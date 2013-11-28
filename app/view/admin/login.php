<!DOCTYPE html>
<html>
    <head>
        <title>.: Scholarship Management and Early Warning System beta.1.0 :.</title>
        <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
		<link rel="icon" type="image/png" href="<?php echo URL; ?>public/img/treascho-ico.png">
        <link rel="stylesheet" href="<?php echo URL; ?>public/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css">

        <script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.form.js"></script>
        <script src="<?php echo URL; ?>public/js/myjs.js"></script>
        <script src="<?php echo URL; ?>public/js/teamdf-jquery-number/jquery.number.js"></script>
        <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/form.css" rel="stylesheet">
    </head>
    <body>
<!--        <div>
            <div>LOGO</div>
            <div>
            <?php
                if(isset($this->error)){
                    echo "<div style='color:red' id=notfound><h2>".$this->error."<h2></div>";
                }
            ?>
            <form method="POST" action="<?php echo URL;?>auth/login">
                <div id="wuser" class="error"></div>
                <label>username</label><input type="text" name="user" id="nuser" placeholder="username">
                <div id="wpass" class="error"></div>
                <label>password</label><input type="password" name="pass" id="pass">
                <input type="reset" value="KESET"><input type="submit" value="LOGIN" onclick="return cek();">
            </form>
            </div>
        </div>-->
        <center><a class="logo" href="<?php echo URL;?>notifikasi"><img title="SIMS" height="64" src="<?php echo URL; ?>public/img/treascho-new.png" alt="SIMS" style="padding-top: 40px"/></a></center>
		<div class="login-container">
		<div id="menu">
		<ul>
		<li class="nav"><a> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </a></li>
		<li class="nav"><a href="<?php echo URL; ?>notifikasi/index/1" title="tampilan semua notifikasi"> NOTIFIKASI I</a></li>
		<li class="nav"><a href="<?php echo URL; ?>notifikasi/index/2" title="jumlah notifikasi per PIC"> NOTIFIKASI II</a></li>
		</ul>
		</div>
            
			<div class="form login">
            <?php 
                if(isset($this->error)){
                    echo "<div style='color:red' id=notfound><h2>".$this->error."<h2></div>";
                }
            ?>
            <center><h1>LOGIN</h1></center>
			<form id="login-form" action="<?php echo URL;?>auth/login" method="post">	<div class="row">
                            <input class="log" name="user" id="nuser" type="text" placeholder="Username"/>
                            <div class="error" id="wuser" style="display:none"></div>	</div>
                    <div class="row">
                            <input class="log" style="" name="pass" id="pass" type="password" placeholder="Password" />
                                            <div class="error" id="wpass" style="display:none"></div>	</div>
                    <div class="row buttons">
                            <label> <input id="button" type="submit" name="yt0" value="Login" onClick="return cek()"/> </label>
                    </div>
            </form>
			
            <div class="clearfix"></div>
            <div class="copyright">
			<BR><BR><BR>
                                            
											Scholarship Management and Early Warning System beta.1.0 <br>Copyright &copy; 2013 Bagian Pengembangan Pegawai - 
                                            <a class="djpbn" title="Direktorat Jenderal Perbendaharaan" href="http://www.perbendaharaan.go.id/">Ditjen Perbendaharaan</a>
<?php 
            ?>
                                    </div>
            
			</div>
            
            </div>
    </body>
</html>

<script type="text/javascript">
$(function(){
    var notfound = document.getElementById('notfound');
    $('#nuser').focus();
    $('#wuser').fadeOut();
    $('#wpass').fadeOut();
    $('#nuser').keyup(function(){
        if(notfound!=null){
            $('#notfound').fadeOut(200);
        }
        if($('#nuser').val()!=''){
            $('#wuser').fadeOut(200);
        }
    })
    $('#pass').keyup(function(){
        if(notfound!=null){
            $('#notfound').fadeOut(200);
        }
        if($('#npass').val()!=''){
            $('#wpass').fadeOut(200);
        }
    })
})

function cek(){
    var jml=0;
    if(document.getElementById('nuser').value==''){
        var data = "Isikan nama user anda!";
        $('#wuser').fadeIn(200);
        $('#wuser').html(data);
        jml++;
    }
    
    if(document.getElementById('pass').value==''){
        var data = "Isikan password anda!";
        $('#wpass').fadeIn(200);
        $('#wpass').html(data);
        jml++;
    }
    
    if(jml>0){
        return false;
    }else{
        return true;
    }
}

</script>