<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Cuti{
    public $registry;
    private $_db;
    private $t_cuti = 'd_cuti';
    private $_kd_cuti;
    private $_jsc;
    private $_pb;
    private $_no_sc;
    private $_tgl_sc;
    private $_periode_mul; //periode mulai cuti/semester
    private $_periode_sel;
    private $_perk_go; //perkiraan bulan dihentikan pembayaran elemen beasiswa
    private $_perk_stop; //perkiraan bulan dimulai pembayaran elemen beasiswa
    
    public function __construct($registry = Registry){
        $this->registry = $registry;
        $this->_db = $registry->db;
    }
    
    public function get_cuti(Penerima $pb=null){
        $sql = "SELECT a.KD_CUTI as KD_CUTI,a.KD_PB as KD_PB,";
        if(!is_null($pb)){
            $sql .= " b.NM_PB as KD_PB,";
        }else{
            $sql .= "a.KD_PB as KD_PB,";
        }
        
        $sql .= "
            c.NM_JNS_SRT_CUTI as KD_JNS_SRT_CUTI,
            a.NO_CUTI as NO_CUTI,
            a.TGL_CUTI as TGL_CUTI,
            a.PRD_MUL_CUTI as PRD_MUL_CUTI,
            a.PRD_SEL_CUTI as PRD_SEL_CUTI,
            a.PERK_STOP as PERK_STOP,
            a.PERK_GO as PERK_GO
            FROM ".$this->t_cuti." a ";
        
        if(!is_null($pb)){
            $sql .= " LEFT JOIN d_pb b ON a.KD_PB=b.KD_PB";
        }    
                
            $sql .= " LEFT JOIN r_jsc c ON a.KD_JNS_SRT_CUTI=c.KD_JNS_SRT_CUTI";
        if(!is_null($pb)){
            $sql .= " WHERE a.KD_PB=".$pb->get_kd_pb();
        }
        $result = $this->_db->select($sql);
        $data = array();
        foreach ($result as $v){
            $cuti = new $this($this->registry);
            $cuti->set_kode_cuti($v['KD_CUTI']);
            $cuti->set_jenis_cuti($v['KD_JNS_SRT_CUTI']);
            $cuti->set_pb($v['KD_PB']);
            $cuti->set_no_surat_cuti($v['NO_CUTI']);
            $cuti->set_tgl_surat_cuti($v['TGL_CUTI']);
            $cuti->set_prd_mulai($v['PRD_MUL_CUTI']);
            $cuti->set_prd_selesai($v['PRD_SEL_CUTI']);
            $cuti->set_perk_stop($v['PERK_STOP']);
            $cuti->set_perk_go($v['PERK_GO']);
            $data[] = $cuti;
        }
        return $data;
    }
    
    public function get_cuti_by_id(Penerima $pb){
        
    }


    /*
     * setter
     */
    public function set_kode_cuti($kd_cuti){
        $this->_kd_cuti = $kd_cuti;
    }
    public function set_jenis_cuti($jns_cuti){
        $this->_jsc = $jns_cuti;
    }
    public function set_pb($pb){
        $this->_pb = $pb;
    }
    public function set_no_surat_cuti($no_sc){
        $this->_no_sc = $no_sc;
    }
    public function set_tgl_surat_cuti($tgl_sc){
        $this->_tgl_sc = $tgl_sc;
    }
    public function set_prd_mulai($prd_mul){
        $this->_periode_mul = $prd_mul;
    }
    public function set_prd_selesai($prd_sel){
        $this->_periode_sel = $prd_sel;
    }
    public function set_perk_stop($perk_stop){
        $this->_perk_stop = $perk_stop;
    }
    public function set_perk_go($perk_go){
        $this->_perk_go = $perk_go;
    }
    
    /*
     * getter
     */
    public function get_kode_cuti(){
        return $this->_kd_cuti;
    }
    public function get_jenis_cuti(){
        return $this->_jsc;
    }
    public function get_pb(){
        return $this->_pb;
    }
    public function get_no_surat_cuti(){
        return $this->_no_sc;
    }
    public function get_tgl_surat_cuti(){
        return $this->_tgl_sc;
    }
    public function get_prd_mulai(){
        return $this->_periode_mul;
    }
    public function get_prd_selesai(){
        return $this->_periode_sel;
    }
    public function get_perk_stop(){
        return $this->_perk_stop;
    }
    public function get_perk_go(){
        return $this->_perk_go;
    }
    
    public function __destruct() {
        ;
    }
}
?>
