<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class KontrakController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }

    public function index() {
        $this->view->render('kontrak/mon_pembayaran');
    }

    public function display() {
        //$kontrak = new Kontrak();
        //$data = $kontrak->get_All();
        $universitas = new Universitas($this->registry);
        $univ = $universitas->get_univ();
        //var_dump($univ);
        $this->view->univ = $univ;
        //$this->view->data = $data;
        $this->view->render('kontrak/data_kontrak');
    }

    public function rekamKontrak() {
        if (!isset($_POST['rekam_kontrak'])) {
            $universitas = new Universitas($this->registry);
            $univ = $universitas->get_univ();
            $kontrak = new Kontrak();
            $kon = $kontrak->get_All();
            $this->view->univ = $univ;
            $this->view->kon = $kon;
            $this->view->render('kontrak/rekam_kontrak');
        } else {
            $kontrak = new Kontrak();
            //$kontrak->kd_kontrak =$_POST[''];
            $kontrak->no_kontrak = $_POST['nomor'];
            $kontrak->kd_jurusan = $_POST['jur'];
            $kontrak->tgl_kontrak = date('Y-m-d', strtotime($_POST['tanggal']));
            $kontrak->thn_masuk_kontrak = $_POST['tahun_masuk'];
            $kontrak->jml_pegawai_kontrak = $_POST['jml_peg'];
            $kontrak->lama_semester_kontrak = $_POST['lama_semester'];
            $kontrak->kontrak_lama = $_POST['kontrak_lama'];

            $upload = new Upload();
            $upload->init('fupload');
            $upload->setDirTo('files/');
            $nama = array($kontrak->no_kontrak, $kontrak->tgl_kontrak);
            $upload->changeFileName($upload->getFileName(), $nama);
            $kontrak->file_kontrak = $upload->getFileTo();

            if ($kontrak->isEmpty($kontrak) == false) {
                //var_dump($kontrak);
                //$validasi = new Validasi();
                if (Validasi::validate_number($kontrak->jml_pegawai_kontrak) == TRUE) {
                    $kontrak->add($kontrak);
                    $upload->uploadFile();
                    header('location:' . URL . 'kontrak/display');
                } else {
                    $url = URL . 'kontrak/rekamKontrak';
                    header("refresh:1;url=" . $url);
                    echo "Jumlah pegawai harus diisi angka.";
                    //header('location:' . URL . 'kontrak/rekamKontrak/');
                }
            } else {
                $url = URL . 'kontrak/rekamKontrak';
                header("refresh:1;url=" . $url);
                echo "Isian form belum lengkap";
                //header('location:' . URL . 'kontrak/rekamKontrak/');
            }
        }
    }

    public function get_jur_by_univ() {
        if (isset($_POST['univ']) && $_POST['univ'] != "") {
            $univ = $_POST['univ'];
            $jurusan = new Jurusan($this->registry);
            $data = $jurusan->get_jur_by_univ($univ);
            echo "<option value=''>Pilih Jurusan</option>";
            foreach ($data as $jur) {
                if (isset($_POST['jur_def'])) {
                    if ($jur->get_kode_jur() == $_POST['jur_def']) {
                        $select = " selected";
                    } else {
                        $select = "";
                    }
                    echo "<option value=" . $jur->get_kode_jur() . "" . $select . ">" . $jur->get_nama() . "</option>\n";
                } else {
                    echo "<option value=" . $jur->get_kode_jur() . ">" . $jur->get_nama() . "</option>\n";
                }
            }
        } else {
            echo "<option value=''>Pilih Jurusan</option>";
        }
    }

    public function editKontrak($id = null) {
        if ($id != "") {
            $kontrak = new Kontrak();
            $data = $kontrak->get_by_id($id);
            //var_dump($kontrak);
            $universitas = new Universitas($this->registry);
            $this->view->universitas = $universitas;
            $univ = $universitas->get_univ();
            $kon = $kontrak->get_All();
            $this->view->univ = $univ;
            $this->view->data = $data;
            $this->view->kon = $kon;
            $this->view->render('kontrak/edit_kontrak');
        } else {
            header('location:' . URL . 'kontrak/display');
        }
    }

    public function updateKontrak() {
        if (isset($_POST['update_kontrak'])) {
            $kontrak = new Kontrak();
            $kontrak->kd_kontrak = $_POST['kd_kontrak'];
            $kontrak->no_kontrak = $_POST['nomor'];
            $kontrak->kd_jurusan = $_POST['jur'];
            $kontrak->tgl_kontrak = date('Y-m-d', strtotime($_POST['tanggal']));
            $kontrak->thn_masuk_kontrak = $_POST['tahun_masuk'];
            $kontrak->jml_pegawai_kontrak = $_POST['jml_peg'];
            $kontrak->lama_semester_kontrak = $_POST['lama_semester'];
            $kontrak->kontrak_lama = $_POST['kontrak_lama'];

            $upload = new Upload();
            $upload->init('fupload');

            if ($upload->getFileName() != "") {
                $upload->setDirTo('files/');
                $nama = array($kontrak->no_kontrak, $kontrak->tgl_kontrak);
                $upload->changeFileName($upload->getFileName(), $nama);
                $file_baru = $upload->getFileTo();
                $kontrak->file_kontrak = $file_baru;
            } else {
                $file_lama = $_POST['fupload_lama'];
                $kontrak->file_kontrak = $file_lama;
            }

            if ($kontrak->isEmpty($kontrak) == false) {
                //var_dump($kontrak);
                $kontrak->update($kontrak);
                if ($file_baru != "") {
                    $upload->uploadFile();
                }
                header('location:' . URL . 'kontrak/display');
            } else {
                $url = URL . 'kontrak/editKontrak/' . $kontrak->kd_kontrak;
                header("refresh:1;url=" . $url);
                echo "Isian form belum lengkap";
                //header('location:' . URL . 'kontrak/editKontrak/');
            }
        } else {
            header('location:' . URL . 'kontrak/display');
        }
    }

    public function get_data_kontrak() {
        $kontrak = new Kontrak();
        $univ = $_POST['univ'];
        $jurusan = new Jurusan($this->registry);
        $universitas = new Universitas($this->registry);

        if ($univ == "") {
            $data = $kontrak->get_All();
            $this->view->data = $data;
            //var_dump($data);
        } else {
            $this->view->data = $kontrak->get_by_univ($univ);
        }
        $this->view->jurusan = $jurusan;
        $this->view->kontrak = $kontrak;
        $this->view->universitas = $universitas;
        $this->view->load('kontrak/tabel_kontrak');
    }

    public function biaya($id = null) {
        if ($id != "") {
            $kontrak = new Kontrak();
            $data = $kontrak->get_by_id($id);
            //var_dump($kontrak);
            $universitas = new Universitas($this->registry);
            $this->view->universitas = $universitas;
            $univ = $universitas->get_univ_by_jur($data->kd_jurusan);
            $jurusan = new Jurusan($this->registry);
            $jurusan->set_kode_jur($data->kd_jurusan);
            $this->view->jurusan = $jurusan->get_jur_by_id($jurusan);
            $this->view->kontrak = $kontrak;
            $this->view->univ = $univ;
            $this->view->data = $data;
            $this->view->render('kontrak/data_biaya');
        } else {
            header('location:' . URL . 'kontrak/display');
        }
    }

    public function delKontrak($id = null) {
        if ($id != "") {
            $kontrak = new Kontrak();
            $kontrak->delete($id);
            //echo "berhasil hapus";
        }
        header("Location:" . URL . "kontrak/display");
    }

    public function rekambiaya() {
        $this->view->render('kontrak/rekam_biaya');
    }

    public function monitoring() {
        $this->view->render('kontrak/mon_pembayaran');
    }

    public function file($file = null) {
        if ($file != "") {
            header("Location:" . URL . "files/" . $file);
        }
    }

}

?>
