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
    private $_tb_peg = 'd_sik';
    
    public function __construct($registry) {
        $this->registry=$registry;
        $this->db = $registry->db;
    }
    
    public function get_peg_by_nip($peg = Pegawai){
        $sql = "SELECT 
            a.nip as nip,
            a.nama as nama,
            a.sex as sex,
            a.gol as gol,
            b.new as unit
            FROM ".$this->_tb_peg." a
                LEFT JOIN ref_unit_convert_2013 b ON a.unit = b.idNew 
                WHERE a.nip='".$peg->get_nip()."'";
        $result = $this->db->select($sql);
        foreach ($result as $val){
            $this->set_kd_peg($val['nip']);
            $this->set_nama($val['nama']);
            $this->set_jkel($val['sex']);
            $this->set_golongan($val['gol']);
            $this->set_unit_asal($val['unit']);
        }
        
        return $this;
    }
    
     public function get_penerima_by_nip($peg = Pegawai,$filter=false){
        $sql = "SELECT 
            DISTINCT(a.nip) as nip,
            a.nama as nama,
            a.sex as sex,
            a.gol as gol
            FROM ".$this->_tb_peg." a ";
        if($filter){
            $sql .= " LEFT JOIN d_pb b ON a.nip<>b.NIP_PB ";
        }
        $sql .= "WHERE a.nip LIKE '".$peg->get_kd_peg()."%'";
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val){
            $tmp = new Pegawai($this->registry);
            $tmp->set_kd_peg($val['nip']);
            $tmp->set_nama($val['nama']);
            $tmp->set_jkel($val['sex']);
            $tmp->set_golongan($val['gol']);
            $tmp->set_unit_asal($val['unit']);
            $data[] = $tmp;
        }
        return $data;
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
