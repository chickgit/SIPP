<?php
class Waktu_model extends MY_Model {

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

    public function insert_data()
    {
        $data = array(
            "waktu_aw"      => $this->input->post('awal_wk'),
            "waktu_ak"      => $this->input->post('akhir_wk'),
            "role"          => $this->input->post('role'),
            "sks"           => $this->input->post('sks_wk'),
            "created_by"    => $this->session_username()
        );
        $this->db->insert('waktu', $data);
        echo "OK";
    }

    public function update_wk()
    {
        $data = array(
            "waktu_aw"      => $this->input->post('upd_awal_wk'),
            "waktu_ak"      => $this->input->post('upd_akhir_wk'),
            "role"          => $this->input->post('upd_role'),
            "sks"           => $this->input->post('upd_sks_wk'),
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username()
        );
        $this->db->where("id_waktu", $this->input->post('upd_id_waktu'));
        $this->db->update('waktu', $data);
        echo "OK";
    }

    public function delete_wk()
    {
        $data = array(
            "isDelete"      => 1,
            "modified_date" => date('Y-m-d H:i:s'),
            "modified_by"   => $this->session_username()
        );
        $this->db->where('id_waktu',$this->input->post('del_id_waktu'));
        $this->db->update('waktu',$data);
        // $this->db->delete('dosen');
        echo "OK";
    }

}
