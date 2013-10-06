<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CutiController extends BaseController{
    
    public function __construct($registry) {
        parent::__construct($registry);
    }
    
    public function index(){
        
    }
    
    public function datasc($id=null){
        $ct = new Cuti($this->registry);
        $jsc = new JenisSuratCuti($this->registry);
        $univ = new Universitas($this->registry);
        if(isset($_POST['sb_add'])){
            $noct = $_POST['no_ct'];
            $jsc = $_POST['jsc'];
            $tgl_st = $_POST['tgl_st'];
            $kd_pb = $_POST['kd_pb'];
            $jur = $_POST['jur'];
            $sem_mul = $_POST['sem_mulai'];
            $thn_mul = $_POST['thn_mulai'];
            $sem_sel = $_POST['sem_sel'];
            $thn_sel = $_POST['thn_sel'];
            $bln_stop = $_POST['bln_stop'];
            $thn_stop = $_POST['thn_stop'];
            $bln_go = $_POST['bln_go'];
            $thn_go = $_POST['thn_go'];
            
            $pb = new Penerima($this->registry);
            $pb->set_kd_pb($kd_pb);
            $d_pb = $pb->get_penerima_by_id($pb);
//            $upload = $this->registry->upload;
            $cname = array('CUTI',$d_pb->get_nip(),$thn_mul);
            $this->registry->upload->init('fupload');
            $this->registry->upload->setDirTo('files/cuti/');
            $this->registry->upload->changeFileName($this->registry->upload->getFileName(),$cname);
            $file = $this->registry->upload->getFileTo();
            $this->registry->upload->uploadFile();
        }
        
        if(!is_null($id)){
            $this->view->d_ubah = $ct->get_cuti_by_id($pb);
        }
        $this->view->d_ct = $ct->get_cuti();
        $this->view->d_univ = $univ->get_univ();
        $this->view->d_jsc = $jsc->get_jsc();
        $this->view->curr_year = date('Y');
        $this->view->render('riwayat_tb/data_cuti');
    }
    public function __destruct() {
        parent::__destruct();
    }
}
?>
