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

    public function get_penerima($posisi=null,$batas=null){
        $sql = "SELECT * FROM ".$this->_tb_penerima;
        if(!is_null($posisi) AND !is_null($batas)){
            $sql .= " LIMIT ".$posisi.",".$batas;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach($result as $val){
            $penerima = new $this($this->registry);
            $penerima->set_kd_pb($val['KD_PB']);
            $penerima->set_st($val['KD_ST']);
            $jur = new Jurusan($this->registry);
            $jur->set_kode_jur($val['KD_JUR']);
            $d_jur = $jur->get_jur_by_id($jur);
            $nm_jur = $d_jur->get_nama();
            $penerima->set_jur($nm_jur);
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
            unset($jur);
            $data[] = $penerima;
        }
        return $data;
    }
    
    public function get_penerima_by_id($pb = Penerima){
        $sql = "SELECT * FROM ".$this->_tb_penerima." WHERE KD_PB=".$pb->get_kd_pb();
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
    
    public function get_penerima_by_st($pb = Penerima){
        $sql = "SELECT * FROM ".$this->_tb_penerima." WHERE KD_ST=".$pb->get_st();
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
    
    public function get_penerima_by_name($pb = Penerima, $filter_st=false){
        $sql = "SELECT * FROM ".$this->_tb_penerima." WHERE NM_PB LIKE '%".$pb->get_nama()."%'"; 
        if($filter_st){
            $sql .= " AND KD_ST=".$pb->get_st();
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
    
    public function get_penerima_by_column($pb = Penerima, $cat="",$info = false){
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
        if($info){
            $sql .= "LEFT JOIN d_srt_tugas b ON a.KD_ST=b.KD_ST
                LEFT JOIN r_jur c ON a.KD_JUR=c.KD_JUR
                LEFT JOIN r_stb d ON a.KD_STS_TB=d.KD_STS_TB
                LEFT JOIN r_bank e ON a.KD_BANK=e.KD_BANK 
                LEFT JOIN r_fakul f ON c.KD_FAKUL=f.KD_FAKUL
                LEFT JOIN r_univ g ON f.KD_UNIV=g.KD_UNIV
                LEFT JOIN r_strata h ON c.KD_STRATA=h.KD_STRATA ";
        }
        if($cat=='nip'){
            $sql .= "WHERE NIP_PB =".$pb->get_nip();
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
