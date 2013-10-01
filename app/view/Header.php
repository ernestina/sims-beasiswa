<!DOCTYPE html>
<html>
    <head>
        <title>SIMS OKE</title>   
        <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo URL; ?>public/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
<!--        <script src="<?php echo URL; ?>public/js/jquery-ui-1.10.2/ui/jquery.ui.datepicker.js"></script>-->

        <script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
        <script src="<?php echo URL; ?>public/js/myjs.js"></script>
        <script src="<?php echo URL; ?>public/js/teamdf-jquery-number/jquery.number.js"></script>
<!--    <link href="<?php echo URL; ?>public/css/flick/jquery-ui-1.10.1.custom.css" rel="stylesheet">-->
    <!--link href="<?php echo URL; ?>public/css/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/ui.theme.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/sims.css" rel="stylesheet"-->
        <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/dialog.css" rel="stylesheet">

        <script type="text/javascript">
            $(function(){
                $('#datepicker').datepicker(); 
                $('#datepicker1').datepicker();
                $('#datepicker2').datepicker();
            });
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div class="kolom1">
                    <img src="<?php echo URL; ?>public/img/logo.png" style="padding-left: 20px; padding-bottom: 10px">
                </div>
                <div id="jam" class="kolom2" >

                    <p id="jam" onload="jam()"></p>

                </div>
            </div>

            <div id="menu">
                <ul>
                    <li class="nav">
                        <a href="<?php echo URL; ?>index">BERANDA</a>
                    </li>
                    <li class="subnav">
                        <a href="<?php echo URL; ?>admin/addUniversitas">ADMIN</a>
                        <ul>
                            <li><a href="<?php echo URL; ?>admin/addUniversitas">UNIVERSITAS</a></li>
                            <li><a href="<?php echo URL; ?>admin/addFakultas">FAKULTAS</a></li>
                            <li><a href="<?php echo URL; ?>admin/addJurusan">JURUSAN</a></li>
                            <li><a href="<?php echo URL; ?>admin/addStrata">STRATA</a></li>
                            <li><a href="<?php echo URL; ?>admin/addPemberi">PEMBERI BEASISWA</a></li>
                            <li><a href="<?php echo URL; ?>admin/addPejabat">PEJABAT</a></li>
                            <li><a href="<?php echo URL; ?>admin/addST">JENIS SURAT TUGAS</a></li>
                            <li><a href="<?php echo URL; ?>admin/addCuti">JENIS SURAT CUTI</a></li>
                            <li><a href="<?php echo URL; ?>admin/list_bank">BANK</a></li>
                            <li><a href="<?php echo URL; ?>admin/listUser">USER</a></li>
                        </ul>
                    </li>
                    <li class="subnav">
                        <a href="#">DATABASE</a>
                        <ul>
                            <li><a href="<?php echo URL; ?>admin/config"">Setting</a></li>
            <!--                <li><a href="<?php echo URL . '#' ?>">IP-Server</a></li>-->
                            <li><a href="<?php echo URL; ?>admin/backup"">Backup</a></li>
                            <li><a href="<?php echo URL; ?>admin/restore"">Restore</a></li>
                        </ul>
                    </li>
                    <li class="subnav">
                        <a href="<?php echo URL . 'kontrak/display'; ?>">KONTRAK</a>
                        <ul>
                            <li><a href="<?php echo URL . 'kontrak/display'; ?>"> Data Kontrak</a></li>
                            <li><a href="<?php echo URL . '#'; ?>">Monitoring Kontrak</a></li>
                        </ul>
                    </li>
                    <li class="subnav">
                        <a href="<?php echo URL . 'penerima/datapb'; ?>">PROFIL BEASISWA</a>
                        <ul>
                            <li><a href="<?php echo URL . 'surattugas/datast' ?>">Surat Tugas</a></li>
                            <li><a href="<?php echo URL . '#' ?>">Surat Cuti</a></li>
                            <li><a href="<?php echo URL . 'penerima/datapb'; ?>">Penerima Beasiswa</a></li>
                        </ul>
                    </li>
                    <li class="subnav">
                        <a href="<?php echo URL . 'elemenBeasiswa/mon_pembayaran' ?>">ELEMEN BEASISWA</a>
                        <ul>
                            <li><a href="<?php echo URL . 'elemenBeasiswa/mon_pembayaran' ?>">Monitoring Pembayaran</a></li>
                            <li><a href="<?php echo URL . 'elemenBeasiswa/viewJadup'; ?>">Tunjangan Hidup</a></li>
                            <li><a href="<?php echo URL . 'elemenBeasiswa/viewBuku'; ?>">Tunjangan Buku</a></li>
                            <li><a href="<?php echo URL . 'elemenBeasiswa/viewSkripsi'; ?>">Tunjangan Skripsi/TA/Tesis</a></li>
                        </ul>
                    </li>
                    <li class="nav">
                        <a class="blok" href="#"><img class="profil" src="<?php echo URL; ?>public/img/pic.jpg" /></a>
                    </li>
                </ul>
            </div>
            <script>
                jam();
            </script>





