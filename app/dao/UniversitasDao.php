<?php

class UniversitasDao {
	
	private $_no;
    private $_kd_univ;
    private $_kode_univ;
    private $_kode_pic;
    private $_nama;
    private $_alamat;
    private $_telepon;
    private $_status;
    private $_lokasi;

    public function __construct(){
    	;
    }

    /*
     * setter
     */

    public function set_no($no) {
        $this->_no = $no;
    }
    
    public function set_kode_in($kode) {
        $this->_kd_univ = $kode;
    }

    public function set_kode($kode) {
        $this->_kode_univ = $kode;
    }

    public function set_pic($pic) {
        $this->_kode_pic = $pic;
    }

    public function set_nama($nama) {
        $this->_nama = $nama;
    }

    public function set_alamat($alamat) {
        $this->_alamat = $alamat;
    }

    public function set_telepon($telepon) {
        $this->_telepon = $telepon;
    }

    public function set_status($status) {
        $this->_status = $status;
    }

    public function set_lokasi($lokasi) {
        $this->_lokasi = $lokasi;
    }

    public function get_no() {
        return $this->_no;
    }

    public function get_kode_in() {
        return $this->_kd_univ;
    }

    public function get_kode() {
        return $this->_kode_univ;
    }

    public function get_pic() {
        return $this->_kode_pic;
    }

    public function get_alamat() {
        return $this->_alamat;
    }

    public function get_lokasi() {
        return $this->_lokasi;
    }

    public function get_nama() {
        return $this->_nama;
    }

    public function get_status() {
        return $this->_status;
    }

    public function get_telepon() {
        return $this->_telepon;
    }

    public function __destruct(){
    	;
    }
}

