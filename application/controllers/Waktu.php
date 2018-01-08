<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waktu extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
        $this->load->model('waktu_model');
    }
	public function index()
	{
		$data['list_dosen'] = $this->waktu_model->get_data();

		$data['waktu'] = 'active open';
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',NULL,TRUE);
		$data['header'] = $this->load->view('header',NULL,TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('waktu',$data);
		
	}
	public function comments()
        {
                echo 'Look at this!';
        }
}
