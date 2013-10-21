<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class NotifikasiDao{
    
    private $_kode_link;
    private $_jns_notif;
    private $_univ;
    private $_jurusan;
    private $_thn_masuk;
    private $_jatuh_tempo;
    private $_status_notif;
    private $_pic = array();
    private $_link;
    private $_foto_pic;
    
    public function set_kode_link($kode_link){
        $this->_kode_link = $kode_link;
    }
    
    public function set_jenis_notif($jenis_notif){
        $this->_jns_notif = $jenis_notif;
    }
    
    public function set_univ($univ){
        $this->_univ = $univ;
    }
    
    public function set_jurusan($jurusan){
        $this->_jurusan = $jurusan;
    }
    
    public function set_tahun_masuk($tahun_masuk){
        $this->_thn_masuk = $tahun_masuk;
    }
    
    public function set_jatuh_tempo($jatuh_tempo){
        $this->_jatuh_tempo = $jatuh_tempo;
    }
    
    public function set_status_notif($status_notif){
        $this->_status_notif = $status_notif;
    }
    
    public function set_pic(array $pic){
        $this->_pic = $pic;
    }
    
    public function set_link($link){
        $this->_link = $link;
    }
    
    public function get_kode_link(){
        return $this->_kode_link;
    }
    
    public function get_jenis_notif(){
        return $this->_jns_notif;
    }
    
    public function get_univ(){
        return $this->_univ;
    }
    
    public function get_jurusan(){
        return $this->_jurusan;
    }
    
    public function get_tahun_masuk(){
        return $this->_thn_masuk;
    }
    
    public function get_jatuh_tempo(){
        return $this->_jatuh_tempo;
    }
    
    public function get_status_notif(){
        return $this->_status_notif;
    }
    
    public function get_pic(){
        return $this->_pic;
    }
    
    public function get_link(){
        return $this->_link;
    }
}
?>
