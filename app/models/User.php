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
    private $_table2 = "r_user";

    public function __construct($registry) {
        $this->registry = $registry;
        $this->_db = new Database();
    }

    public function get_user($level = FALSE) {

        $sql = "SELECT ".$this->_table.".KD_USER, ".$this->_table.".NIP_USER, ".$this->_table.".NM_USER, ".$this->_table.".PASS_USER,
                ".$this->_table2.".nama as AKSES_USER, ".$this->_table.".FOTO_USER FROM ".$this->_table." LEFT JOIN ".$this->_table2."
                on ".$this->_table.".AKSES_USER = ".$this->_table2.".id ";
        if ($level) {
            $sql .=" WHERE AKSES_USER= 'user'";
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

    public function getUser_id($KD_USER) {

        $sql = "SELECT * FROM " . $this->_table . " WHERE KD_USER = " . $KD_USER . "";

        $result = $this->_db->select($sql);

        $data = array();

        foreach ($result as $value) {
            $user = new User($registry);
            $user->set_id($value['KD_USER']);
            $user->set_nip($value['NIP_USER']);
            $user->set_nmUser($value['NM_USER']);
            $user->set_pass($value['PASS_USER']);
            $user->set_akses($value['AKSES_USER']);
            $user->set_foto($value['FOTO_USER']);

            $data = $user;
        }

        return $data;
    }

    public function check_user_nip($nip) {

        $sql = "SELECT * FROM " . $this->_table . " WHERE NIP_USER='" . $nip . "'";

        $result = $this->_db->select($sql);

//        var_dump($result);
        $count = count($result);
//        var_dump($count);
        return $count;
    }

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
    public function updateUser_withoutpass (User $user){
            $where = "KD_USER = " . $user->get_id();

//            var_dump($user->get_pass());
            $data = array(
                'NIP_USER' => $user->get_nip(),
                'NM_USER' => $user->get_nmUser(),
                'AKSES_USER' => $user->get_akses(),
                'FOTO_USER' => $user->get_foto()
            );
            $this->_db->update($this->_table, $data, $where);
    }
    public function delUser($id) {
        $where = "KD_USER=" . $id;

        $this->_db->delete($this->_table, $where);
    }

    public function get_id() {
        return $this->_id;
    }

    public function set_id($id) {
        $this->_id = $id;
    }

    public function get_nip() {
        return $this->_nip;
    }

    public function set_nip($nip) {
        $this->_nip = $nip;
    }

    public function get_nmUser() {
        return $this->_nama;
    }

    public function set_nmUser($nama) {
        $this->_nama = $nama;
    }

    public function get_pass() {
        return $this->_pass;
    }

    public function set_pass($pass) {
        $this->_pass = $pass;
    }

    public function get_akses() {
        return $this->_akses;
    }

    public function set_akses($akses) {
        $this->_akses = $akses;
    }

    public function get_foto() {
        return $this->_foto;
    }

    public function set_foto($foto) {
        $this->_foto = $foto;
    }

}

?>
