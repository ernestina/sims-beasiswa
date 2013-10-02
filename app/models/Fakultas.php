<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Fakultas{
    
    private $db;
    public $registry;
    private $_table='r_fakul';
    private $_tb_univ = 'r_univ';
    private $_kd_fakul;
    private $_kd_univ;
    private $_nama_fakul;
    private $_alamat;
    private $_telepon;
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
     * mendapatkan data fakultas dari tabel fakultas
     * param posisi, batas default null
     * return array objek fakultas
     */
    public function get_fakul($limit=null, $batas=null){
        $sql = "SELECT a.KD_FAKUL as KD_FAKUL,
                b.NM_UNIV as KD_UNIV,
                a.NM_FAKUL as NM_FAKUL,
                a.ALMT_FAKUL as ALMT_FAKUL,
                a.TELP_FAKUL as TELP_FAKUL
                FROM ".$this->_table." a
                LEFT JOIN ".$this->_tb_univ." b ON a.KD_UNIV=b.KD_UNIV";
        if(!is_null($limit) AND !is_null($batas)) {
            $sql .= " LIMIT ".$limit.",".$batas;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach($result as $val){
            $fakul = new $this($this->registry);
            $fakul->set_kode_fakul($val['KD_FAKUL']);
            $fakul->set_kode_univ($val['KD_UNIV']);
            $fakul->set_nama($val['NM_FAKUL']);
            $fakul->set_alamat($val['ALMT_FAKUL']);
            $fakul->set_telepon($val['TELP_FAKUL']);
            $data[] = $fakul;
        }
        return $data;
    }
    
    /*
     * mendapatkan data fakultas sesuai id
     * param objek Fakultas -> kd_fakul harus sudah terisi
     * return objek fakultas
     */
    public function get_fakul_by_id($fakul=  Fakultas){
        if(is_null($fakul->get_kode_fakul())){
            return false;
        }
        $sql = "SELECT * FROM ".$this->_table." WHERE KD_FAKUL=".$fakul->get_kode_fakul();
        $result = $this->db->select($sql);
        foreach($result as $val){
            $this->set_kode_fakul($val['KD_FAKUL']);
            $this->set_kode_univ($val['KD_UNIV']);
            $this->set_nama($val['NM_FAKUL']);
            $this->set_alamat($val['ALMT_FAKUL']);
            $this->set_telepon($val['TELP_FAKUL']);
        }
        
        return $this;
    }
    
    /*
     * menambahkan data fakultas
     * param array data
     */
    public function add_fakul(){
        $data = array(
                'KD_UNIV' => $this->get_kode_univ(),
                'NM_FAKUL' => $this->get_nama(),
                'ALMT_FAKUL' => $this->get_alamat(),
                'TELP_FAKUL' => $this->get_telepon()
            );
        $this->validate();
        if(!$this->get_valid()) return false;
        if(!is_array($data)) return false;
        $this->db->insert($this->_table,$data);
    }
    
    /*
     * ubah data fakultas, kd_fakul harus sudah di set
     * param array data
     */
    public function update_fakul($data=array()){
        $data = array(
                'KD_UNIV' => $this->get_kode_univ(),
                'NM_FAKUL' => $this->get_nama(),
                'ALMT_FAKUL' => $this->get_alamat(),
                'TELP_FAKUL' => $this->get_telepon()
            );
        $this->validate();
        if(!$this->get_valid()) return false;
        if(!is_array($data)) return false;
        $where = ' KD_FAKUL='.$this->get_kode_fakul();
        return $this->db->update($this->_table,$data, $where);
    }
    
    /*
     * hapus fakultas, kd_fakul harus sudah diset
     */
    public function delete_fakul(){
        $where = ' KD_FAKUL='.$this->get_kode_fakul();
        $this->db->delete($this->_table,$where);
    }
    
    public function validate(){
        if($this->get_kode_univ()==0){
            $this->_error .= "Universitas belum dipilih!</br>";
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
    }

    /*
     * setter
     */
    public function set_table($table){
        $this->table = $table;
    }
    
    public function set_kode_fakul($kode){
        $this->_kd_fakul = $kode;
    }
    
    public function set_kode_univ($kode){
        $this->_kd_univ = $kode;
    }
    
    public function set_nama($nama){
        $this->_nama_fakul = $nama;
    }
    
    public function set_alamat($alamat){
        $this->_alamat = $alamat;
    }
    
    public function set_telepon($telp){
        $this->_telepon = $telp;
    }

    /*
     * getter
     */
    public function get_kode_fakul($where=null){
        if(!is_null($where)){
            $sql = "SELECT KD_FAKUL FROM '".$this->_table."' WHERE '".$where."'";
            $result = $this->db->select($sql);
            foreach ($result as $val){
                $this->set_kode_fakul($val['KD_FAKUL']);
            }
        }
        return $this->_kd_fakul;
    }
    
    public function get_kode_univ(){
        return $this->_kd_univ;
    }
    
    public function get_nama(){
        return $this->_nama_fakul;
    }
    
    public function get_alamat(){
        return $this->_alamat;
    }
    
    public function get_telepon(){
        return $this->_telepon;
    }

    public function get_valid(){
        return $this->_valid;
    }
    
    public function get_error(){
        return $this->_error;
    }
    /*
     * destruktor
     */
    public function __destruct() {
        ;
    }
}
?>
