<!DOCTYPE html>
<html>
    <head>
        <title>Monitoring Kontrak <?php echo Tanggal::getTimeSekarang(); ?></title>   
        <style>
            td, th {
                border: 1px solid black;
            }
            table {
                border-collapse: collapse;
            }
            .td2{
                border: 0px ;
            }

            @media print {
                #printbtn {
                    display :  none;
                }
            }
            </style>
    </head>
    <body style="font-family:arial;color:black;font-size:10px;">
        <p align="center" style="font-weight: bold; font-size:13px;">
            MONITORING KONTRAK KERJASAMA <br />
            BEASISWA INTERNAL DIREKTORAT JENDERAL PERBENDAHARAAN <br />
            <?php
            if ($this->univ != "") {
                echo strtoupper($this->data_univ->get_nama()) . "<br />";
            }
            if ($this->status != "") {
                echo strtoupper($this->status) ." DIBAYAR<br />";
            }
            
            if ($this->jadwal != "") {
                echo "JADWAL PEMBAYARAN TAHUN " . strtoupper($this->jadwal) . "<br />";
            }
            
            echo "PER ".strtoupper(Tanggal::getTglSekarangIndo());
            echo "<br />";
            echo "(PIC: ".strtoupper(Session::get('user')).")";
            ?>

        </p>
         <table border="0" align="center" cellspacing=0 cellpadding=0 width=90% style="border-width: 0px; font-size: 10px;">
            <tr>
                <td class="td2" align="right"> 
                    <FORM>
                        <button TYPE="button" id="printbtn" onClick="cetak();">Cetak</button>
                    </FORM>
                </td>
            </tr>
        </table>
        <br />
        <table align="center" cellspacing=0 cellpadding=4 width=90% style="border-width: 1px; font-size: 10px; border-style: solid; border-color: black;">
            <thead bgcolor="#E6F9ED">
            <th>No</th>
            <th>No & Tgl Kontrak</th>
            <th>Jurusan</th>
            <th>Nama Biaya</th>
            <th>Jumlah Biaya</th>
            <th>Jadwal <br />dibayarkan</th>
<!--            <th>Jumlah dibayarkan</th>-->
            <th>Status <br />Pembayaran</th>
            <th>No dan Tgl SP2D</th>
        </thead>

        <?php
        $i = 1;
        $total = 0;
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
                <td align="right"><?php echo number_format($val->jml_biaya); ?></td>
                <td><?php echo $val->jadwal_bayar; ?></td>
<!--                <td><?php echo number_format($this->biaya->get_biaya_by_kontrak_dibayar($val->kd_kontrak)); ?></td>-->
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
            $total = $total + $val->jml_biaya;
        }
        ?>
            <tr>
                <td colspan="4"></td>
                <td align="right"><?php echo number_format($total); ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
    </table>
</body>
</html>
<script type="text/javascript">
    function cetak(){
		window.print();
		window.onfocus = function() { window.close(); }
	}
</script>
