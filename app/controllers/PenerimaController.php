<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PenerimaController extends BaseController{
    
    private $registry;
    private $View;
    
    public function __construct($registry){
        parent::__construct($registry);
    }
    
    public function profil($id){
        
    }
    
    public function tes($id){
        $penerima = new Penerima();
        $this->View->data = $penerima->get();
        $this->View->load('test');
    }
}
?>
