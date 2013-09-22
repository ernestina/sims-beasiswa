<div>
    DAFTAR BIAYA TUNJANGAN HIDUP
</div>

<div id="dropdown-menu">
    <div>Universitas : 
        <select id="univ">
            <option>Universitas Indonesia</option>
        </select>
    </div>
    <div>
        Jurusan/Prodi :
        <select id="jur">
            <option>Akuntansi</option>
        </select>
    </div>
    <div>
        Tahun Masuk :
        <select>
            <option>2013</option>
        </select>
    </div>
    <div>
        <input type="button" id="add" value="TAMBAH" onClick="location.href='<?php echo URL.'elemenBeasiswa/addElem'?>'">
    </div>
</div>
<div id="table">
    <table>
        <thead>
        <th>No</th>
        <th>No dan Tgl SP2D</th>
        <th>Universitas</th>
        <th>Jurusan/Prodi Th. Masuk</th>
        <th>Jumlah Pegawai</th>
        <th>Bulan</th>
        <th>Tahun</th>
        <th>Total Bayar</th>
        <th>Aksi</th>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach ($this->data as $val){
                    echo "<tr>";
                    echo "<td>$no</td>";
                    echo "<td>".$val->get_no_sp2d()." ".$val->get_tgl_sp2d()."</td>";
                    echo "<td> ITS</td>";
                    echo "<td> Sistem Informasi 2013</td>";
                    echo "<td>".$val->get_jml_peg()."</td>";
                    echo "<td>".$val->get_bln()."</td>";
                    echo "<td>".$val->get_thn()."</td>";
                    echo "<td>".$val->get_total_bayar()."</td>";
                    echo "<td><a href=".URL."elemenBeasiswa/delElem/".$val->get_kd_d().">X</a> | 
                        <a href=".URL."elemenBeasiswa/addElem/".$val->get_kd_d().">...</a></td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
            </tbody>
    </table>
</div>
