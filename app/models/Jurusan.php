<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Jurusan{
    private $db;
    public $registry;
    private $_table='r_jur';
    private $_kd_jur;
    private $_kd_fakul;
    private $_kd_strata;
    private $_nama;
    private $_alamat;
    private $_telepon;
    private $_pic;
    private $_telp_pic;
    private $_status;
    
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
        $sql = "SELECT * FROM '".$this->_table."' ";
        if(!is_null($limit) AND !is_null($batas)) {
            $sql .= " LIMIT ".$limit.",".$batas;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val){
            $jur = new $this($this->registry);
            $jur->set_kode_jur($val['kd_jur']);
            $jur->set_kode_fakul($val['kd_fakul']);
            $jur->set_kode_strata($val['kd_strata']);
            $jur->set_nama($val['nama_jur']);
            $jur->set_alamat($val['alamat_jur']);
            $jur->set_telepon($val['telp_jur']);
            $jur->set_pic($val['pic_jur']);
            $jur->set_telp_pic($val['telp_pic_jur']);
            $jur->set_status($val['status_jur']);
            $data[]=$jur;
        }
        
        return $data;
    }
    
    /*
     * mendapatkan data jurusan sesuai dengan kd jurusan
     * param objek jurusan
     * return objek Jurusan
     */
    public function get_jur_by_id($jur = Jurusan){
        $sql = "SELECT * FROM '".$this->_table."' WHERE kd_jur=".$jur->get_kode_jur();
        $result = $this->db->select($sql);
        foreach ($result as $val){
            $this->set_kode_jur($val['kd_jur']);
            $this->set_kode_fakul($val['kd_fakul']);
            $this->set_kode_strata($val['kd_strata']);
            $this->set_nama($val['nama_jur']);
            $this->set_alamat($val['alamat_jur']);
            $this->set_telepon($val['telp_jur']);
            $this->set_pic($val['pic_jur']);
            $this->set_telp_pic($val['telp_pic_jur']);
            $this->set_status($val['status_jur']);
        }
        
        return $this;
    }
    
    /*
     * menambah data jurusan
     * param data array
     */
    public function add_jurusan($data=array()){
        if(!is_array($data)) return false;
        $this->db->insert($this->_table,$data);
    }
    
    /*
     * ubah data jurusan, kd jurusan harus sudah di set
     * param data array
     */
    public function update_jurusan($data=array()){
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

    public function __destruct() {
        ;
    }
}
?>
