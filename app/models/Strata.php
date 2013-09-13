<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Strata {

    private $kd_strata;
    private $kode_strata;
    private $nama_strata;

    public function __construct() {
        
    }

    public function set_kd_strata($kd_strata) {
        $this->kd_strata = $kd_strata;
    }

    public function set_kode_strata($kode_strata) {
        $this->kode_strata = $kode_strata;
    }

    public function set_nama_strata($nama_strata) {
        $this->nama_strata = $nama_strata;
    }

    public function get_kd_strata() {
        return $this->kd_strata;
    }

    public function get_kode_strata() {
        return $this->kode_strata;
    }

    public function get_nama_strata() {
        return $this->nama_strata;
    }

}

class StrataModel extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    /*
     * mendapatkan seluruh data strata dari database dalam bentuk array
     * mengubah masing-masing array ke dalam objek stata
     * return array objek 
     */

    public function get_strata() {
        $table = "r_strata";
        $sql = "SELECT * FROM $table";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $strata = new Strata();
            $strata->set_kd_strata($val["KD_STRATA"]);
            $strata->set_kode_strata($val["KODE_STRATA"]);
            $strata->set_nama_strata($val["NAMA_STRATA"]);
            $data[] = $strata;
        }
        //var_dump($data);
        return $data;
    }

    /*
     * menambahkan data strata ke dalam database
     * param objek strata diubah ke bentuk array
     * return void 
     */

    public function add_strata(Strata $strata) {
        $table = "r_strata";
        $data = array(
                'KODE_STRATA'=>$strata->get_kode_strata(),
                'NAMA_STRATA'=>$strata->get_nama_strata()
            );
        //var_dump($data);
        $this->db->insert($table, $data);
    }

    public function delete($id = null) {
        $table = "r_strata";
        $where = ' KD_STRATA='.$id;
        echo $id;
        $this->db->delete($table,$where);
    }

    public function ubah($data) {
        
    }

}

?>
