
<div id="top">
    <h2>UBAH DATA STRATA</h2>
	<div class="kolom3">
	  <fieldset><legend>Ubah Data</legend>
		<div id="form-input" >
        <form method="POST" action="<?php /*$_SERVER['PHP_SELF'];*/ echo URL.'admin/updStrata'?>">
        <div class="kiri">
		<input type="hidden" name="kd_strata" id="kd" value="<?php echo $this->strata->kd_strata;?>">
        
		<label>Kode</label><input type="text" name="kode_strata" id="kode" size="8" value="<?php echo $this->strata->kode_strata;?>"><div id="wkode_strata"></div>
        
		<label>Nama</label><input type="text" name="nama_strata" id="nama" size="50" value="<?php echo $this->strata->nama_strata;?>"><div id="wnama_strata"></div>
        
		<ul class="inline tengah">
			<li><input class="normal" type="submit" onclick="window.location.href='<?php echo URL."admin/addStrata"; ?>'" value="BATAL"></li>
			
			<li><input class="sukses" type="submit" name="upd_strata" value="SIMPAN" onClick="return cek();"></li>
		</ul>
		
        </div> <!--end class kiri-->
		</form>
    </div>
	</fieldset>
</div>


<div class="kolom4" id="table">
	<fieldset><legend>Daftar Strata</legend>
    <div id="table-content">
        <table class="table-bordered zebra scroll">
            <thead>
                <th>No</th>
                <th width="30%">Kode</th>
                <th width="70%">Nama</th>
                
            </thead>
			<tbody>
            <?php $i=1; foreach($this->data as $strata){ ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $strata->kode_strata; ?></td>
                <td><?php echo $strata->nama_strata; ?></td>

            </tr>
            <?php $i++; } ?>
			</tbody>
        </table>
    </div>
	</fieldset>
</div>
</div>
<script type="text/javascript">
	
	$('#kode').keyup(function() {   
            $('#wkode_strata').fadeOut(0);             
    });
	
	$('#nama').keyup(function() {   
            $('#wnama_strata').fadeOut(0);             
    });
	
    function cek(){    
        var jml = 0;
        if($('#kode').val()==''){
            var wkode_strata= 'Kode harus diisi!';
            $('#wkode_strata').fadeIn(0);
            $('#wkode_strata').html(wkode_strata);
			$('#wkode_strata').addClass('error');
            jml++;
        }
    
        if($('#nama').val()==''){
            var wnama_strata= 'Nama harus diisi!';
            $('#wnama_strata').fadeIn(0);
            $('#wnama_strata').html(wnama_strata);
			$('#wnama_strata').addClass('error');
            jml++;
        }
    
        if(jml>0){
            //alert('Isian form belum lengkap');
            return false;
        }
    }
    
</script>