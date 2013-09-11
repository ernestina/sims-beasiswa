<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Universitas {
    
    private $db;
    private $_kd_univ;
    private $_kode_univ;
    private $_kode_pic;
    private $_nama;
    private $_alamat;
    private $_telepon;
    private $_status;
    private $_lokasi;
    private $_table = 'r_univ';
    public $registry;
    
    /*
     * konstruktor
     */
    public function __construct($registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }
    
    /*
     * mendapatkan data dari tabel universitas
     * @param limit batas default null
     * return array objek universitas
     */
    public function get_univ($limit=null,$batas=null){
        $sql = "SELECT * FROM '".$this->_table."' ";
        if(!is_null($limit) AND !is_null($batas)){
            $sql .= " LIMIT ".$limit.",".$batas;
        }
        $result = $this->db->select($sql);
        $data=array();
        foreach ($result as $val){
            $univ = new $this($this->registry);
            $univ->set_kode_in($val['kd_univ']);
            $univ->set_kode($val['kode_univ']);
            $univ->set_pic($val['kd_pic']);
            $univ->set_nama($val['nama_univ']);
            $univ->set_alamat($val['alamat_univ']);
            $univ->set_telepon($val['telp_univ']);
            $univ->set_status($val['status_univ']);
            $univ->set_lokasi($val['lokasi_univ']);
            $data[] = $univ;
        }
        
        return $data;
    }
    
    /*
     * mendapatkan universitas sesuai id
     * @param objek Universitas
     * return objek Universitas
     */
    public function get_univ_by_id($univ = Universitas){
        if(is_null($univ->get_kode_in())){
            return false;
        }
        $sql = "SELECT * FROM '".$univ->_table."' WHERE kode_univ=".$univ->get_kode_in();
        $result = $this->db->select($sql);
        foreach ($result as $val){
            $this->set_kode_in($val['kd_univ']);
            $this->set_kode($val['kode_univ']);
            $this->set_pic($val['kd_pic']);
            $this->set_nama($val['nama_univ']);
            $this->set_alamat($val['alamat_univ']);
            $this->set_telepon($val['telp_univ']);
            $this->set_status($val['status_univ']);
            $this->set_lokasi($val['lokasi_univ']);
        }
        return $this;
    }
    
    /*
     * tambah data universitas
     * param array data array key=>value, nama kolom=>data
     */
    public function add_univ($data=array()){
        if(!is_array($data)) return false;
        $this->db->insert($this->_table,$data);
    }
    
    /*
     * update universitas, id harus di set terlebih dahulu
     * param data array
     */
    public function update_univ($data=array()){
        if(!is_array($data)) return false;
        $where = ' kd_univ='.$this->get_kode_in();
        $this->db->update($this->_table,$data, $where);
    }
    
    /*
     * hapus universitas, id harus di set terlebih dahulu
     */
    public function delete_univ(){
        $where = ' kd_univ='.$this->get_kode_in();
        $this->db->delete($this->_table,$where);
    }
    
    /*
     * setter
     */
    public function set_kode_in($kode){
        $this->_kd_univ = $kode;
    }
    
    public function set_kode($kode){
        $this->_kode_univ = $kode;
    }
    
    public function set_pic($pic){
        $this->_kode_pic = $pic;
    }
    
    public function set_nama($nama){
        $this->_nama = $nama;
    }
    
    public function set_alamat($alamat){
        $this->_alamat = $alamat;
    }
    
    public function set_telepon($telepon){
        $this->_telepon = $telepon;
    }
    
    public function set_status($status){
        $this->_status = $status;
    }
    
    public function set_lokasi($lokasi){
        $this->_lokasi = $lokasi;
    }
    
    public function set_table($table){
        $this->_table = $table;
    }
    
    /*
     * getter
     */
    public function get_kode_in($where=null){
        if(!is_null($where)){
            $sql = "SELECT kd_univ FROM '".$this->_table."' WHERE '".$where."'";
            $result = $this->db->select($sql);
            foreach ($result as $val){
                $this->set_kode_in($val['kd_univ']);
            }
        }
        return $this->_kd_univ;
    }

    public function get_kode(){
        return $this->_kode_univ;
    }
    
    public function get_pic(){
        return $this->_kode_pic;
    }
    
    public function get_alamat(){
        return $this->_alamat;
    }
    
    public function get_lokasi(){
        return $this->_lokasi;
    }
    
    public function get_nama(){
        return $this->_nama;
    }
    
    public function get_status(){
        return $this->_status;
    }
    
    public function get_telepon(){
        return $this->_telepon;
    }
    
    /*
     * destruktor
     */
    public function __destruct() {
        ;
    }
    
}
?>
