<?php
class Waktu_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Your own constructor code
    }

    public function get_data()
    {
    	$query = $this->db->query('SELECT * FROM waktu');
    	return $query->result();
    }

}
