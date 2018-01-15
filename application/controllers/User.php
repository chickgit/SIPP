<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
    	
    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}
    }
    
	public function index()
	{
		$data['session_detail'] = $this->session->userdata('Detail');
		$data['session_login'] = $this->session->userdata('Login');
		$data['my_profile'] = 'active open';
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);

		$data['css'] = '
		<link href="'.base_url().'assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
		<link href="'.base_url().'assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />';
		
		$data['title'] = 'My Profile';
		$this->load->view('header',$data);

		$this->load->view('user_profile',$data);
		$this->load->view('footer');
	}
	public function comments()
        {
                echo 'Look at this!';
        }
}
