<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();

    	$this->load->library('session');
    	if($this->session->has_userdata('Login')){
			redirect(base_url().'home');
    	}

        $this->load->model('login_model');
    }
	public function index()
	{

		$this->load->view('login');
		
	}

	public function login()
	{
		$data['login_res'] = $this->login_model->login($_POST);

		// print_r($data['login_res']);
		// exit();
		if ($data['login_res']['error']) 
		{
			$this->session->set_flashdata('error', $data['login_res']['error']);
			redirect(base_url().'login');
		}
		else
		{
			$this->session->set_userdata(array('Login' => $data['login_res']['login']));
			redirect(base_url().'home');
		}
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
