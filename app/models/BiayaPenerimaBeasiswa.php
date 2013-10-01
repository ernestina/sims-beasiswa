<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class BiayaPenerimaBeasiswa{
    
    private $_nm_biaya;
    private $_jml;
    
    public function __construct() {
        ;
    }
    
    /*
     * setter
     */
    public function set_nama_biaya($nama){
        $this->_nm_biaya = $nama;
    }

    public function set_jumlah_biaya($jumlah){
        $this->_jml = $jumlah;
    }


    /*
     * getter
     */
    public function get_nama_biaya(){
        return $this->_nm_biaya;
    }

    public function get_jumlah_biaya(){
        return $this->_jml;
    }
    
    public function __destruct() {
        ;
    }
}
?>
