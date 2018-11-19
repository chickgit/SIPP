<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen_jp extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();

    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}
    	$this->load->library('Pdf');

        $this->load->model('jadwal_model');
        $this->load->model('dosen_model');
        // $this->load->model('mahasiswa_model');
    }
	public function index()
	{
		$data['user'] 				= $this->session->userdata();
		$data['tahun_ajaran'] 		= $this->session->userdata('TA')->tahun_ajaran;
		$data['semester'] 			= $this->session->userdata('TA')->semester;
		$data['role'] 				= $this->get_role_user();

		$data['opt_jp'] 			= $this->dosen_model->draft();
		
		// $this->check_pass_data_only($this->session->userdata());

		# Jika tahun ajaran mata kuliah di pilih, maka akan menampilkan jadwal perkuliahan
		# sesuai dengan tahun ajaran yang dipilih.
		if ($this->input->post('tahun_ajar') && $this->input->post('tahun_ajar') != 0) {
			$data['wawasan'] = $this->wawasan_dosen();

			# list selruh matkul dari draft yang di pilih
			$data['list_jp'] = $this->dosen_model->get_all_jadwal_perkuliahan(array(
				'draft_jadwal_perkuliahan.draft_id_jp' => $this->input->post('tahun_ajar')
				));

			# kirim data tahun ajaran yang di pilih
			$data['flash_id_jp'] = $this->input->post('tahun_ajar');
		}

		if ($this->input->post('pdf') && $this->input->post('tahun_ajar')) {
			// $this->check_pass_data_only($this->input->post());
			return $this->eksportToPDF();
		}
		// $this->check_pass_data_only($data['matkul_diambil'],'var_dump');

		$data['dosen_jp'] = 'active open';

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

		$this->load->view('dosen_jp',$data);
		
	}

	public function eksportToPDF()
	{
		$list_jp = $this->dosen_model->get_all_jadwal_perkuliahan(array(
				'draft_jadwal_perkuliahan.draft_id_jp' => $this->input->post('tahun_ajar'),
				));
		$wawasan = $this->wawasan_dosen();
		foreach ($list_jp as $key => $value) {
			if (in_array($value->kode_mk, $wawasan)) {
				$new_list[] = $value;
			}
		}
		$data = array(
			'jadwal_tanggalDiBuat' => date('j F Y'),
			'jadwal_judul' => $this->input->post('judul'),
			'jadwal_tabel' => $new_list,
			'jadwal_catatanKaki' => $this->input->post('catatan_kaki'),
			'jadwal_persetujuan' => array(
				'mengetahui' => array(
					'nama' => $this->input->post('mengetahui_nama'),
					'sebagai' => $this->input->post('mengetahui_sebagai')
				),
				'menyetujui' => array(
					'nama' => $this->input->post('menyetujui_nama'),
					'sebagai' => $this->input->post('menyetujui_sebagai')
				)
			)
		);
		// $data['hari'] = $this->jadwal_perkuliahan_export_model->get_all_data('hari');

		$this->load->view('Jadwal_report',$data);
	}

	public function wawasan_dosen()
	{
		# mengambil wawasan dosen
		$wawasan = preg_replace('/(_)\w+/', '', $this->session->userdata('Detail')['wawasan_matkul']);
		$mk = explode(';', $wawasan);
		return $mk;
	}
}
