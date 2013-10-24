<table class="table-bordered zebra">
    <thead>
    <th>No</th>
    <th>Nama Biaya</th>
    <th>Periode Pembayaran</th>
    <th>Universitas</th>
    <th>Jurusan </th>
    <th>Th Masuk</th>
    <th style="font-size: 75%">Jumlah<br>Pegawai dibayarkan</th>
    <th style="font-size: 80%">Jumlah Pegawai TB</th>
    <th>No. dan Tgl SP2D</th>
    <th>Jumlah dibayarkan</th>
</thead>
<tbody>
    <?php
    $no = 1;
    //var_dump($this->data);
    foreach ($this->data as $val4) {
        echo "<tr>";
        echo "<td style='text-align: center'>$no</td>";
        $jns_elem = $val4->get_kd_r();
        
        $bulan = $val4->get_bln();
        if ($jns_elem == 1) {
            echo "<td>Tunjangan Hidup</td>";
        } else if ($jns_elem == 2) {
            echo "<td>Tunjangan Buku</td>";
        } else if ($jns_elem == 3) {
            echo "<td>Tunjangan Skripsi/TA/Tesis</td>";
        } else {
            echo "<td>Nama biaya tidak terdaftar</td>";
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
        echo "<td>" . $val4->get_univ() . "</td>";
        $this->jurusan->set_kode_jur($val4->get_kd_jur());
        $jur = $this->jurusan->get_jur_by_id($this->jurusan);
        echo "<td>" . $jur->get_nama() . "</td>";
        echo "<td style='text-align: center'>" . $val4->get_thn_masuk() . "</td>";
        echo "<td style='text-align: center'>" . $val4->get_jml_peg() . "</td>";
        echo "<td style='text-align: center'>" . count($this->pb->get_penerima_by_kd_jur_thn_masuk($val4->get_kd_jur(),$val4->get_thn_masuk() )) . "</td>";
        $tgl = "";
        if (date('d-m-Y', strtotime($val4->get_tgl_sp2d())) != "01-01-1970" && date('d-m-Y', strtotime($val4->get_tgl_sp2d())) != "00-00-0000") {
            $tgl = date('d-m-Y', strtotime($val4->get_tgl_sp2d()));
        }
        echo "<td style='text-align: center'>" . $val4->get_no_sp2d() . " / " . $tgl . "</td></center>";
        echo "<td style='text-align: right'>" . number_format($val4->get_total_bayar()) . "</td>";
        echo "</tr>";
        $no++;
    }
    ?>
</tbody>
</table>