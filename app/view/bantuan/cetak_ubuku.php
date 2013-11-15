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
            <?php 
            if($this->elemen->get_bln()==1){
                $semester="GANJIL";
            } else {
               $semester="GENAP"; 
            }
            ?>
            DAFTAR PEMBAYARAN BIAYA BUKU BEASISWA INTERNAL DITJEN PERBENDAHARAAN<br />
            PADA PROGRAM STUDI <?php echo " " . strtoupper($this->strata->kode_strata) . " "; ?> <?php echo " " . strtoupper($this->jur->get_nama()) . " "; ?> <?php echo " " . strtoupper($this->univ->get_nama()) . " "; ?> ANGKATAN <?php echo " " . $this->elemen->get_thn_masuk() . " "; ?><br />
            SEMESTER <?php echo " " . $semester . " "; ?> TAHUN <?php echo " " . $this->elemen->get_thn() . " "; ?> 
        </p>

        <table border="0" align="center" cellspacing=0 cellpadding=0 width=97% style="border-width: 0px; font-size: 10px;">
            <tr>
                <td class="td2" align="right"> 
                    <FORM>
                        <button TYPE="button" id="printbtn" onClick="cetak();">Cetak</button>
                    </FORM>
                </td>
            </tr>
        </table>
        <table align="center" cellspacing=0 cellpadding=4 width=97% style="border-width: 1px; font-size: 10px; border-style: solid; border-color: black;">
            <tr>
                <th >No</th>
                <th >Nama</th>
                <th >NIP</th>
                <th >Gol</th>
                <th >Bantuan Buku</th>
                <th >Jumlah Kotor</th>
                <th >Jumlah Terima</th>
                <th >Bank<br>Penerima</th>
                <th >No<br>Rekening</th>
                <th width="15%" colspan="2">Tanda Tangan</th>
            </tr>
            <?php
            $no = 1;
            $total_jml_kotor = 0;
            foreach ($this->penerima_elemen as $pb) {

                $this->pb->set_kd_pb($pb->kd_pb);
                $penerima = $this->pb->get_penerima_by_id($this->pb);


                $bank = $this->bank->get_bank_id($penerima->get_bank());
                ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $penerima->get_nama(); ?></td>
                    <td><?php echo $penerima->get_nip(); ?></td>
                    <td><?php echo Golongan::golongan_int_string2($penerima->get_gol()); ?></td>
                    <td align="right"><?php echo number_format($biaya_per_pegawai); ?></td>
                    <td align="right"><?php echo number_format($biaya_per_pegawai); ?></td>
                    <td align="right"><?php echo number_format($biaya_per_pegawai); ?></td>
                    <td><?php echo $bank->get_nama(); ?></td>
                    <td><?php echo $penerima->get_no_rek(); ?></td>
                    <td class="td2">
                        <div>
                            <table border="0" align="center" cellspacing=0 cellpadding=0 width=100% style="border-width: 0px; font-size: 10px;">
                                <tr>
                                    <td class="td2" width="50%">
                                        <?php
                                        if ($no == 1) {
                                            echo "1......";
                                        } else {
                                            if (($no % 2) == 1) {
                                                echo $no . "......";
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td class="td2" width="50%">
                                        <?php
                                        if (($no % 2) == 0 && $no != 1) {
                                            echo $no . "......";
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table> 
                        </div>
                    </td>

                </tr>
                <?php
                $no++;
                $total_jml_kotor = $total_jml_kotor + $biaya_per_pegawai;
            }
            ?>
            <tr>
                <td colspan="4" align="center"> Jumlah</td>
                <td align="right"><?php echo number_format($biaya_per_pegawai * ($no - 1)); ?></td>
                <td align="right"><?php echo number_format($total_jml_kotor); ?></td>
                <td align="right"><?php echo number_format($total_jml_kotor); ?></td>
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
                    Jakarta, &nbsp; &nbsp; &nbsp; &nbsp;   <?php echo Tanggal::bulan_indo(date('m')) . " " . date('Y'); ?><br />
                    Lunas dibayar,<br/>
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