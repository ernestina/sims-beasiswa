<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseModel{
    public $registry;
    public $db;
    public $table;
                
    public function __construct($registry) {
        $this->registry = $registry;
        $this->db = $registry->db;
    }
    
       
    public function __destruct(){
        ;
    }
    
}
?>
