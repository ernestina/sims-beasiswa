<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class NotifikasiController extends BaseController{
    
    public function __construct($registry) {
        parent::__construct($registry);
    }
    
    public function index($notif=1){
        if($notif==1) $this->notif_all();
        if($notif==2) $this->notif_pic();
    }
    
    public function notif_all(){
        $d_notif = $this->get_notifikasi();
        
        $this->view->d_notif = $d_notif;
        $this->view->load('notifikasi');
    }
    
    public function notif_pic(){
        $pic = new User($this->registry);
        $data_pic = $pic->get_user(true);
        $d_notif = $this->get_notifikasi_pic_all();
        $data_arr = array();
        $i=0;
        foreach ($data_pic as $val){
            $temp = array();
            $temp['pic'] = array('kode'=>$val->get_id(),"nama"=>$val->get_nmUser(),"foto"=>$val->get_foto());
            foreach($d_notif as $v){
                $kode = $v['pic']['kode'];
                if($kode == $val->get_id()){
                    if(isset($v['jadup'])){
                        $temp['jadup'] = $v['jadup'];
                    }
                    
                    if(isset($v['buku'])){
                        $temp['buku'] = $v['buku'];
                    }
                    
                    if(isset($v['kontrak'])){
                        $temp['kontrak'] = $v['kontrak'];
                    }
                    
                    if(isset($v['skripsi'])){
                        $temp['skripsi'] = $v['skripsi'];
                    }
                    
                    if(isset($v['skripsi'])){
                        $temp['skripsi'] = $v['skripsi'];
                    }
                }
            }
            $data_arr[] = $temp;
            $i++;
        }
        
//        echo json_encode($data_arr);
        $this->view->d_notif = json_encode($data_arr);
        $this->view->load('informasi/notifikasi_pic');
//        $this->view->d_notif = $this->get_notifikasi();
//        $this->view->load('notifikasi');
    }


    public function display_notif(){
        $this->view->d_notif = $this->get_notifikasi_pic_all();
        $this->view->load('informasi/notifikasi_pic');
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
    
    private function get_notifikasi_pic_all(){
        $notif = new Notifikasi($this->registry);
        $data_notif = $notif->get_notifikasi();
        $d_notif = array();
        foreach ($data_notif as $data){
            $pic = $data->get_pic();
            $temp = array();
            $kode_pic = $pic['kode'];
            $jenis = $data->get_jenis_notif();
            $status = $data->get_status_notif();
            if(array_key_exists($kode_pic, $d_notif)){
                $temp = $d_notif[$kode_pic];
                if(array_key_exists($jenis, $temp)){
                    if(array_key_exists($status, $temp[$jenis])){
                        $temp[$jenis][$status]++;
                    }else{
                        $temp[$jenis][$status] = 1;
                    }
                    
                }else{
                    $temp[$jenis][$status] = 1;
                }
                $d_notif[$kode_pic]=$temp;
            }else{
                $d_notif[$kode_pic]['pic'] = $pic;
                $d_notif[$kode_pic][$jenis][$status] = 1;
            }
            
        }
        
        return $d_notif;
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
