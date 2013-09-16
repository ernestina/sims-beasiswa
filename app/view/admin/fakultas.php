<?php
    $this->load('admin/menu_admin');
?>
<div id="form">
    <!--div id="form-title"-->
	<h2>DATA FAKULTAS</h2></div>
    <div class="kolom3">
	  <fieldset><legend>Tambah Fakultas</legend>
		<div id="form-input">
        <form method="POST" action="<?php 
            if(isset($this->d_ubah)){
                echo URL.'admin/updFakultas';
            }else{
                $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'
            }
            ?>">
        <?php 
            if(isset($this->d_ubah)){
                echo "<input type=hidden name='kd_fakul' value=".$this->d_ubah->get_kode_fakul().">";
            }
        ?>
        <div class="kiri">
			<label>Universitas</label><select type="text" id="status" name="universitas">
			
            <?php 
                    foreach ($this->univ as $val){
                        if(isset($this->d_ubah)){
                            if($val->get_kode_in()==$this->d_ubah->get_kode_univ()){
                                echo "<option value=".$val->get_kode_in()." selected>".$val->get_nama()."</option>";
                            }else{
                                echo "<option value=".$val->get_kode_in()." >".$val->get_nama()."</option>";
                            }
                        }else{
                            echo "<option value=".$val->get_kode_in()." >".$val->get_nama()."</option>";
                        }
                    }
            ?>
			</select>
				<label>Nama</label>
				<input type="text" name="nama" id="nama" size="50" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nama():'';?>">
			
			
				<label>Alamat</label><textarea type="text" name="alamat" id="alamat" rows="8" ><?php echo isset($this->d_ubah)?$this->d_ubah->get_alamat():'';?></textarea>
        
				<label>Telepon</label><input type="text" name="telepon" id="telepon" size="15" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telepon():'';?>">
        
			<ul class="inline tengah">
				<li><input class="normal" type="submit" onclick="" value="BATAL"></li>
				<li><input class="sukses" type="submit" name="<?php echo isset($this->d_ubah)?'upd_fak':'add_fak';?>" value="SIMPAN"></li>
			</ul>
        </div>
		</form>
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
                <th width="100">Universitas</th>
                <th width="150">Fakultas</th>
                <th width="150">Alamat</th>
                <th width="50">Telepon</th>
                <th>Aksi</th>
            </thead>
			<tbody>

            <?php
                $no=1;
                foreach($this->data as $val){
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$val->get_kode_univ()."</td>";
                    echo "<td>".$val->get_nama()."</td>";
                    echo "<td>".$val->get_alamat()."</td>";
                    echo "<td>".$val->get_telepon()."</td>";
                    echo "<td><a href=".URL."admin/delFakultas/".$val->get_kode_fakul().">X</a> | 
                        <a href=".URL."admin/addFakultas/".$val->get_kode_fakul().">...</a></td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
			</tbody>
        </table>
    </div>
</div>
</div>