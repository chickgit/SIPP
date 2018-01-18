<?php
class MataKuliah_model extends CI_Model {

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

    public function insert_data($arr = array())
    {
        $sql = ("INSERT INTO matakuliah(kode_mk, nama_mk, sks_mk, semester_mk, program_studi, peminatan) VALUES (?, ?, ?, ?, ?, ?)");
        $this->db->query($sql, array($arr['kode_mk'],$arr['nama_mk'],$arr['sks_mk'],$arr['semester_mk'],$arr['program_studi'],$arr['peminatan']));
        echo "OK";
    }

    public function get_mk($kode_mk)
    {
        $query = $this->db->query('SELECT * FROM matakuliah WHERE kode_mk = "'.$kode_mk.'"');
        return $query->row();
    }

    public function update_mk($arr = array())
    {
        $sql = ("UPDATE matakuliah SET nama_mk = ?, sks_mk = ?, semester_mk = ?, program_studi = ?, peminatan = ?, modified_date = ?, modified_by = ? WHERE kode_mk = ?");
        $this->db->query($sql, array($arr['upd_nama_mk'],$arr['upd_sks_mk'],$arr['upd_semester_mk'],$arr['upd_program_studi'],$arr['upd_peminatan'],date('Y-m-d H:i:s'),$this->session_username(),$arr['upd_kode_mk']));
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
