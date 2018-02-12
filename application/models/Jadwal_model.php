<?php
class Jadwal_model extends CI_Model {

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

    public function get_data()
    {
        $query = $this->db->get_where('matakuliah', array('isDelete' => 0, 'isShow' => 1));
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
