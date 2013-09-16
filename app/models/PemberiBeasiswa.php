<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PemberiBeasiswa{
    
    private $_kode;
    private $_nama;
    private $_alamat;
    private $_telp;
    private $_pic;
    private $_telp_pic;
    private $_table = 'r_pemb';
    
    public function __construct() {
        ;
    }
    
    public function get_pemb_beasiswa(){
        
    }

    public function set_kode($kode){
        $this->_kode = $kode;
    }
    
    public function set_nama($nama){
        $this->_nama = $nama;
    }
    
    public function set_alamat($alamat){
        $this->_alamat = $alamat;
    }
    
    public function set_telp($telp){
        $this->_telp = $telp;
    }
    
    public function set_pic($pic){
        $this->_pic = $pic;
    }
    
    public function set_telp_pic($telp){
        $this->_telp_pic = $telp;
    }
    
    public function get_kode(){
        return $this->_kode;
    }
    
    public function get_nama(){
        return $this->_nama ;
    }
    
    public function get_alamat(){
        return $this->_alamat ;
    }
    
    public function get_telp(){
        return $this->_telp ;
    }
    
    public function get_pic(){
        return $this->_pic ;
    }
    
    public function get_telp_pic(){
        return $this->_telp_pic ;
    }

    public function __destruct() {
        ;
    }
}
?>
