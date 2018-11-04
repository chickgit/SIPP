<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mhs_jp extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();

    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('jadwal_model');
        $this->load->model('mahasiswa_model');
    }
	public function index()
	{
		// print_r(json_encode($data['jp']));
		// exit();
		$data['user'] = $this->session->userdata();
		$data['tahun_ajaran'] 		= $this->session->userdata('TA')->tahun_ajaran;
		$data['semester'] 			= $this->session->userdata('TA')->semester;

		$data['opt_jp'] = $this->mahasiswa_model->draft();
		
		// $this->check_pass_data_only($this->session->userdata(),'var_dump');
		# Jika tahun ajaran mata kuliah di pilih, maka akan menampilkan jadwal perkuliahan
		# sesuai dengan tahun ajaran yang dipilih.
		if ($this->input->post('tahun_ajar') && $this->input->post('tahun_ajar') != 0) {
			$data['matkul_diambil'] = $this->matkul_diambil_mahasiswa();

			# list selruh matkul dari draft yang di pilih
			$data['list_jp'] = $this->mahasiswa_model->get_all_jadwal_perkuliahan(array(
				'draft_jadwal_perkuliahan.draft_id_jp' => $this->input->post('tahun_ajar'),
				));

			# kirim data tahun ajaran yang di pilih
			$data['flash_id_jp'] = $this->input->post('tahun_ajar');
		}
		// $this->check_pass_data_only($data['matkul_diambil'],'var_dump');

		$data['all_data'] = array(
			"hari" 			=> $this->jadwal_model->get_all_data('hari'),
			"matakuliah" 	=> $this->jadwal_model->get_all_data('matakuliah'),
			"waktu" 		=> $this->jadwal_model->get_all_data('waktu'),
			"dosen" 		=> $this->jadwal_model->get_all_data('dosen'),
			"ruangan" 		=> $this->jadwal_model->get_all_data('ruangan')
		);

		$data['role'] = $this->get_role_user();

		$data['mhs_jp'] = 'active open';

		$data['header']['title'] = 'Data Jadwal';
		$data['header']['css_page_plugin'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/bootstrap-sweetalert/sweetalert.css" rel="stylesheet" type="text/css" />
			';
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

		$this->load->view('mhs_jp',$data);
		
	}

	public function matkul_diambil_mahasiswa()
	{
		# mengambil matakuliah yang diambil oleh mahasiswa
		$options = array(
			'table'     => 'ambil_matakuliah',
			'where'     => array(
				'nim'  => $this->session->userdata('Detail')['nim'],
				'id_ta'    => $this->session->userdata('TA')->id_ta,
				'id_smstr'    => $this->session->userdata('TA')->id_smstr,
			),
			'single'    => true
		);
		$data  = $this->mahasiswa_model->commonGet($options);
		
		# data matakuliah yang diambil dirubah ke dalam array.
		$new = explode(';', $data->kode_mk);
		$data->kode_mk = $new;
		return $data;
	}

	public function buka()
	{
		if ($this->input->post('tahun_ajar') != 0) {

			$data_terbuka = $this->mahasiswa_model->get_all_data('draft_jadwal_perkuliahan', array(
				'draft_id_jp' => $this->input->post('tahun_ajar')
				), 'row');
		}
		$this->check_pass_data_only($data_terbuka);
	}

	public function generate()
	{
		// $this->check_pass_data_only($this->input->post());
		$data['jp'] = $this->jadwal_model->generate_jadwal();
		echo json_encode($data['jp']);
		// echo json_encode($this->input->post('data'));
	}

	public function draft()
	{
		// $this->check_pass_data_only($this->input->post());
		$data['draft'] = $this->jadwal_model->draft();
		echo json_encode($data['draft']);
	}

	public function get_detail_jw()
	{
		// $this->check_pass_data_only($this->input->post());
		$data['get_detail_jw'] = $this->jadwal_model->get_detail_jw($_POST['kode_jw']);
		echo json_encode($data['get_detail_jw']);
		// print_r($data['get_dosen']);
	}

	public function update_jw()
	{
		// $this->check_pass_data_only($this->input->post());
		$data['update_jw'] = $this->jadwal_model->update_jw();
		echo $data['update_jw'];
		exit();
	}

	public function delete_jw()
	{
		$data['delete_jw'] = $this->jadwal_model->delete_jw($this->input->post('del_kode_jw'));
		echo $data['delete_jw'];
		exit();
	}

}
