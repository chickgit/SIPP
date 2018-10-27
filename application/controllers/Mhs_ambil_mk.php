<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mhs_ambil_mk extends MY_Controller {

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
		$data['nim'] 				= $this->session->userdata('Detail')['nim'];
		$data['tahun_ajaran'] 		= $this->session->userdata('TA')['tahun_ajaran'];
		$data['semester'] 			= $this->session->userdata('TA')['semester'];
		$data['list_mk']	 		= $this->mahasiswa_model->get_data();

		$data['role'] 				= $this->get_role_user();

		$data['amk'] 				= 'active open';

		$data['header']['title'] 	= 'Ambil Mata Kuliah';
		$data['header']['css_page_plugin'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
			';
		$data['footer']['footer_page_plugin'] = '
			<script src="'.base_url().'assets/global/scripts/datatable.js" type="text/javascript"></script>
			<script src="'.base_url().'assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
			<script src="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
			<script src="'.base_url().'assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
			<script src="'.base_url().'assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
			';
		$data['footer']['footer_page_scripts'] = '
			<script src="'.base_url().'assets/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
			';
			
		$data['menu'] 				= $this->load->view('sidebar',$data,TRUE);
		$data['footer'] 			= $this->load->view('footer',$data['footer'],TRUE);
		$data['header'] 			= $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->
		// json_encode(print_r($data['list_mk']));
		// exit();

		$this->load->view('mhs_ambil_mk',$data);
		
	}

	public function insert()
	{
		// $this->check_pass_data_only($this->input->post('kd_mk'));
		// CHECK DATA IF EXIST
		$where = array(
			'nim'			=> $this->input->post('nim'),
			'tahun_ajaran'	=> $this->input->post('tahun_ajaran'),
			'smstr'			=> $this->input->post('semester')
		);
		$check_mhs = $this->mahasiswa_model->get_all_data('ambil_matakuliah', $where, 'row');
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

}
