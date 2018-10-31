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
		$data['list_ruangan'] = $this->ruangan_model->get_all_ruangan();

		$data['role'] = $this->get_role_user();
		$data['ruangan'] = 'active open';

		$data['header']['title'] = 'Data Ruangan';

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

		$data['jenis_ruangan'] = $this->ruangan_model->get_all_data('jenis_ruangan',array(),'result');
		$data['drop']['jenis_ruangan']['opt'][0] = 'Pilih Jenis Ruangan';
		foreach ($data['jenis_ruangan'] as $key => $value) {
			# code...
			$data['drop']['jenis_ruangan']['opt'][$value->id_jenis] = $value->nama.' ['.$value->jenis.']';
		}

		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',$data['footer'],TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('ruangan',$data);
		
	}

	public function insert_ruangan()
	{
        // $this->check_pass_data_only($this->input->post());
		$data['insert_ruangan'] = $this->ruangan_model->insert_data();
		echo $data['insert_ruangan'];
		exit();
	}

	public function get_rg()
	{
        // $this->check_pass_data_only($this->input->post());
		$data['get_rg'] = $this->ruangan_model->get_rg();
		echo json_encode($data['get_rg']);
		// print_r($data['get_dosen']);
	}

	public function update_rg()
	{
        // $this->check_pass_data_only($this->input->post());
		$data['update_rg'] = $this->ruangan_model->update_rg();
		echo $data['update_rg'];
		exit();
	}

	public function delete_rg()
	{
        // $this->check_pass_data_only($this->input->post());
		$data['delete_rg'] = $this->ruangan_model->delete_rg();
		echo $data['delete_rg'];
		exit();
	}
}
