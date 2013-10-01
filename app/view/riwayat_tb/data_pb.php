<div id="top">
    <h2>DATA PENERIMA BEASISWA</h2>

<div>
    <table style="margin-left:10px; margin-right: 10px" width="100%" >
        <tr>
            <td><label>Universitas</label><select type="text">
                    <?php 
                        foreach ($this->univ as $val){
                            echo "<option value=".$val->get_kode().">".$val->get_nama()."</option>";
                        }
                    ?>
                </select></td>
            <td><label>Tahun Masuk</label><select type="text">
                    <?php 
                       foreach ($this->th_masuk as $key=>$val){
                            echo "<option value=".$key.">".$val."</option>";
                        }
                    ?>
                </select></td>
            <td><label>Status</label><select type="text"></select></td>
            <td><input type="search" name="cari" id="cari" size="30"></td>
        </tr>
        <!--tr><td colspan="3"></td><td style="padding-right: 45px; padding-top: 0px"><input type="button" value="TAMBAH" onclick="location.href='<?php echo URL.'penerima/penerima'?>'"></td></tr-->
    </table>
</div>
<div>
    <table class="table-bordered zebra scroll" >
        <thead >
        <th>no</th>
        <th width="15%">NIP</th>
        <th width="30%">Nama</th>
        <th width="10%">Gol</th>
        <th width="30%">Unit Asal</th>
        <th width="10%">Jurusan</th>
        <th width="20%">Jenis Beasiswa</th>
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
</div>