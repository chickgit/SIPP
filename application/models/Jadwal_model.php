<?php
class Jadwal_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->load->library('algo');
        // Your own constructor code
    }

    private function session_username()
    {
        return $this->session->userdata('Login')['username'];
    }

    public function generate_jadwal()
    {
        $row_ta = $this->session->userdata('TA');

        // $query = $this->db->get_where('jadwal_temp', array('tahun_ajaran' => $row_ta['tahun_ajaran']));
        // $rows = $query->num_rows();

        // var_dump($this->input->post());
        // exit();
        
        // if ($this->input->post('data') === 'NEW') 
        // {
        //     // NOTHING TO DO
        // }
        // elseif ($this->input->post('data') === 'ULANG') 
        // {
        //     // BERSIHKAN TABEL
        //     $this->db->truncate('jadwal_temp');
        // }
        // INSERT NAMA JADWAL
        $data = array(
            'draft_nama' => $this->input->post('draft_nama'),
            'created_by' => $this->session_username()
        );
        $query = $this->db->insert('draft_jadwal_perkuliahan', $data);
        $last_id = $this->db->insert_id();

        // INSERT DATA BARU
        $jadwal = $this->algo->generate_jadwal($row_ta['tahun_ajaran'], $row_ta['semester']);
        $peminatan = Array(
          '0' => 'Umum',
          '1' => 'EIS',
          '2' => 'MM',
          '3' => 'JarKom',
          '4' => 'MobA',
        );

        if (isset($jadwal['FLAG_TERTINGGAL'])) {
            # code...
            foreach ($jadwal['FLAG_TERTINGGAL'] as $key_flag => $value_flag) {
                # code...
                $data = array(
                    "tahun_ajaran"  => $row_ta['tahun_ajaran'],
                    "kode_mk"       => $value_flag['kode_mk'],
                    "ket"           => $row_ta['semester'],
                    "peserta"       => $value_flag['program_studi'].' | '.$peminatan[$value_flag['peminatan']],
                    "draft_id_jp"   => $last_id,
                    "created_by"    => $this->session_username()
                );
                $this->db->insert('jadwal_perkuliahan', $data);
            }
        }

        unset($jadwal['FLAG_TERTINGGAL']);

        foreach ($jadwal as $key_hr => $value_hr) {
            foreach ($value_hr['WAKTU'] as $key_wk => $value_wk) {
                foreach ($value_wk['RUANGAN'] as $key_rg => $value_rg) {
                    # code...
                    $a = isset($value_rg['MATKUL']) ? $value_rg['MATKUL']['program_studi'] : NULL;
                    if (isset($value_rg['MATKUL']) && array_key_exists($value_rg['MATKUL']['peminatan'], $peminatan)) {
                        $b = $peminatan[$value_rg['MATKUL']['peminatan']];
                    }
                    else
                    {
                        $b = NULL;
                    }
                    $peserta = $a.' | '.$b;
                    $data = array(
                        "tahun_ajaran"  => $row_ta['tahun_ajaran'],
                        "id_hari"       => $value_hr['id'],
                        "kode_wk"       => $value_wk['kode_wk'],
                        "kode_rg"       => $value_rg['kode_rg'],
                        "kode_mk"       => isset($value_rg['MATKUL']) ? $value_rg['MATKUL']['kode_mk'] : NULL,
                        "nid"           => isset($value_rg['DOSEN']) ? $value_rg['DOSEN'] : NULL,
                        "peserta"       => $peserta,
                        "ket"           => $row_ta['semester'],
                        "draft_id_jp"   => $last_id,
                        "created_by"    => $this->session_username()
                    );
                    $this->db->insert('jadwal_perkuliahan', $data);
                }
            }
        }

        // $query = $this->db->get('jadwal_temp');
        return 'OK';
    }

    public function draft()
    {
        $draft = split('_', $this->input->post('draft_id'));

        if ($draft[0] == 'open') 
        {
            # Membuka jadwal perkuliahan dari draft
            // $open_draft = $this->get_all_data('draft_jadwal_perkuliahan', array('draft_id_jp' => $draft[1]), 'row_array');
            $this->session->set_userdata(array('id_draft' => $draft[1]));
            echo "OK";
        }
        else if ($draft[0] == 'edit') 
        {
            # Mengubah nama draft jadwal perkuliahan
            $data = array(
                "draft_nama"    => $this->input->post('draft_nama'),
                "modified_date" => date('Y-m-d H:i:s'),
                "modified_by"   => $this->session_username()
            );

            $this->db->where('draft_id_jp', $draft[1]);
            $this->db->update('draft_jadwal_perkuliahan', $data);
            echo "OK";
        }
        else if ($draft[0] == 'finalisasi') {
            # Hapus seluruh data jadwal satuan di dalam tabel jadwal perkuliahan 
            $this->db->where('kode_mk', NULL);
            $this->db->where('draft_id_jp', $draft[1]);
            $this->db->delete('jadwal_perkuliahan');

            # Update draft menjadi telah di finalisasi
            $data = array(
                'finalisasi' => 1
            );
            $this->db->where('draft_id_jp', $draft[1]);
            $this->db->update('draft_jadwal_perkuliahan', $data);

            if ($this->session->has_userdata('id_draft')) {
                $this->session->unset_userdata('id_draft');
            }

            echo "OK";
        }
        else if ($draft[0] == 'delete') 
        {
            # Menghapus draft jadwal
            $data = array(
                'isDelete' => 1
            );
            $this->db->where('draft_id_jp', $draft[1]);
            $this->db->update('draft_jadwal_perkuliahan', $data);
            
            $this->db->where('draft_id_jp', $draft[1]);
            $this->db->update('jadwal_perkuliahan', $data);
            // $this->db->delete('dosen');

            if ($this->session->has_userdata('id_draft')) {
                $this->session->unset_userdata('id_draft');
            }
            
            echo "OK";
        }
    }

    public function get_detail_jw($id_jw)
    {
        // Ambil induk data JADWAL_TEMP
        $this->db->where('id_jadwal_p',$id_jw);
        $query          = $this->db->get('jadwal_perkuliahan');
        $jadwal_temp    = $query->row_array();
        // return $query->row();

        // Masukkan detail HARI ke dalam JADWAL_TEMP
        $hari           = $this->get_all_data('hari', array('id' => $jadwal_temp['id_hari']), 'row_array');
        $jadwal_temp['DETAIL']['hari'] = $hari;
        $jadwal_temp['id_hari_nama'] = $hari['nama_hari'];

        // Masukkan detail MATA KULIAH ke dalam JADWAL_TEMP
        $matkul         = $this->get_all_data('matakuliah', array('kode_mk' => $jadwal_temp['kode_mk']), 'row_array');
        $jadwal_temp['DETAIL']['matkul'] = $matkul;
        $jadwal_temp['kode_mk_nama'] = $matkul['nama_mk'];

        // Masukkan detail WAKTU ke dalam JADWAL_TEMP
        $waktu          = $this->get_all_data('waktu', array('kode_wk' => $jadwal_temp['kode_wk']), 'row_array');
        $jadwal_temp['DETAIL']['waktu'] = $waktu;
        $jadwal_temp['kode_wk_nama'] = $waktu['waktu_aw'].' - '.$waktu['waktu_ak'];

        // Masukkan detail setiap dosen yang berhak mengajar ke dalam JADWAL_TEMP
        $dosen          = $this->get_all_data('dosen');
        foreach ($dosen as $k => $v) {
            $a = explode(';', $v['wawasan_matkul']);
            $dosen[$k]['wawasan_matkul'] = array();
            foreach ($a as $k_n => $v_n) {
                $b = explode('_', $v_n);
                $dosen[$k]['wawasan_matkul'][] = $b[0];
            }
        }

        foreach ($dosen as $k => $v) {
            if (isset($jadwal_temp['kode_mk']) && in_array($jadwal_temp['kode_mk'], $v['wawasan_matkul'])) {
                $jadwal_temp['DETAIL']['dosen'][] = $v;
            }
            if (is_null($jadwal_temp['kode_mk'])){
                $jadwal_temp['DETAIL']['dosen'] = NULL;
            }
            if (isset($jadwal_temp['nid']) && ($jadwal_temp['nid'] == $v['nid'])) {
                $jadwal_temp['nid_nama'] = $v['nama'];
            }
        }

        // Masukkan detail RUANGAN ke dalam JADWAL_TEMP
        $ruangan          = $this->get_all_data('ruangan', array('kode_rg' => $jadwal_temp['kode_rg']), 'row_array');
        $jadwal_temp['DETAIL']['ruangan'] = $ruangan;

        return $jadwal_temp;
    }

    public function update_jw()
    {
        $data = array(
            "id_hari"       => $this->input->post('upd_hari_jw'),
            "kode_wk"       => $this->input->post('upd_waktu_jw'),
            "kode_rg"       => $this->input->post('upd_ruangan_jw'),
            "kode_mk"       => $this->input->post('upd_mk_jw'),
            "nid"           => $this->input->post('upd_dosen_jw'),
            "peserta"       => $this->input->post('upd_peserta_jw'),
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username()
        );

        $this->db->where('id_jadwal_p', $this->input->post('upd_kode_jw'));
        $this->db->update('jadwal_perkuliahan', $data);
        echo "OK";
    }

    public function delete_jw($kode_jw)
    {
        $data = array(
            'isDelete' => 1
        );
        $this->db->where('id_jadwal_p',$kode_jw);
        $this->db->update('jadwal_perkuliahan',$data);
        echo "OK";
    }
}
