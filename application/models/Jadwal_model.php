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
                    "ket"           => $row_ta->semester
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
        // Ambil induk data jadwal_temp
        $this->db->where('id_j_t',$id_jw);
        $query          = $this->db->get('jadwal_temp');
        $jadwal_temp    = $query->row_array();
        // return $query->row();

        // Masukkan detail setiap dosen yang berhak mengajar ke dalam jadwal_temp
        // $dosen          = $this->get_dosen();
        // foreach ($dosen as $k => $v) {
        //     if (in_array($jadwal_temp['kode_mk'], $v['wawasan_matkul'])) {
        //         $jadwal_temp['DETAIL']['dosen'][] = $v;
        //     }
        // }

        return $jadwal_temp;
    }

    public function get_data($table)
    {
        $this->db->where('isDelete', 0);
        $this->db->where('isShow', 1);
        $query  = $this->db->get($table);
        $data   = $query->result_array();

        return $data;
    }

    private function get_hari()
    {
        $this->db->where('isDelete', 0);
        $this->db->where('isShow', 1);
        $query = $this->db->get('hari');
        $hari = $query->result_array();

        return $hari;
    }

    private function get_dosen()
    {
        $this->db->where('isDelete', 0);
        $this->db->where('isShow', 1);
        $query = $this->db->get('dosen');
        $dosen = $query->result_array();

        foreach ($dosen as $k => $v) {
            $a = explode(';', $v['wawasan_matkul']);
            $dosen[$k]['wawasan_matkul'] = array();
            foreach ($a as $k_n => $v_n) {
                $b = explode('_', $v_n);
                $dosen[$k]['wawasan_matkul'][] = $b[0];
            }
        }

        return $dosen;
    }

    public function check_kode_mk($kode_mk)
    {
        $query = $this->db->query('SELECT kode_mk FROM matakuliah WHERE kode_mk = "'.$kode_mk.'"');
        return $query->row();
    }

    public function insert_data()
    {
        $data = array(
            "kode_mk"       => $this->input->post('kode_mk'),
            "nama_mk"       => $this->input->post('nama_mk'),
            "sks_mk"        => $this->input->post('sks_mk'),
            "semester_mk"   => $this->input->post('semester_mk'),
            "program_studi" => $this->input->post('program_studi'),
            "peminatan"     => $this->input->post('peminatan'),
            "jenis_rg"      => $this->input->post('jenis_rg')
        );
        $this->db->insert('matakuliah', $data);
        echo "OK";
    }

    public function get_mk($kode_mk)
    {
        $query = $this->db->query('SELECT * FROM matakuliah WHERE kode_mk = "'.$kode_mk.'"');
        return $query->row();
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

    public function delete_mk($kode_mk)
    {
        $data = array(
            'isDelete' => 1
        );
        $this->db->where('kode_mk',$kode_mk);
        $this->db->update('matakuliah',$data);
        // $this->db->delete('dosen');
        echo "OK";
    }

}
