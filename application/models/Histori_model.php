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

    public function delete_data($table, $nid)
    {
        $this->db->where('nid', $nid);
        $this->db->delete($table);
        // $this->db->delete('dosen');
        echo "OK";
    }

    public function get_data($a, $nid)
    {
        $query = $this->db->query('SELECT * FROM '.$a.' WHERE nid = '.$nid);
        return $query->row();
    }
}
