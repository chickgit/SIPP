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

	public function generate_jadwal($tahun_ajaran)
	{
		$jadwal = array();
        $tahun_ajaran = $tahun_ajaran;
        /*
        UNTUK MELAKUKAN GENERATE JADWAL PERKULIAHAN SECARA OTOMATIS
        1. HARI
            # PENGAMBILAN DATA HARI DARI DB
            */
            $query_hari         = $this->CI->db->get_where('hari', array('isDelete' => 0, 'isShow' => 1));
            $hasil_hari         = $query_hari->result_array();
            $jadwal             = $hasil_hari;
        /*
        2. WAKTU
            # PENGAMBILAN DATA WAKTU DARI DB
            */
            $query_waktu        = $this->CI->db->get_where('waktu', array('isDelete' => 0, 'isShow' => 1));
            $hasil_waktu        = $query_waktu->result_array();
            /*
            # PENYEMATAN MASING-MASING WAKTU KE SETIAP HARI
                HASIL DI INGINKAN : 
                    SENIN
                        08.00-10.30
                        10.45-13.15
                        13.30-16.00
                        dst
            */
            foreach ($jadwal as $key_jadwal => $value_jadwal) {
                $jadwal[$key_jadwal]['WAKTU'] = $hasil_waktu;
            }
        /*
        3.RUANGAN
            # PENGAMBILAN DATA RUANGAN DARI DB
            */
            $query_ruangan      = $this->CI->db->get_where('ruangan', array('isDelete' => 0, 'isShow' => 1, 'gedung_rg' => 'A'));
            $hasil_ruangan      = $query_ruangan->result_array();
            /*
            # PENYEMATAN MASING-MASING RUANGAN DI SETIAP WAKTU DI SETIAP HARI
                HASIL DI INGINKAN : 
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
            foreach ($jadwal as $key_jadwal => $value_jadwal) {
                foreach ($value_jadwal['WAKTU'] as $key_waktu => $value_waktu) {
                    $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'] = $hasil_ruangan;
                }
            }
        /*
        4. MATA KULIAH
            # PENGAMBILAN DATA MATA KULIAH YANG DIAMBIL MAHASISWA
            */
            $query_matkul_ambil = $this->CI->db->get_where('ambil_matakuliah', array('tahun_ajaran' => $tahun_ajaran,'isDelete' => 0, 'isShow' => 1));
            $hasil_matkul_ambil = $query_matkul_ambil->result_array();

            /*
            # MENJUMLAHKAN MAHASISWA YANG TELAH MENGAMBIL MATA KULIAH
            */
            $matkul = array();
            foreach ($hasil_matkul_ambil as $row) {
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
            /*
            # MEMBUANG MATA KULIAH YANG MEMILIKI MAHASISWA DI BAWAH 5
            */
            foreach ($matkul as $key => $value) {
                if ($value < 5) {
                    unset($matkul[$key]);
                }
            }
            /*
            # PENYATUAN DATA DETAIL MATA KULIAH DAN SISA MATA KULIAH YANG MEMILIKI PESERTA DIATAS 5 BERDASARKAN KODE_MK
            */
            $this->CI->db->where_in('kode_mk',array_keys($matkul));
            $this->CI->db->where('isDelete', 0);
            $this->CI->db->where('isShow', 1);
            $query_matkul       = $this->CI->db->get('matakuliah');
            $hasil_matkul       = $query_matkul->result_array();
            /*
            # MEMASUKKAN JUMLAH MAHASISWA KE DALAM DATA MATA KULIAH
            */
            foreach ($hasil_matkul as $key =>$value) {
                foreach ($matkul as $key_mk => $value_mk) {
                    if ($key_mk == $value['kode_mk']) {
                        $hasil_matkul[$key]['JUMLAH_MHS'] = $value_mk;
                    }
                }
            }
            /*
            # PENYEMATAN MASING-MASING MATA KULIAH SECARA RANDOM KE DALAM SETIAP HARI DI SETIAP WAKTU DI SETIAP RUANGAN DENGAN SYARAT:
                + MASING-MASING RUANGAN HANYA MEMILIKI 1 MATA KULIAH (done)
                + 1 MATA KULIAH HANYA 1X PERTEMUAN (KECUALI EXTENSI) PER PEKAN
                + 1 WAKTU TIDAK BOLEH MEMILIKI BEBERAPA MATA KULIAH DI SETIAP RUANGAN DENGAN SEMESTER YANG SAMA
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
                                MATKUL B SMSTR 1 (TIDAK BOLEH, KARENA MEMILIKI SEMESTER YANG SAMA)

            MASIH ADA KESALAHAN PADA ARRAY SMSTR
            SEHARUSNYA
                1. URUTAN SMSTR TERGANTUNG PADA MATKUL PERTAMA YG MASUK DI ARRAY, TIDAK TERBALIK
                2. BANYAKNYA SMSTR DAN BANYAKNYA MATKUL TERKADANG TIDAK SAMA
            */
            $z = 0;
            while (!empty($hasil_matkul)) #1
            {
                # V1
                // foreach ($jadwal as $key_jadwal => $value_jadwal) #2 => 3
                // {
                //     /*
                //     VALIDASI : JIKA INDEX JADWAL == RANDOM INDEX JADWAL
                //     */
                //     $rand_index_jadwal = array_rand($jadwal);
                //     if ($rand_index_jadwal == $key_jadwal) 
                //     {
                //         foreach ($value_jadwal['WAKTU'] as $key_waktu => $value_waktu) #3 => 2
                //         {
                //             $rand_index_waktu = array_rand($jadwal[$key_jadwal]['WAKTU']);
                //             /*
                //             VALIDASI : 
                //             1. JIKA INDEX WAKTU == RANDOM INDEX WAKTU
                //             2. [TIDAK BOLEH ADA MATKUL MEMILIKI SEMESTER SAMA DALAM 1 WAKTU - SUDAH]
                //             */
                //             if ($rand_index_waktu == $key_waktu) 
                //             {
                //                 foreach ($value_waktu['RUANGAN'] as $key_ruangan => $value_ruangan) #4 => 1
                //                 {
                //                     $rand_index_ruangan = array_rand($jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN']);
                //                     $rand_index_matkul = array_rand($hasil_matkul);
                //                     /*
                //                     VALIDASI : TIDAK BOLEH ADA MATKUL MEMILIKI SMSTR SAMA DALAM 1 WAKTU
                //                     */
                //                     if (isset($value_waktu['SMSTR'])) 
                //                     {
                //                         # code...
                //                         $search_value = $hasil_matkul[$rand_index_matkul]['semester_mk'];


                //                         if (in_array($search_value,$value_waktu['SMSTR']))
                //                         {
                //                             break 3;
                //                         }
                //                         else
                //                         {
                //                             /*
                //                             VALIDASI :
                //                             1. JIKA INDEX RUANGAN ==  RANDOM INDEX RUANGAN
                //                             2. JIKA TERDAPAT RANDOM INDEX MATKUL DALAM ARRAY $HASIL_MATKUL
                //                             3. JENIS RUANGAN(RUANGAN) == JENIS RUANGAN(MATKUL)
                //                             4. KAPASITAS RUANGAN >= JUMLAH MHS MATKUL
                //                             */
                //                             if (($rand_index_ruangan == $key_ruangan) && (array_key_exists($rand_index_matkul, $hasil_matkul)) && ($value_ruangan['jenis_rg'] == $hasil_matkul[$rand_index_matkul]['jenis_rg']) && ($value_ruangan['kapasitas_rg'] >= $hasil_matkul[$rand_index_matkul]['JUMLAH_MHS'])) 
                //                             {
                //                                 $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['SMSTR'][] = $hasil_matkul[$rand_index_matkul]['semester_mk'];
                //                                 $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'][$key_ruangan]['MATKUL'] = $hasil_matkul[$rand_index_matkul];
                //                                 $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'][$key_ruangan]['MATKUL']['YES'] = $z;
                //                                 unset($hasil_matkul[$rand_index_matkul]);
                //                                 $z = $z+1;
                //                                 break 3;
                //                             }

                //                         }
                //                     }
                //                     else
                //                     {
                //                         /*
                //                         VALIDASI :
                //                         1. JIKA INDEX RUANGAN ==  RANDOM INDEX RUANGAN
                //                         2. JIKA TERDAPAT RANDOM INDEX MATKUL DALAM ARRAY $HASIL_MATKUL
                //                         3. JENIS RUANGAN(RUANGAN) == JENIS RUANGAN(MATKUL)
                //                         4. KAPASITAS RUANGAN >= JUMLAH MHS MATKUL
                //                         */
                //                         if (($rand_index_ruangan == $key_ruangan) && (array_key_exists($rand_index_matkul, $hasil_matkul)) && ($value_ruangan['jenis_rg'] == $hasil_matkul[$rand_index_matkul]['jenis_rg']) && ($value_ruangan['kapasitas_rg'] >= $hasil_matkul[$rand_index_matkul]['JUMLAH_MHS'])) 
                //                         {
                //                             $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['SMSTR'][] = $hasil_matkul[$rand_index_matkul]['semester_mk'];
                //                             $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'][$key_ruangan]['MATKUL'] = $hasil_matkul[$rand_index_matkul];
                //                             $jadwal[$key_jadwal]['WAKTU'][$key_waktu]['RUANGAN'][$key_ruangan]['MATKUL']['YES'] = $z;
                //                             unset($hasil_matkul[$rand_index_matkul]);
                //                                 $z = $z+1;
                //                             break 3;
                //                         }
                //                     }
                //                 }
                //             }
                //         }
                //     }
                // }
                # V2
                $rand_hari = array_rand($jadwal);
                $hari = $jadwal[$rand_hari];

                $rand_waktu = array_rand($hari['WAKTU']);
                $waktu = $hari['WAKTU'][$rand_waktu];

                $rand_ruangan = array_rand($waktu['RUANGAN']);
                $ruangan = $waktu['RUANGAN'][$rand_ruangan];
                $tujuan = $jadwal[$rand_hari]['WAKTU'][$rand_waktu]['RUANGAN'][$rand_ruangan];

                $rand_matkul = array_rand($hasil_matkul);
                $matkul = $hasil_matkul[$rand_matkul];

                // 1 WAKTU HANYA MEMILIKI 1 MATKUL UNTUK 1 JENIS SMSTR
                if (isset($waktu['SMSTR']) && !in_array($matkul['semester_mk'], $waktu['SMSTR'])) 
                {
                    //1 RUANGAN 1 MATKUL
                    if (!isset($ruangan['MATKUL'])) 
                    {
                        // JUMLAH MHS TIDAK BOLEH MELEBIHI KAPASITAS RUANGAN
                        if ($ruangan['kapasitas_rg'] >= $matkul['JUMLAH_MHS']) 
                        {
                            // JENIS RUANGAN HARUS SAMA DENGAN JENIS MATKUL
                            if ($ruangan['jenis_rg'] == $matkul['jenis_rg']) 
                            {
                                // MEMASUKKAN MATKUL
                                $jadwal[$rand_hari]['WAKTU'][$rand_waktu]['RUANGAN'][$rand_ruangan]['MATKUL'] = $matkul;
                                $tujuan['MATKUL'] = $matkul;

                                // TANDA UNTUK 1 SMSTR 1 WAKTU
                                $jadwal[$rand_hari]['WAKTU'][$rand_waktu]['SMSTR'][] = $matkul['semester_mk'];
                                unset($hasil_matkul[$rand_matkul]);
                            }
                        }
                    }
                }
                else
                {
                    // JUMLAH MHS TIDAK BOLEH MELEBIHI KAPASITAS RUANGAN
                    if ($ruangan['kapasitas_rg'] >= $matkul['JUMLAH_MHS']) 
                    {
                        // JENIS RUANGAN HARUS SAMA DENGAN JENIS MATKUL
                        if ($ruangan['jenis_rg'] == $matkul['jenis_rg']) 
                        {
                            // MEMASUKKAN MATKUL
                            $jadwal[$rand_hari]['WAKTU'][$rand_waktu]['RUANGAN'][$rand_ruangan]['MATKUL'] = $matkul;
                            $tujuan['MATKUL'] = $matkul;

                            // TANDA UNTUK 1 SMSTR 1 WAKTU
                            $jadwal[$rand_hari]['WAKTU'][$rand_waktu]['SMSTR'][] = $matkul['semester_mk'];
                            unset($hasil_matkul[$rand_matkul]);
                        }
                    }
                }
            }
        /*
        5. FINISHING
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
        return $jadwal;
	}

    function array_solo_random($arr)
    {
        shuffle($arr);
        return $arr[0];
    }

}
