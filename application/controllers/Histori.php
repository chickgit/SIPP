<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Histori extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();
    	
    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}
        $this->load->model('histori_model');

    }

    private function segment()
    {
    	return $this->uri->segment(2);
    }
    
	public function index()
	{
		$data['list_histori'] = $this->histori_model->get_histori($this->segment());

		$data['role'] = $this->get_role_user();
		$data['histori_'.$this->segment()] = 'active open';
		$data['header']['title'] = 'Histori '.ucwords($this->segment());
		$data['header']['css_page_plugin'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

		$data['footer']['footer_page_plugin'] = '
			';
		$data['footer']['footer_page_scripts'] = '
			';

		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',$data['footer'],TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);


		$this->load->view('histori_'.$this->segment(),$data);
		
	}

	public function get_data()
	{
		$data['get_data'] = $this->histori_model->get_data($_POST[0], $_POST[1]);
		echo json_encode($data['get_data']);
	}

	public function restore_data()
	{
		$data['restore_data'] = $this->histori_model->restore_data($_POST);
		echo $data['restore_data'];
		exit();
	}

	public function delete_data()
	{
		$data['delete_data'] = $this->histori_model->delete_data($_POST);
		echo $data['delete_data'];
		exit();
	}


	public function comments()
        {
                echo 'Look at this!';
        }
}
