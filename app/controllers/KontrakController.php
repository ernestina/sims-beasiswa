<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KontrakController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function index() {
        
    }

    public function display() {
        $kontrak = new Kontrak();
        if (!isset($_POST['pilih_univ'])) {
            //echo "1";
            $data = $kontrak->get_All();
            $this->view->pil = "";
        } else {
            //echo $_POST['universitas'];
            if ($_POST['universitas'] != "") {
                $data = $kontrak->get_by_univ($_POST['universitas']);
                $this->view->pil = $_POST['universitas'];
            } else {
                $data = $kontrak->get_All();
                $this->view->pil = "";
            }
        }
        //var_dump($data);
        $universitas = new Universitas($this->registry);
        $univ = $universitas->get_univ();
        //var_dump($univ);
        $this->view->univ = $univ;
        $this->view->data = $data;

        $this->view->render('kontrak/data_kontrak');
    }

    public function rekam() {

        $this->view->render('kontrak/rekam_kontrak');
    }

    public function biaya() {
        $this->view->render('kontrak/data_biaya');
    }

    public function rekambiaya() {
        $this->view->render('kontrak/rekam_biaya');
    }

    public function monitoring() {
        $this->view->render('kontrak/mon_pembayaran');
    }

}

?>
