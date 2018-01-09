<?php
class Histori_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Your own constructor code
    }

    public function get_histori($table)
    {
    	// $query = $this->db->query('SELECT * FROM dosen');
        $query = $this->db->get_where($table, array('isDelete' => 1, 'isShow' => 1));
    	return $query->result();
    }

    public function restore_data($table, $nid)
    {
        $data = array(
            'isDelete' => 0
        );
        $this->db->where('nid', $nid);
        $this->db->update($table, $data);
        // $this->db->delete('dosen');
        echo "OK";
    }

    public function get_data($a, $nid)
    {
        $query = $this->db->query('SELECT * FROM '.$a.' WHERE nid = '.$nid);
        return $query->row();
    }

    public function check_nid($nid)
    {
        $query = $this->db->query('SELECT nid FROM dosen WHERE nid = '.$nid);
        return $query->row();
    }

    public function insert_data($arr = array())
    {
        $sql = ("INSERT INTO dosen(nid, nama, alamat, telepon) VALUES (?, ?, ?, ?)");
        $this->db->query($sql, array($arr['nid'],$arr['nama'],$arr['alamat'],$arr['telepon']));
        echo "OK";
    }

    

    public function update_dosen($arr = array())
    {
        $sql = ("UPDATE dosen SET nama = ?, alamat = ?, telepon = ? WHERE nid = ?");
        $this->db->query($sql, array($arr['upd_nama'],$arr['upd_alamat'],$arr['upd_telepon'],$arr['upd_nid']));
        echo "OK";
    }

    public function delete_dosen($nid)
    {
        $data = array(
            'isDelete' => 1
        );
        $this->db->where('nid',$nid);
        $this->db->update('dosen',$data);
        // $this->db->delete('dosen');
        echo "OK";
    }

}
