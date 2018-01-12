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

    public function insert_data($arr = array())
    {
        $sql = ("INSERT INTO waktu(kode_wk, waktu_aw, waktu_ak) VALUES (?, ?, ?)");
        $this->db->query($sql, array($arr['kode_wk'],$arr['awal_wk'],$arr['akhir_wk']));
        echo "OK";
    }

    public function get_wk($kode_wk)
    {
        $query = $this->db->query('SELECT * FROM waktu WHERE kode_wk = "'.$kode_wk.'"');
        return $query->row();
    }

    public function update_wk($arr = array())
    {
        $sql = ("UPDATE waktu SET waktu_aw = ?, waktu_ak = ?, modified_date = ?, modified_by = ? WHERE kode_wk = ?");
        $this->db->query($sql, array($arr['upd_awal_wk'],$arr['upd_akhir_wk'],date('Y-m-d H:i:s'),$this->session_username(),$arr['upd_kode_wk']));
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
