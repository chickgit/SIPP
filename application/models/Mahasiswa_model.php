<?php
class Mahasiswa_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Your own constructor code
    }

    private function session_username()
    {
        return $this->session->userdata('Login')['username'];
    }

    private function change_array_to_string($array = array())
    {
        $string = '';
        foreach ($array as $key) {
            $string .= $key.';';
        }
        return rtrim($string,';');
    }
    
    # MHS_AMBIL_MK.PHP
    # mengambil mata kuliah yang terbuka untuk tahun ajar dan semester yang dibuka pada saat ini,
    # serta sesuai dengan program studi dan peminatan yang dimiliki mahasiswa
    public function get_list_open_mk()
    {
        # 1. mengambil status tahun ajaran yang sedang di buka.
        $options = array(
            'select'    => 'buka_tahun_ajaran.id_bta, buka_tahun_ajaran.id_ta, buka_tahun_ajaran.id_smstr, buka_tahun_ajaran.batas_akhir, 
                            tahun_ajaran.tahun_ajaran, semester.semester',
            'table'     => 'buka_tahun_ajaran',
            'join'      => array(
                'tahun_ajaran' => 'tahun_ajaran.id_ta = buka_tahun_ajaran.id_ta',
                'semester'     => 'semester.id_smstr = buka_tahun_ajaran.id_smstr'
            ),
            'single'    => TRUE
        );
        $row    = $this->commonGet($options);

        $smstr = array();
        # 2. querying table matakuliah.
        # - matakuliah dengan peminatan sama dengan mahasiswa
        # - matakuliah program studi sama dengan mahasiswa
        # - matakuliah semester 8, karena di dalamnya ada tugas akhir
        # - ordering sesuai dengan semester dan sks dari yg terkecil
        $options = array(
            'select'    => 'matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, 
                            program_studi.id_prodi, program_studi.panggilan program_studi, 
                            peminatan.id_peminatan, peminatan.panggilan peminatan, 
                            jenis_ruangan.id_jenis, jenis_ruangan.jenis, 
                            matakuliah.created_date, matakuliah.created_by, matakuliah.modified_date, matakuliah.modified_by, matakuliah.isShow',
            'table'     => 'matakuliah',
            'where_in'  => array(
                'matakuliah.id_peminatan',
                array(1, $this->session->userdata('Detail')['id_peminatan'])
            ),
            'where'     => array(
                'matakuliah.id_prodi'  => $this->session->userdata('Detail')['id_prodi'],
            ),
            'or_where'  => array('matakuliah.semester_mk' => 8),
            'order'  => array(
                'matakuliah.semester_mk'   => 'ASC',
                'matakuliah.sks_mk'        => 'ASC'
            ),
            'join'      => array(
                'program_studi'     => 'program_studi.id_prodi = matakuliah.id_prodi',
                'peminatan'         => 'peminatan.id_peminatan = matakuliah.id_peminatan',
                'jenis_ruangan'     => 'jenis_ruangan.id_jenis = matakuliah.id_jenis'
            )
        );
        # 3. penambahan query
        # - semester bilangan ganjil untuk GANJIL, bilangan genap untuk GENAP
        if ($row->semester == 'GANJIL') { #GANJIL
            // # mencari matkul dengan semester ganjil dan semester 8
            $options['where']['MOD (semester_mk,2) ='] = 1;
        } 
        else{ # GENAP
            // # mencari matkul dengan semester genap dan semester 8
            $options['where']['MOD (semester_mk,2) ='] = 0;
        }
        return $this->commonGet($options);
    }

    # mengambil list mata kuliah yang sudah diambil mahasiswa
    public function get_data()
    {
        $options = array(
            'select'    => 'ambil_matakuliah.nim, ambil_matakuliah.kode_mk, 
                            tahun_ajaran.id_ta, tahun_ajaran.tahun_ajaran, 
                            semester.id_smstr, semester.semester',
            'table'     => 'ambil_matakuliah',
            'where'     => array(
                'ambil_matakuliah.nim'  => $this->session->userdata('Detail')['nim'],
                'tahun_ajaran.id_ta'    => $this->session->userdata('TA')->id_ta,
                'semester.id_smstr'    => $this->session->userdata('TA')->id_smstr,
            ),
            'join'      => array(
                'tahun_ajaran'     => 'tahun_ajaran.id_ta = ambil_matakuliah.id_ta',
                'semester'         => 'semester.id_smstr = ambil_matakuliah.id_smstr',
            ),
            'single'    => true
        );
        $data_ambil_mk = $this->commonGet($options);
        $new_obj = (object) array();
        $new = explode(';', $data_ambil_mk->kode_mk);
        foreach ($new as $key => $kode_mk) {
            $query = $this->get_mk($kode_mk);
            if (isset($query)) {
                $new_obj->$key = $query;
                $new_obj->$key->nim = $data_ambil_mk->nim;
                $new_obj->$key->id_ta = $data_ambil_mk->id_ta;
                $new_obj->$key->tahun_ajaran = $data_ambil_mk->tahun_ajaran;
                $new_obj->$key->id_smstr = $data_ambil_mk->id_smstr;
                $new_obj->$key->smstr = $data_ambil_mk->semester;
            }
        }
        return $new_obj;
        // return $data_ambil_mk;
    }

    # input data ambil mata kuliah oleh mhs
    public function insert()
    {
        $data = array(
            "nim"           => $this->input->post('nim'),
            "id_ta"         => $this->input->post('tahun_ajaran'),
            "id_smstr"      => $this->input->post('semester'),
            "kode_mk"       => $this->change_array_to_string($this->input->post('kd_mk')),
            "created_by"    => $this->session_username()
        );
        $this->db->insert('ambil_matakuliah', $data);
        echo "OK";
    }

    # update data ambil mata kuliah oleh mhs
    public function update()
    {
        $data = array(
            "kode_mk"           => $this->change_array_to_string($this->input->post('kd_mk')),
            "modified_date"     => date('Y-m-d H:i:s'),
            "modified_by"       => $this->session_username()
        );
        $this->db->where("nim", $this->input->post('nim'));
        $this->db->where("id_ta", $this->input->post('tahun_ajaran'));
        $this->db->where("id_smstr", $this->input->post('semester'));
        $this->db->update('ambil_matakuliah', $data);
        echo "OK";
    }

    # mengambil data mata kuliah satuan
    public function get_mk($kode_mk)
    {
        $options = array(
            'select'    => 'matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, program_studi.id_prodi, program_studi.panggilan program_studi, peminatan.id_peminatan, peminatan.panggilan peminatan, jenis_ruangan.id_jenis, jenis_ruangan.jenis, matakuliah.created_date, matakuliah.created_by, matakuliah.modified_date, matakuliah.modified_by, matakuliah.isShow',
            'table'     => 'matakuliah',
            'where'     => array('matakuliah.kode_mk' => $kode_mk),
            'join'      => array(
                'program_studi'     => 'program_studi.id_prodi = matakuliah.id_prodi',
                'peminatan'         => 'peminatan.id_peminatan = matakuliah.id_peminatan',
                'jenis_ruangan'     => 'jenis_ruangan.id_jenis = matakuliah.id_jenis'
            ),
            'single'    => TRUE
        );
        return $this->commonGet($options);
        // $query = $this->db->get_where('matakuliah', array(
        //     "kode_mk"   => $kode_mk,
        //     "isDelete"  => 0, 
        //     "isShow"    => 1
        // ));
        // return $query->row();
    }

    # MHS_JP.PHP
    # mengambil draft matkul yang sudah difinalisasi dan terbit
    public function draft()
    {
        $options = array(
			'select'    => 'draft_jadwal_perkuliahan.draft_id_jp, draft_jadwal_perkuliahan.draft_nama, draft_jadwal_perkuliahan.finalisasi, draft_jadwal_perkuliahan.terbit, 
							tahun_ajaran.id_ta, tahun_ajaran.tahun_ajaran, 
							semester.id_smstr, semester.semester',
			'table'     => 'draft_jadwal_perkuliahan',
			'where'		=> array(
				'draft_jadwal_perkuliahan.finalisasi'	        => 1,
				'draft_jadwal_perkuliahan.terbit'		        => 1,
				'draft_jadwal_perkuliahan.id_ta IS NOT NULL'    => NULL,
				'draft_jadwal_perkuliahan.id_smstr IS NOT NULL' => NULL
			),
			'join'      => array(
				array('tahun_ajaran', 'tahun_ajaran.id_ta = draft_jadwal_perkuliahan.id_ta', 'left'),
				array('semester', 'semester.id_smstr = draft_jadwal_perkuliahan.id_smstr', 'left'),
            )
        );
        return $this->commonGet($options);
    }

    # mengambil jadwal perkuliahan khusus untuk mhs sesuai dg pilihannya
    public function jadwal_perkuliahan_mahasiswa(Type $var = null)
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
            'where'     => array(
				'draft_jadwal_perkuliahan.draft_id_jp'  => $this->input->post('tahun_ajar'),
				'program_studi.id_prodi'                => $this->session->userdata('Detail')['id_prodi'],
                ),
            'where_in'  => array(
                'matakuliah.id_peminatan',
                array(1, $this->session->userdata('Detail')['id_peminatan'])
            ),
            'or_where'  => array('matakuliah.semester_mk' => 8),
            'order'  => array(
                'matakuliah.semester_mk'   => 'ASC',
                'matakuliah.sks_mk'        => 'ASC'
            ),
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
    }
}
