<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class elemenBeasiswaController extends BaseController {

    public function __construct($registry) {
        parent::__construct($registry);
    }
	

    public function index() {
        $univ = new Universitas($this->registry);
        $user = Session::get('kd_user');      
		if(Session::get('role')==2){
				$univ2 = $univ->get_univ_by_pic($user);
			}
		else{
				$univ2 = $univ->get_univ();
			}
        $this->view->univ = $univ2;
        
        $this->view->render('bantuan/mon_pembayaran');
    }

    public function data_index_mon() {
		//var_dump($_POST);
        if (isset($_POST['univ']) && isset($_POST['jurusan']) && isset($_POST['tahun']) && isset($_POST['sts'])) {
            //print_r($_POST['univ']);
            $univ = $_POST['univ'];
            $jurusan = $_POST['jurusan'];
            $tahun = $_POST['tahun'];
            $sts = $_POST['sts'];
            $user = Session::get('kd_user');

            $elem = new ElemenBeasiswa($this->registry);
            
			if(Session::get('role')==2){
				$data = $elem->get_list_elem($univ, $jurusan, $tahun, $sts, $user);
			} else {
				$data = $elem->get_list_elem($univ, $jurusan, $tahun, $sts);
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
            $this->view->jurusan = new Jurusan($this->registry);
            $this->view->pb = new Penerima($this->registry);
            $this->view->load('bantuan/tabel_index_mon_pembayaran');
        }
    }

    public function cetak_jadup($id = null) {
        if ($id != "") {
            $elem = new ElemenBeasiswa($this->registry);
            $elem->set_kd_d($id);
            $data_elemen = $elem->get_elem_by_id($elem);
            $this->view->elemen = $data_elemen;

            $penerima_elemen = new PenerimaElemenBeasiswa();
            $data_penerima_elemen = $penerima_elemen->get_by_elemen($id);
            $this->view->penerima_elemen = $data_penerima_elemen;

            $this->view->pb = new Penerima($this->registry);

            $bank = new Bank($this->registry);

            $universitas = new Universitas($this->registry);
            $data_univ = $universitas->get_univ_by_jur($data_elemen->get_kd_jur());

            $jurusan = new Jurusan($this->registry);
            $jurusan->set_kode_jur($data_elemen->get_kd_jur());
            $data_jurusan = $jurusan->get_jur_by_id($jurusan);

            $pejabat = new Pejabat();
            $ppk = $pejabat->get_by_jabatan("1");
            $pj = $pejabat->get_by_jabatan("2");
            $bdr = $pejabat->get_by_jabatan("3");

            $strata = new Strata();
            $data_strata = $strata->get_by_id($data_jurusan->get_kode_strata());

            $this->view->univ = $data_univ;
            $this->view->jur = $data_jurusan;
            $this->view->strata = $data_strata;
            $this->view->ppk = $ppk;
            $this->view->pj = $pj;
            $this->view->bdr = $bdr;
            $this->view->bank = $bank;
            $this->view->load('bantuan/cetak_jadup');
        }
    }

    public function cetak_ubuku($id = null) {
        if ($id != "") {
            $elem = new ElemenBeasiswa($this->registry);
            $elem->set_kd_d($id);
            $data_elemen = $elem->get_elem_by_id($elem);
            $this->view->elemen = $data_elemen;

            $penerima_elemen = new PenerimaElemenBeasiswa();
            $data_penerima_elemen = $penerima_elemen->get_by_elemen($id);
            $this->view->penerima_elemen = $data_penerima_elemen;

            $this->view->pb = new Penerima($this->registry);

            $bank = new Bank($this->registry);

            $universitas = new Universitas($this->registry);
            $data_univ = $universitas->get_univ_by_jur($data_elemen->get_kd_jur());

            $jurusan = new Jurusan($this->registry);
            $jurusan->set_kode_jur($data_elemen->get_kd_jur());
            $data_jurusan = $jurusan->get_jur_by_id($jurusan);

            $pejabat = new Pejabat();
            $ppk = $pejabat->get_by_jabatan("1");
            $pj = $pejabat->get_by_jabatan("2");
            $bdr = $pejabat->get_by_jabatan("3");

            $strata = new Strata();
            $data_strata = $strata->get_by_id($data_jurusan->get_kode_strata());

            $this->view->univ = $data_univ;
            $this->view->jur = $data_jurusan;
            $this->view->strata = $data_strata;
            $this->view->ppk = $ppk;
            $this->view->pj = $pj;
            $this->view->bdr = $bdr;
            $this->view->bank = $bank;
            $this->view->load('bantuan/cetak_ubuku');
        }
    }

    public function cetak_uskripsi($id = null) {
        if ($id != "") {
            $elem = new ElemenBeasiswa($this->registry);
            $elem->set_kd_d($id);
            $data_elemen = $elem->get_elem_by_id($elem);
            $this->view->elemen = $data_elemen;

            $penerima_elemen = new PenerimaElemenBeasiswa();
            $data_penerima_elemen = $penerima_elemen->get_by_elemen($id);
            $this->view->penerima_elemen = $data_penerima_elemen;

            $this->view->pb = new Penerima($this->registry);

            $bank = new Bank($this->registry);

            $universitas = new Universitas($this->registry);
            $data_univ = $universitas->get_univ_by_jur($data_elemen->get_kd_jur());

            $jurusan = new Jurusan($this->registry);
            $jurusan->set_kode_jur($data_elemen->get_kd_jur());
            $data_jurusan = $jurusan->get_jur_by_id($jurusan);

            $pejabat = new Pejabat();
            $ppk = $pejabat->get_by_jabatan("1");
            $pj = $pejabat->get_by_jabatan("2");
            $bdr = $pejabat->get_by_jabatan("3");

            $strata = new Strata();
            $data_strata = $strata->get_by_id($data_jurusan->get_kode_strata());

            $this->view->univ = $data_univ;
            $this->view->jur = $data_jurusan;
            $this->view->strata = $data_strata;
            $this->view->ppk = $ppk;
            $this->view->pj = $pj;
            $this->view->bdr = $bdr;
            $this->view->bank = $bank;
            $this->view->load('bantuan/cetak_uskripsi');
        }
    }

    public function cetak_mon_pembayaran() {
        if (isset($_POST['universitas']) && isset($_POST['jurusan']) && isset($_POST['tahun_masuk']) && isset($_POST['sts'])) {
            //print_r($_POST['univ']);
            $elem = new ElemenBeasiswa($this->registry);
            $univ = $_POST['universitas'];
            $jur = $_POST['jurusan'];
            $tahun = $_POST['tahun_masuk'];
            $sts = $_POST['sts'];
            $universitas = new Universitas($this->registry);
            $universitas->set_kode_in($univ);
            $data_univ = $universitas->get_univ_by_id($universitas);
            //var_dump($data_univ);

            $jurusan = new Jurusan($this->registry);
            $jurusan->set_kode_jur($jur);
            $data_jur = $jurusan->get_jur_by_id($jurusan);
            $this->view->universitas = $data_univ;
            $this->view->jurusan = $jurusan;
            $this->view->data_jurusan = $data_jur;
            $this->view->pb = new Penerima($this->registry);
            $user = Session::get('kd_user');
            
			if(Session::get('role')==2){
				$data = $elem->get_list_elem($univ, $jur, $tahun, $sts, $user);
			}
			else{
				$data = $elem->get_list_elem($univ, $jur, $tahun, $sts);
			}
			$this->view->data = $data;
            $this->view->univ = $univ;
            $this->view->jur = $jur;
            $this->view->tahun = $tahun;
            $this->view->sts = $sts;
            $this->view->load('bantuan/cetak_mon_pembayaran');
        }
    }

    public function viewJadup() {

        $univ = new Universitas($this->registry);
        $user = Session::get('kd_user');
		if(Session::get('role')==2){
				$data = $univ->get_univ_by_pic($user);
			}
		else{
				$data = $univ->get_univ();
			}
        $this->view->univ = $data;
        $this->view->render('bantuan/jadup');
    }

    public function data_index_jadup() {

        if (isset($_POST['univ']) && isset($_POST['jurusan']) && isset($_POST['tahun'])) {
            //tinggal nambahin filter di get_elem_jadup
            $univ = $_POST['univ'];
            $jurusan = $_POST['jurusan'];
            $tahun = $_POST['tahun'];
            $user = Session::get('kd_user');
            $elem = new ElemenBeasiswa();
			if(Session::get('role')==2){
				$data_jadup = $elem->get_elem_jadup($univ, $jurusan, $tahun, $user);
			}
			else{
				$data_jadup = $elem->get_elem_jadup($univ, $jurusan, $tahun);
			}
			if(isset($_POST['cur_page'])){
			$cur_page = $_POST['cur_page'];
			} else {
				$cur_page = 1;
			}
			$paging = new MyPaging($cur_page, $data_jadup);
			$this->view->cur_page = $paging->getCurPage();
			$this->view->per_page = $paging->getPerPage();
			$this->view->page_num = $paging->getPageNum();
            $this->view->elem = $paging->getData();

            $this->view->load('bantuan/tabel_index_jadup');
        }
    }

    public function data_index_jadup2() {
        if (isset($_POST['sp2d'])) {
            //tinggal nambahin filter di get_elem_jadup
            $sp2d = $_POST['sp2d'];
            $elem = new ElemenBeasiswa();
            //echo $univ;
            //echo $jurusan;
            //echo $tahun;
            $user = Session::get('kd_user');
            $jadup = $elem->get_elem_jadup_by_sp2d($sp2d, $user);
            //var_dump($buku);
            $this->view->elem = $jadup;
            $this->view->load('bantuan/tabel_index_jadup');
        }
    }

    public function tabel_penerima_jadup() {

        if (isset($_POST['kd_jurusan']) && isset($_POST['thn_masuk']) && $_POST['kd_jurusan'] != "" && $_POST['thn_masuk'] != "") {
            $kd_jur = $_POST['kd_jurusan'];
            $thn_masuk = $_POST['thn_masuk'];
            $pb = new Penerima($this->registry);
            $data_pb = $pb->get_penerima_by_kd_jur_thn_masuk($kd_jur, $thn_masuk);
            $bank = new Bank($this->registry);
            $this->view->penerima_elemen = new PenerimaElemenBeasiswa();
            $this->view->bln = $_POST['bln'];
            $this->view->thn = $_POST['thn'];
            $this->view->bank = $bank;
            $this->view->pb = $data_pb;
            $this->view->load('bantuan/tabel_penerima_jadup');
        }
    }

    public function addJadup() {
		if(Session::get('role')!=2){
			$this->viewJadup();
			exit();
		}
        $univ = new Universitas($this->registry);
        $user = Session::get('kd_user');
        $this->view->univ = $univ->get_univ_by_pic($user);
        $this->view->render('bantuan/rekam_jadup');
    }

    public function saveJadup() {
		
        if (isset($_POST['rekam_jadup'])) { //if 1
            if (isset($_POST['js']) && $_POST['js'] == 1) {
                header('location:' . URL . 'elemenBeasiswa/viewJadup');
            }
//            var_dump($_POST);
//            exit();
            if ($_POST['jml_peg'] != "" && $_POST['r_elem'] != "" && $_POST['kode_jur'] != "" &&
                    $_POST['tahun_masuk'] != "" && $_POST['biaya_peg'] != "" && $_POST['total_bayar'] != "" &&
                    $_POST['bln'] != "" && $_POST['thn'] != "") { //if 2
                $elem = new ElemenBeasiswa();
                $jml_peg = $_POST['jml_peg'];
                $elem->set_kd_r($_POST['r_elem']);
                $elem->set_kd_jur($_POST['kode_jur']);
                $elem->set_thn_masuk($_POST['tahun_masuk']);
                $elem->set_biaya_per_peg(str_replace(',', '', $_POST['biaya_peg']));
                $elem->set_bln($_POST['bln']);
                $elem->set_thn($_POST['thn']);
                $elem->set_total_bayar(str_replace(',', '', $_POST['total_bayar']));

                $jml = 0;
                for ($j = 1; $j <= $jml_peg; $j++) { //for
                    if ($_POST['setuju' . $j] != "") {
                        $jml++;
                    }
                } //end for

                $elem->set_jml_peg($jml);
                $kd_elemen_beasiswa = $elem->add_elem($elem);

                if ($kd_elemen_beasiswa != "") { //if 3
                    for ($i = 1; $i <= $jml_peg; $i++) {  // for
                        if ($_POST['setuju' . $i] != "") {  //if 4
                            $penerima_elemen = new PenerimaElemenBeasiswa();
                            $penerima_elemen->kd_elemen_beasiswa = $kd_elemen_beasiswa;
                            $penerima_elemen->kd_pb = $_POST['setuju' . $i];
                            $penerima_elemen->kehadiran = str_replace(',', '', $_POST['jml_hadir' . $i]);
                            $penerima_elemen->pajak = str_replace(',', '', $_POST['pajak' . $i]);

                            $penerima_elemen->add($penerima_elemen);
                        } //end if 4
                    } //end for
                } //end if 3
				ClassLog::write_log("elemen beasiswa","rekam jadup","kd_el.".$kd_elemen_beasiswa);
                //display success message and redirect 
                $url = URL . 'elemenBeasiswa/viewJadup';
                echo '<script> alert("Data berhasil disimpan") </script>';
                echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
            } //end if 2
            else {
                header('location:' . URL . 'elemenBeasiswa/addJadup');
            }
        } //end if 1
        else {
            header('location:' . URL . 'elemenBeasiswa/addJadup');
        }
    }

    //menghapus data jadup
    public function delJadup($id = null) {
		if(Session::get('role')!=2){
			$this->viewJadup();
			exit();
		}
        if ($id != "") {
            $elem = new ElemenBeasiswa($this->registry);
            //echo $id;
            $elem->set_kd_d($id);
            $elemen = $elem->get_elem_by_id($elem);
            $elem->delete_elem($id);

            $penerima_elemen = new PenerimaElemenBeasiswa();
            $penerima_elemen->delete($id);

            $file = "files/sp2d/" . $elemen->get_file_sp2d();
            //echo $file;
            if (file_exists($file)) {
                unlink($file);
            }
			ClassLog::write_log("elemen beasiswa","hapus jadup","kd_el.".$id);
			$url = URL . 'elemenBeasiswa/viewJadup';
			echo '<script> alert("Data berhasil dihapus") </script>';
			echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
        }

    }

    public function editJadup($id = null) {
		if(Session::get('role')!=2){
			$this->viewJadup();
			exit();
		}
        if ($id != "") {

            $elemen = new ElemenBeasiswa();
            $elemen->set_kd_d($id);
            $elemen2 = $elemen->get_elem_by_id($elemen);
            $this->view->elemen = $elemen2;

            $jur = new Jurusan($this->registry);
            $jur->set_kode_jur($elemen2->get_kd_jur());
            $jur2 = $jur->get_jur_by_id($jur);
            //var_dump($jur2);
            $this->view->jur = $jur2;

            $univ = new Universitas($this->registry);
            $univ2 = $univ->get_univ_by_jur($jur2->get_kode_jur());
            $this->view->univ = $univ2;

            $this->view->render('bantuan/ubah_jadup');
        } else {
            header('location:' . URL . 'elemenBeasiswa/viewJadup');
        }
    }

    public function tabel_penerima_jadup2() {

        if (isset($_POST['kd_jurusan']) && isset($_POST['thn_masuk']) && $_POST['kd_jurusan'] != "" && $_POST['thn_masuk'] != "") {
            $kd_jur = $_POST['kd_jurusan'];
            $thn_masuk = $_POST['thn_masuk'];
            $pb = new Penerima($this->registry);
            $bank = new Bank($this->registry);
            $penerima_elemen = new PenerimaElemenBeasiswa();
            $this->view->bank = $bank;
            $data_pb = $pb->get_penerima_by_kd_jur_thn_masuk($kd_jur, $thn_masuk);
            $this->view->penerima_elemen = $penerima_elemen;
            $this->view->bln = $_POST['bln'];
            $this->view->thn = $_POST['thn'];
            $this->view->kd_el = $_POST['kd_el'];
            $this->view->bank = $bank;
            $this->view->pb = $data_pb;
            $this->view->load('bantuan/tabel_penerima_jadup2');
        }
    }

    public function updateJadup() {
        if (isset($_POST['ubah_jadup'])) {
            if (isset($_POST['js']) && $_POST['js'] == 1) {
                header('location:' . URL . 'elemenBeasiswa/viewJadup');
                exit();
            }


            if ($_POST['jml_peg'] != "" && $_POST['r_elem'] != "" && $_POST['kode_jur'] != "" &&
                    $_POST['tahun_masuk'] != "" && $_POST['biaya_peg'] != "" && $_POST['total_bayar'] != "" &&
                    $_POST['bln'] != "" && $_POST['thn'] != "" && $_POST['kd_el'] != "") {

                $elem = new ElemenBeasiswa();
                $elem->set_kd_d($_POST['kd_el']);
                $jml_peg = $_POST['jml_peg'];
                $elem->set_kd_r($_POST['r_elem']);
                $elem->set_kd_jur($_POST['kode_jur']);
                $elem->set_thn_masuk($_POST['tahun_masuk']);
                $elem->set_biaya_per_peg(str_replace(',', '', $_POST['biaya_peg']));
                $elem->set_bln($_POST['bln']);
                $elem->set_thn($_POST['thn']);
                $elem->set_total_bayar(str_replace(',', '', $_POST['total_bayar']));
                $elem->set_no_sp2d($_POST['no_sp2d']);
                $elem->set_tgl_sp2d(date('Y-m-d', strtotime($_POST['tgl_sp2d'])));
                $jml = 0;
                for ($j = 1; $j <= $jml_peg; $j++) {
                    if ($_POST['setuju' . $j] != "") {
                        $jml++;
                    }
                }
                $elem->set_jml_peg($jml);

                $upload = new Upload();
                $upload->init('fupload');
                if ($upload->getFileName() != "") {
                    $upload->setDirTo("files/sp2d/");
                    $nama = array($elem->get_no_sp2d(), $elem->get_tgl_sp2d());
                    if ($upload->uploadFile2("", $nama) == false) {
                        $url = URL . 'elemenBeasiswa/editJadup/' . $elem->get_kd_d();
                        echo '<script> alert("File gagal diupload.") </script>';
                        echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
                        exit();
                    }
                    $elem->set_file_sp2d($upload->getFileTo());
                    //echo $upload->getFileName();

                    if ($_POST['fupload_lama'] != "") {
                        $file = "files/sp2d/" . $_POST['fupload_lama'];
                        //echo $file;
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                } else {
                    if ($_POST['fupload_lama'] != "") {
                        $elem->set_file_sp2d($_POST['fupload_lama']);
                        //echo $_POST['fupload_lama'];
                    } else {
                        $elem->set_file_sp2d("");
                    }
                }

                $elem->update_elem($elem);
                $penerima = new PenerimaElemenBeasiswa();
                $penerima->delete($elem->get_kd_d());
                for ($i = 1; $i <= $jml_peg; $i++) {
                    if ($_POST['setuju' . $i] != "") {
                        $penerima_elemen = new PenerimaElemenBeasiswa();
                        $penerima_elemen->kd_elemen_beasiswa = $elem->get_kd_d();
                        $penerima_elemen->kd_pb = $_POST['setuju' . $i];
                        $penerima_elemen->kehadiran = str_replace(',', '', $_POST['jml_hadir' . $i]);
                        $penerima_elemen->pajak = str_replace(',', '', $_POST['pajak' . $i]);
                        //if($penerima_elemen->kehadiran == 0 || $penerima_elemen->kehadiran == ""){
                        $penerima_elemen->add($penerima_elemen);
                    }
                    //}
                }
				ClassLog::write_log("elemen beasiswa","ubah jadup","kd_el.".$elem->get_kd_d()); 
                //$url = URL . 'elemenBeasiswa/editJadup/' . $elem->get_kd_d();
				$url = URL . 'elemenBeasiswa/viewJadup';
                echo '<script> alert("Data berhasil disimpan") </script>';
                echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
            } else {
                //echo "2";
                header('location:' . URL . 'elemenBeasiswa/viewJadup');
            }
        } else {
            //echo "3";
            header('location:' . URL . 'elemenBeasiswa/viewJadup');
        }
    }

    public function viewUangBuku() {

        $univ = new Universitas($this->registry);
        $user = Session::get('kd_user');
		if(Session::get('role')==2){
				$data = $univ->get_univ_by_pic($user);
			}
		else{
				$data = $univ->get_univ();
			}
        $this->view->univ = $data;

        $this->view->render('bantuan/buku');
    }

    public function data_index_buku() {

        if (isset($_POST['univ']) && isset($_POST['jurusan']) && isset($_POST['tahun'])) {
            //tinggal nambahin filter di get_elem_jadup
            $univ = $_POST['univ'];
            $jurusan = $_POST['jurusan'];
            $tahun = $_POST['tahun'];
			$user = Session::get('kd_user');
            $elem = new ElemenBeasiswa();
            
            if(Session::get('role')==2){
				$data_buku = $elem->get_elem_buku($univ, $jurusan, $tahun, $user);
			}
			else{
				$data_buku = $elem->get_elem_buku($univ, $jurusan, $tahun);
			}
			if(isset($_POST['cur_page'])){
			$cur_page = $_POST['cur_page'];
			} else {
				$cur_page = 1;
			}
			$paging = new MyPaging($cur_page, $data_buku);
			$this->view->cur_page = $paging->getCurPage();
			$this->view->per_page = $paging->getPerPage();
			$this->view->page_num = $paging->getPageNum();
            $this->view->buku = $paging->getData();
            $this->view->load('bantuan/tabel_index_buku');
        }
    }

    public function data_index_buku2() {

        if (isset($_POST['sp2d'])) {
            //tinggal nambahin filter di get_elem_jadup
            $sp2d = $_POST['sp2d'];
            $elem = new ElemenBeasiswa();
			$user = Session::get('kd_user');
            
            $buku = $elem->get_elem_buku_by_sp2d($sp2d, $user);
            //var_dump($buku);
            $this->view->buku = $buku;
            $this->view->load('bantuan/tabel_index_buku');
        }
    }

    public function tabel_penerima_buku() {
        if (isset($_POST['kd_jurusan']) && isset($_POST['thn_masuk']) && $_POST['kd_jurusan'] != "" && $_POST['thn_masuk'] != "") {
            $kd_jur = $_POST['kd_jurusan'];
            $thn_masuk = $_POST['thn_masuk'];
            $pb = new Penerima($this->registry);
            $data_pb = $pb->get_penerima_by_kd_jur_thn_masuk($kd_jur, $thn_masuk);
            $bank = new Bank($this->registry);
            $this->view->penerima_elemen = new PenerimaElemenBeasiswa();
            $this->view->semester = $_POST['semester'];
            $this->view->thn = $_POST['thn'];
            $this->view->bank = $bank;
            $this->view->pb = $data_pb;
            $this->view->load('bantuan/tabel_penerima_buku');
        }
    }

    public function addUangBuku($id = null) {
		if(Session::get('role')!=2){
			$this->viewUangBuku();
			exit();
		}
        $univ = new Universitas($this->registry);
        $user = Session::get('kd_user');
        $this->view->univ = $univ->get_univ_by_pic($user);
        $jur = new Jurusan($this->registry);
        $this->view->jur = $jur->get_jurusan();
        $ref_elem = new ReferensiElemenBeasiswa();
        $this->view->buku = $ref_elem->buku();

        $this->view->render('bantuan/rekam_buku');
    }

    public function saveUangBuku() {

        if (isset($_POST['rekam_buku'])) {
            if (isset($_POST['js']) && $_POST['js'] == 1) {
                header('location:' . URL . 'elemenBeasiswa/addUangBuku');
            }
            if ($_POST['setuju'] != "" && $_POST['r_elem'] != "" && $_POST['kode_jur'] != "" &&
                    $_POST['tahun_masuk'] != "" && $_POST['biaya_buku'] != "" && $_POST['total_bayar'] != "" &&
                    $_POST['semester'] != "" && $_POST['thn'] != "") {

                $elem = new ElemenBeasiswa();
                $pb = $_POST['setuju'];
                $jml_peg = count($pb);
                $elem->set_jml_peg($jml_peg);
                $elem->set_kd_r($_POST['r_elem']);
                $elem->set_kd_jur($_POST['kode_jur']);
                $elem->set_thn_masuk($_POST['tahun_masuk']);
                $elem->set_biaya_per_peg(str_replace(',', '', $_POST['biaya_buku']));
                $elem->set_bln($_POST['semester']);
                $elem->set_thn($_POST['thn']);
                $elem->set_total_bayar(str_replace(',', '', $_POST['total_bayar']));

                $kd_elemen_beasiswa = $elem->add_elem($elem);

                if ($kd_elemen_beasiswa != "") {
                    foreach ($pb as $val) {
                        $penerima_elemen = new PenerimaElemenBeasiswa();
                        $penerima_elemen->kd_elemen_beasiswa = $kd_elemen_beasiswa;
                        $penerima_elemen->kd_pb = $val;
                        $penerima_elemen->add($penerima_elemen);
                    }
                }
        		ClassLog::write_log("elemen beasiswa","rekam uang buku","kd_el.".$kd_elemen_beasiswa);
                //header('location:' . URL . 'elemenBeasiswa/viewUangBuku');
                $url = URL . 'elemenBeasiswa/viewUangBuku';
                echo '<script> alert("Data berhasil disimpan") </script>';
                echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
            } else {
                header('location:' . URL . 'elemenBeasiswa/addUangBuku');
            }
        } else {
            header('location:' . URL . 'elemenBeasiswa/addUangBuku');
        }
    }

    public function delUangBuku($id = null) {
		if(Session::get('role')!=2){
			$this->viewUangBuku();
			exit();
		}
        if ($id != "") {
            $elem = new ElemenBeasiswa($this->registry);
            //echo $id;
            $elem->delete_elem($id);

            $penerima_elemen = new PenerimaElemenBeasiswa();
            $penerima_elemen->delete($id);

            $elem->set_kd_d($id);
            $elemen = $elem->get_elem_by_id($elem);
            $file = "files/sp2d/" . $elemen->get_file_sp2d();
            //echo $file;
            if (file_exists($file)) {
                unlink($file);
            }
			
			ClassLog::write_log("elemen beasiswa","hapus uang buku","kd_el.".$id);
			$url = URL . 'elemenBeasiswa/viewUangBuku';
			echo '<script> alert("Data berhasil dihapus") </script>';
			echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
        }
        
    }

    public function editUangBuku($id = null) {
		if(Session::get('role')!=2){
			$this->viewUangBuku();
			exit();
		}
        if ($id != "") {

            $elemen = new ElemenBeasiswa();
            $elemen->set_kd_d($id);
            $elemen2 = $elemen->get_elem_by_id($elemen);
            $this->view->elemen = $elemen2;

            $jur = new Jurusan($this->registry);
            $jur->set_kode_jur($elemen2->get_kd_jur());
            $jur2 = $jur->get_jur_by_id($jur);
            //var_dump($jur2);
            $this->view->jur = $jur2;

            $univ = new Universitas($this->registry);
            $univ2 = $univ->get_univ_by_jur($jur2->get_kode_jur());
            $this->view->univ = $univ2;

            $this->view->render('bantuan/ubah_buku');
        } else {
            header('location:' . URL . 'elemenBeasiswa/viewUangBuku');
        }
    }

    public function updateUangBuku() {


        if (isset($_POST['ubah_buku'])) {
            if (isset($_POST['js']) && $_POST['js'] == 1) {
                header('location:' . URL . 'elemenBeasiswa/viewUangBuku');
            }

            if ($_POST['kd_el'] && $_POST['setuju'] != "" && $_POST['r_elem'] != "" && $_POST['kode_jur'] != "" &&
                    $_POST['tahun_masuk'] != "" && $_POST['biaya_buku'] != "" && $_POST['total_bayar'] != "" &&
                    $_POST['semester'] != "" && $_POST['thn'] != "") {
                $elem = new ElemenBeasiswa();
                $pb = $_POST['setuju'];
                $jml_peg = count($pb);
                $elem->set_kd_d($_POST['kd_el']);
                $elem->set_jml_peg($jml_peg);
                $elem->set_kd_r($_POST['r_elem']);
                $elem->set_kd_jur($_POST['kode_jur']);
                $elem->set_thn_masuk($_POST['tahun_masuk']);
                $elem->set_biaya_per_peg(str_replace(',', '', $_POST['biaya_buku']));
                $elem->set_bln($_POST['semester']);
                $elem->set_thn($_POST['thn']);
                $elem->set_total_bayar(str_replace(',', '', $_POST['total_bayar']));
                $elem->set_no_sp2d($_POST['no_sp2d']);
                $elem->set_tgl_sp2d(date('Y-m-d', strtotime($_POST['tgl_sp2d'])));

                //var_dump($elem);
                //echo $kd_elemen_beasiswa;
                //exit();     
                //var_dump($elem);
                $upload = new Upload();
                $upload->init('fupload');
                if ($upload->getFileName() != "") {
                    $upload->setDirTo("files/sp2d/");
                    $nama = array($elem->get_no_sp2d(), $elem->get_tgl_sp2d());
                    //$upload->uploadFile2("", $nama);
                    if ($upload->uploadFile2("", $nama) == false) {
                        $url = URL . 'elemenBeasiswa/viewJadup';
                        echo '<script> alert("File gagal diupload.") </script>';
                        echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
                        exit();
                    }

                    $elem->set_file_sp2d($upload->getFileTo());

                    if ($_POST['fupload_lama'] != "") {
                        $file = "files/sp2d/" . $_POST['fupload_lama'];
                        //echo $file;
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                    //echo $upload->getFileName();
                } else {
                    if ($_POST['fupload_lama'] != "") {
                        $elem->set_file_sp2d($_POST['fupload_lama']);
                        //echo $_POST['fupload_lama'];
                    } else {
                        $elem->set_file_sp2d("");
                    }
                }
                $elem->update_elem($elem);

                $penerima = new PenerimaElemenBeasiswa();
                $penerima->delete($elem->get_kd_d());
                foreach ($pb as $val) {
                    $penerima_elemen = new PenerimaElemenBeasiswa();
                    $penerima_elemen->kd_elemen_beasiswa = $elem->get_kd_d();
                    $penerima_elemen->kd_pb = $val;
                    $penerima_elemen->add($penerima_elemen);
                }
				ClassLog::write_log("elemen beasiswa","ubah uang buku","kd_el.".$elem->get_kd_d());
                //header('location:' . URL . 'elemenBeasiswa/viewUangBuku');
                $url = URL . 'elemenBeasiswa/viewUangBuku';
                echo '<script> alert("Data berhasil disimpan") </script>';
                echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
            } else {
                header('location:' . URL . 'elemenBeasiswa/editUangBuku/' . $elem->get_kd_d());
            }
        } else {
            header('location:' . URL . 'elemenBeasiswa/viewUangBuku');
        }
    }

    public function tabel_penerima_buku2() {

        if (isset($_POST['kd_jurusan']) && isset($_POST['thn_masuk']) && isset($_POST['kd_el']) && $_POST['kd_jurusan'] != "" && $_POST['thn_masuk'] != "" && $_POST['kd_el'] != "") {
            $kd_jur = $_POST['kd_jurusan'];
            $thn_masuk = $_POST['thn_masuk'];
            $pb = new Penerima($this->registry);
            $data_pb = $pb->get_penerima_by_kd_jur_thn_masuk($kd_jur, $thn_masuk);
            $bank = new Bank($this->registry);
            $penerima_elemen = new PenerimaElemenBeasiswa();
            $this->view->semester = $_POST['semester'];
            $this->view->thn = $_POST['thn'];
            $this->view->penerima_elemen = $penerima_elemen;
            $this->view->bank = $bank;
            $this->view->pb = $data_pb;
            $this->view->kd_el = $_POST['kd_el'];
            $this->view->load('bantuan/tabel_penerima_buku2');
        }
    }

    public function delPenerimaElemen() {
        if (isset($_POST['kd_el']) && isset($_POST['kd_pb'])) {

            $penerima_elemen = new PenerimaElemenBeasiswa();
            $penerima_elemen->delete2($_POST['kd_el'], $_POST['kd_pb']);
        }
    }

    public function viewSkripsi() {
        $univ = new Universitas($this->registry);
		$jur = new Jurusan($this->registry);
        $user = Session::get('kd_user');
		if(Session::get('role')==2){
				$data = $univ->get_univ_by_pic($user);
				$jurusan = $jur->get_jur_by_pic($user);
			}
		else{
				$data = $univ->get_univ();
				$jurusan = $jur->get_jurusan();
			}
         
        
        $myArray = array();
        foreach ($jurusan as $val2) {
            $st = new SuratTugas($this->registry);
            $thn = $st->get_thn_masuk_by_jur($val2->get_kode_jur());
            //var_dump($thn);
            foreach ($thn as $th) {
                $penerima = new Penerima($this->registry);
                $pb = $penerima->get_penerima_by_skripsi($val2->get_kode_jur(), $th);
                $jml = count($pb);
                //echo $jml;
                $un = new Universitas($this->registry);
                $c_univ = $un->get_univ_by_jur($val2->get_kode_jur());
                $penerima_elemen = new PenerimaElemenBeasiswa();
                $byr = $penerima_elemen->get_elemen_dibayar("3", $val2->get_kode_jur(), $th);
                //echo $byr;
                $pros = $penerima_elemen->get_elemen_proses_dibayar("3", $val2->get_kode_jur(), $th);
                //echo $pros;
                $arr = array('jur' => $val2->get_nama() . " " . $c_univ->get_kode(), 'thn' => $th, 'jml' => $jml, 'byr' => $byr, 'pros' => $pros);
                array_push($myArray, $arr);
            }
        }
        //var_dump($myArray);
        foreach ($myArray as $c => $key) {
            $sort_jur[] = $key['jur'];
            $sort_thn[] = $key['thn'];
            $sort_jml[] = $key['jml'];
            $sort_byr[] = $key['byr'];
            $sort_pros[] = $key['pros'];
        }
		
		if(!empty($myArray)){
			array_multisort($sort_thn, SORT_DESC, $myArray);
		}
        
		$this->view->univ = $data;
        $this->view->arr = $myArray;
        $this->view->render('bantuan/biaya_skripsi');
    }

    public function data_index_skripsi() {
        if (isset($_POST['univ']) && isset($_POST['jurusan']) && isset($_POST['tahun'])) {
            //tinggal nambahin filter di get_elem_jadup
            $univ = $_POST['univ'];
            $jurusan = $_POST['jurusan'];
            $tahun = $_POST['tahun'];
			$user = Session::get('kd_user'); 
            $elem = new ElemenBeasiswa();
			if(Session::get('role')==2){
				$data_skripsi = $elem->get_elem_skripsi($univ, $jurusan, $tahun, $user);
			}
			else{
				$data_skripsi = $elem->get_elem_skripsi($univ, $jurusan, $tahun);
			}
			if(isset($_POST['cur_page'])){
			$cur_page = $_POST['cur_page'];
			} else {
				$cur_page = 1;
			}
			$paging = new MyPaging($cur_page, $data_skripsi);
			$this->view->cur_page = $paging->getCurPage();
			$this->view->per_page = $paging->getPerPage();
			$this->view->page_num = $paging->getPageNum();
            			
			$this->view->skripsi = $paging->getData();
            $this->view->load('bantuan/tabel_index_skripsi');
        }
    }

    public function data_index_skripsi2() {
        if (isset($_POST['sp2d'])) {
            //tinggal nambahin filter di get_elem_jadup
            $sp2d = $_POST['sp2d'];
			$user = Session::get('kd_user');

            $elem = new ElemenBeasiswa();
            $this->view->skripsi = $elem->get_elem_skripsi_by_sp2d($sp2d, $user);

            $this->view->load('bantuan/tabel_index_skripsi');
        }
    }

    public function addSkripsi($id = null) {
		if(Session::get('role')!=2){
			$this->viewSkripsi();
			exit();
		}
        $univ = new Universitas($this->registry);
        $user = Session::get('kd_user');
        $this->view->univ = $univ->get_univ_by_pic($user);
        $this->view->render('bantuan/rekam_biaya_skripsi');
    }

    public function tabel_penerima_skripsi() {
        if (isset($_POST['kd_jurusan']) && isset($_POST['thn_masuk']) && $_POST['kd_jurusan'] != "" && $_POST['thn_masuk'] != "") {
            $kd_jur = $_POST['kd_jurusan'];
            $thn_masuk = $_POST['thn_masuk'];
            $pb = new Penerima($this->registry);
            $data_pb = $pb->get_penerima_by_kd_jur_thn_masuk($kd_jur, $thn_masuk);
            $bank = new Bank($this->registry);
            $this->view->penerima_el = new PenerimaElemenBeasiswa();
            $this->view->bank = $bank;
            $this->view->pb = $data_pb;
            $this->view->load('bantuan/tabel_penerima_skripsi');
        }

        if (isset($_POST['kd_jurusan']) && isset($_POST['thn_masuk']) && $_POST['kd_jurusan'] != "" && $_POST['thn_masuk'] == "") {
            $kd_jur = $_POST['kd_jurusan'];
            //$thn_masuk = $_POST['thn_masuk'];
            $pb = new Penerima($this->registry);
            $data_pb = $pb->get_penerima_by_kd_jur($kd_jur);
            $bank = new Bank($this->registry);
            $this->view->penerima_el = new PenerimaElemenBeasiswa();
            $this->view->bank = $bank;
            $this->view->pb = $data_pb;
            $this->view->load('bantuan/tabel_penerima_skripsi');
        }
    }

    public function saveUangSkripsi() {
        if (isset($_POST['rekam_uskripsi'])) {
            if (isset($_POST['js']) && $_POST['js'] == 1) {
                header('location:' . URL . 'elemenBeasiswa/viewSkripsi');
            }
            if ($_POST['setuju'] != "" && $_POST['r_elem'] != "" && $_POST['kode_jur'] != "" &&
                    $_POST['tahun_masuk'] != "" && $_POST['biaya_skripsi'] != "" &&
                    $_POST['total_bayar'] != "") {
                $elem = new ElemenBeasiswa();
                $pb = $_POST['setuju'];
                $jml_peg = count($pb);
                $elem->set_jml_peg($jml_peg);
                $elem->set_kd_r($_POST['r_elem']);
                $elem->set_kd_jur($_POST['kode_jur']);
                $elem->set_thn_masuk($_POST['tahun_masuk']);
                $elem->set_biaya_per_peg(str_replace(',', '', $_POST['biaya_skripsi']));
                $elem->set_total_bayar(str_replace(',', '', $_POST['total_bayar']));
//        $elem->set_no_sp2d($_POST['no_sp2d']);
//        $elem->set_tgl_sp2d(date('Y-m-d', strtotime($_POST['tgl_sp2d'])));
//        $elem->set_file_sp2d($_POST['fupload']);
                //var_dump($elem);
                //echo $kd_elemen_beasiswa;
                //exit();     
                //var_dump($elem);
                $kd_elemen_beasiswa = $elem->add_elem($elem);

                if ($kd_elemen_beasiswa != "") {
                    foreach ($pb as $val) {
                        $penerima_elemen = new PenerimaElemenBeasiswa();
                        $penerima_elemen->kd_elemen_beasiswa = $kd_elemen_beasiswa;
                        $penerima_elemen->kd_pb = $val;
                        $penerima_elemen->add($penerima_elemen);
                    }
                }
				ClassLog::write_log("elemen beasiswa","ubah uang penelitian","kd_el.".$kd_elemen_beasiswa);
                //header('location:' . URL . 'elemenBeasiswa/viewUangBuku');
                $url = URL . 'elemenBeasiswa/viewSkripsi';
                echo '<script> alert("Data berhasil disimpan") </script>';
                echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
            } else {
                header('location:' . URL . 'elemenBeasiswa/addSkripsi');
            }
        } else {
            header('location:' . URL . 'elemenBeasiswa/addSkripsi');
        }
    }

    public function delSkripsi($id = null) {
		if(Session::get('role')!=2){
			$this->viewSkripsi();
			exit();
		}
        if ($id != "") {
            $elem = new ElemenBeasiswa($this->registry);
            //echo $id;
            $elem->delete_elem($id);

            $penerima_elemen = new PenerimaElemenBeasiswa();
            $penerima_elemen->delete($id);
			
			ClassLog::write_log("elemen beasiswa","hapus uang penelitian","kd_el.".$id);
			$url = URL . 'elemenBeasiswa/viewSkripsi';
			echo '<script> alert("Data berhasil dihapus") </script>';
			echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
			
        }
        
    }

    public function editSkripsi($id = null) {
		if(Session::get('role')!=2){
			$this->viewSkripsi();
			exit();
		}
        if ($id != "") {

            $elemen = new ElemenBeasiswa();
            $elemen->set_kd_d($id);
            $elemen2 = $elemen->get_elem_by_id($elemen);
            $this->view->elemen = $elemen2;

            $jur = new Jurusan($this->registry);
            $jur->set_kode_jur($elemen2->get_kd_jur());
            $jur2 = $jur->get_jur_by_id($jur);
            //var_dump($jur2);
            $this->view->jur = $jur2;

            $univ = new Universitas($this->registry);
            $univ2 = $univ->get_univ_by_jur($jur2->get_kode_jur());
            $this->view->univ = $univ2;

            $this->view->render('bantuan/ubah_skripsi');
        } else {
            header('location:' . URL . 'elemenBeasiswa/viewSkripsi');
        }
    }

    public function tabel_penerima_skripsi2() {
        if (isset($_POST['kd_jurusan']) && isset($_POST['thn_masuk']) && $_POST['kd_jurusan'] != "" && $_POST['thn_masuk'] != "" && $_POST['kd_el'] != "") {
            $kd_jur = $_POST['kd_jurusan'];
            $thn_masuk = $_POST['thn_masuk'];
            $pb = new Penerima($this->registry);
            $data_pb = $pb->get_penerima_by_kd_jur_thn_masuk($kd_jur, $thn_masuk);
            $bank = new Bank($this->registry);
            $this->view->penerima_el = new PenerimaElemenBeasiswa();
            $this->view->kd_el = $_POST['kd_el'];
            $this->view->bank = $bank;
            $this->view->pb = $data_pb;
            $this->view->load('bantuan/tabel_penerima_skripsi2');
        }

        if (isset($_POST['kd_jurusan']) && isset($_POST['thn_masuk']) && $_POST['kd_jurusan'] != "" && $_POST['thn_masuk'] == "") {
            $kd_jur = $_POST['kd_jurusan'];
            //$thn_masuk = $_POST['thn_masuk'];
            $pb = new Penerima($this->registry);
            $data_pb = $pb->get_penerima_by_kd_jur($kd_jur);
            $bank = new Bank($this->registry);
            $this->view->penerima_el = new PenerimaElemenBeasiswa();
            $this->view->kd_el = $_POST['kd_el'];
            $this->view->bank = $bank;
            $this->view->pb = $data_pb;
            $this->view->load('bantuan/tabel_penerima_skripsi2');
        }
    }

    public function updateUangSkripsi() {
        if (isset($_POST['ubah_uskripsi'])) {
            if (isset($_POST['js']) && $_POST['js'] == 1) {
                header('location:' . URL . 'elemenBeasiswa/viewSkripsi');
            }

            if ($_POST['kd_el'] && $_POST['setuju'] != "" && $_POST['r_elem'] != "" && $_POST['kode_jur'] != "" &&
                    $_POST['tahun_masuk'] != "" && $_POST['biaya_skripsi'] != "" &&
                    $_POST['total_bayar'] != "") {
                $elem = new ElemenBeasiswa();
                $pb = $_POST['setuju'];
                $jml_peg = count($pb);
                $elem->set_kd_d($_POST['kd_el']);
                $elem->set_jml_peg($jml_peg);
                $elem->set_kd_r($_POST['r_elem']);
                $elem->set_kd_jur($_POST['kode_jur']);
                $elem->set_thn_masuk($_POST['tahun_masuk']);
                $elem->set_biaya_per_peg(str_replace(',', '', $_POST['biaya_skripsi']));

                $elem->set_total_bayar(str_replace(',', '', $_POST['total_bayar']));
                $elem->set_no_sp2d($_POST['no_sp2d']);
                $elem->set_tgl_sp2d(date('Y-m-d', strtotime($_POST['tgl_sp2d'])));

                //var_dump($elem);
                //echo $kd_elemen_beasiswa;
                //exit();     
                //var_dump($elem);
                $upload = new Upload();
                $upload->init('fupload');
                if ($upload->getFileName() != "") {
                    $upload->setDirTo("files/sp2d/");
                    $nama = array($elem->get_no_sp2d(), $elem->get_tgl_sp2d());
                    //$upload->uploadFile2("", $nama);
                    if ($upload->uploadFile2("", $nama) == false) {
                        $url = URL . 'elemenBeasiswa/editJadup/' . $elem->get_kd_d();
                        echo '<script> alert("File gagal diupload.") </script>';
                        echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
                        exit();
                    }
                    $elem->set_file_sp2d($upload->getFileTo());
                    //echo $upload->getFileName();

                    if ($_POST['fupload_lama'] != "") {
                        $file = "files/sp2d/" . $_POST['fupload_lama'];
                        //echo $file;
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }
                    
                    //echo $upload->getFileName();
                } else {
                    if ($_POST['fupload_lama'] != "") {
                        $elem->set_file_sp2d($_POST['fupload_lama']);
                        //echo $_POST['fupload_lama'];
                    } else {
                        $elem->set_file_sp2d("");
                    }
                }
                $elem->update_elem($elem);

                $penerima = new PenerimaElemenBeasiswa();
                $penerima->delete($elem->get_kd_d());
                foreach ($pb as $val) {
                    $penerima_elemen = new PenerimaElemenBeasiswa();
                    $penerima_elemen->kd_elemen_beasiswa = $elem->get_kd_d();
                    $penerima_elemen->kd_pb = $val;
                    $penerima_elemen->add($penerima_elemen);
                }
				ClassLog::write_log("elemen beasiswa","ubah uang penelitian","kd_el.".$elem->get_kd_d());				
                //$url = URL . 'elemenBeasiswa/editSkripsi/' . $elem->get_kd_d();
				$url = URL . 'elemenBeasiswa/viewSkripsi';
                echo '<script> alert("Data berhasil disimpan") </script>';
                echo '<script language="JavaScript"> window.location.href ="' . $url . '" </script>';
            } else {
                header('location:' . URL . 'elemenBeasiswa/editSkripsi/' . $elem->get_kd_d());
            }
        } else {
            header('location:' . URL . 'elemenBeasiswa/viewSkripsi');
        }
    }

    public function get_method() {
        $method = get_class_methods($this);
        foreach ($method as $method) {
            print_r("\$akses['pic']['" . get_class($this) . "']['" . $method . "'];</br>");
        }
    }

    //menampilkan daftar jurusan berdasrkan universitas dalam bentuk select option
    public function get_jur_by_univ() {
        if (isset($_POST['univ']) && $_POST['univ'] != "") {
            $univ = $_POST['univ'];
            $jurusan = new Jurusan($this->registry);
            $data = $jurusan->get_jur_by_univ($univ);
            echo "<option value=\"\">Pilih Jurusan</option>";
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

    public function get_thn_masuk_by_jur() {

        if (isset($_POST['kd_jurusan']) && $_POST['kd_jurusan'] != "") {
            $jur = $_POST['kd_jurusan'];
            //print_r ($jur);
            $kontrak = new Kontrak();
            $data = $kontrak->get_list_thn_masuk_by_jur($jur);
            //var_dump($data);
            echo "<option value=''>Pilih Tahun Masuk</option>";
            foreach ($data as $thn) {
                if (isset($_POST['jur_def'])) {
                    if ($thn == $_POST['thn_def']) {
                        $select = " selected";
                    } else {
                        $select = "";
                    }
                    echo "<option value=" . $thn . "" . $select . ">" . $thn . "</option>\n";
                } else {
                    echo "<option value=" . $thn . ">" . $thn . "</option>\n";
                }
            }
        } else {
            //echo "tes";
            echo "<option value=''>Pilih Tahun Masuk</option>";
        }
    }

    public function get_thn_bayar() {

        if (isset($_POST['thn']) && $_POST['thn'] != "") {
            $thn = $_POST['thn'];
            //print_r ($jur);
            echo "<option value=''>Pilih Tahun </option>";
            for ($i = $thn; $i <= date('Y') + 1; $i++) {
                if ($i == date('Y')) {
                    echo "<option value=" . $i . " selected>" . $i . "</option>";
                } else {
                    echo "<option value=" . $i . " >" . $i . "</option>";
                }
            }
        } else {
            echo "<option value=''>Pilih Tahun</option>";
        }
    }

    public function filesp2d($file = null) {
        if ($file != "") {
            header("Location:" . URL . "files/sp2d/" . $file);
        }
    }

}

?>
