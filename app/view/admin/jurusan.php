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
        <label>Fakultas</label><select type="text" id="status" name="fakultas">
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
        <label>Strata</label><select type="text" id="status" name="strata">
            <option value="1">Sarjana</option>
            <option value="2">Magister</option>
        </select>
<!--        <label>PIC</label><select id="status" name="PIC">
            <option value="1">Firman</option>
            <option value="2">Afis</option>
        </select></br-->
        <label>Jurusan</label><input type="text" name="nama" id="nama" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nama():'';?>">
        
		<label>Alamat</label><textarea type="text" name="alamat" id="alamat" rows="8"><?php echo isset($this->d_ubah)?$this->d_ubah->get_alamat():'';?></textarea>
        
		<label>Telepon</label><input type="text" name="telepon" id="telepon" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telepon():'';?>">
		
        <label>PIC Jurusan</label><input type="text" name="pic_jur" id="pic_jur" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_pic():'';?>">
		
        <label>Telp PIC Jurusan</label><input type="text" name="telp_pic_jur" id="telp_pic_jur" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telp_pic():'';?>">
		
        <label>Status</label>
			<select type="text" name="status" id="status" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_status():'';?>">
				<option>Aktif</option>
				<option>Non-aktif</option>
			</select>
        
		<ul class="inline tengah">
			<li><input class="normal" type="submit" onclick="" value="BATAL"></li>
			<li><input class="sukses" type="submit" name="<?php echo isset($this->d_ubah)?'upd_jur':'add_jur';?>" value="SIMPAN"></li>
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
