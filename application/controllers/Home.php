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
    }

    private function session_username()
    {
        return $this->session->userdata('Login')['username'];
    }
    
	public function index()
	{
		// $arr = array('Login', 'Detail');
		// $this->session->unset_userdata($arr);
		// print_r(json_encode($this->get_all_detail()));
		// exit();

		$data['role'] = $this->get_role_user();
		$data['session'] = $this->user_all_detail();
		$data['dashboard'] = 'active open';
		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		
		$data['title'] = 'Beranda';

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

		$data['bta'] = $this->home_model->get_all_data('buka_tahun_ajaran',array(),'row');

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
