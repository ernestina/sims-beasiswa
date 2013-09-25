<?php
$this->load('admin/menu_admin');
?>



    <div id="top">
        <h2>DATA PEJABAT</h2>
		<div class="kolom3">
			<fieldset><legend>Tambah Fakultas</legend>
			<div id="form-input" >
            <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'admin/addPejabat' ?>">
<!--                <label>Kode</label><input type="text" name="kd_pejabat" id="kd_pejabat" size="8"></br>-->
                <div class="kiri">
				<label>NIP</label><input type="text" name="nip_pejabat" id="nip_pejabat" size="18">
                <label>Nama</label><input type="text" name="nama_pejabat" id="nama_pejabat" size="50">
                <label>Jabatan</label><input type="text" name="nama_jabatan" id="nama_jabatan" size="50">
                <label>Jenis Jabatan</label>
                <select type="text" name="jenis_jabatan">
                    <option value="1">Pejabat Pembuat Komitmen</option>
                    <option value="2">Penanggung Jawab Kegiatan</option>
                    <option value="3">Bendahara</option>
                </select>
                <ul class="inline tengah">
                <li><input class="normal" type="submit" value="BATAL"></li>
				<li><input class="sukses" type="submit" name="add_pejabat" value="SIMPAN"></li>
				</div> <!--end kiri-->
            </form>
        </div> <!--end form-input-->
	   </fieldset>
    </div> <!--end kolom3-->

    <div id="table" class="kolom4">
	<fieldset><legend>Daftar Pejabat</legend>
        <div id="table-content">
            <table class="table-bordered zebra scroll">
                <thead>
                <th>No</th>
                <th>NIP Pejabat</th>
                <th width="100">Nama Pejabat</th>
                <th width="200">Jabatan</th>
                <th width="200">Jenis Jabatan</th>
                <th width="30">Aksi</th>                
                </thead>
                <?php $i = 1;
                foreach ($this->data as $pejabat) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $pejabat->nip_pejabat; ?></td>
                        <td><?php echo $pejabat->nama_pejabat; ?></td>
                        <td><?php echo $pejabat->nama_jabatan; ?></td>
                        <td><?php 
                        if($pejabat->jenis_jabatan==1){ echo "Pejabat Pembuat Komitment";}
                        if($pejabat->jenis_jabatan==2){ echo "Penanggung Jawab Kegiatan";}
                        if($pejabat->jenis_jabatan==3){ echo "Bendahara";}
                         
                        ?></td>
                        <td>
                            <?php echo "<a href=" . URL . "admin/delPejabat/" . $pejabat->kd_pejabat . ">X</a> | 
                    <a href=" . URL . "admin/editPejabat/" . $pejabat->kd_pejabat . ">...</a>" ?>
                        </td>
                    </tr>
    <?php $i++;
} ?>
            </table>
        </div>
	   </fieldset>
    </div> <!--end kolom4-->
</div>

