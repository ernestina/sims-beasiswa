<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ElemenBeasiswa {

    private $db;
    private $_kd_d;
    private $_kd_r;
    private $_kd_jur;
    private $_thn_masuk;
    private $_jml_peg;
    private $_biaya_per_peg;
    private $_bln;
    private $_thn;
    private $_total_bayar;
    private $_no_sp2d;
    private $_tgl_sp2d;
    private $_file_sp2d;
    private $_table = 'd_elemen_beasiswa';
    private $_table_univ = 'r_univ';
    private $_table_fakul = 'r_fakul';
    private $_table_jur = 'r_jur';
    private $_table_gol = 'r_gol';
    public $registry;

    /**
     *  attribut tambahan 
     */
    private $_univ;
    private $_jadup = 1;
    private $_buku = 2;
    private $_skripsi = 3;

    /*
     * konstruktor
     */

    public function __construct($registry = Registry) {
        $this->db = new Database();
        $this->registry = $registry;
    }

    /*
     * mendapatkan data dari tabel universitas
     * @param limit batas default null
     * return array objek universitas
     */

    public function get_elem($r_elem = null, $limit = null, $batas = null) {
        $sql = "SELECT * FROM " . $this->_table;
        if (!is_null($r_elem)) {
            $sql .= " WHERE KD_R_ELEM_BEASISWA =" . $r_elem . " order by KD_D_ELEM_BEASISWA desc";
        }
        if (!is_null($limit) AND !is_null($batas)) {
            $sql .= " order by KD_D_ELEM_BEASISWA desc LIMIT " . $limit . "," . $batas;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $elem = new $this($this->registry);
            $elem->set_kd_d($val['KD_D_ELEM_BEASISWA']);
            $elem->set_kd_r($val['KD_R_ELEM_BEASISWA']);
            $elem->set_kd_jur($val['KD_JUR']);
            $elem->set_thn_masuk($val['TAHUN_MASUK']);
            $elem->set_jml_peg($val['JML_PEG_D_ELEM_BEASISWA']);
            $elem->set_biaya_per_peg($val['BIAYA_PER_PEG_D_ELEM_BEASISWA']);
            $elem->set_bln($val['BLN_D_ELEM_BEASISWA']);
            $elem->set_thn($val['THN_D_ELEM_BEASISWA']);
            $elem->set_total_bayar($val['TOTAL_BAYAR_D_ELEM_BEASISWA']);
            $elem->set_no_sp2d($val['NO_SP2D_D_ELEM_BEASISWA']);
            $elem->set_tgl_sp2d($val['TGL_SP2D_D_ELEM_BEASISWA']);
            $elem->set_file_sp2d($val['FILE_SP2D_D_ELEM_BEASISWA']);
            $data[] = $elem;
        }

        return $data;
    }

    /*
     * mendapatkan universitas sesuai id
     * @param objek Universitas
     * return objek Universitas
     */

    public function get_elem_by_id($elem = ElemenBeasiswa) {
        if (is_null($elem->get_kd_d())) {
            return false;
        }
        $sql = "SELECT * FROM " . $elem->_table . " WHERE KD_D_ELEM_BEASISWA=" . $elem->get_kd_d() . "";
//        var_dump($sql);
        $result = $this->db->select($sql);
        foreach ($result as $val) {
            $this->set_kd_d($val['KD_D_ELEM_BEASISWA']);
            $this->set_kd_r($val['KD_R_ELEM_BEASISWA']);
            $elem->set_kd_jur($val['KD_JUR']);
            $elem->set_thn_masuk($val['TAHUN_MASUK']);
            $this->set_jml_peg($val['JML_PEG_D_ELEM_BEASISWA']);
            $elem->set_biaya_per_peg($val['BIAYA_PER_PEG_D_ELEM_BEASISWA']);
            $this->set_bln($val['BLN_D_ELEM_BEASISWA']);
            $this->set_thn($val['THN_D_ELEM_BEASISWA']);
            $this->set_total_bayar($val['TOTAL_BAYAR_D_ELEM_BEASISWA']);
            $this->set_no_sp2d($val['NO_SP2D_D_ELEM_BEASISWA']);
            $this->set_tgl_sp2d($val['TGL_SP2D_D_ELEM_BEASISWA']);
            $this->set_file_sp2d($val['FILE_SP2D_D_ELEM_BEASISWA']);
        }
        return $this;
    }

    /*
     * tambah data universitas
     * param array data array key=>value, nama kolom=>data
     */

    public function add_elem(ElemenBeasiswa $elem) {
//        if(!is_array($data)) return false;
        $data = array(
            'KD_R_ELEM_BEASISWA' => $elem->get_kd_r(),
            'KD_JUR' => $elem->get_kd_jur(),
            'TAHUN_MASUK' => $elem->get_thn_masuk(),
            'JML_PEG_D_ELEM_BEASISWA' => $elem->get_jml_peg(),
            'BIAYA_PER_PEG_D_ELEM_BEASISWA' => $elem->get_biaya_per_peg(),
            'BLN_D_ELEM_BEASISWA' => $elem->get_bln(),
            'THN_D_ELEM_BEASISWA' => $elem->get_thn(),
            'TOTAL_BAYAR_D_ELEM_BEASISWA' => $elem->get_total_bayar(),
            'NO_SP2D_D_ELEM_BEASISWA' => $elem->get_no_sp2d(),
            'TGL_SP2D_D_ELEM_BEASISWA' => $elem->get_tgl_sp2d(),
            'FILE_SP2D_D_ELEM_BEASISWA' => $elem->get_file_sp2d()
        );

        $this->db->insert($this->_table, $data);
        return $this->db->lastInsertId();
    }

    /*
     * update universitas, id harus di set terlebih dahulu
     * param data array
     */

    public function update_elem(ElemenBeasiswa $elem) {
        $data = array(
            'KD_R_ELEM_BEASISWA' => $elem->get_kd_r(),
            'KD_JUR' => $elem->get_kd_jur(),
            'TAHUN_MASUK' => $elem->get_thn_masuk(),
            'JML_PEG_D_ELEM_BEASISWA' => $elem->get_jml_peg(),
            'BIAYA_PER_PEG_D_ELEM_BEASISWA' => $elem->get_biaya_per_peg(),
            'BLN_D_ELEM_BEASISWA' => $elem->get_bln(),
            'THN_D_ELEM_BEASISWA' => $elem->get_thn(),
            'TOTAL_BAYAR_D_ELEM_BEASISWA' => $elem->get_total_bayar(),
            'NO_SP2D_D_ELEM_BEASISWA' => $elem->get_no_sp2d(),
            'TGL_SP2D_D_ELEM_BEASISWA' => $elem->get_tgl_sp2d(),
            'FILE_SP2D_D_ELEM_BEASISWA' => $elem->get_file_sp2d()
        );
        $where = "KD_D_ELEM_BEASISWA='" . $elem->get_kd_d() . "'";
        $this->db->update($this->_table, $data, $where);
    }

    /*
     * hapus elemen beasiswa, id harus di set terlebih dahulu
     */

    public function delete_elem($id) {
        $where = 'KD_D_ELEM_BEASISWA=' . $id;
        $this->db->delete($this->_table, $where);
    }

    public function get_elem_per_pb(Penerima $pb, $lunas = false) {
        $sql = "SELECT a.KD_D_ELEM_BEASISWA AS KD_D_ELEM_BEASISWA,
            b.NM_ELEM_BEASISWA as KD_R_ELEM_BEASISWA,
            a.JML_PEG_D_ELEM_BEASISWA as JML_PEG_D_ELEM_BEASISWA,
            a.BLN_D_ELEM_BEASISWA as BLN_D_ELEM_BEASISWA,
            a.THN_D_ELEM_BEASISWA as THN_D_ELEM_BEASISWA,
            a.TOTAL_BAYAR_D_ELEM_BEASISWA as TOTAL_BAYAR_D_ELEM_BEASISWA,
            c.KD_PB as KD_PB,
            a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_D_ELEM_BEASISWA
            FROM " . $this->_table . " a 
                LEFT JOIN r_elem_beasiswa b ON a.KD_R_ELEM_BEASISWA = b.KD_R_ELEM_BEASISWA
                LEFT JOIN t_elem_beasiswa c ON a.KD_D_ELEM_BEASISWA = c.KD_D_ELEM_BEASISWA
                WHERE c.KD_PB=" . $pb->get_kd_pb();
        if ($lunas) {
            $sql .= " AND a.NO_SP2D_D_ELEM_BEASISWA<>NULL";
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $v) {
            $elem = new $this($this->registry);
            $elem->set_kd_d($v['KD_D_ELEM_BEASISWA']);
            $elem->set_kd_r($v['KD_R_ELEM_BEASISWA']);

            $jml_peg = (int) $v['JML_PEG_D_ELEM_BEASISWA'];
            $total_bayar = (int) $v['TOTAL_BAYAR_D_ELEM_BEASISWA'];
            $by_per_peg = ($total_bayar / $jml_peg);
            $elem->set_biaya_per_peg($v['BIAYA_PER_PEG_D_ELEM_BEASISWA']);
            $elem->set_total_bayar($by_per_peg);
            $elem->set_thn_masuk($val['TAHUN_MASUK']);
            $elem->set_bln(Tanggal::bulan_indo($v['BLN_D_ELEM_BEASISWA']));
            $elem->set_thn($v['THN_D_ELEM_BEASISWA']);
            $elem->set_no_sp2d($v['NO_SP2D_KD_D_ELEM_BEASISWA']);
            $elem->set_no_sp2d($v['NO_SP2D_D_ELEM_BEASISWA']);
            $data[] = $elem;
        }

        return $data;
    }
    
    public function get_list_elem($univ = NULL, $jurusan = NULL, $tahun = NULL, $elemen=NULL) {

        $sql = "SELECT 
            a.KD_D_ELEM_BEASISWA AS KD_D_ELEM_BEASISWA,
            a.KD_R_ELEM_BEASISWA AS KD_R_ELEM_BEASISWA,
            a.TAHUN_MASUK AS TAHUN_MASUK,
            a.KD_JUR AS KD_JUR,
            b.NM_JUR as NM_JUR,
            c.KD_FAKUL AS KD_FAKUL,
            d.NM_UNIV as NM_UNIV,
            a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_D_ELEM_BEASISWA,
            a.TGL_SP2D_D_ELEM_BEASISWA as TGL_SP2D_D_ELEM_BEASISWA,
            a.JML_PEG_D_ELEM_BEASISWA as JML_PEG_D_ELEM_BEASISWA,
            a.BLN_D_ELEM_BEASISWA as BLN_D_ELEM_BEASISWA,
            a.THN_D_ELEM_BEASISWA as THN_D_ELEM_BEASISWA,
            a.TOTAL_BAYAR_D_ELEM_BEASISWA as TOTAL_BAYAR_D_ELEM_BEASISWA
            FROM " . $this->_table . " a
                LEFT JOIN r_jur b ON a.KD_JUR = b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL = c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV = d.KD_UNIV
                ";

        if ($univ != "" ) {
            $sql .=" WHERE d.KD_UNIV ='" . $univ . "'";
        }

        if ($jurusan != "") {
            if ($univ == "") {
                $sql .=" WHERE b.KD_JUR ='" . $jurusan . "'";
            } else {
                $sql .=" AND b.KD_JUR ='" . $jurusan . "'";
            }
        }

        if ($tahun != "") {
            if($univ == "" && $jurusan == ""){
               $sql .=" WHERE a.TAHUN_MASUK ='" . $tahun . "'"; 
            } else {
                $sql .=" AND a.TAHUN_MASUK ='" . $tahun . "'";
            }
            
        }
        
        if ($elemen != "") {
            if($univ == "" && $jurusan == "" && $tahun == "" ){
               $sql .=" WHERE a.KD_R_ELEM_BEASISWA ='" . $elemen . "'"; 
            } else {
                $sql .=" AND a.KD_R_ELEM_BEASISWA ='" . $elemen . "'";
            }
            
        }

        $sql .=" order by a.KD_D_ELEM_BEASISWA desc";
        $result = $this->db->select($sql);

        $data = array();
        foreach ($result as $key => $value) {

            $elem = new ElemenBeasiswa();
            $elem->set_kd_d($value['KD_D_ELEM_BEASISWA']);
            $elem->set_kd_r($value['KD_R_ELEM_BEASISWA']);
            $elem->set_no_sp2d($value['NO_SP2D_D_ELEM_BEASISWA']);
            $elem->set_tgl_sp2d(date('d-m-Y', strtotime($value['TGL_SP2D_D_ELEM_BEASISWA'])));
            $elem->set_univ($value['NM_UNIV']);
            $elem->set_thn_masuk($value['TAHUN_MASUK']);
            $elem->set_kd_jur($value['KD_JUR']);
            $elem->set_jml_peg($value['JML_PEG_D_ELEM_BEASISWA']);
            $elem->set_bln($value['BLN_D_ELEM_BEASISWA']);
            $elem->set_biaya_per_peg($v['BIAYA_PER_PEG_D_ELEM_BEASISWA']);
            $elem->set_thn($value['THN_D_ELEM_BEASISWA']);
            $elem->set_total_bayar($value['TOTAL_BAYAR_D_ELEM_BEASISWA']);
            $data [] = $elem;
        }
        //var_dump($data);
        return $data;
    }

    
    public function get_elem_jadup($univ = null, $jurusan = null, $tahun = null, $user=null) {

        $sql = "SELECT 
            a.KD_D_ELEM_BEASISWA AS KD_D_ELEM_BEASISWA,
            a.KD_R_ELEM_BEASISWA AS KD_R_ELEM_BEASISWA,
            a.TAHUN_MASUK AS TAHUN_MASUK,
            b.NM_JUR as NM_JUR,
            c.KD_FAKUL AS KD_FAKUL,
            d.NM_UNIV as NM_UNIV,
            a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_D_ELEM_BEASISWA,
            a.TGL_SP2D_D_ELEM_BEASISWA as TGL_SP2D_D_ELEM_BEASISWA,
            a.JML_PEG_D_ELEM_BEASISWA as JML_PEG_D_ELEM_BEASISWA,
            a.BLN_D_ELEM_BEASISWA as BLN_D_ELEM_BEASISWA,
            a.THN_D_ELEM_BEASISWA as THN_D_ELEM_BEASISWA,
            a.TOTAL_BAYAR_D_ELEM_BEASISWA as TOTAL_BAYAR_D_ELEM_BEASISWA
            FROM " . $this->_table . " a
                LEFT JOIN r_jur b ON a.KD_JUR = b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL = c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV = d.KD_UNIV
                WHERE KD_R_ELEM_BEASISWA='" . $this->_jadup . "'
                AND d.KD_USER ='".$user."'
                ";

        if ($univ != "") {
            $sql .=" AND d.KD_UNIV ='" . $univ . "'";
        }

        if ($jurusan != "") {
            if ($univ == "") {
                $sql .=" b.KD_JUR ='" . $jurusan . "'";
            } else {
                $sql .=" AND b.KD_JUR ='" . $jurusan . "'";
            }
        }

        if ($tahun != "") {
            $sql .=" AND a.TAHUN_MASUK ='" . $tahun . "'";
        }

        $sql .=" order by a.KD_D_ELEM_BEASISWA desc";
        $result = $this->db->select($sql);

        $data = array();
        foreach ($result as $key => $value) {

            $elem = new ElemenBeasiswa();
            $elem->set_kd_d($value['KD_D_ELEM_BEASISWA']);
            $elem->set_no_sp2d($value['NO_SP2D_D_ELEM_BEASISWA']);
            $elem->set_tgl_sp2d(date('d-m-Y', strtotime($value['TGL_SP2D_D_ELEM_BEASISWA'])));
            $elem->set_univ($value['NM_UNIV']);
            $elem->set_thn_masuk($value['TAHUN_MASUK']);
            $elem->set_kd_jur($value['NM_JUR']);
            $elem->set_jml_peg($value['JML_PEG_D_ELEM_BEASISWA']);
            $elem->set_bln($value['BLN_D_ELEM_BEASISWA']);
            $elem->set_biaya_per_peg($v['BIAYA_PER_PEG_D_ELEM_BEASISWA']);
            $elem->set_thn($value['THN_D_ELEM_BEASISWA']);
            $elem->set_total_bayar($value['TOTAL_BAYAR_D_ELEM_BEASISWA']);
            $data [] = $elem;
        }
        //var_dump($data);
        return $data;
    }

    public function get_elem_buku($univ = null, $jurusan = null, $tahun = null) {

        $sql = "SELECT 
            a.KD_D_ELEM_BEASISWA AS KD_D_ELEM_BEASISWA,
            a.KD_R_ELEM_BEASISWA AS KD_R_ELEM_BEASISWA,
            a.TAHUN_MASUK AS TAHUN_MASUK,
            b.NM_JUR as NM_JUR,
            c.KD_FAKUL AS KD_FAKUL,
            d.NM_UNIV as NM_UNIV,
            a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_D_ELEM_BEASISWA,
            a.TGL_SP2D_D_ELEM_BEASISWA as TGL_SP2D_D_ELEM_BEASISWA,
            a.JML_PEG_D_ELEM_BEASISWA as JML_PEG_D_ELEM_BEASISWA,
            a.BLN_D_ELEM_BEASISWA as BLN_D_ELEM_BEASISWA,
            a.THN_D_ELEM_BEASISWA as THN_D_ELEM_BEASISWA,
            a.TOTAL_BAYAR_D_ELEM_BEASISWA as TOTAL_BAYAR_D_ELEM_BEASISWA
            FROM " . $this->_table . " a
                LEFT JOIN r_jur b ON a.KD_JUR = b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL = c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV = d.KD_UNIV
                WHERE KD_R_ELEM_BEASISWA='" . $this->_buku . "'";

        if ($univ != "") {
            $sql .=" AND d.KD_UNIV ='" . $univ . "'";
        }

        if ($jurusan != "") {
            if ($univ == "") {
                $sql .=" b.KD_JUR ='" . $jurusan . "'";
            } else {
                $sql .=" AND b.KD_JUR ='" . $jurusan . "'";
            }
        }

        if ($tahun != "") {
            $sql .=" AND a.TAHUN_MASUK ='" . $tahun . "'";
        }

        $sql .=" order by a.KD_D_ELEM_BEASISWA desc";
        $result = $this->db->select($sql);

        $data = array();
        foreach ($result as $key => $value) {

            $elem = new ElemenBeasiswa();
            $elem->set_kd_d($value['KD_D_ELEM_BEASISWA']);
            $elem->set_no_sp2d($value['NO_SP2D_D_ELEM_BEASISWA']);
            $elem->set_tgl_sp2d(date('d-m-Y', strtotime($value['TGL_SP2D_D_ELEM_BEASISWA'])));
            $elem->set_univ($value['NM_UNIV']);
            $elem->set_thn_masuk($value['TAHUN_MASUK']);
            $elem->set_kd_jur($value['NM_JUR']);
            $elem->set_jml_peg($value['JML_PEG_D_ELEM_BEASISWA']);
            $elem->set_bln($value['BLN_D_ELEM_BEASISWA']);
            $elem->set_biaya_per_peg($v['BIAYA_PER_PEG_D_ELEM_BEASISWA']);
            $elem->set_thn($value['THN_D_ELEM_BEASISWA']);
            $elem->set_total_bayar($value['TOTAL_BAYAR_D_ELEM_BEASISWA']);
            $data [] = $elem;
        }
        //var_dump($data);
        return $data;
    }
    
    public function get_elem_jadup_by_sp2d($sp2d, $user) {

        $sql = "SELECT 
            a.KD_D_ELEM_BEASISWA AS KD_D_ELEM_BEASISWA,
            a.KD_R_ELEM_BEASISWA AS KD_R_ELEM_BEASISWA,
            a.TAHUN_MASUK AS TAHUN_MASUK,
            b.NM_JUR as NM_JUR,
            c.KD_FAKUL AS KD_FAKUL,
            d.NM_UNIV as NM_UNIV,
            a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_D_ELEM_BEASISWA,
            a.TGL_SP2D_D_ELEM_BEASISWA as TGL_SP2D_D_ELEM_BEASISWA,
            a.JML_PEG_D_ELEM_BEASISWA as JML_PEG_D_ELEM_BEASISWA,
            a.BLN_D_ELEM_BEASISWA as BLN_D_ELEM_BEASISWA,
            a.THN_D_ELEM_BEASISWA as THN_D_ELEM_BEASISWA,
            a.TOTAL_BAYAR_D_ELEM_BEASISWA as TOTAL_BAYAR_D_ELEM_BEASISWA
            FROM " . $this->_table . " a
                LEFT JOIN r_jur b ON a.KD_JUR = b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL = c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV = d.KD_UNIV
                WHERE KD_R_ELEM_BEASISWA='" . $this->_jadup . "'
                AND d.KD_USER ='".$user."'
                ";

        if ($sp2d != "") {
            $sql .=" AND a.NO_SP2D_D_ELEM_BEASISWA LIKE '" . $sp2d . "%'";
        }

        $sql .=" order by a.KD_D_ELEM_BEASISWA desc";
        $result = $this->db->select($sql);

        $data = array();
        foreach ($result as $key => $value) {

            $elem = new ElemenBeasiswa();
            $elem->set_kd_d($value['KD_D_ELEM_BEASISWA']);
            $elem->set_no_sp2d($value['NO_SP2D_D_ELEM_BEASISWA']);
            $elem->set_tgl_sp2d(date('d-m-Y', strtotime($value['TGL_SP2D_D_ELEM_BEASISWA'])));
            $elem->set_univ($value['NM_UNIV']);
            $elem->set_thn_masuk($value['TAHUN_MASUK']);
            $elem->set_kd_jur($value['NM_JUR']);
            $elem->set_jml_peg($value['JML_PEG_D_ELEM_BEASISWA']);
            $elem->set_bln($value['BLN_D_ELEM_BEASISWA']);
            $elem->set_biaya_per_peg($v['BIAYA_PER_PEG_D_ELEM_BEASISWA']);
            $elem->set_thn($value['THN_D_ELEM_BEASISWA']);
            $elem->set_total_bayar($value['TOTAL_BAYAR_D_ELEM_BEASISWA']);
            $data [] = $elem;
        }
        //var_dump($data);
        return $data;
    }

    public function get_elem_buku_by_sp2d($sp2d) {

        $sql = "SELECT 
            a.KD_D_ELEM_BEASISWA AS KD_D_ELEM_BEASISWA,
            a.KD_R_ELEM_BEASISWA AS KD_R_ELEM_BEASISWA,
            a.TAHUN_MASUK AS TAHUN_MASUK,
            b.NM_JUR as NM_JUR,
            c.KD_FAKUL AS KD_FAKUL,
            d.NM_UNIV as NM_UNIV,
            a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_D_ELEM_BEASISWA,
            a.TGL_SP2D_D_ELEM_BEASISWA as TGL_SP2D_D_ELEM_BEASISWA,
            a.JML_PEG_D_ELEM_BEASISWA as JML_PEG_D_ELEM_BEASISWA,
            a.BLN_D_ELEM_BEASISWA as BLN_D_ELEM_BEASISWA,
            a.THN_D_ELEM_BEASISWA as THN_D_ELEM_BEASISWA,
            a.TOTAL_BAYAR_D_ELEM_BEASISWA as TOTAL_BAYAR_D_ELEM_BEASISWA
            FROM " . $this->_table . " a
                LEFT JOIN r_jur b ON a.KD_JUR = b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL = c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV = d.KD_UNIV
                WHERE KD_R_ELEM_BEASISWA='" . $this->_buku . "'";

        if ($sp2d != "") {
            $sql .=" AND a.NO_SP2D_D_ELEM_BEASISWA LIKE '" . $sp2d . "%'";
        }

        $sql .=" order by a.KD_D_ELEM_BEASISWA desc";
        $result = $this->db->select($sql);

        $data = array();
        foreach ($result as $key => $value) {

            $elem = new ElemenBeasiswa();
            $elem->set_kd_d($value['KD_D_ELEM_BEASISWA']);
            $elem->set_no_sp2d($value['NO_SP2D_D_ELEM_BEASISWA']);
            $elem->set_tgl_sp2d(date('d-m-Y', strtotime($value['TGL_SP2D_D_ELEM_BEASISWA'])));
            $elem->set_univ($value['NM_UNIV']);
            $elem->set_thn_masuk($value['TAHUN_MASUK']);
            $elem->set_kd_jur($value['NM_JUR']);
            $elem->set_jml_peg($value['JML_PEG_D_ELEM_BEASISWA']);
            $elem->set_bln($value['BLN_D_ELEM_BEASISWA']);
            $elem->set_biaya_per_peg($v['BIAYA_PER_PEG_D_ELEM_BEASISWA']);
            $elem->set_thn($value['THN_D_ELEM_BEASISWA']);
            $elem->set_total_bayar($value['TOTAL_BAYAR_D_ELEM_BEASISWA']);
            $data [] = $elem;
        }
        //var_dump($data);
        return $data;
    }

    public function get_elem_skripsi_by_sp2d($sp2d = null) {

        $sql = "SELECT 
            a.KD_D_ELEM_BEASISWA AS KD_D_ELEM_BEASISWA,
            a.KD_R_ELEM_BEASISWA AS KD_R_ELEM_BEASISWA,
            a.TAHUN_MASUK AS TAHUN_MASUK,
            b.NM_JUR as NM_JUR,
            c.KD_FAKUL AS KD_FAKUL,
            d.NM_UNIV as NM_UNIV,
            a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_D_ELEM_BEASISWA,
            a.TGL_SP2D_D_ELEM_BEASISWA as TGL_SP2D_D_ELEM_BEASISWA,
            a.JML_PEG_D_ELEM_BEASISWA as JML_PEG_D_ELEM_BEASISWA,
            a.BLN_D_ELEM_BEASISWA as BLN_D_ELEM_BEASISWA,
            a.THN_D_ELEM_BEASISWA as THN_D_ELEM_BEASISWA,
            a.TOTAL_BAYAR_D_ELEM_BEASISWA as TOTAL_BAYAR_D_ELEM_BEASISWA
            FROM " . $this->_table . " a
                LEFT JOIN r_jur b ON a.KD_JUR = b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL = c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV = d.KD_UNIV
                WHERE KD_R_ELEM_BEASISWA='" . $this->_skripsi . "'";

        if ($sp2d != "") {
            $sql .=" AND a.NO_SP2D_D_ELEM_BEASISWA LIKE '" . $sp2d . "%'";
        }


        $sql .=" order by a.KD_D_ELEM_BEASISWA desc";
        $result = $this->db->select($sql);

        $data = array();
        foreach ($result as $key => $value) {

            $elem = new ElemenBeasiswa();
            $elem->set_kd_d($value['KD_D_ELEM_BEASISWA']);
            $elem->set_no_sp2d($value['NO_SP2D_D_ELEM_BEASISWA']);
            $elem->set_tgl_sp2d(date('d-m-Y', strtotime($value['TGL_SP2D_D_ELEM_BEASISWA'])));
            $elem->set_univ($value['NM_UNIV']);
            $elem->set_thn_masuk($value['TAHUN_MASUK']);
            $elem->set_kd_jur($value['NM_JUR']);
            $elem->set_jml_peg($value['JML_PEG_D_ELEM_BEASISWA']);
            $elem->set_bln($value['BLN_D_ELEM_BEASISWA']);
            $elem->set_biaya_per_peg($v['BIAYA_PER_PEG_D_ELEM_BEASISWA']);
            $elem->set_thn($value['THN_D_ELEM_BEASISWA']);
            $elem->set_total_bayar($value['TOTAL_BAYAR_D_ELEM_BEASISWA']);
            $data [] = $elem;
        }
        //var_dump($data);
        return $data;
    }

    public function get_elem_skripsi($univ = null, $jurusan = null, $tahun = null) {

        $sql = "SELECT 
            a.KD_D_ELEM_BEASISWA AS KD_D_ELEM_BEASISWA,
            a.KD_R_ELEM_BEASISWA AS KD_R_ELEM_BEASISWA,
            a.TAHUN_MASUK AS TAHUN_MASUK,
            b.NM_JUR as NM_JUR,
            c.KD_FAKUL AS KD_FAKUL,
            d.NM_UNIV as NM_UNIV,
            a.NO_SP2D_D_ELEM_BEASISWA as NO_SP2D_D_ELEM_BEASISWA,
            a.TGL_SP2D_D_ELEM_BEASISWA as TGL_SP2D_D_ELEM_BEASISWA,
            a.JML_PEG_D_ELEM_BEASISWA as JML_PEG_D_ELEM_BEASISWA,
            a.BLN_D_ELEM_BEASISWA as BLN_D_ELEM_BEASISWA,
            a.THN_D_ELEM_BEASISWA as THN_D_ELEM_BEASISWA,
            a.TOTAL_BAYAR_D_ELEM_BEASISWA as TOTAL_BAYAR_D_ELEM_BEASISWA
            FROM " . $this->_table . " a
                LEFT JOIN r_jur b ON a.KD_JUR = b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL = c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV = d.KD_UNIV
                WHERE KD_R_ELEM_BEASISWA='" . $this->_skripsi . "'";

        if ($univ != "") {
            $sql .=" AND d.KD_UNIV ='" . $univ . "'";
        }

        if ($jurusan != "") {
            if ($univ == "") {
                $sql .=" b.KD_JUR ='" . $jurusan . "'";
            } else {
                $sql .=" AND b.KD_JUR ='" . $jurusan . "'";
            }
        }

        if ($tahun != "") {
            $sql .=" AND a.TAHUN_MASUK ='" . $tahun . "'";
        }

        $sql .=" order by a.KD_D_ELEM_BEASISWA desc";
        $result = $this->db->select($sql);

        $data = array();
        foreach ($result as $key => $value) {

            $elem = new ElemenBeasiswa();
            $elem->set_kd_d($value['KD_D_ELEM_BEASISWA']);
            $elem->set_no_sp2d($value['NO_SP2D_D_ELEM_BEASISWA']);
            $elem->set_tgl_sp2d(date('d-m-Y', strtotime($value['TGL_SP2D_D_ELEM_BEASISWA'])));
            $elem->set_univ($value['NM_UNIV']);
            $elem->set_thn_masuk($value['TAHUN_MASUK']);
            $elem->set_kd_jur($value['NM_JUR']);
            $elem->set_jml_peg($value['JML_PEG_D_ELEM_BEASISWA']);
            $elem->set_bln($value['BLN_D_ELEM_BEASISWA']);
            $elem->set_biaya_per_peg($v['BIAYA_PER_PEG_D_ELEM_BEASISWA']);
            $elem->set_thn($value['THN_D_ELEM_BEASISWA']);
            $elem->set_total_bayar($value['TOTAL_BAYAR_D_ELEM_BEASISWA']);
            $data [] = $elem;
        }
        //var_dump($data);
        return $data;
    }

    /*
     * setter
     */

    public function set_kd_d($kd_d) {
        $this->_kd_d = $kd_d;
    }

    public function set_kd_r($kd_r) {
        $this->_kd_r = $kd_r;
    }

    public function set_kd_jur($kd_jur) {
        $this->_kd_jur = $kd_jur;
    }

    public function set_thn_masuk($thn_masuk) {
        $this->_thn_masuk = $thn_masuk;
    }

    public function set_biaya_per_peg($biaya_per_peg) {
        $this->_biaya_per_peg = $biaya_per_peg;
    }

    public function set_jml_peg($jml_peg) {
        $this->_jml_peg = $jml_peg;
    }

    public function set_bln($bln) {
        $this->_bln = $bln;
    }

    public function set_thn($thn) {
        $this->_thn = $thn;
    }

    public function set_total_bayar($total_bayar) {
        $this->_total_bayar = $total_bayar;
    }

    public function set_no_sp2d($no_sp2d) {
        $this->_no_sp2d = $no_sp2d;
    }

    public function set_tgl_sp2d($tgl_sp2d) {
        $this->_tgl_sp2d = $tgl_sp2d;
    }

    public function set_file_sp2d($file_sp2d) {
        $this->_file_sp2d = $file_sp2d;
    }

    public function set_table($table) {
        $this->_table = $table;
    }

    /**
     *  Setter tambahan untuk menggabungkan dengan tabel universitas
     */
    public function set_univ($univ) {
        $this->_univ = $univ;
    }

    /*
     * getter
     */

    public function get_kd_d($where = null) {
        if (!is_null($where)) {
            $sql = "SELECT KD_D_ELEM_BEASISWA FROM '" . $this->_table . "' WHERE '" . $where . "'";
            $result = $this->db->select($sql);
            foreach ($result as $val) {
                $this->set_kd_d($val['KD_D_ELEM_BEASISWA']);
            }
        }
        return $this->_kd_d;
    }

    public function get_kd_r() {
        return $this->_kd_r;
    }

    public function get_kd_jur() {
        return $this->_kd_jur;
    }

    public function get_thn_masuk() {
        return $this->_thn_masuk;
    }

    public function get_jml_peg() {
        return $this->_jml_peg;
    }

    public function get_biaya_per_peg() {
        return $this->_biaya_per_peg;
    }

    public function get_bln() {
        return $this->_bln;
    }

    public function get_thn() {
        return $this->_thn;
    }

    public function get_total_bayar() {
        return $this->_total_bayar;
    }

    public function get_no_sp2d() {
        return $this->_no_sp2d;
    }

    public function get_tgl_sp2d() {
        return $this->_tgl_sp2d;
    }

    public function get_file_sp2d() {
        return $this->_file_sp2d;
    }

    /**
     * getter tambahan univ 
     */
    public function get_univ() {
        return $this->_univ;
    }

    /*
     * destruktor
     */

    public function __destruct() {
        ;
    }

}

?>
