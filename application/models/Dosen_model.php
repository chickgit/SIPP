<?php
class Dosen_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Your own constructor code
    }

    private function session_username()
    {
        return $this->session->userdata('Login')['username'];
    }

    public function get_data()
    {
        $query = $this->db->get_where('dosen', array('isDelete' => 0, 'isShow' => 1));
    	return $query->result();
    }

    public function check_nid($nid)
    {
        $query = $this->db->query('SELECT nid FROM dosen WHERE nid = '.$nid);
        return $query->row();
    }

    public function insert_data($arr = array())
    {
        if ($this->input->post('ketersediaan_hari')) {
            # code...
            $hari = '';
            foreach ($this->input->post('ketersediaan_hari') as $key => $value) {
                $hari = $hari.$value.';';
            }
            $hari = rtrim($hari,';');
        }
        else{
            $hari = $this->input->post('ketersediaan_hari');
        }

        if ($this->input->post('wawasan_matkul')) {
            $matkul = '';
            foreach ($this->input->post('wawasan_matkul') as $key => $value) {
                $value = explode('_', $value);
                $matkul = $matkul.$value[0].';';
            }
            $matkul = rtrim($matkul,';');
        }
        else{
            $matkul = $this->input->post('wawasan_matkul');
        }
        // echo json_encode($matkul);
        // exit();
        $data = array(
            "nid" => $this->input->post('nid'),
            "nama" => $this->input->post('nama'),
            "alamat" => $this->input->post('alamat'),
            "telepon" => $this->input->post('telepon'),
            "gambar_ava" => $this->input->post('gambar_ava'),
            "ketersediaan_hari" => $hari,
            "wawasan_matkul" => $matkul,
        );
        $this->db->insert('dosen', $data);
        echo "OK";
        // $sql = ("INSERT INTO dosen(nid, nama, alamat, telepon, gambar_ava, ketersediaan_hari, wawasan_matkul) VALUES (?, ?, ?, ?, ?, ?, ?)");
        // $this->db->query($sql, array($arr['nid'],$arr['nama'],$arr['alamat'],$arr['telepon']));
        // echo "OK";
    }

    public function get_dosen($nid)
    {
        $query = $this->db->query('SELECT * FROM dosen WHERE nid = '.$nid);
        return $query->row();
    }

    public function update_dosen($arr = array())
    {
        $sql = ("UPDATE dosen SET nama = ?, alamat = ?, telepon = ?, modified_date = ?, modified_by = ? WHERE nid = ?");
        $this->db->query($sql, array($arr['upd_nama'],$arr['upd_alamat'],$arr['upd_telepon'],date('Y-m-d H:i:s'),$this->session_username(),$arr['upd_nid']));
        echo "OK";
    }

    public function delete_dosen($nid)
    {
        $data = array(
            'isDelete' => 1
        );
        $this->db->where('nid',$nid);
        $this->db->update('dosen',$data);
        // $this->db->delete('dosen');
        echo "OK";
    }

}
