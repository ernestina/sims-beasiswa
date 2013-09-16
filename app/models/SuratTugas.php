<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class SuratTugas {

    public $registry;
    public $db;
    private $_kd_st;
    private $_jur;
    private $_jenis_st;
    private $_st_lama;
    private $_nomor;
    private $_tgl_st;
    private $_tgl_mulai;
    private $_tgl_selesai;
    private $_th_masuk;
    private $_file;
    private $_tb_st = 'surat_tugas';

    public function __construct($registry) {
        $this->registry = $registry;
        $this->db = $registry->db;
    }

    public function get_surat_tugas($id = null) {
        $sql = "SELECT * FROM " . $this->_tb_st;
        if (!is_null($id)) {
            $sql .= ' WHERE KD_ST<>' . $id;
        }

        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $st = new $this($this->registry);
            $st->set_kd_st($val['KD_ST']);
            $st->set_jur($val['KD_JUR']);
            $st->set_nomor($val['NOMOR_ST']);
            $st->set_st_lama($val['KD_ST_LAMA']);
            $st->set_jenis_st($val['KD_JENIS_ST']);
            $st->set_tgl_st($val['TANGGAL_ST']);
            $st->set_tgl_mulai($val['TANGGAL_MULAI_ST']);
            $st->set_tgl_selesai($val['TANGGAL_SELESAI_ST']);
            $st->set_th_masuk($val['TAHUN_MASUK']);
            $st->set_file($val['FILE_ST']);
            $data[] = $st;
        }

        return $data;
    }

    public function get_surat_tugas_by_id($st = SuratTugas) {
        $sql = "SELECT * FROM " . $this->_tb_st . " WHERE KD_ST=" . $st->get_kd_st();
        $result = $this->db->select($sql);
        foreach ($result as $val) {
            $this->set_kd_st($val['KD_ST']);
            $this->set_jur($val['KD_JUR']);
            $this->set_nomor($val['NOMOR_ST']);
            $this->set_st_lama($val['KD_ST_LAMA']);
            $this->set_jenis_st($val['KD_JENIS_ST']);
            $this->set_tgl_st($val['TANGGAL_ST']);
            $this->set_tgl_mulai($val['TANGGAL_MULAI_ST']);
            $this->set_tgl_selesai($val['TANGGAL_SELESAI_ST']);
            $this->set_th_masuk($val['TAHUN_MASUK']);
            $this->set_file($val['FILE_ST']);
        }

        return $this;
    }

    /*
     * rekam surat tugas
     * param data array
     */

    public function add_st($data = array()) {
        if (!is_array($data))
            return false;
        $this->db->insert($this->_tb_st, $data);
    }

    /*
     * hapus surat tugas, kd st harus diset terlebih dahulu
     */

    public function del_st() {
        $where = " KD_ST=" . $this->get_kd_st();
        $this->db->delete($this->_tb_st, $where);
    }

    /*
     * ubah surat tugas, kode harus di set dahulu
     * param array data
     */

    public function update_st($data = array()) {
        if (!is_array($data))
            return false;
        $where = " KD_ST=" . $this->get_kd_st();
        $this->db->update($this->_tb_st, $data, $where);
    }

    public function get_list_th_masuk() {
        $this_year = (int) date('Y');
        $begin_list = $this_year - 6;
        $data = array();
        for ($begin_list; $begin_list <= $this_year; $begin_list++) {
            $data[$begin_list] = $begin_list;
        }

        return $data;
    }

    public function get_st_class() {
        $sql = "SELECT * FROM r_jst";
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $jst = new JenisSuratTugas();
            $jst->set_kode($val['KD_JENIS_ST']);
            $jst->set_nama($val['NAMA_JENIS_ST']);
            $jst->set_keterangan($val['KETERANGAN_JENIS_ST']);
            $data[] = $jst;
        }

        return $data;
    }

    /*
     * setter
     */

    public function set_table($table) {
        $this->_tb_st = $table;
    }

    public function set_kd_st($kd) {
        $this->_kd_st = $kd;
    }

    public function set_jur($jur) {
        $this->_jur = $jur;
    }

    public function set_jenis_st($jns) {
        $this->_jenis_st = $jns;
    }

    public function set_st_lama($st_lama) {
        $this->_st_lama = $st_lama;
    }

    public function set_nomor($nomor) {
        $this->_nomor = $nomor;
    }

    public function set_tgl_st($tgl) {
        $this->_tgl_st = $tgl;
    }

    public function set_tgl_mulai($tgl) {
        $this->_tgl_mulai = $tgl;
    }

    public function set_tgl_selesai($tgl) {
        $this->_tgl_selesai = $tgl;
    }

    public function set_th_masuk($thn) {
        $this->_th_masuk = $thn;
    }

    public function set_file($file) {
        $this->_file = $file;
    }

    /*
     * getter
     */

    public function get_kd_st() {
        return $this->_kd_st;
    }

    public function get_jur() {
        return $this->_jur;
    }

    public function get_jenis_st() {
        return $this->_jenis_st;
    }

    public function get_st_lama() {
        return $this->_st_lama;
    }

    public function get_nomor() {
        return $this->_nomor;
    }

    public function get_tgl_st() {
        return $this->_tgl_st;
    }

    public function get_tgl_mulai() {
        return $this->_tgl_mulai;
    }

    public function get_tgl_selesai() {
        return $this->_tgl_selesai;
    }

    public function get_th_masuk() {
        return $this->_th_masuk;
    }

    public function get_file() {
        return $this->_file;
    }

}

?>
