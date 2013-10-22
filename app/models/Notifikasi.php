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
    private $_jtemp_buku = '1_MONTH';
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
        
        foreach ($d_st as $val){
            $kd_st = $val['KD_ST'];
            $d_bulan = $this->get_bulan_surat_tugas($kd_st);
            foreach ($d_bulan as $bulan){
//                echo $bulan;
//                $tahun = substr($bulan, 0,4);
//                $bulan_num = substr($bulan,5,2);
                $cek_proses = $this->cek_telah_bayar_elem(1,$bulan, $kd_st);
//                var_dump($cek_proses);
//                echo "</br>";
//                $this->get_jadup_by_st($kd_st);
                $notif = new NotifikasiDao();
                if($cek_proses){ //jika data telah ada 
                    $cek_bayar = $this->cek_telah_bayar_elem(1,$bulan, $kd_st,true);
                    $d_proses = $this->get_jadup_by_st($kd_st,$bulan);
                    if(!$cek_bayar){ //jika data sp2d belum diisi
                        $notif->set_jatuh_tempo($bulan);
                        $notif->set_jenis_notif($d_proses->get_jenis_notif());
                        $notif->set_jurusan($d_proses->get_jurusan());
                        $notif->set_kode_link($d_proses->get_kode_link());
                        $notif->set_link($d_proses->get_link());
                        $notif->set_pic($d_proses->get_pic());
                        $notif->set_status_notif($d_proses->get_status_notif());
                        $notif->set_tahun_masuk($d_proses->get_tahun_masuk());
                        $notif->set_univ($d_proses->get_univ());
//                        echo $kd_st."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                        $this->_notif_data[] = $notif;
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
                    $notif->set_univ($d_univ->get_nama());
                    /** pic **/
                    $pic = new User($this->registry);
                    $d_pic = $pic->getUser_id($d_univ->get_pic());
                    $pic_arr = array('kode'=>$d_pic->get_id(),
                                    'nama'=>$d_pic->get_nmUser(),
                                    'foto'=>$d_pic->get_foto());
                    $notif->set_pic($pic_arr);
//                    echo $kd_st."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                    $this->_notif_data[] = $notif;
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
                $bulan = $temp[1];
                $is_sem_satu = $bulan==$this->_start_buku['sem_satu'];
                $is_sem_dua = $bulan==$this->_start_buku['sem_dua']; 
                if($is_sem_satu || $is_sem_dua){
//                    echo $kd_st."-".$bln_mul."</br>";
                    $d_bulan[] = $bln_mul;
                }
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
            h.NM_UNIV as UNIV,
            a.NO_SP2D_D_ELEM_BEASISWA as SP2D,
            e.KD_ST as ST,
            e.THN_MASUK as THN_MASUK,
            i.NM_USER as NM_USER,
            i.KD_USER as KD_USER,
            i.FOTO_USER as FOTO,
            MONTH(NOW()) as CURR_BULAN,
            'jadup' as JENIS
            FROM d_elemen_beasiswa a
            LEFT JOIN r_elem_beasiswa b ON a.KD_R_ELEM_BEASISWA=b.KD_R_ELEM_BEASISWA
            LEFT JOIN t_elem_beasiswa c ON a.KD_D_ELEM_BEASISWA=c.KD_D_ELEM_BEASISWA
            LEFT JOIN d_pb d ON c.KD_PB=d.KD_PB
            LEFT JOIN d_srt_tugas e ON d.KD_ST=e.KD_ST
            LEFT JOIN r_jur f ON d.KD_JUR=d.KD_JUR
            LEFT JOIN r_fakul g ON f.KD_FAKUL=g.KD_FAKUL
            LEFT JOIN r_univ h ON g.KD_UNIV=h.KD_UNIV 
            LEFT JOIN d_user i ON h.KD_USER=i.KD_USER
            WHERE b.KD_R_ELEM_BEASISWA=1 AND e.KD_ST=".$kd_st;
        if(!is_null($bulan)){
            $sql .= " AND a.BLN_D_ELEM_BEASISWA=".$bln_bayar[1]." AND a.THN_D_ELEM_BEASISWA=".$bln_bayar[0];
        }
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
            e.NM_UNIV as NM_UNIV,
            f.KD_USER as KD_USER,
            f.NM_USER as NM_USER,
            f.FOTO_USER as FOTO_USER,
            'skripsi' as JENIS
            FROM d_pb a 
            LEFT JOIN d_srt_tugas b ON a.KD_ST=b.KD_ST
            LEFT JOIN r_jur c ON b.KD_JUR=c.KD_JUR
            LEFT JOIN r_fakul d ON c.KD_FAKUL=d.KD_FAKUL
            LEFT JOIN r_univ e ON d.KD_UNIV=e.KD_UNIV
            LEFT JOIN d_user f ON e.KD_USER=f.KD_USER";
//        echo $sql."</br>";
        $d_skripsi = $this->_db->select($sql);
        foreach($d_skripsi as $skripsi){
            $judul_skripsi = $skripsi['JUDUL_SKRIPSI_PB'];
            $kd_pb = $skripsi['KD_PB'];
            $kd_st = $skripsi['KD_ST'];
            $sudah_ta = $judul_skripsi!='' && $judul_skripsi!=NULL;
            $cek_proses = $this->cek_telah_bayar_elem(3,$kd_pb, $kd_st);
            if($sudah_ta){
                $notif = new NotifikasiDao();
                $notif->set_jatuh_tempo($skripsi['TGL_SEL_ST']);
                $notif->set_jenis_notif($skripsi['JENIS']);
                $notif->set_jurusan($skripsi['NM_JUR']);
                $notif->set_kode_link($kd_st);
                $notif->set_link('');
                $pic = array('kode'=>$skripsi['KD_USER'],'nama'=>$skripsi['NM_USER'],'foto'=>$skripsi['FOTO_USER']);
                $notif->set_pic($pic);
                $notif->set_tahun_masuk($skripsi['THN_MASUK']);
                $notif->set_univ($skripsi['NM_UNIV']);
                
                if($cek_proses){ //jika ditemukan data pembayaran
                    $cek_selesai = $this->cek_telah_bayar_elem(3,$kd_pb, $kd_st,true);
                    if(!$cek_selesai){ //jika data sp2d telah ada
                        $notif->set_status_notif('proses');
    //                    echo $kd_st."-".$skripsi['NM_PB']."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
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
                $notif->set_status_notif('');
                $notif->set_tahun_masuk($data[$i]->get_tahun_masuk());
                $notif->set_univ($data[$i]->get_univ());
                $this->_notif_data[]=$notif;
                $st = $data[$i]->get_kode_link();
            }
            
        }
    }
    
    private function get_list_kode_st($is_selesai=false){
        $sql = "SELECT KD_ST FROM d_srt_tugas";
        if($is_selesai) $sql .= " WHERE TGL_SEL_ST>NOW()";
//        echo $sql;
        $d_st = $this->_db->select($sql);
        return $d_st;
    }
    
    /*
     * 
     */
    private function get_data_buku(){
        $d_st = $this->get_list_kode_st(true);
        foreach ($d_st as $st){
            $kd_st = $st['KD_ST'];
            $d_bulan = $this->get_bulan_surat_tugas($kd_st,true);
            foreach ($d_bulan as $bulan){
                $cek_proses = $this->cek_telah_bayar_elem(2, $bulan, $kd_st);
                $cek_bayar = $this->cek_telah_bayar_elem(2, $bulan, $kd_st,true);
                if($cek_proses){
                    if(!$cek_bayar){
                        $d_proses = $this->get_data_buku_by_st($kd_st, $bulan);
                        $d_proses->set_link($bulan);
//                        echo $kd_st."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                        $this->_notif_data[] = $d_proses;
                    }
                }else{
                    $notif = new NotifikasiDao();
                    $st = new SuratTugas($this->registry);
                    $st->set_kd_st($kd_st);
                    $d_st = $st->get_surat_tugas_by_id($st);
                    $notif->set_jatuh_tempo($d_st->get_th_masuk());
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
                    $notif->set_univ($d_univ->get_nama());
                    /** pic **/
                    $pic = new User($this->registry);
                    $d_pic = $pic->getUser_id($d_univ->get_pic());
                    $pic_arr = array('kode'=>$d_pic->get_id(),
                                    'nama'=>$d_pic->get_nmUser(),
                                    'foto'=>$d_pic->get_foto());
                    $notif->set_pic($pic_arr);
//                    echo $kd_st."-".$bulan."-".$notif->get_jenis_notif()."-".$notif->get_jurusan()."-".$notif->get_tahun_masuk()."-".$notif->get_univ()."-".$notif->get_status_notif()."</br>";
                    $this->_notif_data[] = $notif;
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
            CONCAT(a.BLN_D_ELEM_BEASISWA,'-',a.THN_D_ELEM_BEASISWA) as BULAN,
            a.TOTAL_BAYAR_D_ELEM_BEASISWA as TOTAL_BAYAR,
            e.THN_MASUK as THN_MASUK,
            f.NM_JUR as NM_JUR,
            h.NM_UNIV as UNIV,
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
            LEFT JOIN r_jur f ON d.KD_JUR=d.KD_JUR
            LEFT JOIN r_fakul g ON f.KD_FAKUL=g.KD_FAKUL
            LEFT JOIN r_univ h ON g.KD_UNIV=h.KD_UNIV 
            LEFT JOIN d_user i ON h.KD_USER=i.KD_USER
            WHERE b.KD_R_ELEM_BEASISWA=2 AND e.KD_ST=".$kd_st;
        if(!is_null($bulan)){
            $sql .= " AND a.BLN_D_ELEM_BEASISWA=".$bln_bayar[1]." AND a.THN_D_ELEM_BEASISWA=".$bln_bayar[0];
        }
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
    
    private function cek_telah_bayar_elem($kode_elem, $month,$surat_tugas,$cek_sp2d=false){
        $month = explode("-",$month);
        $sql = "SELECT a.KD_D_ELEM_BEASISWA as KD_D_ELEM_BEASISWA, 
                a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_ELEM_BEASISWA
                FROM d_elemen_beasiswa a 
                LEFT JOIN t_elem_beasiswa b ON a.KD_D_ELEM_BEASISWA = b.KD_D_ELEM_BEASISWA
                LEFT JOIN d_pb c ON b.KD_PB = c.KD_PB
                LEFT JOIN d_srt_tugas d ON c.KD_ST = d.KD_ST
                WHERE a.BLN_D_ELEM_BEASISWA=".$month[1]." AND THN_D_ELEM_BEASISWA=".$month[0]." AND d.KD_ST=".$surat_tugas." AND KD_R_ELEM_BEASISWA=$kode_elem";
        
        if($cek_sp2d){
            $sql .= " AND a.NO_SP2D_D_ELEM_BEASISWA<>''";
        }
//        echo $sql."</br>";
        $d_cek = count($this->_db->select($sql));
        
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
            b.KD_TAGIHAN as KD_TAGIHAN,
            b.NM_TAGIHAN as NM_TAGIHAN,
            b.JADWAL_BAYAR_TAGIHAN as DATE_BAYAR,
            (b.BIAYA_PER_PEG_TAGIHAN*b.JML_PEG_BAYAR_TAGIHAN) as BIAYA,
            c.NM_JUR as NM_JUR,
            e.NM_UNIV as NM_UNIV,
            b.STS_TAGIHAN as STS_TAGIHAN,
            DATEDIFF(b.JADWAL_BAYAR_TAGIHAN,DATE(NOW())) as SELISIH,
            f.NM_USER as NM_USER,
            f.KD_USER as KD_USER,
            f.FOTO_USER as FOTO,
            g.THN_MASUK as THN_MASUK,
            'kontrak' as JENIS
            FROM d_kontrak a
            LEFT JOIN d_tagihan b ON a.KD_KON=b.KD_KON
            LEFT JOIN r_jur c ON a.KD_JUR=c.KD_JUR
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
                $notif = new NotifikasiDao();
                $notif->set_jenis_notif($kontrak['JENIS']);
                $notif->set_jurusan($kontrak['NM_JUR']);
                $notif->set_kode_link('');
                $notif->set_link($kontrak['SELISIH']);
                $pic = array('kode'=>$kontrak['KD_ST'],'nama'=>$kontrak['NM_USER'],'foto'=>$kontrak['FOTO']);
                $notif->set_pic($pic);
                $notif->set_status_notif($kontrak['STS_TAGIHAN']);
                $notif->set_tahun_masuk($kontrak['THN_MASUK']);
                $notif->set_univ($kontrak['NM_UNIV']);
                $notif->set_jatuh_tempo($kontrak['DATE_BAYAR']);
                $this->_notif_data[] = $notif;
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
            e.NM_UNIV as NM_UNIV,
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
            $sebulan = $st['SELISIH']<31;
            if($sebulan){
                $notif->set_jenis_notif($st['JENIS']);
                $notif->set_jurusan($st['NM_JUR']);
                $notif->set_kode_link('');
                $notif->set_link($st['SELISIH']);
                $pic = array('kode'=>$st['KD_ST'],'nama'=>$st['NM_USER'],'foto'=>$st['FOTO']);
                $notif->set_pic($pic);
                $notif->set_status_notif('akan lulus');
                $notif->set_tahun_masuk($st['THN_MASUK']);
                $notif->set_univ($st['NM_UNIV']);
                $notif->set_jatuh_tempo($st['TGL_SEL_ST']);
                $this->_notif_data[] = $notif;
            }
        }
    }
    
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
    
    public function get_notifikasi(){
        $this->get_data_jadup();
        $this->get_data_skripsi();
        $this->get_data_buku();
        $this->get_data_surat_tugas();
        $this->get_data_kontrak();
        echo "jumlah notifikasi : ".count($this->_notif_data)."</br>";
        echo "data notifikasi : </br>";
        $this->dump_data();
//        $this->union_data();
//        echo $this->diff_month('2014-11', date('Y-m-d'));
    }
    
    private function dump_data(){
        foreach ($this->_notif_data as $v){
            echo $v->get_jenis_notif().":".$v->get_status_notif().":".$v->get_jatuh_tempo().":".$v->get_tahun_masuk().":".$v->get_univ().":".$v->get_link()."</br>";
        }
    }
    
    private function sort_data_notif(){
        
    }
    
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

    public function __destruct() {
        ;
    }
}
?>
