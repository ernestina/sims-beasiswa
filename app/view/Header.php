<!DOCTYPE html>
<html>
    <head>
        <title>.:Treascho:.</title>   
        <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo URL; ?>public/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
<!--        <script src="<?php echo URL; ?>public/js/jquery-ui-1.10.3/ui/i18n/jquery.ui.datepicker-id.js"></script>-->
		<script src="<?php echo URL; ?>public/js/jquery-ui-1.10.3/ui/jquery.ui.datepicker.js"></script>

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
        <link href="<?php echo URL; ?>public/css/notifikasi.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/autocomplete.css" rel="stylesheet">
        <script type="text/javascript">
            $(function(){
                $('#datepicker').datepicker({
                    changeMonth: true,changeYear:true
                }); 
                $('#datepicker1').datepicker({
                    changeMonth: true,changeYear:true
                });
                $('#datepicker2').datepicker({
                    changeMonth: true,changeYear:true
                });
            });
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <div class="kolom1">
                    <a href="<?php echo URL; ?>" style="cursor:  pointer"><img src="<?php echo URL; ?>public/img/treascho-new.png" style="padding-left: 40px; padding-bottom: 10px" width="40%"></a>
                </div>
				
                <div id="jam" class="kolom2" >

                    <p id="jam" onload="jam()"></p>

                </div>
				<?php
				$role="";
				if(Session::get('role')==1){$role="admin";}
				if(Session::get('role')==2){$role="pic";}
				if(Session::get('role')==3){$role="pic bagian umum";}
				if(Session::get('role')==4){$role="pic bagian keuangan";}
				if(Session::get('role')==5){$role="pic bagian kepegawaian";}
				if(Session::get('role')==6){$role="pic bagian pengembangan";}
				
				?>
                <div style="float: top; margin-top: 20px"><?php echo Session::get('user').'</br>anda login sebagai '.  strtoupper($role);?></div>
            </div>

            <div id="menu">
                <ul>
                    <li class="nav">
                        <a href="<?php echo URL; ?>index">BERANDA</a>
                    </li>
                    <?php if(Auth::is_role('1')) { ?>
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
                            <!--<li><a href="<?php echo URL; ?>admin/config"> <i class="icon-wrench icon-white"></i>  Setting</a></li>-->
            <!--                <li><a href="<?php echo URL . '#' ?>">IP-Server</a></li>-->
                            <li><a href="<?php echo URL; ?>admin/backup"><i class="icon-hdd icon-white"></i>  Backup</a></li>
                            <li><a href="<?php echo URL; ?>admin/restore"><i class="icon-repeat icon-white"></i>  Restore</a></li>
                        </ul>
                    </li>
                    <?php } 
                    
                    if(Auth::is_role('2') || Auth::is_role('3') || Auth::is_role('4') || Auth::is_role('6')){ ?>
                    <li class="subnav">
                        <a href="<?php echo URL . 'kontrak/display'; ?>">KONTRAK</a>
                        <ul>
                            <li><a href="<?php echo URL . 'kontrak/display'; ?>"><i class="icon-folder-open icon-white"></i>  Data Kontrak</a></li>
                            <li><a href="<?php echo URL . 'kontrak/monitoring'; ?>"><i class="icon-eye-open icon-white"></i>  Monitoring Kontrak</a></li>
                        </ul>
                    </li>
					<?php } ?>
					
					<?php
					if(Auth::is_role('2') || Auth::is_role('5') || Auth::is_role('6')){ ?>
                    <li class="subnav">
                        <a href="<?php echo URL . 'penerima/datapb'; ?>">PROFIL BEASISWA</a>
                        <ul>
                            <?php if(Auth::is_role('2') || Auth::is_role('6')){ ?><li><a href="<?php echo URL . 'surattugas/datast' ?>"><i class="icon-file icon-white"></i>  Surat Tugas</a></li><?php } ?>
                            <?php if(Auth::is_role('2') || Auth::is_role('5') || Auth::is_role('6')){ ?><li><a href="<?php echo URL . 'penerima/datapb'; ?>"><i class="icon-user icon-white"></i>  Penerima Beasiswa</a></li><?php } ?>
                            <?php if(Auth::is_role('2') || Auth::is_role('6')){ ?><li><a href="<?php echo URL . 'cuti/datasc' ?>"><i class="icon-road icon-white"></i>  Surat Cuti</a></li><?php } ?>
                        </ul>
                    </li>
					<?php } ?>
					
					<?php
					if(Auth::is_role('2') || Auth::is_role('4') || Auth::is_role('6')){ ?>
                    <li class="subnav">
                        <a href="<?php echo URL . 'elemenBeasiswa/mon_pembayaran' ?>">ELEMEN BEASISWA</a>
                        <ul>
                            <li><a href="<?php echo URL . 'elemenBeasiswa/mon_pembayaran' ?>"><i class="icon-tags icon-white"></i>  Monitoring Pembayaran</a></li>
                            <li><a href="<?php echo URL . 'elemenBeasiswa/viewJadup'; ?>"><i class="icon-leaf icon-white"></i>  Tunjangan Hidup</a></li>
                            <li><a href="<?php echo URL . 'elemenBeasiswa/viewUangBuku'; ?>"><i class="icon-book icon-white"></i>  Tunjangan Buku</a></li>
                            <li><a href="<?php echo URL . 'elemenBeasiswa/viewSkripsi'; ?>" style="font-size: 70%"><i class="icon-certificate icon-white"></i>  Tunjangan Skripsi/TA/Tesis</a></li>
                        </ul>
                    </li>
                    <?php } ?>
                    <li class="nav">
                        <a href="<?php echo URL . 'auth/logout' ?>">LOGOUT</a>
                    </li>
<!--                    <li class="nav">
                        <a class="blok" href="<?php echo URL.'auth/logout';?>" title="logout">
                            <img class="profil" src="<?php echo URL; ?>public/img/pic.jpg" />
                        </a>
                    </li>-->
                </ul>
            </div>
            <script>
                jam();
            </script>





