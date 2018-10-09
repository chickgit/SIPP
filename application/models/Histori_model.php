<?php
class Histori_model extends MY_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Your own constructor code
    }

    private function get_jadwal_history($where = array())
    {
        $query = $this->db->select(
                // 'jadwal_temp.id_j_t, jadwal_temp.tahun_ajaran, jadwal_temp.peserta,
                'A.id_jadwal_p, A.tahun_ajaran, A.peserta,
                hari.id, hari.nama_hari, 
                waktu.kode_wk, waktu.waktu_aw, waktu.waktu_ak, 
                ruangan.kode_rg, 
                matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, matakuliah.program_studi, matakuliah.peminatan,
                dosen.nid, dosen.nama'
            )
                            ->from('jadwal_perkuliahan A')
                            ->where(array('A.isDelete' => 1, 'A.isShow' => 1))
                            ->where($where)
                            ->join('hari', 'hari.id = A.id_hari', 'left')
                            ->join('waktu', 'waktu.kode_wk = A.kode_wk', 'left')
                            ->join('ruangan', 'ruangan.kode_rg = A.kode_rg', 'left')
                            ->join('matakuliah', 'matakuliah.kode_mk = A.kode_mk', 'left')
                            ->join('dosen', 'dosen.nid = A.nid', 'left')
                            ->get();
        return $query;                            
    }

    public function get_histori($table, $where = array())
    {
        $data = array(
            'isDelete' => 1,
            'isShow'   => 1
        );
        if (!empty($where)) {
            $data = array_merge($data, $where);
        }

        if ($table == 'jadwal' || $table == 'jadwal_perkuliahan') 
        {
            $query = $this->get_jadwal_history($where);
        }
        else
        {
            $query = $this->db->get_where($table, $data);
        }
    	return $query->result();
    }

    public function get_data($table, $arr)
    {
        if ($table == 'jadwal' || $table == 'jadwal_perkuliahan') 
        {
            $query = $this->db->select(
                // 'jadwal_temp.id_j_t, jadwal_temp.tahun_ajaran, jadwal_temp.peserta,
                'A.id_jadwal_p, A.tahun_ajaran, A.peserta,
                hari.id, hari.nama_hari, 
                waktu.kode_wk, waktu.waktu_aw, waktu.waktu_ak, 
                ruangan.kode_rg, 
                matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, matakuliah.program_studi, matakuliah.peminatan,
                dosen.nid, dosen.nama'
            )
                            ->from('jadwal_perkuliahan A')
                            ->where($arr)
                            ->join('hari', 'hari.id = A.id_hari', 'left')
                            ->join('waktu', 'waktu.kode_wk = A.kode_wk', 'left')
                            ->join('ruangan', 'ruangan.kode_rg = A.kode_rg', 'left')
                            ->join('matakuliah', 'matakuliah.kode_mk = A.kode_mk', 'left')
                            ->join('dosen', 'dosen.nid = A.nid', 'left')
                            ->get();
        }
        else
        {
            $query = $this->db->get_where($table,$arr);
        }
        return $query->row();
    }

    public function restore_data($arr)
    {
        $data = array(
            'isDelete' => 0
        );
        $arr2 = array(
            $arr['restore_1'] => $arr['restore_0']
        );
        $this->db->update($arr['restore_2'], $data, $arr2);
        // $this->db->delete('dosen');
        echo "OK";
    }

    public function delete_data($arr)
    {
        $arr2 = array(
            $arr['delete_1'] => $arr['delete_0']
        );
        $this->db->delete($arr['delete_2'],$arr2);
        // $this->db->delete('dosen');
        echo "OK";
    }

    public function draft()
    {
        $draft = split('_', $this->input->post('draft_id'));

        if ($draft[0] == 'open') 
        {
            # Membuka jadwal perkuliahan dari draft
            // $open_draft = $this->get_all_data('draft_jadwal_perkuliahan', array('draft_id_jp' => $draft[1]), 'row_array');
            $this->session->set_userdata(array('id_draft_histori' => $draft[1]));
            echo "OK";
        }
        else if ($draft[0] == 'restore') {
            // Mengembalikan data jadwal perkuliahan
            $data = array(
                'isDelete' => 0
            );
            $arr2 = array(
                'draft_id_jp' => $draft[1]
            );
            $this->db->update('draft_jadwal_perkuliahan', $data, $arr2);
            echo "OK";
        }
        else if ($draft[0] == 'delete') 
        {
            # Menghapus permanen draft jadwal
            $data = array(
                'draft_id_jp' => $draft[1]
            );
            $this->db->delete('draft_jadwal_perkuliahan',$data);
            $this->db->delete('jadwal_perkuliahan',$data);
            echo "OK";
        }
    }
}
