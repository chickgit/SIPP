<?php
class Dosen_model extends MY_Model {

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
    # BEGIN PENGELOLAAN DOSEN
    private function ketersediaan_hari()
    {
        if ($this->uri->segment(2) == 'update_dosen') {
            $arr_hari = $this->input->post('upd_ketersediaan_hari');
        }
        else
        {
            $arr_hari = $this->input->post('ketersediaan_hari');
        }

        if ($arr_hari) {
            # code...
            $hari = '';
            foreach ($arr_hari as $key => $value) {
                $hari = $hari.$value.';';
            }
            $hari = rtrim($hari,';');
        }
        else{
            $hari = $arr_hari;
        }

        return $hari;
    }

    private function wawasan_matkul()
    {
        if ($this->uri->segment(2) == 'update_dosen') {
            $arr_matkul = $this->input->post('upd_wawasan_matkul');
        }
        else
        {
            $arr_matkul = $this->input->post('wawasan_matkul');
        }

        if ($arr_matkul) {
            $matkul = '';
            foreach ($arr_matkul as $key => $value) {
                // $value = explode('_', $value);
                // $matkul = $matkul.$value[0].';';
                $matkul = $matkul.$value.';';
            }
            $matkul = rtrim($matkul,';');
        }
        else{
            $matkul = $arr_matkul;
        }

        return $matkul;
    }

    public function get_all_dosen()
    {
        return $this->get_all_data('dosen',array(),'result');
    }

    public function get_all_hari()
    {
        return $this->get_all_data('hari',array(),'result');
    }

    public function check_nid($nid)
    {
        $query = $this->db->query('SELECT nid FROM dosen WHERE nid = '.$nid);
        return $query->row();
    }

    public function insert_data($arr = array())
    {
        $data = array(
            "nid" => $this->input->post('nid'),
            "nama" => $this->input->post('nama'),
            "alamat" => $this->input->post('alamat'),
            "telepon" => $this->input->post('telepon'),
            "gambar_ava" => $this->input->post('gambar_ava'),
            "ketersediaan_hari" => $this->ketersediaan_hari(),
            "wawasan_matkul" => $this->wawasan_matkul(),
            "created_by" => $this->session_username(),
            "isShow" => $this->input->post('isShow')
        );
        $this->db->insert('dosen', $data);
        echo "OK";
        // echo json_encode($data);
    }

    public function get_dosen($nid)
    {
        $query = $this->db->query('SELECT * FROM dosen WHERE nid = '.$nid);
        return $query->row();
    }

    public function update_dosen($arr = array())
    {
        // echo json_encode($this->input->post());
        // exit();
        $data = array(
            "nama" => $this->input->post('upd_nama'),
            "alamat" => $this->input->post('upd_alamat'),
            "telepon" => $this->input->post('upd_telepon'),
            "gambar_ava" => $this->input->post('upd_gambar_ava'),
            "ketersediaan_hari" => $this->ketersediaan_hari(),
            "wawasan_matkul" => $this->wawasan_matkul(),
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by" => $this->session_username(),
            "isShow" => $this->input->post('upd_isShow')
        );

        $this->db->where("nid", $this->input->post('upd_nid'));
        $this->db->update("dosen", $data);

        // $sql = ("UPDATE dosen SET nama = ?, alamat = ?, telepon = ?, modified_date = ?, modified_by = ? WHERE nid = ?");
        // $this->db->query($sql, array($arr['upd_nama'],$arr['upd_alamat'],$arr['upd_telepon'],date('Y-m-d H:i:s'),$this->session_username(),$arr['upd_nid']));
        echo "OK";
    }

    public function delete_dosen($nid)
    {
        $data = array(
            "isDelete"      => 1,
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username()
        );
        $this->db->where('nid',$nid);
        $this->db->update('dosen',$data);
        // $this->db->delete('dosen');
        echo "OK";
    }
    # END PENGELOLAAN DOSEN

    # BEGIN DOSEN

    # MHS_JP.PHP
    # mengambil draft matkul yang sudah difinalisasi dan terbit
    public function draft()
    {
        $options = array(
            'select'    => 'draft_jadwal_perkuliahan.draft_id_jp, draft_jadwal_perkuliahan.draft_nama, draft_jadwal_perkuliahan.finalisasi, draft_jadwal_perkuliahan.terbit, 
                            tahun_ajaran.id_ta, tahun_ajaran.tahun_ajaran, 
                            semester.id_smstr, semester.semester',
            'table'     => 'draft_jadwal_perkuliahan',
            'where'     => array(
                'draft_jadwal_perkuliahan.finalisasi'           => 1,
                'draft_jadwal_perkuliahan.terbit'               => 1,
                'draft_jadwal_perkuliahan.id_ta IS NOT NULL'    => NULL,
                'draft_jadwal_perkuliahan.id_smstr IS NOT NULL' => NULL
            ),
            'join'      => array(
                array('tahun_ajaran', 'tahun_ajaran.id_ta = draft_jadwal_perkuliahan.id_ta', 'left'),
                array('semester', 'semester.id_smstr = draft_jadwal_perkuliahan.id_smstr', 'left'),
            )
        );
        return $this->commonGet($options);
    }
    
    # END DOSEN
}
