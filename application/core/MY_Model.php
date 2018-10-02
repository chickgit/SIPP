<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public function __construct()
    {
    	parent::__construct();
    	
        $this->load->database();
    }

    public function get_all_data($table, $array = array(), $result = 'result_array')
    {
        $this->db->where('isDelete', 0);
        $this->db->where('isShow', 1);
        if (!empty($array)) {
            $this->db->where($array);
        }
        $query  = $this->db->get($table);

        switch ($result) {
            case 'result':
                $data = $query->result();
                break;

            case 'result_array':
                $data = $query->result_array();
                break;
            
            case 'row':
                $data = $query->row();
                break;

            case 'row_array':
                $data = $query->row_array();
                break;

            case 'num_rows':
                $data = $query->num_rows();
                break;

            default:
                $data = $query->result();
                break;
        }
        
        return $data;
    }
    
}
