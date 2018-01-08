<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MataKuliah extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
        $this->load->model('matakuliah_model');
    }
	public function index()
	{
		$data['list_dosen'] = $this->matakuliah_model->get_data();

		$data['mk'] = 'active open';
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',NULL,TRUE);
		$data['header'] = $this->load->view('header',NULL,TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('matakuliah',$data);
		
	}
	public function comments()
        {
                echo 'Look at this!';
        }
}
