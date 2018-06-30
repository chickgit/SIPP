<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();
    	
    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('dosen_model');
        $this->load->model('hari_model');
        $this->load->model('matakuliah_model');
    }

	public function index()
	{
		$data['list_dosen'] = $this->dosen_model->get_data();
		$data['list_hari'] = $this->hari_model->get_data();
		$data['list_matakuliah'] = $this->matakuliah_model->get_data();

		$data['role'] = $this->get_role_user();

		$data['dosen'] = 'active open';
		
		$data['header']['title'] = 'Data Dosen';
		$data['header']['css_page_plugin'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
			';

		$data['footer']['footer_page_plugin'] = '
			<script src="'.base_url().'assets/global/scripts/datatable.js" type="text/javascript"></script>
			<script src="'.base_url().'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
			<script src="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
			<script src="'.base_url().'assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
			<script src="'.base_url().'assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        	<script src="'.base_url().'assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
			';
		$data['footer']['footer_page_scripts'] = '
			<script src="'.base_url().'assets/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
        	<script src="'.base_url().'assets/pages/scripts/components-select2.js" type="text/javascript"></script>
			';

		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',$data['footer'],TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('dosen',$data);
		
	}

	public function insert_dosen()
	{
		// print_r($_GET);
		// print_r($_POST['nid']);
		// echo json_encode($_POST);
		$data['insert_dosen'] = $this->dosen_model->insert_data($_POST);
		echo $data['insert_dosen'];
		exit();
	}

	public function check_nid()
	{
		// print_r($_GET);
		$data['check_nid_dosen'] = $this->dosen_model->check_nid($_GET['nid']);
		isset($data['check_nid_dosen']) ? $a="false" : $a="true";
		echo $a;
	}

	public function get_dosen()
	{
		// print_r($_GET);
		$data['get_dosen'] = $this->dosen_model->get_dosen($_POST['nid']);
		echo json_encode($data['get_dosen']);
		// print_r($data['get_dosen']);
	}

	public function update_dosen()
	{
		$data['update_dosen'] = $this->dosen_model->update_dosen($_POST);
		echo $data['update_dosen'];
		exit();
	}

	public function delete_dosen()
	{
		$data['delete_dosen'] = $this->dosen_model->delete_dosen($_POST['del_nid']);
		echo $data['delete_dosen'];
		exit();
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
