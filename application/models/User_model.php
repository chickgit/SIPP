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
    	$sql = ("UPDATE dosen SET nama = ?, alamat = ?, telepon = ?, modified_date = ?, modified_by = ? WHERE nid = ?");
        $this->db->query($sql, array($arr['upd_nama'],$arr['upd_alamat'],$arr['upd_telepon'],date('Y-m-d H:i:s'),$this->session_username(),$arr['upd_nid']));
        echo "OK";
    }

    public function update_password($arr = array())
    {
    	$new_pass = password_hash($arr['upd_new_password'],PASSWORD_BCRYPT);
    	$sql = ("UPDATE user SET password = ? WHERE id = ?");
        $this->db->query($sql, array($new_pass,$arr['upd_id']));
        echo "OK";
    }

}
?>