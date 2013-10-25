<table class="table-bordered zebra">
    <thead>
    <th width="2%">No</th>
    <th width="10%">No dan Tgl SP2D</th>
    <th width="15%">Universitas</th>
    <th width="15%">Jurusan/Prodi</th>
    <th width="5%">Th. Masuk</th>
    <th width="5%">Jumlah Pegawai Dibayar</th>
    <th width="5%">Semester</th>
    <th width="5%">Tahun</th>
    <th width="10%">Total Bayar</th>
    <th width="8%">Aksi</th>
</thead>
<tbody style="text-align: center">
    <?php
    $no = 1;
    foreach ($this->buku as $val) {
        echo "<tr>";
        echo "<td>$no</td>";
        $tgl="";
        if(date('d-m-Y', strtotime($val->get_tgl_sp2d())) != "01-01-1970" && date('d-m-Y', strtotime($val->get_tgl_sp2d())) != "00-00-0000"){
            $tgl = date('d-m-Y', strtotime($val->get_tgl_sp2d()));
        }
        echo "<td>" . $val->get_no_sp2d() . " / ".$tgl."</td>";

        echo "<td style='text-align: left'>" . $val->get_univ() . "</td>";
//                    $this->jur->set_kode_jur($val->get_kd_jur());
//                    $jur = $this->jur2->get_jur_by_id($this->jur2);
        echo "<td style='text-align: left'>" . $val->get_kd_jur() . "</td>";
        echo "<td>".$val->get_thn_masuk()."</td>";
        echo "<td>" . $val->get_jml_peg() . "</td>";
        $semester = $val->get_bln();
        echo "<td>" . $semester . "</td>";
        echo "<td>" . $val->get_thn() . "</td>";
        echo "<td style=\"text-align: right\">" . number_format($val->get_total_bayar()) . "</td>";
        echo "<td><a href=" . URL . "elemenBeasiswa/delUangBuku/" . $val->get_kd_d() . " onClick=\"return del();\" title=\"hapus\"><i class=\"icon-trash\"></i></a> &nbsp
                        <a href=" . URL . "elemenBeasiswa/editUangBuku/" . $val->get_kd_d() . "><i class=\"icon-pencil\" title=\"ubah\"></i></a> &nbsp
                            <a href='#' onClick='cetak_ubuku(" . $val->get_kd_d() . "); return false;' title='cetak'><i class=\"icon-print\"></i></a>
                            
        </td>";
        echo "</tr>";
        $no++;
    }
    ?>
</tbody>
</table>

<script>
    function del(){
        if(confirm('Yakin akan menghapus data ini?'))
            return true;
        else return false
    }
    function cetak_ubuku(kd_el){  
        var url = "<?php echo URL; ?>elemenBeasiswa/cetak_ubuku/"+kd_el;
        var w = 1000;
        var h = 500;
        
        var title = "cetak pembayaran elemen jadup";
        window.open(url, title, 'toolbar=no, location=no, addressbar=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, copyhistory=no, width='+w+', height='+h);
    }
    
</script>