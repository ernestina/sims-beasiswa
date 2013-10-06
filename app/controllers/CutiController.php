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
        if(isset($_POST['sb_add'])){
            $noct = $_POST['no_sc'];
            $jsc = $_POST['jsc'];
            $tgl_sc = $_POST['tgl_sc'];
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
//            $data = $noct." ".$jsc." ".$tgl_sc." ".$kd_pb." ".$jur." ".$sem_mul." ".$sem_sel." ".$thn_mul." ".$thn_sel
//                    ." ".$bln_stop." ".$bln_go." ".$thn_stop." ".$thn_go." ".$_FILES['fupload']['name'];
//            echo $data;
            $pb = new Penerima($this->registry);
            $pb->set_kd_pb($kd_pb);
            $d_pb = $pb->get_penerima_by_id($pb);
//            $upload = $this->registry->upload;
            $cname = array('CUTI',$d_pb->get_nip(),$thn_mul);
            $this->registry->upload->init('fupload');
            $this->registry->upload->setDirTo('files/cuti/');
            $this->registry->upload->changeFileName($this->registry->upload->getFileName(),$cname);
            $file = $this->registry->upload->getFileTo();
//            echo $file;
            $ct->set_no_surat_cuti($noct);
            $ct->set_jenis_cuti($jsc);
            $ct->set_tgl_surat_cuti(Tanggal::ubahFormatTanggal($tgl_sc));
            $ct->set_pb($kd_pb);
            $ct->set_prd_mulai($sem_mul." ".$thn_mul);
            $ct->set_prd_selesai($sem_sel." ".$thn_sel);
            $ct->set_perk_stop($bln_stop." ".$thn_stop);
            $ct->set_perk_go($bln_go." ".$thn_go);
            $ct->set_file($file);
            if($ct->add_cuti()){
                $this->registry->upload->uploadFile();
                header('location:'.URL.'cuti/datasc');
            }else{
                
            }
            
        }
        
        if(!is_null($id)){
            $this->view->d_ubah = $ct->get_cuti_by_id($pb);
        }
        $jsc = new JenisSuratCuti($this->registry);
        $univ = new Universitas($this->registry);
        $this->view->d_ct = $ct->get_cuti();
        $this->view->d_univ = $univ->get_univ();
        $this->view->d_jsc = $jsc->get_jsc();
        $this->view->curr_year = date('Y');
        $this->view->render('riwayat_tb/data_cuti');
    }
    
    public function del_sc($kd_cuti){
        $ct = new Cuti($this->registry);
        $ct->set_kode_cuti($kd_cuti);
        $ct->del_ct();
        header('location:'.URL.'cuti/datasc');
    }


    public function dialog_add_pb(){
        $pb = new Penerima($this->registry);
        $this->view->d_pb = $pb->get_penerima();
        $this->view->load('riwayat_tb/dialog_add_pb_sc');
    }
    
    public function __destruct() {
        parent::__destruct();
    }
}
?>
