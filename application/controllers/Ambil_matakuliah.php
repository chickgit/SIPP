<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ambil_matakuliah extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();

    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('mahasiswa_model');
    }

	public function index()
	{
		// print_r($this->session->userdata());
		// exit();
		$data['list_open_mk'] 		= $this->mahasiswa_model->get_list_open_mk();
		$data['tahun_ajaran'] 		= $this->mahasiswa_model->get_tahun_ajaran();
		$data['nim'] 				= $this->session->userdata('Detail')['nim'];
		$data['list_mk']	 		= $this->mahasiswa_model->get_data();

		$data['role'] 				= $this->get_role_user();

		$data['amk'] 				= 'active open';

		$data['header']['title'] 	= 'Ambil Mata Kuliah';
		$data['header']['css'] 		= '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
			
		$data['menu'] 				= $this->load->view('sidebar',$data,TRUE);
		$data['footer'] 			= $this->load->view('footer',NULL,TRUE);
		$data['header'] 			= $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->
		// json_encode(print_r($data['list_mk']));
		// exit();

		$this->load->view('ambil_matakuliah',$data);
		
	}

	public function insert()
	{
		// CHECK DATA IF EXIST
		$check_mhs = $this->mahasiswa_model->check_mk();
		if ($check_mhs) 
		{
			//UPDATE IF EXIST
			$data['update'] = $this->mahasiswa_model->update();
			echo $data['update'];
			exit();
		}
		else
		{
			//INSERT IF NOT EXIST
			$data['insert'] = $this->mahasiswa_model->insert();
			echo $data['insert'];
			exit();
		}
	}

	public function check_kode_mk()
	{
		// print_r($_GET);
		$data['check_kode_mk'] = $this->matakuliah_model->check_kode_mk($_GET['kode_mk']);
		isset($data['check_kode_mk']) ? $a="false" : $a="true";
		echo $a;
	}

	public function get_mk()
	{
		// print_r($_GET);
		$data['get_mk'] = $this->matakuliah_model->get_mk($_POST['kode_mk']);
		echo json_encode($data['get_mk']);
		// print_r($data['get_dosen']);
	}

	public function update_mk()
	{
		$data['update_mk'] = $this->matakuliah_model->update_mk($_POST);
		echo $data['update_mk'];
		exit();
	}

	public function delete_mk()
	{
		$data['delete_mk'] = $this->matakuliah_model->delete_mk($_POST['del_kode_mk']);
		echo $data['delete_mk'];
		exit();
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
