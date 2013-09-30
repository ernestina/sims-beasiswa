<div class="kolom3" align="centre">
    <fieldset><legend>Restore Database</legend>
        <div id="form-input"><div class="kiri">
                <form method="POST" action="<?php
                $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'
                ?>">
                    <div id="whost" class="error"></div>
                    <label></label><input type="file" name="fupload" id="fupload">
                    <ul class="inline tengah">
                        <li><input class="normal" type="submit" onclick="" value="BATAL"></li>
                        <li><input class="sukses" type="submit" name="add_conf" value="RESTORE" onClick="return cek();"></li>
                    </ul>
                </form>
            </div>
        </div>
    </fieldset>
</div>

<script type="text/javascript">

    $(function(){
        $('.error').fadeOut(0);
    
        hideWarning('whost','host','keyup');
    })

    function hideWarning(id_error,id_input,action){
        switch (action){
            case 'keyup':
                $('#'+id_input).keyup(function(){
                    $('#'+id_error).fadeOut(200);
                });
                break;
        }
    
    }

    function cek(){
        var host = document.getElementById('host').value;
        var db = document.getElementById('db').value;
        var uname = document.getElementById('username').value;
        var pass = document.getElementById('pass').value;
        var pass_u = document.getElementById('pass_u').value;
        var jml=0;
        if(host==''){
            var whost = "host harus diisi!";
            $('#whost').html(whost);
            $('#whost').fadeIn(100);
            jml++;
        }
    
        if(db==''){
            var wdb = "nama database harus diisi!";
            $('#wdb').html(wdb);
            $('#wdb').fadeIn(100);
            jml++;
        }
    
        if(uname==''){
            var wusername = "username harus diisi!";
            $('#wusername').html(wusername);
            $('#wusername').fadeIn(100);
            jml++;
        }
    
        if(pass != pass_u){
            var wpass = "password tidak sama!";
            $('#wpass').html(wpass);
            $('#wpass').fadeIn(100);
            jml++;
        }
    
        if(jml>0){
            return false;
        }else{
            return true;
        }
    
    }
</script>