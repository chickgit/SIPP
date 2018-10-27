<?php
class Mahasiswa_model extends MY_Model {

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

    private function change_array_to_string($array = array())
    {
        $string = '';
        foreach ($array as $key) {
            $string .= $key.';';
        }
        return rtrim($string,';');
    }

    public function get_list_open_mk()
    {
        // $query  = $this->db->get('buka_tahun_ajaran');
        $row    = $this->get_tahun_ajaran();

        if ($row->semester == 'GANJIL') {
            $this->db->where_in('peminatan',array(0,$this->session->userdata('Detail')['peminatan']));
            $this->db->like('program_studi',$this->session->userdata('Detail')['program_studi']);
            $this->db->where('MOD (semester_mk,2) =',1);
            $this->db->or_where('semester_mk',8);
            $this->db->order_by('semester_mk', 'ASC');
            $this->db->order_by('sks_mk', 'ASC');
            $query = $this->db->get('matakuliah');
            return $query->result();
        } 
        else{
            $this->db->where_in('peminatan',array(0,$this->session->userdata('Detail')['peminatan']));
            $this->db->like('program_studi',$this->session->userdata('Detail')['program_studi']);
            $this->db->where('MOD (semester_mk,2) =',0);
            $this->db->order_by('semester_mk', 'ASC');
            $this->db->order_by('sks_mk', 'ASC');
            $query = $this->db->get('matakuliah');
            return $query->result();
        }
    }

    public function get_tahun_ajaran()
    {
        $query  = $this->db->get('buka_tahun_ajaran');
        return $query->row();
    }

    public function get_data()
    {
        $where = array(
            'nim'           => $this->session->userdata('Detail')['nim'],
            'tahun_ajaran'  => $this->session->userdata('TA')['tahun_ajaran'],
            'smstr'         => $this->session->userdata('TA')['semester']
        );
        $data_ambil_mk = $this->get_all_data('ambil_matakuliah', $where, 'result');
        // $query = $this->db->get_where('ambil_matakuliah', array(
        //     'isDelete'  => 0, 
        //     'isShow'    => 1, 
        //     'nim'       => $this->session->userdata('Detail')['nim']
        // ));
        $new_obj = (object) array();
        foreach ($data_ambil_mk as $row) {
            $new = explode(';', $row->kode_mk);
            foreach ($new as $key => $kode_mk) {
                $query = $this->get_mk($kode_mk);
                $new_obj->$key = $query;
                $new_obj->$key->nim = $row->nim;
                $new_obj->$key->tahun_ajaran = $row->tahun_ajaran;
                $new_obj->$key->smstr = $row->smstr;
            }
        }
        return $new_obj;
    }

    // public function check_mk()
    // {
    //     $query = $this->db->get_where('ambil_matakuliah', array('nim' => $this->input->post('nim'), 'tahun_ajaran' => $this->input->post('tahun_ajaran')));
    //     return $query->row();
    // }

    public function insert()
    {
        $data = array(
            "nim"           => $this->input->post('nim'),
            "tahun_ajaran"  => $this->input->post('tahun_ajaran'),
            "kode_mk"       => $this->change_array_to_string($this->input->post('kd_mk')),
            "created_by"    => $this->session_username()
        );
        $this->db->insert('ambil_matakuliah', $data);
        echo "OK";
    }

    public function update()
    {
        $data = array(
            "kode_mk"           => $this->change_array_to_string($this->input->post('kd_mk')),
            "modified_date"     => date('Y-m-d H:i:s'),
            "modified_by"       => $this->session_username()
        );
        $this->db->where("nim", $this->input->post('nim'));
        $this->db->where("tahun_ajaran", $this->input->post('tahun_ajaran'));
        $this->db->update('ambil_matakuliah', $data);
        echo "OK";
    }

    public function get_mk($kode_mk)
    {
        $query = $this->db->get_where('matakuliah', array(
            "kode_mk"   => $kode_mk,
            "isDelete"  => 0, 
            "isShow"    => 1
        ));
        return $query->row();
    }
}
