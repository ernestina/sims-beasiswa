<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KontrakController extends BaseController{
    
    public function __construct($registry) {
        parent::__construct($registry);
    }
    
    public function index(){
        
    }
    
    public function display(){
        
        $this->view->load('kontrak/data_kontrak');
    }
    
    public function rekam(){
        
        $this->view->load('kontrak/rekam_kontrak');
    }
    
    public function biaya(){
        $this->view->load('kontrak/data_biaya');
    }
    
    public function rekambiaya(){
        $this->view->load('kontrak/rekam_biaya');
    }
    
    public function monitoring(){
        $this->view->load('kontrak/mon_pembayaran');
    }
}
?>
