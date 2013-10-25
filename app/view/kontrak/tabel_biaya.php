<table class="table-bordered zebra scroll" id="table">
    <thead>
    <th width="5%">No</th>
    <th width="10%">No & Tgl Kontrak</th>
    <th width="20%">Jurusan</th>
    <th width="25%">Nama Biaya</th>
    <th width="10%">Jumlah Biaya</th>
    <th width="10%">Jadwal <br />dibayarkan</th>
<!--    <th>Jumlah dibayarkan</th>-->
    <th width="10%">Status <br />Pembayaran</th>
    <th width="10%">No dan Tgl SP2D</th>
</thead>
<tbody>
<?php
$i = 1;
foreach ($this->data_biaya as $val) {
    $data_kontrak = $this->kontrak->get_by_id($val->kd_kontrak);
    //var_dump($data_kontrak);
    //echo $data_kontrak->kd_jurusan;
    $this->jurusan->set_kode_jur($data_kontrak->kd_jurusan);
    $data_jurusan = $this->jurusan->get_jur_by_id($this->jurusan);
    $data_universitas = $this->universitas->get_univ_by_jur($data_kontrak->kd_jurusan);
    ?>
    <tr>
        <td style="text-align: center"><?php echo $i; ?></td>
        <td><?php echo $data_kontrak->no_kontrak." (".$data_kontrak->tgl_kontrak.")"; ?></td>
        <td><?php echo $data_jurusan->get_nama()." ".$data_universitas->get_kode()." ".$data_kontrak->thn_masuk_kontrak; ?></td>
        <td><?php echo $val->nama_biaya; ?></td>
        <td style="text-align: right"><?php echo number_format($val->jml_biaya); ?></td>
        <td style="text-align: center"><?php echo $val->jadwal_bayar; ?></td>
<!--        <td><?php echo number_format($this->biaya->get_biaya_by_kontrak_dibayar($val->kd_kontrak)); ?></td>-->
        <td style="text-align: center"><?php echo $val->status_bayar; ?></td>
        <td style="text-align: center">
            <?php
            if ($val->tgl_sp2d != "01-01-1970") {
                echo $val->no_sp2d." (".$val->tgl_sp2d.")";
            } else {
                echo "-";
            }
            ?>
        </td>
    </tr>
    <?php
    $i++;
}
if (empty($this->data_biaya)) {
    echo "<tr><td colspan=10>Biaya kontrak tidak ditemukan.</td></tr>";
}
?>
</tbody>
</table>