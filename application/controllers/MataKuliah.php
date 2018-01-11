<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MataKuliah extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();

    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('matakuliah_model');
    }
	public function index()
	{
		$data['list_mk'] = $this->matakuliah_model->get_data();

		$data['mk'] = 'active open';

		$data['header']['title'] = 'Data Mata Kuliah';
		$data['header']['css'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',NULL,TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('matakuliah',$data);
		
	}

	public function insert_matakuliah()
	{
		// print_r($_GET);
		// print_r($_POST['nid']);
		// json_encode($_POST);
		$data['insert_matakuliah'] = $this->matakuliah_model->insert_data($_POST);
		echo $data['insert_matakuliah'];
		exit();
	}

	public function check_kode_mk()
	{
		// print_r($_GET);
		$data['check_kode_mk'] = $this->matakuliah_model->check_kode_mk($_GET['nid']);
		isset($data['check_kode_mk']) ? $a="false" : $a="true";
		echo $a;
	}

	public function get_dosen()
	{
		// print_r($_GET);
		$data['get_dosen'] = $this->matakuliah_model->get_dosen($_POST['nid']);
		echo json_encode($data['get_dosen']);
		// print_r($data['get_dosen']);
	}

	public function update_dosen()
	{
		$data['update_dosen'] = $this->matakuliah_model->update_dosen($_POST);
		echo $data['update_dosen'];
		exit();
	}

	public function delete_dosen()
	{
		$data['delete_dosen'] = $this->matakuliah_model->delete_dosen($_POST['del_nid']);
		echo $data['delete_dosen'];
		exit();
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
