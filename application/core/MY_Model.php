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
        $where_in        = false;
        $single          = false;
        $where_not_in    = false;
        $like            = false;
        $history         = false;
        $isDelete        = 0;

        extract($options);

        if ($history != false) {
            $isDelete = 1;
        }

        if ($select != false)
            $this->db->select($select);

        if ($table != false)
            $this->db->from($table);

        if ($where != false)
            $this->db->where($where);

        if ($where_in != false) {
            #$where_in[1] as field, $where_in[2] as array(item,item) of target values
            $this->db->where_in($where_in[0],$where_in[1]);
        }

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
                        $key.'.isDelete' => $isDelete,
                        $key.'.isShow' => 1
                    ));
                }
            }
            $this->db->where(array(
                $table.'.isDelete' => $isDelete,
                $table.'.isShow' => 1
            ));
        }

        $query = $this->db->get();

        if ($single) {
            return $query->row();
        }
        
        // return $this->db; # checking query
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

    public function get_all_ruangan()
    {
        $options = array(
            'select'    => 'ruangan.id_ruangan, ruangan.nama_ruangan, ruangan.gedung_rg, jenis_ruangan.id_jenis, jenis_ruangan.jenis, ruangan.kapasitas_rg, ruangan.created_date, ruangan.created_by, ruangan.modified_date, ruangan.modified_by, ruangan.isShow',
            'table'     => 'ruangan',
            'join'      => array(
                'jenis_ruangan'     => 'jenis_ruangan.id_jenis = ruangan.id_jenis',
            )
        );
        return $this->commonGet($options);
    }
    
    public function get_all_jadwal_perkuliahan($where = array())
    {
        $options = array(
            'select'    => 'jadwal_perkuliahan.id_jadwal_p,
                            tahun_ajaran.id_ta, tahun_ajaran.tahun_ajaran,
                            semester.id_smstr, semester.semester,
                            hari.id_hari, hari.nama_hari, 
                            waktu.id_waktu, waktu.waktu_aw, waktu.waktu_ak, 
                            ruangan.id_ruangan, ruangan.nama_ruangan, 
                            matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, 
                            program_studi.id_prodi, program_studi.panggilan prodi, 
                            peminatan.id_peminatan, peminatan.panggilan peminatan,
                            dosen.nid, dosen.nama,
                            draft_jadwal_perkuliahan.draft_id_jp',
            'table'     => 'jadwal_perkuliahan',
            'where'     => $where,
            // 'join'      => array(
            //     'tahun_ajaran'  => 'tahun_ajaran.id_ta = jadwal_perkuliahan.id_ta',
            //     'semester'      => 'semester.id_smstr = jadwal_perkuliahan.id_smstr',
            //     'hari'          => 'hari.id_hari = jadwal_perkuliahan.id_hari',
            //     'waktu'         => 'waktu.id_waktu = jadwal_perkuliahan.id_waktu',
            //     'ruangan'       => 'ruangan.id_ruangan = jadwal_perkuliahan.id_ruangan',
            //     'matakuliah'    => 'matakuliah.kode_mk = jadwal_perkuliahan.kode_mk',
            //     'program_studi' => 'program_studi.id_prodi = matakuliah.id_prodi', # program_studi join dg matkul
            //     'peminatan'     => 'peminatan.id_peminatan = matakuliah.id_peminatan', # peminatan join dg matkul
            //     'dosen'         => 'dosen.nid = jadwal_perkuliahan.nid',
            // )
            'join'      => array(
                array('tahun_ajaran', 'tahun_ajaran.id_ta = jadwal_perkuliahan.id_ta', 'left'),
                array('semester', 'semester.id_smstr = jadwal_perkuliahan.id_smstr', 'left'),
                array('hari', 'hari.id_hari = jadwal_perkuliahan.id_hari', 'left'),
                array('waktu', 'waktu.id_waktu = jadwal_perkuliahan.id_waktu', 'left'),
                array('ruangan', 'ruangan.id_ruangan = jadwal_perkuliahan.id_ruangan', 'left'),
                array('matakuliah', 'matakuliah.kode_mk = jadwal_perkuliahan.kode_mk', 'left'),
                array('program_studi', 'program_studi.id_prodi = matakuliah.id_prodi', 'left'),
                array('peminatan', 'peminatan.id_peminatan = matakuliah.id_peminatan', 'left'),
                array('dosen', 'dosen.nid = jadwal_perkuliahan.nid', 'left'),
                array('draft_jadwal_perkuliahan', 'draft_jadwal_perkuliahan.draft_id_jp = jadwal_perkuliahan.draft_id_jp', 'left')
            )
        );
        $hasil = $this->commonGet($options);
        foreach ($hasil as $key => $value) {
            foreach ($hasil as $key_hasil => $value_hasil) {
                // Cegah agar tidak bertemu data sendiri
                if ($value->id_jadwal_p != $value_hasil->id_jadwal_p) 
                {
                    // Jika id_hari==null ATAU kode_mk==null ATAU id_ruangan==null ATAU nid==null
                    if (is_null($value->id_hari) || is_null($value->kode_mk) || is_null($value->id_ruangan) || is_null($value->nid)) 
                    {
                        # Beri label warning tingkat S
                        $hasil[$key]->label = 's_warning';
                    }
                    else
                    {
                        // Jika id_hari sama,
                        if ($value->id_hari == $value_hasil->id_hari) 
                        {
                            // cek
                            // Jika (id_waktu DAN semester_mk sama) ATAU (id_waktu DAN nid sama) ATAU (id_waktu DAN nama_mk sama) ATAU (id_waktu DAN id_ruangan sama) ATAU (nama_mk sama) ATAU (kode_mk sama)
                            if (
                                (($value->id_waktu == $value_hasil->id_waktu) && ($value->semester_mk == $value_hasil->semester_mk)) ||
                                (($value->id_waktu == $value_hasil->id_waktu) && ($value->nid == $value_hasil->nid)) ||
                                (($value->id_waktu == $value_hasil->id_waktu) && ($value->nama_mk == $value_hasil->nama_mk)) ||
                                (($value->id_waktu == $value_hasil->id_waktu) && ($value->id_ruangan == $value_hasil->id_ruangan)) ||
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
