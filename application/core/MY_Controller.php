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

	public function giving_access($as)
	{
		if ($this->session->has_userdata('Login')) {
			if ($this->session->userdata('Login')['sebagai'] != $as) {
				echo "alert('Anda tidak memiliki hak akses')";
			}
			// switch () {
			// 	case 0:
			// 		# code...
			// 		break;
				
			// 	case 1:
			// 		# code...
			// 		break;

			// 	case 2:
			// 		# code...
			// 		break;
			// 	default:
			// 		# code...
			// 		break;
			// }
			// if ( == 0) {
			// 	# code...
			// }
			
		}
	}
}
