<div id="menu">
    <select id="menu-admin">
        <option>-pilih menu-</option>
    </select>
</div>
<div id="form">
    <div id="form-title">DATA UNIVERSITAS</div>
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
        ?>
        <label>PIC</label><select id="status" name="pic">
            <option value="0">afies</option>
            <option value="1">imron</option>
        </select></br>
        <label>Kode</label><input type="text" name="kode" id="kode" size="8" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_kode():'';?>"></br>
        <label>Nama</label><input type="text" name="nama" id="nama" size="50" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nama():'';?>"></br>
        <label>Alamat</label><textarea name="alamat" id="alamat" cols="50" rows="10"><?php echo isset($this->d_ubah)?$this->d_ubah->get_alamat():'';?></textarea></br>
        <label>Telepon</label><input type="text" name="telepon" id="telepon" size="15" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telepon():'';?>"></br>
        <label>Lokasi</label><input type="text" name="lokasi" id="lokasi" size="30" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_lokasi():'';?>"></br>
<!--        <label>Status</label><select id="status" name="status">
            <option value="aktif">aktif</option>
            <option value="non_aktif">non aktif</option>
        </select></br>-->
        <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="<?php echo isset($this->d_ubah)?'upd_univ':'add_univ';?>" value="SIMPAN">
        </form>
    </div>
</div>
<div id="table">
    <div id="table-title"></div>
    <div id="table-content">
        <table>
            <thead>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>lokasi</th>
                <th>Aksi</th>
            </thead>
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
        </table>
    </div>
</div>
