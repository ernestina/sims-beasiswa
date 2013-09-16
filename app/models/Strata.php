<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Strata extends BaseModel {

    var $kd_strata;
    var $kode_strata;
    var $nama_strata;

    public function __construct() {
        parent::__construct();
    }

    /*
     * mendapatkan seluruh data strata dari database dalam bentuk array
     * mengubah masing-masing array ke dalam objek stata
     * return array objek 
     */

    public function get_All() {
        $table = "r_strata";
        $sql = "SELECT * FROM $table";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $strata = new $this();
            $strata->kd_strata= $val["KD_STRATA"];
            $strata->kode_strata = $val["KODE_STRATA"];
            $strata->nama_strata = $val["NAMA_STRATA"];
            $data[] = $strata;
        }
        //var_dump($data);
        return $data;
    }

    /*
     * mendapatkan seluruh data strata dari database dalam bentuk array
     * mengubah masing-masing array ke dalam objek stata
     * return array objek 
     */

    public function get_by_id($id) {
        $table = "r_strata";
        $where = "KD_STRATA='" . $id . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);

        foreach ($result as $val) {
            $strata = new $this();
            $strata->kd_strata = $val["KD_STRATA"];
            $strata->kode_strata = $val["KODE_STRATA"];
            $strata->nama_strata = $val["NAMA_STRATA"];
        }
        //var_dump($data);
        return $strata;
    }

    /*
     * menambahkan data strata ke dalam database
     * param objek strata diubah ke bentuk array
     * return void 
     */

    public function add(Strata $strata) {
        $table = "r_strata";
        $data = array(
            'KODE_STRATA' => $strata->kode_strata,
            'NAMA_STRATA' => $strata->nama_strata
        );
        //var_dump($data);
        $this->db->insert($table, $data);
    }

    /*
     * menghapus data strata dari database
     * param id = kd_strata
     * return void 
     */

    public function delete($id = null) {
        $table = "r_strata";
        $where = 'KD_STRATA=' . $id;
        //echo $id;
        $this->db->delete($table, $where);
    }

    public function update(Strata $strata) {
        $table = "r_strata";
        $data = array(
            'KODE_STRATA' => $strata->kode_strata,
            'NAMA_STRATA' => $strata->nama_strata
        );
        $where = "KD_STRATA='" . $strata->kd_strata. "'";
        $this->db->update($table, $data, $where);
    }

}

?>
