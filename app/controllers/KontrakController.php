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

    //menampilkan halaman data_kontrak
    public function display() {
        $universitas = new Universitas($this->registry);
        $kd_user = Session::get('kd_user');
        if(Session::get('role')==2){
			$univ = $universitas->get_univ_by_pic($kd_user);
		}
		if(Session::get('role')==3){
			$univ = $universitas->get_univ();
		}
        $this->view->kd_univ = $univ;
        $this->view->render('kontrak/data_kontrak');
    }

    //menampilkan data kontrak dalam bentuk tabel di tabel_kontrak di halaman data_kontrak berdasarkan universitas
    public function get_data_kontrak() {
        $kontrak = new Kontrak();
        $univ = $_POST['univ'];
        $user = Session::get('kd_user');
        //echo $user;
		
        $biaya = new Biaya();
        $jurusan = new Jurusan($this->registry);
        $universitas = new Universitas($this->registry);

        if ($univ == "") {
			if(Session::get('role')==2){
				$data = $kontrak->get_All($user);
			}
			if(Session::get('role')==3){
				$data = $kontrak->get_All();
			}
            
        } else {
            $data = $kontrak->get_by_univ($univ);
        }
		
		if(isset($_POST['cur_page'])){
			$cur_page = $_POST['cur_page'];
		} else {
			$cur_page = 1;
		}
		$paging = new MyPaging($cur_page, $data);
		$this->view->cur_page = $paging->getCurPage();
		$this->view->per_page = $paging->getPerPage();
		$this->view->page_num = $paging->getPageNum();
		$this->view->data = $paging->getData();
        $this->view->biaya = $biaya;
        $this->view->jurusan = $jurusan;
        $this->view->kontrak = $kontrak;
        $this->view->universitas = $universitas;
        $this->view->load('kontrak/tabel_kontrak');
    }

    //menampilkan data kontrak dalam bentuk tabel di tabel_kontrak di halaman data_kontrak berdasarkan no kontrak
    public function get_data_kontrak2() {
        $kontrak = new Kontrak();
        $key = $_POST['key'];
        $user = Session::get('kd_user');
        //echo $user;
        $biaya = new Biaya();
        $jurusan = new Jurusan($this->registry);
        $universitas = new Universitas($this->registry);

        if ($key != "") {
			if(Session::get('role')==2){
				$data = $kontrak->get_by_nomor($key, $user);
			}
			if(Session::get('role')==3){
				$data = $kontrak->get_by_nomor($key);
			}
            
            $this->view->data = $data;
            //var_dump($data);
        }
        $this->view->biaya = $biaya;
        $this->view->jurusan = $jurusan;
        $this->view->kontrak = $kontrak;
        $this->view->universitas = $universitas;
        $this->view->load('kontrak/tabel_kontrak');
    }

    //menampilkan halaman rekam_kontrak dan melakukan proses rekam kontrak (pada halaman baru)
    public function rekamKontrak() {
		if(Session::get('role')!=2){
			$this->display();
			exit();
		}
        if (!isset($_POST['rekam_kontrak'])) {
            $universitas = new Universitas($this->registry);
            $kd_user = Session::get('kd_user');
            //echo $kd_user;
            $univ = $universitas->get_univ_by_pic($kd_user);
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
                        //header('location:' . URL . 'kontrak/display');
                        $url = URL . 'kontrak/display';
                        header("refresh:1;url=" . $url);
                        echo "Kontrak berhasil disimpan.";
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

    //menampilkan halaman rekam_kontrak_dialog dalam bentuk modal (pada halaman data_kontrak)
    public function viewRekamKontrak() {
		if(Session::get('role')!=2){
			$this->display();
			exit();
		}
        $universitas = new Universitas($this->registry);
        $kd_user = Session::get('kd_user');
        //echo $kd_user;
        $univ = $universitas->get_univ_by_pic($kd_user);
        $this->view->univ = $univ;
        $this->view->load('kontrak/rekam_kontrak_dialog');
    }

    public function getSelectByJur() {
        if (isset($_POST['jur'])) {
            if ($_POST['jur'] != "") {
                $jur = $_POST['jur'];
                //print_r($jur);
                $kontrak = new Kontrak();
                $data = $kontrak->get_by_jur($jur);
                echo "<option value=\"\">Pilih kontrak lama</option>";
                foreach ($data as $kon) {
                    if (isset($_POST['kon_def'])) {
                        if ($kon->kd_kontrak === $_POST['kon_def']) {
                            $select = " selected";
                        } else {
                            $select = "";
                        }
                        echo "<option value=" . $kon->kd_kontrak . "" . $select . ">" . $kon->no_kontrak . "</option>\n";
                    } else {
                        echo "<option value=" . $kon->kd_kontrak . ">" . $kon->no_kontrak . "</option>\n";
                    }
                }
            } else {
                echo "<option value=\"\">Pilih kontrak lama</option>";
            }
        }
    }

    //melakukan proses rekam kontrak pada modal rekam_kontrak_dialog (pada halaman data_kontrak)
    public function rekamKontrak2() {
		if(Session::get('role')!=2){
			$this->display();
			exit();
		}
        if (isset($_POST['rekam_kontrak'])) {
            $kontrak = new Kontrak();
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
            $upload->setDirTo('files/kontrak/');
            $nama = array($kontrak->no_kontrak, $kontrak->tgl_kontrak);
            $upload->uploadFile2("", $nama);
            $kontrak->file_kontrak = $upload->getFileTo();
            //var_dump($kontrak);
            $kontrak->add($kontrak);
			ClassLog::write_log("kontrak","rekam kontrak","kontrak no.".$kontrak->no_kontrak);
        }
    }

    //menampilkan daftar jurusan berdasrkan universitas dalam bentuk select option
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

    //menampilkan halaman edit_kontrak pada halaman baru
    public function editKontrak($id = null) {
		if(Session::get('role')!=2){
			$this->display();
			exit();
		}
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

    //melakukan proses update kontrak pada halaman edit_kontrak  
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

    //menampilkan halaman edit_kontrak_dialog dalam bentuk modal pada halaman data_kontrak
    public function viewEditKontrak($id = null) {
		if(Session::get('role')!=2){
			$this->display();
			exit();
		}
        if ($id != "") {
            $kontrak = new Kontrak();
            $data = $kontrak->get_by_id($id);
            //var_dump($kontrak);
            $universitas = new Universitas($this->registry);
            $current_univ = $universitas->get_univ_by_jur($data->kd_jurusan);
            $jurusan = new Jurusan($this->registry);
            $jur = $jurusan->get_jur_by_univ($current_univ->get_kode_in());
            //echo $data->kd_jurusan;
            //var_dump($jur);
            $this->view->universitas = $universitas;
            $kd_user = Session::get('kd_user');
            //echo $kd_user;
            $univ = $universitas->get_univ_by_pic($kd_user);
            $kon = $kontrak->get_by_jur($data->kd_jurusan);
            $this->view->jur = $jur;
            $this->view->univ = $univ;
            $this->view->data = $data;
            $this->view->kon = $kon;
            $this->view->load('kontrak/edit_kontrak_dialog');
        }
    }

    //melakukan proses update kontrak pada modal edti_kontrak_dialog
    public function updateKontrak2() {
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

            if ($_FILES['fupload']['name'] != "") {
                $upload = new Upload();
                $upload->init('fupload');
                $upload->setDirTo('files/kontrak/');
                $nama = array($kontrak->no_kontrak, $kontrak->tgl_kontrak);
                $upload->uploadFile2("", $nama);
                $kontrak->file_kontrak = $upload->getFileTo();
            } else {
                $kontrak->file_kontrak = $_POST['fupload_lama'];
            }
            //print_r($kontrak->kd_kontrak);
            $kontrak->update($kontrak);
			ClassLog::write_log("kontrak","ubah kontrak","kontrak no.".$kontrak->no_kontrak);
        }
    }

    //menghapus data kontrak berdasarkan kd_kontrak
    public function delKontrak($id = null) {
		if(Session::get('role')!=2){
			$this->display();
			exit();
		}
        if ($id != "") {
            $kontrak = new Kontrak();
            $data_kontrak = $kontrak->get_by_id($id);
            $kontrak->delete($id);

            $file = "files/kontrak/" . $data_kontrak->file_kontrak;
            //echo $file;
            if (file_exists($file)) {
                unlink($file);
            }
            ClassLog::write_log("kontrak","hapus kontrak","kontrak no.".$data_kontrak->no_kontrak);
        }
        header("Location:" . URL . "kontrak/display");
    }

    //menampilkan data biaya berdasarkan kd_kontrak
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

    //menampilkan halaman rekam_biaya pada halaman baru
    public function viewRekamBiaya() {
		if(Session::get('role')!=2){
			$this->display();
			exit();
		}
        if (isset($_POST['kd_kontrak'])) {
            $kontrak = new Kontrak();
            $id = $_POST['kd_kontrak'];
            $data_kontrak = $kontrak->get_by_id($id);
            //var_dump($kontrak);
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
			$this->view->total_biaya_kontrak = $biaya->get_biaya_by_kontrak($id);
            $this->view->nama_univ = $nama_univ;
            $this->view->nama_jur = $nama_jur;
            $this->view->kon_lama = $kon_lama;
            $this->view->kontrak = $data_kontrak;
            $this->view->render('kontrak/rekam_biaya');
        } else {
            header("Location:" . URL . "kontrak/display");
        }
    }

    //melakukan proses rekam biaya baru pada halaman rekam_biaya
    public function rekamBiaya() {
        //var_dump($_POST);
        //exit();
		
        if (isset($_POST['rekam_biaya'])) {
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
				$total_biaya = $biaya->get_biaya_by_kontrak($biaya->kd_kontrak);
				if($total_biaya + $biaya->jml_biaya > $_POST['max_kontrak']){
					$url = URL . 'kontrak/rekamBiaya/' . $biaya->kd_kontrak;
					echo '<script> alert("Jumlah biaya melebihi nilai kontrak.") </script>';
                    echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
					exit();
				}
				if($biaya->jml_pegawai_bayar > $_POST['max_peg']){
					$url = URL . 'kontrak/rekamBiaya/' . $biaya->kd_kontrak;
					echo '<script> alert("Jumlah pegawai melebihi jumlah pegawai dalam kontrak.") </script>';
                    echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
					exit();
				}
				
                if (Validasi::validate_number($biaya->biaya_per_pegawai) == TRUE &&
                        Validasi::validate_number($biaya->jmlh_pegawai_bayar) == TRUE &&
                        Validasi::validate_number($biaya->jumlah_biaya) == TRUE) {
                    $biaya->addBiaya($biaya);
					ClassLog::write_log("kontrak","rekam biaya kontrak","kode biaya ".$biaya->kd_biaya."kode kontrak".$biaya->kd_kontrak);
                    //header('location:' . URL . 'kontrak/biaya/' . $biaya->kd_kontrak);
                    $url = URL . 'kontrak/biaya/' . $biaya->kd_kontrak;                  
                    echo '<script> alert("Data biaya berhasil disimpan") </script>';
                    echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
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

    //melakukan proses rekam biaya pada halaman rekam_biaya menggunakan ajax
    public function rekamBiaya2() {
        if (isset($_POST['rekam_biaya'])) {
            $biaya = new Biaya();
            $biaya->kd_kontrak = $_POST['kd_kontrak'];
            $biaya->nama_biaya = $_POST['nama_biaya'];
            $biaya->biaya_per_pegawai = str_replace(',', '', $_POST['biaya_per_peg']);
            $biaya->jml_pegawai_bayar = str_replace(',', '', $_POST['jml_peg']);
            $biaya->jadwal_bayar = date('Y-m-d', strtotime($_POST['jadwal_bayar']));
            $biaya->jml_biaya = str_replace(',', '', $_POST['jml_biaya']);
            $biaya->status_bayar = "belum";
            //var_dump($biaya);
            print_r($_POST['kd_kontrak']);
            $biaya->addBiaya($biaya);
        }
    }

    //menampilkan master halaman edit biaya berdasarkan id=kd_biaya pada halaman baru
    public function editBiaya($id = null,$tab=null) {
		if(Session::get('role')!=2){
			$this->display();
			exit();
		}
        if ($id != "") {
            $biaya = new Biaya();
            $data_biaya = $biaya->get_by_id($id); //mendapatkan data biaya berdasarkan id=kd_biaya
            //var_dump($data_biaya);
            $kontrak = new Kontrak();
            //$kd_kontrak = $_POST['kd_kontrak'];
            $data_kontrak = $kontrak->get_by_id($data_biaya->kd_kontrak);
            //var_dump($kontrak);
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
            if($tab=="" || $tab>2){
                $tab=0;
            }
			
			$this->view->total_biaya_kontrak = $biaya->get_biaya_by_kontrak($data_biaya->kd_kontrak);
            $this->view->nama_univ = $nama_univ;
            $this->view->nama_jur = $nama_jur;
            $this->view->biaya = $data_biaya;
            $this->view->kontrak = $data_kontrak;
            $this->view->tab = $tab;
            $this->view->render('kontrak/edit_biaya');
        } else {
            header('location:' . URL . 'kontrak/display');
        }
    }

    //melakukan proses update biaya pada halaman edit_biaya
    public function updateBiaya() {
        if (isset($_POST['update_biaya'])) {
            //sleep(1);
            $biaya = new Biaya();
            $biaya->kd_biaya = $_POST['kd_biaya'];
            $biaya->kd_kontrak = $_POST['kd_kontrak'];
            $biaya->nama_biaya = $_POST['nama_biaya'];
            $biaya->biaya_per_pegawai = str_replace(',', '', $_POST['biaya_per_peg']);
            $biaya->jml_pegawai_bayar = $_POST['jml_peg'];
            $biaya->jadwal_bayar = date('Y-m-d', strtotime($_POST['jadwal_bayar']));
            $biaya->jml_biaya = str_replace(',', '', $_POST['jml_biaya']);
            $biaya_current = $biaya->get_by_id($biaya->kd_biaya);
            $biaya->status_bayar = $biaya_current->status_bayar; //untuk mendapatkan status bayar terkini
            if ($biaya->isEmptyBiaya($biaya) == false) {
				$total_biaya = $biaya->get_biaya_by_kontrak($biaya->kd_kontrak);
				if($total_biaya + $biaya->jml_biaya - $_POST['def_jml_biaya']> $_POST['max_kontrak']){
					$url = URL . 'kontrak/editBiaya/' . $biaya->kd_kontrak;
					echo '<script> alert("Jumlah biaya melebihi nilai kontrak.") </script>';
                    echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
					exit();
				}
				if($biaya->jml_pegawai_bayar > $_POST['max_peg']){
					$url = URL . 'kontrak/editBiaya/' . $biaya->kd_kontrak;
					echo '<script> alert("Jumlah pegawai melebihi jumlah pegawai dalam kontrak.") </script>';
                    echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
					exit();
				}
                if (Validasi::validate_number($biaya->biaya_per_pegawai) == TRUE &&
                        Validasi::validate_number($biaya->jmlh_pegawai_bayar) == TRUE &&
                        Validasi::validate_number($biaya->jumlah_biaya) == TRUE) {
                    $biaya->updateBiaya($biaya);
					ClassLog::write_log("kontrak","ubah biaya utama kontrak","kode biaya ".$biaya->kd_biaya."kode kontrak".$biaya->kd_kontrak);
                    //$url = URL . 'kontrak/editBiaya/' . $biaya->kd_biaya;
					$url = URL . 'kontrak/biaya/' . $biaya->kd_kontrak;
                    echo '<script> alert("Data biaya berhasil disimpan") </script>';
                    echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
                } else {
                    $url = URL . 'kontrak/editBiaya/' . $biaya->kd_biaya;
                    //header("refresh:1;url=" . $url);
                    //echo "Isian Biaya per pegawai, jumlah pegawai dan jumlah biaya harus diisi angka.";
                    //header('location:' . URL . 'kontrak/editBiaya/' . $biaya->kd_biaya);
                    echo '<script> alert("Isian Biaya per pegawai, jumlah pegawai dan jumlah biaya harus diisi angka") </script>';
                    echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
                }
            } else {
                $url = URL . 'kontrak/editBiaya/' . $biaya->kd_biaya;
				
                //header("refresh:1;url=" . $url);
                //echo "Isian form belum lengkap.";
                //header('location:' . URL . 'kontrak/editBiaya/' . $biaya->kd_biaya);
                echo '<script> alert("Isian form belum lengkap") </script>';
                echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
            }
        } else {
            header('location:' . URL . 'kontrak/display');
        }
    }

    //melakukan proses update biaya pada halaman edit_biaya dengan ajax
    public function updateBiaya2() {
        if (isset($_POST['update_biaya'])) {
            $biaya = new Biaya();
            $biaya->kd_biaya = $_POST['kd_biaya'];
            $biaya->kd_kontrak = $_POST['kd_kontrak'];
            $biaya->nama_biaya = $_POST['nama_biaya'];
            $biaya->biaya_per_pegawai = str_replace(',', '', $_POST['biaya_per_peg']);
            $biaya->jml_pegawai_bayar = $_POST['jml_peg'];
            $biaya->jadwal_bayar = date('Y-m-d', strtotime($_POST['jadwal_bayar']));
            $biaya->jml_biaya = str_replace(',', '', $_POST['jml_biaya']);
            $biaya_current = $biaya->get_by_id($biaya->kd_biaya);
            $biaya->status_bayar = $biaya_current->status_bayar;  //untuk mendapatkan status bayar terkini
            if ($biaya->isEmptyBiaya($biaya) == false) {
                if (Validasi::validate_number($biaya->biaya_per_pegawai) == TRUE &&
                        Validasi::validate_number($biaya->jmlh_pegawai_bayar) == TRUE &&
                        Validasi::validate_number($biaya->jumlah_biaya) == TRUE) {
                    $biaya->updateBiaya($biaya);
                    $respon = "sukses";
                } else {
                    $respon = "gagal";
                }
            } else {
                $respon = "gagal";
            }
            $res = array('respon' => $respon);
            echo json_encode($res);
        } else {
            header('location:' . URL . 'kontrak/display');
        }
    }

    //melakukan proses update tagihan pada halaman edit_biaya
    public function updateTagihan() {
        if (isset($_POST['update_tagihan'])) {
            //sleep(1);
            $biaya = new Biaya();
			$biaya->kd_kontrak = $_POST['kd_kontrak'];
            $biaya->kd_biaya = $_POST['kd_biaya'];
            $biaya->no_bast = $_POST['no_bast'];
            $biaya->tgl_bast = date('Y-m-d', strtotime($_POST['tgl_bast']));
            $biaya->no_bap = $_POST['no_bap'];
            $biaya->tgl_bap = date('Y-m-d', strtotime($_POST['tgl_bap']));
            $biaya->no_ring_kontrak = $_POST['no_ring_kon'];
            $biaya->tgl_ring_kontrak = date('Y-m-d', strtotime($_POST['tgl_ring_kon']));
            $biaya->no_kuitansi = $_POST['no_kuitansi'];
            $biaya->tgl_kuitansi = date('Y-m-d', strtotime($_POST['tgl_kuitansi']));
            $biaya->jml_pegawai_bayar = $_POST['jml_peg'];

            if ($_FILES['file_bast']['name'] != "") {
                $biaya->file_bast = $_FILES['file_bast']['name'];
            } else {
                if ($_POST['file_bast_lama'] != "") {
                    $biaya->file_bast = $_POST['file_bast_lama'];
                } else {
                    $biaya->file_bast = "";
                }
            }

            if ($_FILES['file_bap']['name'] != "") {
                $biaya->file_bap = $_FILES['file_bap']['name'];
            } else {
                if ($_POST['file_bap_lama'] != "") {
                    $biaya->file_bap = $_POST['file_bap_lama'];
                } else {
                    $biaya->file_bap = "";
                }
            }

            if ($_FILES['file_ring_kon']['name'] != "") {
                $biaya->file_ring_kontrak = $_FILES['file_ring_kon']['name'];
            } else {
                if ($_POST['file_bap_lama'] != "") {
                    $biaya->file_ring_kontrak = $_POST['file_ring_kon_lama'];
                } else {
                    $biaya->file_ring_kontrak = "";
                }
            }

            if ($_FILES['file_kuitansi']['name'] != "") {
                $biaya->file_kuitansi = $_FILES['file_kuitansi']['name'];
            } else {
                if ($_POST['file_kuitansi_lama'] != "") {
                    $biaya->file_kuitansi = $_POST['file_kuitansi_lama'];
                } else {
                    $biaya->file_kuitansi = "";
                }
            }

            $biaya_current = $biaya->get_by_id($biaya->kd_biaya);
            $biaya->status_bayar = $biaya_current->status_bayar;  //untuk mendapatkan status bayar terkini
            //var_dump($biaya);
            if ($biaya->isEmptyTagihan($biaya) == false) {
                //echo "terisi";
                //exit();
                $penerima_biaya_kontrak = new PenerimaBiayaKontrak();
                $penerima_biaya = $penerima_biaya_kontrak->get_by_biaya($biaya->kd_biaya);
                //echo count($penerima_biaya);
                //echo $biaya->jml_pegawai_bayar;
                //exit();
                    $upload = new Upload();
                    if ($_FILES['file_bast']['name'] != "") {
                        $upload->init('file_bast');
                        $upload->setDirTo('files/bast/');
                        $nama = array($biaya->no_bast, $biaya->tgl_bast);
                        $upload->uploadFile2("", $nama);
                        $biaya->file_bast = $upload->getFileTo();
						if($_POST['file_bast_lama']!=""){
							$file1 = "files/bast/" . $_POST['file_bast_lama'];
							//echo $file;
							if (file_exists($file1)) {
							unlink($file1);
							}
						}
                    }

                    if ($_FILES['file_bap']['name'] != "") {
                        $upload->init('file_bap');
                        $upload->setDirTo('files/bap/');
                        $nama = array($biaya->no_bap, $biaya->tgl_bap);
                        $upload->uploadFile2("", $nama);
                        $biaya->file_bap = $upload->getFileTo();
						if($_POST['file_bap_lama']!=""){
							$file2 = "files/bap/" . $_POST['file_bap_lama'];
							//echo $file;
							if (file_exists($file2)) {
							unlink($file2);
							}
						}
                    }

                    if ($_FILES['file_ring_kon']['name'] != "") {
                        $upload->init('file_ring_kon');
                        $upload->setDirTo('files/ringkasan_kontrak/');
                        $nama = array($biaya->no_ring_kontrak, $biaya->tgl_ring_kontrak);
                        $upload->uploadFile2("", $nama);
                        $biaya->file_ring_kontrak = $upload->getFileTo();
						if($_POST['file_ring_kon__lama']!=""){
							$file3 = "files/ringkasan_kontrak/" . $_POST['file_ring_kon_lama'];
							//echo $file;
							if (file_exists($file3)) {
							unlink($file3);
							}
						}
                    }

                    if ($_FILES['file_kuitansi']['name'] != "") {
                        $upload->init('file_kuitansi');
                        $upload->setDirTo('files/kwitansi/');
                        $nama = array($biaya->no_kuitansi, $biaya->tgl_kuitansi);
                        $upload->uploadFile2("", $nama);
                        $biaya->file_kuitansi = $upload->getFileTo();
						if($_POST['file_kuitansi_lama']!=""){
							$file4 = "files/kwitansi/" . $_POST['file_kuitansi_lama'];
							//echo $file;
							if (file_exists($file4)) {
							unlink($file4);
							}
						}
                    }
                    $biaya->updateTagihan($biaya);
					
					$penerima = $_POST['penerima'];					
					$penerima_biaya = new PenerimaBiayaKontrak();	 
					
					//menghapus data penerima biaya berdasarkan kd_biaya
					$penerima_biaya->deleteByBiaya($biaya->kd_biaya);

					//menambahkan data penerima biaya berdasrkan ceklist.
					$penerima_biaya->kd_biaya = $biaya->kd_biaya;
					foreach ($penerima as $pb) {
						$penerima_biaya->kd_penerima_beasiswa = $pb;
						$penerima_biaya->add($penerima_biaya);
					}
					
					ClassLog::write_log("kontrak","simpan tagihan biaya kontrak","kode biaya ".$biaya->kd_biaya."kode kontrak".$biaya->kd_kontrak);
					
                    //$url = URL . 'kontrak/editBiaya/' . $biaya->kd_biaya."/1";
					$url = URL . 'kontrak/biaya/' . $biaya->kd_kontrak;
                    echo '<script> alert("Data tagihan berhasil disimpan") </script>';
                    echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
                
            } else {
                //echo "kosong";
                //header('location:' . URL . 'kontrak/editBiaya/'.$biaya->kd_biaya);
                $url = URL . 'kontrak/editBiaya/' . $biaya->kd_biaya."/1";
                echo '<script> alert("Isian form belum lengkap") </script>';
                echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
            }
        } else {
            header('location:' . URL . 'kontrak/display');
        }
    }

    //melakukan proses update pembayaran tagihan pada halaman edit_biaya
    public function updatePembayaran() {
        //sleep(1);
        if (isset($_POST['update_pembayaran'])) {
            $biaya = new Biaya();
			$biaya->kd_kontrak = $_POST['kd_kontrak'];
            $biaya->kd_biaya = $_POST['kd_biaya'];
            $biaya->no_sp2d = $_POST['no_sp2d'];
            $biaya->tgl_sp2d = date('Y-m-d', strtotime($_POST['tgl_sp2d']));
            if ($_FILES['file_sp2d']['name'] != "") {
                $biaya->file_sp2d = $_FILES['file_sp2d']['name'];
            } else {
                if ($_POST['file_sp2d_lama'] != "") {
                    $biaya->file_sp2d = $_POST['file_sp2d_lama'];
                } else {
                    $biaya->file_sp2d = "";
                }
            }

            $biaya_current = $biaya->get_by_id($biaya->kd_biaya);
            $biaya->status_bayar = $biaya_current->status_bayar;  //untuk mendapatkan status bayar terkini
            if ($biaya->status_bayar == "belum") {
                //header('location:' . URL . 'kontrak/editBiaya/'.$biaya->kd_biaya);
                $url = URL . 'kontrak/editBiaya/' . $biaya->kd_biaya."/2";
//                header("refresh:1;url=" . $url);
//                echo "Data tagihan biaya belum diisi.";
                echo '<script> alert("Data tagihan biaya belum diisi") </script>';
                echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
            } else {
                if ($biaya->isEmptyPembayaran($biaya) == false) {
                    $upload = new Upload();
                    if ($_FILES['file_sp2d']['name'] != "") {
                        $upload->init('file_sp2d');
                        $upload->setDirTo('files/sp2d/');
                        $nama = array($biaya->no_sp2d, $biaya->tgl_sp2d);
                        $upload->uploadFile2("", $nama);
                        $biaya->file_sp2d = $upload->getFileTo();
						if($_POST['file_sp2d_lama']!=""){
							$file = "files/sp2d/" . $_POST['file_sp2d_lama'];
							//echo $file;
							if (file_exists($file)) {
							unlink($file);
							}
						}
                    }
                    $biaya->updatePembayaranTagihan($biaya);
					ClassLog::write_log("kontrak","simpan pembayaran biaya kontrak","kode biaya ".$biaya->kd_biaya."kode kontrak".$biaya->kd_kontrak);
					
                    //$url = URL . 'kontrak/editBiaya/' . $biaya->kd_biaya."/2";
					$url = URL . 'kontrak/biaya/' . $biaya->kd_kontrak;
                    echo '<script> alert("Data Pembayaran tagihan berhasil disimpan") </script>';
                    echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
                } else {
                    //header('location:' . URL . 'kontrak/editBiaya/'.$biaya->kd_biaya);
					
                    $url = URL . 'kontrak/editBiaya/' . $biaya->kd_biaya."/2"; //angka 2 menunjukan id tab dari pembayaran 
                    echo '<script> alert("Isian form pembayaran tagihan biaya belum lengkap") </script>';
                    echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
                }
            }
        } else {
            header('location:' . URL . 'kontrak/display');
        }
    }

    //menghapus data biaya berdasarkan id=kd_biaya pada halaman data_biaya
    public function delBiaya($id = null) {
		if(Session::get('role')!=2){
			$this->display();
			exit();
		}
        if ($id != "") {
            $biaya = new Biaya();
            $data = $biaya->get_by_id($id);
            $biaya->deleteBiaya($id);
			ClassLog::write_log("kontrak","hapus biaya kontrak","kode biaya ".$id."kode kontrak".$data->kd_kontrak);
					

            //echo $data->kd_kontrak;
        }
        header("Location:" . URL . "kontrak/biaya/" . $data->kd_kontrak);
    }

    //menampilkan data pb pada tabel_tagihan_pb di form_edit_tagihan yang telah masuk tagihan kontrak
    public function getTagihanPbByBiaya() {
       		
		 if (isset($_POST['kd_kontrak']) && isset($_POST['kd_biaya'])) {
            $kontrak = new Kontrak();
            $data_kontrak = $kontrak->get_by_id($_POST['kd_kontrak']);
            $penerima = new Penerima($this->registry);
            $pb = $penerima->get_penerima_by_kd_jur_thn_masuk($data_kontrak->kd_jurusan, $data_kontrak->thn_masuk_kontrak);
            $penerima_biaya = new PenerimaBiayaKontrak();
            $this->view->pb = $pb;
            $this->view->penerima_biaya = $penerima_biaya;
            $this->view->kd_biaya = $_POST['kd_biaya'];
            $this->view->load('kontrak/tabel_tagihan_pb');
        }
    }
	
	//menampilkan form add_pb_to_tagihan_dialog untuk dialog menambahkan pb ke tagihan di form_edit_tagihan
    public function viewAddTagihanPb() {
        if (isset($_POST['kd_kontrak']) && isset($_POST['kd_biaya'])) {
            $kontrak = new Kontrak();
            $data_kontrak = $kontrak->get_by_id($_POST['kd_kontrak']);
            $penerima = new Penerima($this->registry);
            $pb = $penerima->get_penerima_by_kd_jur_thn_masuk($data_kontrak->kd_jurusan, $data_kontrak->thn_masuk_kontrak);
            $penerima_biaya = new PenerimaBiayaKontrak();
            $this->view->pb = $pb;
            $this->view->penerima_biaya = $penerima_biaya;
            $this->view->kd_biaya = $_POST['kd_biaya'];
            $this->view->load('kontrak/add_pb_to_tagihan_dialog');
        }
    }

    //melakukan validasi jumlah penerima biaya dengan jml pegawai yang dibayarkan
    public function cekTagihanPbByBiaya() {
        if (isset($_POST['kd_biaya'])) {
            $kd_biaya = $_POST['kd_biaya'];
            $penerima_biaya_kontrak = new PenerimaBiayaKontrak();
            $penerima_biaya = $penerima_biaya_kontrak->get_by_biaya($kd_biaya);

            $biaya = new Biaya();
            $data_biaya = $biaya->get_by_id($kd_biaya);
            //var_dump($penerima_biaya);
            if (count($penerima_biaya) == $data_biaya->jml_pegawai_bayar) {
                $hasil = true;
            } else {
                $hasil = false;
            }
            echo json_encode(array('respon' => $hasil));
        }
    }

    //menghapus data tagihan pb yang telah masuk ke tagihan kontrak pada tabel_tagihan_pb
    public function delTagihanPb() {
        if (isset($_POST['kd_penerima_biaya'])) {
            $penerima_biaya_kontrak = new PenerimaBiayaKontrak();
            $penerima_biaya_kontrak->delete($_POST['kd_penerima_biaya']);

            //echo $data->kd_kontrak;
        }
    }
	
    
    //melakukan proses penambahan pb ke dalam data tagihan biaya kontrak
    public function addTagihanPb() {
        if (isset($_POST['penerima']) && isset($_POST['kd_biaya'])) {
            $penerima = $_POST['penerima'];
            $penerima_biaya = new PenerimaBiayaKontrak();
            $penerima_biaya->kd_biaya = $_POST['kd_biaya'];
            //print_r($penerima);
            //print_r($_POST['kd_biaya']);
            foreach ($penerima as $pb) {
                $penerima_biaya->kd_penerima_beasiswa = $pb;
                $penerima_biaya->add($penerima_biaya);
            }
            //echo "sukses";
            $hasil = array('respon' => "sukses");
            echo json_encode($hasil);
        }
    }

    public function monitoring() {
        $universitas = new Universitas($this->registry);
        $kd_user = Session::get('kd_user');
        if(Session::get('role')==2){
			$univ = $universitas->get_univ_by_pic($kd_user);
		}
		if(Session::get('role')==3){
			$univ = $universitas->get_univ();
		}
        $this->view->univ = $univ;
        $this->view->render('kontrak/mon_pembayaran');
    }

    //menampilkan tabel biaya kontrak
    public function dataBiayaKontrak() {
        if (isset($_POST['univ']) && isset($_POST['status']) && isset($_POST['jadwal'])) {
            $univ = $_POST['univ'];
            //print_r ($univ);
            $status = $_POST['status'];
            $tahun = $_POST['jadwal'];
            //print_r ($tahun);
            $user = Session::get('kd_user');
            $biaya = new Biaya();
			if(Session::get('role')==2){
				$data_biaya = $biaya->get_by_filter($univ, $status, $tahun, $user);
			}
			if(Session::get('role')==3){
				$data_biaya = $biaya->get_by_filter($univ, $status, $tahun);
			}
            
            $universitas = new Universitas($this->registry);
            $jurusan = new Jurusan($this->registry);
            $kontrak = new Kontrak();
            $this->view->universitas = $universitas;
            $this->view->jurusan = $jurusan;
            $this->view->kontrak = $kontrak;
            $this->view->biaya = $biaya;
            //echo "aaaa";
            //var_dump($biaya);
			
			if(isset($_POST['cur_page'])){
			$cur_page = $_POST['cur_page'];
			} else {
			$cur_page = 1;
			}
			$paging = new MyPaging($cur_page, $data_biaya);
			$this->view->cur_page = $paging->getCurPage();
			$this->view->per_page = $paging->getPerPage();
			$this->view->page_num = $paging->getPageNum();
            $this->view->data_biaya = $paging->getData();
            $this->view->load('kontrak/tabel_biaya');
        }
    }

    //menampilkan cetak biaya kontrak
    public function cetakBiayaKontrak() {
        if (isset($_POST['univ']) && isset($_POST['status']) && isset($_POST['jadwal'])) {
            $univ = $_POST['univ'];
            //print_r ($univ);
            $status = $_POST['status'];
            $tahun = $_POST['jadwal'];
            //print_r ($tahun);
            $biaya = new Biaya();
            $user = Session::get('kd_user');
            $biaya = new Biaya();
            if(Session::get('role')==2){
				$data_biaya = $biaya->get_by_filter($univ, $status, $tahun, $user);
			}
			if(Session::get('role')==3){
				$data_biaya = $biaya->get_by_filter($univ, $status, $tahun);
			}

            $universitas = new Universitas($this->registry);
            $universitas->set_kode_in($univ);
            $data_univ = $universitas->get_univ_by_id($universitas);
            $jurusan = new Jurusan($this->registry);
            $kontrak = new Kontrak();
            $this->view->universitas = $universitas;
            $this->view->jurusan = $jurusan;
            $this->view->kontrak = $kontrak;
            $this->view->biaya = $biaya;
            $this->view->univ = $univ;
            $this->view->data_univ = $data_univ;
            $this->view->status = $status;
            $this->view->jadwal = $tahun;
            //var_dump($biaya);
            $this->view->data_biaya = $data_biaya;
            $this->view->load('kontrak/cetak_biaya_kontrak');
        }
    }

    public function file($file = null) {
        if ($file != "") {
            header("Location:" . URL . "files/kontrak/" . $file);
        }
    }

    public function fileBast($file = null) {
        if ($file != "") {
            header("Location:" . URL . "files/bast/" . $file);
        }
    }

    public function fileBap($file = null) {
        if ($file != "") {
            header("Location:" . URL . "files/bap/" . $file);
        }
    }

    public function fileRingKontrak($file = null) {
        if ($file != "") {
            header("Location:" . URL . "files/ringkasan_kontrak/" . $file);
        }
    }

    public function fileKuitansi($file = null) {
        if ($file != "") {
            header("Location:" . URL . "files/kwitansi/" . $file);
        }
    }

    public function fileSp2d($file = null) {
        if ($file != "") {
            header("Location:" . URL . "files/sp2d/" . $file);
        }
    }

    public function get_method() {
        $method = get_class_methods($this);
        foreach ($method as $method) {
            print_r("\$akses['pic']['" . get_class($this) . "']['" . $method . "'];</br>");
        }
    }

}

?>
