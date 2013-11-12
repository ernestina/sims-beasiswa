<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ClassException extends Exception {
    
    public function __construct() {
        parent::__construct();
//        $this->init($message, $kode);
    }
    
    /*public function __construct($message, $code, $previous) {
        parent::__construct($message, $code, $previous);
    }*/
    
    private function init($message, $kode){
        
    }
}
?>
