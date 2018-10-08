<?php
class MY_Model extends CI_Model {

	public function __construct()
    {
    	parent::__construct();
    	
        $this->load->database();
    }

    public function get_all_data($table, $array = array(), $result = 'result_array')
    {
        $this->db->where('isDelete', 0);
        $this->db->where('isShow', 1);
        if (!empty($array)) {
            $this->db->where($array);
        }
        $query  = $this->db->get($table);

        switch ($result) {
            case 'result':
                $data = $query->result();
                break;

            case 'result_array':
                $data = $query->result_array();
                break;
            
            case 'row':
                $data = $query->row();
                break;

            case 'row_array':
                $data = $query->row_array();
                break;

            case 'num_rows':
                $data = $query->num_rows();
                break;

            // default:
            //     $data = $query->result();
            //     break;
        }
        
        return $data;
    }
    
    public function get_all_jadwal_perkuliahan($where = array())
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
                        ->where($where)
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
}
