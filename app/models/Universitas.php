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
    private $_error;
    private $_valid = TRUE;
    private $_table = 'r_univ';
    public $registry;
    
    /*
     * konstruktor
     */
    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }
    
    /*
     * mendapatkan data dari tabel universitas
     * @param limit batas default null
     * return array objek universitas
     */
    public function get_univ($limit=null,$batas=null){
        $sql = "SELECT * FROM ".$this->_table." ";
        if(!is_null($limit) AND !is_null($batas)){
            $sql .= " LIMIT ".$limit.",".$batas;
        }
        $result = $this->db->select($sql);
        $data=array();
        foreach ($result as $val){
            $univ = new $this($this->registry);
            $univ->set_kode_in($val['KD_UNIV']);
            $univ->set_kode($val['SINGKAT_UNIV']);
            $univ->set_pic($val['KD_PIC']);
            $univ->set_nama($val['NM_UNIV']);
            $univ->set_alamat($val['ALMT_UNIV']);
            $univ->set_telepon($val['TELP_UNIV']);
            $univ->set_status($val['STATUS_UNIV']);
            $univ->set_lokasi($val['LOK_UNIV']);
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
        $sql = "SELECT * FROM ".$univ->_table." WHERE KD_UNIV=".$univ->get_kode_in();
//        var_dump($sql);
        $result = $this->db->select($sql);
        foreach ($result as $val){
            $this->set_kode_in($val['KD_UNIV']);
            $this->set_kode($val['SINGKAT_UNIV']);
            $this->set_pic($val['KD_PIC']);
            $this->set_nama($val['NM_UNIV']);
            $this->set_alamat($val['ALMT_UNIV']);
            $this->set_telepon($val['TELP_UNIV']);
            $this->set_status($val['STATUS_UNIV']);
            $this->set_lokasi($val['LOK_UNIV']);
        }
        return $this;
    }
    
    /*
     * tambah data universitas
     * param array data array key=>value, nama kolom=>data
     */
    public function add_univ(){
        $data = array(
                'KD_USER' => $this->get_pic(),
                'SINGKAT_UNIV' => $this->get_kode(),
                'NM_UNIV' => $this->get_nama(),
                'ALMT_UNIV' => $this->get_alamat(),
                'TELP_UNIV' => $this->get_telepon(),
                'LOK_UNIV' => $this->get_lokasi()
            );
        $this->validate();
        if(!$this->get_valid()) return false;
        if(!is_array($data)) return false;
        return $this->db->insert($this->_table,$data);
    }
    
    /*
     * update universitas, id harus di set terlebih dahulu
     * param data array
     */
    public function update_univ(){
        $data = array(
                'KD_USER' => $this->get_pic(),
                'SINGKAT_UNIV' => $this->get_kode(),
                'NM_UNIV' => $this->get_nama(),
                'ALMT_UNIV' => $this->get_alamat(),
                'TELP_UNIV' => $this->get_telepon(),
                'LOK_UNIV' => $this->get_lokasi()
            );
        $this->validate();
        if(!$this->get_valid()) return false;
        if(!is_array($data)) return false;
        $where = ' KD_UNIV='.$this->get_kode_in();
        $this->db->update($this->_table,$data, $where);
    }
    
    /*
     * hapus universitas, id harus di set terlebih dahulu
     */
    public function delete_univ(){
        $where = ' KD_UNIV='.$this->get_kode_in();
        $this->db->delete($this->_table,$where);
    }
    
    public function validate(){
        if($this->get_pic()==0){
            $this->_error .= "User belum dipilih!</br>";
            $this->_valid = FALSE;
        }
        if($this->get_kode()==""){
            $this->_error .= "Nama singkat Perguruan Tinggi belum diinput!<?br>";
            $this->_valid = FALSE;
        }
        if($this->get_nama()=="" OR !Validasi::validate_string($this->get_nama())){
            $this->_error .= "Nama Perguruan Tinggi belum diinput!</br>";
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
        if($this->get_lokasi()=="" OR !Validasi::validate_string($this->get_lokasi())){
            $this->_error .= "Lokasi belum diinput!</br>";
            $this->_valid = FALSE;
        }
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
            $sql = "SELECT KD_UNIV FROM '".$this->_table."' WHERE '".$where."'";
            $result = $this->db->select($sql);
            foreach ($result as $val){
                $this->set_kode_in($val['KD_UNIV']);
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
    
    public function get_error(){
        return $this->_error;
    }
    
    public function get_valid(){
        return $this->_valid;
    }
    
    /*
     * destruktor
     */
    public function __destruct() {
        ;
    }
	
	public function get_univ_by_jur($kd_jur) {
        $table = "r_jur a, r_fakul b, r_univ c";
        $where = "c.KD_UNIV = b.KD_UNIV AND b.KD_FAKUL=a.KD_FAKUL AND a.KD_JUR = '" . $kd_jur . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        // $data = array();
        foreach ($result as $val) {
            $this->set_kode_in($val['KD_UNIV']);
            $this->set_kode($val['SINGKAT_UNIV']);
            $this->set_pic($val['KD_PIC']);
            $this->set_nama($val['NM_UNIV']);
            $this->set_alamat($val['ALMT_UNIV']);
            $this->set_telepon($val['TELP_UNIV']);
            $this->set_status($val['STATUS_UNIV']);
            $this->set_lokasi($val['LOK_UNIV']);
        }
        return $this;
    }
    
}
?>
