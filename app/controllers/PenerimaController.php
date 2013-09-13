<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PenerimaController extends BaseController{
    
    public function __construct($registry){
        parent::__construct($registry);
    }
    
    public function profil($id=null){
        $pb = new Penerima($this->registry);
        if(!is_null($id)){
            $pb->set_kd_pb($id);
            $this->view->d_pb = $pb->get_penerima_by_id($pb);
        }
        $this->view->render('profil/data_profil');
    }
    
    public function penerima($id=null){
        $pb = new Penerima($this->registry);
        if(isset($_POST['sb_add'])){
            $st = $_POST['st'];
            $bank = $_POST['bank'];
            $jur = $_POST['jur'];
            $status = $_POST['status'];
            $nama = $_POST['nama'];
            $nip = $_POST['nip'];
            $gol = $_POST['gol'];
            $unit_asal = $_POST['unit_asal'];
            $telp = $_POST['telp'];
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $no_rek = $_POST['no_rek'];
            $jkel = $_POST['jk'];
            $tgl_lapor = $_POST['tgl_lap'];
            $skl = $_POST['skl'];
            $spmt = $_POST['spmt'];
            $skripsi = $_POST['skripsi'];
            
            $file = $_FILES['fupload'];
            $data = array(
                'KD_ST'=>$st,
                'KD_JUR'=>$jur,
                'KD_BANK'=>$bank,
                'KD_STATUS_TB'=>$status,
                'NIP_PB'=>$nip,
                'NAMA_PB'=>$nama,
                'JK_PB'=>$jkel,
                'GOLONGAN_PB'=>$gol,
                'UNIT_ASAL_PB'=>$unit_asal,
                'EMAIL_PB'=>$email,
                'TELP_PB'=>$telp,
                'ALAMAT_PB'=>$alamat,
                'NO_REKENING_PB'=>$no_rek,
                'FOTO_PB'=>$file['name'],
                'TANGGAL_LAPOR_PB'=>$tgl_lapor,
                'NOMOR_SKL_PB'=>$skl,
                'NO_SPMT_PB'=>$spmt,
                'JUDUL_SKRIPSI_PB'=>$skripsi
            );
//            var_dump($data);
            $pb->add_penerima($data);
        }
        
        if(!is_null($id)){
            $pb->set_kd_pb($id);
            $this->view->d_ubah = $pb->get_penerima_by_id($pb);
        }
        
        $this->view->d_pb = $pb->get_penerima();
        $this->view->render('riwayat_tb/penerima_beasiswa');
        
    }
    
    public function updpenerima(){
        $pb = new Penerima($this->registry);
        
        $kd = $_POST['kd_pb'];
        $st = $_POST['st'];
        $bank = $_POST['bank'];
        $jur = $_POST['jur'];
        $status = $_POST['status'];
        $nama = $_POST['nama'];
        $nip = $_POST['nip'];
        $gol = $_POST['gol'];
        $unit_asal = $_POST['unit_asal'];
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $no_rek = $_POST['no_rek'];
        $jkel = $_POST['jk'];
        $tgl_lapor = $_POST['tgl_lap'];
        $skl = $_POST['skl'];
        $spmt = $_POST['spmt'];
        $skripsi = $_POST['skripsi'];

        $file = $_FILES['fupload'];
        $data = array(
            'KD_ST'=>$st,
            'KD_JUR'=>$jur,
            'KD_BANK'=>$bank,
            'KD_STATUS_TB'=>$status,
            'NIP_PB'=>$nip,
            'NAMA_PB'=>$nama,
            'JK_PB'=>$jkel,
            'GOLONGAN_PB'=>$gol,
            'UNIT_ASAL_PB'=>$unit_asal,
            'EMAIL_PB'=>$email,
            'TELP_PB'=>$telp,
            'ALAMAT_PB'=>$alamat,
            'NO_REKENING_PB'=>$no_rek,
            'FOTO_PB'=>$file['name'],
            'TANGGAL_LAPOR_PB'=>$tgl_lapor,
            'NOMOR_SKL_PB'=>$skl,
            'NO_SPMT_PB'=>$spmt,
            'JUDUL_SKRIPSI_PB'=>$skripsi
        );
        
        $pb->set_kd_pb($kd);
        $pb->update_penerima($data);
        header('location:'.URL.'penerima/penerima');
    }
    
    public function delpb($id){
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($id);
        $pb->delete_penerima();
        header('location:'.URL.'penerima/penerima');
    }
    public function __destruct() {
        parent::__destruct();
    }
}
?>
