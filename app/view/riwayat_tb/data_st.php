<div> <!-- FORM -->
    <div><h2>TAMBAH SURAT TUGAS</h2></div>
    <div>
        <form method="POST" action="<?php 
                if(isset($this->d_ubah)){
                    echo URL.'surattugas/updst';
                }else{
                    $_SERVER['PHP_SELF'];
                }?>" enctype="multipart/form-data">
            <label>no. Surat Tugas(ST)</label><input type="text" name="no_st" id="no_st" size="30" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nomor():'';?>"></br>
            <label>No. ST Lama</label><select name="st_lama" id="st_lama">
                <?php 
                    foreach($this->d_st_lama as $val){
                        echo "<option value=".$val->get_kd_st().">".$val->get_nomor()."-".$val->get_jur()."</option>";
                    }
                ?>
            </select></br>
            <label>jenis ST</label><select name="jns_st">
                <?php 
                    foreach($this->d_jst as $val){
                        echo "<option value=".$val->get_kode().">".$val->get_nama()."</option>";
                    }
                ?>
            </select></br>
            <label>Tanggal ST</label><input type="date" name="tgl_st" id="tgl_st"></br>
            <label>Tanggal Mulai ST</label><input type="date" name="tgl_mulai" id="tgl_mulai"></br>
            <label>Tanggal Akhir ST</label><input type="date" name="tgl_selesai" id="tgl_akhir"></br>
            <label>Pemberi Beasiswa</label><select name="pemb">
                <?php 
                    foreach($this->d_pemb as $val){
                        echo "<option value=".$val->kd_pemberi.">".$val->nama_pemberi."</option>";
                    }
                ?>
            </select></br>
            <label>Universitas</label><select name="univ" id="univ">
                <?php 
                    foreach($this->d_univ as $val){
                        echo "<option value=".$val->get_kode_in().">".$val->get_nama()."</option>";
                    }
                ?>
            </select></br>
            <label>Jurusan/Prodi</label><select name="jur" id="jur">
                <?php 
                    foreach($this->d_jur as $val){
                        echo "<option value=".$val->get_kode_jur().">".$val->get_nama()." [".$val->get_kode_fakul()."]</option>";
                    }
                ?>
            </select></br>
            <label>Tahun Masuk</label><select name="th_masuk" id="th_masuk">
                <?php
                    foreach ($this->d_th_masuk as $key=>$val){
                        echo "<option value=".$key.">".$val."</option>";
                    }
                ?>
            </select></br>
            <label>Unggah ST</label><input type="file" name="fupload"></br>
            <label></label><input type="reset" value="RESET"><input type="submit" name="<?php echo isset($this->d_ubah)?'sb_upd':'sb_add';?>" value="SIMPAN">
        </form>
    </div>
</div>
<div> <!-- TABEL DATA -->
    <div>
        <h2>DATA SURAT TUGAS</h2>
    </div>
    <div>
        <table>
            <tr>
                <td><label>Universitas</label><select></select></td>
                <td><label>Tahun Masuk</label><select></select></td>
                <td><input type="search" id="cari" size="30"></td>
            </tr>
        </table>
    </div>
    <div>
        <table>
            <thead>
            <th>No</th>
            <th>No Surat Tugas</th>
            <th>Tanggal ST</th>
            <th>Tgl Mulai</th>
            <th>Tgl AKhir</th>
            <th>Jenis ST</th>
            <th>Jurusan/Prodi</th>
            <th>Aksi</th>
            </thead>
            <?php 
                $no=1;
                foreach($this->d_st as $val){
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$val->get_nomor()."</td>";
                    echo "<td>".$val->get_tgl_st()."</td>";
                    echo "<td>".$val->get_tgl_mulai()."</td>";
                    echo "<td>".$val->get_tgl_selesai()."</td>";
                    echo "<td>".$val->get_jenis_st()."</td>";
                    echo "<td>".$val->get_jur()."</td>";
                    echo "<td><a href=".URL."surattugas/del_st/".$val->get_kd_st().">X</a> | 
                        <a href=".URL."surattugas/datast/".$val->get_kd_st().">...</a></td>";
                    echo "</tr>";
                }
            ?>
        </table>
    </div>
</div>
