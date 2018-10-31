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
        // $this->check_pass_data_only($this->input->post());
		$data['list_hari'] = $this->hari_model->get_all_data('hari', array(), 'result');
		$data['role'] = $this->get_role_user();

		$data['hari'] = 'active open';

		$data['header']['title'] = 'Data Hari';
		$data['header']['css_page_plugin'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

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

		$this->load->view('hari',$data);
		
	}

	public function insert_hr()
	{
        // $this->check_pass_data_only($this->input->post());
		$data['insert_hr'] = $this->hari_model->insert_data();
		echo $data['insert_hr'];
		exit();
	}

	public function get_hr()
	{
        // $this->check_pass_data_only($this->input->post());
		$data['get_hr'] = $this->hari_model->get_all_data('hari', array('id_hari' => $this->input->post('id_hari')), 'row');
		echo json_encode($data['get_hr']);
	}
	
	public function update_hr()
	{
		$data['update_hr'] = $this->hari_model->update_hr();
		echo $data['update_hr'];
		exit();
	}

	public function delete_hr()
	{
		$data['delete_hr'] = $this->hari_model->delete_hr();
		echo $data['delete_hr'];
		exit();
	}
}
