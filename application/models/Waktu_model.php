<?php
class Waktu_model extends CI_Model {

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
        $query = $this->db->get_where('waktu', array('isDelete' => 0, 'isShow' => 1));
        return $query->result();
    }

    public function check_kode_wk($kode_wk)
    {
        $query = $this->db->query('SELECT kode_wk FROM waktu WHERE kode_wk = "'.$kode_wk.'"');
        return $query->row();
    }

    public function insert_data()
    {
        $data = array(
            "waktu_aw"  => $this->input->post('awal_wk'),
            "waktu_ak"  => $this->input->post('akhir_wk'),
            "role"      => $this->input->post('id_wk'),
            "sks"       => $this->input->post('sks_wk')
        );
        $this->db->insert('waktu', $data);
        echo "OK";
    }

    public function get_wk($kode_wk)
    {
        $query = $this->db->query('SELECT * FROM waktu WHERE kode_wk = "'.$kode_wk.'"');
        return $query->row();
    }

    public function update_wk()
    {
        $data = array(
            "waktu_aw"      => $this->input->post('upd_awal_wk'),
            "waktu_ak"      => $this->input->post('upd_akhir_wk'),
            "role"          => $this->input->post('upd_id_wk'),
            "sks"           => $this->input->post('upd_sks_wk'),
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username()
        );
        $this->db->where("kode_wk", $this->input->post('upd_kode_wk'));
        $this->db->update('waktu', $data);
        echo "OK";
    }

    public function delete_wk($kode_wk)
    {
        $data = array(
            'isDelete' => 1
        );
        $this->db->where('kode_wk',$kode_wk);
        $this->db->update('waktu',$data);
        // $this->db->delete('dosen');
        echo "OK";
    }

}
