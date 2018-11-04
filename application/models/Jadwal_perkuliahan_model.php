<?php
class Jadwal_perkuliahan_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->load->library('algo');
        // Your own constructor code
    }

    private function session_username()
    {
        return $this->session->userdata('Login')['username'];
    }

    public function penerbitan()
    {
        $check_data = $this->get_all_data('draft_jadwal_perkuliahan', array(
            "id_ta"     => $this->input->post('ta_jadwal'),
            "id_smstr"  => $this->input->post('smstr_jadwal')
            ), 'row');
        
        if (!empty($check_data)) {
            header('HTTP/1.1 432 Penerbitan tidak boleh sama dengan tahun ajar dan semester lain');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'ERROR', 'code' => 1337)));
        }

        $data = array(
            "terbit"        => 1,
            "id_ta"     => $this->input->post('ta_jadwal'),
            "id_smstr"  => $this->input->post('smstr_jadwal'),
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username()
        );

        # Update draft status terbit menjadi 1
        $this->db->where('draft_id_jp', $this->input->post('id_draft'));
        $this->db->update('draft_jadwal_perkuliahan', $data);

        echo "OK";
    }

    public function batal_penerbitan()
    {
        $data = array(
            "terbit"        => 0,
            "id_ta"     => NULL,
            "id_smstr"  => NULL,
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username()
        );

        # Update draft status terbit menjadi 1
        $this->db->where('draft_id_jp', $this->input->post('id_draft_batal'));
        $this->db->update('draft_jadwal_perkuliahan', $data);

        echo "OK";
    }

    public function penghapusan()
    {
        # Proses penghapusan jadwal perkuliahan
        # Hapus data-data jadwal
        $data = array(
            "isDelete"      => 1,
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username()
        );
        $this->db->where('draft_id_jp', $this->input->post('id_draft'));
        $this->db->update('jadwal_perkuliahan', $data);

        # Hapus draft jadwal 
        $this->db->where('draft_id_jp', $this->input->post('id_draft'));
        $this->db->update('draft_jadwal_perkuliahan', $data);
    }

}
