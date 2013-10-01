<div id="top"><h2>BACKUP</h2>
<div class="kolom3" align="center">
    <fieldset><legend>Backup Database</legend>
        <div id="form-input">
                <form method="POST" action="<?php
                $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'
                ?>">
                    <div id="whost" class="error"></div>
                    <input type="file" name="fupload" id="fupload">
                    <ul class="inline tengah">
                        <li><input class="normal" type="submit" onclick="" value="BATAL"></li>
                        <li><input class="sukses" type="submit" name="add_conf" value="BACKUP" onClick="return cek();"></li>
                    </ul>
                </form>
            
        </div>
    </fieldset>
</div>
<div class="kolom4">
	<fieldset><legend>Petunjuk melakukan Backup Database</legend>
		<p style="margin-top: 0px; padding-left: 20px">Backup merupakan fungsi untuk menyimpan basis data sementara, sehingga ketika terjadi kesalahan/gagal menyimpan pada server pusat dapat dikembalikan (restore) ke posisi basis data semula. Backup sebaiknya dilakukan: <br><br>
			+ Setiap sebelum/selesai melakukan update terhadap data <br>
			+ Setiap periode/bulan sekali <br>
			+ Pada komputer selain komputer server aplikasi, misalnya CD, flashdisk, komputer pribadi, dsb. <br>
		
		</p>
	</fieldset>
</div> <!--kolom4-->
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