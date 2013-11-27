<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class SurattugasController extends BaseController{
    
    public function __construct($registry) {
        parent::__construct($registry);
        $this->kd_user = Session::get('kd_user');
    }
    
    public function datast($id=0, $halaman=1,$batas=10){
        $st = new SuratTugas($this->registry);
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
            $upload->setDirTo('files/st/');
            $nama = array($nomor,$tgl_st);
            $upload->changeFileName($upload->getFileName(),$nama);
            $data = array(
                'KD_JUR'=>$jur,
                'KD_PEMB'=>$pemb,
                'KD_JENIS_ST'=>$jenis,
                'KD_ST_LAMA'=>$st_lama,
                'NO_ST'=>$nomor,
                'TGL_ST'=>  Tanggal::ubahFormatTanggal($tgl_st),
                'TGL_MUL_ST'=>  Tanggal::ubahFormatTanggal($tgl_mulai),
                'TGL_SEL_ST'=>  Tanggal::ubahFormatTanggal($tgl_selesai),
                'THN_MASUK'=>$th_masuk,
                'FILE_ST'=>$upload->getFileTo()
            );
            
            $st->add_st($data);
            $upload->uploadFile();
            $ref = " no ST ".$nomor;
            ClassLog::write_log('surat_tugas','rekam',$ref);
        }
        $aksi = array();
        if($id!=0){
            $st->set_kd_st($id);
            $this->view->d_ubah = $st->get_surat_tugas_by_id($st,$this->kd_user);
            $is_exist_file = ($this->view->d_ubah->get_file()!=NULL)?true:false;
            $file = array('file_exist'=>$is_exist_file);
            $aksi = array('aksi'=>'ubah');
        }else{
            $aksi = array('aksi'=>'rekam');
            $file = array('file_exist'=>false);
        }
         
        $univ = new Universitas($this->registry);
        $jur = new Jurusan($this->registry);
        $pemb = new PemberiBeasiswa();
        $this->view->d_pemb = $pemb->get_All();
        if(Session::get('role')==2) $this->view->d_st_lama = $st->get_surat_tugas($this->kd_user);
        $this->view->d_jst = $st->get_st_class();
        if(Session::get('role')==2) {
            $this->view->d_univ = $univ->get_univ($this->kd_user);
        }else{
            $this->view->d_univ = $univ->get_univ();
        }
        $this->view->d_jur = $jur->get_jurusan();
        $this->view->d_th_masuk = $st->get_list_th_masuk(true);
        $this->view->d_th_masuk_input = $st->get_list_th_masuk(false);
        if(Session::get('role')==2) {
            $this->view->d_st_all = $st->get_surat_tugas($this->kd_user);
        }else{
            $this->view->d_st_all = $st->get_surat_tugas();
        }
        $this->view->aksi = json_encode($aksi);
        $this->view->d_file_exist = json_encode($file);
        if($id!=0){
            $jur = $this->view->d_ubah->get_jur();
            $univ = $univ->get_univ_by_jur($jur);
            $this->view->univ = $univ->get_kode_in();
        }
        /**start paging**/
        $url = '';
        if($id==0){
            $url = 'surattugas/datast/0';
        }else{
            $url = 'surattugas/datast/'.$id;
        }
        $this->view->url = $url;
        $this->view->paging = new Paging($url, $batas, $halaman);
        $this->view->jmlData = count($this->view->d_st_all);
        $posisi = $this->view->paging->cari_posisi();
        if(Session::get('role')==2){
            $this->view->d_st = $st->get_surat_tugas_limit($posisi, $batas, $this->kd_user);
        }  else {
            $this->view->d_st = $st->get_surat_tugas_limit($posisi, $batas);
        }
        /**end paging**/
        $this->view->render('riwayat_tb/data_st');
    }
    
    public function updst(){
        if(Session::get('role')!=2){
            $this->datast();
        }
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
            'NO_ST'=>$nomor,
            'TGL_ST'=>  Tanggal::ubahFormatTanggal($tgl_st),
            'TGL_MUL_ST'=>  Tanggal::ubahFormatTanggal($tgl_mulai),
            'TGL_SEL_ST'=>  Tanggal::ubahFormatTanggal($tgl_selesai),
            'THN_MASUK'=>$th_masuk
        );
        if($_FILES['fupload']['name']!=''){
//            $upload = $this->registry->upload;
            $this->registry->upload->init('fupload');
            $this->registry->upload->setDirTo('files/st/');
            $nama = array($nomor,$tgl_st);
            $this->registry->upload->changeFileName($this->registry->upload->getFileName(),$nama);
            $data['FILE_ST']=$this->registry->upload->getFileTo();
            if(file_exists('files/st/'.$data['FILE_ST'])){
                unlink('files/st/'.$data['FILE_ST']);
            }
            $this->registry->upload->uploadFile();
            
            
        }
        $st->set_kd_st($kd_st);
        $st->update_st($data);
        $ref = " no ST ".$nomor;
        ClassLog::write_log('surat_tugas','ubah',$ref);
        header('location:'.URL.'surattugas/datast');
        
    }
    
    /*
     * hapus surat tugas
     */
    public function del_st($kd_st){
        if(Session::get('role')!=2){
            $this->datast();
        }
        $st = new SuratTugas($this->registry);
        $st->set_kd_st($kd_st);
        $st->get_surat_tugas_by_id($st);
        $no = $st->get_nomor();
        $file = 'files/'.$st->get_file();
        $st->del_st();
        if(file_exists($file)) unlink($file);
        $ref = " no ST ".$no;
        ClassLog::write_log('surat_tugas','hapus',$ref);
        header('location:'.URL.'surattugas/datast');
    }
    
    /*
     * menampilkan data surat tugas
     */
    public function get_data_st(){
        $st = new SuratTugas($this->registry);
        $param = $_POST['param'];
        $param = explode(",", $param);
        $univ = $param[0];
        $thn = $param[1];
        $kd_user = $param[2];
        $this->view->d_st=array();
        if($univ==0 AND $thn==0){
            $this->view->d_st = $st->get_surat_tugas($this->kd_user);
            if(Session::get('role')!=2) $this->view->d_st = $st->get_surat_tugas();
        }else{
            $this->view->d_st = $st->get_surat_tugas_by_univ_thn_masuk($univ, $thn, $kd_user);
            if(Session::get('role')!=2) $this->view->d_st = $st->get_surat_tugas_by_univ_thn_masuk($univ, $thn);
        }
        $this->view->load('riwayat_tb/tabel_st');
    }
    
    /*
     * cari berdasarkan nomor
     */
    public function cari_st(){
        $nomor = $_POST['param'];
        $st = new SuratTugas($this->registry);
        $d_st = $st->get_surat_tugas_by_nomor($nomor, $this->kd_user);
        if(Session::get('role')!=2) $d_st = $st->get_surat_tugas_by_nomor($nomor);
        $this->view->d_st = $d_st;
        $this->view->load('riwayat_tb/tabel_st');
    }
    
    /*
     * menampilkan kotak dialog tambah penerima dari data surat tugas
     */
    public function dialog_add_pb($id){
        $bank = new Bank($this->registry);
        $this->view->d_bank = $bank->get_bank();
        $this->view->id=$id;
        $this->view->load('riwayat_tb/dialog_pb');
    }
    
    /*
     * menampilkan halaman tambah penerima
     */
    public function addpb($id){
        $st = new SuratTugas($this->registry);
        $pb = new Penerima($this->registry);
        $univ = new Universitas($this->registry);
        $bank = new Bank($this->registry);
        $st->set_kd_st($id);
        $pb->set_st($id);
        $this->view->kd_st=$id;
        $this->view->d_bank = $bank->get_bank();
        $this->view->d_univ = $univ->get_univ();
        if(Session::get('role')==2){
            $this->view->d_st = $st->get_surat_tugas_by_id($st,$this->kd_user);
            $this->view->d_pb = $pb->get_penerima_by_st($pb,$this->kd_user);
        }else{
            $this->view->d_st = $st->get_surat_tugas_by_id($st);
            $this->view->d_pb = $pb->get_penerima_by_st($pb);
        }
        
        $this->view->d_th_masuk = $st->get_list_th_masuk();
//        var_dump($this->view->d_st);
        $this->view->render('riwayat_tb/pb_to_st');
    }
    
    /*
     * delete pb dari st
     */
    public function del_pb_from_st(){
        if(Session::get('role')!=2){
            $this->datast();
        }
        $d = $_POST['param'];
        $d = explode(",",$d);
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($d[1]);
        $pb->get_penerima_by_id($pb);
        $nama = $pb->get_nama();
        $nip = $pb->get_nip();
        $pb->delete_penerima();
        $ref = " pegawai ".$nama.":".$nip;
        ClassLog::write_log('penerima_beasiswa','hapus',$ref);
        header('location:'.URL.'surattugas/addpb/'.$d[0]);
        
    }
    
    /*
     * cek apakah pb telah terdaftar di data pb, atau belum terdaftar pada st manapun
     */
    public function cek_pb_on_st(){
        $nip = $_POST['nip'];
        $kd_st = $_POST['kd_st'];
        $return = 0;
        $pb = new Penerima($this->registry);
//        $pb->set_nip($nip);
//        $d_cek = $pb->cek_exist_pb();
        $d_cek = $pb->is_prn_beasiswa_strata($nip,$kd_st);
//        var_dump($d_cek);
//        if(((int) $d_cek['cek'])>0) {
        if($d_cek) $return=1;
        
        echo $return;
    }

    public function view_st($file='null'){
        $this->view->file = $file;
        $this->view->load('riwayat_tb/display_st');
    }
    
    public function get_method(){
        $method = get_class_methods($this);
        foreach ($method as $method){
            print_r("\$akses['pic']['".  get_class($this)."']['".$method."'];</br>");
        }
    }
    
    public function cek_exist_nomor(){
        $nomor = $_POST['nomor'];
//        $nomor = 'ST-1349/PB.1/2012';
        $nomor = Validasi::remove_space($nomor);
        $st = new SuratTugas($this->registry);
        $cek = $st->cek_exist_nomor($nomor);
        if($cek){
            echo 1;
        }else{
            echo 0;
        }
    }

}
?>
