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

    public function generate_jadwal()
    {
        $query = $this->db->get('buka_tahun_ajaran');
        $row_ta = $query->row();

        $query = $this->db->get_where('jadwal_temp', array('tahun_ajaran' => $row_ta->tahun_ajaran));
        $rows = $query->num_rows();

        // var_dump($this->input->post());
        // exit();
        
        if ($this->input->post('data') == 'NEW') 
        {
            // NOTHING TO DO
        }
        elseif ($this->input->post('data') == 'ULANG') 
        {
            // BERSIHKAN TABEL
            $this->db->truncate('jadwal_temp');
        }
        // INSERT DATA BARU
        $jadwal = $this->algo->generate_jadwal($row_ta->tahun_ajaran);
        $peminatan = Array(
          '0' => 'Umum',
          '1' => 'EIS',
          '2' => 'MM',
          '3' => 'JarKom',
          '4' => 'MobA',
        );
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
                        "nid"           => isset($value_rg['DOSEN']) ? $value_rg['DOSEN']['nid'] : NULL,
                        "peserta"       => $peserta
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
        $query = $this->db->select('jadwal_temp.tahun_ajaran, jadwal_temp.peserta,
            hari.id, hari.nama_hari, 
            waktu.kode_wk, waktu.waktu_aw, waktu.waktu_ak, 
            ruangan.kode_rg, 
            matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, matakuliah.program_studi, matakuliah.peminatan,
            dosen.nid, dosen.nama')
                        ->from('jadwal_temp')
                        ->join('hari', 'hari.id = jadwal_temp.id_hari', 'left')
                        ->join('waktu', 'waktu.kode_wk = jadwal_temp.kode_wk', 'left')
                        ->join('ruangan', 'ruangan.kode_rg = jadwal_temp.kode_rg', 'left')
                        ->join('matakuliah', 'matakuliah.kode_mk = jadwal_temp.kode_mk', 'left')
                        ->join('dosen', 'dosen.nid = jadwal_temp.nid', 'left')
                        ->get();
    	return $query->result();
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
