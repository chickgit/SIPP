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

    	$this->load->model('dosen_model');
    	$this->load->model('matakuliah_model');
    	$this->load->model('ruangan_model');
    	$this->load->model('waktu_model');
    	$this->load->model('hari_model');
    }

    private function session_username()
    {
        return $this->session->userdata('Login')['username'];
    }
    
	public function index()
	{
		// $arr = array('Login', 'Detail');
		// $this->session->unset_userdata($arr);
		// print_r($this->session->userdata());
		// exit();

		$data['role'] = $this->get_role_user();
		$data['session'] = $this->session->userdata('Detail');
		$data['dashboard'] = 'active open';
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		
		$data['title'] = 'Dashboard';

		$data['count_dosen'] = $this->dosen_model->get_data();
		$data['count_matakuliah'] = $this->matakuliah_model->get_data();
		$data['count_ruangan'] = $this->ruangan_model->get_data();
		$data['count_waktu'] = $this->waktu_model->get_data();
		$data['count_hari'] = $this->hari_model->get_data();

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

		$data['bta'] = $this->db->get('buka_tahun_ajaran')->row();

		$this->load->view('header',$data);

		$this->load->view('home',$data);
		$this->load->view('footer',$data);
	}

	public function update()
	{
		$data = array(
            'tahun_ajaran' 	=> $_POST['tahun_ajar'],
            'semester'		=> $_POST['semester'],
            'batas_akhir'	=> $_POST['date'],
            'modified_date'	=> date('Y-m-d H:i:s'),
            'modified_by'	=> $this->session_username()
        );
        $this->db->where('id',1);
        $this->db->update('buka_tahun_ajaran',$data);
        // $this->db->delete('dosen');
        header("Location: ".base_url()."home");
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
