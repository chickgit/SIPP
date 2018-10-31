<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Histori extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();
    	
    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}
        $this->load->model('histori_model');

    }

    private function segment()
    {
    	return $this->uri->segment(2);
    }

	public function index()
	{
		// $this->check_pass_data_only(base_url());
		$data['user'] = $this->session->userdata();
		$data['list_histori'] = $this->histori_model->get_histori($this->segment());

		$data['role'] = $this->get_role_user();
		$data['histori_'.$this->segment()] = 'active open';
		$data['header']['title'] = 'Histori '.ucwords($this->segment());

		if ($this->segment() == 'jadwal') {
			if ($this->session->has_userdata('id_draft_histori')) {
				if ($this->session->userdata('id_draft_histori') != 'ALL') {
					$data['list_histori'] = $this->histori_model->get_histori($this->segment(), array('draft_id_jp' => $this->session->userdata('id_draft_histori')));
				}
			}
			$data['list_draft_jp'] = $this->histori_model->get_histori('draft_jadwal_perkuliahan');

			$data['header']['title'] = 'Histori Jadwal';
		}

		$data['header']['css_page_plugin'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
			';

		$data['footer']['footer_page_plugin'] = '
			';
		$data['footer']['footer_page_scripts'] = '
			';

		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',$data['footer'],TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);


		$this->load->view('histori_'.$this->segment(),$data);
		
	}

	public function get_data()
	{
		$data['get_data'] = $this->histori_model->get_data($_POST[0], $_POST[1]);
		echo json_encode($data['get_data']);
	}

	public function restore_data()
	{
		$data['restore_data'] = $this->histori_model->restore_data($_POST);
		echo $data['restore_data'];
		exit();
	}

	public function delete_data()
	{
		$data['delete_data'] = $this->histori_model->delete_data($_POST);
		echo $data['delete_data'];
		exit();
	}

	public function draft()
	{
		// $this->check_pass_data_only($this->input->post());
		$data['draft'] = $this->histori_model->draft();
		echo json_encode($data['draft']);
	}


	public function comments()
        {
                echo 'Look at this!';
        }
}
