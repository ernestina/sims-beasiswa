<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminController extends BaseController{
    
    public $registry;
    
    public function __construct($registry) {
        parent::__construct($registry);
        $this->registry = $registry;
    }
    
    public function index(){
        echo "method tidak ada";
    }
    
    /*
     * tambah referensi universitas
     */
    public function addUniversitas($id=null){
        $univ = new Universitas($this->registry);
        if(isset($_POST['add_univ'])){
            $kode = $_POST['kode'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $lokasi = $_POST['lokasi'];
            $pic = $_POST['pic'];
            
            $data = array(
                'KD_PIC'=>$pic,
                'KODE_UNIV'=>$kode,
                'NAMA_UNIV'=>$nama,
                'ALAMAT_UNIV'=>$alamat,
                'TELP_UNIV'=>$telepon,
                'LOKASI_UNIV'=>$lokasi
            );
            $univ->add_univ($data);
            
        }
        
        if(!is_null($id)){
            $univ->set_kode_in($id);
            $this->view->d_ubah = $univ->get_univ_by_id($univ);
        }
        
        $this->view->data = $univ->get_univ();
//        var_dump($this->view->d_ubah);
        $this->view->render('admin/universitas');
    }
    
    /*
     * tambah referensi fakultas
     */
    public function addFakultas(){
        if(isset($_POST['add_fak'])){
            $univ = $_POST['universitas'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            
            $data = $univ.'</br>'.$nama.'</br>'.$alamat.'</br>'.$telepon;
            
            echo $data;
        }
        
        
        
        $this->view->load('admin/fakultas');
    }
    
    /*
     * tambah referensi jurusan
     */
    public function addJurusan(){
        if(isset($_POST['add_jur'])){
            $fak = $_POST['fakultas'];
            $strata = $_POST['strata'];
            $PIC = $_POST['PIC'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $pic_jur = $_POST['pic_jur'];
            $telp_pic_jur = $_POST['telp_pic_jur'];
            
            $data = $fak.'</br>'.$strata.'</br>'.$PIC.'</br>'.$nama.'</br>'.$alamat.'</br>'.$telepon.'</br>'.$pic_jur.'</br>'.$telp_pic_jur;
            
            echo $data;
        }
        
        $this->view->load('admin/jurusan');
    }
    
    /*
     * tambah referensi strata
     */
    public function addStrata(){
        if(isset($_POST['add_strata'])){
            $kode = $_POST['kode'];
            $nama = $_POST['nama'];
            
            $data = $kode.'</br>'.$nama;
            
            echo $data;
        }
        
        $this->view->load('admin/strata');
    }
    
    /*
     * tambah referensi pemberi beasiswa
     */
    public function addPemberi(){
        if(isset($_POST['add_pemberi'])){
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $pic = $_POST['pic'];
            $telp_pic = $_POST['telp_pic'];
            
            $data = $nama.'</br>'.$alamat.'</br>'.$telepon.'</br>'.$pic.'</br>'.$telp_pic;
            
            echo $data;
        }
        
        $this->view->load('admin/pemberi');
    }
    
    /*
     * tambah referensi jenis surat tugas
     */
    public function addST(){
        if(isset($_POST['add_st'])){
            $nama = $_POST['nama'];
            $keterangan = $_POST['keterangan'];
            
            $data = $keterangan.'</br>'.$nama;
            
            echo $data;
        }
        
        $this->view->load('admin/surat_tugas');
    }
    
    /*
     * tambah referensi jenis cuti
     */
    public function addCuti(){
        if(isset($_POST['add_cuti'])){
            $nama = $_POST['nama'];
            $keterangan = $_POST['keterangan'];
            
            $data = $keterangan.'</br>'.$nama;
            
            echo $data;
        }
        
        $this->view->load('admin/cuti');
    }
    
    /*
     * tambah referensi bank
     */
    public function addBank(){
        if(isset($_POST['add_bank'])){
            $nama = $_POST['nama'];
            $keterangan = $_POST['keterangan'];
            
            $data = $keterangan.'</br>'.$nama;
            
            echo $data;
        }
        
        $this->view->load('admin/bank');
    }
    
    /*
     * tambah referensi PIC
     */
    public function addPIC(){
        if(isset($_POST['add_pic'])){
            $nama = $_POST['nama'];
            $keterangan = $_POST['keterangan'];
            
            $data = $keterangan.'</br>'.$nama;
            
            echo $data;
        }
        
        $this->view->load('admin/pic');
    }
    
    /*
     * ubah referensi universitas
     * @param id_univ
     */
    public function updUniversitas($id){
        
        if(!is_null($id)){
            $univ = new Universitas();
            $data = $univ->get($id);
            
        }else{
            throw new Exception;
            return;
        }
        $this->view->load('admin/universitas');
    }
    
    /*
     * ubah referensi fakultas
     * @param id_fakultas
     */
    public function updFakultas($id){
        
        if(!is_null($id)){
            $fak = new Fakultas();
            $data = $fak->get($id);
            
        }else{
            throw new Exception;
            return;
        }
        $this->view->load('admin/fakultas');
    }
    
    /*
     * ubah referensi jurusan
     * @param id_jurusan
     */
    public function updJurusan($id){
        
        if(!is_null($id)){
            $jurusan = new Jurusan();
            $data = $jurusan->get($id);
            
        }else{
            throw new Exception;
            return;
        }
        $this->view->load('admin/jurusan');
    }
    
    /*
     * ubah referensi strata
     * @param id_strata
     */
    public function updStrata($id){
        if(!is_null($id)){
            $strata = new Strata();
            $data = $strata->get($id);
            
        }else{
            throw new Exception;
            return;
        }
        $this->view->load('admin/strata');
    }
    
    /*
     * ubah referensi jenis surat tugas
     * @param id_st
     */
    public function updST($id){
        if(!is_null($id)){
            $st = new SuratTugas();
            $data = $st->get($id);
            
        }else{
            throw new Exception;
            return;
        }
        $this->view->load('admin/surat_tugas');
    }
    
    /*
     * ubah referensi jenis cuti
     * @param id_cuti
     */
    public function updCuti($id){
        if(!is_null($id)){
            $cuti = new Cuti();
            $data = $cuti->get($id);
            
        }else{
            throw new Exception;
            return;
        }
        $this->view->load('admin/cuti');
    }
    
    /*
     * ubah referensi pemberi beasiswa
     * @param id_pemberi_beasiswa
     */
    public function updPemberi($id){
        if(!is_null($id)){
            $donor = new Pemberi();
            $data = $donor->get($id);
            
        }else{
            throw new Exception;
            return;
        }
        $this->view->load('admin/pemberi');
    }
    
    /*
     * ubah referensi bank
     * @param id_bank
     */
    public function updBank($id){
        if(!is_null($id)){
            $bank = new Bank();
            $data = $bank->get($id);
            
        }else{
            throw new Exception;
            return;
        }
        $this->view->load('admin/bank');
    }
    
    /*
     * ubah referensi PIC
     * @param id_pic
     */
    public function updPIC($id){
        if(!is_null($id)){
            $pic = new PIC();
            $data = $pic->get($id);
            
        }else{
            throw new Exception;
            return;
        }
        $this->view->load('admin/pic');
    }
    
    /*
     * hapus referensi universitas
     * @param id_univ
     */
    public function delUniversitas($id){
        $univ = new Universitas($this->registry);
        if(is_null($id)){
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
        $univ->set_kode_in($id);
        $univ->delete_univ();
        $this->addUniversitas(); //refresh ke halaman utama
    }
    
    /*
     * hapus referensi fakultas
     * @param id_fakultas
     */
    public function delFakultas($id){
        if(is_null($id)){
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
    }
    
    /*
     * hapus referensi jurusan
     * @param id_jurusan
     */
    public function delJurusan($id) {
        if(is_null($id)){
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
    }
    
    /*
     * hapus referensi cuti
     * @param id_cuti
     */
    public function delCuti($id){
        if(is_null($id)){
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
    }
    
    /*
     * hapus referensi surat tugas
     * @param id_st
     */
    public function delST($id){
        if(is_null($id)){
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
    }
    
    /*
     * hapus referensi strata
     * @param id_strata
     */
    public function delStrata($id){
        if(is_null($id)){
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
    }
    
    /*
     * hapus referensi pemberi beasiswa
     * @param id_pemberi
     */
    public function delPemberi($id){
        if(is_null($id)){
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
    }
    
    /*
     * hapus referensi pic
     * @param id_pic
     */
    public function delPIC($id){
        if(is_null($id)){
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
    }
    
    public function __destruct() {
        ;
    }
        
    
}
?>
