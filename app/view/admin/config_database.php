<div id="top"><h2>PENGATURAN</h2>
<div class="kolom3">
<fieldset><legend>Pegaturan Database</legend>
		<div id="form-input"><div class="kiri">
        <form method="POST" action="<?php 
            
                $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'
            
            ?>">
        
            <div id="whost" class="error"></div>
        <label>IP - HOST</label><input type="text" name="host" id="host" size="8" value="<?php echo isset($this->ubah)?$this->data->host:'';?>">
        <div id="wdb" class="error"></div>
        <label>DATABASE</label><input type="text" name="db" id="db" size="50" value="<?php echo isset($this->ubah)?$this->data->db:'';?>">
        <div id="wusername" class="error"></div>
        <label>USERNAME</label><input type="text" name="username" id="username" value="<?php echo isset($this->ubah)?$this->data->username:'';?>">
        <div id="wpass" class="error"></div>
        <label>PASSWORD</label><input type="password" name="pass" id="pass" size="15" value="<?php echo isset($this->ubah)?$this->data->pass:'';?>">
        <label>ULANGI PASSWORD</label><input type="password" name="pass_u" id="pass_u" size="15" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telepon():(isset($this->d_rekam)?$this->d_rekam->get_telepon():'');?>">
        <ul class="inline tengah">
			<li><input class="normal" type="submit" onclick="" value="BATAL"></li>
			<li><input class="sukses" type="submit" name="add_conf" value="SIMPAN" onClick="return cek();"></li>
		</ul>
        </form>
    </div>
	</div>
   </fieldset>
</div>
<div class="kolom4" id="table">
    <fieldset><legend>Pengaturan Server</legend>
    <div id="table-title"></div>
    <div id="table-content">
        <table class="table-bordered zebra">
        <tr><td>IP - HOST</td><td><?php echo $this->data->host;?></td></tr>
        <tr><td>DATABASE</td><td><?php echo $this->data->db;?></td></tr>
        <tr><td>USERNAME</td><td><?php echo $this->data->username;?></td></tr>
        <tr><td>PASSWORD</td><td><?php echo $this->data->pass;?></td></tr>
        <tr><td colspan="2"  halign="left" valign="top"><a href="<?php echo URL.'admin/config/1';?>"><input class="sukses" type="submit" value="UBAH"></a></td></tr>
    </table>
    </div>
</div>
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