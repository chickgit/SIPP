<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangan extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();

    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('ruangan_model');
    }
	public function index()
	{
		$data['list_ruangan'] = $this->ruangan_model->get_data();

		$data['role'] = $this->get_role_user();
		$data['ruangan'] = 'active open';

		$data['header']['title'] = 'Data Ruangan';
		$data['header']['css'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',NULL,TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('ruangan',$data);
		
	}

	public function insert_ruangan()
	{
		$data['insert_ruangan'] = $this->ruangan_model->insert_data($_POST);
		echo $data['insert_ruangan'];
		exit();
	}

	public function check_kode_rg()
	{
		// print_r($_GET);
		$data['check_kode_rg'] = $this->ruangan_model->check_kode_rg($_GET['kode_rg']);
		isset($data['check_kode_rg']) ? $a="false" : $a="true";
		echo $a;
	}

	public function get_rg()
	{
		// print_r($_GET);
		$data['get_rg'] = $this->ruangan_model->get_rg($_POST['kode_rg']);
		echo json_encode($data['get_rg']);
		// print_r($data['get_dosen']);
	}

	public function update_rg()
	{
		$data['update_rg'] = $this->ruangan_model->update_rg($_POST);
		echo $data['update_rg'];
		exit();
	}

	public function delete_rg()
	{
		$data['delete_rg'] = $this->ruangan_model->delete_rg($_POST['del_kode_rg']);
		echo $data['delete_rg'];
		exit();
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
