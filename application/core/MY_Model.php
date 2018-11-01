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

    public function commonGet($options) 
    {
        $select          = false;
        $table           = false;
        $join            = false;
        $order           = false;
        $limit           = false;
        $offset          = false;
        $where           = false;
        $or_where        = false;
        $single          = false;
        $where_not_in    = false;
        $like            = false;

        extract($options);

        if ($select != false)
            $this->db->select($select);

        if ($table != false)
            $this->db->from($table);

        if ($where != false)
            $this->db->where($where);

        if ($where_not_in != false) {
            foreach ($where_not_in as $key => $value) {
                if (count($value) > 0)
                    $this->db->where_not_in($key, $value);
            }
        }

        if ($like != false) {
            $this->db->like($like);
        }

        if ($or_where != false)
            $this->db->or_where($or_where);

        if ($limit != false) {

            if (!is_array($limit)) {
                $this->db->limit($limit);
            } else {
                foreach ($limit as $limitval => $offset) {
                    $this->db->limit($limitval, $offset);
                }
            }
        }


        if ($order != false) {

            foreach ($order as $key => $value) {

                if (is_array($value)) {
                    foreach ($order as $orderby => $orderval) {
                        $this->db->order_by($orderby, $orderval);
                    }
                } else {
                    $this->db->order_by($key, $value);
                }
            }
        }


        if ($join != false) {

            foreach ($join as $key => $value) {

                if (is_array($value)) {

                    if (count($value) == 3) {
                        $this->db->join($value[0], $value[1], $value[2]);
                    } else {
                        foreach ($value as $key1 => $value1) {
                            $this->db->join($key1, $value1);
                        }
                    }
                } else {
                    $this->db->join($key, $value);
                    $this->db->where(array(
                        $key.'.isDelete' => 0,
                        $key.'.isShow' => 1
                    ));
                }
            }
            $this->db->where(array(
                $table.'.isDelete' => 0,
                $table.'.isShow' => 1
            ));
        }

        $query = $this->db->get();

        if ($single) {
            return $query->row();
        }


        return $query->result();
    }

    public function get_all_matakuliah()
    {
        $options = array(
            'select'    => 'matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, program_studi.id_prodi, program_studi.panggilan program_studi, peminatan.id_peminatan, peminatan.panggilan peminatan, jenis_ruangan.id_jenis, jenis_ruangan.jenis, matakuliah.created_date, matakuliah.created_by, matakuliah.modified_date, matakuliah.modified_by, matakuliah.isShow',
            'table'     => 'matakuliah',
            'join'      => array(
                'program_studi'     => 'program_studi.id_prodi = matakuliah.id_prodi',
                'peminatan'         => 'peminatan.id_peminatan = matakuliah.id_peminatan',
                'jenis_ruangan'     => 'jenis_ruangan.id_jenis = matakuliah.id_jenis'
            )
        );
        return $this->commonGet($options);
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
