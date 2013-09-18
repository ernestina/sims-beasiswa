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
        echo "method tidak ada";
    }

    /*
     * tambah referensi universitas
     */

    public function addUniversitas($id = null) {
        $univ = new Universitas($this->registry);
        if (isset($_POST['add_univ'])) {
            $kode = $_POST['kode'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $lokasi = $_POST['lokasi'];
            $pic = $_POST['pic'];

            $data = array(
                'KD_USER' => $pic,
                'SINGKAT_UNIV' => $kode,
                'NM_UNIV' => $nama,
                'ALMT_UNIV' => $alamat,
                'TELP_UNIV' => $telepon,
                'LOK_UNIV' => $lokasi
            );
            $univ->add_univ($data);
        }

        if (!is_null($id)) {
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

    public function addFakultas($id = null) {
        $fakul = new Fakultas($this->registry);
        $univ = new Universitas($this->registry);
        $this->view->univ = $univ->get_univ();
        if (isset($_POST['add_fak'])) {
            $univ = $_POST['universitas'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];

            $data = array(
                'KD_UNIV' => $univ,
                'NM_FAKUL' => $nama,
                'ALMT_FAKUL' => $alamat,
                'TELP_FAKUL' => $telepon
            );

            $fakul->add_fakul($data);
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

            $data = array(
                'KD_FAKUL' => $fak,
                'KD_STRATA' => $strata,
                'NM_JUR' => $nama,
                'ALMT_JUR' => $alamat,
                'TELP_JUR' => $telepon,
                'PIC_JUR' => $pic_jur,
                'TELP_PIC_JUR' => $telp_pic_jur,
                'STS_JUR' => $status,
            );

            $jur->add_jurusan($data);
        }

        if (!is_null($id)) {
            $fakul = new Fakultas($this->registry);
            $jur->set_kode_jur($id);
            $this->view->d_ubah = $jur->get_jur_by_id($jur);
            $this->view->fakul = $fakul->get_fakul();
        }

        $this->view->data = $jur->get_jurusan();
        $this->view->render('admin/jurusan');
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
                    if ($pejabat->cekJenisJabatan($pejabat->jenis_jabatan == False)) { //mengecek apakah sudah ada pejabat dengan jenis jabatan yang sama
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
     * tambah referensi jenis surat tugas
     */

    public function addST() {
        if (isset($_POST['add_st'])) {
            $nama = $_POST['nama'];
            $keterangan = $_POST['keterangan'];

            $data = $keterangan . '</br>' . $nama;

            echo $data;
        }

        $this->view->load('admin/surat_tugas');
    }

    /*
     * tambah referensi jenis cuti
     */

    public function addCuti() {
        if (isset($_POST['add_cuti'])) {
            $nama = $_POST['nama'];
            $keterangan = $_POST['keterangan'];

            $data = $keterangan . '</br>' . $nama;

            echo $data;
        }

        $this->view->load('admin/cuti');
    }

    /*
     * tambah referensi PIC
     */

    public function addPIC() {
        if (isset($_POST['add_pic'])) {
            $nama = $_POST['nama'];
            $keterangan = $_POST['keterangan'];

            $data = $keterangan . '</br>' . $nama;

            echo $data;
        }

        $this->view->load('admin/pic');
    }

    /*
     * ubah referensi universitas
     * @param id_univ
     */

    public function updUniversitas() {

        $univ = new Universitas($this->registry);
        if (isset($_POST['upd_univ'])) {
            $kd_univ = $_POST['kd_univ'];
            $kode = $_POST['kode'];
            $nama = $_POST['nama'];
            $alamat = $_POST['alamat'];
            $telepon = $_POST['telepon'];
            $lokasi = $_POST['lokasi'];
            $pic = $_POST['pic'];

            $data = array(
                'KD_UNIV' => $kd_univ,
                'KD_USER' => $pic,
                'SINGKAT_UNIV' => $kode,
                'NM_UNIV' => $nama,
                'ALMT_UNIV' => $alamat,
                'TELP_UNIV' => $telepon,
                'LOK_UNIV' => $lokasi
            );

            $univ->set_kode_in($kd_univ);
            $univ->update_univ($data);
        }

        header('location:' . URL . 'admin/addUniversitas');
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

        $data = array(
            'KD_UNIV' => $univ,
            'NM_FAKUL' => $nama,
            'ALMT_FAKUL' => $alamat,
            'TELP_FAKUL' => $telepon
        );

        $fakul->set_kode_fakul($kd_fakul);
        $fakul->update_fakul($data);

        header('location:' . URL . 'admin/addFakultas');
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

        $data = array(
            'KD_FAKUL' => $fak,
            'KD_STRATA' => $strata,
            'NM_JUR' => $nama,
            'ALMT_JUR' => $alamat,
            'TELP_JUR' => $telepon,
            'PIC_JUR' => $pic_jur,
            'TELP_PIC_JUR' => $telp_pic_jur,
            'STS_JUR' => $status,
        );

        $jur->set_kode_jur($kd_jur);
        $jur->update_jurusan($data);

        header('location:' . URL . 'admin/addJurusan');
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
                //header('location:' . URL . 'admin/updStrata/' . $strata->kd_strata);
            }
        } else {
            header('location:' . URL . 'admin/addStrata/');
        }
    }

    /*
     * ubah referensi jenis surat tugas
     * @param id_st
     */

    public function updST($id) {
        if (!is_null($id)) {
            $st = new SuratTugas();
            $data = $st->get($id);
        } else {
            throw new Exception;
            return;
        }
        $this->view->load('admin/surat_tugas');
    }

    /*
     * ubah referensi jenis cuti
     * @param id_cuti
     */

    public function updCuti($id) {
        if (!is_null($id)) {
            $cuti = new Cuti();
            $data = $cuti->get($id);
        } else {
            throw new Exception;
            return;
        }
        $this->view->load('admin/cuti');
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
                //header('location:' . URL . 'admin/updPemberi/' . $pemberi->kd_pemberi);
            }
        } else {
            header('location:' . URL . 'admin/addPemberi/');
        }
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
                    //header('location:' . URL . 'admin/editPejabat/'.$pejabat->kd_pejabat);
                }
            } else {
                $url = URL . 'admin/editPejabat/' . $pejabat->kd_pejabat;
                header("refresh:1;url=" . $url);
                echo "Isian form belum lengkap...";
                //header('location:' . URL . 'admin/editPejabat/'.$pejabat->kd_pejabat);
            }
        } else {
            //echo "3";
            header('location:' . URL . 'admin/addPejabat/');
        }
    }

    /*
     * ubah referensi bank
     * @param id_bank
     */

    public function updBank($id) {
        if (!is_null($id)) {
            $bank = new Bank();
            $data = $bank->get($id);
        } else {
            throw new Exception;
            return;
        }
        $this->view->load('admin/bank');
    }

    /*
     * ubah referensi PIC
     * @param id_pic
     */

    public function updPIC($id) {
        if (!is_null($id)) {
            $pic = new PIC();
            $data = $pic->get($id);
        } else {
            throw new Exception;
            return;
        }
        $this->view->load('admin/pic');
    }

    /*
     * hapus referensi universitas
     * @param id_univ
     */

    public function delUniversitas($id) {
        $univ = new Universitas($this->registry);
        if (is_null($id)) {
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
        $univ->set_kode_in($id);
        $univ->delete_univ();
        header('location:' . URL . 'admin/addUniversitas');
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
        $fakul->delete_fakul();
        header('location:' . URL . 'admin/addFakultas');
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
     * hapus referensi cuti
     * @param id_cuti
     */

    public function delCuti($id) {
        if (is_null($id)) {
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
    }

    /*
     * hapus referensi surat tugas
     * @param id_st
     */

    public function delST($id) {
        if (is_null($id)) {
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
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
     * hapus referensi pic
     * @param id_pic
     */

    public function delPIC($id) {
        if (is_null($id)) {
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
    }

    public function __destruct() {
        ;
    }

    public function list_bank() {
        $bank = new Bank($this->registry);

        $this->view->data = $bank->get_bank();
//        var_dump($data);
        $this->view->render('admin/list_bank');
    }

    public function addBank() {

        if (isset($_POST['submit'])) {
            $bank = new Bank($registry);

            $bank->set_nama($_POST['nama']);
            $bank->set_keterangan($_POST['keterangan']);

            $bank->addBank($bank);
        }
        header('location:' . URL . 'Admin/list_bank');
    }

    public function editBank($id) {

        $bank = new Bank($this->registry);

        $this->view->data = $bank->get_bank_id($id);
        $this->view->data2 = $bank->get_bank();

        $this->view->render('admin/edit_bank');
    }

    public function updateBank() {
//        $bank = new Bank($this->registry);
        if (isset($_POST['submit'])) {
            $data['KD_BANK'] = $_POST['id'];
            $data['NM_BANK'] = $_POST['nama'];
            $data['KET_BANK'] = $_POST['keterangan'];
        }
//        var_dump($data);
        $bank = new Bank($this->registry);
        $bank->updateBank($data);
        header('location:' . URL . 'Admin/list_bank');
    }

    public function deleteBank($id) {

        $bank = new Bank($this->registry);
        $bank->set_id($id);
        $bank->deleteBank();

        header('location:' . URL . 'Admin/list_bank');
    }

}

?>
