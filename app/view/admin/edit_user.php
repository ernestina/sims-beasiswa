<div id="top">
    <h2>UBAH DATA USER</h2>
	<div class="kolom3">
	  <fieldset><legend>Ubah User</legend>
		
		<div id="form-input">           
        <form method="POST" enctype="multipart/form-data" action=" <?php echo URL.'Admin/updateUser' ?>">
            
			<div class="kiri">
			<input type="hidden" name="id" id="id" value="<?php echo $this->data->get_id(); ?>" size="30">
            <label>NIP</label><input type="text" name="nip" id="nama" value="<?php echo $this->data->get_nip(); ?>" size="30"/>
            <label>Nama</label><input type="text" name="nama" id="nama" value="<?php echo $this->data->get_nmUser(); ?>" size="30"/>
            <label>Password</label><input type="text" name="pass" id="nama" value="<?php echo $this->data->get_pass(); ?>" size="30"/>
            <label>Akses</label><input type="text" name="akses" id="nama" value="<?php echo $this->data->get_akses(); ?>" size="30"/>
            <label>Upload Foto</label><input type="file" name="foto" id="nama" value="" size="30"/>
				<ul class="inline tengah">
					<li><input class="biru" type="button" onclick="" value="BATAL"></li>
					<li><input class="sukses" type="submit" name="submit" value="SIMPAN"></li>
				</ul>
			</div>
			
        </form>
    </div>
	</fieldset>
</div>
</div>


