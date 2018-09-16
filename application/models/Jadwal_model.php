<?php
class Jadwal_model extends CI_Model {

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
            $jadwal     = $this->get_data('jadwal_temp');
            foreach ($jadwal as $k_j => $v_j) {
                if ( ! is_null($v_j['kode_mk'])) {
                    unset($jadwal[$k_j]['id_j_t']);
                    $this->db->insert('jadwal_perkuliahan', $jadwal[$k_j]);
                    $this->delete_jw($v_j['id_j_t']);
                }
            }
            echo "OK";
        }
    }

    public function hapus_jadwal()
    {
        if ($this->input->post('data') === 'HAPUS') {
            # code...
            $this->db->truncate('jadwal_temp');
            echo "OK";
        }
    }

    public function generate_jadwal()
    {
        $query = $this->db->get('buka_tahun_ajaran');
        $row_ta = $query->row();

        $query = $this->db->get_where('jadwal_temp', array('tahun_ajaran' => $row_ta->tahun_ajaran));
        $rows = $query->num_rows();

        // var_dump($this->input->post());
        // exit();
        
        if ($this->input->post('data') === 'NEW') 
        {
            // NOTHING TO DO
        }
        elseif ($this->input->post('data') === 'ULANG') 
        {
            // BERSIHKAN TABEL
            $this->db->truncate('jadwal_temp');
        }
        // INSERT DATA BARU
        $jadwal = $this->algo->generate_jadwal($row_ta->tahun_ajaran, $row_ta->semester);
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
                    "tahun_ajaran"  => $row_ta->tahun_ajaran,
                    "kode_mk"       => $value_flag['kode_mk'],
                    "ket"           => $row_ta->semester,
                    "peserta"       => $value_flag['program_studi'].' | '.$peminatan[$value_flag['peminatan']]
                );
                $this->db->insert('jadwal_temp', $data);
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
                        "tahun_ajaran"  => $row_ta->tahun_ajaran,
                        "id_hari"       => $value_hr['id'],
                        "kode_wk"       => $value_wk['kode_wk'],
                        "kode_rg"       => $value_rg['kode_rg'],
                        "kode_mk"       => isset($value_rg['MATKUL']) ? $value_rg['MATKUL']['kode_mk'] : NULL,
                        "nid"           => isset($value_rg['DOSEN']) ? $value_rg['DOSEN'] : NULL,
                        "peserta"       => $peserta,
                        "ket"           => $row_ta->semester
                    );
                    $this->db->insert('jadwal_temp', $data);
                }
            }
        }

        $query = $this->db->get('jadwal_temp');
        return $query->result_array();
    }

    public function get_data_temp()
    {
        $query = $this->db->select(
            // 'jadwal_temp.id_j_t, jadwal_temp.tahun_ajaran, jadwal_temp.peserta,
            'A.id_j_t, A.tahun_ajaran, A.peserta,
            hari.id, hari.nama_hari, 
            waktu.kode_wk, waktu.waktu_aw, waktu.waktu_ak, 
            ruangan.kode_rg, 
            matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, matakuliah.program_studi, matakuliah.peminatan,
            dosen.nid, dosen.nama'
        )
                        ->from('jadwal_temp A')
                        ->where(array('A.isDelete' => 0, 'A.isShow' => 1))
                        ->join('hari', 'hari.id = A.id_hari', 'left')
                        ->join('waktu', 'waktu.kode_wk = A.kode_wk', 'left')
                        ->join('ruangan', 'ruangan.kode_rg = A.kode_rg', 'left')
                        ->join('matakuliah', 'matakuliah.kode_mk = A.kode_mk', 'left')
                        ->join('dosen', 'dosen.nid = A.nid', 'left')
                        ->get();
    	return $query->result();
    }

    public function get_detail_jw($id_jw)
    {
        // Ambil induk data JADWAL_TEMP
        $this->db->where('id_j_t',$id_jw);
        $query          = $this->db->get('jadwal_temp');
        $jadwal_temp    = $query->row_array();
        // return $query->row();

        // Masukkan detail HARI ke dalam JADWAL_TEMP
        $hari           = $this->get_data('hari', array('id' => $jadwal_temp['id_hari']), 'row');
        $jadwal_temp['DETAIL']['hari'] = $hari;
        $jadwal_temp['id_hari_nama'] = $hari['nama_hari'];

        // Masukkan detail MATA KULIAH ke dalam JADWAL_TEMP
        $matkul         = $this->get_data('matakuliah', array('kode_mk' => $jadwal_temp['kode_mk']), 'row');
        $jadwal_temp['DETAIL']['matkul'] = $matkul;
        $jadwal_temp['kode_mk_nama'] = $matkul['nama_mk'];

        // Masukkan detail WAKTU ke dalam JADWAL_TEMP
        $waktu          = $this->get_data('waktu', array('kode_wk' => $jadwal_temp['kode_wk']), 'row');
        $jadwal_temp['DETAIL']['waktu'] = $waktu;
        $jadwal_temp['kode_wk_nama'] = $waktu['waktu_aw'].' - '.$waktu['waktu_ak'];

        // Masukkan detail setiap dosen yang berhak mengajar ke dalam JADWAL_TEMP
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
        $ruangan          = $this->get_data('ruangan', array('kode_rg' => $jadwal_temp['kode_rg']), 'row');
        $jadwal_temp['DETAIL']['ruangan'] = $ruangan;

        return $jadwal_temp;
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

        $this->db->where('id_j_t', $this->input->post('upd_kode_jw'));
        $this->db->update('jadwal_temp', $data);
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
        $this->db->where('id_j_t',$kode_jw);
        $this->db->update('jadwal_temp',$data);
        // $this->db->delete('dosen');
        echo "OK";
    }

}
