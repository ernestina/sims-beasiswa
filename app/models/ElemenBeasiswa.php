<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ElemenBeasiswa {
    
    private $db;
    private $_kd_d;
    private $_kd_r;
    private $_kd_jur;
    private $_jml_peg;
    private $_bln;
    private $_thn;
    private $_total_bayar;
    private $_no_sp2d;
    private $_tgl_sp2d;
    private $_file_sp2d;
    private $_table = 'd_elemen_beasiswa';
    private $_table_univ = 'r_univ';
    private $_table_fakul = 'r_fakul';
    private $_table_jur = 'r_jur';
    private $_table_gol = 'r_gol';
    public $registry;
    
    /*
     * konstruktor
     */
    public function __construct($registry = Registry) {
        $this->db = new Database();
        $this->registry = $registry;
    }
    
    /*
     * mendapatkan data dari tabel universitas
     * @param limit batas default null
     * return array objek universitas
     */
    public function get_elem($r_elem=null,$limit=null,$batas=null){
        $sql = "SELECT * FROM ".$this->_table;
        if(!is_null($r_elem)){
            $sql .= " WHERE KD_R_ELEM_BEASISWA =".$r_elem;
        }
        if(!is_null($limit) AND !is_null($batas)){
            $sql .= " LIMIT ".$limit.",".$batas;
        }
        $result = $this->db->select($sql);
        $data=array();
        foreach ($result as $val){
            $elem = new $this($this->registry);
            $elem->set_kd_d($val['KD_D_ELEM_BEASISWA']);
            $elem->set_kd_r($val['KD_R_ELEM_BEASISWA']);
            $elem->set_kd_jur($val['KD_JUR']);
            $elem->set_jml_peg($val['JML_PEG_D_ELEM_BEASISWA']);
            $elem->set_bln($val['BLN_D_ELEM_BEASISWA']);
            $elem->set_thn($val['THN_D_ELEM_BEASISWA']);
            $elem->set_total_bayar($val['TOTAL_BAYAR_D_ELEM_BEASISWA']);
            $elem->set_no_sp2d($val['NO_SP2D_D_ELEM_BEASISWA']);
            $elem->set_tgl_sp2d($val['TGL_SP2D_D_ELEM_BEASISWA']);
            $elem->set_file_sp2d($val['FILE_SP2D_D_ELEM_BEASISWA']);
            $data[] = $elem;
        }
        
        return $data;
    }
    
    /*
     * mendapatkan universitas sesuai id
     * @param objek Universitas
     * return objek Universitas
     */
    public function get_elem_by_id($elem = ElemenBeasiswa ){
        if(is_null($elem->get_kd_d())){
            return false;
        }
        $sql = "SELECT * FROM ".$elem->_table." WHERE KD_D_ELEM_BEASISWA=".$elem->get_kd_d()."";
//        var_dump($sql);
        $result = $this->db->select($sql);
        foreach ($result as $val){
            $this->set_kd_d($val['KD_D_ELEM_BEASISWA']);
            $this->set_kd_r($val['KD_R_ELEM_BEASISWA']);
            $elem->set_kd_jur($val['KD_JUR']);
            $this->set_jml_peg($val['JML_PEG_D_ELEM_BEASISWA']);
            $this->set_bln($val['BLN_D_ELEM_BEASISWA']);
            $this->set_thn($val['THN_D_ELEM_BEASISWA']);
            $this->set_total_bayar($val['TOTAL_BAYAR_D_ELEM_BEASISWA']);
            $this->set_no_sp2d($val['NO_SP2D_D_ELEM_BEASISWA']);
            $this->set_tgl_sp2d($val['TGL_SP2D_D_ELEM_BEASISWA']);
            $this->set_file_sp2d($val['FILE_SP2D_D_ELEM_BEASISWA']);
        }
        return $this;
    }
    
    /*
     * tambah data universitas
     * param array data array key=>value, nama kolom=>data
     */
    public function add_elem(ElemenBeasiswa $elem){
//        if(!is_array($data)) return false;
        $data = array (
            'KD_R_ELEM_BEASISWA' =>$elem->get_kd_r(),
            'KD_JUR' =>$elem->get_kd_jur(),
            'JML_PEG_D_ELEM_BEASISWA' =>$elem->get_jml_peg(),
            'BLN_D_ELEM_BEASISWA' => $elem->get_bln(),
            'THN_D_ELEM_BEASISWA' => $elem->get_thn(),
            'TOTAL_BAYAR_D_ELEM_BEASISWA' => $elem->get_total_bayar(),
            'NO_SP2D_D_ELEM_BEASISWA' =>$elem->get_no_sp2d(),
            'TGL_SP2D_D_ELEM_BEASISWA' =>$elem->get_tgl_sp2d(),
            'FILE_SP2D_D_ELEM_BEASISWA' =>$elem->get_file_sp2d()
                );
            
        $this->db->insert($this->_table,$data);
    }
    
    /*
     * update universitas, id harus di set terlebih dahulu
     * param data array
     */
    public function update_elem($data=array()){
        if(!is_array($data)) return false;
        $where = 'KD_D_ELEM_BEASISWA='.$this->get_kd_d();
        $this->db->update($this->_table,$data, $where);
    }
    
    /*
     * hapus universitas, id harus di set terlebih dahulu
     */
    public function delete_elem(){
        $where = ' KD_D_ELEM_BEASISWA='.$this->get_kd_d();
        $this->db->delete($this->_table,$where);
    }
    
    public function get_elem_per_pb(Penerima $pb, $lunas=false){
        $sql = "SELECT a.KD_D_ELEM_BEASISWA AS KD_D_ELEM_BEASISWA,
            b.NM_ELEM_BEASISWA as KD_R_ELEM_BEASISWA,
            a.JML_PEG_D_ELEM_BEASISWA as JML_PEG_D_ELEM_BEASISWA,
            a.BLN_D_ELEM_BEASISWA as BLN_D_ELEM_BEASISWA,
            a.THN_D_ELEM_BEASISWA as THN_D_ELEM_BEASISWA,
            a.TOTAL_BAYAR_D_ELEM_BEASISWA as TOTAL_BAYAR_D_ELEM_BEASISWA,
            c.KD_PB as KD_PB,
            a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_D_ELEM_BEASISWA
            FROM ".$this->_table." a 
                LEFT JOIN r_elem_beasiswa b ON a.KD_R_ELEM_BEASISWA = b.KD_R_ELEM_BEASISWA
                LEFT JOIN t_elem_beasiswa c ON a.KD_D_ELEM_BEASISWA = c.KD_D_ELEM_BEASISWA
                WHERE c.KD_PB=".$pb->get_kd_pb();
        if($lunas){
            $sql .= " AND a.NO_SP2D_D_ELEM_BEASISWA<>NULL";
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $v){
            $elem = new $this($this->registry);
            $elem->set_kd_d($v['KD_D_ELEM_BEASISWA']);
            $elem->set_kd_r($v['KD_R_ELEM_BEASISWA']);
            $jml_peg = (int) $v['JML_PEG_D_ELEM_BEASISWA'];
            $total_bayar = (int) $v['TOTAL_BAYAR_D_ELEM_BEASISWA'];
            $by_per_peg = ($total_bayar/$jml_peg);
            $elem->set_total_bayar($by_per_peg);
            $elem->set_bln(Tanggal::bulan_indo($v['BLN_D_ELEM_BEASISWA']));
            $elem->set_thn($v['THN_D_ELEM_BEASISWA']);
            $elem->set_no_sp2d($v['NO_SP2D_KD_D_ELEM_BEASISWA']);
            $elem->set_no_sp2d($v['NO_SP2D_D_ELEM_BEASISWA']);
            $data[] = $elem;
        }
        
        return $data;
    }


    /*
     * setter
     */
    public function set_kd_d($kd_d){
        $this->_kd_d = $kd_d;
    }
    
    public function set_kd_r($kd_r){
        $this->_kd_r = $kd_r;
    }
    
    public function set_kd_jur($kd_jur){
        $this->_kd_jur = $kd_jur;
    }
    
    public function set_jml_peg($jml_peg){
        $this->_jml_peg = $jml_peg;
    }
    
    public function set_bln($bln){
        $this->_bln = $bln;
    }
    
    public function set_thn($thn){
        $this->_thn = $thn;
    }
    
    public function set_total_bayar($total_bayar){
        $this->_total_bayar = $total_bayar;
    }
    
    public function set_no_sp2d($no_sp2d){
        $this->_no_sp2d = $no_sp2d;
    }
    
    public function set_tgl_sp2d($tgl_sp2d){
        $this->_tgl_sp2d = $tgl_sp2d;
    }
    
    public function set_file_sp2d($file_sp2d){
        $this->_file_sp2d = $file_sp2d;
    }
    
    public function set_table($table){
        $this->_table = $table;
    }
    
    /*
     * getter
     */
    public function get_kd_d($where=null){
        if(!is_null($where)){
            $sql = "SELECT KD_D_ELEM_BEASISWA FROM '".$this->_table."' WHERE '".$where."'";
            $result = $this->db->select($sql);
            foreach ($result as $val){
                $this->set_kd_d($val['KD_D_ELEM_BEASISWA']);
            }
        }
        return $this->_kd_d;
    }

    public function get_kd_r(){
        return $this->_kd_r;
    }
    
    public function get_kd_jur(){
        return $this->_kd_jur;
    }
    
    public function get_jml_peg(){
        return $this->_jml_peg;
    }
    
    public function get_bln(){
        return $this->_bln;
    }
    
    public function get_thn(){
        return $this->_thn;
    }
    
    public function get_total_bayar(){
        return $this->_total_bayar;
    }
    
    public function get_no_sp2d(){
        return $this->_no_sp2d;
    }
    
    public function get_tgl_sp2d(){
        return $this->_tgl_sp2d;
    }
    
    public function get_file_sp2d(){
        return $this->_file_sp2d;
    }
    
    /*
     * destruktor
     */
    public function __destruct() {
        ;
    }
    
}
?>
