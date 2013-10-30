<?php
$biaya_per_pegawai = $this->elemen->get_biaya_per_peg();
?>
<html>
    <head>
        <title>SIMS OKE <?php echo Tanggal::getTimeSekarang(); ?></title>   
        <style>
            td, th {
                border: 1px solid black;
            }
            tr {
                min-height: 30px;
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
        <p align="center" style="font-weight: bold; font-size:12px;">

            DAFTAR PEMBAYARAN BIAYA HIDUP BEASISWA INTERNAL DITJEN PERBENDAHARAAN<br />
            PADA PROGRAM STUDI <?php echo " " . strtoupper($this->strata->kode_strata) . " "; ?> <?php echo " " . strtoupper($this->jur->get_nama()) . " "; ?> <?php echo " " . strtoupper($this->univ->get_nama()) . " "; ?> ANGKATAN <?php echo " " . $this->elemen->get_thn_masuk() . " "; ?><br />
            BULAN <?php echo " " . strtoupper(Tanggal::bulan_indo($this->elemen->get_bln())) . " "; ?> TAHUN <?php echo " " . $this->elemen->get_thn() . " "; ?> 
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
        <table align="center" cellspacing=0 cellpadding=4 width=90% style="border-width: 1px; font-size: 10px; border-style: solid; border-color: black;">
            <tr>
                <th rowspan="2" >No</th>
                <th rowspan="2">Nama</th>
                <th rowspan="2">NIP</th>
                <th rowspan="2">Gol</th>
                <th colspan="5">Biaya Penunjang Hidup</th>
                <th rowspan="2">Bank<br>Penerima</th>
                <th rowspan="2">No<br>Rekening</th>
                <th width="15%" rowspan="2">Tanda Tangan</th>
            </tr>
            <tr >
                <th >Biaya <br>Penunjang</th>
                <th >Jml <br>Bln</th>
                <th style="display:none">% Hadir</th>
                <th style="display:none">Potongan<br></th>
                <th >Jumlah<br>Kotor</th>
                <th >PPh</th>
                <th >Jumlah<br>Bersih</th>
            </tr>
            <?php
            $no = 1;
            $total_potongan = 0;
            $total_pajak = 0;
            $total_jml_bersih = 0;
            $total_jml_kotor = 0;
            foreach ($this->penerima_elemen as $pb) {

                $this->pb->set_kd_pb($pb->kd_pb);
                $penerima = $this->pb->get_penerima_by_id($this->pb);
                $hadir = floatval($pb->kehadiran);
                //echo $hadir;
                $potongan = (100 - $hadir) * 0.01 * $biaya_per_pegawai;
                $jml_kotor = $biaya_per_pegawai - $potongan;
                $pajak = $pb->pajak * 0.01 * $jml_kotor;
                $jml_bersih = $jml_kotor - $pajak;
                if ($hadir == 0) {
                    $pajak = 0;
                }

                $bank = $this->bank->get_bank_id($penerima->get_bank());
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $penerima->get_nama(); ?></td>
                    <td><?php echo $penerima->get_nip(); ?></td>
                    <td><?php echo Golongan::golongan_int_string2($penerima->get_gol()); ?></td>
                    <td align="right"><?php echo number_format($biaya_per_pegawai); ?></td>
                    <td>1</td>
                    <td align="right" style="display:none"><?php echo $hadir; ?></td>
                    <td align="right" style="display:none"><?php echo number_format($potongan); ?></td>
                    <td align="right"><?php echo number_format($jml_kotor); ?></td>
                    <td align="right"><?php echo number_format($pajak); ?></td>
                    <td align="right"><?php echo number_format($jml_bersih); ?></td>
                    <td><?php echo $bank->get_nama(); ?></td>
                    <td><?php echo $penerima->get_no_rek(); ?></td>
                    <td class="td2"><div>
                            <table border="0" align="center" cellspacing=0 cellpadding=0 width=100% style="border-width: 0px; font-size: 10px;">
                                <tr>
                                    <td class="td2" width="50%"><?php
            if ($no == 1) {
                echo "1......";
            } else {
                if (($no % 2) == 1) {
                    echo $no . "......";
                }
            }
                ?></td>
                                    <td class="td2" width="50%"><?php
                                    if (($no % 2) == 0 && $no != 1) {
                                        echo $no . "......";
                                    }
                ?></td>
                                </tr>
                            </table> 
                        </div>
                    </td>

                </tr>
                <?php
                $no++;
                $total_potongan = $total_potongan + $potongan;
                $total_pajak = $total_pajak + $pajak;
                $total_jml_bersih = $total_jml_bersih + $jml_bersih;
                $total_jml_kotor = $total_jml_kotor + $jml_kotor;
            }
            ?>
            <tr>
                <td colspan="4" align="center"> Jumlah</td>
                <td align="right"><?php echo number_format($biaya_per_pegawai * ($no - 1)); ?></td>
                <td ></td>
                <td style="display:none"></td>
                <td align="right" style="display:none"><?php echo number_format($total_potongan) ?></td>
                <td align="right"><?php echo number_format($total_jml_kotor); ?></td>
                <td align="right"><?php echo number_format($total_pajak); ?></td>
                <td align="right"><?php echo number_format($total_jml_bersih); ?></td>
                <td ></td>
                <td ></td>
                <td ></td>                
            </tr>
        </table>

        <br/>
        <table border="0" align="center" cellspacing=0 cellpadding=0 width=90% style="border-width: 0px; font-size: 10px;">
            <tr>
                <td class="td2" width="30%" align="left">
                    Setuju Bayar,<br/>
                    <?php echo $this->ppk->nama_jabatan . " Selaku"; ?><br/>
                    Pejabat Pembuat Komitmen
                    <br/>
                    <br/>
                    <br/> 
                    <br/> 
                    <br/> 
                    <?php echo $this->ppk->nama_pejabat; ?><br/>
                    <?php echo "NIP " . $this->ppk->nip_pejabat; ?>
                </td>
                <td class="td2" width="30%" align="center">
                    Penanggung Jawab Kegiatan,<br />
                    <?php echo $this->pj->nama_jabatan; ?><br/>

                    <br/>
                    <br/>
                    <br/> 
                    <br/> 
                    <br/> 
                    <?php echo $this->pj->nama_pejabat; ?><br/>
                    <?php echo "NIP " . $this->pj->nip_pejabat; ?>
                </td>
                <td class="td2" width="30%" align="right">
                    Jakarta, &nbsp; &nbsp; &nbsp; &nbsp;   <?php echo Tanggal::bulan_indo($this->elemen->get_bln()) . " " . $this->elemen->get_thn(); ?><br />
                    Lunas dibayar
                    <?php echo $this->bdr->nama_jabatan; ?><br/>
                    <br/>
                    <br/>
                    <br/> 
                    <br/> 
                    <br/> 
                    <?php echo $this->bdr->nama_pejabat; ?><br/>
                    <?php echo "NIP " . $this->bdr->nip_pejabat; ?>
                </td>
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