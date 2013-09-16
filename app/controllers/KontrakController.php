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
        
        $this->view->render('kontrak/data_kontrak');
    }
    
    public function rekam(){
        
        $this->view->render('kontrak/rekam_kontrak');
    }
    
    public function biaya(){
        $this->view->render('kontrak/data_biaya');
    }
    
    public function rekambiaya(){
        $this->view->render('kontrak/rekam_biaya');
    }
    
    public function monitoring(){
        $this->view->render('kontrak/mon_pembayaran');
    }
}
?>
