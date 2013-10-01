<!DOCTYPE html>
<html>
    <head>
        <title>rekam penerima beasiswa</title>
        <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
        <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
    </head>
    <body style="max-width: 370px;max-height: 500px; text-align: center; overflow:no-content;">
<div id="dialog_pb" style="text-align: left;">
    
    <form id="form_rekam" method="POST" action="">
        <table>
            <input type="hidden" id="cek" value="">
            <input type="hidden" id="kd_pb" name="kd_pb" value="<?php echo $this->kd_pb;?>">
            <tr><td colspan="2"><h3>REKAM PERMASALAHAN</h3></td></tr>
            <tr><td>Nama</td><td><?php echo $this->d_pb->get_nama();?></td></tr>
            <tr><td>NIP</td><td><?php echo $this->d_pb->get_nip();?></td></tr>
            <div id="winput" class="error"></div>
            <tr><td><label>Uraian</label></td><td><textarea id="uraian" name="uraian" cols="40" rows="10"></textarea></td></tr>
            <tr><td><label>Sumber Permasalahan</label></td><td><input type="text" id="sumber" name="sumber"></td></tr>
            <tr><td colspan="2"><input type="button" id="bt_ok" value="simpan" onclick="return goSelect();"></td></tr>
        </table>
    </form>
</div>
<div id="test"></div>
    </body>
<script>
    $(function(){
        $('.error').fadeOut(0);
        hideError();
        $('#t_nip').focus();
    });
    
    function hideError(){
        $('#uraian').keyup(function(){
            $('.error').fadeOut(100);
        })
        
        $('#sumber').keyup(function(){
            $('.error').fadeOut(100);
        })
    }
    
    function goSelect(){
        var kd_pb = document.getElementById('kd_pb').value;
        var uraian = document.getElementById('uraian').value;
        var sumber = document.getElementById('sumber').value;
        
        if(uraian==""){
            var winput = "uraian permasalahan harus diisi!"
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }
        
        if(sumber==""){
            var winput = "sumber permasalahan harus diisi!"
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }
        
        var formData = new FormData($('#form_rekam')[0]);
        
        $.ajax({
            url: '<?php echo URL; ?>penerima/add_problem',
            type: 'POST',
            data: formData,
            async: false,
            success: function () {
                    window.opener.callFromDialog(kd_pb,'problem'); //or use //window.opener.document.getElementById(idFromCallPage).value = data;
                    window.close();
            },
            cache: false,
            contentType: false,
            processData: false
        });
        
    }
    
</script>