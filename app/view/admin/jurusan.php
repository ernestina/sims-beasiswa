<?php
    $this->load('admin/menu_admin');
?>
<div id="form">
    
	<!--div id="form-title"--><h2>DATA JURUSAN</h2></div>
	<div class="kolom3">
	  <fieldset><legend>Tambah Jurusan</legend>
		<div id="form-input">
        <form method="POST" action="<?php 
            if(isset($this->d_ubah)){
                echo URL.'admin/updJurusan';
            }else{
                $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'
            }?>">
        <?php 
            if(isset($this->d_ubah)){
                echo "<input type=hidden name='kd_jur' value=".$this->d_ubah->get_kode_jur().">";
            }
        ?>
	  <div class="kiri">
              <div id="wfakul"></div>
        <label>Fakultas</label><select type="text" id="fakultas" name="fakultas">
            <?php 
                    foreach ($this->fakul as $val){
                        if(isset($this->d_ubah)){
                            if($val->get_kode_fakul()==$this->d_ubah->get_kode_fakul()){
                                echo "<option value=".$val->get_kode_fakul()." selected>[".$val->get_kode_univ()."] ".$val->get_nama()."</option>";
                            }else{
                                echo "<option value=".$val->get_kode_fakul()." >[".$val->get_kode_univ()."] ".$val->get_nama()."</option>";
                            }
                        }else{
                            echo "<option value=".$val->get_kode_fakul()." >[".$val->get_kode_univ()."] ".$val->get_nama()."</option>";
                        }
                    }
            ?>
        </select>
        <div id="wstrata"></div>
        <label>Strata</label><select type="text" id="strata" name="strata">
            <option value="1">Sarjana</option>
            <option value="2">Magister</option>
        </select>
<!--        <label>PIC</label><select id="status" name="PIC">
            <option value="1">Firman</option>
            <option value="2">Afis</option>
        </select></br-->
        <div id="wnama"></div>
        <label>Jurusan</label><input type="text" name="nama" id="nama" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nama():'';?>">
        <div id="walamat"></div>
		<label>Alamat</label><textarea type="text" name="alamat" id="alamat" rows="8"><?php echo isset($this->d_ubah)?$this->d_ubah->get_alamat():'';?></textarea>
        <div id="wtelepon"></div>
		<label>Telepon</label><input type="text" name="telepon" id="telepon" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telepon():'';?>">
		<div id="wpic_jur"></div>
        <label>PIC Jurusan</label><input type="text" name="pic_jur" id="pic_jur" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_pic():'';?>">
	<div id="wtelp_pic_jur"></div>	
        <label>Telp PIC Jurusan</label><input type="text" name="telp_pic_jur" id="telp_pic_jur" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telp_pic():'';?>">
	<div id="wstatus"></div>	
        <label>Status</label>
			<select type="text" name="status" id="status" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_status():'';?>">
				<option>Aktif</option>
				<option>Non-aktif</option>
			</select>
        
		<ul class="inline tengah">
			<li><input class="normal" type="submit" onclick="" value="BATAL"></li>
			<li><input class="sukses" type="submit" name="<?php echo isset($this->d_ubah)?'upd_jur':'add_jur';?>" value="SIMPAN" onClick="return cek();"></li>
		</ul>
        </form>
		</div>
	</div>
   </fieldset>
</div>

<div class="kolom4" id="table">
   <fieldset><legend>Daftar Jurusan</legend>
    <div id="table-title"></div>
    <div id="table-content">
        <table class="table-bordered zebra scroll">
            <thead>
                <th>No</th>
                <th>Fakultas</th>
                <th>Strata</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>PIC Jurusan</th>
                <th>Telp PIC Jurusan</th>
                <th>Status</th>
                <th>Aksi</th>
            </thead>
			<tbody>
            <?php
                $no=1;
                foreach ($this->data as $val){
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$val->get_kode_fakul()."</td>";
                    echo "<td>".$val->get_kode_strata()."</td>";
                    echo "<td>".$val->get_nama()."</td>";
                    echo "<td>".$val->get_alamat()."</td>";
                    echo "<td>".$val->get_telepon()."</td>";
                    echo "<td>".$val->get_pic()."</td>";
                    echo "<td>".$val->get_telp_pic()."</td>";
                    echo "<td>".$val->get_status()."</td>";
                    echo "<td><a href=".URL."admin/delJurusan/".$val->get_kode_jur().">X</a> | 
                        <a href=".URL."admin/addJurusan/".$val->get_kode_jur().">...</a></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
		</table>
    </div>
</div>
</div>

<script type="text/javascript">
function cek(){
    var fakul = document.getElementById('fakultas').value;
    var strata = document.getElementById('strata').value;
    var nama = document.getElementById('nama').value;
    var alamat = document.getElementById('alamat').value;
    var telepon = document.getElementById('telepon').value;
    var pic_jur = document.getElementById('pic_jur').value;
    var telp_pic_jur = document.getElementById('telp_pic_jur').value;
    var status = document.getElementById('status').value;
    var jml=0;
    if(fakul=''){
        var wfakul= 'Fakultas harus dipilih!';
        $('#wfakul').fadeIn(0);
        $('#wfakul').html(wfakul);
        jml++;
    }
    
    if(strata==''){
        var wstrata= 'Strata harus dipilih!';
        $('#wstrata').fadeIn(0);
        $('#wstrata').html(wstrata);
        jml++;
    }
    
    if(nama==''){
        var wnama= 'Nama Jurusan harus diisi!';
        $('#wnama').fadeIn(0);
        $('#wnama').html(wnama);
        jml++;
    }
    
    if(alamat==''){
        var walamat= 'Alamat jurusan harus diisi!';
        $('#walamat').fadeIn(0);
        $('#walamat').html(walamat);
        jml++;
    }
    
    if(telepon==''){
        var wtelepon= 'Telepon jurusan harus diisi!';
        $('#wtelepon').fadeIn(0);
        $('#wtelepon').html(wtelepon);
        jml++;
    }
    
    if(pic_jur==''){
        var wpic_jur= 'PIC perguruan tinggi harus diisi!';
        $('#wpic_jur').fadeIn(0);
        $('#wpic_jur').html(wpic_jur);
        jml++;
    }
    
    if(telp_pic_jur==''){
        var wtelp_pic_jur= 'telepon PIC harus diisi!';
        $('#wtelp_pic_jur').fadeIn(0);
        $('#wtelp_pic_jur').html(wtelp_pic_jur);
        jml++;
    }
    
    if(status==''){
        var wstatus= 'status harus diisi!';
        $('#wstatus').fadeIn(0);
        $('#wstatus').html(wstatus);
        jml++;
    }
    
    if(jml>0){
        return false
    }else{
        return true;
    }
    
}
</script>