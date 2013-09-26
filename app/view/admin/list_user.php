<div id="top">
    <h2>DATA USER</h2>
	<div class="kolom3">
	  <fieldset><legend>Tambah User</legend>
		<div id="form-input">           
        
		<form method="POST" enctype="multipart/form-data" action=" <?php echo URL.'Admin/addUser' ?>">
            
			<div class= "kiri">
			<input type="hidden" name="id" id="id" value="" size="30">
            
			<label>NIP</label><input type="text" name="nip" id="nama" value="" size="30"/>
            
			<label>Nama</label><input type="text" name="nama" id="nama" value="" size="30"/>
            <label>PASS</label><input type="text" name="pass" id="nama" value="" size="30"/>
            <label>AKSES</label><input type="text" name="akses" id="nama" value="" size="30"/>
            <label>Upload Foto</label><input type="file" name="foto" id="nama" value="" size="30"/>
            
			<ul class="inline tengah">
				<li><input class= "normal" type="reset" onclick="" value="BATAL"></li>
				<li><input class= "sukses" type="submit" name="submit" value="SIMPAN"></li>
			</ul>
			</div> <!--end class kiri-->
        </form>
    </div>
	</fieldset>
</div> <!--end kolom3-->


<div class="kolom4" id="table">
	  <fieldset><legend>Daftar User</legend>
    <div id="table-title"></div>
    <div id="table-content">
        <table class="table-bordered zebra scroll">
            <thead>
                <th width="5%">No</th>
                <th width="20%">NIP</th>
                <th width="30%">Nama</th>
                <th width="20%">Pass</th>
                <th width="15%">Akses</th>               
                <th width="5%">Aksi</th>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($this->data as $value) {
                    echo '<tr>';
                    echo '<td>'.$i.'</td>';
                    echo '<td>'.$value->get_nip().'</td>';
                    echo '<td>'.$value->get_nmUser().'</td>';
                    echo '<td>'.$value->get_pass().'</td>';
                    echo '<td>'.$value->get_akses().'</td>';                   
                    echo '<td>
                        <a href="' . URL . 'Admin/deleteUser/' . $value->get_id() . '">X</a>
			<a href="' . URL . 'Admin/editUser/' . $value->get_id() . '">...</a>
                        </td>';
                    echo '</tr>';
                    $i++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>