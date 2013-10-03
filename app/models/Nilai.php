<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Nilai{
    public $registry;
    private $_db;
    private $_kd_nil;
    private $_kd_pb;
    private $_ips;
    private $_ipk;
    private $_sem;
    private $_file;
    private $_tb_nilai = 'd_nil_pb';
    
    public function __construct($registry) {
        $this->registry = $registry;
        $this->_db = $registry->db;
    }
    
    public function get_nilai($pb = Penerima){
        $sql = "SELECT * FROM ".$this->_tb_nilai." WHERE KD_PB=".$pb->get_kd_pb();
        $result = $this->_db->select($sql);
        $data = array();
        foreach ($result as $v){
            $nilai = new $this($this->registry);
            $nilai->set_kode($v['KD_NIL_PB']);
            $nilai->set_pb($v['KD_PB']);
            $nilai->set_ips($v['IPS_NIL_PB']);
            $nilai->set_ipk($v['IPK_NIL_PB']);
            $nilai->set_semester($v['SEM_NIL_PB']);
            $nilai->set_file($v['FILE_NIL_PB']);
            $data[] = $nilai;
        }
        return $data;
    }
    
    public function get_current_ipk($pb){
        $sql = "SELECT MAX(SEM_NIL_PB) as SEM_NIL_PB, IPK_NIL_PB as IPK_NIL_PB FROM ".$this->_tb_nilai." WHERE KD_PB=".$pb->get_kd_pb();
        $result = $this->_db->select($sql);
        foreach ($result as $v){
            $this->set_kode($v['KD_NIL_PB']);
            $this->set_pb($v['KD_PB']);
            $this->set_ips($v['IPS_NIL_PB']);
            $this->set_ipk($v['IPK_NIL_PB']);
            $this->set_semester($v['SEM_NIL_PB']);
        }
        return $this;
    }
    
    public function add_nilai(){
        $data = array(
            'KD_PB'=>$this->get_pb(),
            'IPS_NIL_PB'=>$this->get_ips(),
            'IPK_NIL_PB'=>$this->get_ipk(),
            'SEM_NIL_PB'=>$this->get_semester(),
            'FILE_NIL_PB'=>$this->get_file()
        );
        
        return $this->registry->db->insert($this->_tb_nilai,$data);
    }


    /*
     * setter
     */
    
    public function set_kode($kd_nilai){
        $this->_kd_nil = $kd_nilai;
    }
    public function set_pb($pb){
        $this->_kd_pb = $pb;
    }
    public function set_ips($ips){
        $this->_ips = $ips;
    }
    public function set_ipk($ipk){
        $this->_ipk = $ipk;
    }
    public function set_semester($semester){
        $this->_sem = $semester;
    }
    public function set_file($file){
        $this->_file = $file;
    }
    /*
     * getter
     */
    public function get_kode(){
        return $this->_kd_nil;
    }
    public function get_pb(){
        return $this->_kd_pb;
    }
    public function get_ips(){
        return $this->_ips;
    }
    public function get_ipk(){
        return $this->_ipk;
    }
    public function get_semester(){
        return $this->_sem;
    }
    public function get_file(){
        return $this->_file;
    }
    
    public function __destruct() {
        ;
    }
}
?>
