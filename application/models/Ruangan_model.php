<?php
class Ruangan_model extends MY_Model {

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

    public function get_all_ruangan()
    {
        $options = array(
            'select'    => 'ruangan.id_ruangan, ruangan.nama_ruangan, ruangan.gedung_rg, jenis_ruangan.id_jenis, jenis_ruangan.jenis, ruangan.kapasitas_rg, ruangan.created_date, ruangan.created_by, ruangan.modified_date, ruangan.modified_by, ruangan.isShow',
            'table'     => 'ruangan',
            'join'      => array(
                'jenis_ruangan'     => 'jenis_ruangan.id_jenis = ruangan.id_jenis',
            )
        );
        return $this->commonGet($options);
    }

    public function insert_data()
    {
        $data = array(
            "nama_ruangan"  => $this->input->post('nama_ruangan'),
            "gedung_rg"     => $this->input->post('gedung'),
            "id_jenis"      => $this->input->post('jenis'),
            "kapasitas_rg"  => $this->input->post('kapasitas'),
            "created_by"    => $this->session_username(),
            "isShow" => $this->input->post('isShow')
        );
        $this->db->insert('ruangan', $data);
        echo "OK";
    }

    public function get_rg()
    {
        $options = array(
            'select'    => 'ruangan.id_ruangan, ruangan.nama_ruangan, ruangan.gedung_rg, jenis_ruangan.id_jenis, jenis_ruangan.jenis, ruangan.kapasitas_rg, ruangan.created_date, ruangan.created_by, ruangan.modified_date, ruangan.modified_by, ruangan.isShow',
            'table'     => 'ruangan',
            'where'     => array('ruangan.id_ruangan' => $this->input->post('id_ruangan')),
            'join'      => array(
                'jenis_ruangan'     => 'jenis_ruangan.id_jenis = ruangan.id_jenis',
            ),
            'single'    => TRUE
        );
        return $this->commonGet($options);
    }

    public function update_rg()
    {
        $data = array(
            "nama_ruangan"  => $this->input->post('upd_nama_ruangan'),
            "gedung_rg"     => $this->input->post('upd_gedung'),
            "id_jenis"      => $this->input->post('upd_jenis'),
            "kapasitas_rg"  => $this->input->post('upd_kapasitas'),
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username(),
            "isShow" => $this->input->post('upd_isShow')
        );
        $this->db->where("id_ruangan", $this->input->post('upd_id_ruangan'));
        $this->db->update('ruangan', $data);
        echo "OK";
    }

    public function delete_rg()
    {
        $data = array(
            "isDelete"      => 1,
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username()
        );
        $this->db->where('id_ruangan',$this->input->post('del_id_ruangan'));
        $this->db->update('ruangan',$data);
        // $this->db->delete('dosen');
        echo "OK";
    }
}
