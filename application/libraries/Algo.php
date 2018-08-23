<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Algo{

	public function __construct()
    {
    	// parent::__construct();
        // Assign the CodeIgniter super-object
        $this->CI =& get_instance();
    	
        $this->CI->load->database();
    	$this->CI->load->library('session');
    	if (!$this->CI->session->has_userdata('Login')) {
			redirect(base_url().'login');
    	}

        $this->CI->load->model('dosen_model');
    }

    private function json_view($arr = array())
    {
    	print_r(json_encode($arr));
    }

    private function hasil($table)
    {
        $query         = $this->CI->db->get_where($table, array('isDelete' => 0, 'isShow' => 1));
        $hasil         = $query->result_array();
        return $hasil;
    }

    private function dosen_raw()
    {
        $dosen = $this->hasil('dosen');

        foreach ($dosen as $key_dosen => $value_dosen) {
            $dosen_dosen = array();
            // $dosen_dosen
            $dosen[$key_dosen]['ketersediaan_hari'] = explode(';', $value_dosen['ketersediaan_hari']);
            $a = explode(';', $value_dosen['wawasan_matkul']);
            foreach ($a as $key => $value) {
                $b = explode('_', $value);
                $wawasan_matkul[] = $b[0];
            }
            $dosen[$key_dosen]['wawasan_matkul'] = $wawasan_matkul;
            unset($wawasan_matkul);
        }

        return $dosen;
    }

    private function matkul_raw($tahun_ajaran)
    {
        # PENGAMBILAN DATA MATA KULIAH YANG DIAMBIL MAHASISWA
        $query = $this->CI->db->get_where('ambil_matakuliah', array('tahun_ajaran' => $tahun_ajaran,'isDelete' => 0, 'isShow' => 1));
        $hasil = $query->result_array();

        # MENJUMLAHKAN MAHASISWA YANG TELAH MENGAMBIL MATA KULIAH
        $matkul = array();
        foreach ($hasil as $row) {
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

        # MEMBUANG MATA KULIAH YANG MEMILIKI MAHASISWA DI BAWAH 5
        foreach ($matkul as $key => $value) {
            if ($value < 5) {
                unset($matkul[$key]);
            }
        }

        # PENYATUAN DATA DETAIL MATA KULIAH DAN SISA MATA KULIAH YANG MEMILIKI PESERTA DIATAS 5 BERDASARKAN KODE_MK
        $this->CI->db->where_in('kode_mk',array_keys($matkul));
        $this->CI->db->where('isDelete', 0);
        $this->CI->db->where('isShow', 1);
        $query = $this->CI->db->get('matakuliah');
        $hasil = $query->result_array();

        # MEMASUKKAN JUMLAH MAHASISWA KE SETIAP DATA MATA KULIAH
        foreach ($hasil as $key =>$value) {
            foreach ($matkul as $key_mk => $value_mk) {
                if ($key_mk == $value['kode_mk']) {
                    $hasil[$key]['JUMLAH_MHS'] = $value_mk;
                }
            }
        }

        return $hasil;
    }

    private function jadwal_raw()
    {
        $jadwal     = array();
        # 1. HARI
        $hari       = $this->hasil('hari');
        # 2. DOSEN
        $dosen      = $this->dosen_raw();
        # 3. WAKTU
        $waktu      = $this->hasil('waktu');
        # 4. RUANGAN
        $ruangan    = $this->hasil('ruangan');

        $jadwal = $hari;
        foreach ($jadwal as $key_jadwal => $value_jadwal) {
            /*
            # penyematan masing-masing waktu ke setiap hari | hasil di inginkan:
                SENIN
                    08.00-10.30
                    10.45-13.15
                    13.30-16.00
                    dst
            */
            $jadwal[$key_jadwal]['WAKTU'] = $waktu;

            foreach ($jadwal[$key_jadwal]['WAKTU'] as $key_waktu => $value_waktu) {
                /*
                # penyematan masing-masing ruangan di setiap waktu di setiap hari | hasil di inginkan:
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
                $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'] = $ruangan;

                # memasukkan batasan semester di setiap hari
                $jadwal[$key_jadwal]['SMSTR'] = array(
                    "PP" => array(),
                    "PS" => array(),
                    "SS" => array()
                );
            }

            foreach ($dosen as $key_dosen => $value_dosen) {
                if (in_array($value_jadwal['id'], $value_dosen['ketersediaan_hari'])) {
                    # memasukkan kesiapan dosen di setiap hari
                    $jadwal[$key_jadwal]['DOSEN_SIAP'][] = array(
                        "nid"       => $value_dosen['nid'],
                        "wawasan"   => $value_dosen['wawasan_matkul'],
                        "flag_role" => array()
                    );
                }
            }
        }

        return $jadwal;
    }

    public function jadwal($jadwal,$matkul)
    {
        /*
        # PENYEMATAN MASING-MASING MATA KULIAH SECARA RANDOM KE DALAM SETIAP HARI DI SETIAP WAKTU DI SETIAP RUANGAN DENGAN SYARAT:
            + (DONE)MASING-MASING RUANGAN HANYA MEMILIKI 1 MATA KULIAH
            + 1 MATA KULIAH HANYA 1X PERTEMUAN (KECUALI EXTENSI) PER PEKAN
            + (DONE)1 WAKTU TIDAK BOLEH MEMILIKI MATA KULIAH LEBIH DARI SATU DENGAN SEMESTER YANG SAMA MESKIPUN BERBEDA RUANGAN
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
                            MATKUL B SMSTR 1 
            + 1 waktu tidak boleh memiliki mata kuliah lebih dari satu dengan dosen yang sama meskipun beda ruangan
                E.G : 08.00-10.30
                        LR-1
                            MATKUL A DOSEN X
                        LR-2
                            MATKUL B DOSEN X (TIDAK BOLEH, KARENA MEMILIKI SEMESTER YANG SAMA)
                     SEHARUSNYA
                     08.00-10.30
                        LR-1
                            MATKUL A DOSEN X
                     10.45-13.15
                        LR-2
                            MATKUL B DOSEN Y 

        */
        $x = 0;
        # PENJABARAN MATKUL
        foreach ($matkul as $key_mk => $value_mk) 
        {
            # PENJABARAN JADWAL MENJADI HARI
            foreach ($jadwal as $key_jw => $value_hr) 
            {
                # PENJABARAN DOSEN
                foreach ($value_hr['DOSEN_SIAP'] as $key_dosen => $value_dosen) 
                {
                    # PENJABARAN HARI MENJADI WAKTU
                    foreach ($value_hr['WAKTU'] as $key_wk => $value_wk) 
                    {
                        # PENJABARAN WAKTU MENJADI RUANGAN
                        foreach ($value_wk['RUANGAN'] as $key_rg => $value_rg) 
                        {
                            # CEK APAKAH DOSEN TERSEDIA PADA HARI INI
                            if (in_array($value_mk['kode_mk'], $value_dosen['wawasan'])) 
                            {
                                # SKS WAKTU SAMA DENGAN SKS MATKUL
                                if ($value_wk['sks'] == $value_mk['sks_mk']) 
                                {
                                    # 1 ROLE WAKTU(PP/PS/SS) HANYA MEMILIKI 1 MATKUL UNTUK 1 SMSTR
                                    # CEK APAKAH TERDAPAT ROLE WAKTU DI ARRAY SMSTR
                                    if (array_key_exists($value_wk['role'], $value_hr['SMSTR'])) 
                                    {
                                        # CEK APAKAH SUDAH ADA SEMESTER YANG DIAMBIL DALAM ROLE TSB
                                        if (!in_array($value_mk['semester_mk'], $value_hr['SMSTR'][$value_wk['role']])) 
                                        {
                                            # 1 RUANGAN 1 MATKUL
                                            if (!isset($value_rg['MATKUL'])) 
                                            {
                                                # JUMLAH MHS TIDAK BOLEH MELEBIHI KAPASITAS RUANGAN
                                                if ($value_rg['kapasitas_rg'] >= $value_mk['JUMLAH_MHS'])
                                                {
                                                    # JENIS RUANGAN HARUS SAMA DENGAN JENIS MATKUL
                                                    if ($value_rg['jenis_rg'] == $value_mk['jenis_rg'])
                                                    {
                                                        # CEK APAKAH MATKUL TERSEDIA DI ARRAY
                                                        if (isset($matkul[$key_mk])) 
                                                        {
                                                                    $x++;
                                                            # MEMASUKKAN MATKUL
                                                            $jadwal[$key_jw]['WAKTU'][$key_wk]['RUANGAN'][$key_rg]['MATKUL'] = $matkul[$key_mk];
                                                            // $jadwal[$key_jw]['WAKTU'][$key_wk]['RUANGAN'][$key_rg]['MATKUL'] = $value_mk;
                                                            // $tujuan['MATKUL'] = $matkul;

                                                            # MEMASUKKAN DOSEN
                                                            $jadwal[$key_jw]['WAKTU'][$key_wk]['RUANGAN'][$key_rg]['DOSEN'] = $value_dosen['nid'];

                                                            # TANDA UNTUK 1 SMSTR 1 WAKTU
                                                            array_push($jadwal[$key_jw]['SMSTR'][$value_wk['role']], $value_mk['semester_mk']);

                                                            # Hapus matkul dari array matkul
                                                            unset($matkul[$key_mk]);

                                                            # Hapus kesiapan dosen dari array jadwal
                                                            foreach ($jadwal as $key_jw2 => $value_hr2) 
                                                            {
                                                                foreach ($value_hr2['DOSEN_SIAP'] as $key_dosen2 => $value_dosen2) 
                                                                {
                                                                    foreach ($value_dosen2['wawasan'] as $key_wwsn => $value_wwsn) 
                                                                    {
                                                                        if (($value_dosen['nid'] == $value_dosen2['nid']) && ($value_wwsn == $value_mk['kode_mk'])) 
                                                                        {
                                                                            unset($jadwal[$key_jw2]['DOSEN_SIAP'][$key_dosen2]['wawasan'][$key_wwsn]);
                                                                        }
                                                                    }

                                                                    if (empty($value_dosen2['wawasan'])) 
                                                                    {
                                                                        unset($jadwal[$key_jw2]['DOSEN_SIAP'][$key_dosen2]);
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            
                        }
                    }
                }
            }
        }

        if (isset($matkul)) {
            # code...
            $jadwal['FLAG_TERTINGGAL'] = $matkul;
            unset($matkul);
        }
        return $jadwal;
    }

	public function generate_jadwal($tahun_ajaran, $semester_mk)
	{
        $jadwal_raw     = $this->jadwal_raw();                  //Generate jadwal frame(kasarnya)
        $matkul         = $this->matkul_raw($tahun_ajaran);     //Generate matkul frame(kasarnya)
        return $jadwal_raw;
        $hasil_jadwal   = $this->jadwal($jadwal_raw,$matkul);   //Generate jadwal | combine jadwal_raw & matkul

        $start = microtime(true);
        $time_elapsed_secs = microtime(true) - $start;
        $hasil_jadwal[0][0] = $time_elapsed_secs;

        return $hasil_jadwal;

        
        // $z = 0;
        // while (!empty($hasil_matkul)) #1
        // {
        //     # V1
        //         // foreach ($jadwal as $key_jadwal => $value_jadwal) #2 => 3
        //         // {
        //         //     /*
        //         //     VALIDASI : JIKA INDEX JADWAL == RANDOM INDEX JADWAL
        //         //     */
        //         //     $rand_index_jadwal = array_rand($jadwal);
        //         //     if ($rand_index_jadwal == $key_jadwal) 
        //         //     {
        //         //         foreach ($value_jadwal['WAKTU'] as $key_waktu => $value_waktu) #3 => 2
        //         //         {
        //         //             $rand_index_waktu = array_rand($jadwal[$key_jadwal]['WAKTU']);
        //         //             /*
        //         //             VALIDASI : 
        //         //             1. JIKA INDEX WAKTU == RANDOM INDEX WAKTU
        //         //             2. [TIDAK BOLEH ADA MATKUL MEMILIKI SEMESTER SAMA DALAM 1 WAKTU - SUDAH]
        //         //             */
        //         //             if ($rand_index_waktu == $key_waktu) 
        //         //             {
        //         //                 foreach ($value_waktu['RUANGAN'] as $key_ruangan => $value_ruangan) #4 => 1
        //         //                 {
        //         //                     $rand_index_ruangan = array_rand($jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN']);
        //         //                     $rand_index_matkul = array_rand($hasil_matkul);
        //         //                     /*
        //         //                     VALIDASI : TIDAK BOLEH ADA MATKUL MEMILIKI SMSTR SAMA DALAM 1 WAKTU
        //         //                     */
        //         //                     if (isset($value_waktu['SMSTR'])) 
        //         //                     {
        //         //                         # code...
        //         //                         $search_value = $hasil_matkul[$rand_index_matkul]['semester_mk'];


        //         //                         if (in_array($search_value,$value_waktu['SMSTR']))
        //         //                         {
        //         //                             break 3;
        //         //                         }
        //         //                         else
        //         //                         {
        //         //                             /*
        //         //                             VALIDASI :
        //         //                             1. JIKA INDEX RUANGAN ==  RANDOM INDEX RUANGAN
        //         //                             2. JIKA TERDAPAT RANDOM INDEX MATKUL DALAM ARRAY $HASIL_MATKUL
        //         //                             3. JENIS RUANGAN(RUANGAN) == JENIS RUANGAN(MATKUL)
        //         //                             4. KAPASITAS RUANGAN >= JUMLAH MHS MATKUL
        //         //                             */
        //         //                             if (($rand_index_ruangan == $key_ruangan) && (array_key_exists($rand_index_matkul, $hasil_matkul)) && ($value_ruangan['jenis_rg'] == $hasil_matkul[$rand_index_matkul]['jenis_rg']) && ($value_ruangan['kapasitas_rg'] >= $hasil_matkul[$rand_index_matkul]['JUMLAH_MHS'])) 
        //         //                             {
        //         //                                 $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['SMSTR'][] = $hasil_matkul[$rand_index_matkul]['semester_mk'];
        //         //                                 $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'][$key_ruangan]['MATKUL'] = $hasil_matkul[$rand_index_matkul];
        //         //                                 $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'][$key_ruangan]['MATKUL']['YES'] = $z;
        //         //                                 unset($hasil_matkul[$rand_index_matkul]);
        //         //                                 $z = $z+1;
        //         //                                 break 3;
        //         //                             }

        //         //                         }
        //         //                     }
        //         //                     else
        //         //                     {
        //         //                         /*
        //         //                         VALIDASI :
        //         //                         1. JIKA INDEX RUANGAN ==  RANDOM INDEX RUANGAN
        //         //                         2. JIKA TERDAPAT RANDOM INDEX MATKUL DALAM ARRAY $HASIL_MATKUL
        //         //                         3. JENIS RUANGAN(RUANGAN) == JENIS RUANGAN(MATKUL)
        //         //                         4. KAPASITAS RUANGAN >= JUMLAH MHS MATKUL
        //         //                         */
        //         //                         if (($rand_index_ruangan == $key_ruangan) && (array_key_exists($rand_index_matkul, $hasil_matkul)) && ($value_ruangan['jenis_rg'] == $hasil_matkul[$rand_index_matkul]['jenis_rg']) && ($value_ruangan['kapasitas_rg'] >= $hasil_matkul[$rand_index_matkul]['JUMLAH_MHS'])) 
        //         //                         {
        //         //                             $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['SMSTR'][] = $hasil_matkul[$rand_index_matkul]['semester_mk'];
        //         //                             $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'][$key_ruangan]['MATKUL'] = $hasil_matkul[$rand_index_matkul];
        //         //                             $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'][$key_ruangan]['MATKUL']['YES'] = $z;
        //         //                             unset($hasil_matkul[$rand_index_matkul]);
        //         //                                 $z = $z+1;
        //         //                             break 3;
        //         //                         }
        //         //                     }
        //         //                 }
        //         //             }
        //         //         }
        //         //     }
        //         // }
        //     # V2
        //         // $rand_hari = array_rand($jadwal);
        //         // $hari = $jadwal[$rand_hari];

        //         // $rand_waktu = array_rand($hari['WAKTU']);
        //         // $waktu = $hari['WAKTU'][$rand_waktu];

        //         // $rand_ruangan = array_rand($waktu['RUANGAN']);
        //         // $ruangan = $waktu['RUANGAN'][$rand_ruangan];
        //         // $tujuan = $jadwal[$rand_hari]['WAKTU'][$rand_waktu]['RUANGAN'][$rand_ruangan];

        //         // $rand_matkul = array_rand($hasil_matkul);
        //         // $matkul = $hasil_matkul[$rand_matkul];

        //         // // SKS WAKTU SAMA DENGAN SKS MATKUL | LOOPING SANGAT LAMA KARENA MENGGUNAKAN RANDOM
        //         // // if ($waktu['sks'] == $matkul['sks_mk']) {
        //         // // if (in_array($waktu['kode_wk'], $matkul['PELUANG_WK'])) {
        //         //     // 1 WAKTU HANYA MEMILIKI 1 MATKUL UNTUK 1 JENIS SMSTR
        //         //     if (isset($waktu['SMSTR']) && !in_array($matkul['semester_mk'], $waktu['SMSTR'])) 
        //         //     {
        //         //         //1 RUANGAN 1 MATKUL
        //         //         if (!isset($ruangan['MATKUL'])) 
        //         //         {
        //         //             // JUMLAH MHS TIDAK BOLEH MELEBIHI KAPASITAS RUANGAN
        //         //             if ($ruangan['kapasitas_rg'] >= $matkul['JUMLAH_MHS']) 
        //         //             {
        //         //                 // JENIS RUANGAN HARUS SAMA DENGAN JENIS MATKUL
        //         //                 if ($ruangan['jenis_rg'] == $matkul['jenis_rg']) 
        //         //                 {
        //         //                     // MEMASUKKAN MATKUL
        //         //                     $jadwal[$rand_hari]['WAKTU'][$rand_waktu]['RUANGAN'][$rand_ruangan]['MATKUL'] = $matkul;
        //         //                     // $tujuan['MATKUL'] = $matkul;

        //         //                     // TANDA UNTUK 1 SMSTR 1 WAKTU
        //         //                     $jadwal[$rand_hari]['WAKTU'][$rand_waktu]['SMSTR'][] = $matkul['semester_mk'];
        //         //                     unset($hasil_matkul[$rand_matkul]);
        //         //                 }
        //         //             }
        //         //         }
        //         //     }
        //         // }
        //         // else
        //         // {
        //             // // JUMLAH MHS TIDAK BOLEH MELEBIHI KAPASITAS RUANGAN
        //             // if ($ruangan['kapasitas_rg'] >= $matkul['JUMLAH_MHS']) 
        //             // {
        //             //     // JENIS RUANGAN HARUS SAMA DENGAN JENIS MATKUL
        //             //     if ($ruangan['jenis_rg'] == $matkul['jenis_rg']) 
        //             //     {
        //             //         // MEMASUKKAN MATKUL
        //             //         $jadwal[$rand_hari]['WAKTU'][$rand_waktu]['RUANGAN'][$rand_ruangan]['MATKUL'] = $matkul;
        //             //         // $tujuan['MATKUL'] = $matkul;

        //             //         // TANDA UNTUK 1 SMSTR 1 WAKTU
        //             //         $jadwal[$rand_hari]['WAKTU'][$rand_waktu]['SMSTR'][] = $matkul['semester_mk'];
        //             //         unset($hasil_matkul[$rand_matkul]);
        //             //     }
        //             // }
        //         // }
        //     # V3
        //         //         $count_mk = count($hasil_matkul);
        //         //         $count_mk_0 = 0;

        //         //         # PENJABARAN MATKUL
        //         //         foreach ($hasil_matkul as $key_mk => $value_mk) {

        //         //             # PENJABARAN JADWAL MENJADI HARI
        //         //             foreach ($jadwal as $key_jw => $value_hr) {

        //         //                     // return $value_dosen;
        //         //                 # CEK APAKAH DOSEN TERSEDIA PADA HARI INI
        //         //                 foreach ($value_hr['DOSEN_SIAP'] as $key_dosen => $value_dosen) {
        //         //                     // return $value_hr;
        //         //                     if (in_array($value_mk['kode_mk'], $value_dosen['wawasan'])) {

        //         //                         # PENJABARAN HARI MENJADI WAKTU
        //         //                         foreach ($value_hr['WAKTU'] as $key_wk => $value_wk) {

        //         //                             # SKS WAKTU SAMA DENGAN SKS MATKUL
        //         //                             if ($value_wk['sks'] == $value_mk['sks_mk']) {

        //         //                                 # 1 ROLE WAKTU(PP/PS/SS) HANYA MEMILIKI 1 MATKUL UNTUK 1 SMSTR
        //         //                                 // $cth = array("PP" => array(1,3,5),"PS" => array(1,3),"SS" => array(1,7));
        //         //                                 // foreach ($cth as $key => $value) {
        //         //                                 //     # code...
        //         //                                 //     // return $key;
        //         //                                 // }
        //         //                                 // return $hasil_matkul;
        //         //                                 # CEK APAKAH TERDAPAT ROLE WAKTU DI ARRAY SMSTR
        //         //                                 if (array_key_exists($value_wk['role'], $value_hr['SMSTR'])) {
        //         //                                     # CEK APAKAH SUDAH ADA SEMESTER YANG DIAMBIL DALAM ROLE TSB
        //         //                                     if (!in_array($value_mk['semester_mk'], $value_hr['SMSTR'][$value_wk['role']])) {
        //         //                                     // if (!in_array($value_mk['semester_mk'], $value_hr['SMSTR'])) {

        //         //                                         # PENJABARAN WAKTU MENJADI RUANGAN
        //         //                                         foreach ($value_wk['RUANGAN'] as $key_rg => $value_rg) {

        //         //                                             # 1 RUANGAN 1 MATKUL
        //         //                                             if (!isset($value_rg['MATKUL'])) {

        //         //                                                 # JUMLAH MHS TIDAK BOLEH MELEBIHI KAPASITAS RUANGAN
        //         //                                                 if ($value_rg['kapasitas_rg'] >= $value_mk['JUMLAH_MHS']){

        //         //                                                     # JENIS RUANGAN HARUS SAMA DENGAN JENIS MATKUL
        //         //                                                     if ($value_rg['jenis_rg'] == $value_mk['jenis_rg']){

        //         //                                                         # MEMASUKKAN MATKUL
        //         //                                                         $jadwal[$key_jw]['WAKTU'][$key_wk]['RUANGAN'][$key_rg]['MATKUL'] = $value_mk;
        //         //                                                         // $tujuan['MATKUL'] = $matkul;

        //         //                                                         # MEMASUKKAN DOSEN
        //         //                                                         $jadwal[$key_jw]['WAKTU'][$key_wk]['RUANGAN'][$key_rg]['DOSEN'] = $value_dosen['nid'];

        //         //                                                         # TANDA UNTUK 1 SMSTR 1 WAKTU
        //         //                                                         array_push($jadwal[$key_jw]['SMSTR'][$value_wk['role']], $value_mk['semester_mk']);
        //         //                                                         // $jadwal[$key_jw]['SMSTR'][] = $value_wk['role'].'_'.$value_mk['semester_mk'];
        //         //                                             // return $jadwal;
        //         //                                                         unset($hasil_matkul[$key_mk]);
        //         //                                                         // unset($hasil_matkul);
        //         //                                                         // $count_mk_0++;
        //         //                                                         break 4;
        //         //                                                         // return $jadwal;
        //         //                                                     }
        //         //                                                 }
        //         //                                             }
        //         //                                         }
        //         //                                     // }
        //         //                                     }
        //         //                                 }
        //         //                             }
        //         //                         }
        //         //                     }
        //         //                 }
        //         //             }
        //         //         }
        //         //         // if ($count_mk_0 >= 60) {
        //         //         //     if (isset($hasil_matkul)) {
        //         //         //         $jadwal['FLAG_TERTINGGAL'][] = $hasil_matkul;
        //         //         //         unset($hasil_matkul);
        //         //         //     }
        //         //         // }
        //         //                                             // return $hasil_matkul;
        //         //         $batas_smstr = array("PP"=>array(), "PS"=>array(), "SS"=>array());
        //         //                     // return $batas_smstr[0];
        //         //         // $batas_smstr['PP']++;
        //         //         foreach ($jadwal as $key_jw => $value_jw) {
        //         //             foreach ($value_jw['SMSTR'] as $key_smstr => $value_smstr) {
        //         //                 foreach ($value_smstr as $key => $value) {
        //         //                     foreach ($batas_smstr as $key_batas => $value_batas) {
        //         //                         if ($key_batas == $key_smstr) {
        //         //                             if (array_key_exists((int)$value, $batas_smstr[$key_batas])) {
        //         //                                 $batas_smstr[$key_batas][$value]++;
        //         //                             }else{
        //         //                                 $batas_smstr[$key_batas][$value] = 1;
        //         //                             }
        //         //                         }
        //         //                     }
        //         //                 }
        //         //             }
        //         //         }
        //         //                             return $batas_smstr;

        //         //         if (isset($hasil_matkul)) {
        //         //             # code...
        //         //             foreach ($hasil_matkul as $key_mk => $value_mk) {
        //         //                 # code...
        //         //                 if ((isset($value_batas[$value_mk['semester_mk']])) && 
        //         //                     ($value_batas[$value_mk['semester_mk']] == count($hasil_hari))) {

        //         //                     $jadwal['FLAG_TERTINGGAL'][] = $value_mk;
        //         //                     unset($hasil_matkul[$key_mk]);
        //         //                 }
        //         //             }
        //         //         }
        // }
        /*
        6. FINISHING
            MEMBUANG DATA YANG TIDAK DI BUTUHKAN
            */
            // foreach ($jadwal as $key_jadwal => $value_jadwal) {
            //     foreach ($value_jadwal['WAKTU'] as $key_waktu => $value_waktu) {
            //         foreach ($value_waktu['RUANGAN'] as $key_ruangan => $value_ruangan) {
            //             if (!isset($value_ruangan['MATKUL'])) 
            //             {
            //                 unset($jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'][$key_ruangan]);
            //             }
            //         }
            //     }
            // }
        /*
        SELESAI
        */
        // $this->json_view($jadwal);
        // $this->json_view($final);
        // $this->json_view(count($final));
        // $this->json_view(count($hasil_matkul));
        // $this->json_view($hasil_matkul[array_rand($hasil_matkul,1)]);
        // set_time_limit(5);
        // $time_elapsed_secs = microtime(true) - $start;
        // $jadwal[0][0] = $time_elapsed_secs;
        // return $jadwal[0];
	}

    function array_solo_random($arr)
    {
        shuffle($arr);
        return $arr[0];
    }

}
