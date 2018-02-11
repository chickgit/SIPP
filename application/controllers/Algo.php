<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Algo extends MY_Controller {

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
		$jadwal = array();
        $tahun_ajaran = '2017/2018';
        /*
        UNTUK MELAKUKAN GENERATE JADWAL PERKULIAHAN SECARA OTOMATIS
        1. HARI
            # PENGAMBILAN DATA HARI DARI DB
            */
            $query_hari         = $this->db->get_where('hari', array('isDelete' => 0, 'isShow' => 1));
            $hasil_hari         = $query_hari->result_array();
            $jadwal             = $hasil_hari;
        /*
        2. WAKTU
            # PENGAMBILAN DATA WAKTU DARI DB
            */
            $query_waktu        = $this->db->get_where('waktu', array('isDelete' => 0, 'isShow' => 1));
            $hasil_waktu        = $query_waktu->result_array();
            /*
            # PENYEMATAN MASING-MASING WAKTU KE SETIAP HARI
                HASIL DI INGINKAN : 
                    SENIN
                        08.00-10.30
                        10.45-13.15
                        13.30-16.00
                        dst
            */
            foreach ($jadwal as $key_jadwal => $value_jadwal) {
                $jadwal[$key_jadwal]['WAKTU'] = $hasil_waktu;
            }
        /*
        3.RUANGAN
            # PENGAMBILAN DATA RUANGAN DARI DB
            */
            $query_ruangan      = $this->db->get_where('ruangan', array('isDelete' => 0, 'isShow' => 1, 'gedung_rg' => 'A'));
            $hasil_ruangan      = $query_ruangan->result_array();
            /*
            # PENYEMATAN MASING-MASING RUANGAN DI SETIAP WAKTU DI SETIAP HARI
                HASIL DI INGINKAN : 
                    SENIN
                        08.00-10.30
                            LR-1
                            ...
                            OCR-1
                            ...
                            IMAC
                            CISCO
                        10.45-13.15
                            LR-1
                            dst
                        dst
            */
            foreach ($jadwal as $key_jadwal => $value_jadwal) {
                foreach ($value_jadwal['WAKTU'] as $key_waktu => $value_waktu) {
                    $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'] = $hasil_ruangan;
                }
            }
        /*
        4. MATA KULIAH
            # PENGAMBILAN DATA MATA KULIAH YANG DIAMBIL MAHASISWA
            */
            $query_matkul_ambil = $this->db->get_where('ambil_matakuliah', array('tahun_ajaran' => $tahun_ajaran,'isDelete' => 0, 'isShow' => 1));
            $hasil_matkul_ambil = $query_matkul_ambil->result_array();

            /*
            # MENJUMLAHKAN MAHASISWA YANG TELAH MENGAMBIL MATA KULIAH
            */
            $matkul = array();
            foreach ($hasil_matkul_ambil as $row) {
                $new = explode(';', $row['kode_mk']);
                foreach ($new as $value) {
                    if (array_key_exists($value, $matkul)) 
                    {
                        $matkul[$value] = $matkul[$value] + 1;
                    }
                    else
                    {
                        $matkul[$value] = 1;
                    }
                }
            }
            /*
            # MEMBUANG MATA KULIAH YANG MEMILIKI MAHASISWA DI BAWAH 5
            */
            foreach ($matkul as $key => $value) {
                if ($value < 5) {
                    unset($matkul[$key]);
                }
            }
            /*
            # PENYATUAN DATA DETAIL MATA KULIAH DAN SISA MATA KULIAH YANG MEMILIKI PESERTA DIATAS 5 BERDASARKAN KODE_MK
            */
            $this->db->where_in('kode_mk',array_keys($matkul));
            $this->db->where('isDelete', 0);
            $this->db->where('isShow', 1);
            $query_matkul       = $this->db->get('matakuliah');
            $hasil_matkul       = $query_matkul->result_array();
            /*
            # MEMASUKKAN JUMLAH MAHASISWA KE DALAM DATA MATA KULIAH
            */
            foreach ($hasil_matkul as $key =>$value) {
                foreach ($matkul as $key_mk => $value_mk) {
                    if ($key_mk == $value['kode_mk']) {
                        $hasil_matkul[$key]['JUMLAH_MHS'] = $value_mk;
                    }
                }
            }
            /*
            # PENYEMATAN MASING-MASING MATA KULIAH SECARA RANDOM KE DALAM SETIAP HARI DI SETIAP WAKTU DI SETIAP RUANGAN DENGAN SYARAT:
                + MASING-MASING RUANGAN HANYA MEMILIKI 1 MATA KULIAH (done)
                + 1 MATA KULIAH HANYA 1X PERTEMUAN (KECUALI EXTENSI) PER PEKAN
                + 1 WAKTU TIDAK BOLEH MEMILIKI BEBERAPA MATA KULIAH DI SETIAP RUANGAN DENGAN SEMESTER YANG SAMA
                    E.G : 08.00-10.30
                            LR-1
                                MATKUL A SMSTR 1
                            LR-2
                                MATKUL B SMSTR 1 (TIDAK BOLEH, KARENA MEMILIKI SEMESTER YANG SAMA)
                         SEHARUSNYA
                         08.00-10.30
                            LR-1
                                MATKUL A SMSTR 1
                         10.45-13.15
                            LR-2
                                MATKUL B SMSTR 1 (TIDAK BOLEH, KARENA MEMILIKI SEMESTER YANG SAMA)
            */
            while (!empty($hasil_matkul)) 
            {
                # code...
                foreach ($jadwal as $key_jadwal => $value_jadwal) 
                {
                    $rand_index_jadwal = array_rand($jadwal);
                    if ($rand_index_jadwal == $key_jadwal) 
                    {
                        foreach ($value_jadwal['WAKTU'] as $key_waktu => $value_waktu) 
                        {
                            $rand_index_waktu = array_rand($jadwal[$key_jadwal]['WAKTU']);
                            if ($rand_index_waktu == $key_waktu) 
                            {
                                foreach ($value_waktu['RUANGAN'] as $key_ruangan => $value_ruangan) 
                                {
                                    $rand_index_ruangan = array_rand($jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN']);
                                    $rand_index_matkul = array_rand($hasil_matkul);
                                    // print_r($hasil_matkul[$rand_index_matkul]['JUMLAH_MHS']);
                                    // exit();
                                    if (($rand_index_ruangan == $key_ruangan) && (array_key_exists($rand_index_matkul, $hasil_matkul))) 
                                    {
                                        $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'][$key_ruangan]['MATKUL'] = $hasil_matkul[$rand_index_matkul];
                                        unset($hasil_matkul[$rand_index_matkul]);
                                    }
                                    // else
                                    // {
                                    //     break;
                                    // }
                                }
                            }
                            // else
                            // {
                            //     break;
                            // }
                        }
                    }
                    // else
                    // {
                    //     break;
                    // }
                }
            }
        /*
        SELESAI
        */
        $this->json_view($jadwal);
        // $this->json_view(count($hasil_matkul));
        // $this->json_view($hasil_matkul[array_rand($hasil_matkul,1)]);
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
