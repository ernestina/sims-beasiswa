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
    private $_start_buku = array(3,9);
    private $_start_lulus = '1 MONTH';


    public function __construct(Registry $registry) {
        $this->registry = $registry;
        $this->_db = $registry->db;
    }
    
    private function get_data_elemen_beasiswa(){
        $sql = "SELECT  
            a.KD_D_ELEM_BEASISWA as KODE,
            b.NM_ELEM_BEASISWA as NAMA,
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
            'elem' as JENIS
            FROM d_elemen_beasiswa a
            LEFT JOIN r_elem_beasiswa b ON a.KD_R_ELEM_BEASISWA=b.KD_R_ELEM_BEASISWA
            LEFT JOIN t_elem_beasiswa c ON a.KD_D_ELEM_BEASISWA=c.KD_D_ELEM_BEASISWA
            LEFT JOIN d_pb d ON c.KD_PB=d.KD_PB
            LEFT JOIN d_srt_tugas e ON d.KD_ST=e.KD_ST
            LEFT JOIN r_jur f ON d.KD_JUR=d.KD_JUR
            LEFT JOIN r_fakul g ON f.KD_FAKUL=g.KD_FAKUL
            LEFT JOIN r_univ h ON g.KD_UNIV=h.KD_UNIV 
            LEFT JOIN d_user i ON h.KD_USER=i.KD_USER
            GROUP BY e.KD_ST";
//        echo $sql;
//        
        $d_elem = $this->_db->select($sql);
//        $this->test_array($d_elem);
        foreach ($d_elem as $val){
            $notif = new NotifikasiDao();
            $pic = array('kode'=>$val['KD_USER'],
                        'nama'=>$val['NM_USER'],
                        'foto'=>$val['FOTO_USER']);
            $jth_tempo = date('Y-m-d');
            $notif->set_jatuh_tempo($jth_tempo);
            $notif->set_jenis_notif($val['JENIS']);
            $notif->set_jurusan($val['NM_JUR']);
            $notif->set_kode_link('');
            $notif->set_pic($pic);
            $notif->set_status_notif('');
            $notif->set_tahun_masuk($val['THN_MASUK']);
            $notif->set_univ($val['UNIV']);
            $notif->set_link('');
            $this->_notif_data[] = $notif;
            
        }
    }
    
    /*
     * ambil semua data jadup
     * ambil semua data surat tugas
     * cek keberadaan sp2d di data jadup > jika tidak ada > status proses
     * cek kesesuaian pembayaran terakhir dengan data surat tugas > jika ada yg belum, buat data baru > status belum
     */
    private function get_data_jadup(){
        
        $sql = "SELECT KD_ST FROM d_srt_tugas WHERE TGL_SEL_ST>NOW()";
//        echo $sql;
        $d_st = $this->_db->select($sql);
        
        foreach ($d_st as $val){
            $kd_st = $val['KD_ST'];
            $d_bulan = $this->get_bulan_surat_tugas($kd_st);
            foreach ($d_bulan as $bulan){
//                echo $bulan;
                $tahun = substr($bulan, 0,4);
//                $bulan_num = substr($bulan,5,2);
                $cek_proses = $this->cek_telah_bayar_jadup($bulan, $kd_st);
//                var_dump($cek_proses);
//                echo "</br>";
//                $this->get_jadup_by_st($kd_st);
                $notif = new NotifikasiDao();
                if($cek_proses){ //jika data telah ada 
                    $cek_bayar = $this->cek_telah_bayar_jadup($bulan, $kd_st,true);
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
                    $notif->set_jenis_notif('elem');
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
//        foreach ($this->_notif_data as $v){
//            echo $v->get_jenis_notif().":".$v->get_status_notif().":".$v->get_jatuh_tempo().":".$v->get_tahun_masuk().":".$v->get_univ()."</br>";
//        }
        
    }
    
    private function get_bulan_surat_tugas($kd_st){
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
            $d_bulan[] = $bln_mul;
            $bln_mul = date('Y-m',  strtotime('+1 month',  strtotime($bln_mul))); //tambahkan 1 bulan
            $stop = $bln_mul == $next_curr_bulan; //cek kapan berhenti
            if($stop){
                $cek_bulan=false;
                $d_bulan[] = $bln_mul; //tambahkan lagi untuk mengisi bulan setelah bulan berjalan
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
            'elem' as JENIS
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
     * ambil semua data bayar skripsi
     * ambil semua data mahasiswa
     * cek keberadaan sp2d di data jadup > jika tidak ada > status proses
     * cek kesesuaian data bayar dengan judul skripsi mahasiswa, jika tidak ada buat data baru > status belum
     */
    private function get_data_skripsi(){
        
    }
    
    /*
     * 
     */
    private function get_data_buku(){
        
    }
    
    private function get_data_kontrak(){
        $sql = "SELECT 
            a.KD_KON,
            b.KD_TAGIHAN,
            b.NM_TAGIHAN,
            b.JADWAL_BAYAR_TAGIHAN as DATE_BAYAR,
            (b.BIAYA_PER_PEG_TAGIHAN*b.JML_PEG_BAYAR_TAGIHAN) as BIAYA,
            c.NM_JUR,
            e.SINGKAT_UNIV,
            b.STS_TAGIHAN,
            DATEDIFF(b.JADWAL_BAYAR_TAGIHAN,DATE(NOW())) as SELISIH,
            f.NM_USER,
            g.THN_MASUK,
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
        $kon = new Kontrak($this->registry);
        $d_kontrak = $kon->get_All();
        return $d_kontrak;
        
    }
    /*
     * join d_pb dan d_srt_tugas dan d_univ dan d_user
     * d_pb :
     * d_srt_tugas :
     * d_univ :
     * d_user :
     * 
     */
    private function get_data_penerima(){
        $sql = "SELECT 
            a.TGL_SEL_ST,
            a.THN_MASUK,
            c.NM_JUR,
            e.SINGKAT_UNIV,
            f.NM_USER,
            DATEDIFF(a.TGL_SEL_ST,DATE(NOW())) as SELISIH,
            'pb' as JENIS
            FROM d_srt_tugas a 
            LEFT JOIN r_jur c ON a.KD_JUR=c.KD_JUR
            LEFT JOIN r_fakul d ON c.KD_FAKUL=d.KD_FAKUL
            LEFT JOIN r_univ e ON d.KD_UNIV=e.KD_UNIV
            LEFT JOIN d_user f ON e.KD_USER=f.KD_USER";
//        echo $sql;
        $pb = new Penerima($this->registry);
        $d_pb = $pb->get_penerima();
        return $d_pb;
    }
    
    private function union_data(){
        $d_elem = $this->get_data_elemen_beasiswa();
        $d_kon = $this->get_data_kontrak();
        $d_pb = $this->get_data_penerima();
        
//        foreach($d_elem as $v){
//            $d_notif = array(
//                'kode'=>$v->get_kd_d(),
//                'type'=>'elem'
//            );
//            $this->_notif_data[] = $d_notif;
//        }
        
        foreach($d_kon as $v){
            $d_notif = array(
                'kode'=>$v->kd_kontrak,
                'type'=>'kontrak'
            );
            $this->_notif_data[] = $d_notif;
        }
        
        foreach($d_pb as $v){
            $d_notif = array(
                'kode'=>$v->get_kd_pb(),
                'type'=>'penerima'
            );
            $this->_notif_data[] = $d_notif;
        }
        
//        foreach ($this->_notif_data as $key=>$val){
//            echo $key."=>id:".$val['kode'].";type:".$val['type']."</br>";
//        }
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
//        $this->union_data();
//        echo $this->diff_month('2014-11', date('Y-m-d'));
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


    private function cek_telah_bayar_jadup($month,$surat_tugas,$cek_sp2d=false){
        $month = explode("-",$month);
        $sql = "SELECT a.KD_D_ELEM_BEASISWA as KD_D_ELEM_BEASISWA, 
                a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_ELEM_BEASISWA
                FROM d_elemen_beasiswa a 
                LEFT JOIN t_elem_beasiswa b ON a.KD_D_ELEM_BEASISWA = b.KD_D_ELEM_BEASISWA
                LEFT JOIN d_pb c ON b.KD_PB = c.KD_PB
                LEFT JOIN d_srt_tugas d ON c.KD_ST = d.KD_ST
                WHERE a.BLN_D_ELEM_BEASISWA=".$month[1]." AND THN_D_ELEM_BEASISWA=".$month[0]." AND d.KD_ST=".$surat_tugas;
        if($cek_sp2d){
            $sql .= " AND a.NO_SP2D_D_ELEM_BEASISWA<>''";
        }
//        echo $sql."</br>";
        $d_cek = count($this->_db->select($sql));
        
        return $d_cek>0?true:false;
    }
    
    private function cek_telah_bayar_jabuk(){
        
    }
    
    private function cek_telah_bayar_jaskrip(){
        
    }
    /*
     * ini sekedar tes aja, jangan dihapus dulu ya
     */
    private function test_array($array){
        if(!is_array($array)) return "bukan array";
        foreach($array as $val){
            foreach($val as $key=>$v){
                echo $key." [".$v."]</br>";
            }
        }
    }

    public function __destruct() {
        ;
    }
}
?>
