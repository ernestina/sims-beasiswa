<div>
    BIAYA TUNJANGAN HIDUP > TAMBAH <!-- memakai breadcrumb -->
</div>
<div>
    <form method="POST" action="
          <?php
                echo URL.'elemenBeasiswa/index'
          ?>
          " enctype="multipart/form-data">
        <?php 
            if(isset($this->d_ubah)){
                echo "<input type='hidden' name='kode_d' id='kode_d' value=".$this->d_ubah->get_kd_d().">";
            }
        ?>
    <div>
        <div>
            <label>Universitas : </label>
            <select id="universitas" name="universitas">
            <option value="0">UI</option>
            <option value="1">ITS</option>  
            </select>
        </d<iv>
        <div>
            <label>Jurusan/Prodi : </label>
            <select>
                <option>Pilih Jurusan/Prodi</option>
            </select>
        </div>
        <div>
            <label>Tahun Masuk : </label>
            <select>
                <option>Pilih Tahun Masuk</option>
            </select>
        </div>
        <div>
            <input type="hidden" id="kode_r" name="kode_r" size="12" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_kd_r():'1';?>">
        </div>
        <div>
            <label>jml_peg : </label>
                <input type="text" id="jml_peg" name="jml_peg" size="12" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_jml_peg():'';?>">
        </div>
    </div>
    <div>
        <div>
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
        </div>
        <div>
            <label>Jumlah Biaya : </label>
            <input type="text" id="total_bayar" name="total_bayar" size="12" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_total_bayar():'';?>">
        </div>
    </div>
    <div>
        <div>
            <label>No. SP2D : </label>
            <input type="text" id="no_sp2d" name="no_sp2d" size="20" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_no_sp2d():'';?>">
        </div>
        <div>
            <label>Tgl SP2D : </label>
            <input type="text" id="tgl_sp2d" name="tgl_sp2d" size="20" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_tgl_sp2d():'';?>">
        </div>
        <div>
            <label>File SP2D : </label>
            <input type="file" id="fupload" name="fupload" size="20" >
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
        <th>Jumlah Kotor Dibayarkan</th>
        <th>Pajak</th>
        <th>Bank Penerima</th>
        <th>No. Rekening</th>
        </thead>
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