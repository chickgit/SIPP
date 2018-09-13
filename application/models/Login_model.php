<?php
class Login_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Your own constructor code
    }

    public function login($arr = array())
    {
    	$query = $this->db->get_where('user', array('username' => $arr['username']));
        // $hasil = $this->db->where('username',$arr['username']);
        // $hasil = array();
        $hasil = $query->row_array();

        $hasil_akhir_err = array('error' => 'Username atau Password tidak ditemukan');
        $hasil_akhir_suc = array(
            'success' => 'Username atau Password ditemukan',
            'login' => $hasil
        );

        if ($hasil == NULL) {
            return $hasil_akhir_err;
        }

        // print_r($hasil);
        if ( ($hasil['password'] == '123456') && ($arr['password'] == '123456')  ) 
        {
            return $hasil_akhir_suc;
        }
        else if (password_verify($arr['password'],$hasil['password']))
        {
            return $hasil_akhir_suc;
        }
        else
        {
            return $hasil_akhir_err;
        }
    }

    public function get_data_user($id = array())
    {
        if ($id['sebagai'] == 0 || $id['sebagai'] == 1) {
            $query = $this->db->get_where('dosen', array('nid' => $id['id_sebagai']));
        }else{
            $query = $this->db->get_where('mahasiswa', array('nim' => $id['id_sebagai']));
        }
        return $query->row_array();
    }

    public function get_tahun_ajaran()
    {
        return $this->db->get_where('buka_tahun_ajaran', array('isDelete' => 0, 'isShow' => 1))->row_array();
    }

}
