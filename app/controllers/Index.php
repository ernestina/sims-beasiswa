<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Index extends BaseController{
    
    public function __construct($registry) {
        parent::__construct($registry);
    }
    
    public function index(){
        $notif = new Notifikasi($this->registry);
        $notif->get_notifikasi();
        $this->view->render('index');
    }
}
?>
