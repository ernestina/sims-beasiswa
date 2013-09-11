<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class BantuanController extends BaseController{
    
    public function __construct($registry) {
        parent::__construct($registry);
    }
    
    public function index(){
        echo 'index bantuan';
    }
    
    public function jadup(){
        $this->view->load('bantuan/jadup');
    }
    
    public function addJadup(){
        $this->view->load('bantuan/rekam_jadup');
    }
    
    public function bybuku(){
        $this->view->load('bantuan/buku');
    }
    
    public function addByBuku(){
        $this->view->load('bantuan/rekam_buku');
    }
    
    public function byskripsi(){
        $this->view->load('bantuan/biaya_skripsi');
    }
    
    public function addBySkripsi(){
        $this->view->load('bantuan/rekam_biaya_skripsi');
    }
    
    public function monbayar(){
        $this->view->load('bantuan/mon_pembayaran');
    }
}

?>
