<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Histori extends CI_Controller {

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
		$data['list_dosen'] = $this->histori_model->get_histori($this->segment());

		$data['dosen'] = 'active open';
		$data['header']['title'] = 'Histori '.ucwords($this->segment());
		$data['header']['css'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',NULL,TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);


		$this->load->view('histori_'.$this->segment(),$data);
		
	}

	public function get_data()
	{
		$data['get_data'] = $this->histori_model->get_data($_POST['table'], $_POST['nid']);
		echo json_encode($data['get_data']);
	}

	public function restore_data()
	{
		$data['restore_data'] = $this->histori_model->restore_data($_POST['restore_table'], $_POST['restore_nid']);
		echo $data['restore_data'];
		exit();
	}

	public function delete_histori_dosen()
	{
		$data['delete_histori_dosen'] = $this->histori_model->delete_histori_dosen($_POST['del_nid']);
		echo $data['delete_histori_dosen'];
		exit();
	}


	public function comments()
        {
                echo 'Look at this!';
        }
}
