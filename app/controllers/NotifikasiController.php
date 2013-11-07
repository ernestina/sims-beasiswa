<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class NotifikasiController extends BaseController{
    
    public function __construct($registry) {
        parent::__construct($registry);
    }
    
    public function index(){
        $this->view->d_notif = $this->get_notifikasi();
        $this->view->load('notifikasi');
    }
    
    public function display_notif(){
        $this->view->d_notif = $this->get_notifikasi();
        $this->view->load('informasi/notifikasi');
    }
    
    private function get_notifikasi(){
        $notif = new Notifikasi($this->registry);
        $data_notif = $notif->get_notifikasi();
        
        $d_notif = array();
        $i = 0;
        foreach ($data_notif as $data){
            $pic = $data->get_pic();
            $nama_pic = $pic['nama'];
            $kode_pic = $pic['kode'];
            $foto_pic = $pic['foto'];
            $jatuh_tempo = explode('-',$data->get_jatuh_tempo());
            $count = count($jatuh_tempo)>1;
            $bln = $count?$jatuh_tempo[1]:'';
            $thn = $jatuh_tempo[0];
            $bulan = Tanggal::bulan_indo($bln);
            if($data->get_jenis_notif()=='buku'){
                if($jatuh_tempo[1]==1){
                    $bulan = 'ganjil';
                }else{
                    $bulan = 'genap';
                }
            }
            $temp = array(
                'jatuh_tempo'=>$data->get_jatuh_tempo(),
                'tgl'=>$jatuh_tempo[2]==null?1:$jatuh_tempo[2],
                'bulan'=>  $bulan,
                'tahun'=>  $thn,
                'nama_pic'=>$nama_pic,
                'kode_pic'=>$kode_pic,
                'foto_pic'=>$foto_pic,
                'tahun_masuk'=>$data->get_tahun_masuk(),
                'jurusan'=>$data->get_jurusan(),
                'univ'=>$data->get_univ(),
                'jenis'=>$data->get_jenis_notif(),
                'status'=>$data->get_status_notif()
            );
            $d_notif[] = $temp;
            $i++;
        }
//        $tmp_data = $notif->create_data_sort($data_notif);
//        ksort($tmp_data);
//        foreach($tmp_data as $key=>$value){
//            echo $key." tgl.".$value->get_jatuh_tempo()."</br>";
//        }
        
        return json_encode($d_notif);
    }
    
    private function get_notifikasi_pic($kd_user){
        $notif = new Notifikasi($this->registry);
        $data = $notif->get_notifikasi();
        
        $d_notif = array();
        foreach ($data as $data){
            $pic = $data->get_pic();
            $nama_pic = $pic['nama'];
            $kode_pic = $pic['kode'];
            $foto_pic = $pic['foto'];
            $jatuh_tempo = explode('-',$data->get_jatuh_tempo());
            $count = count($jatuh_tempo)>1;
            $bln = $count?$jatuh_tempo[1]:'';
            if($data->get_jenis_notif()=='buku'){
                if($bln==1){
                    $bln=9;
                }else{
                    $bln=3;
                }
            }
            $thn = $jatuh_tempo[0];
            $temp = array(
                'jatuh_tempo'=>$data->get_jatuh_tempo(),
                'bulan'=>  Tanggal::bulan_indo($bln),
                'tahun'=>  $thn,
                'nama_pic'=>$nama_pic,
                'kode_pic'=>$kode_pic,
                'foto_pic'=>$foto_pic,
                'tahun_masuk'=>$data->get_tahun_masuk(),
                'jurusan'=>$data->get_jurusan(),
                'univ'=>$data->get_univ(),
                'jenis'=>$data->get_jenis_notif(),
                'status'=>$data->get_status_notif()
            );
            $is_notif_for_user = $kode_pic==$kd_user;
            if($is_notif_for_user) {
                $d_notif[] = $temp;
            }
        }
        
//        return json_encode($d_notif);
        return $d_notif;
    }
    
    public function display_notif_pic(){
        $kd_user = $_POST['param'];
        $this->view->is_pic = Session::get('role')==2;
        $this->view->d_notif = $this->get_notifikasi_pic($kd_user);
        $this->view->load('informasi/list_notif');
    }
    
    public function count_notif(){
        $kd_user = $_POST['param'];
        $d_notif = $this->get_notifikasi_pic($kd_user);
        $jml = 0;
        foreach ($d_notif as $data){
            $jml++;
        }
//        $return = array('jml_notif'=>$jml);
//        return json_encode($return);
        echo $jml;
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
}
?>
