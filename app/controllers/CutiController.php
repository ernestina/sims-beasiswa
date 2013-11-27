<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CutiController extends BaseController{
    
    public function __construct($registry) {
        parent::__construct($registry);
        $this->kd_user = Session::get('kd_user');
    }
    
    public function index(){
        
    }
    
    public function datasc($id=0, $halaman=1,$batas=10){
        $ct = new Cuti($this->registry);
        if(isset($_POST['sb_add'])){
            $noct = $_POST['no_sc'];
            $jsc = $_POST['jsc'];
            $tgl_sc = $_POST['tgl_sc'];
            $kd_pb = $_POST['kd_pb'];
//            $jur = $_POST['jur'];
            $sem_mul = $_POST['sem_mulai'];
            $thn_mul = $_POST['thn_mulai'];
            $sem_sel = $_POST['sem_sel'];
            $thn_sel = $_POST['thn_sel'];
            $bln_stop = $_POST['bln_stop'];
            $thn_stop = $_POST['thn_stop'];
            $bln_go = $_POST['bln_go'];
            $thn_go = $_POST['thn_go'];
            $data = $noct." ".$jsc." ".$tgl_sc." ".$kd_pb." ".$jur." ".$sem_mul." ".$sem_sel." ".$thn_mul." ".$thn_sel
                    ." ".$bln_stop." ".$bln_go." ".$thn_stop." ".$thn_go." ".$_FILES['fupload']['name'];
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
//                $pb->set_kd_pb($kd);
                $d_pb->set_status(4);
                $d_pb->update_penerima();
                $this->registry->upload->uploadFile();
                $ref = " no SC ".$noct;
                ClassLog::write_log('cuti','rekam',$ref);
                header('location:'.URL.'cuti/datasc');
            }else{
                $this->view->d_rekam = $ct;
            }
            
        }
        
        if($id!=0){
            $ct->set_kode_cuti($id);
            $this->view->d_ubah = $ct->get_cuti_by_id($ct,$this->kd_user);
//            var_dump($this->view->d_ubah);
            $pb = new Penerima($this->registry);
            $pb->set_kd_pb($ct->get_pb());
            $this->view->d_pb_ubah = $pb->get_penerima_by_id($pb,$this->kd_user);
            $is_exist_file = ($this->view->d_ubah->get_file()!=NULL && $this->view->d_ubah->get_file()!='')?true:false;
            $file = array('file_exist'=>$is_exist_file);
        }else{
            $file = array('file_exist'=>false);
        }
        $jsc = new JenisSuratCuti($this->registry);
        $univ = new Universitas($this->registry);
        $st = new SuratTugas($this->registry);
        $pb = new Penerima($this->registry);
        if(Session::get('role')==2){
            $this->view->d_pb = $pb->get_penerima($this->kd_user);
            $this->view->d_ct_all = $ct->get_cuti($this->kd_user);
            $this->view->d_univ = $univ->get_univ($this->kd_user);
        }else{
            $this->view->d_pb = $pb->get_penerima(0);
            $this->view->d_ct_all = $ct->get_cuti(0);
            $this->view->d_univ = $univ->get_univ();
        }
        $this->view->d_jsc = $jsc->get_jsc();
        $this->view->d_th_masuk = $st->get_list_th_masuk();
        $this->view->curr_year = date('Y');
        $this->view->d_file_exist = json_encode($file);
        /**start paging**/
        $url = '';
        if($id==0){
            $url = 'cuti/datasc/0';
        }else{
            $url = 'cuti/datasc/'.$id;
        }
        $this->view->url = $url;
        $this->view->paging = new Paging($url, $batas, $halaman);
        $this->view->jmlData = count($this->view->d_ct_all);
        $posisi = $this->view->paging->cari_posisi();
        if(Session::get('role')==2){
            $this->view->d_ct = $ct->get_cuti_limit($posisi, $batas, $this->kd_user);
        }else{
            $this->view->d_ct = $ct->get_cuti_limit($posisi, $batas, 0);
        }
        
        /**end paging**/
        $this->view->render('riwayat_tb/data_cuti');
    }
    
    public function del_sc($kd_cuti){
        if(Session::get('role')!=2){
            $this->datasc();
        }
        $ct = new Cuti($this->registry);
        $ct->set_kode_cuti($kd_cuti);
        $ct->get_cuti_by_id($ct, $this->kd_user);
        
        /*
         * update penerima
         */
        $pb = new Penerima($this->registry);
        $kd_pb_ct = $ct->get_pb();
        $pb->set_kd_pb($kd_pb_ct);
        $pb->get_penerima_by_id($pb);
        $status = $pb->cek_pb_konek_st_ct($pb, 'st', false, true);
        $pb->set_status($status);
        /*$kd_st = $pb->get_st();
        $st = new SuratTugas($this->registry);
        $is_child = $st->is_child($kd_st);
        if($is_child){
            $kd_parent = $st->get_st_lama();
            if($kd_parent!=''){
                $pb->set_status(3);
            }else{
                $pb->set_status(2);
            } 
        }else{
            $pb->set_status(1);
        }*/
        $pb->update_penerima();
        unset($pb);
        /*
         * end 
         */
        $no = $ct->get_no_surat_cuti();
        $file = $ct->get_file();
        $ct->del_ct();
        if(file_exists('files/cuti/'.$file)){
            unlink('files/cuti/'.$file);
        }
        $ref = " no SC ".$no;
        ClassLog::write_log('cuti','hapus',$ref);
        header('location:'.URL.'cuti/datasc');
    }
    
    public function updct(){
        if(Session::get('role')!=2){
            $this->datasc();
        }
        $kd_ct = $_POST['kd_sc'];
        $jsc = $_POST['jsc'];
        $kd_pb = $_POST['kd_pb'];
        $no_sc = $_POST['no_sc'];
        $tgl_sc = Tanggal::ubahFormatTanggal($_POST['tgl_sc']);
        $prd_mul = $_POST['sem_mulai']." ".$_POST['thn_mulai'];
        $prd_sel = $_POST['sem_sel']." ".$_POST['thn_sel'];
        $perk_stop = $_POST['bln_stop']." ".$_POST['thn_stop'];
        $perk_go = $_POST['bln_go']." ".$_POST['thn_go'];
        $file = $_FILES['fupload']['name'];
        
        $ct = new Cuti($this->registry);
        $ct->set_kode_cuti($kd_ct);
//        echo $kd_ct."-".$jsc."-".$kd_pb."-".$no_sc."-".$tgl_sc."-".$prd_mul."-".$prd_sel."-".$perk_stop."-".$perk_go."-".$file;
        /*
         * cek eksistensi file
         */
//        var_dump($_FILES['fupload']);
        $d_ct = $ct->get_cuti_by_id($ct,$this->kd_user);
        /*
         * sementara dulu
         * untuk update status tb, sambil nunggu fungsi yg benar :(
         */
        $pb = new Penerima($this->registry);
        $kd_pb_ct = $ct->get_pb();
        $pb->set_kd_pb($kd_pb_ct);
        $pb->get_penerima_by_id($pb);
        $status = $pb->cek_pb_konek_st_ct($pb, 'st', false, true);
        $pb->set_status($status);
//        $kd_st = $pb->get_st();
//        $st = new SuratTugas($this->registry);
//        $is_child = $st->is_child($kd_st);
//        if($is_child){
//            $kd_parent = $st->get_st_lama();
//            if($kd_parent!=''){
//                $pb->set_status(3);
//            }else{
//                $pb->set_status(2);
//            } 
//        }else{
//            $pb->set_status(1);
//        }
        $pb->update_penerima();
        unset($pb);
//        unlink($pb);
        /*
         * end update status
         */
        
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $d_pb = $pb->get_penerima_by_id($pb);
        if($file!=''){
            $this->registry->upload->init('fupload');
            $this->registry->upload->setDirTo('files/cuti/');
            $tmp_prd = explode(" ",$prd_mul);
            $prd_mulai = $tmp_prd[count($tmp_prd)-1];
            $cname = array('CUTI',$d_pb->get_nip(),$prd_mulai);
            $this->registry->upload->changeFileName($this->registry->upload->getFileName(),$cname);
            $file = $this->registry->upload->getFileTo();
            if(file_exists('files/cuti/'.$file)){
                unlink('files/cuti/'.$file);
            }
            $this->registry->upload->uploadFile();
        }else{
//            echo $kd_ct."</br>";
            $file = $d_ct->get_file();
            if($kd_pb!=$kd_pb_ct){
                $tmp = explode("_",$file);
                $file_baru = $tmp[0]."_".$pb->get_nip()."_".$tmp[2];
                rename("files/cuti/".$file,"files/cuti/".$file_baru);
                $file=$file_baru;
            }else{
                $file = $d_ct->get_file();
            }
//            echo $file;
        }
        /*
         * set cuti
         */
        
        $ct->set_jenis_cuti($jsc);
        $ct->set_pb($kd_pb);
        $ct->set_no_surat_cuti($no_sc);
        $ct->set_tgl_surat_cuti($tgl_sc);
        $ct->set_prd_mulai($prd_mul);
        $ct->set_prd_selesai($prd_sel);
        $ct->set_perk_stop($perk_stop);
        $ct->set_perk_go($perk_go);
        $ct->set_file($file);
        if($ct->update_cuti()){
            $pb->set_status(4);
            $pb->update_penerima();
            $ref = " no SC ".$no_sc;
            ClassLog::write_log('cuti','ubah',$ref);
            header('location:'.URL.'cuti/datasc');
        }else{
            $this->view->d_ubah = $ct;
            $this->view->render('riwayat_tb/data_cuti');
        }
    }


    public function dialog_add_pb(){
        $pb = new Penerima($this->registry);
        $this->view->d_pb = $pb->get_penerima();
        $this->view->load('riwayat_tb/dialog_add_pb_sc');
    }
    
    public function cekfile(){
        $kd_sc = $_POST['kd_ct'];
        $ct = new Cuti($this->registry);
        $ct->set_kode_cuti($kd_sc);
        $d_ct = $ct->get_cuti_by_id($ct);
        if($d_ct->get_file()!='' && file_exists('files/cuti/'.$d_ct->get_file())){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    public function get_data_sc(){
        $sc = new Cuti($this->registry);
        $param = $_POST['param'];
        $param = explode(",", $param);
        $univ = $param[0];
        $thn_masuk = $param[1];
        $this->view->d_ct=array();
        if($univ==0 AND $thn_masuk==0){
            $this->view->d_ct = $sc->get_cuti($this->kd_user);
            if(Session::get('role')!=2) $this->view->d_ct = $sc->get_cuti(0);
        }else{
            $this->view->d_ct = $sc->get_cuti_by_univ_thn_masuk($univ, $thn_masuk,$this->kd_user);
            if(Session::get('role')!=2) $this->view->d_ct = $sc->get_cuti_by_univ_thn_masuk($univ, $thn_masuk);
        }
        $this->view->load('riwayat_tb/tabel_sc');
    }
    
    public function get_sc_by_name(){
        $sc = new Cuti($this->registry);
        $pb_name = $_POST['param'];
        $this->view->d_ct=$sc->get_cuti_by_pb_name($pb_name,$this->kd_user);
        if(Session::get('role')!=2) $this->view->d_ct=$sc->get_cuti_by_pb_name($pb_name);
        
        $this->view->load('riwayat_tb/tabel_sc');
    }


    public function get_method(){
        $method = get_class_methods($this);
        foreach ($method as $method){
            print_r("\$akses['pic']['".  get_class($this)."']['".$method."'];</br>");
        }
    }
    
    public function cek_exist_nomor(){
        $nomor = $_POST['nomor'];
        $nomor = Validasi::remove_space($nomor);
        
        $sc = new Cuti($this->registry);
        $cek = $sc->cek_exist_nomor($nomor);
        if($cek){
            echo 1;
        }else{
            echo 0;
        }
    }
    
    public function view_sc($file='null'){
        $this->view->file = $file;
        $this->view->load('riwayat_tb/display_sc');
    }
    
    public function __destruct() {
        parent::__destruct();
    }
}
?>
