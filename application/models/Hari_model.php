<?php
class Hari_model extends CI_Model {

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
        $query = $this->db->get_where('hari', array('isDelete' => 0, 'isShow' => 1));
        return $query->result();
    }

    public function check_kode_hr($kode_hr)
    {
        $query = $this->db->query('SELECT id FROM hari WHERE id = "'.$kode_hr.'"');
        return $query->row();
    }

    public function insert_data($arr = array())
    {
        $sql = ("INSERT INTO hari(id, nama_hari) VALUES (?, ?)");
        $this->db->query($sql, array($arr['id'],$arr['nama_hari']));
        echo "OK";
    }

    public function get_hr($kode_hr)
    {
        $query = $this->db->query('SELECT * FROM hari WHERE id = "'.$kode_hr.'"');
        return $query->row();
    }

    public function update_hr($arr = array())
    {
        $sql = ("UPDATE hari SET nama_hari = ?, modified_date = ?, modified_by = ? WHERE id = ?");
        $this->db->query($sql, array($arr['upd_nama_hr'],date('Y-m-d H:i:s'),$this->session_username(),$arr['upd_id_hr']));
        echo "OK";
    }

    public function delete_hr($kode_hr)
    {
        $data = array(
            'isDelete' => 1
        );
        $this->db->where('id',$kode_hr);
        $this->db->update('hari',$data);
        // $this->db->delete('dosen');
        echo "OK";
    }

}
