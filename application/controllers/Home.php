<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
    {
    	parent::__construct();
    	
        $this->load->database();
        
    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('home_model');

        $this->load->helper('form');
    }

    private function session_username()
    {
        return $this->session->userdata('Login')['username'];
    }
    
	public function index()
	{
        // $this->check_pass_data_only($this->session->userdata());
		// $arr = array('Login', 'Detail');
		// $this->session->unset_userdata($arr);
		// print_r(json_encode($this->get_all_detail()));
		// exit();

		$data['role'] = $this->get_role_user();
		$data['session'] = $this->user_all_detail();
		$data['dashboard'] = 'active open';
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		
		$data['title'] = 'Beranda';

        # COUNTER
		$data['count_dosen'] = $this->home_model->get_all_data('dosen',array(),'num_rows');
		$data['count_matakuliah'] = $this->home_model->get_all_data('matakuliah',array(),'num_rows');
		$data['count_ruangan'] = $this->home_model->get_all_data('ruangan',array(),'num_rows');
		$data['count_waktu'] = $this->home_model->get_all_data('waktu',array(),'num_rows');
		$data['count_hari'] = $this->home_model->get_all_data('hari',array(),'num_rows');

        $data['footer_page_plugin'] = '
            <script src="'.base_url().'assets/global/plugins/moment.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/morris/morris.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/morris/raphael-min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
            <script src="'.base_url().'assets/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
        ';
        $data['footer_page_scripts'] = '
            <script src="'.base_url().'assets/pages/scripts/dashboard.min.js" type="text/javascript"></script>
        ';

        # BUKA TAHUN AJARAN
        $options = array(
            'select'    => 'buka_tahun_ajaran.id_bta, buka_tahun_ajaran.id_ta, buka_tahun_ajaran.id_smstr, buka_tahun_ajaran.batas_akhir, tahun_ajaran.tahun_ajaran, semester.semester',
            'table'     => 'buka_tahun_ajaran',
            'join'      => array(
                'tahun_ajaran' => 'tahun_ajaran.id_ta = buka_tahun_ajaran.id_ta',
                'semester'     => 'semester.id_smstr = buka_tahun_ajaran.id_smstr'
            ),
            'single'    => TRUE
        );
		$data['bta'] = $this->home_model->commonGet($options);
        // $this->check_pass_data_only($data['bta'], 'var_dump');
        $data['bta']->tahun_ajaran = isset($data['bta']->tahun_ajaran) ? $data['bta']->tahun_ajaran : 'NULL';
        $data['bta']->semester = isset($data['bta']->semester) ? $data['bta']->semester : 'NULL';
        $data['bta']->batas_akhir = isset($data['bta']->batas_akhir) ? $data['bta']->batas_akhir : 'NULL';

        # FORM-DROPDOWN TAHUN AJARAN
        $data['tahun_ajaran'] = $this->home_model->get_all_data('tahun_ajaran', array(), 'result');
        $data['drop']['ta']['opt'][0] = 'Pilih Tahun Ajaran';
        foreach ($data['tahun_ajaran'] as $key => $value) {
            $data['drop']['ta']['opt'][$value->id_ta] = $value->tahun_ajaran;
        }
        $data['drop']['ta']['slctd'] = isset($data['bta']->id_ta) ? $data['bta']->id_ta : 0;
        $data['drop']['ta']['attr'] = array('class' => 'form-control', 'id' => 'tahun_ajaran');

        # FORM-DROPDOWN SEMESTER
        $data['semester'] = $this->home_model->get_all_data('semester', array(), 'result');
        $data['drop']['smstr']['opt'][0] = 'Pilih Semester';
        foreach ($data['semester'] as $key => $value) {
            $data['drop']['smstr']['opt'][$value->id_smstr] = $value->semester;
        }
        $data['drop']['smstr']['slctd'] = isset($data['bta']->id_smstr) ? $data['bta']->id_smstr : 0;
        $data['drop']['smstr']['attr'] = array('class' => 'form-control', 'id' => 'tahun_ajaran');

        # FORM-INPUT TANGGAL BATAS AKHIR
        $data['input']['batas_akhir'] = array(
            'type'  => 'date',
            'class' => 'form-control',
            'id'    => 'date',
            'name'  => 'date',
            'value' => isset($data['bta']->batas_akhir) ? $data['bta']->batas_akhir : ''
        );

        // $this->check_pass_data_only($data['bta']);
		$this->load->view('header',$data);
		$this->load->view('home',$data);
		$this->load->view('footer',$data);
	}

	public function update()
	{
        // $this->check_pass_data_only($this->input->post());
		$data = array(
            'id_ta' 	    => $this->input->post('tahun_ajaran'),
            'id_smstr'		=> $this->input->post('semester'),
            'batas_akhir'	=> $this->input->post('date'),
            'modified_date'	=> date('Y-m-d H:i:s'),
            'modified_by'	=> $this->session_username()
        );
        $this->db->where('id_bta',1);
        // $this->check_pass_data_only($this->db);
        $this->db->update('buka_tahun_ajaran',$data);
        header("Location: ".base_url()."home");
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
