<?php
class Histori_model extends MY_Model {
    // protected $arr = array();
    protected $single = false;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Your own constructor code
    }

    public function get_histori($table, $where = array())
    {
        // $data = array(
        //     'isDelete' => 1,
        //     'isShow'   => 1
        // );
        // if (!empty($where)) {
        //     $data = array_merge($data, $where);
        // }

        // if ($table == 'jadwal_perkuliahan') {
        //     $table = 'draft_jadwal_perkuliahan';
        //     $data['finalisasi'] = 1;
        // }

        // if ($table == 'jadwal') 
        // {
        //     $query = $this->get_jadwal_history($where);
        //     return $query;
        // }
        // else
        // {
        //     $query = $this->db->get_where($table, $data);
        // }
        // return $query->result();

        switch ($table) {
            case 'jadwal':
                return $this->jadwal_perkuliahan($where);
                break;
            
            case 'jadwal_perkuliahan':
                $where = array('finalisasi' => 1);
                return $this->draft_jadwal_perkuliahan($where);
                break;

            default:
                $data = array(
                    'isDelete' => 1,
                    'isShow'   => 1
                );
                if (!empty($where)) {
                    $data = array_merge($data, $where);
                }
                $query = $this->db->get_where($table,$data);
                return $query->result();
                break;
        }
    }

    private function get_jadwal_history($where = array())
    {
        $options = array(
            'history'   => TRUE,
            'select'    => 'jadwal_perkuliahan.id_jadwal_p, jadwal_perkuliahan.draft_id_jp,
                            tahun_ajaran.id_ta, tahun_ajaran.tahun_ajaran,
                            semester.id_smstr, semester.semester,
                            hari.id_hari, hari.nama_hari, 
                            waktu.id_waktu, waktu.waktu_aw, waktu.waktu_ak, 
                            ruangan.id_ruangan, ruangan.nama_ruangan, 
                            matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, 
                            program_studi.id_prodi, program_studi.panggilan prodi, 
                            peminatan.id_peminatan, peminatan.panggilan peminatan,
                            dosen.nid, dosen.nama',
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
                array('dosen', 'dosen.nid = jadwal_perkuliahan.nid', 'left')
            )
        );
        $hasil = $this->commonGet($options);
        return $hasil;
        // $query = $this->db->select(
        //         // 'jadwal_temp.id_j_t, jadwal_temp.tahun_ajaran, jadwal_temp.peserta,
        //         'A.id_jadwal_p, A.tahun_ajaran, A.peserta,
        //         hari.id, hari.nama_hari, 
        //         waktu.kode_wk, waktu.waktu_aw, waktu.waktu_ak, 
        //         ruangan.kode_rg, 
        //         matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, matakuliah.program_studi, matakuliah.peminatan,
        //         dosen.nid, dosen.nama'
        //     )
        //                     ->from('jadwal_perkuliahan A')
        //                     ->where(array('A.isDelete' => 1, 'A.isShow' => 1))
        //                     ->where($where)
        //                     ->join('hari', 'hari.id = A.id_hari', 'left')
        //                     ->join('waktu', 'waktu.kode_wk = A.kode_wk', 'left')
        //                     ->join('ruangan', 'ruangan.kode_rg = A.kode_rg', 'left')
        //                     ->join('matakuliah', 'matakuliah.kode_mk = A.kode_mk', 'left')
        //                     ->join('dosen', 'dosen.nid = A.nid', 'left')
        //                     ->get();
        // return $query;                            
    }

    public function get_data($table, $arr)
    {
        $this->single = true;
        switch ($table) {
            case 'jadwal':
                return $this->jadwal_perkuliahan($arr);
                break;
            
            case 'jadwal_perkuliahan':
                return $this->jadwal_perkuliahan($arr);
                break;

            case 'draft_jadwal_perkuliahan':
                return $this->draft_jadwal_perkuliahan($arr);
                break;
            
            default:
                $query = $this->db->get_where($table,$arr);
                return $query->row();
                break;
        }
        // if ($table == 'jadwal' || $table == 'jadwal_perkuliahan') 
        // {
        //     $query = $this->db->select(
        //         // 'jadwal_temp.id_j_t, jadwal_temp.tahun_ajaran, jadwal_temp.peserta,
        //         'A.id_jadwal_p, A.tahun_ajaran, A.peserta,
        //         hari.id, hari.nama_hari, 
        //         waktu.kode_wk, waktu.waktu_aw, waktu.waktu_ak, 
        //         ruangan.kode_rg, 
        //         matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, matakuliah.program_studi, matakuliah.peminatan,
        //         dosen.nid, dosen.nama'
        //     )
        //                     ->from('jadwal_perkuliahan A')
        //                     ->where($arr)
        //                     ->join('hari', 'hari.id = A.id_hari', 'left')
        //                     ->join('waktu', 'waktu.kode_wk = A.kode_wk', 'left')
        //                     ->join('ruangan', 'ruangan.kode_rg = A.kode_rg', 'left')
        //                     ->join('matakuliah', 'matakuliah.kode_mk = A.kode_mk', 'left')
        //                     ->join('dosen', 'dosen.nid = A.nid', 'left')
        //                     ->get();
        // }
        // else
        // {
        //     $query = $this->db->get_where($table,$arr);
        // }
        // return $query->row();
    }

    private function jadwal_perkuliahan($arr)
    {
        $options = array(
            'history'   => TRUE,
            'select'    => 'jadwal_perkuliahan.id_jadwal_p, jadwal_perkuliahan.draft_id_jp,
                            tahun_ajaran.id_ta, tahun_ajaran.tahun_ajaran,
                            semester.id_smstr, semester.semester,
                            hari.id_hari, hari.nama_hari, 
                            waktu.id_waktu, waktu.waktu_aw, waktu.waktu_ak, 
                            ruangan.id_ruangan, ruangan.nama_ruangan, 
                            matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, 
                            program_studi.id_prodi, program_studi.panggilan prodi, 
                            peminatan.id_peminatan, peminatan.panggilan peminatan,
                            dosen.nid, dosen.nama',
            'table'     => 'jadwal_perkuliahan',
            'where'     => $arr,
            'join'      => array(
                array('tahun_ajaran', 'tahun_ajaran.id_ta = jadwal_perkuliahan.id_ta', 'left'),
                array('semester', 'semester.id_smstr = jadwal_perkuliahan.id_smstr', 'left'),
                array('hari', 'hari.id_hari = jadwal_perkuliahan.id_hari', 'left'),
                array('waktu', 'waktu.id_waktu = jadwal_perkuliahan.id_waktu', 'left'),
                array('ruangan', 'ruangan.id_ruangan = jadwal_perkuliahan.id_ruangan', 'left'),
                array('matakuliah', 'matakuliah.kode_mk = jadwal_perkuliahan.kode_mk', 'left'),
                array('program_studi', 'program_studi.id_prodi = matakuliah.id_prodi', 'left'),
                array('peminatan', 'peminatan.id_peminatan = matakuliah.id_peminatan', 'left'),
                array('dosen', 'dosen.nid = jadwal_perkuliahan.nid', 'left')
            ),
            'single'    => $this->single
        );
        $hasil = $this->commonGet($options);
        return $hasil;
    }

    public function draft_jadwal_perkuliahan($arr)
    {
        $options = array(
            'history'   => TRUE,
			'select'    => 'draft_jadwal_perkuliahan.draft_id_jp, draft_jadwal_perkuliahan.draft_nama, draft_jadwal_perkuliahan.finalisasi, draft_jadwal_perkuliahan.terbit, 
							tahun_ajaran.id_ta, tahun_ajaran.tahun_ajaran, 
							semester.id_smstr, semester.semester',
			'table'     => 'draft_jadwal_perkuliahan',
			'where'		=> $arr,
			'join'      => array(
				array('tahun_ajaran', 'tahun_ajaran.id_ta = draft_jadwal_perkuliahan.id_ta', 'left'),
				array('semester', 'semester.id_smstr = draft_jadwal_perkuliahan.id_smstr', 'left'),
			),
			'single'	=> $this->single    
        );
        return $this->commonGet($options);
    }

    public function restore_data($arr)
    {
        # restore what?
        $data = array(
            'isDelete' => 0
        );
        # restore who?
        $arr2 = array(
            $arr['restore_1'] => $arr['restore_0']
        );
        $this->db->update($arr['restore_2'], $data, $arr2);
        // $this->db->delete('dosen');
        echo "OK";
    }

    public function delete_data($arr)
    {
        $arr2 = array(
            $arr['delete_1'] => $arr['delete_0']
        );
        $this->db->delete($arr['delete_2'],$arr2);
        // $this->db->delete('dosen');
        echo "OK";
    }

    public function draft()
    {
        $draft = explode('_', $this->input->post('draft_id'));

        if ($draft[0] == 'open') 
        {
            # Membuka jadwal perkuliahan dari draft
            // $open_draft = $this->get_all_data('draft_jadwal_perkuliahan', array('draft_id_jp' => $draft[1]), 'row_array');
            $this->session->set_userdata(array('id_draft_histori' => $draft[1]));
            echo "OK";
        }
        else if ($draft[0] == 'restore') {
            // Mengembalikan data jadwal perkuliahan
            $data = array(
                'isDelete' => 0
            );
            $arr2 = array(
                'draft_id_jp' => $draft[1]
            );
            $this->db->update('draft_jadwal_perkuliahan', $data, $arr2);
            echo "OK";
        }
        else if ($draft[0] == 'delete') 
        {
            # Menghapus permanen draft jadwal
            $data = array(
                'draft_id_jp' => $draft[1]
            );
            $this->db->delete('jadwal_perkuliahan',$data); # Child
            $this->db->delete('draft_jadwal_perkuliahan',$data); # Parent
            echo "OK";
        }
    }
}
