<div>
    REKAM PENERIMA BEASISWA
</div>
<hr>
<div>
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
        <label>Surat Tugas</label><select name="st" id="st">
        </select></br>
            <option value="1">ST-003</option>
        <label>Jurusan</label><select name="jur" id="jur">
            <option value="1">Akuntansi</option>
        </select></br>
        <label>Bank</label><select name="bank" id="bank">
            <option value="1">Bank Mandiri</option>
        </select></br>
        <label>Status</label><select name="status" id="status">
            <option value="1">Belum Lulus</option>
        </select></br>
        <label>NIP</label><input type="text" name="nip" id="nip" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nip():'';?>" size="18"></br>
        <label>NAMA</label><input type="text" name="nama" id="nama" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nama():'';?>" size="50"></br>
        <label>Jenis Kelamin</label><select name="jk" id="jk">
            <option value="1">Laki-laki</option>
            <option value="2">Perempuan</option>
            <option value="3">Abu-abu</option>
        </select></br>
        <label>Golongan</label><select name="gol" id="gol">
            <?php 
                for($i=1;$i<5;$i++){
                    $gol = 1;
                    for($j=a;$j<e;$j++){
                        echo "<option value='$i$gol'>$i $j</option>";
                        $gol++;
                    }
                }
            ?>
        </select></br>
        <label>Unit Asal</label><input type="text" name="unit_asal" id="unit_asal" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_unit_asal():'';?>" size="50"></br>
        <label>Email</label><input type="text" name="email" id="email" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_email():'';?>" size="30"></br>
        <label>Telepon</label><input type="text" name="telp" id="telp" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telp():'';?>" size="15"></br>
        <label>Alamat</label><textarea name="alamat" id="alamat"><?php echo isset($this->d_ubah)?$this->d_ubah->get_alamat():'';?></textarea></br>
        <label>No Rekening</label><input type="text" name="no_rek" id="no_rek" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_no_rek():'';?>" size="30"></br>
        <label>Foto</label><input type="file" name="fupload" id="fupload"></br>
        <label>Tanggal Lapor</label><input type="date" name="tgl_lap" id="tgl_lap" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_tgl_lapor():'';?>" size="10"></br>
        <label>Nomor SKL</label><input type="text" name="skl" id="skl" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_skl():'';?>" size="20"></br>
        <label>SPMT</label><input type="text" name="spmt" id="spmt" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_spmt():'';?>" size="20"></br>
        <label>Judul Skripsi</label><textarea name="skripsi" id="skripsi"><?php echo isset($this->d_ubah)?$this->d_ubah->get_skripsi():'';?></textarea></br>
        <label></label><input type="button" value="BATAL" onClick="location:href('')"><input type="submit" name="<?php echo isset($this->d_ubah)?'sb_upd':'sb_add';?>" value="SIMPAN">
    </form>
</div>
<div>
    <h2>Data Penerima</h2>
    <table border="1">
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
</div>
