<?php
class Jadwal_perkuliahan_model extends CI_Model {

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

    public function bersih_jadwal()
    {
        // MEMBUANG DATA YANG TIDAK DI BUTUHKAN
        if ($this->input->post('data') === 'BERSIH') {
            # code...
            $jadwal_new = array();
            $jadwal     = $this->get_data('jadwal_perkuliahan');
            foreach ($jadwal as $k_j => $v_j) {
                if ( ! is_null($v_j['kode_mk'])) {
                    unset($jadwal[$k_j]['id_jadwal_p']);
                    $this->db->insert('jadwal_perkuliahan', $jadwal[$k_j]);
                    $this->delete_jw($v_j['id_jadwal_p']);
                }
            }
            echo "OK";
        }
    }

    public function hapus_jadwal()
    {
        if ($this->input->post('data') === 'HAPUS') {
            # code...
            $this->db->truncate('jadwal_perkuliahan');
            echo "OK";
        }
    }

    public function get_data_temp()
    {
        $query = $this->db->select(
            // 'jadwal_perkuliahan.id_jadwal_p, jadwal_perkuliahan.tahun_ajaran, jadwal_perkuliahan.peserta,
            'A.id_jadwal_p, A.tahun_ajaran, A.peserta,
            hari.id, hari.nama_hari, 
            waktu.kode_wk, waktu.waktu_aw, waktu.waktu_ak, 
            ruangan.kode_rg, 
            matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, matakuliah.program_studi, matakuliah.peminatan,
            dosen.nid, dosen.nama'
        )
                        ->from('jadwal_perkuliahan A')
                        ->where(array('A.isDelete' => 0, 'A.isShow' => 1))
                        ->join('hari', 'hari.id = A.id_hari', 'left')
                        ->join('waktu', 'waktu.kode_wk = A.kode_wk', 'left')
                        ->join('ruangan', 'ruangan.kode_rg = A.kode_rg', 'left')
                        ->join('matakuliah', 'matakuliah.kode_mk = A.kode_mk', 'left')
                        ->join('dosen', 'dosen.nid = A.nid', 'left')
                        ->get();
        $hasil = $query->result();
        foreach ($hasil as $key => $value) {
            foreach ($hasil as $key_hasil => $value_hasil) {
                // Cegah agar tidak bertemu data sendiri
                if ($value->id_jadwal_p != $value_hasil->id_jadwal_p) 
                {
                    // Jika id_hari==null ATAU kode_mk==null ATAU kode_rg==null ATAU nid==null
                    if (is_null($value->id) || is_null($value->kode_mk) || is_null($value->kode_rg) || is_null($value->nid)) 
                    {
                        # Beri label warning tingkat S
                        $hasil[$key]->label = 's_warning';
                    }
                    else
                    {
                        // Jika hari sama,
                        if ($value->id == $value_hasil->id) 
                        {
                            // cek
                            // Jika (kode_wk DAN semester_mk sama) ATAU (kode_wk DAN nid sama) ATAU (kode_wk DAN nama_mk sama) ATAU (kode_wk DAN kode_rg sama) ATAU (nama_mk sama) ATAU (kode_mk sama)
                            if (
                                (($value->kode_wk == $value_hasil->kode_wk) && ($value->semester_mk == $value_hasil->semester_mk)) ||
                                (($value->kode_wk == $value_hasil->kode_wk) && ($value->nid == $value_hasil->nid)) ||
                                (($value->kode_wk == $value_hasil->kode_wk) && ($value->nama_mk == $value_hasil->nama_mk)) ||
                                (($value->kode_wk == $value_hasil->kode_wk) && ($value->kode_rg == $value_hasil->kode_rg)) ||
                                ($value->nama_mk == $value_hasil->nama_mk) ||
                                ($value->kode_mk == $value_hasil->kode_mk) 
                            ) 
                            {
                                // Ganti label warning tingkat A
                                $hasil[$key]->label = 'a_warning';
                            }
                        }
                    }
                }
            }
        }
    	return $hasil;
    }

    public function get_detail_jw($id_jw)
    {
        // Ambil induk data JADWAL_perkuliahan
        $this->db->where('id_jadwal_p',$id_jw);
        $query          = $this->db->get('jadwal_perkuliahan');
        $jadwal_perkuliahan    = $query->row_array();
        // return $query->row();

        // Masukkan detail HARI ke dalam JADWAL_perkuliahan
        $hari           = $this->get_data('hari', array('id' => $jadwal_perkuliahan['id_hari']), 'row');
        $jadwal_perkuliahan['DETAIL']['hari'] = $hari;
        $jadwal_perkuliahan['id_hari_nama'] = $hari['nama_hari'];

        // Masukkan detail MATA KULIAH ke dalam JADWAL_perkuliahan
        $matkul         = $this->get_data('matakuliah', array('kode_mk' => $jadwal_perkuliahan['kode_mk']), 'row');
        $jadwal_perkuliahan['DETAIL']['matkul'] = $matkul;
        $jadwal_perkuliahan['kode_mk_nama'] = $matkul['nama_mk'];

        // Masukkan detail WAKTU ke dalam JADWAL_perkuliahan
        $waktu          = $this->get_data('waktu', array('kode_wk' => $jadwal_perkuliahan['kode_wk']), 'row');
        $jadwal_perkuliahan['DETAIL']['waktu'] = $waktu;
        $jadwal_perkuliahan['kode_wk_nama'] = $waktu['waktu_aw'].' - '.$waktu['waktu_ak'];

        // Masukkan detail setiap dosen yang berhak mengajar ke dalam JADWAL_perkuliahan
        $dosen          = $this->get_data('dosen');
        foreach ($dosen as $k => $v) {
            $a = explode(';', $v['wawasan_matkul']);
            $dosen[$k]['wawasan_matkul'] = array();
            foreach ($a as $k_n => $v_n) {
                $b = explode('_', $v_n);
                $dosen[$k]['wawasan_matkul'][] = $b[0];
            }
        }

        foreach ($dosen as $k => $v) {
            if (isset($jadwal_perkuliahan['kode_mk']) && in_array($jadwal_perkuliahan['kode_mk'], $v['wawasan_matkul'])) {
                $jadwal_perkuliahan['DETAIL']['dosen'][] = $v;
            }
            if (is_null($jadwal_perkuliahan['kode_mk'])){
                $jadwal_perkuliahan['DETAIL']['dosen'] = NULL;
            }
            if (isset($jadwal_perkuliahan['nid']) && ($jadwal_perkuliahan['nid'] == $v['nid'])) {
                $jadwal_perkuliahan['nid_nama'] = $v['nama'];
            }
        }

        // Masukkan detail RUANGAN ke dalam JADWAL_perkuliahan
        $ruangan          = $this->get_data('ruangan', array('kode_rg' => $jadwal_perkuliahan['kode_rg']), 'row');
        $jadwal_perkuliahan['DETAIL']['ruangan'] = $ruangan;

        return $jadwal_perkuliahan;
    }

    public function get_data($table, $array = array(), $result = 'array')
    {
        $this->db->where('isDelete', 0);
        $this->db->where('isShow', 1);
        if (!empty($array)) {
            $this->db->where($array);
        }
        $query  = $this->db->get($table);
        if ($result == 'array') {
            $data = $query->result_array();
        }
        if ($result == 'row') {
            $data = $query->row_array();
        }
        return $data;
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

    public function update_mk()
    {
        $data = array(
            "nama_mk"       => $this->input->post('upd_nama_mk'),
            "sks_mk"        => $this->input->post('upd_sks_mk'),
            "semester_mk"   => $this->input->post('upd_semester_mk'),
            "program_studi" => $this->input->post('upd_program_studi'),
            "peminatan"     => $this->input->post('upd_peminatan'),
            "jenis_rg"      => $this->input->post('upd_jenis_rg'),
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username()
        );
        $this->db->where("kode_mk", $this->input->post('upd_kode_mk'));
        $this->db->update('matakuliah', $data);
        echo "OK";
    }

    public function delete_jw($kode_jw)
    {
        $data = array(
            'isDelete' => 1
        );
        $this->db->where('id_jadwal_p',$kode_jw);
        $this->db->update('jadwal_perkuliahan',$data);
        // $this->db->delete('dosen');
        echo "OK";
    }

}
