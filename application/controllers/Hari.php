<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hari extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();

    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('hari_model');
    }
	public function index()
	{
		$data['list_hari'] = $this->hari_model->get_data();
		$data['role'] = $this->get_role_user();

		$data['hari'] = 'active open';

		$data['header']['title'] = 'Data Hari';
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

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('hari',$data);
		
	}

	public function insert_hr()
	{
		$data['insert_hr'] = $this->hari_model->insert_data($_POST);
		echo $data['insert_hr'];
		exit();
	}

	public function check_kode_hr()
	{
		// print_r($_GET);
		$data['check_kode_hr'] = $this->hari_model->check_kode_hr($_GET['id']);
		isset($data['check_kode_hr']) ? $a="false" : $a="true";
		echo $a;
	}

	public function get_hr()
	{
		// print_r($_GET);
		$data['get_hr'] = $this->hari_model->get_hr($_POST['id']);
		echo json_encode($data['get_hr']);
		// print_r($data['get_dosen']);
	}

	public function get_all_data()
	{
		$data['list_hari'] = $this->hari_model->get_data();
		echo json_encode($data['list_hari']);
	}

	public function update_hr()
	{
		$data['update_hr'] = $this->hari_model->update_hr($_POST);
		echo $data['update_hr'];
		exit();
	}

	public function delete_hr()
	{
		$data['delete_hr'] = $this->hari_model->delete_hr($_POST['del_id_hari']);
		echo $data['delete_hr'];
		exit();
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
