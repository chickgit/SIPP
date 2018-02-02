<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();
    	
    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('user_model');
    }
    
	public function index()
	{
		// print_r($this->session->userdata());
		// exit();
		$data['session_detail'] = $this->session->userdata('Detail');
		$data['session_login'] = $this->session->userdata('Login');
		$data['role'] = $this->get_role_user();
		$data['my_profile'] = 'active open';

		$data['header']['title'] = 'My Profile';
		$data['header']['css'] = '
		<link href="'.base_url().'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
		<link href="'.base_url().'assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />';
		
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',NULL,TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);

		$this->load->view('user_profile',$data);
	}

	public function update_personal()
	{
		$data['update_personal'] = $this->user_model->update_personal($_POST);
		echo $data['update_personal'];
		exit();
	}

	public function update_password()
	{
		$pass_old = $this->session->userdata('Login')['password'];

		if ($_POST['upd_old_password'] == '123456') {
			$data['update_password'] = $this->user_model->update_password($_POST);
			echo $data['update_password'];
			exit();
		}else{
			if (password_verify($_POST['upd_old_password'],$pass_old)) {
				$data['update_password'] = $this->user_model->update_password($_POST);
				echo $data['update_password'];
				exit();
			}
			echo "Password Salah";
			exit();
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
