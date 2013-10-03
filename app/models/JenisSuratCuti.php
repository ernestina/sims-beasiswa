<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class JenisSuratCuti {

    private $db;
    private $_kd;
    private $_nama;
    private $_keterangan;
    private $_error;
    private $_valid = TRUE;
    private $_table = 'r_jsc';
    public $registry;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = $registry->db;
        $this->registry = $registry;
    }

    /*
     * mendapatkan data dari tabel jenis surat tugas
     * @param limit batas default null
     * return array objek jenis surat tugas
     */

    public function get_jsc($limit = null, $batas = null) {
        $sql = "SELECT * FROM " . $this->_table . " ";
        if (!is_null($limit) AND !is_null($batas)) {
            $sql .= " LIMIT " . $limit . "," . $batas;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $jsc = new $this($this->registry);
            $jsc->set_kode($val['KD_JNS_SRT_CUTI']);
            $jsc->set_nama($val['NM_JNS_SRT_CUTI']);
            $jsc->set_keterangan($val['KET_JNS_SRT_CUTI']);
            $data[] = $jsc;
        }
        return $data;
    }

    /*
     * mendapatkan jenis surat tugas sesuai id
     * @param objek jenis surat tugas
     * return objek jenis surat tugas
     */

    public function get_jsc_by_id($jsc = JenisSuratTugas) {
        if (is_null($jsc->get_kode())) {
            return false;
        }
        $sql = "SELECT * FROM " . $jsc->_table . " WHERE KD_JNS_SRT_CUTI=" . $jsc->get_kode();
        $result = $this->db->select($sql);
        foreach ($result as $val) {
            $this->set_kode($val['KD_JNS_SRT_CUTI']);
            $this->set_nama($val['NM_JNS_SRT_CUTI']);
            $this->set_keterangan($val['KET_JNS_SRT_CUTI']);
        }
        return $this;
    }

    /*
     * tambah data jenis surat tugas
     * param array data array key=>value, nama kolom=>data
     */

    public function add_jsc() {
        $data = array(
            'NM_JNS_SRT_CUTI' => $this->get_nama(),
            'KET_JNS_SRT_CUTI' => $this->get_keterangan()
        );
        $this->validate();
        if (!$this->get_valid())
            return false;
        if (!is_array($data))
            return false;
        $this->db->insert($this->_table, $data);
    }

    /*
     * update jenis surat tugas, id harus di set terlebih dahulu
     * param data array
     */

    public function update_jsc() {
        $data = array(
            'NM_JNS_SRT_CUTI' => $this->get_nama(),
            'KET_JNS_SRT_CUTI' => $this->get_keterangan()
        );
        $this->validate();
        if (!$this->get_valid())
            return false;
        if (!is_array($data))
            return false;
        $where = ' KD_JNS_SRT_CUTI=' . $this->get_kode();
        $this->db->update($this->_table, $data, $where);
    }

    /*
     * hapus jenis surat tugas, id harus di set terlebih dahulu
     */

    public function delete_jsc() {
        $where = ' KD_JNS_SRT_CUTI=' . $this->get_kode();
        $this->db->delete($this->_table, $where);
    }

    /*
     * Validasi untuk inputan
     */

    public function validate() {
        if ($this->get_nama() == "") {
            $this->_error .= "Nama Jenis Surat Cuti belum diinput!</br>";
            $this->_valid = FALSE;
        }
    }

    /*
     * setter
     */

    public function set_kode($kode) {
        $this->_kd = $kode;
    }

    public function set_nama($nama) {
        $this->_nama = $nama;
    }

    public function set_keterangan($ket) {
        $this->_keterangan = $ket;
    }

    /*
     * getter
     */

    public function get_kode($where = null) {
        if (!is_null($where)) {
            $sql = "SELECT KD_JNS_SRT_CUTI '" . $this->_table . "' WHERE '" . $where . "'";
            $result = $this->db->select($sql);
            foreach ($result as $val) {
                $this->set_kode($val['KD_JNS_SRT_CUTI']);
            }
        }
        return $this->_kd;
    }

    public function get_nama() {
        return $this->_nama;
    }

    public function get_keterangan() {
        return $this->_keterangan;
    }

    public function get_error() {
        return $this->_error;
    }

    public function get_valid() {
        return $this->_valid;
    }

    public function __destruct() {
        ;
    }

}

?>
