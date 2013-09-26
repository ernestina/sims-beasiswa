<div id="top">
    <!--div id="form-title"-->
	
	<h2>DATA PEMBERI BEASISWA</h2>
    <div class="kolom3">
	   <fieldset><legend>Tambah Pemberi Beasiswa</legend>
		<div id="form-input">
        <form method="POST" action="<?php /*$_SERVER['PHP_SELF']; */ echo URL.'admin/addPemberi'?>">
        <div class="kiri">
			<label>Nama</label><input type="text" name="nama_pemberi" id="nama" size="50">
			
			<label>Alamat</label><textarea type="text" name="alamat_pemberi" id="alamat" rows="8"></textarea>
			
			<label>Telepon</label><input type="text" name="telp_pemberi" id="telepon" size="15">
			
			<label>PIC</label><input type="text" name="pic_pemberi" id="PIC" size="30">
			
			<label>Telepon PIC</label><input type="text" name="telp_pic_pemberi" id="telp_pic" size="8">
			
			<ul class="inline tengah">
				<li><input class="normal" type="submit" onclick="" value="BATAL"></li>
				<li><input class="sukses" type="submit" name="add_pemberi" value="SIMPAN"></li>
			</ul>
		</div>
      </form>
    </div>
	   </fieldset>
</div>

<div class="kolom4" id="table">
<fieldset><legend>Daftar Pemberi Beasiswa</legend>

    <div id="table-title"></div>
    <div id="table-content">
        <table class="table-bordered zebra scroll">
            <thead>
                <th>No</th>
                <th width="200">Nama</th>
                <th width="200">Alamat</th>
                <th width="50">Telepon</th>
                <th width="70">PIC</th>
                <th width="70">Telp. PIC</th>
                <th width="30">Aksi</th>
            </thead>
			<tbody>
				<?php $i=1; foreach($this->data as $pemberi){ ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $pemberi->nama_pemberi; ?></td>
					<td><?php echo $pemberi->alamat_pemberi; ?></td>
					<td><?php echo $pemberi->telp_pemberi;?></td>
					<td><?php echo $pemberi->pic_pemberi;?></td>
					<td><?php echo $pemberi->telp_pic_pemberi;?></td>
					<td>
						<?php echo "<a href=".URL."admin/delPemberi/".$pemberi->kd_pemberi.">X</a> | 
                    <a href=".URL."admin/editPemberi/".$pemberi->kd_pemberi.">...</a>" ?>                    
					</td>
				</tr>
				<?php $i++; } ?>
			</tbody>
        </table>
    </div>
</div>
</div>
