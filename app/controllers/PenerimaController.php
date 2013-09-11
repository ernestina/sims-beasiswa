<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PenerimaController {
    
    private $registry;
    private $View;
    
    public function __construct($registry){
        $this->registry = $registry;
        $this->View = new View();
    }
    
    public function halo($name){
        echo "halo ".$name."!";
        
    }
    
    public function tes($id){
        $penerima = new Penerima();
        $this->View->data = $penerima->get();
        $this->View->load('test');
    }
}
?>
