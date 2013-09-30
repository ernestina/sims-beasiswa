
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
        foreach ($this->data as $val) { ?>
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