<?php
class MataKuliah_model extends MY_Model {

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
            "id_prodi"      => $this->input->post('id_program_studi'),
            "id_peminatan"  => $this->input->post('id_peminatan'),
            "id_jenis"      => $this->input->post('id_jenis_ruangan'),
            "created_by"    => $this->session_username()
        );
        $this->db->insert('matakuliah', $data);
        echo "OK";
    }
    
    public function get_mk()
    {
        $options = array(
            'select'    => 'matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, program_studi.id_prodi, program_studi.panggilan program_studi, peminatan.id_peminatan, peminatan.panggilan peminatan, jenis_ruangan.id_jenis, jenis_ruangan.jenis, matakuliah.created_date, matakuliah.created_by, matakuliah.modified_date, matakuliah.modified_by, matakuliah.isShow',
            'table'     => 'matakuliah',
            'where'     => array('matakuliah.kode_mk' => $this->input->post('kode_mk')),
            'join'      => array(
                'program_studi'     => 'program_studi.id_prodi = matakuliah.id_prodi',
                'peminatan'         => 'peminatan.id_peminatan = matakuliah.id_peminatan',
                'jenis_ruangan'     => 'jenis_ruangan.id_jenis = matakuliah.id_jenis'
            ),
            'single'    => TRUE
        );
        return $this->commonGet($options);
    }

    public function update_mk()
    {
        $data = array(
            "nama_mk"       => $this->input->post('upd_nama_mk'),
            "sks_mk"        => $this->input->post('upd_sks_mk'),
            "semester_mk"   => $this->input->post('upd_semester_mk'),
            "id_prodi"      => $this->input->post('upd_program_studi'),
            "id_peminatan"  => $this->input->post('upd_peminatan'),
            "id_jenis"      => $this->input->post('upd_jenis_ruangan'),
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
            "isDelete"      => 1,
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username()
        );
        $this->db->where('kode_mk',$kode_mk);
        $this->db->update('matakuliah',$data);
        // $this->db->delete('dosen');
        echo "OK";
    }
}
