<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$akses = array();
$akses['Auth'] = array(
                'login',
                'logout'
                );

/*
 * akses admin
 */
$akses['Admin'] = array(
                    '__construct',
                    'index',
                    'addUniversitas',
                    'updUniversitas',
                    'delUniversitas',
                    'addFakultas',
                    'updFakultas',
                    'delFakultas',
                    'addJurusan',
                    'updJurusan',
                    'delJurusan',
                    'addStrata',
                    'editStrata',
                    'updStrata',
                    'delStrata',
                    'addPemberi',
                    'editPemberi',
                    'updPemberi',
                    'delPemberi',
                    'addPejabat',
                    'editPejabat',
                    'updPejabat',
                    'delPejabat',
                    'addST',
                    'updST',
                    'delST',
                    'addCuti',
                    'updCuti',
                    'delCuti',
                    'list_bank',
                    'addBank',
                    'editBank',
                    'updateBank',
                    'deleteBank',
                    'listUser',
                    'addUser',
                    'editUser',
                    'updateUser',
                    'deleteUser',
                    'get_jur_by_univ',
                    'cekJabatan',
                    'config',
                    'backup',
                    'restore',
                    'get_method',
                    '__destruct',
                    'load_model');

/*
 * akses modul cuti
 */
$akses['Cuti'] = array(
                '__construct',
                'index',
                'datasc',
                'del_sc',
                'updct',
                'dialog_add_pb',
                'cekfile',
                'get_method',
                '__destruct',
                'load_model',
                'get_data_sc',
                'get_sc_by_name'
                );
/*
 * akses modul surat tugas
 */
$akses['Surattugas'] = array(
                '__construct',
                'datast',
                'updst',
                'del_st',
                'get_data_st',
                'dialog_add_pb',
                'addpb',
                'del_pb_from_st',
                'cek_pb_on_st',
                'view_st',
                'get_method',
                'load_model',
                '__destruct'
                );
/*
 * akses modul Elemen beasiswa
 */
$akses['ElemenBeasiswa'] = array(
                'index',
                'viewJadup',
                'addJadup',
                'delJadup',
                'viewUangBuku',
                'addUangBuku',
                'delUangBuku',
                'viewSkripsi',
                'addSkripsi',
                'delSkripsi',
                'get_method',
                'load_model',
                '__destruct'
                );
/*
 * akses modul kontrak
 */
$akses['Kontrak'] = array(
                'index',
                'display',
                'rekamKontrak',
                'get_jur_by_univ',
                'editKontrak',
                'updateKontrak',
                'get_data_kontrak',
                'biaya',
                'delKontrak',
                'rekamBiaya',
                'editBiaya',
                'updateBiaya',
                'updateBiaya2',
                'updateTagihan',
                'updatePembayaran',
                'delBiaya',
                'monitoring',
                'file',
                'fileBast',
                'fileBap',
                'fileRingKontrak',
                'fileKuitansi',
                'fileSp2d',
                'get_method',
                'load_model',
                'dataBiayaKontrak',
                'cetakBiayaKontrak',
                'viewRekamKontrak',
                'addTagihanPb',
                'getTagihanPbByBiaya',
                'rekamKontrak2',
                'viewEditKontrak',
                'updateKontrak2',
                '__destruct'
                );
/*
 * akses modul penerima
 */
$akses['Penerima'] = array(
                '__construct',
                'profil',
                'datapb',
                'penerima',
                'pb_by_st',
                'find_pb',
                'add_from_dialog_to_st',
                'updpenerima',
                'updprofil',
                'delpb',
                'get_nama_peg',
                'editpb',
                'for_edit_pb',
                'dialog_masalah',
                'add_problem',
                'get_masalah',
                'dialog_nilai',
                'add_nilai',
                'get_nilai',
                'view_transkrip',
                'view_foto',
                'view_skl',
                'view_spmt',
                'delnilai',
                'delmas',
                'cekfile',
                'get_data_pb',
                'get_tabel_peg',
                'get_method',
                '__destruct',
                'load_model',
                'get_nip_data',
                'filter_pb',
                'cari'
                );

?>
