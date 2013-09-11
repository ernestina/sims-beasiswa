<div>
    DATA KONTRAK KERJASAMA > BIAYA > TAMBAH <!-- entar pake breadcrumb-->
</div>
<div>
    <label>Nomor / Tgl Kontrak</label><input type="text" size="50"></br>
    <label>Program Studi</label><input type="text" size="70"></br>
    <label>Jumlah Pegawai</label><input type="text" size="4">
    <label>Lama Semester</label><input type="text" size="4">
</div>
<div>
    <div>
        <h2>Data Utama Biaya</h2>
        <label>Nama Biaya</label><input type="text" size="50"></br>
        <label>Biaya per Pegawai</label><input type="text" size="12"></br>
        <label>Jumlah Pegawai</label><input type="text" size="4"></br>
        <label>Jadwal dibayarkan</label><input type="text" size="20"></br>
        <label>Jumlah Biaya</label><input type="text" size="14"></br>
    </div>
    <hr>
    <form method="POST" action="" enctype="multipart/form-data">
    <div>
        <h2>Data Tagihan Biaya</h2>
        <div>
            <label>No. BAST</label><input type="text" size="30"></br>
            <label>Tgl. BAST</label><input type="text" size="20"></br>
            <label>File BAST</label><input type="file"></br>
            <label>No. BAP</label><input type="text" size="30"></br>
            <label>Tgl. BAP</label><input type="text" size="20"></br>
            <label>File BAP</label><input type="file"></br>
        </div>
        <div>
            <label>No. Ringkasan Kontrak</label><input type="text" size="30"></br>
            <label>File Ringkasan Kontrak</label><input type="file"></br>
            <label>No. Kuitansi</label><input type="text" size="30"></br> 
            <label>File Kuitansi</label><input type="file"></br>
        </div>
    </div>
    <hr>
    <div>
        <h2>Data Pembayaran Tagihan Biaya</h2>
        <label>No. SP2D</label><input type="text" size="30"></br>
        <label>Tgl. SP2D</label><input type="text" size="20"></br>
        <label>File SP2D</label><input type="file"></br>
        <label>Jumlah dibayar</label><input type="text" size="14"></br>
        <div>Keterangan : *harus diisi</div>
        <div><input type="button" value="BATAL" onClick="location.href='<?php echo URL.'kontrak/biaya';?>'">
        <input type="submit" name="sb_rekam_by" value="SIMPAN"></div>
    </div>
    </form>
</div>
