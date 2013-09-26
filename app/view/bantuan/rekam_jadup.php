<div>
    BIAYA TUNJANGAN HIDUP > TAMBAH <!-- memakai breadcrumb -->
</div>
<div>
    <form method="POST" action="
          <?php
                echo URL.'elemenBeasiswa/viewJadup'
          ?>
          " enctype="multipart/form-data">
        <?php 
            if(isset($this->d_ubah)){
                echo "<input type='hidden' name='kode_d' id='kode_d' value=".$this->d_ubah->get_kd_d().">";
            }
        ?>
    <div>
        <input type="hidden" id="kode_r" name="kode_r" size="12" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_kd_r():'1';?>">
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
                        <select id="kode_jur" name="kode_jur">
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
                        <label>Bulan dan Tahun : </label>
                        <select id="bln" name="bln" >
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">Nopember</option>
                            <option value="12">Desember</option>
                        </select>
                        <select id="thn" name="thn">
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                        </select>
                        <label>Biaya Per Pegawai : </label>
                        <input disable type="text" id="biaya_peg" name="biaya_peg" size="12" value="520.000">
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
    <div>Data Penerima Tunjangan Hidup</div>
    <div>file link print</div>
</div>
<div>
    <table>
        <thead>
            <th>No</th>
            <th>Nama/NIP</th>
            <th>Gol</th>
            <th>Status</th>
            <th>Jumlah Hari Masuk</th>
            <th>Jumlah Kotor</th>
            <th>Pajak</th>
            <th>Jumlah Bersih</th>
            <th>Bank Penerima</th>
            <th>No. Rekening</th>
            <th>Pilih</th>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach ($this->pb as $val4){
                    if ($val4->get_jur()==$this->d_ubah->get_kd_jur()){
                        echo "<tr>";
                        echo "<td>$no</td>";
                        echo "<td>".$val4->get_nama()." / ".$val4->get_nip()."</td>";
                        echo "<td>".Golongan::golongan_int_string($val4->get_gol())."</td>";
                        echo "<td>".StatusPB::status_int_string($val4->get_status())."</td>";
                        $jml_jadup=520000;
                        $jml_hr_msk=100;
                        echo "<td size=12>".$jml_hr_msk." %</td>";
                        $jml_kotor=($jml_hr_msk*$jml_jadup/100);
                        echo "<td size=12>Rp. ".$jml_kotor."</td>";
                        $pajak=0;
                        if ($val4->get_gol()>30){
                            $pajak=5;
                        }
                        $jml_pajak=($pajak*$jml_kotor/100);
                        echo "<td size=12>Rp. ".$jml_pajak."</td>";
                        $jml_bersih = ($jml_kotor-$jml_pajak);
                        echo "<td size=12>Rp. ".$jml_bersih."</td>";
                        echo "<td>".$val4->get_bank()."</td>";
                        echo "<td>".$val4->get_no_rek()."</td>";
            ?>
                        <td><input type="checkbox" id="setuju" name="setuju" size="4" value=""></td>
            <?php
                        $no++;
                    }
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