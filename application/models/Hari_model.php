<?php
class Hari_model extends MY_Model {

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

    public function insert_data($arr = array())
    {
        $data = array(
            "nama_hari"  => $this->input->post('nama_hari'),
            "created_by" => $this->session_username(),
            "isShow"     => $this->input->post('isShow')
        );
        $this->db->insert('hari', $data);
        echo "OK";
    }

    
    public function update_hr()
    {
        $data = array(
            "nama_hari"     => $this->input->post('upd_nama_hari'),
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username(),
            "isShow"     => $this->input->post('upd_isShow')
        );
        $this->db->where("id_hari", $this->input->post('upd_id_hari'));
        $this->db->update('hari', $data);
        echo "OK";
    }

    public function delete_hr()
    {
        $data = array(
            "isDelete"      => 1,
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username()
        );
        $this->db->where('id_hari',$this->input->post('del_id_hari'));
        $this->db->update('hari',$data);
        echo "OK";
    }
}
