<?php
class Histori_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        // Your own constructor code
    }

    public function get_histori($table)
    {
    	// $query = $this->db->query('SELECT * FROM dosen');
        if ($table == 'jadwal_temp') 
        {
            $query = $this->db->select(
                // 'jadwal_temp.id_j_t, jadwal_temp.tahun_ajaran, jadwal_temp.peserta,
                'A.id_j_t, A.tahun_ajaran, A.peserta,
                hari.id, hari.nama_hari, 
                waktu.kode_wk, waktu.waktu_aw, waktu.waktu_ak, 
                ruangan.kode_rg, 
                matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, matakuliah.program_studi, matakuliah.peminatan,
                dosen.nid, dosen.nama'
            )
                            ->from('jadwal_temp A')
                            ->where(array('A.isDelete' => 1, 'A.isShow' => 1))
                            ->join('hari', 'hari.id = A.id_hari', 'left')
                            ->join('waktu', 'waktu.kode_wk = A.kode_wk', 'left')
                            ->join('ruangan', 'ruangan.kode_rg = A.kode_rg', 'left')
                            ->join('matakuliah', 'matakuliah.kode_mk = A.kode_mk', 'left')
                            ->join('dosen', 'dosen.nid = A.nid', 'left')
                            ->get();
        }
        else
        {
            $query = $this->db->get_where($table, array('isDelete' => 1, 'isShow' => 1));
        }
    	return $query->result();
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

    public function get_data($table, $arr)
    {
        if ($table == 'jadwal_temp') 
        {
            $query = $this->db->select(
                // 'jadwal_temp.id_j_t, jadwal_temp.tahun_ajaran, jadwal_temp.peserta,
                'A.id_j_t, A.tahun_ajaran, A.peserta,
                hari.id, hari.nama_hari, 
                waktu.kode_wk, waktu.waktu_aw, waktu.waktu_ak, 
                ruangan.kode_rg, 
                matakuliah.kode_mk, matakuliah.nama_mk, matakuliah.sks_mk, matakuliah.semester_mk, matakuliah.program_studi, matakuliah.peminatan,
                dosen.nid, dosen.nama'
            )
                            ->from('jadwal_temp A')
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
}
