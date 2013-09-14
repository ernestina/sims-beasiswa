<!DOCTYPE html>
<html>
    <head>
        <title></title>
    <header><b>SCHOLARSHIP INFORMATION MANAGEMENT SYSTEM</b></BR>
        Bagian Pengembangan Pegawai, Setditjen PBN Jakarta
    </header>
    <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>

    <script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
<!--    <link href="<?php echo URL; ?>public/css/flick/jquery-ui-1.10.1.custom.css" rel="stylesheet">-->
    <link href="<?php echo URL; ?>public/css/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo URL; ?>public/css/ui.theme.css" rel="stylesheet">
    <hr>
    <script type="text/javascript">
    $(function(){
       $('#datepicker').datepicker(); 
    });
    </script>
    </head>
    <body>
        <div id="menu">
            <ul>
                <li><a href="<?php echo URL.'surattugas/datast'?>">Data Surat Tugas</a></li>
                <li>Data Cuti</li>
                <li><a href="<?php echo URL.'penerima/datapb';?>">Data Penerima Beasiswa</a></li>
                <li>Data Master</li>
            </ul>
        </div>