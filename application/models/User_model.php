<?php
class User_model extends CI_Model {

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
    
    public function update_personal($arr = array())
    {
        $data = array(
            "nama"              => $arr['upd_nama'],
            "alamat"            => $arr['upd_alamat'],
            "telepon"           => $arr['upd_telepon'],
            "modified_date"     => date('Y-m-d H:i:s'),
            "modified_by"       => $this->session_username()
        );
        $this->db->where($arr['id'], $arr['upd_id']);
        $this->db->update($arr['table'], $data);
        echo "OK";
    }

    public function update_password($arr = array())
    {
    	$new_pass = password_hash($arr['upd_new_password'],PASSWORD_BCRYPT);
        $data = array(
            "password"          => $new_pass,
            "modified_date"     => date('Y-m-d H:i:s'),
            "modified_by"       => $this->session_username()
        );
        $this->db->where('id', $this->input->post('upd_id'));
        $this->db->update('user', $data);
        echo "OK";
    }

}
?>