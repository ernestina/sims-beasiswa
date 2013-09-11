<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Penerima extends Database{
    
    private $registry;
    
    public function __construct() {
        parent::__construct();
    }

    public function get(){
        $sql = "SELECT * FROM penerima";
        $data = $this->select($sql);
        return $data;
    }
    
    public function remove($id=null){
        $where = 'id = '.$id;
        $this->delete($table, $where);
    }
    
    public function ubah($data){
        
    }
}
?>
