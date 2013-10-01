<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class MasalahPenerima{
    
    public $registry;
    private $_pb;
    private $_kode_mas;
    private $_uraian;
    private $_sumber_mas;
    private $_t_mas = 'd_mas_tb';
    
    public function __construct($registry) {
        $this->registry = $registry;
    }
    
    public function get_masalah(Penerima $pb = null){
        $sql = "SELECT * FROM ".$this->_t_mas;
        if(!is_null($pb)){
            $sql .= " WHERE KD_PB=".$pb->get_kd_pb();
        }
        $result = $this->registry->db->select($sql);
        $data = array();
        foreach($result as $v){
            $d = new $this($this->registry);
            $d->set_kode($v['KD_MAS_TB']);
            $d->set_kode_pb($v['KD_PB']);
            $d->set_uraian($v['URA_MAS_TB']);
            $d->set_sumber_masalah($v['SMBR_MAS_TB']);
            $data[] = $d;
                    
        }
        return $data;
    }
    
    public function add_masalah(){
        $data = array(
            'KD_PB' => $this->get_kode_pb(),
            'URA_MAS_TB'=>$this->get_uraian(),
            'SMBR_MAS_TB'=>$this->get_sumber_masalah()
        );
        
        $this->registry->db->insert($this->_t_mas,$data);
    }


    /*
     * setter
     */
    public function set_kode($kode_mas){
        $this->_kode_mas = $kode_mas;
    }
    public function set_kode_pb($kd_pb){
        $this->_pb = $kd_pb;
    }
    public function set_uraian($uraian){
        $this->_uraian = $uraian;
    }
    public function set_sumber_masalah($sumber_masalah){
        $this->_sumber_mas = $sumber_masalah;
    }
    /*
     * getter
     */
    public function get_kode(){
        return $this->_kode_mas;
    }
    public function get_kode_pb(){
        return $this->_pb;
    }
    public function get_uraian(){
        return $this->_uraian;
    }
    public function get_sumber_masalah(){
        return $this->_sumber_mas;
    }
    public function __destruct(){
        
    }
}
?>
