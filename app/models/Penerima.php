<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Penerima {
    
    public $registry;
    private $_db;
    private $_kd_pb;
    private $_st;
    private $_jur;
    private $_bank;
    private $_status_tb;
    private $_nip;
    private $_nama;
    private $_jkel;
    private $_gol;
    private $_unit_asal;
    private $_email;
    private $_telp;
    private $_alamat;
    private $_no_rek;
    private $_foto;
    private $_tgl_lapor;
    private $_no_skl;
    private $_spmt;
    private $_skripsi;
    private $_tb_penerima = 'd_pb';
    
    /*
     * konstruktor
     */
    public function __construct($registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    public function get_penerima($kd_user=0,$posisi=null,$batas=null){
        $sql = "SELECT * FROM ".$this->_tb_penerima;
        $sql .= " a LEFT JOIN r_jur b ON a.KD_JUR=b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL=c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV=d.KD_UNIV";
        if($kd_user!=0){
            $sql .= " WHERE d.KD_USER=".$kd_user;
        }        
        if(!is_null($posisi)){
            $sql .= " LIMIT ".$posisi.",".$batas;
        }
//        echo $sql;
        $result = $this->db->select($sql);
        $data = array();
        foreach($result as $val){
            $penerima = new $this($this->registry);
            $penerima->set_kd_pb($val['KD_PB']);
            $st = new SuratTugas($this->registry);
            $st->set_kd_st($val['KD_ST']);
            $d_st = $st->get_surat_tugas_by_id($st);
            $penerima->set_st($d_st->get_tgl_mulai().";".$d_st->get_tgl_selesai());
            $jur = new Jurusan($this->registry);
            $jur->set_kode_jur($val['KD_JUR']);
            $d_jur = $jur->get_jur_by_id($jur);
            $nm_jur = $d_jur->get_nama();
            $penerima->set_jur($nm_jur);
            $penerima->set_bank($val['KD_BANK']);
            $stb = new Status();
            $d_stb = $stb->get_by_id($val['KD_STS_TB']);
            $penerima->set_status($d_stb->nm_status);
            $penerima->set_nip($val['NIP_PB']);
            $penerima->set_nama($val['NM_PB']);
            $penerima->set_jkel($val['JK_PB']);
            $penerima->set_gol($val['KD_GOL']);
            $penerima->set_unit_asal($val['UNIT_ASAL_PB']);
            $penerima->set_email($val['EMAIL_PB']);
            $penerima->set_telp($val['TELP_PB']);
            $penerima->set_alamat($val['ALMT_PB']);
            $penerima->set_no_rek($val['NO_REKENING_PB']);
            $penerima->set_foto($val['FOTO_PB']);
            $penerima->set_tgl_lapor($val['TGL_LAPOR_PB']);
            $penerima->set_skl($val['NO_SKL_PB']);
            $penerima->set_spmt($val['NO_SPMT_PB']);
            $penerima->set_skripsi($val['JUDUL_SKRIPSI_PB']);
            unset($jur);
            $data[] = $penerima;
        }
        return $data;
    }
    
    public function get_penerima_by_id($pb = Penerima){
        $sql = "SELECT * FROM ".$this->_tb_penerima;
        $sql .= " a LEFT JOIN r_jur b ON a.KD_JUR=b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL=c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV=d.KD_UNIV ";
        $sql .= " WHERE a.KD_PB=".$pb->get_kd_pb();
        //if($kd_user!="") {$sql .= " AND d.KD_USER=".$kd_user;}
        $result = $this->db->select($sql);
        foreach($result as $val){
            $this->set_kd_pb($val['KD_PB']);
            $this->set_st($val['KD_ST']);
            $this->set_jur($val['KD_JUR']);
            $this->set_bank($val['KD_BANK']);
            $this->set_status($val['KD_STS_TB']);
            $this->set_nip($val['NIP_PB']);
            $this->set_nama($val['NM_PB']);
            $this->set_jkel($val['JK_PB']);
            $this->set_gol($val['KD_GOL']);
            $this->set_unit_asal($val['UNIT_ASAL_PB']);
            $this->set_email($val['EMAIL_PB']);
            $this->set_telp($val['TELP_PB']);
            $this->set_alamat($val['ALMT_PB']);
            $this->set_no_rek($val['NO_REKENING_PB']);
            $this->set_foto($val['FOTO_PB']);
            $this->set_tgl_lapor($val['TGL_LAPOR_PB']);
            $this->set_skl($val['NO_SKL_PB']);
            $this->set_spmt($val['NO_SPMT_PB']);
            $this->set_skripsi($val['JUDUL_SKRIPSI_PB']);
        }
        return $this;
    }
    
    public function get_penerima_by_st($pb = Penerima,$kd_user=null){
        $sql = "SELECT * FROM ".$this->_tb_penerima;
        $sql .= " a LEFT JOIN r_jur b ON a.KD_JUR=b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL=c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV=d.KD_UNIV ";
        $sql .= " WHERE a.KD_ST=".$pb->get_st();
        if(!is_null($kd_user)) $sql .= " AND d.KD_USER=".$kd_user;
        $st = new SuratTugas($this->registry);
        $is_parent = $st->is_parent($pb->get_st());
        if($is_parent){
            $st_child = $st->get_child($pb->get_st());
            foreach ($st_child as $vst){
                $sql .= " UNION SELECT * FROM ".$this->_tb_penerima;
                $sql .= " a LEFT JOIN r_jur b ON a.KD_JUR=b.KD_JUR
                        LEFT JOIN r_fakul c ON b.KD_FAKUL=c.KD_FAKUL
                        LEFT JOIN r_univ d ON c.KD_UNIV=d.KD_UNIV ";
                $sql .= " WHERE a.KD_ST=".$vst->get_kd_st();
                if(!is_null($kd_user)) $sql .= " AND d.KD_USER=".$kd_user;
                
                $is_parent_second = $st->is_parent($vst->get_kd_st());
                if($is_parent_second){
                    $st_child_second = $st->get_child($vst->get_kd_st());
                    foreach ($st_child_second as $vsts){
                        $sql .= " UNION SELECT * FROM ".$this->_tb_penerima;
                        $sql .= " a LEFT JOIN r_jur b ON a.KD_JUR=b.KD_JUR
                                LEFT JOIN r_fakul c ON b.KD_FAKUL=c.KD_FAKUL
                                LEFT JOIN r_univ d ON c.KD_UNIV=d.KD_UNIV ";
                        $sql .= " WHERE a.KD_ST=".$vsts->get_kd_st();
                        if(!is_null($kd_user)) $sql .= " AND d.KD_USER=".$kd_user;
                    }
                }
                
            }
            
        }
//        echo $sql;
        $result = $this->db->select($sql);
        $data = array();
        foreach($result as $val){
            $penerima = new $this($this->registry);
            $penerima->set_kd_pb($val['KD_PB']);
            $penerima->set_st($val['KD_ST']);
            $penerima->set_jur($val['KD_JUR']);
            $penerima->set_bank($val['KD_BANK']);
            $penerima->set_status($val['KD_STS_TB']);
            $penerima->set_nip($val['NIP_PB']);
            $penerima->set_nama($val['NM_PB']);
            $penerima->set_jkel($val['JK_PB']);
            $penerima->set_gol($val['KD_GOL']);
            $penerima->set_unit_asal($val['UNIT_ASAL_PB']);
            $penerima->set_email($val['EMAIL_PB']);
            $penerima->set_telp($val['TELP_PB']);
            $penerima->set_alamat($val['ALMT_PB']);
            $penerima->set_no_rek($val['NO_REKENING_PB']);
            $penerima->set_foto($val['FOTO_PB']);
            $penerima->set_tgl_lapor($val['TGL_LAPOR_PB']);
            $penerima->set_skl($val['NO_SKL_PB']);
            $penerima->set_spmt($val['NO_SPMT_PB']);
            $penerima->set_skripsi($val['JUDUL_SKRIPSI_PB']);
            $data[] = $penerima;
        }
        return $data;
    }
    
    public function get_penerima_by_st_nip($pb = Penerima,$kd_user=null){
        $sql = "SELECT * FROM ".$this->_tb_penerima;
        $sql .= " a LEFT JOIN r_jur b ON a.KD_JUR=b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL=c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV=d.KD_UNIV ";
        $sql .= " WHERE a.KD_ST=".$pb->get_st()." AND a.NIP_PB=".$pb->get_nip();
        if(!is_null($kd_user)) $sql .= " AND d.KD_USER=".$kd_user;
        $result = $this->db->select($sql);
//        $data = array();
        $penerima = new $this($this->registry);
        foreach($result as $val){
            
            $penerima->set_kd_pb($val['KD_PB']);
            $penerima->set_st($val['KD_ST']);
            $penerima->set_jur($val['KD_JUR']);
            $penerima->set_bank($val['KD_BANK']);
            $penerima->set_status($val['KD_STS_TB']);
            $penerima->set_nip($val['NIP_PB']);
            $penerima->set_nama($val['NM_PB']);
            $penerima->set_jkel($val['JK_PB']);
            $penerima->set_gol($val['KD_GOL']);
            $penerima->set_unit_asal($val['UNIT_ASAL_PB']);
            $penerima->set_email($val['EMAIL_PB']);
            $penerima->set_telp($val['TELP_PB']);
            $penerima->set_alamat($val['ALMT_PB']);
            $penerima->set_no_rek($val['NO_REKENING_PB']);
            $penerima->set_foto($val['FOTO_PB']);
            $penerima->set_tgl_lapor($val['TGL_LAPOR_PB']);
            $penerima->set_skl($val['NO_SKL_PB']);
            $penerima->set_spmt($val['NO_SPMT_PB']);
            $penerima->set_skripsi($val['JUDUL_SKRIPSI_PB']);
//            $data[] = $penerima;
        }
        return $penerima;
    }
    
    public function get_penerima_by_name($pb = Penerima, $kd_user=0, $filter_st=false){
        $sql = "SELECT * FROM ".$this->_tb_penerima;
        $sql .= " a LEFT JOIN r_jur b ON a.KD_JUR=b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL=c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV=d.KD_UNIV ";
        $sql .= " WHERE NM_PB LIKE '%".$pb->get_nama()."%'";
        if($kd_user!=0) $sql .= " AND d.KD_USER=".$kd_user;
        if($filter_st){
            $sql .= " AND a.KD_ST=".$pb->get_st();
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach($result as $val){
            $penerima = new $this($this->registry);
            $st = new SuratTugas($this->registry);
            $st->set_kd_st($val['KD_ST']);
            $d_st = $st->get_surat_tugas_by_id($st,$kd_user);
            if($kd_user==0) $d_st = $st->get_surat_tugas_by_id($st);
            $tglmulsel = $d_st->get_tgl_mulai().";".$d_st->get_tgl_selesai();
            $penerima->set_kd_pb($val['KD_PB']);
            $penerima->set_st($tglmulsel);
            $jur = new Jurusan($this->registry);
            $jur->set_kode_jur($val['KD_JUR']);
            $d_jur = $jur->get_jur_by_id($jur);
            $nm_jur = $d_jur->get_nama();
            $penerima->set_jur($nm_jur);
            $penerima->set_bank($val['KD_BANK']);
            $stb = new Status();
            $d_stb = $stb->get_by_id($val['KD_STS_TB']);
            $penerima->set_status($d_stb->nm_status);
            $penerima->set_nip($val['NIP_PB']);
            $penerima->set_nama($val['NM_PB']);
            $penerima->set_jkel($val['JK_PB']);
            $penerima->set_gol($val['KD_GOL']);
            $penerima->set_unit_asal($val['UNIT_ASAL_PB']);
            $penerima->set_email($val['EMAIL_PB']);
            $penerima->set_telp($val['TELP_PB']);
            $penerima->set_alamat($val['ALMT_PB']);
            $penerima->set_no_rek($val['NO_REKENING_PB']);
            $penerima->set_foto($val['FOTO_PB']);
            $penerima->set_tgl_lapor($val['TGL_LAPOR_PB']);
            $penerima->set_skl($val['NO_SKL_PB']);
            $penerima->set_spmt($val['NO_SPMT_PB']);
            $penerima->set_skripsi($val['JUDUL_SKRIPSI_PB']);
            $data[] = $penerima;
        }
        return $data;
    }
    
    public function get_penerima_by_column($pb = Penerima, $kd_user=0, $cat="",$info = false){
        $sql = "SELECT a.KD_PB as KD_PB,";
        if($info){
            $sql .= "CONCAT(b.NO_ST,',',b.TGL_ST,',',b.THN_MASUK) as KD_ST,
                CONCAT(c.NM_JUR,',',g.NM_UNIV,',',h.STRATA) as KD_JUR,
                d.NM_STS_TB as KD_STS_TB,
                e.NM_BANK as KD_BANK,";
        }else{
            $sql .= "a.KD_ST as KD_ST,
                a.KD_JUR as KD_JUR,
                a.KD_STS_TB as KD_STS_TB,
                a.KD_BANK as KD_BANK,";
        }
        $sql .= "
            a.KD_GOL as KD_GOL,
            a.NIP_PB as NIP_PB,
            a.NM_PB as NM_PB,
            a.JK_PB as JK_PB,
            a.UNIT_ASAL_PB as UNIT_ASAL_PB,
            a.EMAIL_PB as EMAIL_PB,
            a.TELP_PB as TELP_PB,
            a.ALMT_PB as ALMT_PB,
            a.NO_REKENING_PB as NO_REKENING_PB,
            a.FOTO_PB as FOTO_PB,
            a.TGL_LAPOR_PB as TGL_LAPOR_PB,
            a.NO_SKL_PB as NO_SKL_PB,
            a.NO_SPMT_PB as NO_SPMT_PB,
            a.JUDUL_SKRIPSI_PB as JUDUL_SKRIPSI_PB
            FROM ".$this->_tb_penerima." a ";
//        if($info){
            $sql .= "LEFT JOIN d_srt_tugas b ON a.KD_ST=b.KD_ST
                LEFT JOIN r_jur c ON a.KD_JUR=c.KD_JUR
                LEFT JOIN r_stb d ON a.KD_STS_TB=d.KD_STS_TB
                LEFT JOIN r_bank e ON a.KD_BANK=e.KD_BANK 
                LEFT JOIN r_fakul f ON c.KD_FAKUL=f.KD_FAKUL
                LEFT JOIN r_univ g ON f.KD_UNIV=g.KD_UNIV
                LEFT JOIN r_strata h ON c.KD_STRATA=h.KD_STRATA ";
//        }
        if($cat=='nip'){
            $sql .= "WHERE a.NIP_PB =".$pb->get_nip();
            if($kd_user!=0) $sql .= " AND g.KD_USER=".$kd_user;
        }else{
            if($kd_user!=0) $sql .= " WHERE g.KD_USER=".$kd_user;
        }
        
        $result = $this->db->select($sql);
        $data = array();
        foreach($result as $val){
            $penerima = new $this($this->registry);
            $penerima->set_kd_pb($val['KD_PB']);
            $penerima->set_st($val['KD_ST']);
            $penerima->set_jur($val['KD_JUR']);
            $penerima->set_bank($val['KD_BANK']);
            $penerima->set_status($val['KD_STS_TB']);
            $penerima->set_nip($val['NIP_PB']);
            $penerima->set_nama($val['NM_PB']);
            $penerima->set_jkel($val['JK_PB']);
            $penerima->set_gol($val['KD_GOL']);
            $penerima->set_unit_asal($val['UNIT_ASAL_PB']);
            $penerima->set_email($val['EMAIL_PB']);
            $penerima->set_telp($val['TELP_PB']);
            $penerima->set_alamat($val['ALMT_PB']);
            $penerima->set_no_rek($val['NO_REKENING_PB']);
            $penerima->set_foto($val['FOTO_PB']);
            $penerima->set_tgl_lapor($val['TGL_LAPOR_PB']);
            $penerima->set_skl($val['NO_SKL_PB']);
            $penerima->set_spmt($val['NO_SPMT_PB']);
            $penerima->set_skripsi($val['JUDUL_SKRIPSI_PB']);
            $data[] = $penerima;
        }
        return $data;
    }
    
    public function add_penerima($data=array()){
        if(!is_array($data)) return false;
        return $this->db->insert($this->_tb_penerima,$data);
    }


    /*
     * hapus penerima beasiswa, kd penerima harus diset
     */
    public function delete_penerima(){
        $where = 'KD_PB = '.$this->get_kd_pb();
        $this->db->delete($this->_tb_penerima, $where);
    }
    
    /*
     * update data penerima beasiswa, kode penerima harus diset
     */
    public function update_penerima(){
        $data = array(
            'KD_PB'=>$this->get_kd_pb(),
            'KD_ST'=>$this->get_st(),
            'KD_JUR'=>$this->get_jur(),
            'KD_BANK'=>$this->get_bank(),
            'KD_STS_TB'=>$this->get_status(),
            'NIP_PB'=>$this->get_nip(),
            'NM_PB'=>$this->get_nama(),
            'JK_PB'=>$this->get_jkel(),
            'KD_GOL'=>$this->get_gol(),
            'UNIT_ASAL_PB'=>$this->get_unit_asal(),
            'EMAIL_PB'=>$this->get_email(),
            'TELP_PB'=>$this->get_telp(),
            'ALMT_PB'=>$this->get_alamat(),
            'NO_REKENING_PB'=>$this->get_no_rek(),
            'FOTO_PB'=>$this->get_foto(),
            'TGL_LAPOR_PB'=>$this->get_tgl_lapor(),
            'NO_SKL_PB'=>$this->get_skl(),
            'NO_SPMT_PB'=>$this->get_spmt(),
            'JUDUL_SKRIPSI_PB'=>$this->get_skripsi()
        );
        if(!is_array($data)) return false;
        $where = 'KD_PB = '.$this->get_kd_pb();
        return $this->db->update($this->_tb_penerima,$data,$where);
    }
    
    /*
     * cek pb exist
     * @param TRUE sudah ada dan belum terdaftar di ST 
     */
    public function cek_exist_pb($cek_st=FALSE){
        $sql = "SELECT * FROM ".$this->_tb_penerima." WHERE NIP_PB='".$this->get_nip()."'";
        if($cek_st){
            $sql .= " AND KD_ST=0 ";
        }
//        var_dump($this->_db);
        $cek = count($this->db->select($sql));
        $return = array();
        if($cek_st){
            $return['aksi']='ubah';
        }else{
            $return['aksi']='rekam';
        }
        
        $return['cek']=$cek;
        return $return;
    }
    
    /*
     * cek apakah pb pernah mendapat beasiswa dalam strata yg sama
     */
    
    public function is_prn_beasiswa_strata($nip,$kd_st){
//        $st = new SuratTugas($this->registry);
//        $st->set_kd_st($kd_st);
        $sql = "SELECT * FROM ".$this->_tb_penerima." a 
            LEFT JOIN r_jur b ON a.KD_JUR=b.KD_JUR
            WHERE a.NIP_PB='".$nip."' 
                AND b.KD_STRATA=(SELECT b.KD_STRATA FROM d_srt_tugas a 
                                LEFT JOIN r_jur b ON a.KD_JUR=b.KD_JUR
                                WHERE a.KD_ST=".$kd_st.")";
//        echo $sql;
        $count = count($this->db->select($sql));
        $is_exist = $count>0;
        if($is_exist) return true;
        return false;
    }
    /*
     * cek perubahan status tugas belajar
     * tanggal telah bersih, tidak menerima null atau karakter kosong
     */
    public function get_status_change_pb(SuratTugas $st, $tgl_lapor,$tgl_sel_st){
//        $tgl_lapor = $pb->get_tgl_lapor();
//        $tgl_sel_st = $st->get_tgl_selesai();
        $lulus_dini = Tanggal::check_before_a_date($tgl_lapor, $tgl_sel_st);
        $jst = $st->get_jenis_st();
        /*
         * 1 belum lulus
         * 2 belum lulus dengan perpanjangan 1
         * 3 belum lulus dengan perpanjangan 2
         * 4 belum lulus cuti
         * 5 lulus -> X
         * 6 lulus lebih dini -> X
         * 7 lulus perpanjangan 1 -> X
         * 8 lulus perpanjangan 2 -> X
         * 9 tidak lulus
         * cek
         */
        $status = null;
        switch($jst){
            case 1:
                $status = ($lulus_dini)? 6:5;
                break;
            case 2:
                $status = 7;
                break;
            case 3:
                $status = 8;
                break;
            case 4:
                $status = ($lulus_dini)? 6:5;
                break;
            default:
                $status=5;
        }
        return $status;
    }

    //mendapatkan data penerima berhasarkan kd_jurusan dan tahun_masuk
    
    public function get_penerima_by_kd_jur_thn_masuk($kd_jur, $thn_masuk){
        $sql = "SELECT * FROM d_pb a, d_srt_tugas b where a.KD_ST=b.KD_ST and b.KD_JUR='".$kd_jur."' and b.THN_MASUK='".$thn_masuk."'";
        $result = $this->db->select($sql);
        $data = array();
        foreach($result as $val){
            $penerima = new $this($this->registry);
            $penerima->set_kd_pb($val['KD_PB']);
            $penerima->set_st($val['KD_ST']);
            $penerima->set_jur($val['KD_JUR']);
            $penerima->set_bank($val['KD_BANK']);
            $penerima->set_status($val['KD_STS_TB']);
            $penerima->set_nip($val['NIP_PB']);
            $penerima->set_nama($val['NM_PB']);
            $penerima->set_jkel($val['JK_PB']);
            $penerima->set_gol($val['KD_GOL']);
            $penerima->set_unit_asal($val['UNIT_ASAL_PB']);
            $penerima->set_email($val['EMAIL_PB']);
            $penerima->set_telp($val['TELP_PB']);
            $penerima->set_alamat($val['ALMT_PB']);
            $penerima->set_no_rek($val['NO_REKENING_PB']);
            $penerima->set_foto($val['FOTO_PB']);
            $penerima->set_tgl_lapor($val['TGL_LAPOR_PB']);
            $penerima->set_skl($val['NO_SKL_PB']);
            $penerima->set_spmt($val['NO_SPMT_PB']);
            $penerima->set_skripsi($val['JUDUL_SKRIPSI_PB']);
            $data[] = $penerima;
        }
        return $data;
    }
    
    //mendapatkan data penerima berhasarkan kd_jurusan 
    
    public function get_penerima_by_kd_jur($kd_jur){
        $sql = "SELECT * FROM d_pb a, d_srt_tugas b where a.KD_ST=b.KD_ST and b.KD_JUR='".$kd_jur."'";
        $result = $this->db->select($sql);
        $data = array();
        foreach($result as $val){
            $penerima = new $this($this->registry);
            $penerima->set_kd_pb($val['KD_PB']);
            $penerima->set_st($val['KD_ST']);
            $penerima->set_jur($val['KD_JUR']);
            $penerima->set_bank($val['KD_BANK']);
            $penerima->set_status($val['KD_STS_TB']);
            $penerima->set_nip($val['NIP_PB']);
            $penerima->set_nama($val['NM_PB']);
            $penerima->set_jkel($val['JK_PB']);
            $penerima->set_gol($val['KD_GOL']);
            $penerima->set_unit_asal($val['UNIT_ASAL_PB']);
            $penerima->set_email($val['EMAIL_PB']);
            $penerima->set_telp($val['TELP_PB']);
            $penerima->set_alamat($val['ALMT_PB']);
            $penerima->set_no_rek($val['NO_REKENING_PB']);
            $penerima->set_foto($val['FOTO_PB']);
            $penerima->set_tgl_lapor($val['TGL_LAPOR_PB']);
            $penerima->set_skl($val['NO_SKL_PB']);
            $penerima->set_spmt($val['NO_SPMT_PB']);
            $penerima->set_skripsi($val['JUDUL_SKRIPSI_PB']);
            $data[] = $penerima;
        }
        return $data;
    }
    
     public function get_penerima_by_skripsi($kd_jur, $thn){
        $sql = "SELECT a.* FROM d_pb a, d_srt_tugas b where a.JUDUL_SKRIPSI_PB !='' AND a.KD_JUR ='".$kd_jur."' AND a.KD_ST = b.KD_ST AND b.THN_MASUK='".$thn."'  ";
        $result = $this->db->select($sql);
        $data = array();
        foreach($result as $val){
            $penerima = new $this($this->registry);
            $penerima->set_kd_pb($val['KD_PB']);
            $penerima->set_st($val['KD_ST']);
            $penerima->set_jur($val['KD_JUR']);
            $penerima->set_bank($val['KD_BANK']);
            $penerima->set_status($val['KD_STS_TB']);
            $penerima->set_nip($val['NIP_PB']);
            $penerima->set_nama($val['NM_PB']);
            $penerima->set_jkel($val['JK_PB']);
            $penerima->set_gol($val['KD_GOL']);
            $penerima->set_unit_asal($val['UNIT_ASAL_PB']);
            $penerima->set_email($val['EMAIL_PB']);
            $penerima->set_telp($val['TELP_PB']);
            $penerima->set_alamat($val['ALMT_PB']);
            $penerima->set_no_rek($val['NO_REKENING_PB']);
            $penerima->set_foto($val['FOTO_PB']);
            $penerima->set_tgl_lapor($val['TGL_LAPOR_PB']);
            $penerima->set_skl($val['NO_SKL_PB']);
            $penerima->set_spmt($val['NO_SPMT_PB']);
            $penerima->set_skripsi($val['JUDUL_SKRIPSI_PB']);
            $data[] = $penerima;
        }
        return $data;
    }
    
    public function get_penerima_filter($univ, $thn_masuk, $status, $kd_user=0, $posisi=null, $batas=null){
        $sql = "SELECT a.KD_PB as KD_PB,";
        $sql .= "a.KD_ST as KD_ST,
            a.KD_JUR as KD_JUR,
            a.KD_STS_TB as KD_STS_TB,
            b.TGL_MUL_ST as TGL_MUL_ST,
            b.TGL_SEL_ST as TGL_SEL_ST,
            a.KD_BANK as KD_BANK,";
        $sql .= "
            a.KD_GOL as KD_GOL,
            a.NIP_PB as NIP_PB,
            a.NM_PB as NM_PB,
            a.JK_PB as JK_PB,
            a.UNIT_ASAL_PB as UNIT_ASAL_PB,
            a.EMAIL_PB as EMAIL_PB,
            a.TELP_PB as TELP_PB,
            a.ALMT_PB as ALMT_PB,
            a.NO_REKENING_PB as NO_REKENING_PB,
            a.FOTO_PB as FOTO_PB,
            a.TGL_LAPOR_PB as TGL_LAPOR_PB,
            a.NO_SKL_PB as NO_SKL_PB,
            a.NO_SPMT_PB as NO_SPMT_PB,
            a.JUDUL_SKRIPSI_PB as JUDUL_SKRIPSI_PB
            FROM ".$this->_tb_penerima." a ";
        $sql .= "LEFT JOIN d_srt_tugas b ON a.KD_ST=b.KD_ST
            LEFT JOIN r_jur c ON b.KD_JUR=c.KD_JUR
            LEFT JOIN r_fakul f ON c.KD_FAKUL=f.KD_FAKUL
            LEFT JOIN r_univ g ON f.KD_UNIV=g.KD_UNIV
            LEFT JOIN r_stb d ON a.KD_STS_TB=d.KD_STS_TB
            LEFT JOIN r_bank e ON a.KD_BANK=e.KD_BANK 
            LEFT JOIN r_strata h ON c.KD_STRATA=h.KD_STRATA ";
        if($univ==0 && $thn_masuk==0 &&$status!=0){
            $sql .= "WHERE a.KD_STS_TB=".$status;
            if($kd_user!=0) $sql .=" AND g.KD_USER=".$kd_user;
        }else if($univ==0 && $thn_masuk!=0 &&$status!=0){
            $sql .= "WHERE b.THN_MASUK=".$thn_masuk." AND a.KD_STS_TB=".$status;
            if($kd_user!=0) $sql .=" AND g.KD_USER=".$kd_user;
        }else if($univ!=0 && $thn_masuk!=0 &&$status!=0){
            $sql .= "WHERE g.KD_UNIV=".$univ." AND b.THN_MASUK=".$thn_masuk." AND a.KD_STS_TB=".$status;
            if($kd_user!=0) $sql .=" AND g.KD_USER=".$kd_user;
        }else if($univ!=0 && $thn_masuk!=0 &&$status==0){
            $sql .= "WHERE g.KD_UNIV=".$univ." AND b.THN_MASUK=".$thn_masuk;
            if($kd_user!=0) $sql .=" AND g.KD_USER=".$kd_user;
        }else if($univ!=0 && $thn_masuk==0 &&$status==0){
            $sql .= "WHERE g.KD_UNIV=".$univ;
            if($kd_user!=0) $sql .=" AND g.KD_USER=".$kd_user;
        }else if($univ==0 && $thn_masuk!=0 &&$status==0){
            $sql .= "WHERE b.THN_MASUK=".$thn_masuk;
            if($kd_user!=0) $sql .=" AND g.KD_USER=".$kd_user;
        }else if($univ!=0 && $thn_masuk==0 &&$status!=0){
            $sql .= "WHERE g.KD_UNIV=".$univ."  AND a.KD_STS_TB=".$status;
            if($kd_user!=0) $sql .=" AND g.KD_USER=".$kd_user;
        }else{
            if($kd_user!=0) $sql .=" WHERE g.KD_USER=".$kd_user;
        }
        
        if(!is_null($posisi)){
            $sql .= " LIMIT ".$posisi.",".$batas;
        }
//        echo $sql;
        $result = $this->db->select($sql);
        $data = array();
        foreach($result as $val){
            $penerima = new $this($this->registry);
            $penerima->set_kd_pb($val['KD_PB']);
            $st = new SuratTugas($this->registry);
            $penerima->set_st($val['TGL_MUL_ST'].";".$val['TGL_SEL_ST']);
            $jur = new Jurusan($this->registry);
            $jur->set_kode_jur($val['KD_JUR']);
            $d_jur = $jur->get_jur_by_id($jur);
            $nm_jur = $d_jur->get_nama();
            $penerima->set_jur($nm_jur);
            $penerima->set_bank($val['KD_BANK']);
            $stb = new Status();
            $d_stb = $stb->get_by_id($val['KD_STS_TB']);
            $penerima->set_status($d_stb->nm_status);
            $penerima->set_nip($val['NIP_PB']);
            $penerima->set_nama($val['NM_PB']);
            $penerima->set_jkel($val['JK_PB']);
            $penerima->set_gol($val['KD_GOL']);
            $penerima->set_unit_asal($val['UNIT_ASAL_PB']);
            $penerima->set_email($val['EMAIL_PB']);
            $penerima->set_telp($val['TELP_PB']);
            $penerima->set_alamat($val['ALMT_PB']);
            $penerima->set_no_rek($val['NO_REKENING_PB']);
            $penerima->set_foto($val['FOTO_PB']);
            $penerima->set_tgl_lapor($val['TGL_LAPOR_PB']);
            $penerima->set_skl($val['NO_SKL_PB']);
            $penerima->set_spmt($val['NO_SPMT_PB']);
            $penerima->set_skripsi($val['JUDUL_SKRIPSI_PB']);
            $data[] = $penerima;
            unset($jur);
        }
        return $data;
    }
    
    public function get_pb_jadup (){
        $sql = "SELECT 
            a.KD_PB AS KD_PB,
            a.NM_PB AS NM_PB,
            a.KD_GOL AS KD_GOL,
            b.NM_STS_TB AS NM_STS_TB,
            c.NM_BANK AS NM_BANK,
            a.NO_REKENING_PB AS NO_REKENING_PB
            FROM d_pb a
            LEFT JOIN 
            r_stb b ON a.KD_STS_TB = b.KD_STS_TB
            LEFT JOIN
            r_bank c ON a.KD_BANK = c.KD_BANK
            ";
        
        $result = $this->db->select($sql);
        
        $data = array();
        foreach ($result as $value){
            $pb = new Penerima($this->registry);
            
            $pb->set_kd_pb($value['KD_PB']);
            $pb->set_nama($value['NM_PB']);
            $pb->set_status($value['NM_STS_TB']);
            $pb->set_bank($value['NM_BANK']);
            $pb->set_no_rek($value['NO_REKENING_PB']);

            $data[]=$pb;
        }
        
        return $data;
    }
    
    public function get_jumlah_pegawai($filter,$kode_filter){
        $sql = "SELECT COUNT(*) as JUMLAH FROM ".$this->_tb_penerima;
        switch($filter){
            case 'universitas':
                $sql .= " a LEFT JOIN r_jur b ON a.KD_JUR=b.KD_JUR
                        LEFT JOIN r_fakul c ON b.KD_FAKUL=c.KD_FAKUL
                        LEFT JOIN r_univ d ON c.KD_UNIV=d.KD_UNIV
                        WHERE d.KD_UNIV=".$kode_filter." AND ";
                break;
            case 'jurusan':
                $sql .= " WHERE KD_JUR=".$kode_filter." AND ";
                break;
            default:
                throw new Exception();
        }
        $sql .= " KD_STS_TB<5";
//        echo $sql;
        $d_jumlah = $this->db->select($sql);
        foreach ($d_jumlah as $v){
            return $v['JUMLAH'];
        }
    }
    
    /*
     * cek hubungan pb dengan cuti dan surat tugas perpanjangan
     * param Penerima pb, jenis cek [cuti, st, all], luaran [false=boolean, true=status]
     * cek = all, semua di cek
     * is_lulus = cek apakah sudah lulus
     * luaran => false jika luaran boolean
     * 
     */
    public function cek_pb_konek_st_ct(Penerima $pb,$jenis_cek='all',$is_lulus=false,$luaran=false){
        if($pb->get_kd_pb()=='' || is_null($pb->get_kd_pb())) return false;
        
        if($pb->get_st()=='' || is_null($pb->get_st())){
            $pb = $pb->get_penerima_by_id($pb);
        }
        $kd_st = $pb->get_st();
        $status = $pb->get_status();
        switch($jenis_cek){
            case 'all':
                if(!$is_lulus){ //status belum lulus
                    $sts_cuti = $this->cek_pb_konek_st_ct($pb, 'cuti',false); //cek masih cuti?
//                    var_dump($sts_cuti);
                    if($sts_cuti){ 
                        $status = $this->cek_pb_konek_st_ct($pb, 'cuti',false,true);
                        if($luaran){
                            return $status;
                        } 
                        return true;
                    }else{ //jika tidak dalam keadaan cuti
                        $status = $this->cek_pb_konek_st_ct($pb, 'st', false, true);
                        return $status;
                    }
                }else{
                    //TO DO cek lebih ke st, tp cek dulu dia dalam keadaancuti apa tidak
                    //klo dalam keadaan cuti ya tidak bisa dong, harus dikembalikan ke cuti
                    $sts_cuti = $this->cek_pb_konek_st_ct($pb, 'cuti',true);
                    if($sts_cuti){
                        $status = $this->cek_pb_konek_st_ct($pb,'cuti',true,true);
                        if($luaran){
                            return $status;
                        }
                        return true;
                    }else{
                        $status = $this->cek_pb_konek_st_ct($pb, 'st', true, true);
                        return $status;
                    }
                    
                }
                break;
            case 'cuti':
                $ct = new Cuti($this->registry);
                $d_ct = $ct->get_cuti(Session::get('kd_user'), $pb);
                //TO DO cek apakah masa cuti masih ada
                $exist_data = count($d_ct)>0;
                if($exist_data){
                    if($luaran){
                        return 4; //saat cuti tidak boleh lulus
                    }else{
                        return true;
                    }
                }else{
                    if($is_lulus){ //untuk kode lulus
                        if($luaran){
                            $status = $this->cek_pb_konek_st_ct($pb, 'st', true, true); //kode untuk lulus
                            return $status;
                        }else{
                            //TO DO kembalian boolean
                            return true;
                        }
                    }else{ //untuk kode belum lulus
                        if($luaran){
                            $status = $this->cek_pb_konek_st_ct($pb, 'st', false, true); //kode sebelum lulus
                            return $status;
                        }else{
                            //TO DO kembalian boolean
                            return false;
                        }
                    }
                    
                    if(!$luaran) return false;
                }
                break;
            case 'st':
                $st = new SuratTugas($this->registry);
                $st->set_kd_st($kd_st);
                $st = $st->get_surat_tugas_by_id($st);
                $tgl_sel_st = $st->get_tgl_selesai();
                $child = $st->is_child($kd_st); //child pertama
                if($child){
                    $st_child = new SuratTugas($this->registry);
                    $st_child->set_kd_st($st->get_st_lama()); //st parent
                    $st_child = $st_child->get_surat_tugas_by_id($st_child);
                    $second_child = $st_child->is_child($st_child->get_kd_st());
                    if($second_child){ //jika child kedua
                        if($is_lulus) { //untuk status lulus
                            if($pb->get_tgl_lapor()=='' || is_null($pb->get_tgl_lapor())){
                                $tgl_lapor = date('Y-m-d');
                            }else{
                                $tgl_lapor = $pb->get_tgl_lapor();
                            }
                            $status = $pb->get_status_change_pb($st, $tgl_lapor, $tgl_sel_st);
                        }else{
                            $status = 3;
                        }
                        return $status;
                    }else{
                        if($is_lulus){
                            if($pb->get_tgl_lapor()=='' || is_null($pb->get_tgl_lapor())){
                                $tgl_lapor = date('Y-m-d');
                            }else{
                                $tgl_lapor = $pb->get_tgl_lapor();
                            }
                            $status = $pb->get_status_change_pb($st, $tgl_lapor, $tgl_sel_st);
                        }else{
                            $status = 2;
                        }
                        return $status;
                    }
                }else{
                    return 1;
                }
                break;
            default:
                throw new Exception();
        }
    }

    /*
     * setter
     */
    public function set_kd_pb($kd){
        $this->_kd_pb = $kd;
    }
    
    public function set_st($st){
        $this->_st = $st;
    }
    
    public function set_jur($jur){
        $this->_jur = $jur;
    }
    public function set_bank($bank){
        $this->_bank = $bank;
    }
    public function set_status($status){
        $this->_status_tb = $status;
    }
    public function set_nip($nip){
        $this->_nip = $nip;
    }
    public function set_nama($nama){
        $this->_nama = $nama;
    }
    public function set_jkel($jkel){
        $this->_jkel = $jkel;
    }
    public function set_gol($gol){
        $this->_gol = $gol;
    }
    public function set_unit_asal($unit){
        $this->_unit_asal = $unit;
    }
    public function set_email($email){
        $this->_email = $email;
    }
    public function set_telp($telp){
        $this->_telp = $telp;
    }
    public function set_alamat($alamat){
        $this->_alamat = $alamat;
    }
    public function set_no_rek($rek){
        $this->_no_rek = $rek;
    }
    public function set_foto($foto){
        $this->_foto = $foto;
    }
    public function set_tgl_lapor($tgl){
        $this->_tgl_lapor = $tgl;
    }
    public function set_skl($skl){
        $this->_no_skl = $skl;
    }
    public function set_spmt($spmt){
        $this->_spmt = $spmt;
    }
    public function set_skripsi($judul){
        $this->_skripsi = $judul;
    }
    
    /*
     * getter
     */
    public function get_kd_pb(){
        return $this->_kd_pb;
    }
    public function get_st(){
        return $this->_st;
    }
    public function get_jur(){
        return $this->_jur;
    }
    public function get_bank(){
        return $this->_bank;
    }
    public function get_status(){
        return $this->_status_tb;
    }
    public function get_nip(){
        return $this->_nip;
    }
    public function get_nama(){
        return $this->_nama;
    }
    public function get_jkel(){
        return $this->_jkel;
    }
    public function get_gol(){
        return $this->_gol;
    }
    public function get_unit_asal(){
        return $this->_unit_asal;
    }
    public function get_email(){
        return $this->_email;
    }
    public function get_telp(){
        return $this->_telp;
    }
    public function get_alamat(){
        return $this->_alamat;
    }
    public function get_no_rek(){
        return $this->_no_rek;
    }
    public function get_foto(){
        return $this->_foto;
    }
    public function get_tgl_lapor(){
        return $this->_tgl_lapor;
    }
    public function get_skl(){
        return $this->_no_skl;
    }
    public function get_spmt(){
        return $this->_spmt;
    }
    public function get_skripsi(){
        return $this->_skripsi;
    }

    /*
     * destruktor
     */
    public function __destruct() {
        ;
    }
}
?>
