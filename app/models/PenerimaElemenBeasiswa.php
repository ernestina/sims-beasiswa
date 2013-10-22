<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PenerimaElemenBeasiswa extends BaseModel {

    public $kd_penerima_elemen_beasiswa;
    public $kd_elemen_beasiswa;
    public $kd_pb;
    public $pajak;
    public $kehadiran;

    public function __construct() {
        parent::__construct();
    }

    public function add(PenerimaElemenBeasiswa $peb) {
        $table = "t_elem_beasiswa";
        //var_dump($biaya);
        $data = array(
//            'KD_T_ELEM_BEASISWA' => $peb->kd_penerima_elemen_beasiswa,
            'KD_D_ELEM_BEASISWA' => $peb->kd_elemen_beasiswa,
            'KD_PB' => $peb->kd_pb,
            'PAJAK_T_ELEM_BEASISWA' => $peb->pajak,
            'HADIR_T_ELEM_BEASISWA' => $peb->kehadiran
        );
        //var_dump($data);
        $this->db->insert($table, $data);
    }
    
    public function update(PenerimaElemenBeasiswa $peb) {
        $table = "t_elem_beasiswa";
        //var_dump($biaya);
        $data = array(
//            'KD_T_ELEM_BEASISWA' => $peb->kd_penerima_elemen_beasiswa,
            'KD_D_ELEM_BEASISWA' => $peb->kd_elemen_beasiswa,
            'KD_PB' => $peb->kd_pb,
            'PAJAK_T_ELEM_BEASISWA' => $peb->pajak,
            'HADIR_T_ELEM_BEASISWA' => $peb->kehadiran
        );
        $where = "KD_T_ELEM_BEASISWA='" . $peb->kd_penerima_elemen_beasiswa . "'";
        $this->db->update($table, $data, $where);
    }

    //menghapus penerima elemen beasiswa berdasarkan KD_D_ELEM_BEASISWA
    public function delete($id) {
        $table = 't_elem_beasiswa';
        $where = 'KD_D_ELEM_BEASISWA=' . $id;
        $this->db->delete($table, $where);
    }
    
    //menghapus penerima elemen beasiswa berdasarkan KD_D_ELEM_BEASISWA
    public function delete2($kd_el,$kd_pb) {
        $table = "t_elem_beasiswa";
        $where = "KD_D_ELEM_BEASISWA='".$kd_el."' AND KD_PB='".$kd_pb."'";
        $this->db->delete($table, $where);
    }

    public function get_by_elemen($id) {
        $table = "t_elem_beasiswa";
        $where = "KD_D_ELEM_BEASISWA='" . $id."'";
        $sql = "select * from $table where $where";
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $penerima_elemen = new PenerimaElemenBeasiswa();
            $penerima_elemen->kd_elemen_beasiswa = $val['KD_D_ELEM_BEASISWA'];
            $penerima_elemen->kd_pb = $val['KD_PB'];
            $penerima_elemen->kd_penerima_elemen_beasiswa = $val['KD_T_ELEM_BEASISWA'];
            $penerima_elemen->kehadiran = $val['HADIR_T_ELEM_BEASISWA'];
            $penerima_elemen->pajak = $val['PAJAK_T_ELEM_BEASISWA'];
            $data[] = $penerima_elemen;
        }
        //var_dump($data);
        return $data;
    }
    
    public function get_by_elemen_pb($id, $pb) {
               
        $cek = FALSE; //belum ada pb dalam tabel penerima elemen beasiswa berdasarkan kd_elemen_pb dan
        $table = "t_elem_beasiswa";
        $where = "KD_D_ELEM_BEASISWA='" . $id."' AND KD_PB='".$pb."'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        if (!empty($result)) {
            $cek = TRUE;   //jika ditemukan pb dalam tabel penerima pb berdasarkan kd_elemen_pb
        }
        return $cek;
    }
    
    
    
    public function get_elemen_dibayar($r, $jur,$thn_masuk) {
               
        $cek = FALSE; //belum ada pb dalam tabel penerima elemen beasiswa
        $table = "t_elem_beasiswa a, d_elemen_beasiswa b";
        $where = "a.KD_D_ELEM_BEASISWA = b.KD_D_ELEM_BEASISWA AND b.KD_R_ELEM_BEASISWA='" . $r."' AND b.KD_JUR='".$jur."' AND b.TAHUN_MASUK='".$thn_masuk."' AND b.NO_SP2D_D_ELEM_BEASISWA >''";
        $sql = "SELECT count(*) as JML FROM $table where $where";
        $result = $this->db->select($sql);
        $data=0;
        foreach ($result as $val){
            $data=$val['JML'];
        }
        return $data;
    }
    
    public function get_elemen_proses_dibayar($r,$jur,$thn_masuk) {
               
        $cek = FALSE; //belum ada pb dalam tabel penerima elemen beasiswa
        $table = "t_elem_beasiswa a, d_elemen_beasiswa b";
        $where = "a.KD_D_ELEM_BEASISWA = b.KD_D_ELEM_BEASISWA AND b.KD_R_ELEM_BEASISWA='" .$r."' AND b.KD_JUR='".$jur."' AND b.TAHUN_MASUK='".$thn_masuk."' AND (b.NO_SP2D_D_ELEM_BEASISWA ='' OR b.NO_SP2D_D_ELEM_BEASISWA IS NULL)";
        $sql = "SELECT count(*) as JML FROM $table where $where";
        $result = $this->db->select($sql);
        $data=0;
        foreach ($result as $val){
            $data=$val['JML'];
        }
        return $data;
    }
    
    public function cek_buku_by_pb($pb, $sem, $thn) {
               
        $cek = FALSE; //belum ada pb dalam tabel penerima elemen beasiswa
        $table = "t_elem_beasiswa a, d_elemen_beasiswa b";
        $where = "
            a.KD_PB='".$pb."' AND a.KD_D_ELEM_BEASISWA=b.KD_D_ELEM_BEASISWA AND b.KD_R_ELEM_BEASISWA='2' 
                AND b.BLN_D_ELEM_BEASISWA='".$sem."' AND b.THN_D_ELEM_BEASISWA='".$thn."'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        if (!empty($result)) {
            $cek = TRUE;   //jika ditemukan pb dalam tabel penerima pb 
        }
        return $cek;
    }
    
    public function cek_skripsi_by_pb($pb) {
               
        $cek = FALSE; //belum ada pb dalam tabel penerima elemen beasiswa
        $table = "t_elem_beasiswa a, d_elemen_beasiswa b";
        $where = "a.KD_PB='".$pb."' AND a.KD_D_ELEM_BEASISWA=B.KD_D_ELEM_BEASISWA AND b.KD_R_ELEM_BEASISWA='3'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        if (!empty($result)) {
            $cek = TRUE;   //jika ditemukan pb dalam tabel penerima pb 
        }
        return $cek;
    }
    
    public function cek_skripsi_dibayar_by_pb($pb) {
               
        $cek = FALSE; 
        $table = "t_elem_beasiswa a, d_elemen_beasiswa b";
        $where = "a.KD_PB='".$pb."' AND a.KD_D_ELEM_BEASISWA=B.KD_D_ELEM_BEASISWA AND b.KD_R_ELEM_BEASISWA='3' AND b.NO_SP2D_D_ELEM_BEASISWA >''";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        if (!empty($result)) {
            $cek = TRUE;    
        }
        return $cek;
    }
    

}

?>
