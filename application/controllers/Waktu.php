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
        // $this->check_pass_data_only($this->input->post());
		$data['list_waktu'] = $this->waktu_model->get_all_data('waktu', array(), 'result');
		// $data['list_waktu'] = $this->waktu_model->get_data();
		$data['role'] = $this->get_role_user();

		$data['waktu'] = 'active open';

		$data['header']['title'] = 'Data Waktu';
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
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',$data['footer'],TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('waktu',$data);
		
	}

	public function insert_wk()
	{
        // $this->check_pass_data_only($this->input->post());
		$data['insert_wk'] = $this->waktu_model->insert_data();
		echo $data['insert_wk'];
		exit();
	}

	public function get_wk()
	{
        // $this->check_pass_data_only($this->input->post());
		$data['get_wk'] = $this->waktu_model->get_all_data('waktu', array('id_waktu' => $this->input->post('id_waktu')), 'row');
		echo json_encode($data['get_wk']);
	}

	public function update_wk()
	{
        // $this->check_pass_data_only($this->input->post());
		$data['update_wk'] = $this->waktu_model->update_wk();
		echo $data['update_wk'];
		exit();
	}

	public function delete_wk()
	{
        // $this->check_pass_data_only($this->input->post());
		$data['delete_wk'] = $this->waktu_model->delete_wk();
		echo $data['delete_wk'];
		exit();
	}
}
