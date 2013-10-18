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

}

?>
