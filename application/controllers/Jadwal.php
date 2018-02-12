<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();

    	$this->load->library('session');
    	$this->load->library('algo');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('jadwal_model');
    }
	public function index()
	{
		$data['jp'] = $this->algo->generate_jadwal();
		print_r(json_encode($data['jp']));
		exit();

		$data['list_jw'] = $this->jadwal_model->get_data();

		$data['role'] = $this->get_role_user();

		$data['jadwal'] = 'active open';

		$data['header']['title'] = 'Data Jadwal';
		$data['header']['css'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
			
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',NULL,TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('jadwal',$data);
		
	}

	public function insert_matakuliah()
	{
		// print_r($_GET);
		// print_r($_POST['nid']);
		// json_encode($_POST);
		$data['insert_matakuliah'] = $this->jadwal_model->insert_data();
		echo $data['insert_matakuliah'];
		exit();
	}

	public function check_kode_mk()
	{
		// print_r($_GET);
		$data['check_kode_mk'] = $this->jadwal_model->check_kode_mk($_GET['kode_mk']);
		isset($data['check_kode_mk']) ? $a="false" : $a="true";
		echo $a;
	}

	public function get_mk()
	{
		// print_r($_GET);
		$data['get_mk'] = $this->jadwal_model->get_mk($_POST['kode_mk']);
		echo json_encode($data['get_mk']);
		// print_r($data['get_dosen']);
	}

	public function update_mk()
	{
		$data['update_mk'] = $this->jadwal_model->update_mk();
		echo $data['update_mk'];
		exit();
	}

	public function delete_mk()
	{
		$data['delete_mk'] = $this->jadwal_model->delete_mk($_POST['del_kode_mk']);
		echo $data['delete_mk'];
		exit();
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
