<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Strata extends BaseModel{
    
    private $kd_strata;
    private $kode_strata;
    private $nama_strata;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function set_kd_strata($kd_strata){
        $this->kd_strata = $kd_strata;
    }
    
    public function get_kode_univ(){
        return $this->_kd_univ;
    }
    
    /*
     * mendapatkan data strata dari database dalam bentuk array
     * param posisi, batas default null
     * mengubah masing-masing array ke dalam objek stata
     * return array objek 
     */
    public function get_strata($limit=null, $batas=null){
        $sql = "SELECT * FROM '".$this->_table."' ";
        if(!is_null($limit) AND !is_null($batas)) {
            $sql .= " LIMIT ".$limit.",".$batas;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach($result as $val){
            $fakul = new $this($this->registry);
            $fakul->set_kode_fakul($val['kd_fakul']);
            $fakul->set_kode_univ($val['kd_univ']);
            $fakul->set_nama($val['nama_fakul']);
            $fakul->set_alamat($val['alamat_fakul']);
            $fakul->set_telepon($val['telp_fakul']);
            $data[] = $fakul;
        }
        return $data;
    }
    
    
    /*
    * mencari seluruh data strata
    * 
    */
    public function get(){
        $sql = "SELECT * FROM r_strata";
        $data = $this->select($sql);
        //var_dump($data);
        $list_strata = array();
        foreach($data as $key => $value){
            $strata = new Strata();
            $strata->kd_strata = $value["KD_STRATA"];
            $strata->kode_strata = $value["KODE_STRATA"];
            $strata->nama_strata = $value["NAMA_STRATA"];
            $list_strata[] = $strata;
        }
        var_dump($list_strata);
        return $list_strata;
    }
    
    public function remove($id=null){
        $where = 'id = '.$id;
        $this->delete($table, $where);
    }
    
    public function ubah($data){
        
    }
}
?>
