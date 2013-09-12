<div id="menu">
    <select id="menu-admin">
        <option>-pilih menu-</option>
    </select>
</div>
<div id="form">
    <div id="form-title">DATA JURUSAN</div>
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
        <label>Fakultas</label><select id="status" name="fakultas">
            <?php 
                    foreach ($this->fakul as $val){
                        if(isset($this->d_ubah)){
                            if($val->get_kode_fakul()==$this->d_ubah->get_kode_fakul()){
                                echo "<option value=".$val->get_kode_fakul()." selected>".$val->get_nama()."</option>";
                            }else{
                                echo "<option value=".$val->get_kode_fakul()." >".$val->get_nama()."</option>";
                            }
                        }else{
                            echo "<option value=".$val->get_kode_fakul()." >".$val->get_nama()."</option>";
                        }
                    }
            ?>
        </select></br>
        <label>Strata</label><select id="status" name="strata">
            <option value="1">Sarjana</option>
            <option value="2">Magister</option>
        </select></br>
<!--        <label>PIC</label><select id="status" name="PIC">
            <option value="1">Firman</option>
            <option value="2">Afis</option>
        </select></br-->
        <label>Nama</label><input type="text" name="nama" id="nama" size="40" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nama():'';?>"></br>
        <label>Alamat</label><textarea name="alamat" id="alamat" cols="50" rows="10"><?php echo isset($this->d_ubah)?$this->d_ubah->get_alamat():'';?></textarea></br>
        <label>Telepon</label><input type="text" name="telepon" id="telepon" size="15" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telepon():'';?>"></br>
        <label>PIC Jurusan</label><input type="text" name="pic_jur" id="pic_jur" size="30" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_pic():'';?>"></br>
        <label>Telp PIC Jurusan</label><input type="text" name="telp_pic_jur" id="telp_pic_jur" size="15" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telp_pic():'';?>"></br>
        <label>Status</label><input type="text" name="status" id="status" size="15" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_status():'';?>"></br>
        <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="<?php echo isset($this->d_ubah)?'upd_jur':'add_jur';?>" value="SIMPAN">
        </form>
    </div>
</div>
<div id="table">
    <div id="table-title"></div>
    <div id="table-content">
        <table>
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
        </table>
    </div>
</div>
