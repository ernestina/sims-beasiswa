<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class PenerimaController extends BaseController{
    
    public function __construct($registry){
        parent::__construct($registry);
        $this->kd_user = Session::get('kd_user');
    }
    
    public function profil($id=null){
        $pb = new Penerima($this->registry); //mendapatkan informasi pb
        $st = new SuratTugas($this->registry); //mendapatkan informasi surat tugas
        $el = new ElemenBeasiswa($this->registry); //mendapatkan pembayaran
        $bank = new Bank($this->registry); //mendapatkan nama bank
        $jst = new JenisSuratTugas($this->registry); //mendapatkan jenis surat tugas
        $jur = new Jurusan($this->registry);
        $univ = new Universitas($this->registry);
        $nilai = new Nilai($this->registry);
        $cuti = new Cuti($this->registry);
        $mas = new MasalahPenerima($this->registry);
        $pemb = new PemberiBeasiswa();
        $beaya = new Biaya();
        $role = Session::get('role');
        if(!is_null($id)){
            $pb->set_kd_pb($id);
            $this->view->d_pb = $pb->get_penerima_by_id($pb,$this->kd_user);
            $st->set_kd_st($this->view->d_pb->get_st());
            $this->view->d_st = $st->get_surat_tugas_by_id($st,$this->kd_user);
            if($role==3) $this->view->d_st = $st->get_surat_tugas_by_id($st);
            $pemb = $pemb->get_by_id($this->view->d_st->get_pemberi());
            $this->view->d_pemb = $pemb->nama_pemberi;
            $this->view->d_bank = $bank->get_bank_id($this->view->d_pb->get_bank());
            $jur->set_kode_jur($this->view->d_pb->get_jur());
            $this->view->d_jur = $jur->get_jur_by_id($jur);
            $jst->set_kode($this->view->d_st->get_jenis_st());
            $this->view->d_jst = $jst->get_jst_by_id($jst);
            $this->view->d_univ = $univ->get_univ_by_jur($this->view->d_jur->get_kode_jur());
            $this->view->d_nil = $nilai->get_nilai($pb);
            $this->view->d_cur_ipk = $nilai->get_current_ipk($pb);
            $this->view->d_cuti = $cuti->get_cuti($this->kd_user,$pb);
            if($role==3) $this->view->d_cuti = $cuti->get_cuti(0,$pb);
            $this->view->d_rwt_beas = $pb->get_penerima_by_column($pb,$this->kd_user,'nip',true);
            if($role==3) $this->view->d_rwt_beas = $pb->get_penerima_by_column($pb,0,'nip',true);
            $elem = $el->get_elem_per_pb($pb, false);
            $bea = $beaya->get_cost_per_pb($pb,false);
            $this->view->d_mas = $mas->get_masalah($pb);
            $d_bea = array();
            /*
             * sementara versi dummy dulu ye :p
             */
            foreach($elem as $v){
                $d = new BiayaPenerimaBeasiswa();
                $is_jadup = ($v->get_kd_r()=='tunjangan hidup');
                $is_buku = ($v->get_kd_r()=='buku');
                $nama = $v->get_kd_r();
                if($is_jadup){
                    $nama .= " ".$v->get_bln()." ".$v->get_thn();
                }
                if($is_buku){
                    $bulan = Tanggal::bulan_num($v->get_bln());
                    $bulan = ($bulan==1)?'ganjil':'genap';
                    $nama .= " semester ".$bulan." ".$v->get_thn();
                }
                $d->set_nama_biaya($nama);
                $d->set_jumlah_biaya($v->get_total_bayar());
                $d_bea[] = $d;
            }
            
            foreach($bea as $v){
                $d = new BiayaPenerimaBeasiswa();
                $d->set_nama_biaya($v->nama_tagihan);
                $d->set_jumlah_biaya($v->biaya_per_pegawai);
                $d_bea[] = $d;
            }
            $this->view->d_bea = $d_bea;
        }
        $this->view->url = 'profil';
        $this->view->render('profil/data_profil');
    }
    
    public function datapb($halaman=1,$batas=10){
        $pb = new Penerima($this->registry);
        $univ = new Universitas($this->registry);
        $st = new SuratTugas($this->registry);
        $sts = new Status();
        $role = Session::get('role');
        $this->view->th_masuk = $st->get_list_th_masuk();
        if($role!=2) $this->view->th_masuk = $st->get_list_th_masuk(); 
        if($role==2){
            $this->view->univ = $univ->get_univ($this->kd_user);
            $this->view->d_pb_all = $pb->get_penerima($this->kd_user);
        }else{
            $this->view->univ = $univ->get_univ();
            $this->view->d_pb_all = $pb->get_penerima();
        }
        $this->view->d_sts = $sts->get_status();
        $this->view->nilai = new Nilai($this->registry);
        /**start paging**/
        $url = 'penerima/datapb';
        $this->view->url = $url;
        $this->view->paging = new Paging($url, $batas, $halaman);
        $this->view->jmlData = count($this->view->d_pb_all);
        $posisi = $this->view->paging->cari_posisi();
        if($role==2){
            $this->view->d_pb = $pb->get_penerima($this->kd_user,$posisi,$batas);
        }else{
            $this->view->d_pb = $pb->get_penerima(0,$posisi,$batas);
        }
        /**end paging**/
        $this->view->render('riwayat_tb/data_pb');
    }
    
    /*
     * menampilkan form rekam, ubah, daftar data penerima tb
     */
    public function penerima($id=null){
        $pb = new Penerima($this->registry);
        
        $upload = $this->registry->upload;
        $upload->init('fupload'); //awali dengan fungsi ini
        $upload->setDirTo('files/foto/'); //set direktori tujuan
        $ubahNama = array('KAKA','KIKI','KEKE'); //pola nama baru dalam array
        $upload->changeFileName($upload->getFileName(), $ubahNama); //ubah nama
        
        if(isset($_POST['sb_add'])){
            $st = $_POST['st'];
            $bank = $_POST['bank'];
            $nip = $_POST['nip'];
            $telp = $_POST['telp'];
            $alamat = $_POST['alamat'];
            $email = $_POST['email'];
            $no_rek = $_POST['no_rek'];
            
            $data = array(
                'KD_ST'=>$st,
                'KD_BANK'=>$bank,
                'NIP_PB'=>$nip,
                'EMAIL_PB'=>$email,
                'TELP_PB'=>$telp,
                'ALMT_PB'=>$alamat,
                'NO_REKENING_PB'=>$no_rek,
                'FOTO_PB'=>$upload->getFileTo(),
            );
            
            if(!Validasi::validate_nip($nip)) echo 'nip salah....!';
            if($pb->add_penerima($data)){
                /*
                 * upload file
                 */
                $upload->uploadFile();
            }
            
            
        }
        
        if(!is_null($id)){
            $pb->set_kd_pb($id);
            $this->view->d_ubah = $pb->get_penerima_by_id($pb);
        }
        $st = new SuratTugas($this->registry);
        $this->view->d_st = $st->get_surat_tugas();
        $this->view->d_pb = $pb->get_penerima();
        $this->view->render('riwayat_tb/penerima_beasiswa');
        
    }
    
    public function pb_by_st(){
        $kd_st = $_POST['param'];
        $pb = new Penerima($this->registry);
        $pb->set_st($kd_st);
        $this->view->d_pb = $pb->get_penerima_by_st($pb,$this->kd_user);
        $this->view->load('riwayat_tb/tabel_pb');
        
    }
    
    public function find_pb(){
        $param = explode(",",$_POST['param']);
        $nama = $param[0];
        $st = $param[1];
        $pb = new Penerima($this->registry);
        $pb->set_nama($nama);
        $pb->set_st($st);
        $this->view->d_pb = $pb->get_penerima_by_name($pb,$this->kd_user,true);
        if(Session::get('role')!=2) $this->view->d_pb = $pb->get_penerima_by_name($pb,0,true);
        $this->view->load('riwayat_tb/tabel_pb');
        
    }


    /*
     * tambah penerima pada surat tugas
     */
    public function add_from_dialog_to_st(){
        $pb = new Penerima($this->registry);
        $st = new SuratTugas($this->registry);
        $kd = $_POST['st'];
        $st_lama = $_POST['st_parent'];
        $kd_peg = $_POST['kd_peg'];
        $bank = $_POST['bank'];
        $nip = $_POST['nip'];
        $nama = $_POST['nama'];
        $telp = $_POST['telp'];
        $email = $_POST['email'];
        $no_rek = $_POST['no_rek'];
        $jkel = $_POST['jkel'];
        $gol = $_POST['gol'];
        $unit = $_POST['unit'];
        $st_lama = $_POST['st_parent'];
        
        /*
         * mendapatkan kode jurusan 
         */
        
        $is_child = $st_lama!=0;
        if($is_child){
            $st = new SuratTugas($this->registry);
            $cek_child = $st->is_child($st_lama);
            if($cek_child){
                $status = 3;
            }else{
                $status = 2;
            }
            $pb->set_kd_pb($kd_peg);
            $pb = $pb->get_penerima_by_id($pb);
            $pb->set_st($kd);
            $pb->set_status($status);
            $pb->update_penerima();
        }else{
            $st->set_kd_st($kd);
            $st->get_surat_tugas_by_id($st,$this->kd_user);
            $jur = $st->get_jur();
            $data = array(
                'KD_ST'=>$kd,
                'KD_BANK'=>$bank,
                'NIP_PB'=>$nip,
                'NM_PB'=>$nama,
                'TELP_PB'=>$telp,
                'EMAIL_PB'=>$email,
                'NO_REKENING_PB'=>$no_rek,
                'JK_PB'=>$jkel,
                'KD_GOL'=>  Golongan::golongan_string_int2($gol),
                'UNIT_ASAL_PB'=>$unit,
                'KD_JUR'=>$jur,
                'KD_STS_TB'=>1
            );

            $pb->add_penerima($data);
        }
        $ref = " no ST ".$st->get_nomor()." pegawai ".$nama.":".$nip;
        ClassLog::write_log('penerima_beasiswa','rekam',$ref);
    }
    
    /*
     * update penerima tb
     */
    public function updpenerima(){
        $pb = new Penerima($this->registry);
        
        $kd = $_POST['kd_pb'];
        $st = $_POST['st'];
        $bank = $_POST['bank'];
        /*$jur = $_POST['jur'];
        $status = $_POST['status'];
        $nama = $_POST['nama'];*/
        $nip = $_POST['nip'];
        /*$gol = $_POST['gol'];
        $unit_asal = $_POST['unit_asal'];*/
        $telp = $_POST['telp'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $no_rek = $_POST['no_rek'];
        /*$jkel = $_POST['jk'];
        $tgl_lapor = $_POST['tgl_lap'];
        $skl = $_POST['skl'];
        $spmt = $_POST['spmt'];
        $skripsi = $_POST['skripsi'];*/
        
        $data = array(
            'KD_ST'=>$st,
            /*'KD_JUR'=>$jur,*/
            'KD_BANK'=>$bank,
            /*'KD_STATUS_TB'=>$status,*/
            'NIP_PB'=>$nip,
            /*'NAMA_PB'=>$nama,
            'JK_PB'=>$jkel,
            'GOLONGAN_PB'=>$gol,
            'UNIT_ASAL_PB'=>$unit_asal,*/
            'EMAIL_PB'=>$email,
            'TELP_PB'=>$telp,
            'ALMT_PB'=>$alamat,
            'NO_REKENING_PB'=>$no_rek,
            /*'TANGGAL_LAPOR_PB'=>$tgl_lapor,
            'NOMOR_SKL_PB'=>$skl,
            'NO_SPMT_PB'=>$spmt,
            'JUDUL_SKRIPSI_PB'=>$skripsi*/
        );
        
        if(!is_null($_FILES['fupload'])){
            $upload = $this->registry->upload;
            $upload->init('fupload'); //awali dengan fungsi ini
            $upload->setDirTo('files/foto/'); //set direktori tujuan
            $ubahNama = array('KAKA','KIKI','KEKE'); //pola nama baru dalam array
            $upload->changeFileName($upload->getFileName(), $ubahNama); //ubah nama
            $data['FOTO_PB'] = $upload->getFileTo();
            $upload->uploadFile();
        }
        
        
        $pb->set_kd_pb($kd);
        $pb->update_penerima($data);
        header('location:'.URL.'penerima/penerima');
    }
    
    public function updprofil(){
        $pb = new Penerima($this->registry);
        $st = new SuratTugas($this->registry);
        $nip = $_POST['nip'];
        $kd_pb = $_POST['kd_pb'];
        $kd_st = $_POST['kd_st'];
        $no_st = $_POST['no_st'];
        $asal = $_POST['asal'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $telp = $_POST['hp'];
        $bank = $_POST['bank'];
        $norek = $_POST['rekening'];
        $pb->set_kd_pb($kd_pb);
        $pb = $pb->get_penerima_by_id($pb,$this->kd_user);
        $st->set_kd_st($kd_st);
        $d_st = $st->get_surat_tugas_by_id($st,$this->kd_user);
        /*
         * upload foto
         */
        if($_FILES['fotoinput']['name']!=''){
            $upload_foto = $this->registry->upload;
            $upload_foto->init('fotoinput');
            $upload_foto->setDirTo('files/foto/');
            $nm_foto = array($nip);
            $upload_foto->changeFileName($upload_foto->getFileName(),$nm_foto);
            $foto = $upload_foto->getFileTo();
            $upload_foto->uploadFile();
    //        var_dump($upload_foto);
            unset($upload_foto);
        }else{
            $foto = $pb->get_foto();
        }
        
        /*
         * upload skl
         */
//        var_dump($_FILES['sklinput']);
        if($_FILES['sklinput']['name']!=''){
            $upload_skl = $this->registry->upload;
            $upload_skl->init('sklinput');
            $upload_skl->setDirTo('files/skl/');
            $nm_skl = array('SKL',$no_st,$nip);
            $upload_skl->changeFileName($upload_skl->getFileName(),$nm_skl);
            $file_skl = $upload_skl->getFileTo();
            $upload_skl->uploadFile();
//            var_dump($file_skl);
            unset($upload_skl);
        }else{
            $file_skl = $pb->get_skl();
        }
        
        $lap_selesai_tb = Tanggal::ubahFormatTanggal($_POST['tgl_lapor']);
        $tgl_sel_st = $_POST['tgl_sel_st'];
        if($_POST['tgl_lapor']!=''){
//            $cek = Tanggal::check_before_a_date($lap_selesai_tb, $tgl_sel_st);
//            if($cek){
//                $st->set_kd_st($kd_st);
//                $d_st = $st->get_surat_tugas_by_id($st,$this->kd_user);
                $status = $pb->get_status_change_pb($d_st,$lap_selesai_tb,$tgl_sel_st);
//            }
        }else{
            $status = $pb->cek_pb_konek_st_ct($pb, 'all', false, true);
            /*$st = new SuratTugas($this->registry);
            $is_child = $st->is_child($kd_st);
            if($is_child){
                $kd_parent = $st->get_st_lama();
                if($kd_parent!=''){
                    $status = 3;
                }else{
                    $status = 2;
                } 
            }else{
                $status = 1;
            }
            $ct = new Cuti($this->registry);
            $d_cuti = $ct->get_cuti($this->kd_user, $pb);
            if(count($d_cuti)>0){
                $status = 4;
            }*/
        }
//        var_dump($upload_skl);
        
        /*
         * upload spmt
         */
        if($_FILES['spmtinput']['name']!=''){
            $upload_spmt = $this->registry->upload;
            $upload_spmt->init('spmtinput');
            $upload_spmt->setDirTo('files/spmt/');
            $nm_spmt = array('ST',$nip,$no_st);
            $upload_spmt->changeFileName($upload_spmt->getFileName(),$nm_spmt);
            $file_spmt = $upload_spmt->getFileTo();
            $upload_spmt->uploadFile();
//            var_dump($upload_spmt);
            var_dump($file_spmt);
            unset($upload_spmt);
        }else{
            $file_spmt = $pb->get_spmt();
        }
        
        $skripsi = $_POST['skripsi'];
        
        $data = array($kd_pb,$nip,$no_st,$alamat,$email,$telp,$bank,$norek,$foto,$file_skl,$lap_selesai_tb,$file_spmt,$skripsi);
//        var_dump($data);
        $pb->set_unit_asal($asal);
        $pb->set_alamat($alamat);
        $pb->set_email($email);
        $pb->set_telp($telp);
        $pb->set_bank($bank);
        $pb->set_no_rek($norek);
        $pb->set_foto($foto);
        $pb->set_tgl_lapor($lap_selesai_tb);
        $pb->set_skl($file_skl);
        $pb->set_spmt($file_spmt);
        $pb->set_skripsi($skripsi);
        if(isset($status)){
            $pb->set_status($status);
        }
        
        if($pb->update_penerima()){
            $ref = " no ST ".$st->get_nomor()." pegawai ".$pb->get_nama().":".$pb->get_nip();
            ClassLog::write_log('penerima_beasiswa','rekam',$ref);
            header('location:'.URL.'penerima/profil/'.$kd_pb);
        }else{
            /*
             * gagal insert, balikin isian!!!
             */
            $this->view->error = "cek kembali isian anda!";
            $this->view->alamat = $alamat;
            $this->view->email = $email;
            $this->view->telp = $telp;
            $this->view->bank = $bank;
            $this->view->no_rek = $norek;
            $this->view->tgl_lapor = $lap_selesai_tb;
            $this->view->skripsi = $skripsi;
            $this->for_edit_pb($kd_pb);
        }
    }
    
    public function set_status_lulus(){
        $kd_pb = $_POST['id_pb'];
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $pb = $pb->get_penerima_by_id($pb);
        $status = $pb->get_status();
        $blm_lulus = $status!=9;
        $tdk_lulus = $status==9;
        $data = 1;
        if($blm_lulus){
            $pb->set_status(9);
            $data = array('str_status'=>StatusPB::status_int_string(9),'kd_status'=>9);
        }elseif($tdk_lulus){
            $status = $pb->cek_pb_konek_st_ct($pb, 'all', false, true);
            $data = array('str_status'=>StatusPB::status_int_string($status),'kd_status'=>$status);
            $pb->set_status($status);
            /*
            * sementara dulu
            * untuk update status tb, sambil nunggu fungsi yg benar :(
            *
            $curr_month = (int) date('m');
            $curr_year = (int) date('Y');
            $name = $pb->get_nama();
            $ct = new Cuti($this->registry);
            $ct->get_cuti_by_pb_name($name, $this->kd_user);
            $tmp_mul = explode(" ",$ct->get_prd_mulai());
            $tmp_sel = explode(" ",$ct->get_prd_selesai());
            $bul_mul = (int) $tmp_mul[0];
            $thn_mul = (int) $tmp_mul[1];
            $bul_sel = (int) $tmp_mul[0];
            $thn_sel = (int) $tmp_sel[1];
            $is_cuti = $bul_mul<=$curr_month && $thn_mul<=$curr_year && $bul_sel>=$curr_year && $thn_sel>=$curr_year;
            if($is_cuti){
                $pb->set_status(4);
                $data = array('str_status'=>StatusPB::status_int_string(4),'kd_status'=>4);
            }else{ */
                /*
                * st
                *
                $kd_st = $pb->get_st();
                $st = new SuratTugas($this->registry);
                $is_child = $st->is_child($kd_st);
                if($is_child){
                    $kd_parent = $st->get_st_lama();
                    if($kd_parent!=''){
                        $pb->set_status(3);
                        $data = array('str_status'=>StatusPB::status_int_string(3),'kd_status'=>3);
                    }else{
                        $pb->set_status(2);
                        $data = array('str_status'=>StatusPB::status_int_string(2),'kd_status'=>2);
                    } 
                }else{
                    $pb->set_status(1);
                    $data = array('str_status'=>StatusPB::status_int_string(1),'kd_status'=>1);
                }
            }
            */
            /*
            * end update status
            */
        }
//        echo $status;
        $pb->update_penerima();
        
        echo json_encode($data);
    }
    /*
     * hapus penerima tb
     */
    public function delpb($id){
        if(Session::get('role')!=2){
            $this->datapb();
        }
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($id);
        $pb->get_penerima_by_id($pb,$this->kd_user);
        $file = 'files/'.$pb->get_foto();
        $nama = $pb->get_nama();
        $nip = $pb->get_nip();
        $pb->delete_penerima();
        if(file_exists($file)) unlink($file);
        $ref = " pegawai ".$nama.":".$nip;
        ClassLog::write_log('penerima_beasiswa','rekam',$ref);
        header('location:'.URL.'penerima/datapb');
    }
    
    public function get_nama_peg(){
        $nip = $_POST['nip'];
        $kd_st = $_POST['kd_st'];
        $st_lama = $_POST['st_lama'];
        $is_child=$st_lama!=0;
        if($is_child){
            $pb = new Penerima($this->registry);
            $pb->set_nip($nip);
            $pb->set_st($st_lama);
            $data = $pb->get_penerima_by_st_nip($pb);
            $nip = $data->get_kd_pb();
            $nm = $data->get_nama();
            $jk = $data->get_jkel();
            $gol = $data->get_gol();
            $unit = $data->get_unit_asal();
        }else{
            $peg = new Pegawai($this->registry);
            $peg->set_nip($nip);
            $data = $peg->get_peg_by_nip($peg);
            $nip = $peg->get_nip();
            $nm = $data->get_nama();
            $jk = $data->get_jkel();
            $gol = $data->get_golongan();
            $unit = $data->get_unit_asal();
        }
//        $d_cek = $pb->cek_exist_pb();
//        $d_cek = $d_cek['cek'];
        $d_cek = 0;
        if(!$is_child){
            $pb = new Penerima($this->registry);
            $pb->set_nip($nip);
            $d_cek = $pb->is_prn_beasiswa_strata($nip, $kd_st);
        }
        $d_cek = ($d_cek>0)?1:0;
        $return = json_encode(array(
            'kd_peg'=>$nip,
            'nama'=>$nm,
            'jkel'=>$jk,
            'gol'=>  Golongan::golongan_int_string($gol),
            'unit'=>$unit,
            'registered'=>$d_cek
        ));
        
        echo $return;
    }
    
    public function editpb($kode_pb){
//        $pb = new Penerima($this->registry); //mendapatkan informasi pb
//        $st = new SuratTugas($this->registry); //mendapatkan informasi surat tugas
//        $bank = new Bank($this->registry); //mendapatkan nama bank
//        $jst = new JenisSuratTugas($this->registry); //mendapatkan jenis surat tugas
//        $jur = new Jurusan($this->registry);
//        $univ = new Universitas($this->registry);
//        $nilai = new Nilai($this->registry);
//        $cuti = new Cuti($this->registry);
//        $mas = new MasalahPenerima($this->registry);
//        $pb->set_kd_pb($kode_pb);
//        $this->view->d_pb = $pb->get_penerima_by_id($pb);
//        $st->set_kd_st($this->view->d_pb->get_st());
//        $this->view->d_st = $st->get_surat_tugas_by_id($st);
//        $this->view->d_bank = $bank->get_bank_id($this->view->d_pb->get_bank());
//        $jur->set_kode_jur($this->view->d_pb->get_jur());
//        $this->view->d_jur = $jur->get_jur_by_id($jur);
//        $jst->set_kode($this->view->d_st->get_jenis_st());
//        $this->view->t_jst = $jst->get_jst();
//        $this->view->d_jst = $jst->get_jst_by_id($jst);
//        $this->view->d_univ = $univ->get_univ_by_jur($this->view->d_jur->get_kode_jur());
//        $this->view->d_nil = $nilai->get_nilai($pb);
//        $this->view->d_cur_ipk = $nilai->get_current_ipk($pb);
//        $this->view->d_cuti = $cuti->get_cuti($pb);
//        $this->view->d_rwt_beas = $pb->get_penerima_by_column($pb,'nip',true);
//        $this->view->d_mas = $mas->get_masalah($pb);
//        $this->view->render('profil/ubah_profil_v2');
        $this->view->url = 'editpb';
        $this->for_edit_pb($kode_pb);
    }
    
    private function for_edit_pb($kode_pb){
        if(Session::get('role')!=2){
            $this->profil($kode_pb);
        }
        $pb = new Penerima($this->registry); //mendapatkan informasi pb
        $st = new SuratTugas($this->registry); //mendapatkan informasi surat tugas
        $bank = new Bank($this->registry); //mendapatkan nama bank
        $jst = new JenisSuratTugas($this->registry); //mendapatkan jenis surat tugas
        $jur = new Jurusan($this->registry);
        $univ = new Universitas($this->registry);
        $nilai = new Nilai($this->registry);
        $cuti = new Cuti($this->registry);
        $mas = new MasalahPenerima($this->registry);
        $pemb = new PemberiBeasiswa();
        $pb->set_kd_pb($kode_pb);
        $this->view->d_pb = $pb->get_penerima_by_id($pb,$this->kd_user);
        $st->set_kd_st($this->view->d_pb->get_st());
        $this->view->d_st = $st->get_surat_tugas_by_id($st,$this->kd_user);
        $pemb = $pemb->get_by_id($this->view->d_st->get_pemberi());
        $this->view->d_pemb = $pemb->nama_pemberi;
        $this->view->d_bank = $bank->get_bank_id($this->view->d_pb->get_bank());
        $this->view->t_bank = $bank->get_bank();
        $jur->set_kode_jur($this->view->d_pb->get_jur());
        $this->view->d_jur = $jur->get_jur_by_id($jur);
        $jst->set_kode($this->view->d_st->get_jenis_st());
        $this->view->t_jst = $jst->get_jst();
        $this->view->d_jst = $jst->get_jst_by_id($jst);
        $this->view->d_univ = $univ->get_univ_by_jur($this->view->d_jur->get_kode_jur());
        $this->view->d_nil = $nilai->get_nilai($pb);
        $this->view->d_cur_ipk = $nilai->get_current_ipk($pb);
        $this->view->d_cuti = $cuti->get_cuti($this->kd_user,$pb);
        $this->view->d_rwt_beas = $pb->get_penerima_by_column($pb,$this->kd_user,'nip',true);
        $this->view->d_mas = $mas->get_masalah($pb);
        $this->view->render('profil/ubah_profil_v2');
    }
    
    public function dialog_masalah($kd_pb){
        $this->view->kd_pb = $kd_pb;
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $this->view->url = 'editpb';
        $this->view->d_pb = $pb->get_penerima_by_id($pb,$this->kd_user);
        $this->view->load('profil/dialog_masalah');
    }
    
    public function add_problem(){
        $kd_pb = $_POST['kd_pb'];
        $uraian = $_POST['uraian'];
        $sumber = $_POST['sumber'];
        
        $mas = new MasalahPenerima($this->registry);
        $mas->set_kode_pb($kd_pb);
        $mas->set_uraian($uraian);
        $mas->set_sumber_masalah($sumber);
        $mas->add_masalah();
    }
    
    public function get_masalah($kd_pb,$aksi='editpb'){
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $this->view->d_pb = $pb->get_penerima_by_id($pb,$this->kd_user);
        $mas = new MasalahPenerima($this->registry);
        $this->view->url = $aksi;
        $this->view->d_mas = $mas->get_masalah($pb);
        
        $this->view->load('profil/tabel_masalah');
    }
    
    public function dialog_nilai($kd_pb){
        $this->view->kd_pb = $kd_pb;
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $this->view->d_pb = $pb->get_penerima_by_id($pb,$this->kd_user);
        $this->view->url = 'editpb';
        $this->view->load('profil/dialog_nilai');
    }
    
    public function add_nilai(){
        $kd_pb = $_POST['kd_pb'];
        $ips = $_POST['ips'];
        $ipk = $_POST['ipk'];
        $sem = $_POST['semester'];
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $d_pb = $pb->get_penerima_by_id($pb,$this->kd_user);
//        echo "penerima";
        /*
         * upload file
         */
        //        $upload = new Upload();
        $this->registry->upload->init('sfile');
        $this->registry->upload->setDirTo('files/transkrip/');
        $nm_file = array('TRANSKRIP',$d_pb->get_nip(),$sem);
        $this->registry->upload->changeFileName($this->registry->upload->getFileName(), $nm_file);
        $file = $this->registry->upload->getFileTo();
        $this->registry->upload->uploadFile();
        /*
         * rekam nilai di tabel d_nil
         */
        $nilai = new Nilai($this->registry);
        $nilai->set_pb($kd_pb);
        $nilai->set_ips($ips);
        $nilai->set_ipk($ipk);
        $nilai->set_semester($sem);
        $nilai->set_file($file);
        $nilai->add_nilai();
    }
    
    public function get_nilai($kd_pb,$url='editpb'){
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $nil = new Nilai($this->registry);
        $this->view->d_pb = $pb->get_penerima_by_id($pb,$this->kd_user);
        $this->view->d_nil= $nil->get_nilai($pb);
        $this->view->url = $url;
        $this->view->load('profil/tabel_nilai');
    }
    
    public function view_transkrip($file='null'){
        $this->view->file = $file;
        $this->view->load('profil/display_transkrip');
    }
    
    public function view_foto($file='null'){
        $this->view->file = $file;
        $this->view->load('profil/display_foto');
    }
    
    public function view_skl($file='null'){
        $this->view->file = $file;
        $this->view->load('profil/display_skl');
    }
    
    public function view_spmt($file='null'){
        $this->view->file = $file;
        $this->view->load('profil/display_spmt');
    }
    
    public function delnilai($kd_nilai,$kd_pb,$url){
        $nil = new Nilai($this->registry);
        $nil->set_kode($kd_nilai);
//        echo 'location:'.URL.'penerima/'.$kat.'/'.$kd_pb;
        $nil->del_nilai();
            
        header('location:'.URL.'penerima/'.$url.'/'.$kd_pb);
        
    }
    
    /*
     * hapus masalah
     */
    
    public function delmas($kd_mas,$kd_pb,$url){
        $mas = new MasalahPenerima($this->registry);
        $mas->set_kode($kd_mas);
//        echo 'location:'.URL.'penerima/'.$kat.'/'.$kd_pb;
        $mas->del_masalah();
            
        header('location:'.URL.'penerima/'.$url.'/'.$kd_pb);
        
    }
    
    /*
     * cek file ada kagak
     */
    public function cekfile($kd_pb,$case){
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $d_pb = $pb->get_penerima_by_id($pb,$this->kd_user);
        $return = 0;
        switch($case){
            case 'foto':
                if($d_pb->get_foto()!='' OR !is_null($d_pb->get_foto())){
                    $cek_file = file_exists(URL.'files/foto/'.$d_pb->get_foto());
                    if(cek_file){
                        $return = 1;
                    }
                }
                break;
            case 'skl':
                if($d_pb->get_skl()!='' OR !is_null($d_pb->get_skl())){
                    $cek_file = file_exists(URL.'files/skl/'.$d_pb->get_skl());
                    if(cek_file){
                        $return = 1;
                    }
                }
                break;
            case 'spmt':
                if($d_pb->get_spmt()!='' OR !is_null($d_pb->get_spmt())){
                    $cek_file = file_exists(URL.'files/spmt/'.$d_pb->get_spmt());
                    if(cek_file){
                        $return = 1;
                    }
                }
                break;
        }
        echo $return;
    }
    
    public function get_data_pb(){
        $kd_pb = $_POST['param'];
        $pb = new Penerima($this->registry);
        $pb->set_kd_pb($kd_pb);
        $d_pb = $pb->get_penerima_by_id($pb,$this->kd_user);
        
        $return = json_encode(array(
            'kd_pb'=>$d_pb->get_kd_pb(),
            'nip'=>$d_pb->get_nip(),
            'nama'=>$d_pb->get_nama(),
            'jk'=>$d_pb->get_jkel()
        ));
        
        echo $return;
    }
    
    public function get_tabel_peg(){
        $nama = $_POST['param'];
        $pb = new Penerima($this->registry);
        $pb->set_nama($nama);
        $this->view->d_pb = $pb->get_penerima_by_name($pb,$this->kd_user);
        $this->view->load('riwayat_tb/tabel_pb_sc');
    }
    
    public function get_method(){
        $method = get_class_methods($this);
        foreach ($method as $method){
            print_r("\$akses['pic']['".  get_class($this)."']['".$method."'];</br>");
        }
    }
    
    /*
     * bukan dari penerima tapi dari tabel sik
     * jika perpanjangan dari tabel d_pb
     */
    public function get_nip_data(){
        $tmp = $_POST['param'];
        $tmp = explode(",", $tmp);
        $nip = $tmp[0];
        $is_child = $tmp[1]!=0;
        echo "<ul>";
        if($is_child){
            $pb = new Penerima($this->registry);
            $pb->set_st($tmp[1]);
            $d_pb = $pb->get_penerima_by_st($pb,$this->kd_user);
            foreach ($d_pb as $v){
                echo "<li onClick=\"fill('".$v->get_nip()."')\">".$v->get_nip()."</br>".$v->get_nama()."</li>";
            }
        }else{
            $pb= new Pegawai($this->registry);
            $pb->set_kd_peg($nip);
            $d_pb = $pb->get_penerima_by_nip($pb,true);
            foreach ($d_pb as $v){
                echo "<li onClick=\"fill('".$v->get_kd_peg()."')\">".$v->get_kd_peg()."</br>".$v->get_nama()."</li>";
            }
        }
        
        echo "</ul>";
    }
    
    /*
     * filter di hal daftar pb
     */
    
    public function filter_pb($halaman=1,$batas=1){
//        $param = $_POST['param'];
//        $atr = explode(",", $param);
        $role = Session::get('role');
        $this->view->univ = $_POST['univ'];
        $this->view->thn_masuk = $_POST['thn_masuk'];
        $this->view->status = $_POST['status'];
//        echo $_POST['univ']." ".$_POST['thn_masuk']." ".$_POST['status'];
        $pb = new Penerima($this->registry);
        $this->view->d_pb_all = $pb->get_penerima_filter($univ, $thn_masuk, $status,$this->kd_user);
        if($role!=2) $this->view->d_pb_all = $pb->get_penerima_filter($univ, $thn_masuk, $status,0);
        $this->view->nilai = new Nilai($this->registry);
        /**start paging**/
        $url = 'penerima/filter_pb';
        $this->view->url = $url;
        $this->view->paging = new Paging($url, $batas, $halaman);
        $this->view->jmlData = count($this->view->d_pb_all);
        $posisi = $this->view->paging->cari_posisi();
        $this->view->d_pb = $pb->get_penerima_filter($this->view->univ, $this->view->thn_masuk, $this->view->status,$this->kd_user);
        if($role!=2) $this->view->d_pb = $pb->get_penerima_filter($this->view->univ, $this->view->thn_masuk, $this->view->status,0);
        /**end paging**/
        $this->view->load('riwayat_tb/tabel_d_pb');
    }
    
    /*
     * cari berdasarkan nama
     */
    public function cari(){
        $name = $_POST['name'];
        $pb = new Penerima($this->registry);
        $pb->set_nama($name);
        if(Session::get('role')==2) {
            $this->view->d_pb = $pb->get_penerima_by_name($pb,$this->kd_user);
        }else{
            $this->view->d_pb = $pb->get_penerima_by_name($pb,0);
        }
        $this->view->nilai = new Nilai($this->registry);
        $this->view->load('riwayat_tb/tabel_d_pb');
    }
    
    public function cetak_daftar_penerima(){
        $kd_univ = $_POST['univ'];
        $thn = $_POST['thn'];
        $status = $_POST['status'];
        $this->view->univ = '';
        $this->view->thn = '';
        $this->view->status = '';
        $pb = new Penerima($this->registry);
        $role = Session::get('role');
        if($kd_univ==0 && $thn==0 && $status==0){
            if($role==2){
                $this->view->d_pb = $pb->get_penerima($this->kd_user);
            }else{
                $this->view->d_pb = $pb->get_penerima();
            }
        }else{
            if($role==2){
                $this->view->d_pb = $pb->get_penerima_filter($kd_univ, $thn, $status, $this->kd_user);
            }else{
                $this->view->d_pb = $pb->get_penerima_filter($kd_univ, $thn, $status, $this->kd_user);
            }
        }
        
        if($kd_univ!=0){
            $univ = new Universitas($this->registry);
            $univ->set_kode_in($kd_univ);
            $univ = $univ->get_univ_by_id($univ);
            $this->view->univ = $univ->get_nama();
        }
        if($thn!=0){
            $this->view->thn = $thn;
        }
        if($status!=0){
            $sts = new Status();
            $status = $sts->get_by_id($status);
            $this->view->status = $status->nm_status;
        }
        $this->view->load('riwayat_tb/cetak_daftar_penerima');
    }
    
    public function cetak_profil($id){
        $pb = new Penerima($this->registry); //mendapatkan informasi pb
        $st = new SuratTugas($this->registry); //mendapatkan informasi surat tugas
        $el = new ElemenBeasiswa($this->registry); //mendapatkan pembayaran
        $bank = new Bank($this->registry); //mendapatkan nama bank
        $jst = new JenisSuratTugas($this->registry); //mendapatkan jenis surat tugas
        $jur = new Jurusan($this->registry);
        $univ = new Universitas($this->registry);
        $nilai = new Nilai($this->registry);
        $cuti = new Cuti($this->registry);
        $mas = new MasalahPenerima($this->registry);
        $pemb = new PemberiBeasiswa();
        $beaya = new Biaya();
        $role = Session::get('role');
        $pb->set_kd_pb($id);
        $this->view->d_pb = $pb->get_penerima_by_id($pb,$this->kd_user);
        if($role==3) $this->view->d_pb = $pb->get_penerima_by_id($pb);
        $st->set_kd_st($this->view->d_pb->get_st());
        $this->view->d_st = $st->get_surat_tugas_by_id($st,$this->kd_user);
        if($role==3) $this->view->d_st = $st->get_surat_tugas_by_id($st);
        $pemb = $pemb->get_by_id($this->view->d_st->get_pemberi());
        $this->view->d_pemb = $pemb->nama_pemberi;
        $this->view->d_bank = $bank->get_bank_id($this->view->d_pb->get_bank());
        $jur->set_kode_jur($this->view->d_pb->get_jur());
        $this->view->d_jur = $jur->get_jur_by_id($jur);
        $jst->set_kode($this->view->d_st->get_jenis_st());
        $this->view->d_jst = $jst->get_jst_by_id($jst);
        $this->view->d_univ = $univ->get_univ_by_jur($this->view->d_jur->get_kode_jur());
        $this->view->d_nil = $nilai->get_nilai($pb);
        $this->view->d_cur_ipk = $nilai->get_current_ipk($pb);
        $this->view->d_cuti = $cuti->get_cuti($this->kd_user,$pb);
        if($role==3) $this->view->d_cuti = $cuti->get_cuti(0,$pb);
        $this->view->d_rwt_beas = $pb->get_penerima_by_column($pb,$this->kd_user,'nip',true);
        if($role==3) $this->view->d_rwt_beas = $pb->get_penerima_by_column($pb,0,'nip',true);
        $elem = $el->get_elem_per_pb($pb, false);
        $bea = $beaya->get_cost_per_pb($pb,false);
        $this->view->d_mas = $mas->get_masalah($pb);
        $d_bea = array();
        /*
            * sementara versi dummy dulu ye :p
            */
        foreach($elem as $v){
            $d = new BiayaPenerimaBeasiswa();
            $is_jadup = ($v->get_kd_r()=='tunjangan hidup');
            $is_buku = ($v->get_kd_r()=='buku');
            $nama = $v->get_kd_r();
            if($is_jadup){
                $nama .= " ".$v->get_bln()." ".$v->get_thn();
            }
            if($is_buku){
                $bulan = Tanggal::bulan_num($v->get_bln());
                $bulan = ($bulan==1)?'ganjil':'genap';
                $nama .= " semester ".$bulan." ".$v->get_thn();
            }
            $d->set_nama_biaya($nama);
            $d->set_jumlah_biaya($v->get_total_bayar());
            $d_bea[] = $d;
        }

        foreach($bea as $v){
            $d = new BiayaPenerimaBeasiswa();
            $d->set_nama_biaya($v->nama_tagihan);
            $d->set_jumlah_biaya($v->biaya_per_pegawai);
            $d_bea[] = $d;
        }
        $this->view->d_bea = $d_bea;
        
        $this->view->load('profil/cetak_profil');
    }

    public function __destruct() {
        parent::__destruct();
    }
}
?>
