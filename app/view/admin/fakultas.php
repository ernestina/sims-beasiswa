<?php
    $this->load('admin/menu_admin');
?>
<div id="form">
    <div id="form-title"><h1>DATA FAKULTAS</h1></div>
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
        <label>Universitas</label><select id="status" name="universitas">
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
        </select></br>
        <label>Nama</label><input type="text" name="nama" id="nama" size="50" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nama():'';?>"></br>
        <label>Alamat</label><textarea name="alamat" id="alamat" cols="50" rows="10" ><?php echo isset($this->d_ubah)?$this->d_ubah->get_alamat():'';?></textarea></br>
        <label>Telepon</label><input type="text" name="telepon" id="telepon" size="15" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telepon():'';?>"></br>
        <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="<?php echo isset($this->d_ubah)?'upd_fak':'add_fak';?>" value="SIMPAN">
        </form>
    </div>
</div>
<div id="table">
    <div id="table-title"></div>
    <div id="table-content">
        <table>
            <thead>
                <th>No</th>
                <th>Universitas</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </thead>
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
        </table>
    </div>
</div>
