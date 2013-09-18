<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Pegawai{
    
    private $db;
    public $registry;
    private $_kd_peg;
    private $_nm_peg;
    private $_nip_peg;
    private $_jk;
    private $_gol;
    private $_unit_asal;
    private $_tb_peg = 'd_peg';
    
    public function __construct($registry) {
        $this->registry=$registry;
        $this->db = $registry->db;
    }
    
    public function get_peg_by_nip($peg = Pegawai){
        $sql = "SELECT * FROM ".$this->_tb_peg." WHERE NIP_PEG='".$peg->get_nip()."'";
        $result = $this->db->select($sql);
        foreach ($result as $val){
            $this->set_kd_peg($val['KD_PEG']);
            $this->set_nama($val['NM_PEG']);
            $this->set_jkel($val['JK_PEG']);
            $this->set_golongan($val['PKT_PEG']);
            $this->set_unit_asal($val['UNIT_PEG']);
        }
        
        return $this;
    }
    
    public function set_kd_peg($kode){
        $this->_kd_peg = $kode;
    }
    public function set_nip($nip){
        $this->_nip_peg = $nip;
    }
    public function set_nama($nama){
        $this->_nm_peg = $nama;
    }
    public function set_jkel($jk){
        $this->_jk = $jk;
    }
    public function set_golongan($gol){
        $this->_gol = $gol;
    }
    public function set_unit_asal($unit){
        $this->_unit_asal = $unit;
    }
    
    public function get_kd_peg(){
        return $this->_kd_peg;
    }
    public function get_nip(){
        return $this->_nip_peg;
    }
    public function get_nama(){
        return $this->_nm_peg;
    }
    public function get_jkel(){
        return $this->_jk;
    }
    public function get_golongan(){
        return $this->_gol;
    }
    public function get_unit_asal(){
        return $this->_unit_asal;
    }
    
    public function __destruct() {
        ;
    }
    
}
?>
