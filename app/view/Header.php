<!DOCTYPE html>
<html>
    <head>
        <title>SIMS OKE</title>   
        <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo URL; ?>public/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
<!--        <script src="<?php echo URL; ?>public/js/jquery-ui-1.10.2/ui/jquery.ui.datepicker.js"></script>-->

        <script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.form.js"></script>
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
                            <li><a href="<?php echo URL; ?>admin/addUniversitas"><i class="icon-globe icon-white"></i>   Universitas</a></li>
                            <li><a href="<?php echo URL; ?>admin/addFakultas"><i class="icon-briefcase icon-white"></i>  Fakultas</a></li>
                            <li><a href="<?php echo URL; ?>admin/addJurusan"><i class="icon-book icon-white"></i>  Jurusan</a></li>
                            <li><a href="<?php echo URL; ?>admin/addStrata"><i class="icon-bookmark icon-white"></i>  Strata</a></li>
                            <li><a href="<?php echo URL; ?>admin/addPemberi"><i class="icon-gift icon-white"></i>  Pemberi Beasiswa</a></li>
                            <li><a href="<?php echo URL; ?>admin/addPejabat"><i class="icon-flag icon-white"></i>  Pejabat</a></li>
                            <li><a href="<?php echo URL; ?>admin/addST"><i class="icon-file icon-white"></i>  Jenis Surat Tugas</a></li>
                            <li><a href="<?php echo URL; ?>admin/addCuti"><i class="icon-road icon-white"></i>  Jenis Surat Cuti</a></li>
                            <li><a href="<?php echo URL; ?>admin/list_bank"><i class="icon-inbox icon-white"></i>  Bank</a></li>
                            <li><a href="<?php echo URL; ?>admin/listUser"><i class="icon-user icon-white"></i>  User</a></li>
                        </ul>
                    </li>
                    <li class="subnav">
                        <a href="#">DATABASE</a>
                        <ul>
                            <li><a href="<?php echo URL; ?>admin/config"> <i class="icon-wrench icon-white"></i>  Setting</a></li>
            <!--                <li><a href="<?php echo URL . '#' ?>">IP-Server</a></li>-->
                            <li><a href="<?php echo URL; ?>admin/backup"><i class="icon-hdd icon-white"></i>  Backup</a></li>
                            <li><a href="<?php echo URL; ?>admin/restore"><i class="icon-repeat icon-white"></i>  Restore</a></li>
                        </ul>
                    </li>
                    <li class="subnav">
                        <a href="<?php echo URL . 'kontrak/display'; ?>">KONTRAK</a>
                        <ul>
                            <li><a href="<?php echo URL . 'kontrak/display'; ?>"><i class="icon-folder-open icon-white"></i>  Data Kontrak</a></li>
                            <li><a href="<?php echo URL . '#'; ?>"><i class="icon-eye-open icon-white"></i>  Monitoring Kontrak</a></li>
                        </ul>
                    </li>
                    <li class="subnav">
                        <a href="<?php echo URL . 'penerima/datapb'; ?>">PROFIL BEASISWA</a>
                        <ul>
                            <li><a href="<?php echo URL . 'surattugas/datast' ?>"><i class="icon-file icon-white"></i>  Surat Tugas</a></li>
                            <li><a href="<?php echo URL . 'cuti/datasc' ?>"><i class="icon-road icon-white"></i>  Surat Cuti</a></li>
                            <li><a href="<?php echo URL . 'penerima/datapb'; ?>"><i class="icon-user icon-white"></i>  Penerima Beasiswa</a></li>
                        </ul>
                    </li>
                    <li class="subnav">
                        <a href="<?php echo URL . 'elemenBeasiswa/mon_pembayaran' ?>">ELEMEN BEASISWA</a>
                        <ul>
                            <li><a href="<?php echo URL . 'elemenBeasiswa/mon_pembayaran' ?>"><i class="icon-tags icon-white"></i>  Monitoring Pembayaran</a></li>
                            <li><a href="<?php echo URL . 'elemenBeasiswa/viewJadup'; ?>"><i class="icon-leaf icon-white"></i>  Tunjangan Hidup</a></li>
                            <li><a href="<?php echo URL . 'elemenBeasiswa/viewBuku'; ?>"><i class="icon-book icon-white"></i>  Tunjangan Buku</a></li>
                            <li><a href="<?php echo URL . 'elemenBeasiswa/viewSkripsi'; ?>" style="font-size: 70%"><i class="icon-certificate icon-white"></i>  Tunjangan Skripsi/TA/Tesis</a></li>
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





