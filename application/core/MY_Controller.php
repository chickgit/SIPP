<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
    	
    	ini_set('max_execution_time', 0); 
		ini_set('memory_limit','2048M');
    	
    }
    
	public function get_role_user()
	{
		$cek_role = array(
			0 => "Kaprodi",
			1 => "Dosen",
			2 => "Mahasiswa"
		);
		$sess_role = $this->session->userdata('Login')['sebagai'];
		if (array_key_exists($sess_role, $cek_role)) {
			$role = $cek_role[$sess_role];
		}
		return $role;
	}

	public function user_all_detail()
	{
		return $this->session->userdata();
	}

	public function giving_access($as)
	{
		if ($this->session->has_userdata('Login')) {
			if ($this->session->userdata('Login')['sebagai'] != $as) {
				echo "alert('Anda tidak memiliki hak akses')";
			}
			
		}
	}

	public function check_data($data = array(), $as = 'json')
	{
		switch ($as) {
			case 'json':
				echo json_encode($data);
				break;

			case 'print_r':
				print_r($data);
				break;
			
			case 'var_dump':
				var_dump($data);
				break;

			default:
				# code...
				break;
		}
	}
}
