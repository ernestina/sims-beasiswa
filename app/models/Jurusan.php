<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Jurusan{
    private $db;
    public $registry;
    private $_table='r_jur';
    private $_tb_fakul = 'r_fakul';
    private $_tb_strata = 'r_strata';
    private $_tb_pic= 'r_pic';
    private $_kd_jur;
    private $_kd_fakul;
    private $_kd_strata;
    private $_nama;
    private $_alamat;
    private $_telepon;
    private $_pic;
    private $_telp_pic;
    private $_status;
    private $_valid = TRUE;
    private $_error;
    
    /*
     * konstruktor
     */
    public function __construct($registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }
    
    /*
     * mendapatkan data jurusan dari tabel jurusan
     * param posisi, batas default null
     * return array objek Jurusan
     */
    public function get_jurusan($limit=null,$batas=null){
        $sql = "SELECT a.KD_JUR as KD_JUR,
                b.NM_FAKUL as KD_FAKUL,
                a.KD_STRATA as KD_STRATA,
                a.NM_JUR as NM_JUR,
                a.ALMT_JUR as ALMT_JUR,
                a.TELP_JUR as TELP_JUR,
                a.PIC_JUR as PIC_JUR,
                a.TELP_PIC_JUR as TELP_PIC_JUR,
                a.STS_JUR as STS_JUR
                FROM ".$this->_table." a
                LEFT JOIN ".$this->_tb_fakul." b ON a.KD_FAKUL=b.KD_FAKUL";
        if(!is_null($limit) AND !is_null($batas)) {
            $sql .= " LIMIT ".$limit.",".$batas;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val){
            $jur = new $this($this->registry);
            $jur->set_kode_jur($val['KD_JUR']);
            $jur->set_kode_fakul($val['KD_FAKUL']);
            $strata = new Strata();
            $str_jur = $strata->get_by_id($val['KD_STRATA']);
            $jur->set_kode_strata($str_jur->nama_strata);
            $jur->set_nama($val['NM_JUR']);
            $jur->set_alamat($val['ALMT_JUR']);
            $jur->set_telepon($val['TELP_JUR']);
            $jur->set_pic($val['PIC_JUR']);
            $jur->set_telp_pic($val['TELP_PIC_JUR']);
            $jur->set_status($val['STS_JUR']);
            $data[]=$jur;
            unset($strata);
        }
        
        return $data;
    }
    
    /*
     * mendapatkan data jurusan sesuai dengan kd jurusan
     * param objek jurusan
     * return objek Jurusan
     */
    public function get_jur_by_id($jur = Jurusan){
        $sql = "SELECT * FROM ".$this->_table." WHERE KD_JUR=".$jur->get_kode_jur();
        $result = $this->db->select($sql);
        foreach ($result as $val){
            $this->set_kode_jur($val['KD_JUR']);
            $this->set_kode_fakul($val['KD_FAKUL']);
            $this->set_kode_strata($val['KD_STRATA']);
            $this->set_nama($val['NM_JUR']);
            $this->set_alamat($val['ALMT_JUR']);
            $this->set_telepon($val['TELP_JUR']);
            $this->set_pic($val['PIC_JUR']);
            $this->set_telp_pic($val['TELP_PIC_JUR']);
            $this->set_status($val['STS_JUR']);
        }
        
        return $this;
    }
    
    public function get_jur_fakul($univ=null){
        $sql = "SELECT ";
    }


    /*
     * menambah data jurusan
     * param data array
     */
    public function add_jurusan(){
        $data = array(
                'KD_FAKUL' => $this->get_kode_fakul(),
                'KD_STRATA' => $this->get_kode_strata(),
                'NM_JUR' => $this->get_nama(),
                'ALMT_JUR' => $this->get_alamat(),
                'TELP_JUR' => $this->get_telepon(),
                'PIC_JUR' => $this->get_pic(),
                'TELP_PIC_JUR' => $this->get_telp_pic(),
                'STS_JUR' => $this->get_status(),
            );
        $this->validate();
        if(!$this->get_valid()) return false;
        if(!is_array($data)) return false;
        return $this->db->insert($this->_table,$data);
    }
    
    /*
     * ubah data jurusan, kd jurusan harus sudah di set
     * param data array
     */
    public function update_jurusan(){
        $data = array(
                'KD_FAKUL' => $this->get_kode_fakul(),
                'KD_STRATA' => $this->get_kode_strata(),
                'NM_JUR' => $this->get_nama(),
                'ALMT_JUR' => $this->get_alamat(),
                'TELP_JUR' => $this->get_telepon(),
                'PIC_JUR' => $this->get_pic(),
                'TELP_PIC_JUR' => $this->get_telp_pic(),
                'STS_JUR' => $this->get_status(),
            );
        $this->validate();
        if(!$this->get_valid()) return false;
        if(!is_array($data)) return false;
        $where = ' kd_jur='.$this->get_kode_jur();
        $this->db->update($this->_table,$data, $where);
    }
    
    /*
     * hapus data jurusan, kd jurusan harus sudah di set
     */
    public function delete_jurusan(){
        $where = ' kd_jur='.$this->get_kode_jur();
        $this->db->delete($this->_table,$where);
    }
    
    public function validate(){
        if($this->get_kode_fakul()==0){
            $this->_error .= "Fakultas belum dipilih!</br>";
            $this->_valid = FALSE;
        }
        if($this->get_nama()=="" OR !Validasi::validate_string($this->get_nama())){
            $this->_error .= "Nama Fakultas belum diinput!</br>";
            $this->_valid = FALSE;
        }
        if($this->get_alamat()==""){
            $this->_error .= "Alamat belum diinput!</br>";
            $this->_valid = FALSE;
        }
        if($this->get_telepon()=="" OR !Validasi::validate_number($this->get_telepon())){
            $this->_error .= "Telepon belum diinput!</br>";
            $this->_valid = FALSE;
        }
        if($this->get_kode_strata()==0){
            $this->_error .= "Strata belum dipilih!</br>";
            $this->_valid = FALSE;
        }
        if($this->get_pic()==""){
            $this->_error .= "PIC jurusan belum diinput!</br>";
            $this->_valid = FALSE;
        }
        if($this->get_telp_pic()=="" OR !Validasi::validate_number($this->get_telepon())){
            $this->_error .= "telepon PIC belum diinput!</br>";
            $this->_valid = FALSE;
        }
        
    }


    /*
     * setter
     */
    public function set_table($table){
        $this->_table = $table;
    }
    
    public function set_kode_jur($kode){
        $this->_kd_jur = $kode;
    }
    
    public function set_kode_fakul($kode){
        $this->_kd_fakul = $kode;
    }
    
    public function set_kode_strata($kode){
        $this->_kd_strata = $kode;
    }
    
    public function set_nama($nama){
        $this->_nama = $nama;
    }
    
    public function set_alamat($alamat){
        $this->_alamat = $alamat;
    }
    
    public function set_telepon($telp){
        $this->_telepon = $telp;
    }
    
    public function set_pic($pic){
        $this->_pic = $pic;
    }
    
    public function set_telp_pic($telp){
        $this->_telp_pic = $telp;
    }
    
    public function set_status($status){
        $this->_status = $status;
    }
    
    /*
     * getter
     */
    public function get_kode_jur($where=null){
        if(!is_null($where)){
            $sql = "SELECT kd_jur FROM '".$this->_table."' WHERE '".$where."'";
            $result = $this->db->select($sql);
            foreach ($result as $val){
                $this->set_kode_jur($val['kd_jur']);
            }
        }
        return $this->_kd_jur;
    }
    
    public function get_kode_fakul(){
        return $this->_kd_fakul;
    }
    
    public function get_kode_strata(){
        return $this->_kd_strata;
    }
    
    public function get_nama(){
        return $this->_nama;
    }
    
    public function get_alamat(){
        return $this->_alamat;
    }
    
    public function get_telepon(){
        return $this->_telepon;
    }
    
    public function get_pic(){
        return $this->_pic;
    }
    
    public function get_telp_pic(){
        return $this->_telp_pic;
    }
    
    public function get_status(){
        return $this->_status;
    }
    
    public function get_valid(){
        return $this->_valid;
    }
    
    public function get_error(){
        return $this->_error;
    }

    public function __destruct() {
        ;
    }
    
     /*
     * mendapatkan seluruh data jurusan berdasarkan kd_univ
     * 
     * return array objek 
     */ 

    public function get_jur_by_univ($kd_univ) {
        $table = "r_jur a, r_fakul b";
        $where = "a.KD_FAKUL = b.KD_FAKUL and b.KD_UNIV = '".$kd_univ."'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val){
            $jur = new $this($this->registry);
            $jur->set_kode_jur($val['KD_JUR']);
            $jur->set_kode_fakul($val['KD_FAKUL']);
            $jur->set_kode_strata($val['KD_STRATA']);
            $jur->set_nama($val['NM_JUR']);
            $jur->set_alamat($val['ALMT_JUR']);
            $jur->set_telepon($val['TELP_JUR']);
            $jur->set_pic($val['PIC_JUR']);
            $jur->set_telp_pic($val['TELP_PIC_JUR']);
            $jur->set_status($val['STS_JUR']);
            $data[]=$jur;
        }
        
        return $data;
    }
}
?>
