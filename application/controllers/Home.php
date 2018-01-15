<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		// $arr = array('Login', 'Detail');
		// $this->session->unset_userdata($arr);
		// print_r($this->session->userdata());
		// exit();
		$data['session'] = $this->session->userdata('Detail');
		$data['dashboard'] = 'active open';
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		
		$data['title'] = 'Dashboard';
		$this->load->view('header',$data);

		$this->load->view('home',$data);
		$this->load->view('footer');
	}
	public function comments()
        {
                echo 'Look at this!';
        }
}
