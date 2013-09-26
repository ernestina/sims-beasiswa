<div id="top">
    <h2>UBAH DATA PEMBERI BEASISWA</h2>
	<div class="kolom3">
	  <fieldset><legend>Ubah Data</legend>
		<div id="form-input">
        <form method="POST" action="<?php /*$_SERVER['PHP_SELF']; */ echo URL.'admin/updPemberi'?>">
        <div class="kiri">
			<input type="hidden" name="kd_pemberi" id="kd" size="50" value="<?php echo $this->pemberi->kd_pemberi;?>">
			
			<label>Nama</label>
			<input type="text" name="nama_pemberi" id="nama" size="50" value="<?php echo $this->pemberi->nama_pemberi;?>"><div id="wnama">
        
			<label>Alamat</label>
			<textarea type="text" name="alamat_pemberi" id="alamat" rows="8"><?php echo $this->pemberi->alamat_pemberi;?></textarea><div id="walamat"></div>
        
			<label>Telepon</label><input type="text" name="telp_pemberi" id="telepon" size="15" value="<?php echo $this->pemberi->telp_pemberi;?>"><div id="wtelepon"></div>
        
			<label>PIC</label><input type="text" name="pic_pemberi" id="PIC" size="30" value="<?php echo $this->pemberi->pic_pemberi;?>"><div id="wPIC"></div>
        
			<label>Telepon PIC</label><input type="text" name="telp_pic_pemberi" id="telp_pic" size="8" value="<?php echo $this->pemberi->telp_pic_pemberi;?>"><div id="wtelp_pic"></div>
        
			<ul class="inline tengah">
				<li><input class="normal" type="submit" onclick="window.location.href='<?php echo URL."admin/addPemberi"; ?>'" value="BATAL"></li>
			
				<li><input class="sukses" type="submit" name="upd_pemberi" value="SIMPAN" onclick="return cek();"></li>
			</ul>
			
		</div> <!--end class kiri-->
        </form>
    </div>
	</fieldset>
</div> <!--end kolom 3-->



<div class="kolom4" id="table">
	<fieldset><legend>Daftar Pemberi Beasiswa</legend>
    <div id="table-title"></div>
    <div id="table-content">
        <table class="table-bordered zebra scroll">
            <thead>
                <th width="5px">No</th>
                <th width="20%">Nama</th>
                <th width="35%">Alamat</th>
                <th width="15%">Telepon</th>
                <th width="15%">PIC</th>
                <th width="15%">Telp. PIC</th>
               
            </thead>
            <?php $i=1; foreach($this->data as $pemberi){ ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $pemberi->nama_pemberi; ?></td>
                <td><?php echo $pemberi->alamat_pemberi; ?></td>
                <td><?php echo $pemberi->telp_pemberi;?></td>
                <td><?php echo $pemberi->pic_pemberi;?></td>
                <td><?php echo $pemberi->telp_pic_pemberi;?></td>

            </tr>
            <?php $i++; } ?>
        </table>
    </div>
	</fieldset>
</div>
</div>
<script type="text/javascript">
    
    $('#nama').keyup(function() {   
            $('#wnama').fadeOut(0);             
    });
	$('#alamat').keyup(function() {   
            $('#walamat').fadeOut(0);             
    });
	$('#telepon').keyup(function() {   
            $('#wtelepon').fadeOut(0);             
    });
	$('#PIC').keyup(function() {   
            $('#wPIC').fadeOut(0);             
    });
	$('#telp_pic').keyup(function() {   
            $('#wtelp_pic').fadeOut(0);             
    });
	
    function cek(){    
        var jml = 0;
        if($('#nama').val()==''){
            var wnama= 'Nama harus diisi!';
            $('#wnama').fadeIn(0);
            $('#wnama').html(wnama);
			$('#wnama').addClass('error');
            jml++;
        }
    
        if($('#alamat').val()==''){
            var walamat= 'Alamat harus diisi!';
            $('#walamat').fadeIn(0);
            $('#walamat').html(walamat);
			$('#walamat').addClass('error');
            jml++;
        }
        
        if($('#telepon').val()==''){
            var wtelepon= 'Telepon harus diisi!';
            $('#wtelepon').fadeIn(0);
            $('#wtelepon').html(wtelepon);
			$('#wtelepon').addClass('error');
            jml++;
        }
    
        if($('#PIC').val()==''){
            var wPIC= 'PIC harus diisi!';
            $('#wPIC').fadeIn(0);
            $('#wPIC').html(wPIC);
			$('#wPIC').addClass('error');
            jml++;
        }
        
        if($('#telp_pic').val()==''){
            var wtelp_pic= 'Telepon PIC harus diisi!';
            $('#wtelp_pic').fadeIn(0);
            $('#wtelp_pic').html(wtelp_pic);
			$('#wtelp_pic').addClass('error');
            jml++;
        }
    
    
    
        if(jml>0){
            //alert('Isian form belum lengkap');
            return false;
        }
    }
    
</script>