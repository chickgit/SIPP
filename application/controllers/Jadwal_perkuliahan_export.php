<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_perkuliahan_export extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();

    	$this->load->library('session');
    	$this->load->library('algo');
    	$this->load->library('Pdf');
    	
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('jadwal_perkuliahan_export_model');
    }
	public function index()
	{
		// $data['list_jp'] = $this->jadwal_perkuliahan_export_model->get_data_temp();
		// print_r(json_encode($data['list_jp']));
		// exit();
		$data['user'] = $this->session->userdata();

		$data['list_draft_jp'] = $this->jadwal_perkuliahan_export_model->get_all_data('draft_jadwal_perkuliahan',array(),'result');
		if ($this->session->has_userdata('id_draft')) {
			# code...
			$data['list_jp'] = $this->jadwal_perkuliahan_export_model->get_data_temp(array('draft_id_jp' => $this->session->userdata('id_draft')['draft_id_jp']));
		}
		$data['all_data'] = array(
			"hari" 			=> $this->jadwal_perkuliahan_export_model->get_all_data('hari'),
			"matakuliah" 	=> $this->jadwal_perkuliahan_export_model->get_all_data('matakuliah'),
			"waktu" 		=> $this->jadwal_perkuliahan_export_model->get_all_data('waktu'),
			"dosen" 		=> $this->jadwal_perkuliahan_export_model->get_all_data('dosen'),
			"ruangan" 		=> $this->jadwal_perkuliahan_export_model->get_all_data('ruangan')
		);

		$data['role'] = $this->get_role_user();

		$data['jadwal_perkuliahan_export'] = 'active open';

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

		$this->load->view('Jadwal_perkuliahan_export',$data);
		
	}

	public function export()
	{
		echo json_encode($this->input->post());
		exit();
		// $data['list_jp'] = $this->jadwal_perkuliahan_export_model->get_data_temp(array('draft_id_jp' => $this->insput->post('draft_jp')));
		$data = array(
			'jadwal_tanggalDiBuat' => date('j F Y'),
			'jadwal_judul' => $this->input->post('judul'),
			'jadwal_tabel' => $this->jadwal_perkuliahan_export_model->get_data_temp(array('draft_id_jp' => $this->input->post('draft_jp'))),
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

	public function draft()
	{
		// echo json_encode($this->input->post());
		// exit();
		$data['draft'] = $this->jadwal_perkuliahan_export_model->draft();
		echo json_encode($data['draft']);
	}

	public function get_detail_jw()
	{
		$data['get_detail_jw'] = $this->jadwal_perkuliahan_export_model->get_detail_jw($_POST['kode_jw']);
		echo json_encode($data['get_detail_jw']);
		// print_r($data['get_dosen']);
	}

	public function update_jw()
	{
		// echo json_encode($_POST);
		// exit();
		$data['update_jw'] = $this->jadwal_perkuliahan_export_model->update_jw();
		echo $data['update_jw'];
		exit();
	}

	public function delete_jw()
	{
		$data['delete_jw'] = $this->jadwal_perkuliahan_export_model->delete_jw($this->input->post('del_kode_jw'));
		echo $data['delete_jw'];
		exit();
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
