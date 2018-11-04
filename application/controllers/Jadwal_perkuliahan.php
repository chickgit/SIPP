<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_perkuliahan extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();

    	$this->load->library('session');
    	$this->load->library('algo');

    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('jadwal_perkuliahan_model');
    }

	public function index()
	{
		// $data['list_jp'] = $this->jadwal_perkuliahan_model->get_data_temp();
		// print_r(json_encode($data['list_jp']));
		// exit();
		$data['user'] = $this->session->userdata();
		// $this->check_pass_data_only($this->session->userdata(), 'var_dump');

		// $data['list_jp'] = $this->jadwal_perkuliahan_model->get_all_data('draft_jadwal_perkuliahan', array('finalisasi' => 1), 'result');
		$data['list_jp'] = $this->get_draft_all(array('finalisasi' => 1));

		$data['role'] = $this->get_role_user();

		$data['jadwal_perkuliahan'] = 'active open';

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
        	<script src="'.base_url().'assets/global/plugins/pdfmake/build/pdfmake.min.js" type="text/javascript"></script>
        	<script src="'.base_url().'assets/global/plugins/pdfmake/build/vfs_fonts.js" type="text/javascript"></script>
			';
		$data['footer']['footer_page_scripts'] = '
			<script src="'.base_url().'assets/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
        	<script src="'.base_url().'assets/pages/scripts/components-select2.js" type="text/javascript"></script>
        	<script src="'.base_url().'assets/pages/scripts/ui-sweetalert.js" type="text/javascript"></script>
			';
			// <script src="'.base_url().'assets/pages/scripts/table-datatables-managed.js" type="text/javascript"></script>
		
		# FORM-DROPDOWN TAHUN AJARAN
		$data['drop']['ta'] = $this->dropdown_ta();

		# FORM-DROPDOWN SEMESTER
		$data['drop']['smstr'] = $this->dropdown_smstr();
		// $data['tahun_ajaran'] = $this->home_model->get_all_data('tahun_ajaran', array(), 'result');
		// $data['drop']['ta']['opt'][0] = 'Pilih Tahun Ajaran';
		// foreach ($data['tahun_ajaran'] as $key => $value) {
		// 	$data['drop']['ta']['opt'][$value->id_ta] = $value->tahun_ajaran;
		// }
		// $data['drop']['ta']['slctd'] = isset($data['bta']->id_ta) ? $data['bta']->id_ta : 0;
		// $data['drop']['ta']['attr'] = array('class' => 'form-control', 'id' => 'tahun_ajaran');
			
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',$data['footer'],TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('Jadwal_perkuliahan',$data);
	}

	public function get_draft_all($where = array(), $single = false)
	{
		$options = array(
			'select'    => 'draft_jadwal_perkuliahan.draft_id_jp, draft_jadwal_perkuliahan.draft_nama, draft_jadwal_perkuliahan.finalisasi, draft_jadwal_perkuliahan.terbit, 
							tahun_ajaran.id_ta, tahun_ajaran.tahun_ajaran, 
							semester.id_smstr, semester.semester',
			'table'     => 'draft_jadwal_perkuliahan',
			'where'		=> $where,
			'join'      => array(
				array('tahun_ajaran', 'tahun_ajaran.id_ta = draft_jadwal_perkuliahan.id_ta', 'left'),
				array('semester', 'semester.id_smstr = draft_jadwal_perkuliahan.id_smstr', 'left'),
			),
			'single'	=> $single
        );
        return $this->jadwal_perkuliahan_model->commonGet($options);
	}

	public function dropdown_ta()
	{
		$hasil = array();
		$ta = $this->jadwal_perkuliahan_model->get_all_data('tahun_ajaran', array(), 'result');

		$hasil['opt'][0] = 'Pilih Tahun Ajaran';
		foreach ($ta as $key => $value) {
			$hasil['opt'][$value->id_ta] = $value->tahun_ajaran;
		}
		$hasil['slctd'] = '';
		$hasil['attr'] = array('class' => 'form-control');

		return $hasil;
	}

	public function dropdown_smstr()
	{
		$hasil = array();
		$ta = $this->jadwal_perkuliahan_model->get_all_data('semester', array(), 'result');

		$hasil['opt'][0] = 'Pilih Semester';
		foreach ($ta as $key => $value) {
			$hasil['opt'][$value->id_smstr] = $value->semester;
		}
		$hasil['slctd'] = '';
		$hasil['attr'] = array('class' => 'form-control');

		return $hasil;
	}

	public function actions()
	{
		// $this->check_pass_data_only($draft);
		if ($this->input->post('view')) {
			$draft = $this->jadwal_perkuliahan_model->get_all_data('draft_jadwal_perkuliahan', array('draft_id_jp' => $this->input->post('view')), 'row_array');
			$this->session->set_userdata('id_draft',$draft['draft_id_jp'].'_'.$draft['finalisasi'].'_'.$draft['draft_nama']);
			header('Location: '.base_url().'jadwal');
		}
		if ($this->input->post('tutup_view')) {
			$this->session->unset_userdata('id_draft');
			header('Location: '.base_url().'jadwal_perkuliahan');
		}
	}

	public function get_draft()
	{
		$data['draft'] = $this->get_draft_all(array('draft_id_jp' => $this->input->post('id_draft')), true);
		echo json_encode($data['draft']);
	}

	public function penerbitan()
	{
		# Proses Penerbitan
		$this->check_pass_data_only($this->input->post());
		$data['penerbitan'] = $this->jadwal_perkuliahan_model->penerbitan();
		echo json_encode($data['penerbitan']);
	}

	public function batal_penerbitan()
	{
		# Proses Penerbitan
		// $this->check_pass_data_only($this->input->post());
		$data['batal_penerbitan'] = $this->jadwal_perkuliahan_model->batal_penerbitan();
		echo json_encode($data['batal_penerbitan']);
	}

	public function penghapusan()
	{
		# code...
		// $this->check_pass_data_only($this->input->post());
		$data['penghapusan'] = $this->jadwal_perkuliahan_model->penghapusan();
		echo json_encode($data['penghapusan']);
	}
}
