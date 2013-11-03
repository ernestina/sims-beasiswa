<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Strata extends BaseModel {

    public $no;
    public $kd_strata;
    public $kode_strata;
    public $nama_strata;

    /*
     * Konstruktor
     */

    public function __construct() {
        parent::__construct();
    }

    /*
     * mendapatkan seluruh data strata dari database dalam bentuk array
     * mengubah masing-masing array ke dalam objek stata
     * return array objek 
     */

    public function get_All($posisi = null, $batas = null) {
        $table = "r_strata";
        $sql = "SELECT * FROM $table";
        $urut=$posisi+1;
        if (!is_null($posisi) AND !is_null($batas)) $sql .= " limit " . $posisi . ", " . $batas;
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $strata = new $this();
            $strata->no = $urut++;
            $strata->kd_strata = $val["KD_STRATA"];
            $strata->kode_strata = $val["STRATA"];
            $strata->nama_strata = $val["NM_STRATA"];
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
        $strata = false;
        foreach ($result as $val) {
            $strata = new $this();
            $strata->kd_strata = $val["KD_STRATA"];
            $strata->kode_strata = $val["STRATA"];
            $strata->nama_strata = $val["NM_STRATA"];
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
            'STRATA' => $strata->kode_strata,
            'NM_STRATA' => $strata->nama_strata
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

    /*
     * mengupdate data strata
     * param objek strata
     * return void 
     */

    public function update(Strata $strata) {
        $table = "r_strata";
        $data = array(
            'STRATA' => $strata->kode_strata,
            'NM_STRATA' => $strata->nama_strata
        );
        $where = "KD_STRATA='" . $strata->kd_strata . "'";
        $this->db->update($table, $data, $where);
    }

    /*
     * mengecek apakah nilai objek terisi/tidak kosong
     * param objek strata
     * return boolean
     */

    public function isEmpty(Strata $strata) {
        $cek = true;
        if ($strata->kode_strata != "" && $strata->nama_strata != "") {
            $cek = false;
        }
        return $cek;
    }

}

?>
