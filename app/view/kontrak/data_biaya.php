
<div>
    DATA KONTRAK KERJASAMA > BIAYA <!-- ntar pake breadcrumb -->
    <input type="button" value="KEMBALI">
</div>
<div>
    <div>
        <label>Nomor / Tanggal Kontrak</label><input type="text" size="50" readonly value="<?php echo $this->data_kontrak->no_kontrak . " / " . $this->data_kontrak->tgl_kontrak; ?>"></br>
        <label>Program Studi</label><input type="text" size="70" readonly value="<?php echo $this->nama_jur . " " . $this->nama_univ . " " . $this->data_kontrak->thn_masuk_kontrak; ?>"></br>
        <label>Jumlah Pegawai</label><input type="text" size="4" readonly value="<?php echo $this->data_kontrak->jml_pegawai_kontrak; ?>"></br>
        <label>Lama Semester</label><input type="text" size="4" readonly value="<?php echo $this->data_kontrak->lama_semester_kontrak; ?>"></br>
        <label>Total Biaya</label><input type="text" size="14" readonly value="<?php echo number_format($this->data_kontrak->nilai_kontrak); ?>"></br>
        <label>Kontrak Lama</label><input type="text" size="40" readonly value="<?php echo $this->kon_lama; ?>"></br>
    </div>
    <div><input type="button" value="TAMBAH" onClick="location.href='<?php echo URL . 'kontrak/rekambiaya/' .$this->data_kontrak->kd_kontrak; ?>'"</div>
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

        <?php $i = 1;
        foreach ($this->data_biaya as $val) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>Nama Biaya</td>
                <td>Biaya per Pegawai</td>
                <td>Jumlah Pegawai yang dibayarkan</td>
                <td>Jumlah Biaya</td>
                <td>Jadwal dibayarkan</td>
                <td>Jumlah dibayarkan</td>
                <td>Status Pembayaran</td>
                <td>No dan Tgl SP2D</td>
                <td>Aksi</td>
            </tr>
<?php } ?>
    </table>
</div>