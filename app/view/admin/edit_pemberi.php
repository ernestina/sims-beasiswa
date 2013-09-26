<div id="top">
    <h2>UBAH DATA PEMBERI BEASISWA</h2>
	<div class="kolom3">
	  <fieldset><legend>Ubah Data</legend>
		<div id="form-input">
        <form method="POST" action="<?php /*$_SERVER['PHP_SELF']; */ echo URL.'admin/updPemberi'?>">
        <div class="kiri">
			<input type="hidden" name="kd_pemberi" id="kd" size="50" value="<?php echo $this->pemberi->kd_pemberi;?>">
			
			<label>Nama</label>
			<input type="text" name="nama_pemberi" id="nama" size="50" value="<?php echo $this->pemberi->nama_pemberi;?>">
        
			<label>Alamat</label>
			<textarea type="text" name="alamat_pemberi" id="alamat" rows="8"><?php echo $this->pemberi->alamat_pemberi;?></textarea>
        
			<label>Telepon</label><input type="text" name="telp_pemberi" id="telepon" size="15" value="<?php echo $this->pemberi->telp_pemberi;?>">
        
			<label>PIC</label><input type="text" name="pic_pemberi" id="PIC" size="30" value="<?php echo $this->pemberi->pic_pemberi;?>">
        
			<label>Telepon PIC</label><input type="text" name="telp_pic_pemberi" id="telp_pic" size="8" value="<?php echo $this->pemberi->telp_pic_pemberi;?>">
        
			<ul class="inline tengah">
				<li><input class="normal" type="submit" onclick="window.location.href='<?php echo URL."admin/addPemberi"; ?>'" value="BATAL"></li>
			
				<li><input class="sukses" type="submit" name="upd_pemberi" value="SIMPAN"></li>
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