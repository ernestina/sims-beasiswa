<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * data yg perlu diambil
 * - elemen beasiswa
 * - pic
 * - kontrak
 * - penerima beasiswa link surat tugas
 * 
 * data yg dimasukkan
 * - tanggal
 * - pic [nama, foto]
 * - jenis notifikasi
 * - universitas
 * - jurusan
 * - tahun masuk
 * - bulan pembayaran
 * - status pembayaran
 * - link
 * ATURAN NOTIFIKASI
 * - jadup [1 minggu dari bulan selanjutnya]
 * - skripsi [masukin judul]
 * - buku [bulan 3 dan bulan 9]
 * - lulus [1 bulan]
 * - bayar kontrak [tgl_bayar tagihan, mulai sejak direkam]
 */

class Notifikasi{
    
    private $_notif_data = array();
    public $registry;
    private $_db;
    private $_jtemp_jadup = '7 DAY';
    private $_jtemp_buku = '1 MONTH';
    private $_start_buku = array('sem_satu'=>3,'sem_dua'=>9);
    private $_start_lulus = '1 MONTH';


    public function __construct(Registry $registry) {
        $this->registry = $registry;
        $this->_db = $registry->db;
    }
    
    /*
     * ambil semua data jadup
     * ambil semua data surat tugas
     * cek keberadaan sp2d di data jadup > jika tidak ada > status proses
     * cek kesesuaian pembayaran terakhir dengan data surat tugas > jika ada yg belum, buat data baru > status belum
     */
    private function get_data_jadup(){
        
//        $sql = "SELECT KD_ST FROM d_srt_tugas WHERE TGL_SEL_ST>NOW()";
//        echo $sql;
        $d_st = $this->get_list_kode_st(true);
        $now = date('Y-m');
        $now .= "-1";
        $next_month = date('Y-m-d',strtotime('+1 MONTH',strtotime($now)));
//        var_dump($next_month);
        foreach ($d_st as $val){
            $kd_st = $val['KD_ST'];
            $d_bulan = $this->get_bulan_surat_tugas($kd_st);
            foreach ($d_bulan as $bulan){
                $cek_proses = $this->cek_telah_bayar_elem(1,$bulan, $kd_st);
                $notif = new NotifikasiDao();
                $cek_bulan = strtotime($bulan."-01")==strtotime($next_month);
                if($cek_proses){ //jika data telah ada 
                    $cek_bayar = $this->cek_telah_bayar_elem(1,$bulan, $kd_st,true);
//                    var_dump($cek_bayar);
                    $d_proses = $this->get_jadup_by_st($kd_st,$bulan);
//                    var_dump($d_proses);
                    if(!$cek_bayar){ //jika data sp2d belum diisi
//                        if($cek_bulan){
//                            $is_notif = $this->is_write_notif('jadup', $bulan."-01");
//                            if($is_notif){
                                $notif->set_jatuh_tempo($bulan);
                                $notif->set_jenis_notif($d_proses->get_jenis_notif());
                                $notif->set_jurusan($d_proses->get_jurusan());
                                $notif->set_kode_link($d_proses->get_kode_link());
                                $notif->set_link($d_proses->get_link());
                                $notif->set_pic($d_proses->get_pic());
                                $notif->set_status_notif($d_proses->get_status_notif());
                                $notif->set_tahun_masuk($d_proses->get_tahun_masuk());
                                $notif->set_univ($d_proses->get_univ());
                                $pic = $notif->get_pic();
//                                echo $pic['kode']." ".$kd_st."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                                $this->_notif_data[] = $notif;
//                            }
//                        }else{
//                            $notif->set_jatuh_tempo($bulan);
//                            $notif->set_jenis_notif($d_proses->get_jenis_notif());
//                            $notif->set_jurusan($d_proses->get_jurusan());
//                            $notif->set_kode_link($d_proses->get_kode_link());
//                            $notif->set_link($d_proses->get_link());
//                            $notif->set_pic($d_proses->get_pic());
//                            $notif->set_status_notif($d_proses->get_status_notif());
//                            $notif->set_tahun_masuk($d_proses->get_tahun_masuk());
//                            $notif->set_univ($d_proses->get_univ());
//    //                        echo $kd_st."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
//                            $this->_notif_data[] = $notif;
//                        }
                        
                    }
                }else{ //jika data tidak ada
                    $st = new SuratTugas($this->registry);
                    $st->set_kd_st($kd_st);
                    $d_st = $st->get_surat_tugas_by_id($st);

                    $notif->set_jatuh_tempo($bulan);
                    $notif->set_jenis_notif('jadup');
                    /** jurusan **/
                    $jur = new Jurusan($this->registry);
                    $jur->set_kode_jur($d_st->get_jur());
                    $d_jur = $jur->get_jur_by_id($jur);
                    $notif->set_jurusan($d_jur->get_nama());
                    $notif->set_kode_link('');
                    $notif->set_link('');
                    $notif->set_status_notif('belum');
                    $notif->set_tahun_masuk($d_st->get_th_masuk());
                    /** universitas **/
                    $fakul = new Fakultas($this->registry);
                    $fakul->set_kode_fakul($d_jur->get_kode_fakul());
                    $d_fakul = $fakul->get_fakul_by_id($fakul);
                    $univ = new Universitas($this->registry);
                    $univ->set_kode_in($d_fakul->get_kode_univ());
                    $d_univ = $univ->get_univ_by_id($univ);
                    $notif->set_univ($d_univ->get_kode());
                    /** pic **/
                    $pic = new User($this->registry);
                    $d_pic = $pic->getUser_id($d_univ->get_pic());
                    $pic_arr = array('kode'=>$d_pic->get_id(),
                                    'nama'=>$d_pic->get_nmUser(),
                                    'foto'=>$d_pic->get_foto());
                    $notif->set_pic($pic_arr);
                    if($cek_bulan){
                        $is_notif = $this->is_write_notif('jadup', $bulan."-01");
                        if($is_notif){
//                            echo $kd_st."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                            $this->_notif_data[] = $notif;
                        }
                    }else{
//                        echo $kd_st."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                        $this->_notif_data[] = $notif;
                    }
                    
                }
            }
        }
        
    }
    
    private function get_bulan_surat_tugas($kd_st,$is_semester=false){
        $sql = "SELECT MONTH(TGL_MUL_ST) as BLN_MUL, 
            (SELECT EXTRACT(YEAR FROM TGL_MUL_ST)) as THN_MUL, 
            MONTH(TGL_SEL_ST) as BLN_SEL, 
            (SELECT EXTRACT(YEAR FROM TGL_SEL_ST)) as THN_SEL 
            FROM d_srt_tugas WHERE KD_ST=".$kd_st;
//        echo $sql."</br>";
        $d_bulan = $this->_db->select($sql);
        $bln_mul = null;
        $bln_sel = null;
        foreach ($d_bulan as $v){
            $bln_mul = $v['THN_MUL'].'-'.$v['BLN_MUL'];
            $bln_sel = $v['THN_SEL'].'-'.$v['BLN_SEL'];
        }
//        echo $bln_mul."-".$bln_sel;
        $d_bulan = array();
        $cek_bulan = true;
        $curr_bulan = date('Y-m');
        $next_curr_bulan = date('Y-m',strtotime('+1 month',  strtotime($curr_bulan)));
        while($cek_bulan){
            if($is_semester){
                $temp = explode("-",$bln_mul);
                $bulan = (int) $temp[1];
//                echo $bulan."</br>";
//                $is_sem_satu = $bulan==$this->_start_buku['sem_satu'];
//                $is_sem_dua = $bulan==$this->_start_buku['sem_dua'];
                $is_semester_satu= ($bulan>7 || $bulan<2);
                $is_semester_dua = ($bulan>1 && $bulan<8);
//                var_dump($is_semester_dua); echo $bulan."</br>";
                if($is_semester_satu){
                    $tahun = (int) $temp[0];
                    if($bulan<2) $tahun--;
                    $semester = $tahun."-1";
                    
//                    echo $kd_st."-".$bln_mul."</br>";
                    //ada cek dulu apakah ada di array d_bulan, jika tidak ada tambahkan
                    
                }elseif($is_semester_dua){
                    $semester = $temp[0]."-2";
                }
                $data_exist = in_array($semester, $d_bulan);
                if(!$data_exist) $d_bulan[] = $semester;
            }else{
                $d_bulan[] = $bln_mul;
            }
            
            $bln_mul = date('Y-m',  strtotime('+1 month',  strtotime($bln_mul))); //tambahkan 1 bulan
            $stop = $bln_mul == $next_curr_bulan; //cek kapan berhenti
            if($stop){
                $cek_bulan=false;
                if(!$is_semester) $d_bulan[] = $bln_mul; //tambahkan lagi untuk mengisi bulan setelah bulan berjalan
                break;
            }
        }
        return $d_bulan;
    }

    //tambahin kd_user
    private function get_jadup_by_st($kd_st,$bulan=null){
        if(!is_null($bulan)){
            $bln_bayar = explode("-",$bulan);
        }
        $sql = "SELECT  
            a.KD_D_ELEM_BEASISWA as KODE,";
        $sql .= "b.NM_ELEM_BEASISWA as NAMA,
            a.JML_PEG_D_ELEM_BEASISWA as JML_PEG,
            CONCAT(a.BLN_D_ELEM_BEASISWA,'-',a.THN_D_ELEM_BEASISWA) as BULAN,
            a.TOTAL_BAYAR_D_ELEM_BEASISWA as TOTAL_BAYAR,
            e.THN_MASUK as THN_MASUK,
            f.NM_JUR as NM_JUR,
            h.SINGKAT_UNIV as UNIV,
            a.NO_SP2D_D_ELEM_BEASISWA as SP2D,
            e.KD_ST as ST,
            e.THN_MASUK as THN_MASUK,
            i.NM_USER as NM_USER,
            i.KD_USER as KD_USER,
            i.FOTO_USER as FOTO,
            e.TGL_SEL_ST as TGL_SEL_ST,
            MONTH(NOW()) as CURR_BULAN,
            'jadup' as JENIS
            FROM d_elemen_beasiswa a
            LEFT JOIN t_elem_beasiswa c ON a.KD_D_ELEM_BEASISWA=c.KD_D_ELEM_BEASISWA
            LEFT JOIN d_pb d ON c.KD_PB=d.KD_PB
            LEFT JOIN d_srt_tugas e ON d.KD_ST=e.KD_ST
            LEFT JOIN r_jur f ON e.KD_JUR=f.KD_JUR
            LEFT JOIN r_fakul g ON f.KD_FAKUL=g.KD_FAKUL
            LEFT JOIN r_univ h ON g.KD_UNIV=h.KD_UNIV 
            LEFT JOIN d_user i ON h.KD_USER=i.KD_USER
            LEFT JOIN r_elem_beasiswa b ON a.KD_R_ELEM_BEASISWA=b.KD_R_ELEM_BEASISWA
            WHERE b.KD_R_ELEM_BEASISWA=1 AND e.KD_ST=".$kd_st." AND e.TGL_MUL_ST<CURRENT_DATE() AND e.TGL_SEL_ST>CURRENT_DATE()";
        if(!is_null($bulan)){
            $sql .= " AND a.BLN_D_ELEM_BEASISWA=".$bln_bayar[1]." AND a.THN_D_ELEM_BEASISWA=".$bln_bayar[0];
        }
        $sql .= " GROUP BY a.KD_D_ELEM_BEASISWA";
//        echo $sql."</br>";
        $d_jadup = $this->_db->select($sql);
        if(!is_null($bulan)) $notif = new NotifikasiDao();
        foreach ($d_jadup as $val){
            if(is_null($bulan)) $notif = new NotifikasiDao();
            $pic = array('kode'=>$val['KD_USER'],
                        'nama'=>$val['NM_USER'],
                        'foto'=>$val['FOTO_USER']);
            $jth_tempo = date('Y-m-d');
            $notif->set_jatuh_tempo($jth_tempo);
            $notif->set_jenis_notif($val['JENIS']);
            $notif->set_jurusan($val['NM_JUR']);
            $notif->set_kode_link($val['KODE']);
            $notif->set_pic($pic);
            $sts = $val['SP2D']==''?'proses':'selesai';
            $notif->set_status_notif($sts);
            $notif->set_tahun_masuk($val['THN_MASUK']);
            $notif->set_univ($val['UNIV']);
            $notif->set_link('');
            if(is_null($bulan)){
                $this->_notif_data[] = $notif;
            }
            
        }
        
        if(!is_null($bulan)) return $notif;
    }


    /*
     * ambil semua data mahasiswa
     * ambil semua data bayar skripsi
     * cek keberadaan sp2d di data jadup > jika tidak ada > status proses
     * cek kesesuaian data bayar dengan judul skripsi mahasiswa, jika tidak ada buat data baru > status belum
     */
    private function get_data_skripsi(){
        /*
        * - tanggal
        * - pic [nama, foto]
        * - jenis notifikasi
        * - universitas
        * - jurusan
        * - tahun masuk
        * - bulan pembayaran
        * - status pembayaran
        * - link
        * data return nantinya akan digrup per ST, jika terdapat data, tampilkan notif sesuai dengan ST
        */
        $data_skripsi = array();
        $sql = "SELECT a.KD_PB as KD_PB,
            a.NM_PB as NM_PB,
            a.JUDUL_SKRIPSI_PB as JUDUL_SKRIPSI_PB,
            b.KD_ST as KD_ST,
            b.THN_MASUK as THN_MASUK,
            b.TGL_SEL_ST as TGL_SEL_ST,
            c.NM_JUR as NM_JUR,
            e.SINGKAT_UNIV as SINGKAT_UNIV,
            f.KD_USER as KD_USER,
            f.NM_USER as NM_USER,
            f.FOTO_USER as FOTO_USER,
            'skripsi' as JENIS
            FROM d_pb a 
            LEFT JOIN d_srt_tugas b ON a.KD_ST=b.KD_ST
            LEFT JOIN r_jur c ON b.KD_JUR=c.KD_JUR
            LEFT JOIN r_fakul d ON c.KD_FAKUL=d.KD_FAKUL
            LEFT JOIN r_univ e ON d.KD_UNIV=e.KD_UNIV
            LEFT JOIN d_user f ON e.KD_USER=f.KD_USER WHERE a.JUDUL_SKRIPSI_PB<>'' AND a.JUDUL_SKRIPSI_PB IS NOT NULL
            AND b.KD_PEMB=1";
//        echo $sql."</br>";
        $d_skripsi = $this->_db->select($sql);
        foreach($d_skripsi as $skripsi){
            $judul_skripsi = $skripsi['JUDUL_SKRIPSI_PB'];
            $kd_pb = $skripsi['KD_PB'];
            $kd_st = $skripsi['KD_ST'];
            $sudah_ta = $judul_skripsi!='' && $judul_skripsi!=NULL;
            $cek_proses = $this->cek_telah_bayar_elem(3,$kd_pb, $kd_st);
//            var_dump($cek_proses);
            if($sudah_ta){
                $notif = new NotifikasiDao();
                $jatuh_tempo = strtotime('-1 MONTH', strtotime($skripsi['TGL_SEL_ST']));
//                var_dump($skripsi['TGL_SEL_ST']);var_dump(date('Y-m-d',$jatuh_tempo));
                $notif->set_jatuh_tempo(date('Y-m-d',$jatuh_tempo));
                $notif->set_jenis_notif($skripsi['JENIS']);
                $notif->set_jurusan($skripsi['NM_JUR']);
                $notif->set_kode_link($kd_st);
                $notif->set_link('');
                $pic = array('kode'=>$skripsi['KD_USER'],'nama'=>$skripsi['NM_USER'],'foto'=>$skripsi['FOTO_USER']);
                $notif->set_pic($pic);
                $notif->set_tahun_masuk($skripsi['THN_MASUK']);
                $notif->set_univ($skripsi['SINGKAT_UNIV']);
                
                if($cek_proses){ //jika ditemukan data pembayaran
                    $cek_selesai = $this->cek_telah_bayar_elem(3,$kd_pb, $kd_st,true);
//                    var_dump($cek_selesai);
                    if(!$cek_selesai){ //jika data sp2d telah ada
                        $notif->set_status_notif('proses');
//                        echo $kd_st."-".$skripsi['NM_PB']."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."-".$skripsi['KD_USER']."</br>";
                        $data_skripsi[]=$notif;
                    }
                }else{ // jika data tidak ditemukan 
                    $notif->set_status_notif('belum');
//                echo $kd_st."-".$skripsi['NM_PB']."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                    $data_skripsi[]=$notif;
                }
            }
            
        }
        $this->grouping_notif_skripsi_per_st($data_skripsi);
//        return $data_skripsi; 
    }
    
    private function grouping_notif_skripsi_per_st($data = array()){
        if(!is_array($data)) return false;
        $st = null;
        $count = count($data);
        for($i=0;$i<$count;$i++){
            $st_sama = $data[$i]->get_kode_link()==$st;
            if(is_null($st) || !$st_sama){
                $notif = new NotifikasiDao();
                $notif->set_jatuh_tempo($data[$i]->get_jatuh_tempo());
                $notif->set_jenis_notif($data[$i]->get_jenis_notif());
                $notif->set_jurusan($data[$i]->get_jurusan());
                $notif->set_kode_link($data[$i]->get_kode_link);
                $notif->set_link($data[$i]->get_link());
//                $pic = array('kode'=>$skripsi['KD_USER'],'nama'=>$skripsi['NM_USER'],'foto'=>$skripsi['FOTO_USER']);
                $notif->set_pic($data[$i]->get_pic());
                $notif->set_status_notif($data[$i]->get_status_notif());
                $notif->set_tahun_masuk($data[$i]->get_tahun_masuk());
                $notif->set_univ($data[$i]->get_univ());
                $this->_notif_data[]=$notif;
                $st = $data[$i]->get_kode_link();
            }
            
        }
    }
    
    private function get_list_kode_st($is_selesai=false){
        $sql = "SELECT KD_ST FROM d_srt_tugas";
        if($is_selesai){
            $sql .= " WHERE TGL_MUL_ST<NOW() AND TGL_SEL_ST>NOW() AND KD_PEMB=1";
        }else{
            $sql .= " WHERE KD_PEMB=1";
        }
        
//        echo $sql;
        $d_st = $this->_db->select($sql);
        return $d_st;
    }
    
    /*
     * 
     */
    private function get_data_buku(){
        $d_st = $this->get_list_kode_st(true);
        $now = date('Y-m');
        $now .= "-1";
        $next_month = date('Y-m-d',strtotime('+1 MONTH',strtotime($now)));
        foreach ($d_st as $st){
            $kd_st = $st['KD_ST'];
//            print_r($kd_st);
            $d_bulan = $this->get_bulan_surat_tugas($kd_st,true);
//            print_r($d_bulan);
            foreach ($d_bulan as $bulan){
                $cek_proses = $this->cek_telah_bayar_elem(2, $bulan, $kd_st);
//                echo $bulan; var_dump($cek_proses);
                $cek_bayar = $this->cek_telah_bayar_elem(2, $bulan, $kd_st,true);
                $tmp = explode("-",$bulan);
                $month = $tmp[1]==1?3:9;
                $tanggal_akhir = date('Y-m-d',strtotime($tmp[0]."-".$month."-1"));
//                var_dump(date('Y-m-d',$tanggal_akhir));
                $cek_bulan = strtotime($tanggal_akhir)==strtotime($next_month);
                if($cek_proses){
                    if(!$cek_bayar){
                        $notif = $this->get_data_buku_by_st($kd_st, $bulan);
                        $notif->set_link($bulan);
                        $notif->set_status_notif('proses');
//                        echo $kd_st."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
//                        print_r($notif);
                        $this->_notif_data[] = $notif;
                    }
                }else{
                    $notif = new NotifikasiDao();
                    $st = new SuratTugas($this->registry);
                    $st->set_kd_st($kd_st);
                    $d_st = $st->get_surat_tugas_by_id($st);
                    $notif->set_jatuh_tempo($bulan);
                    $notif->set_jenis_notif('buku');
                    /** jurusan **/
                    $jur = new Jurusan($this->registry);
                    $jur->set_kode_jur($d_st->get_jur());
                    $d_jur = $jur->get_jur_by_id($jur);
                    $notif->set_jurusan($d_jur->get_nama());
                    $notif->set_kode_link('');
                    $notif->set_link($bulan);
                    $notif->set_status_notif('belum');
                    $notif->set_tahun_masuk($d_st->get_th_masuk());
                    /** universitas **/
                    $fakul = new Fakultas($this->registry);
                    $fakul->set_kode_fakul($d_jur->get_kode_fakul());
                    $d_fakul = $fakul->get_fakul_by_id($fakul);
                    $univ = new Universitas($this->registry);
                    $univ->set_kode_in($d_fakul->get_kode_univ());
                    $d_univ = $univ->get_univ_by_id($univ);
                    $notif->set_univ($d_univ->get_kode());
                    /** pic **/
                    $pic = new User($this->registry);
                    $d_pic = $pic->getUser_id($d_univ->get_pic());
                    $pic_arr = array('kode'=>$d_pic->get_id(),
                                    'nama'=>$d_pic->get_nmUser(),
                                    'foto'=>$d_pic->get_foto());
                    $notif->set_pic($pic_arr);
//                    
                    if($cek_bulan){
                        $is_notif = $this->is_write_notif('buku', $tanggal_akhir);
                        if($is_notif){
//                            echo $kd_st."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                            $this->_notif_data[] = $notif;
                        }
                    }else{
//                        echo $kd_st."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                        $this->_notif_data[] = $notif;
                    }
                    
                }
            }
        }
    }
    
    private function get_data_buku_by_st($kd_st,$bulan=null){
        if(!is_null($bulan)){
            $bln_bayar = explode("-",$bulan);
        }
        $sql = "SELECT  
            a.KD_D_ELEM_BEASISWA as KODE,";
        $sql .= "b.NM_ELEM_BEASISWA as NAMA,
            a.JML_PEG_D_ELEM_BEASISWA as JML_PEG,
            CONCAT(a.THN_D_ELEM_BEASISWA,'-',a.BLN_D_ELEM_BEASISWA) as BULAN,
            a.TOTAL_BAYAR_D_ELEM_BEASISWA as TOTAL_BAYAR,
            e.THN_MASUK as THN_MASUK,
            f.NM_JUR as NM_JUR,
            h.SINGKAT_UNIV as UNIV,
            a.NO_SP2D_D_ELEM_BEASISWA as SP2D,
            e.KD_ST as ST,
            e.THN_MASUK as THN_MASUK,
            i.NM_USER as NM_USER,
            i.KD_USER as KD_USER,
            i.FOTO_USER as FOTO,
            MONTH(NOW()) as CURR_BULAN,
            'buku' as JENIS
            FROM d_elemen_beasiswa a
            LEFT JOIN r_elem_beasiswa b ON a.KD_R_ELEM_BEASISWA=b.KD_R_ELEM_BEASISWA
            LEFT JOIN t_elem_beasiswa c ON a.KD_D_ELEM_BEASISWA=c.KD_D_ELEM_BEASISWA
            LEFT JOIN d_pb d ON c.KD_PB=d.KD_PB
            LEFT JOIN d_srt_tugas e ON d.KD_ST=e.KD_ST
            LEFT JOIN r_jur f ON e.KD_JUR=f.KD_JUR
            LEFT JOIN r_fakul g ON f.KD_FAKUL=g.KD_FAKUL
            LEFT JOIN r_univ h ON g.KD_UNIV=h.KD_UNIV 
            LEFT JOIN d_user i ON h.KD_USER=i.KD_USER
            WHERE b.KD_R_ELEM_BEASISWA=2 AND e.KD_ST=".$kd_st;
        if(!is_null($bulan)){
            $sql .= " AND a.BLN_D_ELEM_BEASISWA=".$bln_bayar[1]." AND a.THN_D_ELEM_BEASISWA=".$bln_bayar[0];
        }
//        $sql .= " AND e.KD_PEMB>1";
//        echo $sql."</br>";
        $d_jadup = $this->_db->select($sql);
        if(!is_null($bulan)) $notif = new NotifikasiDao();
        foreach ($d_jadup as $val){
            if(is_null($bulan)) $notif = new NotifikasiDao();
            $pic = array('kode'=>$val['KD_USER'],
                        'nama'=>$val['NM_USER'],
                        'foto'=>$val['FOTO_USER']);
            $jth_tempo = date('Y-m-d');
            $notif->set_jatuh_tempo($val['BULAN']);
            $notif->set_jenis_notif($val['JENIS']);
            $notif->set_jurusan($val['NM_JUR']);
            $notif->set_kode_link($val['KODE']);
            $notif->set_pic($pic);
            $sts = $val['SP2D']==''?'proses':'selesai';
            $notif->set_status_notif($sts);
            $notif->set_tahun_masuk($val['THN_MASUK']);
            $notif->set_univ($val['UNIV']);
            $notif->set_link('');
            if(is_null($bulan)){
                $this->_notif_data[] = $notif;
            }
            
        }
        
        if(!is_null($bulan)) return $notif;
    }
    
    private function cek_telah_bayar_elem($kode_elem, $month,$surat_tugas,$cek_sp2d=false){
        if($kode_elem!=3) $month = explode("-",$month);
        $sql = "SELECT a.KD_D_ELEM_BEASISWA as KD_D_ELEM_BEASISWA, 
                a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_ELEM_BEASISWA,
                d.KD_PEMB as KD_PEMB
                FROM d_elemen_beasiswa a 
                LEFT JOIN t_elem_beasiswa b ON a.KD_D_ELEM_BEASISWA = b.KD_D_ELEM_BEASISWA
                LEFT JOIN d_pb c ON b.KD_PB = c.KD_PB
                LEFT JOIN d_srt_tugas d ON c.KD_ST = d.KD_ST
                WHERE a.BLN_D_ELEM_BEASISWA=".$month[1]." AND THN_D_ELEM_BEASISWA=".$month[0]." AND d.KD_ST=".$surat_tugas." AND KD_R_ELEM_BEASISWA=$kode_elem";
        if($kode_elem==3){
            $sql = "SELECT a.KD_D_ELEM_BEASISWA as KD_D_ELEM_BEASISWA, 
                a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_ELEM_BEASISWA
                FROM d_elemen_beasiswa a 
                LEFT JOIN t_elem_beasiswa b ON a.KD_D_ELEM_BEASISWA = b.KD_D_ELEM_BEASISWA
                LEFT JOIN d_pb c ON b.KD_PB = c.KD_PB
                LEFT JOIN d_srt_tugas d ON c.KD_ST = d.KD_ST
                WHERE b.KD_PB=".$month." AND d.KD_ST=".$surat_tugas." AND KD_R_ELEM_BEASISWA=$kode_elem";
        }
        if($cek_sp2d){
            $sql .= " AND a.NO_SP2D_D_ELEM_BEASISWA<>'' AND a.NO_SP2D_D_ELEM_BEASISWA IS NOT NULL";
//            echo $sql."</br>";
        }
//        echo $sql."</br>";
        $d_elem = $this->_db->select($sql);
//        foreach ($d_elem as $elem){
//            $eksternal = ((int) $elem['KD_PEMB'])>1;
//            if($eksternal) return true;
//        }
        $d_cek = count($d_elem);
//        if($kode_elem==3){
//            $sql = "SELECT KD_PB FROM d_pb WHERE KD_ST=".$surat_tugas;
//            $d_itung = count($this->_db->select($sql));
//            if($d_cek==$d_itung){
//                return true;
//            }else{
//                return false;
//            }
//        }
        
//        echo $d_cek."</br>";
        return $d_cek>0?true:false;
    }
    
    private function get_data_kontrak(){
        /*
        * - tanggal
        * - pic [nama, foto]
        * - jenis notifikasi
        * - universitas
        * - jurusan
        * - tahun masuk
        * - bulan pembayaran
        * - status pembayaran
        * - link
        */
        $sql = "SELECT 
            a.KD_KON as KD_KON,
            g.KD_ST as KD_ST,
            a.KD_TAGIHAN as KD_TAGIHAN,
            a.NM_TAGIHAN as NM_TAGIHAN,
            a.JADWAL_BAYAR_TAGIHAN as DATE_BAYAR,
            (a.BIAYA_PER_PEG_TAGIHAN*a.JML_PEG_BAYAR_TAGIHAN) as BIAYA,
            c.NM_JUR as NM_JUR,
            e.SINGKAT_UNIV as SINGKAT_UNIV,
            a.STS_TAGIHAN as STS_TAGIHAN,
            DATEDIFF(a.JADWAL_BAYAR_TAGIHAN,DATE(NOW())) as SELISIH,
            f.NM_USER as NM_USER,
            f.KD_USER as KD_USER,
            f.FOTO_USER as FOTO,
            g.THN_MASUK as THN_MASUK,
            'kontrak' as JENIS
            FROM  d_tagihan a
            LEFT JOIN d_kontrak b ON a.KD_KON=b.KD_KON
            LEFT JOIN r_jur c ON b.KD_JUR=c.KD_JUR
            LEFT JOIN r_fakul d ON c.KD_FAKUL=d.KD_FAKUL
            LEFT JOIN r_univ e ON d.KD_UNIV=e.KD_UNIV
            LEFT JOIN d_user f ON e.KD_USER=f.KD_USER
            LEFT JOIN d_srt_tugas g ON c.KD_JUR=g.KD_JUR
            ";
//        echo $sql;
        $d_kontrak = $this->_db->select($sql);
        foreach($d_kontrak as $kontrak){
            $sel_bayar = $kontrak['STS_TAGIHAN']=='selesai';
            if(!$sel_bayar){
//                var_dump($kontrak['DATE_BAYAR']);
                $is_notif = $this->is_write_notif('kontrak', $kontrak['DATE_BAYAR']);
//                var_dump($is_notif);
                if($is_notif){
                    $notif = new NotifikasiDao();
                    $notif->set_jenis_notif($kontrak['JENIS']);
                    $notif->set_jurusan($kontrak['NM_JUR']);
                    $notif->set_kode_link('');
                    $notif->set_link($kontrak['SELISIH']);
                    $pic = array('kode'=>$kontrak['KD_USER'],'nama'=>$kontrak['NM_USER'],'foto'=>$kontrak['FOTO']);
                    $notif->set_pic($pic);
                    $notif->set_status_notif($kontrak['STS_TAGIHAN']);
                    $notif->set_tahun_masuk($kontrak['THN_MASUK']);
                    $notif->set_univ($kontrak['SINGKAT_UNIV']);
                    $notif->set_jatuh_tempo($kontrak['DATE_BAYAR']);
                    $this->_notif_data[] = $notif;
//                    echo $kontrak['KD_ST']."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                }
            }
        }
    }
    /*
     * join d_pb dan d_srt_tugas dan d_univ dan d_user
     * d_pb :
     * d_srt_tugas :
     * d_univ :
     * d_user :
     * 
     */
    private function get_data_surat_tugas(){
        /*
        * - tanggal
        * - pic [nama, foto]
        * - jenis notifikasi
        * - universitas
        * - jurusan
        * - tahun masuk
        * - bulan pembayaran
        * - status pembayaran
        * - link
        */
        $sql = "SELECT
            a.KD_ST as KD_ST,
            a.TGL_SEL_ST as TGL_SEL_ST,
            a.THN_MASUK as THN_MASUK,
            c.NM_JUR as NM_JUR,
            e.SINGKAT_UNIV as SINGKAT_UNIV,
            f.NM_USER as NM_USER,
            f.KD_USER as KD_USER,
            f.FOTO_USER as FOTO,
            DATEDIFF(a.TGL_SEL_ST,DATE(NOW())) as SELISIH,
            'lulus' as JENIS
            FROM d_srt_tugas a 
            LEFT JOIN r_jur c ON a.KD_JUR=c.KD_JUR
            LEFT JOIN r_fakul d ON c.KD_FAKUL=d.KD_FAKUL
            LEFT JOIN r_univ e ON d.KD_UNIV=e.KD_UNIV
            LEFT JOIN d_user f ON e.KD_USER=f.KD_USER
            WHERE a.TGL_SEL_ST > NOW()";
//        echo $sql;
        $d_st = $this->_db->select($sql);
        foreach ($d_st as $st){
            $notif = new NotifikasiDao();
//            $sebulan = $st['SELISIH']<31;
            $is_notif = $this->is_write_notif('lulus',$st['TGL_SEL_ST']);
//            var_dump($is_notif);
            $notif->set_jenis_notif($st['JENIS']);
            $notif->set_jurusan($st['NM_JUR']);
            $notif->set_kode_link('');
            $notif->set_link($st['SELISIH']);
            $pic = array('kode'=>$st['KD_USER'],'nama'=>$st['NM_USER'],'foto'=>$st['FOTO']);
            $notif->set_pic($pic);
            $notif->set_status_notif('proses');
            $notif->set_tahun_masuk($st['THN_MASUK']);
            $notif->set_univ($st['SINGKAT_UNIV']);
            $notif->set_jatuh_tempo($st['TGL_SEL_ST']);
            
            if($is_notif){
//                echo $kontrak['KD_ST']."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                $complete = $this->is_complete_gradute_st($st['KD_ST']);
//                var_dump($complete);
                if(!$complete){
                    $this->_notif_data[] = $notif;
                }
            }else{
                $complete = $this->is_complete_gradute_st($st['KD_ST']);
                $now = strtotime(date('Y-m-d')); //echo $now.':'.date('Y-m-d');
                $selesai = strtotime($st['TGL_SEL_ST']);//echo "-".$selesai.':'.$st['TGL_SEL_ST'];
                $is_lewat = $now>$selesai;                //var_dump($is_lewat);
                if($is_lewat){
                    if(!$complete){
//                        echo $kontrak['KD_ST']."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                        $this->_notif_data[] = $notif;
                    } 
                }
            }
        }
    }
    
    /*
     * selisih bulan
     */
    private function diff_month($endDate,$startDate){
        $end = explode('-', $endDate);
        $start = explode('-',$startDate);
//        $format_ymd_end = count($end)==3;
//        $format_ymd_start = count($start)==3;
        $month_end = (int) $end[1];
        $month_start = (int) $start[1];
        $year_end = (int) $end[0];
        $year_start = (int) $start[0];
        $same_year = $year_end-$year_start==0;
        $month_diff = $month_end-$month_start;
        if($same_year){
            if($month_diff<0) return "bulan awal melebihi bulan akhir, cek kembali parameter fungsi";
            return $month_diff;
        }
        $year_diff = $year_end-$year_start;
        if($year_diff<0) return "tahun awal melebihi tahun akhir, cek kembali parameter fungsi";
        $month_diff = $month_diff+($year_diff*12);
        return $month_diff;
        
    }
    
    /*
     * mendapatkan notifikasi data
     */
    public function get_notifikasi(){
        $this->get_data_jadup();
        $this->get_data_skripsi();
        $this->get_data_buku();
        $this->get_data_surat_tugas();
        $this->get_data_kontrak();
//        echo "jumlah notifikasi : ".count($this->_notif_data)."</br>";
//        echo "data notifikasi : </br>";
//        $this->dump_data();
//        $this->union_data();
//        echo $this->diff_month('2014-11', date('Y-m-d'));
        $this->_notif_data = $this->sort_data_notif();
        return $this->_notif_data;
    }
    
    private function dump_data(){
        foreach ($this->_notif_data as $v){
            $pic = $v->get_pic();
//            echo $v->get_jenis_notif().":".$v->get_status_notif().":".$v->get_jatuh_tempo().":".$v->get_tahun_masuk().":".$v->get_univ().":".$v->get_link().":".$pic['kode']."</br>";
        }
    }
    
    /*
     * pengurutan
     */
    private function sort_data_notif(){
        $return = $this->_notif_data;
        $count_data = count($return);
        for($i=0;$i<$count_data;$i++){
            $time_i = $this->jatuh_tempo_to_time($return[$i]);
            for($j=0;$j<$count_data;$j++){
                $time_j = $this->jatuh_tempo_to_time($return[$j]);
                $less_than = $time_j<$time_i;
                if($less_than){
                    $tmp = $return[$i];
                    $return[$i] = $return[$j];
                    $return[$j] = $tmp;
                }
            }
        }
//        $return = array();
//        $tmp_data = $this->create_data_sort($this->_notif_data);
//        ksort($tmp_data);
//        foreach ($tmp_data as $key=>$value){
//            $return[] = $value;
//        }
        return $return;
    }
    
    private function jatuh_tempo_to_time($data){
        $jatuh_tempo = $data->get_jatuh_tempo();
        $tmp = explode("-",$jatuh_tempo);
        $is_buku = $data->get_jenis_notif()=='buku'; 
        if($is_buku){
            $bulan = $tmp[1]==1?9:3;
            $date = $tmp[0]."-".$bulan."-01";
//                $v->set_jatuh_tempo($date);
            $jatuh_tempo = date('Y-m-d',  strtotime($date));
        }else{
            if(count($tmp)<3){
                $date = $jatuh_tempo ."-01";
//                    $v->set_jatuh_tempo($date);
                $jatuh_tempo = date('Y-m-d',  strtotime($date));
            }
        }
        
        return strtotime($jatuh_tempo);
    }
    
    /*
     * membuat temporari data, agar bisa diurutkan
     */
    public function create_data_sort($data){
        $strtime_array = array();
//        $no = 1;
        foreach ($data as $v){
            $jatuh_tempo = $v->get_jatuh_tempo();
            $tmp = explode("-",$jatuh_tempo);
            $is_buku = $v->get_jenis_notif()=='buku'; 
            if($is_buku){
                $bulan = $tmp[1]==1?9:3;
                $date = $tmp[0]."-".$bulan."-01";
//                $v->set_jatuh_tempo($date);
                $jatuh_tempo = date('Y-m-d',  strtotime($date));
            }else{
                if(count($tmp)<3){
                    $date = $jatuh_tempo ."-01";
//                    $v->set_jatuh_tempo($date);
                    $jatuh_tempo = date('Y-m-d',  strtotime($date));
                }
            }
            $tgl = strtotime($jatuh_tempo);
//            print_r($v);echo "</br>";
            $strtime_array[$tgl] = $v;
//            $no++;
        }
        return $strtime_array;
    }
    
    /*
     * bulan jadup terakhir dibayarkan
     */
    public function cek_bulan_bayar_jadup_terakhir($kode_st){
        $sql = "SELECT CONCAT(a.THN_D_ELEM_BEASISWA,'-',a.BLN_D_ELEM_BEASISWA) as BULAN
            FROM d_elemen_beasiswa a 
            LEFT JOIN t_elem_beasiswa b ON a.KD_D_ELEM_BEASISWA=b.KD_D_ELEM_BEASISWA
            LEFT JOIN d_pb c ON b.KD_PB = c.KD_PB
            LEFT JOIN d_srt_tugas d ON c.KD_ST=d.KD_ST
            WHERE d.KD_ST=".$kode_st;
        $d_bulan = $this->_db->select($sql);
//        echo date('Y-m')." dr fungsi date".  date('Y-m',strtotime('+1 month',  strtotime(date('Y-m'))))."</br>";
        $bln_tagih = strtotime('+1 month',  strtotime(date('Y-m')));
        $bln_tagih = date('Y-m',$bln_tagih);
//        echo $bln_tagih."</br>";
        $return = 0;
        $data_size = count($d_bulan)>0;
        if($data_size){
            $tmp = 0;
            foreach ($d_bulan as $val){
                $bln_terakhir = strtotime($val['BULAN']) > $tmp;
                if($bln_terakhir){
                    $return = $val['BULAN'];
                    $tmp = strtotime($val['BULAN']);
                }else{
                    $return = date('Y-m',$tmp);
                }
            }
        }
        return $return==0?false:$return;
    }
    
    /*
     * cek apakah akan memunculkan data notifikasi terakhir
     * sesuai jenis notif
     * Kontrak,  : 1 bulan
     * Tunjangan Hidup, : 2 minggu
     * Tunjangan Buku, : 1 minggu
     * Tunjangan Skripsi, : 1 Minggu
     * Selesainya masa tugas belajar penerima beasiswa : 2 minggu
     * selesai cuti sama dengan pembayaran jadup
     */
    private function is_write_notif($jenis_notif, $tanggal_akhir){
        $str_time = strtotime($tanggal_akhir);
        $now = strtotime(date('Y-m-d'));
        $return = false;
        switch($jenis_notif){
            case "kontrak":
                $duedate = strtotime('-1 MONTH', $str_time);
                break;
            case "jadup":
                $duedate = strtotime('-14 DAY', $str_time);
                break;
            case "buku":
                $duedate = strtotime('-7 DAY', $str_time);
                break;
            case "skripsi":
                $duedate = strtotime('-1 MONTH', $str_time);
                break;
            case "lulus":
                $duedate = strtotime('-14 DAY', $str_time);
                break;
            case "cuti":
                $duedate = strtotime('-14 DAY', $str_time);
                break;
            default:
                return false;
        }
        
        $is_notif = $now>=$duedate;
        if($is_notif) return true;
        
        return false;
    }
    
    /*
     * cek pb sudah lulus semua di st
     * dari kolom tanggal lapor
     */
    public function is_complete_gradute_st($kd_st){
        $sql = "SELECT KD_PB,TGL_LAPOR_PB FROM d_pb WHERE KD_ST=".$kd_st;
        $count=0;
        $d_pb = $this->_db->select($sql);
        foreach($d_pb as $pb){
            $tgl_lapor = $pb['TGL_LAPOR_PB'];
            $cek_st_child = $this->cek_st_child($pb['KD_PB'], $kd_st);
            $is_lapor = ($tgl_lapor!='')&&($tgl_lapor!=null);
            if(!$is_lapor){
                if(!$cek_st_child){
                    $count++;
                }
            }
        }
        return $count>0?false:true;
    }
    
    /*
     * cek apakah st memiliki child->perpanjangan
     */
    private function cek_st_child($kd_pb,$st){
        $sql = "SELECT a.KD_PB, b.KD_ST FROM d_pb a 
                LEFT JOIN d_srt_tugas b ON a.KD_PB=b.KD_PB
                WHERE a.KD_PB=".$kd_pb." AND b.KD_ST_LAMA=".$st;
        $d_child = $this->_db->select($sql);
        $count = count($d_child);
        if($count>0) return true;
        return false;
    }
}
?>
