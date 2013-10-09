<!DOCTYPE html>
<html>
    <head>
        <title>SIMS OKE</title>   
        <style>
            td, th {
                border: 1px solid black;
            }
            table {
                border-collapse: collapse;
            }
        </style>
    </head>
    <body style="font-family:arial;color:black;font-size:12px;">
        <p align="center" style="font-weight: bold; font-size:16px;">
            MONITORING KONTRAK KERJASAMA <br />
            DIREKTORAT JENDERAL PERBENDAHARAAN <br />
            <?php
            if ($this->univ != "") {
                echo "UNIVERSITAS : " . strtoupper($this->data_univ->get_nama()) . "<br />";
            }
            if ($this->status != "") {
                echo "UNIVERSITAS :" . strtoupper($this->status) . "<br />";
            }
            ?>

        </p>

        <table align="center" cellspacing=0 cellpadding=4 width=90% style="border-width: 1px; border-style: solid; border-color: black;">
            <thead bgcolor="#E6F9ED">
            <th>No</th>
            <th>No & Tgl Kontrak</th>
            <th>Jurusan</th>
            <th>Nama Biaya</th>
            <th>Jumlah Biaya</th>
            <th>Jadwal <br />dibayarkan</th>
            <th>Jumlah dibayarkan</th>
            <th>Status <br />Pembayaran</th>
            <th>No dan Tgl SP2D</th>
        </thead>

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
                <td><?php echo $i; ?></td>
                <td><?php echo $data_kontrak->no_kontrak . " (" . $data_kontrak->tgl_kontrak . ")"; ?></td>
                <td><?php echo $data_jurusan->get_nama() . " " . $data_universitas->get_kode() . " " . $data_kontrak->thn_masuk_kontrak; ?></td>
                <td><?php echo $val->nama_biaya; ?></td>
                <td><?php echo number_format($val->jml_biaya); ?></td>
                <td><?php echo $val->jadwal_bayar; ?></td>
                <td><?php echo number_format($this->biaya->get_biaya_by_kontrak_dibayar($val->kd_kontrak)); ?></td>
                <td>
                    <?php echo $val->status_bayar; ?>
                </td>
                <td>
                    <?php
                    if ($val->tgl_sp2d != "01-01-1970") {
                        echo $val->no_sp2d . " (" . $val->tgl_sp2d . ")";
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
    </table>
</body>
</html>
<script type="text/javascript">
    window.onload=function cetak(){
		window.print();
		window.onfocus = function() { window.close(); }
	}
</script>
