<?php
    $this->load('bantuan/bantuan_header');
?>
<div>
    BIAYA TUGAS AKHIR > TAMBAH <!-- memakai breadcrumb -->
</div>
<div>
    <form method="POST" action="
          <?php
                echo URL.'elemenBeasiswa/viewSkripsi'
          ?>
          " enctype="multipart/form-data">
        <?php 
            if(isset($this->d_ubah)){
                echo "<input type='hidden' name='kode_d' id='kode_d' value=".$this->d_ubah->get_kd_d().">";
            }
        ?>
    <div>
        <input type="hidden" id="kode_r" name="kode_r" size="12" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_kd_r():'3';?>">
        <input type="hidden" id="jml_peg" name="jml_peg" size="12" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_jml_peg():'';?>">
        <div>
            <table>
                <tr>
                    <td>
                        <label>Universitas : </label>
                        <select id="universitas" name="universitas">
                        <?php 
                            foreach ($this->fakul as $val){
                            echo "<option value=".$val->get_kode_fakul()." >".$val->get_kode_univ()." - ".$val->get_nama()."</option>";
                            }
                        ?> 
                        </select>
                        <label>Jurusan/Prodi : </label>
                        <select>
                        <?php 
                            foreach ($this->jur as $val2){
                                echo "<option value=".$val2->get_kode_jur()." >".$val2->get_nama()."</option>";
                            }
                        ?>
                        </select>
                        <label>Tahun Masuk : </label>
                        <select>
                        <?php 
                            foreach ($this->kon as $val3){
                                echo "<option value=".$val3->thn_masuk_kontrak." >".$val3->thn_masuk_kontrak."</option>";
                            }
                        ?>
                        </select>
                    </td>
                    <td>
                        <label>Tahun : </label>
                        <label id="bln" name="bln" value="0"></label>
                        <select id="thn" name="thn">
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                        </select>
                        <label>Biaya Per Pegawai : </label>
                        <input disable type="text" id="biaya_peg" name="biaya_peg" size="12" value="500.000">
                        <label>Total Biaya : </label>
                        <input type="text" id="total_bayar" name="total_bayar" size="12" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_total_bayar():'';?>">
                    </td>
                    <td>
                        <label>No. SP2D : </label>
                        <input type="text" id="no_sp2d" name="no_sp2d" size="20" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_no_sp2d():'';?>">
                        <label>Tgl SP2D : </label>
                        <input type="text" id="tgl_sp2d" name="tgl_sp2d" size="20" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_tgl_sp2d():'';?>">
                        <label>File SP2D : </label>
                        <input type="file" id="fupload" name="fupload" size="20" >
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div>
    <div>Data Penerima Biaya Skripsi</div>
    <div>file link print</div>
</div>
<div>
    <table>
        <thead>
        <th>No</th>
        <th>NIP / Nama</th>
        <th>Gol</th>
        <th>Judul Penelitian</th>
        <th>Status</th>
        <th>Bank Penerima</th>
        <th>No. Rekening</th>
        <th>Pilih</th>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach ($this->pb as $val4){
                    echo "<tr>";
                    echo "<td>$no</td>";
                    echo "<td>".$val4->get_nama()." / ".$val4->get_nip()."</td>";
                    echo "<td>".$val4->get_gol()."</td>";
            ?>
                    <td><input type="text" id="jdl_teliti" name="jdl_teliti" size="4" value=""></td>>
            <?php
                    echo "<td>".$val4->get_status()."</td>";
                    echo "<td>".$val4->get_bank()."</td>";
                    echo "<td>".$val4->get_no_rek()."</td>";
            ?>
                    <td><input type="check-box" id="setuju" name="setuju" size="4" value="harusnya dalam bentuk chckbox"></td>
            <?php
                    $no++;
                }
            ?>         
        </tbody>
    </table>
</div>
<div>
    <div>Keterangan : *Data harus diisi</div>
    <div>
        <input class="normal" type="submit" onclick="" value="BATAL">
        <input class="sukses" type="submit" name="<?php echo isset($this->d_ubah)?'update_elem':'add_elem';?>" value="SIMPAN" onClick="return cek();">
    </div>
</div>
    </form>
</div>