<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Waktu extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();

    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('waktu_model');
    }
	public function index()
	{
		$data['list_waktu'] = $this->waktu_model->get_data();
		$data['role'] = $this->get_role_user();

		$data['waktu'] = 'active open';

		$data['header']['title'] = 'Data Waktu';
		$data['header']['css'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',NULL,TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('waktu',$data);
		
	}

	public function insert_wk()
	{
		$data['insert_wk'] = $this->waktu_model->insert_data();
		echo $data['insert_wk'];
		exit();
	}

	public function check_kode_wk()
	{
		// print_r($_GET);
		$data['check_kode_wk'] = $this->waktu_model->check_kode_wk($_GET['kode_wk']);
		isset($data['check_kode_wk']) ? $a="false" : $a="true";
		echo $a;
	}

	public function get_wk()
	{
		// print_r($_GET);
		$data['get_wk'] = $this->waktu_model->get_wk($_POST['kode_wk']);
		echo json_encode($data['get_wk']);
		// print_r($data['get_dosen']);
	}

	public function update_wk()
	{
		$data['update_wk'] = $this->waktu_model->update_wk();
		echo $data['update_wk'];
		exit();
	}

	public function delete_wk()
	{
		$data['delete_wk'] = $this->waktu_model->delete_wk($_POST['del_kode_wk']);
		echo $data['delete_wk'];
		exit();
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
