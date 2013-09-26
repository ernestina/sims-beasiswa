<div id="top">
    <h2>DATA BANK</h2>
    <div class="kolom3">
	<fieldset><legend>Ubah Data Bank</legend>
	<div id="form-input">           
        <form method="POST" action="<?php echo URL . 'Admin/updateBank'; ?>">
            <label></label><input type="hidden" name="id" id="id" value="<?php echo $this->data->get_id(); ?>" size="30">
            <div class="kiri">
				<label>Nama</label><input type="text" name="nama" id="nama" value="<?php echo $this->data->get_nama(); ?>" size="30">
				
				<label>Keterangan</label><input type="text" name="keterangan" id="keterangan" value="<?php echo $this->data->get_keterangan(); ?>" size="50">
				
				<ul class="inline tengah">
					<li><input class="normal" type="submit" onclick="" value="BATAL"></li>
					<li><input class="sukses" type="submit" name="submit" value="SIMPAN"></li>
				</ul>
			</div> <!--end class kiri-->
        </form>
    </div>
	</fieldset>
</div> <!--end kolom3-->

<div class="kolom4" id="table">
	<fieldset><legend>Daftar Bank</legend>
    <div id="table-title"></div>
    <div id="table-content">
        <table class="table-bordered zebra scroll">
            <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Keterangan</th>
            
            </thead>
            <tbody><?php
        foreach ($this->data2 as $val) {
            echo '<tr>';
            echo '<td>' . $val->get_id() . '</td>';
            echo '<td>' . $val->get_nama() . '</td>';
            echo '<td>' . $val->get_keterangan() . '</td>';

        }
        ?>                          
            </tbody>
        </table>
    </div>
	</fieldset>
</div>
</div> <!--end top-->
