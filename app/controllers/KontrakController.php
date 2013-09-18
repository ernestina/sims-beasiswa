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
        if (!isset($_POST['rekam_kontrak'])) {
            $universitas = new Universitas($this->registry);
            $univ = $universitas->get_univ();
            $kontrak = new Kontrak();
            $kon = $kontrak->get_All();
            $this->view->univ = $univ;
            $this->view->kon = $kon;
            $this->view->render('kontrak/rekam_kontrak');
        }else{
            $kontrak = new Kontrak();
            //$kontrak->kd_kontrak =$_POST[''];
            $kontrak->no_kontrak=$_POST['nomor'];
            $kontrak->kd_jurusan=$_POST['jur'];
            $kontrak->tgl_kontrak = date('Y-d-m', strtotime($_POST['tanggal']));
            $kontrak->thn_masuk_kontrak=$_POST['tahun_masuk'];
            $kontrak->jml_pegawai_kontrak=$_POST['jml_peg'];
            $kontrak->lama_semester_kontrak=$_POST['lama_semester'];
                        
            $upload = new Upload();
            $upload->init('fupload');
            $upload->setDirTo('files/');
            $nama = array($kontrak->no_kontrak,$kontrak->tgl_kontrak);
            $upload->changeFileName($upload->getFileName(),$nama);
            
            $kontrak->file_kontrak=$upload->getFileTo();
            //var_dump($kontrak);
            $kontrak->add($kontrak);
            $upload->uploadFile();
            header('location:'.URL.'kontrak/display');
        }
    }

    public function univ($univ = null) {
        if ($univ != "") {
            $jurusan = new Jurusan($this->registry);
            $data = $jurusan->get_jur_by_univ($univ);
            foreach ($data as $jur) {
                echo "<option value=" . $jur->get_kode_jur() . ">" . $jur->get_nama() . "</option>\n";
            }
        } else {
           echo "<option value=''>Pilih Jurusan</option>"; 
        }
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
