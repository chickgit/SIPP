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
		// $data['jp'] = $this->algo->generate_jadwal('2017/2018','GANJIL');
		// print_r(json_encode($data['jp']));
		// exit();
		$data['user'] = $this->session->userdata();

		$data['list_jw'] = $this->jadwal_model->get_data_temp();
		$data['all_data'] = array(
			"hari" 			=> $this->jadwal_model->get_data('hari'),
			"matakuliah" 	=> $this->jadwal_model->get_data('matakuliah'),
			"waktu" 		=> $this->jadwal_model->get_data('waktu'),
			"dosen" 		=> $this->jadwal_model->get_data('dosen'),
			"ruangan" 		=> $this->jadwal_model->get_data('ruangan')
		);

		$data['role'] = $this->get_role_user();

		$data['jadwal'] = 'active open';

		$data['header']['title'] = 'Data Jadwal';
		$data['header']['css_page_plugin'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />';

		$data['footer']['footer_page_plugin'] = '
			<script src="'.base_url().'assets/global/scripts/datatable.js" type="text/javascript"></script>
			<script src="'.base_url().'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
			<script src="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
			<script src="'.base_url().'assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
			<script src="'.base_url().'assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        	<script src="'.base_url().'assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        	<script src="'.base_url().'assets/global/plugins/bootstrap-sweetalert/sweetalert.min.js" type="text/javascript"></script>
			';
		$data['footer']['footer_page_scripts'] = '
			<script src="'.base_url().'assets/pages/scripts/table-datatables-jadwal.js" type="text/javascript"></script>
        	<script src="'.base_url().'assets/pages/scripts/components-select2.js" type="text/javascript"></script>
        	<script src="'.base_url().'assets/pages/scripts/ui-sweetalert.js" type="text/javascript"></script>
			';
			// <script src="'.base_url().'assets/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
			
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',$data['footer'],TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('jadwal',$data);
		
	}

	public function generate()
	{
		$data['jp'] = $this->jadwal_model->generate_jadwal();
		echo json_encode($data['jp']);
		// echo json_encode($this->input->post('data'));
	}

	public function hapus()
	{
		$data['hapus_jp'] = $this->jadwal_model->hapus_jadwal();
		echo $data['hapus_jp'];
		exit();
	}

	public function get_detail_jw()
	{
		$data['get_detail_jw'] = $this->jadwal_model->get_detail_jw($_POST['kode_jw']);
		echo json_encode($data['get_detail_jw']);
		// print_r($data['get_dosen']);
	}

	public function update_jw()
	{
		print_r(json_encode($_POST));
		exit();
		$data['update_jw'] = $this->jadwal_model->update_jw();
		echo $data['update_jw'];
		exit();
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
