<!DOCTYPE html>
<html>
    <head>
        <title>SIMS OKE <?php echo Tanggal::getTimeSekarang(); ?></title>   
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
        <p align="center" style="font-weight: bold; font-size:12px;">
            <?php 
            if ($this->elemen != "") {
                $el = $this->elemen;
                switch ($el) {
                    case 1:
                        $r_el = " Tunjangan Hidup";
                        break;
                    case 2:
                        $r_el = " Tunjangan Buku";
                        break;
                    case 3:
                        $r_el = " Tunjangan Skripsi/TA/Tesis";
                        break;
                }
            }
            ?>
            LAPORAN MONITORING PEMBAYARAN ELEMEN BEASISWA <?php echo strtoupper($r_el); ?> <br />
            PEGAWAI TUGAS BELAJAR INTERNAL DIREKTORAT JENDERAL PERBENDAHARAAN <br />
            <?php
            
            if ($this->univ != 0) {
                echo strtoupper($this->universitas->get_nama()) . "<br />";
            }
            if ($this->jur != 0) {
                echo "JURUSAN " . strtoupper($this->data_jurusan->get_nama());
            }

            if ($this->tahun != 0) {
                echo " TAHUN " . strtoupper($this->tahun) . "<br />";
            } 
            
            ?>
            <?php echo PER." ".strtoupper(Tanggal::getTglSekarangIndo()); ?>

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
            <thead>
            <th>No</th>
            <?php $k=0; ?>
            <?php if ($this->elemen == 0) { ?>
            <th>Nama Biaya</th>
            <?php $k=$k+1; } ?>
            <th>Periode Pembayaran</th>
            <?php if ($this->univ == 0) { ?>
                <th>Universitas</th>
            <?php $k=$k+1; } ?>
            <?php if ($this->jur == 0) { ?>
                <th>Jurusan</th>
            <?php $k=$k+1; } ?>
            <?php if ($this->tahun == 0) { ?>
                <th>Tahun Masuk</th>
            <?php $k=$k+1; } ?>
            <th >Jumlah Pegawai dibayarkan</th>
            <th >Jumlah Pegawai TB</th>
            <th>No. dan Tgl SP2D</th>
            <th>Jumlah dibayarkan</th>
        </thead>
        <tbody>
            <?php
            $no = 1;
            //var_dump($this->data);
            $total=0;
            foreach ($this->data as $val4) {
                echo "<tr>";
                echo "<td>$no</td>";
                $jns_elem = $val4->get_kd_r();
                $bulan = $val4->get_bln();
                if ($this->elemen == 0) {  
                    if ($jns_elem == 1) {
                        echo "<td>Tunjangan Hidup</td>";
                    } else if ($jns_elem == 2) {
                        echo "<td>Tunjangan Buku</td>";
                    } else if ($jns_elem == 3) {
                        echo "<td>Tunjangan Skripsi/TA/Tesis</td>";
                    } else {
                        echo "<td>Nama biaya tidak terdaftar</td>";
                    }
                }

                if ($jns_elem == 1) {
                    echo "<td>" . Tanggal::bulan_indo($bulan) . " " . $val4->get_thn() . "</td>";
                    /* if ($bulan==1){
                      echo "<td>Januari ".$val4->get_thn()."</td>";
                      } else if ($bulan==2) {
                      echo "<td>Februari ".$val4->get_thn()."</td>";
                      } else if ($bulan==3) {
                      echo "<td>Maret ".$val4->get_thn()."</td>";
                      } else if ($bulan==4) {
                      echo "<td>April ".$val4->get_thn()."</td>";
                      } else if ($bulan==5) {
                      echo "<td>Mei ".$val4->get_thn()."</td>";
                      } else if ($bulan==6) {
                      echo "<td>Juni ".$val4->get_thn()."</td>";
                      } else if ($bulan==7) {
                      echo "<td>Juli ".$val4->get_thn()."</td>";
                      } else if ($bulan==8) {
                      echo "<td>Agustus ".$val4->get_thn()."</td>";
                      } else if ($bulan==9) {
                      echo "<td>September ".$val4->get_thn()."</td>";
                      } else if ($bulan==10) {
                      echo "<td>Oktober ".$val4->get_thn()."</td>";
                      } else if ($bulan==11) {
                      echo "<td>Nopember ".$val4->get_thn()."</td>";
                      } else if ($bulan==12) {
                      echo "<td>Desember ".$val4->get_thn()."</td>";
                      } else {
                      echo "<td>Bulan dan Tahun tidak diketahui</td>";
                      } */
                } else if ($jns_elem == 2) {
                    if ($bulan == 1) {
                        echo "<td>Semester I " . $val4->get_thn() . "</td>";
                    } else if ($bulan == 2) {
                        echo "<td>Semester 2 " . $val4->get_thn() . "</td>";
                    } else {
                        echo "<td>Semester dan Tahun tidak diketahui</td>";
                    }
                } else if ($jns_elem == 3) {
                    echo "<td>-</td>";
                } else {
                    echo "<td>Periode tidak diketahui</td>";
                }

                if ($this->univ == 0) {
                    echo "<td>" . $val4->get_univ() . "</td>";
                }
                $this->jurusan->set_kode_jur($val4->get_kd_jur());
                $jur = $this->jurusan->get_jur_by_id($this->jurusan);
                if ($this->jur == 0) {

                    echo "<td>" . $jur->get_nama() . "</td>";
                }

                if ($this->tahun == 0) {
                    echo "<td>" . $val4->get_thn_masuk() . "</td>";
                }
                echo "<td>" . $val4->get_jml_peg() . "</td>";
                echo "<td>" . count($this->pb->get_penerima_by_kd_jur_thn_masuk($val4->get_kd_jur(), $val4->get_thn_masuk())) . "</td>";
                $tgl = "";
                if (date('d-m-Y', strtotime($val4->get_tgl_sp2d())) != "01-01-1970" && date('d-m-Y', strtotime($val4->get_tgl_sp2d())) != "00-00-0000") {
                    $tgl = date('d-m-Y', strtotime($val4->get_tgl_sp2d()));
                }
                echo "<td>" . $val4->get_no_sp2d() . " / " . $tgl . "</td>";
                echo "<td align='right'>" . number_format($val4->get_total_bayar()) . "</td>";
                echo "</tr>";
                $no++;
                $total = $total + $val4->get_total_bayar();
            }
            ?>
            <tr>
                <td colspan="<?php echo $k+5;?>" align="right">Total</td>
                <td align="right"><?php echo number_format($total);?></td>
                
                
            </tr>
        </tbody>
    </table>
</body>
</html>

<script type="text/javascript">
    function cetak(){
        window.print();
        window.onfocus = function() { window.close(); }
    }
</script>