<?php
$this->load('admin/menu_admin');
?>
    <div id="top">
        <!--div id="form-title"-->
	  <h2>DATA STRATA</h2>
		<div class="kolom3">
		   <fieldset><legend>Tambah Strata</legend>
			<div id="form-input" class="kiri" >
            <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'admin/addStrata' ?>">
                <label>Kode</label><input type="text" name="kode_strata" id="kode" size="8">
                <label>Strata</label><input type="text" name="nama_strata" id="nama" size="50">
              <ul class="inline tengah">  
				<li><input class="normal" type="submit" value="BATAL"></li>
				<li><input class="sukses" type="submit" name="add_strata" value="SIMPAN"></li>
			  </ul>
            </form>
        </div>
	   </fieldset>
    </div>

	<div class="kolom4">
	  <fieldset><legend>Daftar Strata</legend>
		<div id="table">
        <div id="table-content">
            <table class="table-bordered zebra scroll">
                <thead>
                <th>No</th>
                <th width="200">Kode</th>
                <th width="300">Nama</th>
                <th width="70">Aksi</th>
                </thead>
                <?php $i = 1;
                foreach ($this->data as $strata) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $strata->kode_strata; ?></td>
                        <td><?php echo $strata->nama_strata; ?></td>
                        <td>
                            <?php echo "<a href=" . URL . "admin/delStrata/" . $strata->kd_strata . ">X</a> | 
                    <a href=" . URL . "admin/editStrata/" . $strata->kd_strata . ">...</a>" ?>
                        </td>
                    </tr>
    <?php $i++;
} ?>
            </table>
        </div>
    </div>
   </fieldset>
</div>
</div>

