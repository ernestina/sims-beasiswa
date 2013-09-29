<div id="top">
    <h2>REKAM PENERIMA BEASISWA</h2>


<div class="kolom3">
<fieldset><legend>Rekam Data</legend>
	<div class="kiri">
    <form method="POST" action="<?php if(isset($this->d_ubah)){
                echo URL.'penerima/updpenerima';
            }else{
                $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'
            };
            ?>" enctype="multipart/form-data">
        <?php 
            if(isset($this->d_ubah)){
                echo "<input type=hidden name='kd_pb' value=".$this->d_ubah->get_kd_pb().">";
            }
        ?>
        <label>Surat Tugas</label><select name="st" id="st" type="text">
            <?php 
                if(isset($this->d_st)){
                    foreach ($this->d_st as $val){
                        echo "<option value=".$val->get_kd_st().">".$val->get_nomor()." ".Tanggal::tgl_indo($val->get_tgl_st())."</option>";
                    }
                }
            ?>
        </select>
        <label>Bank</label><select name="bank" id="bank" type="text">
            <option value="1">Bank Mandiri</option>
        </select>
        <label>NIP</label><input type="text" name="nip" id="nip" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nip():'';?>" size="18">
        <label>Email</label><input type="text" name="email" id="email" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_email():'';?>" size="30">
        <label>Telepon</label><input type="text" name="telp" id="telp" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telp():'';?>" size="15">
        <label>Alamat</label><textarea name="alamat" id="alamat" type="text"><?php echo isset($this->d_ubah)?$this->d_ubah->get_alamat():'';?></textarea>
        <label>No Rekening</label><input type="text" name="no_rek" id="no_rek" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_no_rek():'';?>" size="30">
        <label>Foto</label><input type="file" name="fupload" id="fupload">
        <ul class="inline tengah">
			<li><input class="biru" type="button" value="BATAL" onClick="location:href('')"></li>
			
			<li><input class="sukses" type="submit" name="<?php echo isset($this->d_ubah)?'sb_upd':'sb_add';?>" value="SIMPAN"></li>
    </form>
	</div>
	</fieldset>
</div>
<div class="kolom4">
    <fieldset><legend>Data Penerima</legend>
    <table class="table-bordered zebra scroll">
        <thead>
        <th>no</th>
        <th>NIP</th>
        <th>nama</th>
        <th>email</th>
        <th>telp</th>
        <th>unit asal</th>
        <th>aksi</th>
        </thead>
        <?php 
            $no=1;
            foreach($this->d_pb as $v){
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td><a href=".URL."penerima/profil/".$v->get_kd_pb().">".$v->get_nip()."</a></td>";
                echo "<td>".$v->get_nama()."</td>";
                echo "<td>".$v->get_email()."</td>";
                echo "<td>".$v->get_telp()."</td>";
                echo "<td>".$v->get_unit_asal()."</td>";
                echo "<td><a href=".URL."penerima/delpb/".$v->get_kd_pb().">X</a> | 
                        <a href=".URL."penerima/penerima/".$v->get_kd_pb().">...</a></td>";
                echo "</tr>";
            }
        ?>
    </table>
	</fieldset>
</div>
</div>
