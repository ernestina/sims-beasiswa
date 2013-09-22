<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class elemenBeasiswaController extends BaseController{
    
    public function __construct($registry) {
        parent::__construct($registry);
    }
    
    public function index(){
        $elem = new ElemenBeasiswa($this->registry);
        if (isset($_POST['add_elem'])) {
            $kode_r = $_POST['kode_r'];
            $jml_peg = $_POST['jml_peg'];
            $bln = $_POST['bln'];
            $thn = $_POST['thn'];
            $total_bayar = $_POST['total_bayar'];
            $no_sp2d = $_POST['no_sp2d'];
            $tgl_sp2d = $_POST['tgl_sp2d'];
            $file_sp2d = $_POST['file_sp2d'];
            
            $data = array(
                'KD_R_ELEM_BEASISWA' => $kode_r,
                'JML_PEG_D_ELEM_BEASISWA' => $jml_peg,
                'BLN_D_ELEM_BEASISWA' => $bln,
                'THN_D_ELEM_BEASISWA' => $thn,
                'TOTAL_BAYAR_D_ELEM_BEASISWA' => $total_bayar,
                'NO_SP2D_D_ELEM_BEASISWA' => $no_sp2d,
                'TGL_SP2D_D_ELEM_BEASISWA' => $tgl_sp2d,
                'FILE_SP2D_D_ELEM_BEASISWA' => $file_sp2d
            );
            $elem->add_elem($data);
        }
        
        if (isset($_POST['update_elem'])) {
            $kode_d = $_POST['kode_d'];
            $kode_r = $_POST['kode_r'];
            $jml_peg = $_POST['jml_peg'];
            $bln = $_POST['bln'];
            $thn = $_POST['thn'];
            $total_bayar = $_POST['total_bayar'];
            $no_sp2d = $_POST['no_sp2d'];
            $tgl_sp2d = $_POST['tgl_sp2d'];
            $file_sp2d = $_POST['file_sp2d'];
            
            $data = array(
                'KD_D_ELEM_BEASISWA' => $kode_d,
                'KD_R_ELEM_BEASISWA' => $kode_r,
                'JML_PEG_D_ELEM_BEASISWA' => $jml_peg,
                'BLN_D_ELEM_BEASISWA' => $bln,
                'THN_D_ELEM_BEASISWA' => $thn,
                'TOTAL_BAYAR_D_ELEM_BEASISWA' => $total_bayar,
                'NO_SP2D_D_ELEM_BEASISWA' => $no_sp2d,
                'TGL_SP2D_D_ELEM_BEASISWA' => $tgl_sp2d,
                'FILE_SP2D_D_ELEM_BEASISWA' => $file_sp2d
            );
            $elem->set_kd_d($kode_d);
            $elem->update_elem($data);
        }
        
        $this->view->data = $elem->get_elem();
        $this->view->render('bantuan/jadup');
    }
    
    public function addElem($id = null){
        $elem = new ElemenBeasiswa($this->registry);
        
        if (!is_null($id)) {
            $elem->set_kd_d($id);
            $this->view->d_ubah = $elem->get_elem_by_id($elem);
        }
        $this->view->render('bantuan/rekam_jadup');
    }
    
    public function delElem($id) {
        $elem = new ElemenBeasiswa($this->registry);
        if (is_null($id)) {
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
        $elem->set_kd_d($id);
        $elem->delete_elem();
        header('location:' . URL . 'elemenBeasiswa/index');
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
