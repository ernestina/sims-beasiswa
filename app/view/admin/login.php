<!DOCTYPE html>
<html>
    <head>
        <title>SIMS - LOGIN</title>
        <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo URL; ?>public/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css">

        <script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.form.js"></script>
        <script src="<?php echo URL; ?>public/js/myjs.js"></script>
        <script src="<?php echo URL; ?>public/js/teamdf-jquery-number/jquery.number.js"></script>
        <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
    </head>
    <body>
        <div>
            <div>LOGO</div>
            <div>
            <?php 
                if(isset($this->error)){
                    echo "<div style='color:red'><h2>".$this->error."<h2></div>";
                }
            ?>
            <form method="POST" action="<?php echo URL;?>auth/login">
                <div id="wuser" class="error"></div>
                <label>username</label><input type="text" name="user" id="nuser" placeholder="username">
                <div id="wpass" class="error"></div>
                <label>username</label><input type="password" name="pass" id="pass">
                <input type="reset" value="KESET"><input type="submit" value="LOGIN" onclick="return cek();">
            </form>
            </div>
        </div>
    </body>
</html>

<script type="text/javascript">
$(function(){
    $('#nuser').focus();
    $('#wuser').fadeOut();
    $('#wpass').fadeOut();
    $('#nuser').keyup(function(){
        if($('#nuser').val()!=''){
            $('#wuser').fadeOut(200);
        }
    })
    $('#pass').keyup(function(){
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