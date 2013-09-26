<div>
    DATA KONTRAK KERJASAMA > BIAYA <!-- ntar pake breadcrumb -->
    <input type="button" value="KEMBALI">
</div>
<div>
    <div>
        <label>Nomor / Tanggal Kontrak</label><input type="text" size="50" readonly value="<?php echo $this->data->no_kontrak." / ".$this->data->tgl_kontrak; ?>"></br>
        <label>Program Studi</label><input type="text" size="70" readonly value="<?php echo $this->jurusan->get_nama()." ".$this->univ->get_nama(). " ".$this->data->thn_masuk_kontrak; ?>"></br>
        <label>Jumlah Pegawai</label><input type="text" size="4" readonly value="<?php echo $this->data->jml_pegawai_kontrak; ?>"></br>
        <label>Lama Semester</label><input type="text" size="4" readonly value="<?php echo $this->data->lama_semester_kontrak;?>"></br>
        <label>Total Biaya</label><input type="text" size="14" readonly></br>
        <label>Kontrak Lama</label><input type="text" size="40" readonly value="<?php echo $this->data->kontrak_lama;?>"></br>
    </div>
    <div><input type="button" value="TAMBAH" onClick="location.href='<?php echo URL.'kontrak/rekambiaya';?>'"</div>
</div>
<div>
    <table>
        <thead>
        <th>No</th>
        <th>Nama Biaya</th>
        <th>Biaya per Pegawai</th>
        <th>Jumlah Pegawai yang dibayarkan</th>
        <th>Jumlah Biaya</th>
        <th>Jadwal dibayarkan</th>
        <th>Jumlah dibayarkan</th>
        <th>Status Pembayaran</th>
        <th>No dan Tgl SP2D</th>
        <th>Aksi</th>
        </thead>
    </table>
</div>