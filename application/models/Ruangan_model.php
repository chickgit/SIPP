<?php
class Ruangan_model extends CI_Model {

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
        $query = $this->db->get_where('ruangan', array('isDelete' => 0, 'isShow' => 1));
    	return $query->result();
    }

    public function check_kode_rg($kode_rg)
    {
        $query = $this->db->query('SELECT kode_rg FROM ruangan WHERE kode_rg = "'.$kode_rg.'"');
        return $query->row();
    }

    public function insert_data($arr = array())
    {
        $sql = ("INSERT INTO ruangan(kode_rg, gedung_rg, jenis_rg, kapasitas_rg) VALUES (?, ?, ?, ?)");
        $this->db->query($sql, array($arr['kode_rg'],$arr['gedung'],$arr['jenis'],$arr['kapasitas']));
        echo "OK";
    }

    public function get_rg($kode_rg)
    {
        $query = $this->db->query('SELECT * FROM ruangan WHERE kode_rg = "'.$kode_rg.'"');
        return $query->row();
    }

    public function update_rg($arr = array())
    {
        $sql = ("UPDATE ruangan SET gedung_rg = ?, jenis_rg = ?, kapasitas_rg = ?, modified_date = ?, modified_by = ? WHERE kode_rg = ?");
        $this->db->query($sql, array($arr['upd_gedung'],$arr['upd_jenis'],$arr['upd_kapasitas'],date('Y-m-d H:i:s'),$this->session_username(),$arr['upd_kode_rg']));
        echo "OK";
    }

    public function delete_rg($kode_rg)
    {
        $data = array(
            'isDelete' => 1
        );
        $this->db->where('kode_rg',$kode_rg);
        $this->db->update('ruangan',$data);
        // $this->db->delete('dosen');
        echo "OK";
    }

}
