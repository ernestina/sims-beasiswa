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
            <input type="hidden" id="kd_pb" name="kd_pb" value="<?php echo $this->kd_pb;?>">
            <tr><td colspan="2"><h3>REKAM NILAI SEMESTER</h3></td></tr>
            <tr><td>Nama</td><td><?php echo $this->d_pb->get_nama();?></td></tr>
            <tr><td>NIP</td><td><?php echo $this->d_pb->get_nip();?></td></tr>
            <div id="winput" class="error"></div>
            <tr><td><label>IPS</label></td><td><input type="text" id="ips" name="ips"></td></tr>
            <tr><td><label>IPK</label></td><td><input type="text" id="ipk" name="ipk"></td></tr>
            <tr><td><label>Semester</label></td><td><select id="semester" name="semester">
                        <?php 
                            for($i=1;$i<=10;$i++){
                                echo "<option value=$i>Semester $i</option>";
                            }
                        ?>
                    </select></td></tr>
            <tr><td><label>File</label></td><td><input type="file" id="sfile" name="sfile"></td></tr>
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
        $('#ips').keyup(function(){
            $('.error').fadeOut(100);
        })
        
        $('#ipk').keyup(function(){
            $('.error').fadeOut(100);
        })
        
        $('#sfile').change(function(){
            $('.error').fadeOut(100);
        })
    }
    
    function goSelect(){
        var kd_pb = document.getElementById('kd_pb').value;
        var ips = document.getElementById('ips').value;
        var ipk = document.getElementById('ipk').value;
        var sem = document.getElementById('semester').value;
        var sfile = document.getElementById('sfile').value;
        var pattern = '^[1-9]{1}(\.[0-9]{1,2})$';
        if(ips==""){
            var winput = "Indeks Prestasi Semester harus diisi!"
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }else if(!ips.match(pattern)){
            var winput = "Indeks Prestasi Semester tidak sesuai format!";
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }
        
        if(ipk==""){
            var winput = "Indeks Prestasi Kumulatif harus diisi!";
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }else if(!ipk.match(pattern)){
            var winput = "Indeks Prestasi Kumulatif tidak sesuai format!";
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }
        
        if(sfile==""){
            var winput = "File harus dipilih!"
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }else{
            var fsplit = sfile.split(".");
            var ext = fsplit[fsplit.length-1];
            if(ext!='pdf'){
                var winput = "Format file harus pdf!"
                $('#winput').html(winput);
                $('#winput').fadeIn(200);

                return false;
            }
        }
        
        var formData = new FormData($('#form_rekam')[0]);
        
        $.ajax({
            url: '<?php echo URL; ?>penerima/add_nilai',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                    window.opener.callFromDialog(kd_pb,'nilai'); //or use //window.opener.document.getElementById(idFromCallPage).value = data;
                    window.close();
            },
            cache: false,
            contentType: false,
            processData: false
        });
        
    }
    
</script>