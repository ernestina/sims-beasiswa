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
        $elem = new ElemenBeasiswa($this->registry);
        $fakul = new Fakultas($this->registry);
        $this->view->fakul = $fakul->get_fakul();
        $jur = new Jurusan($this->registry);
        $this->view->jur = $jur->get_jurusan();
        $kon = new Kontrak($this->registry);
        $this->view->kon = $kon->get_All();
        $this->view->data = $elem->get_elem();
        $this->view->render('bantuan/mon_pembayaran');
    }

    public function viewJadup() {

        $univ = new Universitas($this->registry);
        $this->view->univ = $univ->get_univ();

        $jur = new Jurusan($this->registry);
        $this->view->jur = $jur->get_jurusan();

        $kon = new Kontrak($this->registry);
        $this->view->kon = $kon->get_All();

//        $elem = new ElemenBeasiswa();
//        $this->view->elem = $elem->get_elem_jadup();
//        var_dump($elem->get_elem_jadup());
        $this->view->render('bantuan/jadup');
    }

    public function data_index_jadup() {

//        if(isset($_POST['univ']) && isset($_POST['jurusan']) && isset($_POST['tahun'])){
        //tinggal nambahin filter di get_elem_jadup
        $elem = new ElemenBeasiswa();
        $this->view->elem = $elem->get_elem_jadup();

        $this->view->load('bantuan/tabel_index_jadup');
//        }
    }

    public function tabel_penerima_jadup() {

        if (isset($_POST['kd_jurusan']) && isset($_POST['thn_masuk']) && $_POST['kd_jurusan'] != "" && $_POST['thn_masuk'] != "") {
            $kd_jur = $_POST['kd_jurusan'];
            $thn_masuk = $_POST['thn_masuk'];
            $pb = new Penerima($this->registry);
            $data_pb = $pb->get_penerima_by_kd_jur_thn_masuk($kd_jur, $thn_masuk);
            $bank = new Bank($this->registry);
            $this->view->bank = $bank;
            $this->view->pb = $data_pb;
            $this->view->load('bantuan/tabel_penerima_jadup');
        }

        if (isset($_POST['kd_jurusan']) && isset($_POST['thn_masuk']) && $_POST['kd_jurusan'] != "" && $_POST['thn_masuk'] == "") {
            $kd_jur = $_POST['kd_jurusan'];
            //$thn_masuk = $_POST['thn_masuk'];
            $pb = new Penerima($this->registry);
            $data_pb = $pb->get_penerima_by_kd_jur($kd_jur);
            $bank = new Bank($this->registry);
            $this->view->bank = $bank;
            $this->view->pb = $data_pb;
            $this->view->load('bantuan/tabel_penerima_jadup');
        }
    }

    public function addJadup() {
        $univ = new Universitas($this->registry);
        $this->view->univ = $univ->get_univ();

        $jur = new Jurusan($this->registry);
        $this->view->jur = $jur->get_jurusan();

        $pb = new Penerima($this->registry);
        $this->view->pb = $pb->get_penerima();

        $ref_elem = new ReferensiElemenBeasiswa();
        $this->view->jadup = $ref_elem->jadup();

        $this->view->render('bantuan/rekam_jadup');
    }

    public function saveJadup() {
        $elem = new ElemenBeasiswa();
        $jml_peg = $_POST['jml_peg'];
        $elem->set_kd_r($_POST['r_elem']);
        $elem->set_kd_jur($_POST['kode_jur']);
        $elem->set_thn_masuk($_POST['tahun_masuk']);
        $elem->set_biaya_per_peg(str_replace(',', '', $_POST['biaya_peg']));
        $elem->set_bln($_POST['bln']);
        $elem->set_thn($_POST['tahun_masuk']);
        $elem->set_total_bayar(str_replace(',', '', $_POST['total_bayar']));
        $elem->set_no_sp2d($_POST['no_sp2d']);
        $elem->set_tgl_sp2d(date('Y-m-d', strtotime($_POST['tgl_sp2d'])));
        $elem->set_file_sp2d('');
        //var_dump($elem);
        $kd_elemen_beasiswa = $elem->add_elem($elem);
        //echo $kd_elemen_beasiswa;
        //exit();

        if ($kd_elemen_beasiswa != "") {
            for ($i = 1; $i <= $jml_peg; $i++) {
                $penerima_elemen = new PenerimaElemenBeasiswa();
                $penerima_elemen->kd_elemen_beasiswa = $kd_elemen_beasiswa;
                $penerima_elemen->kd_pb = $_POST['kd_pb' . $i];
                $penerima_elemen->kehadiran = $_POST['jml_hadir' . $i];
                $penerima_elemen->pajak = $_POST['pajak' . $i];
                //if($penerima_elemen->kehadiran == 0 || $penerima_elemen->kehadiran == ""){
                $penerima_elemen->add($penerima_elemen);
                //}
            }
        }

//        
        header('location:' . URL . 'elemenBeasiswa/viewJadup');
    }

    public function updatejadup($id) {
        
    }

    //menghapus data jadup
    public function delJadup($id = null) {
        if ($id != "") {
            $elem = new ElemenBeasiswa($this->registry);
            //echo $id;
            $elem->delete_elem($id);
            
            $penerima_elemen = new PenerimaElemenBeasiswa();
            $penerima_elemen->delete($id);
        }
        header('location:' . URL . 'elemenBeasiswa/viewJadup');
    }

    public function viewUangBuku() {

        $univ = new Universitas($this->registry);
        $this->view->univ = $univ->get_univ();

        $jur = new Jurusan($this->registry);
        $this->view->jur = $jur->get_jurusan();

        $kon = new Kontrak($this->registry);
        $this->view->kon = $kon->get_All();

        $elem = new ElemenBeasiswa();
        $this->view->elem = $elem->get_elem_buku();

        $this->view->render('bantuan/buku');
    }

    public function data_index_buku() {
        $elem = new ElemenBeasiswa();

        $this->view->buku = $elem->get_elem_buku();
        $this->view->load('bantuan/tabel_index_buku');
    }

    public function tabel_penerima_buku() {
        
    }

    public function addUangBuku($id = null) {

        $univ = new Universitas($this->registry);
        $this->view->univ = $univ->get_univ();
        $jur = new Jurusan($this->registry);
        $this->view->jur = $jur->get_jurusan();
        $kon = new Kontrak($this->registry);
        $this->view->kon = $kon->get_All();
        $ref_elem = new ReferensiElemenBeasiswa();
        $this->view->buku = $ref_elem->buku();

        $this->view->render('bantuan/rekam_buku');
    }

    public function delUangBuku($id) {
        $elem = new ElemenBeasiswa($this->registry);
        if (is_null($id)) {
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
        $elem->set_kd_d($id);
        $elem->delete_elem();
        header('location:' . URL . 'elemenBeasiswa/viewUangBuku');
    }

    public function viewSkripsi() {
        $elem = new ElemenBeasiswa($this->registry);
        $fakul = new Fakultas($this->registry);
        $this->view->fakul = $fakul->get_fakul();
        $jur = new Jurusan($this->registry);
        $this->view->jur = $jur->get_jurusan();
        $kon = new Kontrak($this->registry);
        $this->view->kon = $kon->get_All();
        if (isset($_POST['add_elem'])) {
            $kode_r = $_POST['kode_r'];
            $kode_jur = $_POST['kode_jur'];
            $jml_peg = $_POST['jml_peg'];
            $bln = $_POST['bln'];
            $thn = $_POST['thn'];
            $total_bayar = $_POST['total_bayar'];
            $no_sp2d = $_POST['no_sp2d'];
            $tgl_sp2d = $_POST['tgl_sp2d'];
            $file_sp2d = $_POST['file_sp2d'];

            $data = array(
                'KD_R_ELEM_BEASISWA' => $kode_r,
                'KD_JUR' => $kode_jur,
                'JML_PEG_D_ELEM_BEASISWA' => $jml_peg,
                'BLN_D_ELEM_BEASISWA' => $bln,
                'THN_D_ELEM_BEASISWA' => $thn,
                'TOTAL_BAYAR_D_ELEM_BEASISWA' => $total_bayar,
                'NO_SP2D_D_ELEM_BEASISWA' => $no_sp2d,
                'TGL_SP2D_D_ELEM_BEASISWA' => $tgl_sp2d,
                'FILE_SP2D_D_ELEM_BEASISWA' => $file_sp2d
            );
            $elem->add_elem($data);
        }

        if (isset($_POST['update_elem'])) {
            $kode_d = $_POST['kode_d'];
            $kode_r = $_POST['kode_r'];
            $kode_jur = $_POST['kode_jur'];
            $jml_peg = $_POST['jml_peg'];
            $bln = $_POST['bln'];
            $thn = $_POST['thn'];
            $total_bayar = $_POST['total_bayar'];
            $no_sp2d = $_POST['no_sp2d'];
            $tgl_sp2d = $_POST['tgl_sp2d'];
            $file_sp2d = $_POST['file_sp2d'];

            $data = array(
                'KD_D_ELEM_BEASISWA' => $kode_d,
                'KD_R_ELEM_BEASISWA' => $kode_r,
                'KD_JUR' => $kode_jur,
                'JML_PEG_D_ELEM_BEASISWA' => $jml_peg,
                'BLN_D_ELEM_BEASISWA' => $bln,
                'THN_D_ELEM_BEASISWA' => $thn,
                'TOTAL_BAYAR_D_ELEM_BEASISWA' => $total_bayar,
                'NO_SP2D_D_ELEM_BEASISWA' => $no_sp2d,
                'TGL_SP2D_D_ELEM_BEASISWA' => $tgl_sp2d,
                'FILE_SP2D_D_ELEM_BEASISWA' => $file_sp2d
            );
            $elem->set_kd_d($kode_d);
            $elem->update_elem($data);
        }

        $this->view->data = $elem->get_elem(3);
        $this->view->render('bantuan/biaya_skripsi');
    }

    public function data_index_skripsi() {
        $elem = new ElemenBeasiswa();
        $this->view->skripsi = $elem->get_elem_skripsi();
    }

    public function addSkripsi($id = null) {
        $elem = new ElemenBeasiswa($this->registry);
        $fakul = new Fakultas($this->registry);
        $this->view->fakul = $fakul->get_fakul();
        $jur = new Jurusan($this->registry);
        $this->view->jur = $jur->get_jurusan();
        $kon = new Kontrak($this->registry);
        $this->view->kon = $kon->get_All();
        $pb = new Penerima($this->registry);
        $this->view->pb = $pb->get_penerima();
        $elem = new ElemenBeasiswa($this->registry);

        if (!is_null($id)) {
            $elem->set_kd_d($id);
            $this->view->d_ubah = $elem->get_elem_by_id($elem);
        }
        $this->view->render('bantuan/rekam_biaya_skripsi');
    }

    public function delSkripsi($id) {
        $elem = new ElemenBeasiswa($this->registry);
        if (is_null($id)) {
            throw new Exception;
            echo "id belum dimasukkan!";
            return;
        }
        $elem->set_kd_d($id);
        $elem->delete_elem();
        header('location:' . URL . 'elemenBeasiswa/viewSkripsi');
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

}

?>
