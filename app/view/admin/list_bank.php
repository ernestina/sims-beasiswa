<?php
    $this->load('admin/menu_admin');
?>
<div id="top">
    <h2>DATA BANK</h2>
	<div class="kolom3">
	  <fieldset><legend>Tambah Fakultas</legend>
		<div id="form-input">
			<form method="POST" action="<?php echo URL.'Admin/addBank' ?> ">
				<div class="kiri">
				<label>Nama</label><input type="text" name="nama" id="nama" size="30">
				<label>Keterangan</label><input type="text" name="keterangan" id="keterangan" size="50">
				
				<ul class="inline tengah">
					<li><input class="normal" type="submit" onclick="" value="BATAL"></li>
					<li><input class="sukses" type="submit" name="submit" value="SIMPAN"></li>
				</ul>
				</div>
			</form>
		</div>
		</fieldset>
	</div>
<div class="kolom4" id="table">
	  <fieldset><legend>Tambah Fakultas</legend>
			<div id="table-title"></div>
			<div id="table-content">
			<table class="table-bordered zebra scroll">
				<thead>
					<th>No</th>
					<th width="200">Nama</th>
					<th width="400">Keterangan</th>
					<th width="30">Aksi</th>
				</thead>
            <tbody>
                <?php
                foreach ($this->data as $value) {
                    echo '<tr>';
                    echo '<td>' . $value->get_id() . '</td>';
                    echo '<td>' . $value->get_nama() . '</td>';
                    echo '<td>' . $value->get_keterangan() . '</td>';
                    echo
                    '<td>
                        <a href="' . URL . 'Admin/deleteBank/' . $value->get_id() . '">X</a>
						<a href="' . URL . 'Admin/editBank/' . $value->get_id() . '">...</a>
                    </td>';
                    echo '</tr>';
                }
                ?>            
            </tbody>
        </table>
    </div>
	</fieldset>
</div>
</div>
