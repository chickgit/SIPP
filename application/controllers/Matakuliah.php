<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matakuliah extends MY_Controller {

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
        // $this->check_pass_data_only($this->session->userdata());
		$data['list_mk'] = $this->matakuliah_model->get_all_matakuliah();

		$data['role'] = $this->get_role_user();

		$data['mk'] = 'active open';

		$data['header']['title'] = 'Data Mata Kuliah';
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

		$data['prodi'] = $this->matakuliah_model->get_all_data('program_studi',array(),'result');
		$data['drop']['prodi']['opt'][0] = 'Pilih Program Studi';
		foreach ($data['prodi'] as $key => $value) {
			# code...
			$data['drop']['prodi']['opt'][$value->id_prodi] = $value->nama_prodi.' ['.$value->panggilan.']';
		}

		$data['peminatan'] = $this->matakuliah_model->get_all_data('peminatan',array(),'result');
		$data['drop']['peminatan']['opt'][0] = 'Pilih Peminatan';
		foreach ($data['peminatan'] as $key => $value) {
			# code...
			$data['drop']['peminatan']['opt'][$value->id_peminatan] = $value->nama_peminatan.' ['.$value->panggilan.']';
		}

		$data['jenis_ruangan'] = $this->matakuliah_model->get_all_data('jenis_ruangan',array(),'result');
		$data['drop']['jenis_ruangan']['opt'][0] = 'Pilih Jenis Ruangan';
		foreach ($data['jenis_ruangan'] as $key => $value) {
			# code...
			$data['drop']['jenis_ruangan']['opt'][$value->id_jenis] = $value->nama.' ['.$value->jenis.']';
		}
			
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',$data['footer'],TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('matakuliah',$data);
		
	}

	public function check_kode_mk()
	{
		// print_r($_GET);
		$data['check_kode_mk'] = $this->matakuliah_model->check_kode_mk($_GET['kode_mk']);
		isset($data['check_kode_mk']) ? $a="false" : $a="true";
		echo $a;
	}

	public function insert_matakuliah()
	{
        // $this->check_pass_data_only($this->input->post());
		$data['insert_matakuliah'] = $this->matakuliah_model->insert_data();
		echo $data['insert_matakuliah'];
		exit();
	}

	public function get_mk()
	{
        // $this->check_pass_data_only($this->input->post());
		$data['get_mk'] = $this->matakuliah_model->get_mk();
		echo json_encode($data['get_mk']);
		// print_r($data['get_dosen']);
	}

	public function update_mk()
	{
		$data['update_mk'] = $this->matakuliah_model->update_mk();
		echo $data['update_mk'];
		exit();
	}

	public function delete_mk()
	{
		$data['delete_mk'] = $this->matakuliah_model->delete_mk($_POST['del_kode_mk']);
		echo $data['delete_mk'];
		exit();
	}
}
