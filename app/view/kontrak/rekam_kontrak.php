<div>
DATA KONTRAK KERJASAMA > TAMBAH <!-- pake breadcrumb-->
</div>
<div>
    <form method="POST" action="" enctype="multipart/form-data">
        <label>Nomor </label><input type="text" name="nomor" id="nomor" size="30"></br>
        <label>Tanggal </label><input type="text" name="tanggal" id="tanggal" size="30"></br>
        <label>Universitas </label><select>
            <option>Universitas Indonesia</option>
        </select></br>
        <label>Jurusan </label><select>
            <option>Akuntansi</option>
        </select></br>
        <label>Jumlah Pegawai</label><input type="text" name="jml_peg" id="jml_peg" size="4"></br>
        <label>Lama Semester</label><input type="text" name="lama_sem" id="lama_sem" size="4"></br>
        <label>Tahun Masuk</label><select>
            <option>2010</option>
        </select></br>
        <label>Kontrak Lama </label><select>
            <option>Pilih kontrak lama</option>
        </select>
        <label>File Kontrak </label><input type="file" name="fupload" id="fupload"></br>
        <label></label><input type="button" value="BATAL" onClick="location.href='<?php echo URL.'kontrak/display';?>'">
        <input type="submit" name="sb_rekam" id="sb_rekam" value="SIMPAN"></br>
    </form>
</div>
<div>
    
</div>
