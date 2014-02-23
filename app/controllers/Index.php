<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Index extends BaseController{
    
    public function __construct($registry) {
        parent::__construct($registry);
        $this->kd_user = Session::get('kd_user');
    }
    
    public function index(){
        $user = new User($this->registry);
        $d_user = $user->getUser_id($this->kd_user);
        $univ = Session::get('univ');
        $d_univ = array();
        foreach($univ as $univ){
            $temp = array();
            $pb = new Penerima($this->registry);
            $cuniv = new Universitas($this->registry);
            $univDao = new UniversitasDao();
            $univDao->set_kode_in($univ);
            $cuniv = $cuniv->get_univ_by_id($univDao);
            $temp[] = $cuniv->get_nama();
            $temp[] = $pb->get_jumlah_pegawai('universitas', $univ);
            $d_univ[] = $temp;
        }
        $this->view->is_pic = Session::get('role')==2 || Session::get('role')==3 || Session::get('role')==4 || Session::get('role')==5 || Session::get('role')==6;
        $this->view->d_univ = $d_univ;
        $this->view->d_user = $d_user;
        $this->view->d_notif = $this->get_notifikasi();
        $this->view->count_notif = count($this->view->d_notif);
//        print_r($this->view->d_notif);
        $this->view->render('index');
    }
    
    private function get_notifikasi(){
        $notif = new Notifikasi($this->registry);
        $data = $notif->get_notifikasi();
//        print_r($data);
//        print_r($data);
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
                'status'=>$data->get_status_notif(),
                'link'=>$data->get_kode_link()
            );
            $is_notif_for_user = $kode_pic==$this->kd_user;
            if($is_notif_for_user) {
                $d_notif[] = $temp;
            }else{
                $id = Session::get('role');
                $jenis = $temp['jenis'];
                if($id==3){
                    if($jenis=='kontrak') $d_notif[] = $temp;
                }
                if($id==4){
                    if($jenis=='kontrak') $d_notif[] = $temp;
                    if($jenis=='jadup') $d_notif[] = $temp;
                    if($jenis=='buku') $d_notif[] = $temp;
                    if($jenis=='skripsi') $d_notif[] = $temp;
                }
                if($id==5){
                    if($jenis=='lulus') $d_notif[] = $temp;
                }
                if($id==6){
                    $d_notif[] = $temp;
                }
            }
        }
        
//        return json_encode($d_notif);
        return $d_notif;
    }
}
?>
