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

        $sql = "SELECT " . $this->_table . ".KD_USER, " . $this->_table . ".NIP_USER, " . $this->_table . ".NM_USER, " . $this->_table . ".PASS_USER,
                " . $this->_table2 . ".nama as AKSES_USER, " . $this->_table . ".FOTO_USER FROM " . $this->_table . " LEFT JOIN " . $this->_table2 . "
                on " . $this->_table . ".AKSES_USER = " . $this->_table2 . ".id ";
        if ($level) {
            $sql .=" WHERE AKSES_USER= '2'";
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

//        $data = array();
        $user = new User($registry);
        foreach ($result as $value) {
//            $user = new User($registry);
            $user->set_id($value['KD_USER']);
            $user->set_nip($value['NIP_USER']);
            $user->set_nmUser($value['NM_USER']);
            $user->set_pass($value['PASS_USER']);
            $user->set_akses($value['AKSES_USER']);
            $user->set_foto($value['FOTO_USER']);

//            $data = $user;
        }
//        var_dump($data->get_nmUser());
        return $user;
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
        if ($user->get_foto() == "") {

            $data = array(
                'NIP_USER' => $user->get_nip(),
                'NM_USER' => $user->get_nmUser(),
                'PASS_USER' => Hash::create('sha1', $user->get_pass(), HASH_SALT_KEY),
                'AKSES_USER' => $user->get_akses()
            );
        } else {
            $data = array(
                'NIP_USER' => $user->get_nip(),
                'NM_USER' => $user->get_nmUser(),
                'PASS_USER' => Hash::create('sha1', $user->get_pass(), HASH_SALT_KEY),
                'AKSES_USER' => $user->get_akses(),
                'FOTO_USER' => $user->get_foto()
            );
        }

        $this->_db->update($this->_table, $data, $where);
    }

    public function updateUser_withoutpass(User $user) {
        $where = "KD_USER = " . $user->get_id();

//            var_dump($user->get_pass());
        if ($user->get_foto() == "") {
            $data = array(
                'NIP_USER' => $user->get_nip(),
                'NM_USER' => $user->get_nmUser(),
                'AKSES_USER' => $user->get_akses()
            );
        } else {
            $data = array(
                'NIP_USER' => $user->get_nip(),
                'NM_USER' => $user->get_nmUser(),
                'AKSES_USER' => $user->get_akses(),
                'FOTO_USER' => $user->get_foto()
            );
        }

        $this->_db->update($this->_table, $data, $where);
    }

    public function login($username, $password) {
        $sql = "SELECT * FROM " . $this->_table . " WHERE NM_USER='" . $username . "' AND PASS_USER='" . $password . "'";
        $result = $this->_db->select($sql);
        $role = 0;
        $return = array();
        foreach ($result as $v) {
            $role = $v['AKSES_USER'];
            $kd = $v['NM_USER'];
        }
        $return[] = count($result);
        $return[] = $role;
        $return[] = $kd;
        return $return;
    }

    public function upload_foto() {

        $allowedExts = array("pdf", "jpg", "jpeg", "png");

        $ext = explode('.', $_FILES['upload']['name']);
        $extension = $ext[count($ext) - 1];

        if (in_array($extension, $allowedExts)) {

            if ($_FILES["upload"]["error"] > 0) {
                echo "Return Code: " . $_FILES["upload"]["error"] . "<br />";
            } else {
//                echo "Upload: " . $_FILES["upload"]["name"] . "<br />";
//                echo "Type: " . $_FILES["upload"]["type"] . "<br />";
//                echo "Size: " . ($_FILES["upload"]["size"] / 1024) . " Kb<br />";
//                echo "Temp file: " . $_FILES["upload"]["tmp_name"] . "<br />";

                if (file_exists("files/" . $_SESSION["nrp"] . "/" . $_FILES["upload"]["name"])) {
                    echo $_FILES["upload"]["name"] . " file telah ada. ";
                } else {
                    // Create directory if it does not exist
//                    if (!is_dir("files/" . $_SESSION["nrp"] . "/")) {
//                        mkdir("files/" . $_SESSION["nrp"] . "/");
//                    }
                    // Move the uploaded file
                    move_uploaded_file($_FILES["upload"]["tmp_name"], "files/" . $_SESSION["nrp"] . "/" . $_FILES["upload"]["name"]);
                }
            }
        } else {
            echo "Invalid file";
        }
//        header('location:' . URL . 'file');
    }

    public function delUser($id) {

        $where = "KD_USER=" . $id;

        $sql = "SELECT * FROM " . $this->_table . " WHERE " . $where . "";
        $result = $this->_db->select($sql);

        $pic = new User($registry);
        foreach ($result as $value) {
            $pic->set_id($value['KD_USER']);
            $pic->set_akses($value['AKSES_USER']);
        }

        if ($pic->get_akses() == '1') {
            
        } else {
            $this->_db->delete($this->_table, $where);
        }
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
