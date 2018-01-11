<?php
class MataKuliah_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Your own constructor code
    }

    public function get_data()
    {
    	$query = $this->db->query('SELECT * FROM matakuliah');
    	return $query->result();
    }

    public function check_kode_mk($kode_mk)
    {
        $query = $this->db->query('SELECT kode_mk FROM matakuliah WHERE kode_mk = '.$kode_mk);
        return $query->row();
    }

    public function insert_data($arr = array())
    {
        $sql = ("INSERT INTO matakuliah(kode_mk, nama_mk, sks_mk, semester_mk) VALUES (?, ?, ?, ?)");
        $this->db->query($sql, array($arr['kode_mk'],$arr['nama_mk'],$arr['sks_mk'],$arr['semester_mk']));
        echo "OK";
    }

    public function get_dosen($nid)
    {
        $query = $this->db->query('SELECT * FROM dosen WHERE nid = '.$nid);
        return $query->row();
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
