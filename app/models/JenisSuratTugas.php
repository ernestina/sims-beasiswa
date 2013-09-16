<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class JenisSuratTugas{
    
    private $_kd;
    private $_nama;
    private $_keterangan;
    
    public function __construct() {
        ;
    }
    
    public function set_kode($kode){
        $this->_kd = $kode;
    }
    
    public function set_nama($nama){
        $this->_nama = $nama;
    }
    
    public function set_keterangan($ket){
        $this->_keterangan = $ket;
    }
    
    public function get_kode(){
        return $this->_kd;
    }
    
    public function get_nama(){
        return $this->_nama;
    }
    
    public function get_keterangan(){
        return $this->_keterangan;
    }

    public function __destruct() {
        ;
    }
}
?>
