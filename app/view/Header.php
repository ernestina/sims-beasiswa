<!DOCTYPE html>
<html>
    <head>
        <title></title>
    <header><b>SCHOLARSHIP INFORMATION MANAGEMENT SYSTEM</b></BR>
        <p>Bagian Pengembangan Pegawai, Setditjen PBN Jakarta</p>
    </header>
    <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>

    <script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<!--    <link href="<?php echo URL; ?>public/css/flick/jquery-ui-1.10.1.custom.css" rel="stylesheet">-->
    <link href="<?php echo URL; ?>public/css/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/ui.theme.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/sims.css" rel="stylesheet">
    <hr>
    <script type="text/javascript">
    $(function(){
       $('#datepicker').datepicker(); 
    });
    </script>
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
            <ul class="menu" rel="sam1">
                <li><a href="<?php echo URL.'surattugas/datast'?>">Surat Tugas</a></li>
                <li><a href="">Cuti</a></li>
                <li><a href="<?php echo URL.'penerima/datapb';?>">Penerima Beasiswa</a></li>
                <li><a href="">Admin</a></li>
            </ul>
            </div>
        </div>