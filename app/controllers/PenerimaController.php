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
    
    public function datapb(){
        $pb = new Penerima($this->registry);
        $this->view->d_pb = $pb->get_penerima();
        $this->view->render('riwayat_tb/data_pb');
    }
    
    /*
     * menampilkan form rekam, ubah, daftar data penerima tb
     */
    public function penerima($id=null){
        $pb = new Penerima($this->registry);
        
        $upload = $this->registry->upload;
        $upload->init('fupload'); //awali dengan fungsi ini
        $upload->setDirTo('files/'); //set direktori tujuan
        $ubahNama = array('KAKA','KIKI','KEKE'); //pola nama baru dalam array
        $upload->changeFileName($upload->getFileName(), $ubahNama); //ubah nama
        
        if(isset($_POST['sb_add'])){
            $st = $_POST['st'];
            $bank = $_POST['bank'];
            $nip = $_POST['nip'];
            $telp = $_POST['telp'];
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $no_rek = $_POST['no_rek'];
            
            $data = array(
                'KD_ST'=>$st,
                'KD_BANK'=>$bank,
                'NIP_PB'=>$nip,
                'EMAIL_PB'=>$email,
                'TELP_PB'=>$telp,
                'ALMT_PB'=>$alamat,
                'NO_REKENING_PB'=>$no_rek,
                'FOTO_PB'=>$upload->getFileTo(),
            );
            
            if(!Validasi::validate_nip($nip)) echo 'nip salah....!';
            if($pb->add_penerima($data)){
                /*
                 * upload file
                 */
                $upload->uploadFile();
            }
            
            
        }
        
        if(!is_null($id)){
            $pb->set_kd_pb($id);
            $this->view->d_ubah = $pb->get_penerima_by_id($pb);
        }
        $st = new SuratTugas($this->registry);
        $this->view->d_st = $st->get_surat_tugas();
        $this->view->d_pb = $pb->get_penerima();
        $this->view->render('riwayat_tb/penerima_beasiswa');
        
    }
    
    public function pb_by_st(){
        $kd_st = $_POST['param'];
        $pb = new Penerima($this->registry);
        $pb->set_st($kd_st);
        $this->view->d_pb = $pb->get_penerima_by_st($pb);
        $this->view->load('riwayat_tb/tabel_pb');
        
    }


    /*
     * tambah penerima pada surat tugas
     */
    public function add_from_dialog_to_st(){
        $pb = new Penerima($this->registry);
        $st = new SuratTugas($this->registry);
        $kd = $_POST['st'];
        $bank = $_POST['bank'];
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $telp = $_POST['telp'];
        $email = $_POST['email'];
        $no_rek = $_POST['no_rek'];
        $jkel = $_POST['jkel'];
        $gol = $_POST['gol'];
        $unit = $_POST['unit'];
        
        /*
         * mendapatkan kode jurusan 
         */
        $st->set_kd_st($kd);
        $st->get_surat_tugas_by_id($st);
        $jur = $st->get_jur();
        $data = array(
            'KD_ST'=>$kd,
            'KD_BANK'=>$bank,
            'NIP_PB'=>$nip,
            'NM_PB'=>$nama,
            'TELP_PB'=>$telp,
            'EMAIL_PB'=>$email,
            'NO_REKENING_PB'=>$no_rek,
            'JK_PB'=>$jkel,
            'KD_GOL'=>$gol,
            'UNIT_ASAL_PB'=>$unit,
            'KD_JUR'=>$jur,
            'KD_STS_TB'=>1
        );
        
        $pb->add_penerima($data);
    }
    
    /*
     * update penerima tb
     */
    public function updpenerima(){
        $pb = new Penerima($this->registry);
        
        $kd = $_POST['kd_pb'];
        $st = $_POST['st'];
        $bank = $_POST['bank'];
        /*$jur = $_POST['jur'];
        $status = $_POST['status'];
        $nama = $_POST['nama'];*/
        $nip = $_POST['nip'];
        /*$gol = $_POST['gol'];
        $unit_asal = $_POST['unit_asal'];*/
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $no_rek = $_POST['no_rek'];
        /*$jkel = $_POST['jk'];
        $tgl_lapor = $_POST['tgl_lap'];
        $skl = $_POST['skl'];
        $spmt = $_POST['spmt'];
        $skripsi = $_POST['skripsi'];*/
        
        $data = array(
            'KD_ST'=>$st,
            /*'KD_JUR'=>$jur,*/
            'KD_BANK'=>$bank,
            /*'KD_STATUS_TB'=>$status,*/
            'NIP_PB'=>$nip,
            /*'NAMA_PB'=>$nama,
            'JK_PB'=>$jkel,
            'GOLONGAN_PB'=>$gol,
            'UNIT_ASAL_PB'=>$unit_asal,*/
            'EMAIL_PB'=>$email,
            'TELP_PB'=>$telp,
            'ALMT_PB'=>$alamat,
            'NO_REKENING_PB'=>$no_rek,
            /*'TANGGAL_LAPOR_PB'=>$tgl_lapor,
            'NOMOR_SKL_PB'=>$skl,
            'NO_SPMT_PB'=>$spmt,
            'JUDUL_SKRIPSI_PB'=>$skripsi*/
        );
        
        if(!is_null($_FILES['fupload'])){
            $upload = $this->registry->upload;
            $upload->init('fupload'); //awali dengan fungsi ini
            $upload->setDirTo('files/'); //set direktori tujuan
            $ubahNama = array('KAKA','KIKI','KEKE'); //pola nama baru dalam array
            $upload->changeFileName($upload->getFileName(), $ubahNama); //ubah nama
            $data['FOTO_PB'] = $upload->getFileTo();
            $upload->uploadFile();
        }
        
        
        $pb->set_kd_pb($kd);
        $pb->update_penerima($data);
        header('location:'.URL.'penerima/penerima');
    }
    
    /*
     * hapus penerima tb
     */
    public function delpb($id){
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($id);
        $pb->get_penerima_by_id($pb);
        $file = 'files/'.$pb->get_foto();
        $pb->delete_penerima();
        if(file_exists($file)) unlink($file);
        header('location:'.URL.'penerima/penerima');
    }
    
    public function get_nama_peg(){
        $nip = $_POST['param'];
        $peg = new Pegawai($this->registry);
        $peg->set_nip($nip);
        $data = $peg->get_peg_by_nip($peg);
        echo $data->get_nama();
        
    }


    public function __destruct() {
        parent::__destruct();
    }
}
?>
