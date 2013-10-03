<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class User {

    public $registry;
    private $_table = "d_user";
    public $_db;
    private $_id;
    private $_nip;
    private $_nama;
    private $_pass;
    private $_akses;
    private $_foto;

    /*
     * Konstruktor
     */

    public function __construct($registry) {
        $this->registry = $registry;
        $this->_db = new Database();
    }

    /*
     * Mendapatkan semua user
     */

    public function get_user($level = FALSE) {

        $sql = "SELECT * FROM " . $this->_table . "";
        if ($level) {
            $sql .=" WHERE AKSES_USER=2";
        }

        $result = $this->_db->select($sql);

        $data = array();

        foreach ($result as $value) {
            $user = new User($registry);
            $user->set_id($value['KD_USER']);
            $user->set_nip($value ['NIP_USER']);
            $user->set_nmUser($value ['NM_USER']);
            $user->set_pass($value['PASS_USER']);
            $user->set_akses($value['AKSES_USER']);
            $user->set_foto($value['FOTO_USER']);
            $data[] = $user;
        }
        return $data;
    }

    /*
     * Mendapatkan user berdasarkan id_user
     * @param id_user
     */

    public function getUser_id($KD_USER) {

        $sql = "SELECT * FROM " . $this->_table . " WHERE KD_USER = " . $KD_USER;
        $result = $this->_db->select($sql);
//        $data = array();

        foreach ($result as $value) {
//            $user = new User($this->registry);
            $this->set_id($value['KD_USER']);
            $this->set_nip($value['NIP_USER']);
            $this->set_nmUser($value['NM_USER']);
            $this->set_pass($value['PASS_USER']);
            $this->set_akses($value['AKSES_USER']);
            $this->set_foto($value['FOTO_USER']);

//            $data = $user;
        }

        return $this;
    }

    /*
     * Mengecek apakah nip user telah terdaftar di database
     * @param nip
     */

    public function check_user_nip($nip) {

        $sql = "SELECT * FROM " . $this->_table . " WHERE NIP_USER='" . $nip . "'";

        $result = $this->_db->select($sql);

//        var_dump($result);
        $count = count($result);
//        var_dump($count);
        return $count;
    }

    /*
     * menambahkan user pada database
     */

    public function addUser(User $user) {

        if ($this->check_user_nip($user->get_nip()) == 1) {
            echo 'data telah ada di dalam database';
        } else {
            $data = array(
                'NIP_USER' => $user->get_nip(),
                'NM_USER' => $user->get_nmUser(),
                'PASS_USER' => Hash::create('sha1', $user->get_pass(), HASH_SALT_KEY),
                'AKSES_USER' => $user->get_akses(),
                'FOTO_USER' => $user->get_foto()
            );

            $this->_db->insert($this->_table, $data);
        }
    }

    /*
     * merubah user pada database
     */

    public function updateUser(User $user) {

        $where = "KD_USER = " . $user->get_id();

        $data = array(
            'NIP_USER' => $user->get_nip(),
            'NM_USER' => $user->get_nmUser(),
            'PASS_USER' => Hash::create('sha1', $user->get_pass(), HASH_SALT_KEY),
            'AKSES_USER' => $user->get_akses(),
            'FOTO_USER' => $user->get_foto()
        );
        $this->_db->update($this->_table, $data, $where);
    }

    /*
     * mnghapus user pada database
     */

    public function delUser($id) {
        $where = "KD_USER=" . $id;

        $this->_db->delete($this->_table, $where);
    }

    /*
     * getter
     */

    public function get_id() {
        return $this->_id;
    }

    public function get_nip() {
        return $this->_nip;
    }

    public function get_nmUser() {
        return $this->_nama;
    }

    public function get_pass() {
        return $this->_pass;
    }

    public function get_akses() {
        return $this->_akses;
    }

    public function get_foto() {
        return $this->_foto;
    }

    /*
     * setter
     */

    public function set_id($id) {
        $this->_id = $id;
    }

    public function set_nip($nip) {
        $this->_nip = $nip;
    }

    public function set_nmUser($nama) {
        $this->_nama = $nama;
    }

    public function set_pass($pass) {
        $this->_pass = $pass;
    }

    public function set_akses($akses) {
        $this->_akses = $akses;
    }

    public function set_foto($foto) {
        $this->_foto = $foto;
    }

}

?>
