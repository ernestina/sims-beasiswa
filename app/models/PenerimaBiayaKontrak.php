<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PenerimaBiayaKontrak extends BaseModel {

    public $kd_penerima_biaya;
    public $kd_biaya;
    public $kd_penerima_beasiswa;

    /*
     * Konstruktor
     */

    public function __construct() {
        parent::__construct();
    }

    /*
     * mendapatkan seluruh dpenerima biaya kontrak
     */

    public function get_All() {
        $table = "t_tagihan_kontrak";
        $sql = "SELECT * FROM $table";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
           $penerima_biaya_kontrak = new PenerimaBiayaKontrak();
            $penerima_biaya_kontrak->kd_penerima_biaya = $val["NO_T_TAGIHAN"];
            $penerima_biaya_kontrak->kd_biaya = $val["KD_TAGIHAN"];
            $penerima_biaya_kontrak->kd_penerima_beasiswa = $val["KD_PB"];
            $data[] = $penerima_biaya_kontrak;
        }
        //var_dump($data);
        return $data;
    }

    /*
     * mendapatkan seluruh data penrima biaya kontrak berdasarkan kd_penerima_biaya
     */

    public function get_by_id($id) {
        $table = "t_tagihan_kontrak";
        $where = "NO_T_TAGIHAN='" . $id . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        $penerima_biaya_kontrak = false;
        foreach ($result as $val) {
            $penerima_biaya_kontrak = new PenerimaBiayaKontrak();
            $penerima_biaya_kontrak->kd_penerima_biaya = $val["NO_T_TAGIHAN"];
            $penerima_biaya_kontrak->kd_biaya = $val["KD_TAGIHAN"];
            $penerima_biaya_kontrak->kd_penerima_beasiswa = $val["KD_PB"];
        }
        //var_dump($data);
        return $penerima_biaya_kontrak;
    }
    
     /*
     * mendapatkan seluruh data penrima biaya kontrak berdasarkan kd_biaya dan kd_pb
     */

    public function get_by_biaya_pb($kd_biaya, $kd_pb) {
        $table = "t_tagihan_kontrak";
        $where = "KD_TAGIHAN='" . $kd_biaya . "' AND KD_PB='" . $kd_pb . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        $penerima_biaya_kontrak = false;
        foreach ($result as $val) {
            $penerima_biaya_kontrak = new PenerimaBiayaKontrak();
            $penerima_biaya_kontrak->kd_penerima_biaya = $val["NO_T_TAGIHAN"];
            $penerima_biaya_kontrak->kd_biaya = $val["KD_TAGIHAN"];
            $penerima_biaya_kontrak->kd_penerima_beasiswa = $val["KD_PB"];
        }
        //var_dump($data);
        return $penerima_biaya_kontrak;
    }
    
     /*
     * mendapatkan seluruh data penrima biaya kontrak berdasarkan kd_penerima_biaya
     */

    public function get_by_biaya($kd_biaya) {
        $table = "t_tagihan_kontrak";
        $where = "KD_TAGIHAN='" . $kd_biaya . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $penerima_biaya_kontrak = new PenerimaBiayaKontrak();
            $penerima_biaya_kontrak->kd_penerima_biaya = $val["NO_T_TAGIHAN"];
            $penerima_biaya_kontrak->kd_biaya = $val["KD_TAGIHAN"];
            $penerima_biaya_kontrak->kd_penerima_beasiswa = $val["KD_PB"];
            $data[] = $penerima_biaya_kontrak;
        }
        //var_dump($data);
        return $data;
    }

    /*
     * menambahkan data penerima biaya kontrak
     */

    public function add(PenerimaBiayaKontrak $penerima) {
        $table = "t_tagihan_kontrak";
        $data = array(
            'KD_TAGIHAN' => $penerima->kd_biaya,
            'KD_PB' => $penerima->kd_penerima_beasiswa
        );
        //var_dump($data);
        $this->db->insert($table, $data);
    }

    /*
     * menghapus data penerima biaya kontrak 
     */

    public function delete($id) {
        $table = "t_tagihan_kontrak";
        $where = 'NO_T_TAGIHAN=' . $id;
        //echo $id;
        $this->db->delete($table, $where);
    }
	
	public function deleteByBiaya($kd_biaya) {
        $table = "t_tagihan_kontrak";
        $where = 'KD_TAGIHAN=' . $kd_biaya;
        //echo $id;
        $this->db->delete($table, $where);
    }

}

?>
