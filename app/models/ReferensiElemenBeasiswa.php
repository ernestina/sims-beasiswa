<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ReferensiElemenBeasiswa {

    /**
     * attribut 
     */
    private $jadup;
    private $buku;
    private $ta;
    private $tesis;
    private $table = 'r_elemen_beasiswa';

    public function __construct() {
        $this->db = new Database();
    }

    /**
     * setter 
     */
    public function jadup() {
        $sql = "SELECT JML_ELEM_BEASISWA as jadup FROM R_ELEM_BEASISWA WHERE KD_R_ELEM_BEASISWA=1";

        $result = $this->db->select($sql);

        $data = array();
        foreach ($result as $value) {
            $data = $value['jadup'];
        }
        return $data;
    }

    public function buku() {
        $sql = "SELECT JML_ELEM_BEASISWA as buku FROM R_ELEM_BEASISWA WHERE KD_R_ELEM_BEASISWA=2";

        $result = $this->db->select($sql);

        $data = array();
        foreach ($result as $value) {
            $data = $value['buku'];
        }
        
//        var_dump($data);
        return $data;
    }

    public function ta() {
        $sql = "";
    }

    public function tesis() {
        $sql = "";
    }

    public function set_jadup() {
        
    }

    public function set_buku() {
        
    }

    public function set_ta() {
        
    }

    public function set_tesis() {
        
    }

    /**
     * getter 
     */
    public function get_jadup() {
        
    }

    public function get_buku() {
        
    }

    public function get_ta() {
        
    }

    public function get_tesis() {
        
    }

}

?>
