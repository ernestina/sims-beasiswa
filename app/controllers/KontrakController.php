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
        header('location:' . URL . 'kontrak/display');
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
            $kontrak->nilai_kontrak = str_replace(',', '', $_POST['nilai_kontrak']);
            $kontrak->lama_semester_kontrak = $_POST['lama_semester'];
            $kontrak->kontrak_lama = $_POST['kontrak_lama'];

            $upload = new Upload();
            $upload->init('fupload');
            $upload->setDirTo('files/');
            $nama = array($kontrak->no_kontrak, $kontrak->tgl_kontrak);
            $upload->changeFileName($upload->getFileName(), $nama);
            $kontrak->file_kontrak = $upload->getFileTo();
            //var_dump($kontrak);

            if ($kontrak->isEmpty($kontrak) == false) {
                //var_dump($kontrak);
                //$validasi = new Validasi();
                if (Validasi::validate_number($kontrak->jml_pegawai_kontrak) == TRUE) {
                    if (Validasi::validate_number($kontrak->nilai_kontrak) == TRUE) {
                        $kontrak->add($kontrak);
                        $upload->uploadFile();
                        header('location:' . URL . 'kontrak/display');
                    } else {
                        $url = URL . 'kontrak/rekamKontrak';
                        header("refresh:1;url=" . $url);
                        echo "Nilai kontrak harus diisi angka.";
                        //header('location:' . URL . 'kontrak/rekamKontrak/'); 
                    }
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
            $kontrak->nilai_kontrak = str_replace(',', '', $_POST['nilai_kontrak']);
            $kontrak->kontrak_lama = $_POST['kontrak_lama'];

            $upload = new Upload();
            $upload->init('fupload');

            //var_dump($kontrak);

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
            //menampilkan detil kontrak (header)
            $kontrak = new Kontrak();
            $data_kontrak = $kontrak->get_by_id($id); //detil kontrak berdasarkan kd_kontrak (id)
            $universitas = new Universitas($this->registry);
            $univ = $universitas->get_univ_by_jur($data_kontrak->kd_jurusan);
            $nama_univ = $univ->get_kode(); //mendapatkan nama singkatan universitas

            $kontrak_lama = $kontrak->get_by_id($data_kontrak->kontrak_lama); //mendapatkan objek kontrak lama
            //var_dump($kontrak_lama);
            //echo $kontrak_lama->no_kontrak;
            if ($kontrak_lama != false) {
                $kon_lama = $kontrak_lama->no_kontrak;
            } else {
                $kon_lama = "";
            }

            $jurusan = new Jurusan($this->registry);
            $jurusan->set_kode_jur($data_kontrak->kd_jurusan);
            $jur = $jurusan->get_jur_by_id($jurusan);
            //var_dump($jur->get_nama());
            $nama_jur = $jur->get_nama(); //mendapatkan nama jurusan
            //menampilkan daftar biaya berdasarkan kontrak
            $biaya = new Biaya();
            $data_biaya = $biaya->get_by_kontrak($id); //mendapatkan objek biaya berdasarkan kd_kontrak (id)
            $total_biaya = $biaya->get_biaya_by_kontrak($id); //mendapatkan total biaya berdasarkan kd_kontrak (id)
            //echo $total_biaya;
            //menyimpan variabel-variabel ke obje view
            $this->view->data_kontrak = $data_kontrak;
            $this->view->nama_univ = $nama_univ;
            $this->view->nama_jur = $nama_jur;
            $this->view->kon_lama = $kon_lama;
            $this->view->total_biaya = $total_biaya;
            $this->view->data_biaya = $data_biaya;
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

    //rekam biaya baru
    public function rekamBiaya($id = null) {
        if ($id != "") {
            $kontrak = new Kontrak();
            $data = $kontrak->get_by_id($id);
            //var_dump($kontrak);
            $this->view->kontrak = $data;
            $this->view->render('kontrak/rekam_biaya');
        } else if (isset($_POST['rekam_biaya'])) {
            $biaya = new Biaya();
            $biaya->kd_kontrak = $_POST['kd_kontrak'];
            $biaya->nama_biaya = $_POST['nama_biaya'];
            $biaya->biaya_per_pegawai = str_replace(',', '', $_POST['biaya_per_peg']);
            $biaya->jml_pegawai_bayar = $_POST['jml_peg'];
            $biaya->jadwal_bayar = date('Y-m-d', strtotime($_POST['jadwal_bayar']));
            $biaya->jml_biaya = str_replace(',', '', $_POST['jml_biaya']);
            $biaya->status_bayar = "belum";
            //var_dump($biaya);
            if ($biaya->isEmptyBiaya($biaya) == false) {
                if (Validasi::validate_number($biaya->biaya_per_pegawai) == TRUE &&
                        Validasi::validate_number($biaya->jmlh_pegawai_bayar) == TRUE &&
                        Validasi::validate_number($biaya->jumlah_biaya) == TRUE) {
                    $biaya->addBiaya($biaya);
                    header('location:' . URL . 'kontrak/biaya/' . $biaya->kd_kontrak);
                } else {
                    $url = URL . 'kontrak/rekamBiaya/' . $biaya->kd_kontrak;
                    header("refresh:1;url=" . $url);
                    echo "Isian Biaya per pegawai, jumlah pegawai dan jumlah biaya harus diisi angka.";
                    //header('location:' . URL . 'kontrak/rekamBiaya/'.$biaya->kd_kontrak); 
                }
            } else {
                $url = URL . 'kontrak/rekamBiaya/' . $biaya->kd_kontrak;
                header("refresh:1;url=" . $url);
                echo "Isian form belum lengkap.";
                //header('location:' . URL . 'kontrak/rekamBiaya/'.$biaya->kd_kontrak); 
            }
        } else {
            header("Location:" . URL . "kontrak/display");
        }
    }

    //menampilkan form edit biaya berdasarkan id=kd_biaya
    public function editBiaya($id = null) {
        if ($id != "") {
            $biaya = new Biaya();
            $data_biaya = $biaya->get_by_id($id); //mendapatkan data biaya berdasarkan id=kd_biaya
            //var_dump($data_biaya);
            $kontrak = new Kontrak();
            $data_kontrak = $kontrak->get_by_id($data_biaya->kd_kontrak); //detil kontrak berdasarkan kd_kontrak 

            $this->view->biaya = $data_biaya;
            $this->view->kontrak = $data_kontrak;
            $this->view->render('kontrak/edit_biaya' . $data->kd_biaya);
        } else {
            header('location:' . URL . 'kontrak/display');
        }
    }

    //melakukan proses update biaya dengan ajax
    public function updateBiaya() {
        if (isset($_POST['update_biaya'])) {
            $biaya = new Biaya();
            $biaya->kd_biaya = $_POST['kd_biaya'];
            $biaya->kd_kontrak = $_POST['kd_kontrak'];
            $biaya->nama_biaya = $_POST['nama_biaya'];
            $biaya->biaya_per_pegawai = str_replace(',', '', $_POST['biaya_per_peg']);
            $biaya->jml_pegawai_bayar = $_POST['jml_peg'];
            $biaya->jadwal_bayar = date('Y-m-d', strtotime($_POST['jadwal_bayar']));
            $biaya->jml_biaya = str_replace(',', '', $_POST['jml_biaya']);
            $biaya->status_bayar = "belum";
            if ($biaya->isEmptyBiaya($biaya) == false) {
                if (Validasi::validate_number($biaya->biaya_per_pegawai) == TRUE &&
                        Validasi::validate_number($biaya->jmlh_pegawai_bayar) == TRUE &&
                        Validasi::validate_number($biaya->jumlah_biaya) == TRUE) {
                    $biaya->updateBiaya($biaya);
                    //echo "sukses";
                    $respon = "sukses";
                    //header('location:' . URL . 'kontrak/biaya/' . $biaya->kd_kontrak);
                } else {
                    //$url = URL . 'kontrak/editBiaya/' . $biaya->kd_kontrak;
                    //header("refresh:1;url=" . $url);
                    //echo "Isian Biaya per pegawai, jumlah pegawai dan jumlah biaya harus diisi angka.";
                    //header('location:' . URL . 'kontrak/editBiaya/'.$biaya->kd_kontrak); 
                    //echo "gagal";
                    $respon = "gagal";
                }
            } else {
                //$url = URL . 'kontrak/editBiaya/' . $biaya->kd_kontrak;
                //header("refresh:1;url=" . $url);
                //echo "Isian form belum lengkap.";
                //header('location:' . URL . 'kontrak/editBiaya/'.$biaya->kd_kontrak); 
                $respon = "gagal";
            }

            $res = array('respon' => $respon);
            echo json_encode($res);
        }
//        else {
//            header('location:' . URL . 'kontrak/display');
//        }
    }

    //menghapus data biaya berdasarkan id=kd_biaya
    public function delBiaya($id = null) {
        if ($id != "") {
            $biaya = new Biaya();
            $data = $biaya->get_by_id($id);
            $biaya->deleteBiaya($id);

            //echo $data->kd_kontrak;
        }
        header("Location:" . URL . "kontrak/biaya/" . $data->kd_kontrak);
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
