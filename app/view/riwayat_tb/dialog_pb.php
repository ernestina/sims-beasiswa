<!DOCTYPE html>
<html>
    <head>
        <title>rekam penerima beasiswa</title>
        <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
        <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/autocomplete.css" rel="stylesheet">
    </head>
    <body style="max-width: 370px;max-height: 500px; text-align: center; overflow:no-content;">
<div id="dialog_pb" style="text-align: left;">
    
    <form id="form_add_pb" method="POST" action="">
        <table>
            <input type="hidden" id="cek" value="">
            <input type="hidden" id="kd_st" name="st" value="<?php echo $this->id;?>">
            <div id="winput" class="error"></div>
            <tr><td><label>NIP</label></td><td><input type="text" id="t_nip" name="nip" onkeyup="getNama(this.value);"></td></tr>
            <div id="suggestions" style="display:none"><div class="suggestionList"></div></div>
            <tr><td><label>Nama</label></td><td><input type="text" id="t_nm" name="nama" readonly></td></tr>
            <tr><td><label>Jenis Kelamin</label></td><td><input type="text" id="t_jk" name="jkel" readonly></td></tr>
            <tr><td><label>Golongan</label></td><td><input type="text" id="t_gol" name="gol" readonly></td></tr>
            <tr><td><label>Unit Asal</label></td><td><input type="text" id="t_unit" name="unit" readonly></td></tr>
            <tr><td><label>Email</label></td><td><input type="text" id="t_email" name="email"></td></tr>
            <tr><td><label>No. HP</label></td><td><input type="text" id="t_hp" name="telp"></td></tr>
            <tr><td><label>Bank Penerima</label></td><td>
                    <select id="t_bank" name="bank" type="text">
                        <?php 
                            foreach($this->d_bank as $val){
                                echo "<option value=".$val->get_id().">".$val->get_nama()."</option>";
                            }
                        ?>
                    </select>
                </td></tr>
<!--            <tr><td><label>Cabang</label></td><td><input type="text" id="t_cb" name="t_cb"></td></tr>-->
            <tr><td><label>No. Rekening</label></td><td><input type="text" id="t_rek" name="no_rek"></td></tr>
            <tr><td colspan="2"><input type="button" id="bt_ok" value="Simpan" onclick="return goSelect();"></td></tr>
        </table>
    </form>
</div>
<div id="test"></div>
    </body>
<script>
    $(function(){
        $('.error').fadeOut(0);
//        $('#atc_nip').fadeOut(0);
        hideError();
        $('#t_nip').focus();
        $('#t_nip').keyup(function(){
           if($('#t_nip').val()==''){
                $('#suggestions').fadeOut(0);
           }else{
               auto_nip(this.value);
           } 
        });
    });
    
    function hideError(){
        $('#t_nip').keyup(function(){
            $('.error').fadeOut(100);
        })
    }
    
    function auto_nip(nip){
        $.post('<?php echo URL;?>penerima/get_nip_data',{param:""+nip+""},
            function(data){
                $('#suggestions').fadeIn(10);
                $('.suggestionList').html(data);
            }
        );
    }
    
    function fill(nip){
        $('#t_nip').val(nip);
        getNama(nip);
        $('#suggestions').fadeOut(100);
    }
    
    function getNama(nip){
//        $.post("<?php echo URL; ?>penerima/get_nama_peg", {param:""+nip+""},
//        function(data){
//            $('#t_nm').val(data);
//        });
        $.ajax({
           type:"post",
           url: "<?php echo URL; ?>penerima/get_nama_peg",
           data:"param="+nip,
           dataType:"json",
           success:function(data){
               $('#t_nm').val(data.nama);
               $('#t_jk').val(data.jkel);
               $('#t_gol').val(data.gol);
               $('#t_unit').val(data.unit);
               $('#cek').val(data.registered);
           },
           error:function(){
               alert("nip tidak ada dalam database!");
           }
        });
    }
    
    function goSelect(){
        var kd = document.getElementById('kd_st').value;
        var nip = document.getElementById('t_nip').value;
        var nm = document.getElementById('t_nm').value;
        var email = document.getElementById('t_email').value;
        var hp = document.getElementById('t_hp').value;
        var bank = document.getElementById('t_bank').value;
        var rek = document.getElementById('t_rek').value;
        var cek = document.getElementById('cek').value;
        
        if(nip==""){
            var winput = "masukkan nip pegawai!"
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }
        
        if(nm==""){
            var winput = "pegawai ini tidak terdaftar di database"
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }
        
        if(cek!=0){
            var winput = "pegawai ini telah terdaftar sebagai penerima beasiswa";
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }
//        validate(nip);
        
        /*$.post("<?php echo URL?>surattugas/cek_pb_on_st",{nip:""+nip+""},
        function(data){
            if(data==1){
                    var winput = "pegawai ini telah terdaftar sebagai penerima beasiswa"
                    $('#winput').html(winput);
                    cek = false;
                }
        });
        
        if(cek==false){
            return false;
        }*/
        
//        return false;
        //langsung menyimpan ke tabel penerima tb
//        var idFromCallPage = getUrlVars()["id"];
//        window.opener.callFromDialog(data); //or use //window.opener.document.getElementById(idFromCallPage).value = data;
//        window.close();
        
        var formData = new FormData($('#form_add_pb')[0]);
        
        $.ajax({
            url: '<?php echo URL; ?>penerima/add_from_dialog_to_st',
            type: 'POST',
            data: formData,
            async: false,
            success: function () {
//                $('#pesan').html(data)
                    window.opener.callFromDialog(kd); //or use //window.opener.document.getElementById(idFromCallPage).value = data;
                    window.close();
            },
            cache: false,
            contentType: false,
            processData: false
        });
        
    }
    
    function validate(nip){
        var cek;
        $.ajax({
            type:'POST',
            url:'<?php echo URL?>surattugas/cek_pb_on_st',
            data:'nip='+nip,
            dataType:'json',
            success:function(data){
                /*if(data.cek>0){
                    var winput = "pegawai ini telah terdaftar sebagai penerima beasiswa"
                    $('#winput').html(winput);
                }*/
//                $('#cek').val(data.cek);
                cek = data.cek;
                return cek;
            }
        });
    }

    function getUrlVars(){
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }
    
    function rekam(){
        var formData = new FormData($('#form-rekam')[0]);
        
        $.ajax({
            url: '<?php echo URL; ?>penerima/input',
            type: 'POST',
            data: formData,
            async: false,
            success: function (data) {
                $('#pesan').html(data)
            },
            cache: false,
            contentType: false,
            processData: false
        });
        
        return false;
    }
    
</script>