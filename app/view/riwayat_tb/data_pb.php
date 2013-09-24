<div>
    <h2>DATA PENERIMA BEASISWA</h2>
</div>
<div>
    <table>
        <tr>
            <td><label>Universitas</label><select>
                    <?php 
                        foreach ($this->univ as $val){
                            echo "<option value=".$val->get_kode().">".$val->get_nama()."</option>";
                        }
                    ?>
                </select></td>
            <td><label>Tahun Masuk</label><select>
                    <?php 
                       foreach ($this->th_masuk as $key=>$val){
                            echo "<option value=".$key.">".$val."</option>";
                        }
                    ?>
                </select></td>
            <td><label>Status</label><select></select></td>
            <td><input type="search" name="cari" id="cari" size="30"></td>
        </tr>
        <tr><td colspan="3"></td><td><input type="button" value="TAMBAH" onclick="location.href='<?php echo URL.'penerima/penerima'?>'"></td></tr>
    </table>
</div>
<div>
    <table border="1">
        <thead>
        <th>no</th>
        <th>NIP</th>
        <th>nama</th>
        <th>Gol</th>
        <th>Unit Asal</th>
        <th>Jurusan</th>
        <th>Jenis Beasiswa</th>
        </thead>
        <?php 
            $no=1;
            foreach($this->d_pb as $v){
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td><a href=".URL."penerima/profil/".$v->get_kd_pb().">".$v->get_nip()."</a></td>";
                echo "<td>".$v->get_nama()."</td>";
                echo "<td>".$v->get_gol()."</td>";
                echo "<td>".$v->get_unit_asal()."</td>";
                echo "<td>".$v->get_jur()."</td>";
                echo "<td><a href=".URL."penerima/delpb/".$v->get_kd_pb().">X</a> | 
                        <a href=".URL."penerima/penerima/".$v->get_kd_pb().">...</a></td>";
                echo "</tr>";
                $no++;
            }
        ?>
    </table>
</div>