<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Algo extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
    	
        $this->load->database();
    	$this->load->library('session');
    	if (!$this->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->load->model('dosen_model');
    }

    private function json_view($arr = array())
    {
    	print_r(json_encode($arr));
    }

	public function index()
	{
		$new_arr = array();

		// HARI - WAKTU - MATA KULIAH - SEMESTER - DOSEN - RUANGAN
		// HARI
        $query_hari         = $this->db->get_where('hari', array('isDelete' => 0, 'isShow' => 1));
        $hasil_hari         = $query_hari->result_array();
        // WAKTU
        $query_waktu        = $this->db->get_where('waktu', array('isDelete' => 0, 'isShow' => 1));
        $hasil_waktu        = $query_waktu->result_array();
        // MATKUL
		$query_matkul       = $this->db->get_where('matakuliah', array('isDelete' => 0, 'isShow' => 1));
        $hasil_matkul       = $query_matkul->result_array();
		// SEMESTER
        // $semester           = array(1,3,5,7,8);
        // DOSEN
		$dosen              = array_combine(range(53, 82), range(61,90));
		// RUANGAN
        $query_ruangan      = $this->db->get_where('ruangan', array('isDelete' => 0, 'isShow' => 1, 'gedung_rg' => 'A'));
        $hasil_ruangan      = $query_ruangan->result_array();

        // $query_dosen = $this->db->get_where('ruangan', array('isDelete' => 0, 'isShow' => 1, 'gedung_rg' => 'A'));
		// $new_arr['Waktu'] = array();

        // $query_waktu = $this->db->get_where('waktu', array('isDelete' => 0, 'isShow' => 1));


      //   foreach ($hasil_hari as $key_hari => $value_hari) {
      //   	$arr1 = array(
    		// 	"Hari" => $value_hari['nama_hari']
    		// );
      //   	array_push($new_arr, $arr1);
      //   	$new_arr[$key_hari]['Kode_Waktu'] = array();
      //   	foreach ($hasil_waktu as $key => $value) {
      //   		$arr2 = array(
      //   			"Kode_Waktu" => $value['kode_wk']
      //   		);
      //   		array_push($new_arr[$key_hari]['Kode_Waktu'], $value['kode_wk']);
      //   	}
      //   	// $this->json_view($hasil_hari[$key]['id']);
      //   }

        // POPULASI/TARGET/KROMOSOM
        $TARGET = array();
        for ($i=1; $i <= count($hasil_matkul); $i++) { 
            // RANDOM HARI
            $rand_hari = array_rand($hasil_hari);
            // RANDOM WAKTU
            $rand_waktu = array_rand($hasil_waktu);
            // RANDOM MATKUL
            $rand_matkul = array_rand($hasil_matkul);
            // RANDOM SEMESTER
            // $rand_semester = array_rand($semester);
            // RANDOM DOSEN
            $rand_dosen = array_rand($dosen);
            // RANDOM RUANGAN
            $rand_ruangan = array_rand($hasil_ruangan);

            $arr = array(
            "HARI"      => $hasil_hari[$rand_hari]['id'],
            "JADWAL"    => array(
                $i          => array(
                    "WAKTU"     => $hasil_waktu[$rand_waktu],
                    "MATKUL"    => $hasil_matkul[$rand_matkul],
                    "SEMESTER"  => $hasil_matkul[$rand_matkul]['sks_mk'],
                    // "DOSEN"     => $dosen[$rand_dosen],
                    "RUANGAN"   => $hasil_ruangan[$rand_ruangan]
                    )
                )
            );
            $TARGET[] = $arr;
        }

        $this->json_view($TARGET);
        // $this->json_view($hasil_hari);
		exit();
		$data['list_dosen'] = $this->dosen_model->get_data();

		$data['dosen'] = 'active open';
		
		$data['header']['title'] = 'Data Dosen';
		$data['header']['css'] = '
			<link href="'.base_url().'assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
			<link href="'.base_url().'assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />';

		$data['menu'] = $this->load->view('sidebar',$data,TRUE);
		$data['footer'] = $this->load->view('footer',NULL,TRUE);
		$data['header'] = $this->load->view('header',$data['header'],TRUE);

		// $data['list_dosen'] = $this->dosen_model->

		$this->load->view('dosen',$data);
		
	}

	public function insert_dosen()
	{
		// print_r($_GET);
		// print_r($_POST['nid']);
		// json_encode($_POST);
		$data['insert_dosen'] = $this->dosen_model->insert_data($_POST);
		echo $data['insert_dosen'];
		exit();
	}

	public function check_nid()
	{
		// print_r($_GET);
		$data['check_nid_dosen'] = $this->dosen_model->check_nid($_GET['nid']);
		isset($data['check_nid_dosen']) ? $a="false" : $a="true";
		echo $a;
	}

	public function get_dosen()
	{
		// print_r($_GET);
		$data['get_dosen'] = $this->dosen_model->get_dosen($_POST['nid']);
		echo json_encode($data['get_dosen']);
		// print_r($data['get_dosen']);
	}

	public function update_dosen()
	{
		$data['update_dosen'] = $this->dosen_model->update_dosen($_POST);
		echo $data['update_dosen'];
		exit();
	}

	public function delete_dosen()
	{
		$data['delete_dosen'] = $this->dosen_model->delete_dosen($_POST['del_nid']);
		echo $data['delete_dosen'];
		exit();
	}

	public function comments()
        {
                echo 'Look at this!';
        }
}
