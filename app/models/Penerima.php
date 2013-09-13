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
    private $_tb_penerima = 'penerima_beasiswa';
    
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
            $penerima->set_jur($val['KD_JUR']);
            $penerima->set_bank($val['KD_BANK']);
            $penerima->set_status($val['KD_STATUS_TB']);
            $penerima->set_nip($val['NIP_PB']);
            $penerima->set_nama($val['NAMA_PB']);
            $penerima->set_jkel($val['JK_PB']);
            $penerima->set_gol($val['GOLONGAN_PB']);
            $penerima->set_unit_asal($val['UNIT_ASAL_PB']);
            $penerima->set_email($val['EMAIL_PB']);
            $penerima->set_telp($val['TELP_PB']);
            $penerima->set_alamat($val['ALAMAT_PB']);
            $penerima->set_no_rek($val['NO_REKENING_PB']);
            $penerima->set_foto($val['FOTO_PB']);
            $penerima->set_tgl_lapor($val['TANGGAL_LAPOR_PB']);
            $penerima->set_skl($val['NOMOR_SKL_PB']);
            $penerima->set_spmt($val['NO_SPMT_PB']);
            $penerima->set_skripsi($val['JUDUL_SKRIPSI_PB']);
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
            $this->set_status($val['KD_STATUS_TB']);
            $this->set_nip($val['NIP_PB']);
            $this->set_nama($val['NAMA_PB']);
            $this->set_jkel($val['JK_PB']);
            $this->set_gol($val['GOLONGAN_PB']);
            $this->set_unit_asal($val['UNIT_ASAL_PB']);
            $this->set_email($val['EMAIL_PB']);
            $this->set_telp($val['TELP_PB']);
            $this->set_alamat($val['ALAMAT_PB']);
            $this->set_no_rek($val['NO_REKENING_PB']);
            $this->set_foto($val['FOTO_PB']);
            $this->set_tgl_lapor($val['TANGGAL_LAPOR_PB']);
            $this->set_skl($val['NOMOR_SKL_PB']);
            $this->set_spmt($val['NO_SPMT_PB']);
            $this->set_skripsi($val['JUDUL_SKRIPSI_PB']);
        }
        return $this;
    }
    
    public function add_penerima($data=array()){
        if(!is_array($data)) return false;
        $this->db->insert($this->_tb_penerima,$data);
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
    public function update_penerima($data=array()){
        if(!is_array($data)) return false;
        $where = 'KD_PB = '.$this->get_kd_pb();
        $this->db->update($this->_tb_penerima,$data,$where);
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
