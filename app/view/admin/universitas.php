<?php
    $this->load('admin/menu_admin');
?>
<div id="form">
    <h2>DATA UNIVERSITAS</h2></div>
    <div class="kolom3">
	  <fieldset><legend>Tambah Universitas</legend>
		<div id="form-input">
        <form method="POST" action="<?php 
            if(isset($this->d_ubah)){
                echo URL.'admin/updUniversitas';
            }else{
                $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'
            }
            
            ?>">
        <?php 
            if(isset($this->d_ubah)){
                echo "<input type=hidden name='kd_univ' value=".$this->d_ubah->get_kode_in().">";
            }
            
            if(isset($this->error)){
                echo "<div class=error>".$this->error."</div>";
            }
        ?>
        <div id="wkode"></div>
		<div class="kiri">
        <label>Kode</label><input type="text" name="kode" id="kode" size="8" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_kode():(isset($this->d_rekam)?$this->d_rekam->get_kode():'');?>">
        <div id="wnama" class="warning_field"></div>
        <label>Nama</label><input type="text" name="nama" id="nama" size="50" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nama():(isset($this->d_rekam)?$this->d_rekam->get_nama():'');?>">
        <div id="walamat"></div>
        <label>Alamat</label><textarea name="alamat" id="alamat" rows="8" type="text"><?php echo isset($this->d_ubah)?$this->d_ubah->get_alamat():(isset($this->d_rekam)?$this->d_rekam->get_alamat():'');?></textarea>
        <div id="wtelepon"></div>
        <label>Telepon</label><input type="text" name="telepon" id="telepon" size="15" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telepon():(isset($this->d_rekam)?$this->d_rekam->get_telepon():'');?>">
        <div id="wlokasi"></div>
        <label>Lokasi</label><input type="text" name="lokasi" id="lokasi" size="30" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_lokasi():(isset($this->d_rekam)?$this->d_rekam->get_lokasi():'');?>">
<!--        <label>Status</label><select id="status" name="status">
            <option value="aktif">aktif</option>
            <option value="non_aktif">non aktif</option>
        </select></br>-->
        <div id="wpic"></div>
        <label>PIC</label><select id="pic" name="pic">
            <?php 
                    foreach ($this->pic as $val){
                        if(isset($this->d_ubah)){
                            if($val->get_id()==$this->d_ubah->get_id()){
                                echo "<option value=".$val->get_id()." selected>".$val->get_nmUser()."</option>";
                            }else{
                                echo "<option value=".$val->get_id()." >".$val->get_nmUser()."</option>";
                            }
                        }elseif(isset($this->d_rekam)){
                            if($val->get_kode_fakul()==$this->d_rekam->get_kode_fakul()){
                                echo "<option value=".$val->get_id()." selected>".$val->get_nmUser()."</option>";
                            }else{
                                echo "<option value=".$val->get_id()." >".$val->get_nmUser()."</option>";
                            }
                        }else{
                            echo "<option value=".$val->get_id()." >".$val->get_nmUser()."</option>";
                        }
                    }
            ?>
        </select>
        <ul class="inline tengah">
			<li><input class="normal" type="submit" onclick="" value="BATAL"></li>
			<li><input class="sukses" type="submit" name="<?php echo isset($this->d_ubah)?'upd_univ':'add_univ';?>" value="SIMPAN" onClick=";"></li>
		</ul>
        </form>
    </div>
	</div>
   </fieldset>
</div>
<div class="kolom4" id="table">
	<fieldset><legend>Daftar Fakultas</legend>
    <div id="table-title"></div>
    <div id="table-content">
        <table class="table-bordered zebra scroll">
            <thead>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>lokasi</th>
                <th>Aksi</th>
            </thead>
            <tbody>
            <?php
                $no = 1;
                foreach ($this->data as $val){
                    echo "<tr>";
                    echo "<td>$no</td>";
                    echo "<td>".$val->get_kode()."</td>";
                    echo "<td>".$val->get_nama()."</td>";
                    echo "<td>".$val->get_alamat()."</td>";
                    echo "<td>".$val->get_telepon()."</td>";
                    echo "<td>".$val->get_lokasi()."</td>";
                    echo "<td><a href=".URL."admin/delUniversitas/".$val->get_kode_in().">X</a> | 
                        <a href=".URL."admin/addUniversitas/".$val->get_kode_in().">...</a></td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
                </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
function cek(){
    var kode = document.getElementById('kode').value;
    var nama = document.getElementById('nama').value;
    var alamat = document.getElementById('alamat').value;
    var telepon = document.getElementById('telepon').value;
    var lokasi = document.getElementById('lokasi').value;
    var pic = document.getElementById('pic').value;
    var jml=0;
    if(kode=''){
        var wkode= 'Singkatan Perguruan Tinggi harus diisi!';
        $('#wkode').fadeIn(0);
        $('#wkode').html(wkode);
        jml++;
    }
    
    if(nama==''){
        var wnama= '<font color="red">Nama Perguruan Tinggi harus diisi!</font>';
        $('#wnama').fadeIn(0);
        $('#wnama').html(wnama);
        jml++;
    }
    
    if(alamat==''){
        var walamat= 'Alamat Perguruan Tinggi harus diisi!';
        $('#walamat').fadeIn(0);
        $('#walamat').html(walamat);
        jml++;
    }
    
    if(telepon==''){
        var wtelepon= 'Telepon Perguruan Tinggi harus diisi!';
        $('#wtelepon').fadeIn(0);
        $('#wtelepon').html(wtelepon);
        jml++;
    }
    
    if(lokasi==''){
        var wlokasi= 'Lokasi perguruan tinggi harus diisi!';
        $('#wlokasi').fadeIn(0);
        $('#wlokasi').html(wlokasi);
        jml++;
    }
    
    if(pic==''){
        var wpic= 'Nama PIC harus dipilih!';
        $('#wpic').fadeIn(0);
        $('#wpic').html(wpic);
        jml++;
    }
    
    if(jml>0){
        return false
    }else{
        return true;
    }
    
}
</script>