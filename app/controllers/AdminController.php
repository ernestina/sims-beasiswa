<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class AdminController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function index() {
        $this->view->render('admin/universitas');
    }

    /*
     * tambah referensi universitas
     */

    public function addUniversitas($id = null) {
        $univ = new Universitas($this->registry);
        $univDao = new UniversitasDao();
        if (isset($_POST['add_univ'])) {
            $kode = $_POST['kode'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $lokasi = $_POST['lokasi'];
            $pic = $_POST['pic'];
            $univDao->set_pic($pic);
            $univDao->set_kode($kode);
            $univDao->set_nama($nama);
            $univDao->set_telepon($telepon);
            $univDao->set_alamat($alamat);
            $univDao->set_lokasi($lokasi);
            if (!$univ->add_univ($univDao)) {
                $this->view->d_rekam = $univDao; var_dump($this->view->d_rekam);
                $this->view->error = $univ->get_error();
            }else{
                ClassLog::write_log('universitas','rekam',$nama);
            }
        }
        if (!is_null($id)) {
            $univDao->set_kode_in($id);
            $this->view->d_ubah = $univ->get_univ_by_id($univDao); 
        }
        $pic = new User($this->registry);
        $this->view->data = $univ->get_univ();
        $this->view->pic = $pic->get_user(TRUE);
//        var_dump($this->view->pic);
        $this->view->render('admin/universitas');
    }

    /*
     * ubah referensi universitas
     * @param id_univ
     */

    public function updUniversitas() {
        $univ = new Universitas($this->registry);
        $univDao = new UniversitasDao();
        if (isset($_POST['upd_univ'])) {
            $kd_univ = $_POST['kd_univ'];
            $kode = $_POST['kode'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $lokasi = $_POST['lokasi'];
            $pic = $_POST['pic'];
            $univDao->set_pic($pic);
            $univDao->set_kode($kode);
            $univDao->set_nama($nama);
            $univDao->set_telepon($telepon);
            $univDao->set_alamat($alamat);
            $univDao->set_lokasi($lokasi);
            $univDao->set_kode_in($kd_univ);
            if (!$univ->update_univ($univDao)) {
                $pic = new User($this->registry);
                $this->view->d_ubah = $univDao;
                $this->view->error = $univ->get_error();
                $this->view->data = $univ->get_univ();
                //        var_dump($this->view->d_ubah);
                $this->view->pic = $pic->get_user(TRUE);
                $this->view->render('admin/universitas');
            } else {
                ClassLog::write_log('universitas','ubah',$nama);
                header('location:' . URL . 'admin/addUniversitas/'.$halaman.'/'.$batas);
            }
        }
    }

    /*
     * hapus referensi universitas
     * @param id_univ
     */

    public function delUniversitas($id) {
        $univ = new Universitas($this->registry);
        $univDao = new UniversitasDao();
        if (is_null($id)) {
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
        $univDao->set_kode_in($id);
        $d_univ = $univ->get_univ_by_id($univDao);
        $nama = $d_univ->get_nama();
        $univ->delete_univ($univDao);
        ClassLog::write_log('universitas','hapus',$nama);
        header('location:' . URL . 'admin/addUniversitas/'.$halaman."/".$batas);
    }

    /*
     * tambah referensi fakultas
     */

    public function addFakultas($id = null) {
        $fakul = new Fakultas($this->registry);
        $univ = new Universitas($this->registry);
        $this->view->univ = $univ->get_univ();
        if (isset($_POST['add_fak'])) {
            $univ = $_POST['universitas'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $fakul->set_kode_univ($univ);
            $fakul->set_nama($nama);
            $fakul->set_alamat($alamat);
            $fakul->set_telepon($telepon);
            if (!$fakul->add_fakul()) {
                $this->view->d_rekam = $fakul;
                $this->view->error = $fakul->get_error();
            }else{
                ClassLog::write_log('fakultas','rekam',$nama);
            }
        }
        if (!is_null($id)) {
            $univ = new Universitas($this->registry);
            $fakul->set_kode_fakul($id);
            $this->view->d_ubah = $fakul->get_fakul_by_id($fakul);
            $this->view->univ = $univ->get_univ();
        }
        $this->view->data = $fakul->get_fakul();
        $this->view->render('admin/fakultas');
    }

    /*
     * ubah referensi fakultas
     * @param id_fakultas
     */

    public function updFakultas() {
        $fakul = new Fakultas($this->registry);
        $kd_fakul = $_POST['kd_fakul'];
        $univ = $_POST['universitas'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $fakul->set_kode_univ($univ);
        $fakul->set_nama($nama);
        $fakul->set_alamat($alamat);
        $fakul->set_telepon($telepon);
        $fakul->set_kode_fakul($kd_fakul);
        if (!$fakul->update_fakul()) {
            $this->view->d_ubah = $fakul;
            $this->view->error = $fakul->get_error();
            $univ = new Universitas($this->registry);
            $this->view->univ = $univ->get_univ();
            $this->view->data = $fakul->get_fakul();
            $this->view->render('admin/fakultas');
        } else {
            ClassLog::write_log('fakultas','ubah',$nama);
            header('location:' . URL . 'admin/addFakultas/'.$halaman."/".$batas);
        }
    }

    /*
     * hapus referensi fakultas
     * @param id_fakultas
     */

    public function delFakultas($id) {
        $fakul = new Fakultas($this->registry);
        if (is_null($id)) {
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
        $fakul->set_kode_fakul($id);
        $d_fakul = $fakul->get_fakul_by_id($fakul);
        $nama = $d_fakul->get_nama();
        $fakul->delete_fakul();
        ClassLog::write_log('fakultas','hapus',$nama);
        header('location:' . URL . 'admin/addFakultas/'.$halaman."/".$batas);
    }

    /*
     * tambah referensi jurusan
     */

    public function addJurusan($id = null) {
        $jur = new Jurusan($this->registry);
        $fakul = new Fakultas($this->registry);
        $this->view->fakul = $fakul->get_fakul();
        if (isset($_POST['add_jur'])) {
            $fak = $_POST['fakultas'];
            $strata = $_POST['strata'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $pic_jur = $_POST['pic_jur'];
            $telp_pic_jur = $_POST['telp_pic_jur'];
            $status = $_POST['status'];
            $jur->set_kode_fakul($fak);
            $jur->set_kode_strata($strata);
            $jur->set_nama($nama);
            $jur->set_alamat($alamat);
            $jur->set_telepon($telepon);
            $jur->set_pic($pic_jur);
            $jur->set_telp_pic($telp_pic_jur);
            $jur->set_status($status);
            if (!$jur->add_jurusan()) {
                $this->view->d_rekam = $jur;
                $this->view->error = $jur->get_error();
            }else{
                ClassLog::write_log('jurusan','rekam',$nama);
            }
        }
        if (!is_null($id)) {
            $fakul = new Fakultas($this->registry);
            $jur->set_kode_jur($id);
            $this->view->d_ubah = $jur->get_jur_by_id($jur);
            $this->view->fakul = $fakul->get_fakul();
        }
        $strata = new Strata();
        $this->view->strata = $strata->get_All();
        $this->view->data = $jur->get_jurusan();
        $this->view->render('admin/jurusan');
    }

    /*
     * ubah referensi jurusan
     * @param id_jurusan
     */

    public function updJurusan() {
        $jur = new Jurusan($this->registry);
        $kd_jur = $_POST['kd_jur'];
        $fak = $_POST['fakultas'];
        $strata = $_POST['strata'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $telepon = $_POST['telepon'];
        $pic_jur = $_POST['pic_jur'];
        $telp_pic_jur = $_POST['telp_pic_jur'];
        $status = $_POST['status'];
        $jur->set_kode_fakul($fak);
        $jur->set_kode_strata($strata);
        $jur->set_nama($nama);
        $jur->set_alamat($alamat);
        $jur->set_telepon($telepon);
        $jur->set_pic($pic_jur);
        $jur->set_telp_pic($telp_pic_jur);
        $jur->set_status($status);
        $jur->set_kode_jur($kd_jur);
        if (!$jur->update_jurusan()) {
            $fakul = new Fakultas($this->registry);
            $strata = new Strata();
            $this->view->d_ubah = $jur;
            $this->view->error = $jur->get_error();
            $this->view->fakul = $fakul->get_fakul();
            $this->view->strata = $strata->get_All();
            $this->view->data = $jur->get_jurusan();
            $this->view->render('admin/jurusan');
        } else {
            ClassLog::write_log('jurusan','ubah',$nama);
            header('location:' . URL . 'admin/addJurusan');
        }
    }

    /*
     * hapus referensi jurusan
     * @param id_jurusan
     */

    public function delJurusan($id) {
        $jur = new Jurusan($this->registry);
        if (is_null($id)) {
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
        $jur->set_kode_jur($id);
        $jur->delete_jurusan();
        header('location:' . URL . 'admin/addJurusan');
    }

    /*
     * tambah referensi strata
     */

    public function addStrata() {
        $strata = new Strata();
        if (isset($_POST['add_strata'])) {
            $strata->kode_strata = $_POST["kode_strata"];
            $strata->nama_strata = $_POST["nama_strata"];
            if ($strata->isEmpty($strata) == FALSE) {
                $strata->add($strata);
                header('location:' . URL . 'admin/addStrata');
            } else {
                echo "Isian form belum lengkap";
            }
        }
        $data = $strata->get_All();
        //var_dump($data);
        $this->view->data = $data;
        $this->view->render('admin/strata');
    }

    /*
     * menampilkan referensi strata yang akan diubah
     * @param id_strata
     */

    public function editStrata($id = null) {
        $strata = new Strata();
        if ($id != "") {
            $data = $strata->get_by_id($id);
            $this->view->strata = $data;
            $this->view->data = $strata->get_All();
            $this->view->render('admin/edit_strata');
        } else {
            header('location:' . URL . 'admin/addStrata/');
        }
    }

    /*
     * melakukan proses update referensi strata
     * @param id_strata
     */

    public function updStrata() {
        $strata = new Strata();
        if (isset($_POST['upd_strata'])) {
            $strata->kd_strata = $_POST["kd_strata"];
            $strata->kode_strata = $_POST["kode_strata"];
            $strata->nama_strata = $_POST["nama_strata"];
            //var_dump($strata);
            if ($strata->isEmpty($strata) == FALSE) {
                $strata->update($strata);
                header('location:' . URL . 'admin/addStrata/');
            } else {
                $url = URL . 'admin/editStrata/' . $strata->kd_strata;
                header("refresh:1;url=" . $url);
                echo "Isian form belum lengkap";
            }
        } else {
            header('location:' . URL . 'admin/addStrata/');
        }
    }

    /*
     * hapus referensi strata
     * @param id_strata
     */

    public function delStrata($id = null) {
        if ($id != null) {
            $strata = new Strata();
            $strata->delete($id);
            header('location:' . URL . 'admin/addStrata');
        } else {
            header('location:' . URL . 'admin/addStrata');
        }
    }

    /*
     * tambah referensi pemberi beasiswa
     */

    public function addPemberi() {
        $pemberi = new PemberiBeasiswa;
        if (isset($_POST['add_pemberi'])) {
            $pemberi->nama_pemberi = $_POST['nama_pemberi'];
            $pemberi->alamat_pemberi = $_POST['alamat_pemberi'];
            $pemberi->telp_pemberi = $_POST['telp_pemberi'];
            $pemberi->pic_pemberi = $_POST['pic_pemberi'];
            $pemberi->telp_pic_pemberi = $_POST['telp_pic_pemberi'];
            if ($pemberi->isEmpty($pemberi) == FALSE) {
                $pemberi->add($pemberi);
                header('location:' . URL . 'admin/addPemberi');
            } else {
                echo "Isian form belum lengkap";
            }
        }
        $data = $pemberi->get_All();
        //var_dump($data);
        $this->view->data = $data;
        $this->view->render('admin/pemberi');
    }

    /*
     * menampilkan referensi pemberi beasiswa yang akan diubah
     * @param id_pemberi_beasiswa
     */

    public function editPemberi($id = null) {
        $pemberi = new PemberiBeasiswa();
        if (!is_null($id)) {
            $data = $pemberi->get_by_id($id);
            //var_dump($data);
            $this->view->pemberi = $data;
            $this->view->data = $pemberi->get_All();
            $this->view->render('admin/edit_pemberi');
        } else {
            header('location:' . URL . 'admin/addPemberi/');
        }
    }

    /*
     * ubah referensi pemberi beasiswa
     * @param id_pemberi_beasiswa
     */

    public function updPemberi() {
        $pemberi = new PemberiBeasiswa();
        if (isset($_POST['upd_pemberi'])) {
            $pemberi->kd_pemberi = $_POST['kd_pemberi'];
            $pemberi->nama_pemberi = $_POST['nama_pemberi'];
            $pemberi->alamat_pemberi = $_POST['alamat_pemberi'];
            $pemberi->telp_pemberi = $_POST['telp_pemberi'];
            $pemberi->pic_pemberi = $_POST['pic_pemberi'];
            $pemberi->telp_pic_pemberi = $_POST['telp_pic_pemberi'];
            //var_dump($pemberi);
            if ($pemberi->isEmpty($pemberi) == false) {
                $pemberi->update($pemberi);
                header('location:' . URL . 'admin/addPemberi/');
            } else {
                $url = URL . 'admin/editPemberi/' . $pemberi->kd_pemberi;
                header("refresh:1;url=" . $url);
                echo "Isian form belum lengkap...";
            }
        } else {
            header('location:' . URL . 'admin/addPemberi/');
        }
    }

    /*
     * hapus referensi pemberi beasiswa
     * @param id_pemberi
     */

    public function delPemberi($id = null) {
        if ($id != null) {
            $pemberi = new PemberiBeasiswa();
            $pemberi->delete($id);
            header('location:' . URL . 'admin/addPemberi');
        } else {
            header('location:' . URL . 'admin/addPemberi');
        }
    }

    /*
     * tambah referensi pejabat
     */

    public function addPejabat() {
        $pejabat = new Pejabat();
        if (isset($_POST['add_pejabat'])) {
            $pejabat->kd_pejabat = $_POST['kd_pejabat'];
            $pejabat->nip_pejabat = $_POST['nip_pejabat'];
            $pejabat->nama_pejabat = $_POST['nama_pejabat'];
            $pejabat->nama_jabatan = $_POST['nama_jabatan'];
            $pejabat->jenis_jabatan = $_POST['jenis_jabatan'];
            if ($pejabat->isEmpty($pejabat) == FALSE) { //mengecek apakah data pejabat kosong
                if (Validasi::cekNip($pejabat->nip_pejabat) == true) { //mengecek apakah format nip benar
                    if ($pejabat->cekJenisJabatan($pejabat->jenis_jabatan) == TRUE) { //mengecek apakah sudah ada pejabat dengan jenis jabatan yang sama
                        $pejabat->add($pejabat);
                        header('location:' . URL . 'admin/addPejabat/');
                    } else {
                        echo "Pejabat dengan jenis jabatan tersebut sudah ada....";
                    }
                } else {
                    echo "Format NIP salah...";
                }
            } else {
                echo "Isian form belum lengkap...";
            }
        }
        $data = $pejabat->get_All();
        //var_dump($data);
        $this->view->data = $data;
        $this->view->render('admin/pejabat');
    }

    /*
     * menampilkan referensi pejabat yang akan diedit
     * @param id_pejabat
     */

    public function editPejabat($id = null) {
        $pejabat = new Pejabat();
        if (!is_null($id)) {
            $data = $pejabat->get_by_id($id);
            //var_dump($data);
            $this->view->pejabat = $data;
            $this->view->data = $pejabat->get_All();
            $this->view->render('admin/edit_pejabat');
        } else {
            header('location:' . URL . 'admin/addPejabat/');
        }
    }

    /*
     * ubah referensi pejabat
     * @param id_bank
     */

    public function updPejabat() {
        $pejabat = new Pejabat();
        if (isset($_POST['upd_pejabat'])) { // memproses update pemberi jika data pemberi di POST pada halaman edit_pemberi dan dialihkan ke halaman pemberi
            $pejabat->kd_pejabat = $_POST['kd_pejabat'];
            $pejabat->nip_pejabat = $_POST['nip_pejabat'];
            $pejabat->nama_pejabat = $_POST['nama_pejabat'];
            $pejabat->nama_jabatan = $_POST['nama_jabatan'];
            $pejabat->jenis_jabatan = $_POST['jenis_jabatan'];
            //var_dump($pejabat);
            if ($pejabat->isEmpty($pejabat) == false) {
                if (Validasi::cekNip($pejabat->nip_pejabat) == true) {
                    $pejabat->update($pejabat);
                    header('location:' . URL . 'admin/addPejabat/');
                } else {
                    $url = URL . 'admin/editPejabat/' . $pejabat->kd_pejabat;
                    header("refresh:1;url=" . $url);
                    echo "Format NIP salah...";
                }
            } else {
                $url = URL . 'admin/editPejabat/' . $pejabat->kd_pejabat;
                header("refresh:1;url=" . $url);
                echo "Isian form belum lengkap...";
            }
        } else {
            //echo "3";
            header('location:' . URL . 'admin/addPejabat/');
        }
    }

    /*
     * hapus referensi pejabat
     * @param id_pemberi
     */

    public function delPejabat($id = null) {
        if ($id != null) {
            $pejabat = new Pejabat();
            $pejabat->delete($id);
            header('location:' . URL . 'admin/addPejabat');
        } else {
            header('location:' . URL . 'admin/addPejabat');
        }
    }

    /*
     * tambah referensi jenis surat tugas
     */

    public function addST($id = null) {
        $st = new JenisSuratTugas($this->registry);
        if (isset($_POST['add_st'])) {
            $nama = $_POST['nama'];
            $keterangan = $_POST['keterangan'];
            $st->set_nama($nama);
            $st->set_keterangan($keterangan);
            if (!$st->add_jst()) {
                $this->view->d_rekam = $st;
                $this->view->error = $st->get_error();
            }
        }
        if (!is_null($id)) {
            $st->set_kode($id);
            $this->view->d_ubah = $st->get_jst_by_id($st);
        }
        $this->view->data = $st->get_jst();
//        var_dump($this->view->d_ubah);
        $this->view->render('admin/surat_tugas');
    }

    /*
     * ubah referensi jenis surat tugas
     * @param id_st
     */

    public function updST() {
        $st = new JenisSuratTugas($this->registry);
        if (isset($_POST['upd_st'])) {
            $kd_jenis_st = $_POST['kd_jenis_st'];
            $nama = $_POST['nama'];
            $keterangan = $_POST['keterangan'];
            $st->set_kode($kd_jenis_st);
            $st->set_nama($nama);
            $st->set_keterangan($keterangan);
            if (!$st->update_jst()) {
                $this->view->d_ubah = $st;
                $this->view->error = $st->get_error();
                $this->view->data = $st->get_jst();
                $this->view->render('admin/surat_tugas');
            }
        }
        header('location:' . URL . 'admin/addST');
    }

    /*
     * hapus referensi surat tugas
     * @param id_st
     */

    public function delST($id) {
        $st = new JenisSuratTugas($this->registry);
        if (is_null($id)) {
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
        $st->set_kode($id);
        $st->delete_jst();
        header('location:' . URL . 'admin/addST');
    }

    /*
     * tambah referensi jenis cuti
     */

    public function addCuti($id = null) {
        $sc = new JenisSuratCuti($this->registry);
        if (isset($_POST['add_sc'])) {
            $nama = $_POST['nama'];
            $keterangan = $_POST['keterangan'];
            $sc->set_nama($nama);
            $sc->set_keterangan($keterangan);
            if (!$sc->add_jsc()) {
                $this->view->d_rekam = $sc;
                $this->view->error = $sc->get_error();
            }
        }
        if (!is_null($id)) {
            $sc->set_kode($id);
            $this->view->d_ubah = $sc->get_jsc_by_id($sc);
        }
        $this->view->data = $sc->get_jsc();
//        var_dump($this->view->d_ubah);
        $this->view->render('admin/cuti');
    }

    /*
     * ubah referensi jenis cuti
     * @param id_cuti
     */

    public function updCuti() {
        $sc = new JenisSuratCuti($this->registry);
        if (isset($_POST['upd_sc'])) {
            $kd_jns_srt_cuti = $_POST['kd_jns_srt_cuti'];
            $nama = $_POST['nama'];
            $keterangan = $_POST['keterangan'];
            $sc->set_kode($kd_jns_srt_cuti);
            $sc->set_nama($nama);
            $sc->set_keterangan($keterangan);
            if (!$sc->update_jsc()) {
                $this->view->d_ubah = $sc;
                $this->view->error = $sc->get_error();
                $this->view->data = $sc->get_jsc();
                $this->view->render('admin/cuti');
            }
        }
        header('location:' . URL . 'admin/addCuti');
    }

    /*
     * hapus referensi cuti
     * @param id_cuti
     */

    public function delCuti($id) {
        $sc = new JenisSuratCuti($this->registry);
        if (is_null($id)) {
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
        $sc->set_kode($id);
        $sc->delete_jsc();
        header('location:' . URL . 'admin/addCuti');
    }

    /*
     * melihat data bank
     */

    public function list_bank() {
        $bank = new Bank($this->registry);
        $this->view->data = $bank->get_bank();
//        var_dump($data);
        $this->view->render('admin/list_bank');
    }

    /*
     * menambah data bank
     */

    public function addBank() {
        if (isset($_POST['submit'])) {
            if ($_POST['nama'] == "") {
                echo 'ada field yang masih kosong';
            } else {
                $bank = new Bank($registry);
                if ($bank->get_bank_name($_POST['nama']) == 1) {
                    echo 'data bank telah ada di dalam database';
                } else {
                    $bank->set_nama($_POST['nama']);
                    $bank->set_keterangan($_POST['keterangan']);
                    $bank->addBank($bank);
                }
            }
        }
        header('location:' . URL . 'admin/list_bank');
    }

    /*
     * merubah data bank
     * @param id_bank
     */

    public function editBank($id) {
        $bank = new Bank($this->registry);
        $this->view->data = $bank->get_bank_id($id);
        $bank2 = new Bank($registry);
        $this->view->data2 = $bank2->get_bank();
        $this->view->render('admin/edit_bank');
    }

    /*
     * eksekusi perubahan data bank
     */

    public function updateBank() {
//        $bank = new Bank($this->registry);
        if (isset($_POST['submit'])) {
            if ($_POST['nama'] == "") {
                echo 'nama bank tidak boleh kosong';
            } else {
                $bank = new Bank($registry);
                $bank->set_id($_POST['id']);
                $bank->set_nama($_POST['nama']);
                $bank->set_keterangan($_POST['keterangan']);
                $bank->updateBank($bank);
            }
        }
        header('location:' . URL . 'admin/list_bank');
    }

    /*
     * menghapus data bank
     * @param id_bank
     */

    public function deleteBank($id) {
        $bank = new Bank($this->registry);
        $bank->set_id($id);
        $bank->deleteBank();
        header('location:' . URL . 'admin/list_bank');
    }

    /*
     * melihat data user
     */

    public function listUser() {
        $user = new User($registry);
        $this->view->data = $user->get_user();
        
        $user2 = new User($registry);
        $this->view->data2 = $user2->get_ruser();
//        var_dump($user->get_user());
        $this->view->render('admin/list_user');
    }

    /*
     * menambah data user
     */

    public function addUser() {
        if (ISSET($_POST['submit'])) {

            if ($_POST['nip'] == "" || $_POST['nama'] == "" || $_POST['pass'] == "" || $_POST['cpass'] == "" || $_POST['akses'] == "" || $_FILES['upload'] == "") {
                echo 'ada field yang masih kosong';
            } else {
                if ($_POST['pass'] !== $_POST['cpass']) {

                    echo 'password tidak sama dengan confirm password';
                } else {

                    //FILES 

                    $allowedExts = array("jpg", "jpeg", "png");

                    $ext = explode('.', $_FILES['upload']['name']);
                    $extension = $ext[count($ext) - 1];

                    if (in_array($extension, $allowedExts)) {
                        $img_small = new ResizeImage($_FILES["upload"]["tmp_name"]);
                        $img_small->resizeTo(64, $resizeOption = 'maxwidth');
                        $img_small->saveImage("files/foto/" . $_POST['nip'] . "_small." . $extension);
                        move_uploaded_file($_FILES["upload"]["tmp_name"], "files/foto/" . $_POST['nip'] . "." . $extension);
                    } else {
                        
                    }

                    $user = new User($registry);
                    $user->set_nip($_POST['nip']);
                    $user->set_nmUser($_POST['nama']);
                    $user->set_pass($_POST['pass']);
                    $user->set_akses($_POST['akses']);
                    $user->set_foto($_POST['nip'] . "." . $extension);
                    $user->addUser($user);
                }
            }
        }
        header('location:' . URL . 'admin/listUser');
    }

    /*
     * merubah data user
     * @param id_user
     */

    public function editUser($id) {
        $user = new User($registry);
        $this->view->data = $user->getUser_id($id);
        $user2 = new User($registry);
        $this->view->data2 = $user2->get_user();
        
        $user3 = new User($registry);
        $this->view->data3 = $user3->get_ruser();
        $this->view->render('admin/edit_user');
    }

    /*
     * mengeksekusi data user
     */

    public function updateUser() {
        if (ISSET($_POST['submit'])) {
//            var_dump($_POST['pass']) ;
            if ($_POST['nip'] == "" || $_POST['nama'] == "") {
                echo 'ada field yang masih belum diisi';
            } else {

                if ($_POST['pass'] !== $_POST['cpass']) {
                    echo 'data tidak bisa disimpan karena password berbeda dengan confirm passwordnya';
                }

                if ($_POST['pass'] == "no_change" || $_POST['cpass'] == "no_change") {                  

                    if ($_FILES['upload']['name'] == "") {
                                              
                        $user = new User($registry);
                        $user->set_id($_POST['id']);
                        $user->set_nip($_POST['nip']);
                        $user->set_nmUser($_POST['nama']);
                        $user->set_akses($_POST['akses']);
                        $user->updateUser_withoutpass($user);
                        
                    } else {
                        $allowedExts = array("jpg", "jpeg", "png");

                        $ext = explode('.', $_FILES['upload']['name']);
                        $extension = $ext[count($ext) - 1];

                        if (in_array($extension, $allowedExts)) {                       
                            $img_small = new ResizeImage($_FILES["upload"]["tmp_name"]);
                            $img_small->resizeTo(64, $resizeOption = 'maxwidth');
                            $img_small->saveImage("files/foto/" . $_POST['nip'] . "_small." . $extension);
                            move_uploaded_file($_FILES["upload"]["tmp_name"], "files/foto/" . $_POST['nip'] . "." . $extension);
                        } else {
                            
                        }
                        $user = new User($registry);
                        $user->set_id($_POST['id']);
                        $user->set_nip($_POST['nip']);
                        $user->set_nmUser($_POST['nama']);
                        $user->set_akses($_POST['akses']);
                        $user->set_foto($_POST['nip'] . "." . $extension);
                        $user->updateUser_withoutpass($user);
                    }
                }

                if ($_POST['pass'] !== "no_change" && $_POST['pass'] == $_POST['cpass']) {

                    if ($_FILES['upload']['name'] == "") {
                                              
                        $user = new User($registry);
                        $user->set_id($_POST['id']);
                        $user->set_nip($_POST['nip']);
                        $user->set_nmUser($_POST['nama']);
                        $user->set_pass($_POST['pass']);
                        $user->set_akses($_POST['akses']);
                        $user->updateUser($user);
                        
                    } else {
                        
                        $allowedExts = array("jpg", "jpeg", "png");

                        $ext = explode('.', $_FILES['upload']['name']);
                        $extension = $ext[count($ext) - 1];

                        if (in_array($extension, $allowedExts)) {
                            $img_small = new ResizeImage($_FILES["upload"]["tmp_name"]);
                            $img_small->resizeTo(64, $resizeOption = 'maxwidth');
                            $img_small->saveImage("files/foto/" . $_POST['nip'] . "_small." . $extension);
                            move_uploaded_file($_FILES["upload"]["tmp_name"], "files/foto/" . $_POST['nip'] . "." . $extension);
                            
                        } else {
                            
                        }
                        $user = new User($registry);
                        $user->set_id($_POST['id']);
                        $user->set_nip($_POST['nip']);
                        $user->set_nmUser($_POST['nama']);
                        $user->set_pass($_POST['pass']);
                        $user->set_akses($_POST['akses']);
                        $user->set_foto($_POST['nip'] . "." . $extension);
                        $user->updateUser($user);
                    }
                }
            }
        }
        header('location:' . URL . 'admin/listUser');
    }

    /*
     * menghapus data user
     * @param id_user
     */

    public function deleteUser($id) {
        $user = new User($registry);

        $user->delUser($id);
        header('location:' . URL . 'admin/listUser');
    }

    /*
     * mendapatkan var jurusan berdasarkan id_univ
     * @param id_univ
     */

    public function get_jur_by_univ() {
        $univ = $_POST['param'];
        $jur = new Jurusan($this->registry);
        $data = $jur->get_jur_by_univ($univ);
        echo "<option value=''>-Pilih Jurusan-</option>";
        foreach ($data as $val) {
            echo "<option value=" . $val->get_kode_jur() . ">" . $val->get_nama() . "</option>";
        }
    }

    /*
     * mengecek ketersediaan jenis jabatan
     */

    public function cekJabatan() {
        $pejabat = new Pejabat();
        //$id='4';
        $id = $_POST['jenis_jabatan'];
        //$respon="";
        if ($pejabat->cekJenisJabatan($id) == TRUE) {
            $respon = "TRUE";
        } else {
            $respon = "FALSE";
        }
        $res = array('respon' => $respon);
        echo json_encode($res);
    }

    /*
     * meng-set data konfigurasi
     */

    public function config($ubah = false) {
        $xml = new ClassXML('1.0', 'utf-8');
        if (isset($_POST['add_conf'])) {
            $host = $_POST['host'];
            $db = $_POST['db'];
            $username = $_POST['username'];
            $pass = $_POST['pass'];


            $data = array('config' => array(
                    'host' => $host,
                    'db' => $db,
                    'username' => $username,
                    'password' => $pass
                    ));

            $xml->writeXML('libs/testing', $data);
        }

        $this->view->data = $xml->readXML('libs/testing');
        if ($ubah) {
            $this->view->ubah = true;
        }
        $this->view->render('admin/config_database');
    }

    /*
     * melakukan backup database
     */
    /*
     * halaman backup
     */

    public function backup() {
        $this->view->render('admin/backup_db');
    }

    public function list_backup() {
        $this->view->d_files = array();
        $entry = opendir('public/backup');
        while ($res = readdir($entry)) {
//            echo $res."</br>";
            if (strlen($res) > 10) {
                $this->view->d_files[] = $res;
            }
        }
        $this->view->load('admin/list_backup');
    }

    public function backup_db() {
        $db = new Backuprestore();

        $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        $db->backupDatabase('beasiswa');

        echo "<div id=success>Backup data berhasil dilakukan</div>";
    }

    public function del_backup($filename) {
        $filename = 'public/backup/' . $filename;
        $file_exist = file_exists($filename);
        if ($file_exist) {
            unlink($filename);
//            return true;
        }
//        return false;
        header('location:' . URL . 'admin/backup');
    }

    /*
     * melakukan restore database
     */

    public function restore() {
        $this->view->render('admin/restore_db');
    }

    public function restore_db() {
        $db = new Backuprestore();
        $db->connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//        if(!move_uploaded_file($_FILES['file']['tmp_name'])){
//            switch($_FILES['file']['error']){
//                case 1:
//                    echo "file to large";
//                    break;
//                case 2:
//                    echo "file larger than set in form (MAX_FILE_SIZE)";
//                    break;
//                case 3:
//                    echo "partial upload";
//                    break;
//                case 4:
//                default:
//                    echo "file not uploaded (unknown)";
//            }
//        }
//        if (isset($_POST['sb_restore'])) {
        if (!empty($_FILES['file']['name'])) {
            if ($db->getlast($_FILES['file']['name']) == 'sql') {
                echo $db->getlast($_FILES['file']['name']);
                $tempFile = $_FILES['file']['tmp_name'];
                $targetFile = 'public/temp/' . $_FILES['file']['name'];
                move_uploaded_file($tempFile, $targetFile);
                $db->restoreDatabaseSql($targetFile);
            } elseif ($db->getlast($_FILES['file']['name']) == 'zip') {
                $tempFile = $_FILES['file']['tmp_name']; //echo $tempFile;
                $targetFile = 'public/temp/' . $_FILES['file']['name']; //echo $targetFile;
                move_uploaded_file($tempFile, $targetFile);
                $db->restoreDatabaseZip($targetFile);
            } else {
                echo "Invalid Database File Type";
            }
        }
//        }
        /*
         * ubah nama admin dan password admin, 
         * mengantisipasi lupa password setelah restore
         */
        $sql = "SELECT KD_USER FROM d_user WHERE AKSES_USER=1";
        $data = $this->registry->db->select($sql);
        $id = 0;
        foreach ($data as $val) {
            $id = $val['KD_USER'];
        }
        $data_admin = array('NM_USER' => 'admin',
            'PASS_USER' => Hash::create('sha1', 'admin', HASH_SALT_KEY));
        $where = ' id_user=' . $id;
        $this->registry->db->update('d_user', $data_admin, $where);

        echo "<div id=success>restore data telah berhasil dilakukan, " . $_SESSION['ttlQuery'] . " query dieksekusi pada " . date('Y-m-d H:i:s', $_SESSION['timeQuery']) . "</div>";

//        $this->view->render('admin/restore_db');
    }

    public function get_method() {
        $method = get_class_methods($this);
//        $no = 1;
        foreach ($method as $method) {
            print_r("\$akses[\'admin\'][\'" . get_class($this) . "\'][\'" . $method . "\'];</br>");
//            $no++;
        }
    }

    /*
     * destruktor
     */

    public function __destruct() {
        ;
    }

}

?>
