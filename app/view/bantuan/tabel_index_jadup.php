<table class="table-bordered zebra">
    <thead>
    <th width="2%">No</th>
    <th width="10%">No dan Tgl SP2D</th>
    <th width="10%">Universitas</th>
    <th width="15%">Jurusan/Prodi</th>
    <th width="5%">Th. Masuk</th>
    <th width="5%">Jumlah Pegawai Dibayar</th>
    <th width="10%">Bulan</th>
    <th width="5%">Tahun</th>
    <th width="10%">Total Bayar</th>
    <th width="7%">Aksi</th>
</thead>
<tbody style="text-align: center">
    <?php
    $no = 1;
    //var_dump($this->elem);
    foreach ($this->elem as $val) {
        echo "<tr>";
        echo "<td>$no</td>";
        echo "<td>" . $val->get_no_sp2d() . "</td>";

        echo "<td>" . $val->get_univ() . "</td>";
//                    $this->jur->set_kode_jur($val->get_kd_jur());
//                    $jur = $this->jur2->get_jur_by_id($this->jur2);
        echo "<td>" . $val->get_kd_jur() . "</td>";
        echo "<td>" . $val->get_thn_masuk() . "</td>";
        echo "<td>" . $val->get_jml_peg() . "</td>";
        $bulan = $val->get_bln();
        echo "<td>" . Tanggal::bulan_indo($bulan) . "</td>";
        echo "<td>" . $val->get_thn() . "</td>";
        echo "<td>" . $val->get_total_bayar() . "</td>";
        echo "<td><a href=" . URL . "elemenBeasiswa/delJadup/" . $val->get_kd_d() . " onClick=\"return del();\"><i class=\"icon-trash\"></i></a> &nbsp &nbsp 
                        <a href=" . URL . "elemenBeasiswa/updateJadup/" . $val->get_kd_d() . "><i class=\"icon-pencil\"></i></a></td>";
        echo "</tr>";
        $no++;
    }
    ?>
</tbody>
</table>

<script>
    function del(){
        if(confirm('yakin akan menghapus data ini?'))
            return true;
        else return false
    }
</script>