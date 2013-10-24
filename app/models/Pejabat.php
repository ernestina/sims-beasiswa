<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Pejabat extends BaseModel {

    public $kd_pejabat;
    public $nip_pejabat;
    public $nama_pejabat;
    public $nama_jabatan;
    public $jenis_jabatan;

    /*
     * Konstruktor
     */

    public function __construct() {
        parent::__construct();
    }

    /*
     * mendapatkan data pejabat
     * mengubah data pejabat ke dalam objek pejabat
     * return array objek 
     */

    public function get_All() {
        $table = "r_pejabat";
        //$where = "KD_PEJABAT='" . $id . "'";
        $sql = "SELECT * FROM $table";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $pejabat = new $this();
            $pejabat->kd_pejabat = $val['KD_PEJABAT'];
            $pejabat->nip_pejabat = $val['NIP_PEJABAT'];
            $pejabat->nama_pejabat = $val['NAMA_PEJABAT'];
            $pejabat->nama_jabatan = $val['NAMA_JABATAN'];
            $pejabat->jenis_jabatan = $val['JENIS_JABATAN'];
            $data[] = $pejabat;
        }
        //var_dump($data);
        return $data;
    }

    /*
     * mendapatkan data pejabat
     * mengubah data pejabat ke dalam objek pejabat
     * return array objek 
     */

    public function get_by_id($id) {
        $table = "r_pejabat";
        $where = "KD_PEJABAT='" . $id . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        foreach ($result as $val) {
            $pejabat = new $this();
            $pejabat->kd_pejabat = $val['KD_PEJABAT'];
            $pejabat->nip_pejabat = $val['NIP_PEJABAT'];
            $pejabat->nama_pejabat = $val['NAMA_PEJABAT'];
            $pejabat->nama_jabatan = $val['NAMA_JABATAN'];
            $pejabat->jenis_jabatan = $val['JENIS_JABATAN'];
        }
        //var_dump($data);
        return $pejabat;
    }
    
    public function get_by_jabatan($id) {
        $table = "r_pejabat";
        $where = "JENIS_JABATAN='" . $id . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        foreach ($result as $val) {
            $pejabat = new $this();
            $pejabat->kd_pejabat = $val['KD_PEJABAT'];
            $pejabat->nip_pejabat = $val['NIP_PEJABAT'];
            $pejabat->nama_pejabat = $val['NAMA_PEJABAT'];
            $pejabat->nama_jabatan = $val['NAMA_JABATAN'];
            $pejabat->jenis_jabatan = $val['JENIS_JABATAN'];
        }
        //var_dump($data);
        return $pejabat;
    }

    /*
     * menambahkan data pejabat ke dalam database
     * param objek pejabat diubah ke bentuk array
     * return void 
     */

    public function add(Pejabat $pejabat) {
        $table = "r_pejabat";
        $data = array(
            'NIP_PEJABAT' => $pejabat->nip_pejabat,
            'NAMA_PEJABAT' => $pejabat->nama_pejabat,
            'NAMA_JABATAN' => $pejabat->nama_jabatan,
            'JENIS_JABATAN' => $pejabat->jenis_jabatan
        );
        //var_dump($data);
        $this->db->insert($table, $data);
    }

    /*
     * mengupdate data pejabat
     * param objek pejabat
     * return void 
     */

    public function update(Pejabat $pejabat) {
        $table = "r_pejabat";
        $data = array(
            'NIP_PEJABAT' => $pejabat->nip_pejabat,
            'NAMA_PEJABAT' => $pejabat->nama_pejabat,
            'NAMA_JABATAN' => $pejabat->nama_jabatan,
            'JENIS_JABATAN' => $pejabat->jenis_jabatan
        );
        $where = "KD_PEJABAT='" . $pejabat->kd_pejabat . "'";
        $this->db->update($table, $data, $where);
    }

    /*
     * mengecek apakah nilai objek terisi/tidak kosong
     * param objek pejabat
     * return boolean (trus jika pejabat kosong atau 
     */

    public function isEmpty(Pejabat $pejabat) {
        $cek = true;
        if ($pejabat->kd_pejabat !== "" &&
                $pejabat->nip_pejabat != "" &&
                $pejabat->nama_pejabat !== "" &&
                $pejabat->nama_jabatan != "" &&
                $pejabat->jenis_jabatan !== ""
        ) {
            $cek = false;
        }
        return $cek;
    }

    /*
     * menghapus data pejabat dari database
     * param id = kd_pejabat
     * return void 
     */

    public function delete($id) {
        $table = "r_pejabat";
        $where = 'KD_PEJABAT=' . $id;
        //echo $id;
        $this->db->delete($table, $where);
    }

    /*
     * mengecek apakah sudah ada pejabat dengan jenis jabatan yang sama
     * param jenis_jabatan
     * return boolean
     */

    public function cekJenisJabatan($id) {
        $cek = TRUE; //belum ada pejabat dengan jenis jabatan sama dengan $id
        $table = "r_pejabat";
        $where = "JENIS_JABATAN='" . $id . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        if (!empty($result)) {
            $cek = FALSE;   //jika ditemukan terdapat pejabat dengan jenis jabatan yang seperti $id
        }
        return $cek;
    }

}

?>
