<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class SurattugasController extends BaseController{
    
    public function __construct($registry) {
        parent::__construct($registry);
    }
    
    public function datast($id=null){
        $st = new SuratTugas($this->registry);
        $univ = new Universitas($this->registry);
        $jur = new Jurusan($this->registry);
        $pemb = new Pemberi();
        if(isset($_POST['sb_add'])){
            $jur = $_POST['jur'];
            $jenis = $_POST['jns_st'];
            $st_lama = $_POST['st_lama'];
            $nomor = $_POST['no_st'];
            $tgl_st = $_POST['tgl_st'];
            $tgl_mulai = $_POST['tgl_mulai'];
            $tgl_selesai = $_POST['tgl_selesai'];
            $th_masuk = $_POST['th_masuk'];
            $pemb = $_POST['pemb'];
            
            $upload = $this->registry->upload;
            $upload->init('fupload');
            $upload->setDirTo('files/');
            $nama = array($nomor,$tgl_st);
            $upload->changeFileName($upload->getFileName(),$nama);
            $data = array(
                'KD_JUR'=>$jur,
                'KD_PEMB'=>$pemb,
                'KD_JENIS_ST'=>$jenis,
                'KD_ST_LAMA'=>$st_lama,
                'NOMOR_ST'=>$nomor,
                'TANGGAL_ST'=>  Tanggal::ubahFormatTanggal($tgl_st),
                'TANGGAL_MULAI_ST'=>  Tanggal::ubahFormatTanggal($tgl_mulai),
                'TANGGAL_SELESAI_ST'=>  Tanggal::ubahFormatTanggal($tgl_selesai),
                'TAHUN_MASUK'=>$th_masuk,
                'FILE_ST'=>$upload->getFileTo()
            );
            
            $st->add_st($data);
            $upload->uploadFile();
        }
        
        if(!is_null($id)){
            $st->set_kd_st($id);
            $this->view->d_ubah = $st->get_surat_tugas_by_id($st);
        }
        
        $this->view->d_pemb = $pemb->get_All();
        $this->view->d_st_lama = $st->get_surat_tugas();
        $this->view->d_jst = $st->get_st_class();
        $this->view->d_univ = $univ->get_univ();
        $this->view->d_jur = $jur->get_jurusan();
        $this->view->d_th_masuk = $st->get_list_th_masuk();
        $this->view->d_st = $st->get_surat_tugas();
        
        $this->view->render('riwayat_tb/data_st');
    }
    
    public function updst(){
        $st = new SuratTugas($this->registry);
        
        $kd_st = $_POST['kd_st'];
        $jur = $_POST['jur'];
        $jenis = $_POST['jns_st'];
        $st_lama = $_POST['st_lama'];
        $nomor = $_POST['no_st'];
        $tgl_st = $_POST['tgl_st'];
        $tgl_mulai = $_POST['tgl_mulai'];
        $tgl_selesai = $_POST['tgl_selesai'];
        $th_masuk = $_POST['th_masuk'];
        $pemb = $_POST['pemb'];
        
        $data = array(
            'KD_JUR'=>$jur,
            'KD_PEMB'=>$pemb,
            'KD_JENIS_ST'=>$jenis,
            'KD_ST_LAMA'=>$st_lama,
            'NOMOR_ST'=>$nomor,
            'TANGGAL_ST'=>  Tanggal::ubahFormatTanggal($tgl_st),
            'TANGGAL_MULAI_ST'=>  Tanggal::ubahFormatTanggal($tgl_mulai),
            'TANGGAL_SELESAI_ST'=>  Tanggal::ubahFormatTanggal($tgl_selesai),
            'TAHUN_MASUK'=>$th_masuk
        );
        
        if(!is_null($_FILES['fupload'])){
            $upload = $this->registry->upload;
            $upload->init('fupload');
            $upload->setDirTo('files/');
            $nama = array($nomor,$tgl_st);
            $upload->changeFileName($upload->getFileName(),$nama);
//            $upload->uploadFile();
            $data['FILE_ST']=$upload->getFileTo();
            
        }
        
        $st->set_kd_st($kd_st);
        $st->update_st($data);
        header('location:'.URL.'surattugas/datast');
        
    }

    public function del_st($kd_st){
        $st = new SuratTugas($this->registry);
        $st->set_kd_st($kd_st);
        $st->get_surat_tugas_by_id($st);
        $file = 'files/'.$st->get_file();
        $st->del_st();
        if(file_exists($file)) unlink($file);
        header('location:'.URL.'surattugas/datast');
    }
    
    public function get_data_st(){
        $st = new SuratTugas($this->registry);
        $param = $_POST['param'];
        $param = explode(",", $param);
        $univ = $param[0];
        $thn = $param[1];
        $this->view->d_st=array();
        if($univ==0 AND $thn==0){
            $this->view->d_st = $st->get_surat_tugas();
        }else{
            $this->view->d_st = $st->get_surat_tugas_by_univ_thn_masuk($univ, $thn);
        }
        $this->view->load('riwayat_tb/tabel_st');
    }
}
?>
