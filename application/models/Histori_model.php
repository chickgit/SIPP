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

    public function restore_data($arr)
    {
        $data = array(
            'isDelete' => 0
        );
        $arr2 = array(
            $arr['restore_1'] => $arr['restore_0']
        );
        $this->db->update($arr['restore_2'], $data, $arr2);
        // $this->db->delete('dosen');
        echo "OK";
    }

    public function delete_data($arr)
    {
        $arr2 = array(
            $arr['delete_1'] => $arr['delete_0']
        );
        $this->db->delete($arr['delete_2'],$arr2);
        // $this->db->delete('dosen');
        echo "OK";
    }

    public function get_data($table, $arr)
    {
        $query = $this->db->get_where($table,$arr);
        return $query->row();
    }
}
