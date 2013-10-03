<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PemberiBeasiswa extends BaseModel {

    public $kd_pemberi;
    public $nama_pemberi;
    public $alamat_pemberi;
    public $telp_pemberi;
    public $pic_pemberi;
    public $telp_pic_pemberi;

    /*
     * Kostruktor
     */

    public function __construct() {
        parent::__construct();
    }

    /*
     * mendapatkan seluruh data strata dari database dalam bentuk array
     * mengubah masing-masing array ke dalam objek stata
     * return array objek 
     */

    public function get_All() {
        $table = "d_pemb";
        $sql = "SELECT * FROM $table";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $pemberi = new $this();
            $pemberi->kd_pemberi = $val['KD_PEMB'];
            $pemberi->nama_pemberi = $val['NM_PEMB'];
            $pemberi->alamat_pemberi = $val['ALMT_PEMB'];
            $pemberi->telp_pemberi = $val['TELP_PEMB'];
            $pemberi->pic_pemberi = $val['PIC_PEMB'];
            $pemberi->telp_pic_pemberi = $val['TELP_PIC_PEMB'];
            $data[] = $pemberi;
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
        $table = "d_pemb";
        $where = "KD_PEMB='" . $id . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        $pemberi = false;
        foreach ($result as $val) {
            $pemberi = new $this();
            $pemberi->kd_pemberi = $val['KD_PEMB'];
            $pemberi->nama_pemberi = $val['NM_PEMB'];
            $pemberi->alamat_pemberi = $val['ALMT_PEMB'];
            $pemberi->telp_pemberi = $val['TELP_PEMB'];
            $pemberi->pic_pemberi = $val['PIC_PEMB'];
            $pemberi->telp_pic_pemberi = $val['TELP_PIC_PEMB'];
        }
        //var_dump($data);
        return $pemberi;
    }

    /*
     * menambahkan data strata ke dalam database
     * param objek strata diubah ke bentuk array
     * return void 
     */

    public function add(PemberiBeasiswa $pemberi) {
        $table = "d_pemb";
        $data = array(
            'NM_PEMB' => $pemberi->nama_pemberi,
            'ALMT_PEMB' => $pemberi->alamat_pemberi,
            'TELP_PEMB' => $pemberi->telp_pemberi,
            'PIC_PEMB' => $pemberi->pic_pemberi,
            'TELP_PIC_PEMB' => $pemberi->telp_pic_pemberi
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
        $table = "d_PEMB";
        $where = 'KD_PEMB=' . $id;
        $this->db->delete($table, $where);
    }

    public function update(PemberiBeasiswa $pemberi) {
        $table = "d_pemb";
        $data = array(
            'NM_PEMB' => $pemberi->nama_pemberi,
            'ALMT_PEMB' => $pemberi->alamat_pemberi,
            'TELP_PEMB' => $pemberi->telp_pemberi,
            'PIC_PEMB' => $pemberi->pic_pemberi,
            'TELP_PIC_PEMB' => $pemberi->telp_pic_pemberi
        );
        $where = "KD_PEMB='" . $pemberi->kd_pemberi . "'";
        $this->db->update($table, $data, $where);
    }

    /*
     * mengecek apakah nilai objek terisi/tidak kosong
     * param objek pemberi
     * return boolean
     */

    public function isEmpty(PemberiBeasiswa $pemberi) {
        $cek = true;
        if ($pemberi->nama_pemberi != "" && $pemberi->telp_pemberi != "" && $pemberi->alamat_pemberi != ""
                && $pemberi->pic_pemberi != "" && $pemberi->telp_pic_pemberi != "") {
            $cek = false;
        }
        return $cek;
    }

}

?>