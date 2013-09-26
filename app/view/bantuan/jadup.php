<div>
    DAFTAR BIAYA TUNJANGAN HIDUP
</div>

<div id="dropdown-menu">
    <div>
        <table>
            <tr>
                <td>
                    <label>Universitas</label>
                    <select>
                        <option value="0">Semua</option>>
                        <?php 
                            foreach ($this->fakul as $val){
                                echo "<option value=".$val->get_kode_fakul()." >".$val->get_kode_univ()." - ".$val->get_nama()."</option>";
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <label>Jurusan/Prodi</label>
                    <select>
                        <option value="0">Semua</option>>
                        <?php 
                            foreach ($this->jur as $val2){
                                echo "<option value=".$val2->get_kode_jur()." >".$val2->get_nama()."</option>";
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <label>Tahun Masuk</label>
                    <select>
                        <option value="0">Semua</option>>
                        <?php 
                            foreach ($this->kon as $val3){
                                echo "<option value=".$val3->thn_masuk_kontrak." >".$val3->thn_masuk_kontrak."</option>";
                            }
                        ?>
                    </select>
                </td>
                <td><input type="search" name="cari" id="cari" value="cari" size="30"></td>
            </tr>
        </table>
    </div>
    <div>
        <input type="button" id="add" value="TAMBAH" onClick="location.href='<?php echo URL.'elemenBeasiswa/addJadup'?>'">
    </div>
</div>
<div id="table">
    <table>
        <thead>
        <th>No</th>
        <th>No dan Tgl SP2D</th>
        <th>Universitas</th>
        <th>Jurusan/Prodi</th>
        <th>Th. Masuk</th>
        <th>Jumlah Pegawai yang Dibayar</th>
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
                    $jur=$val->get_kd_jur();
                    $univ=$this->univ->get_univ_by_jur($jur);
                    echo "<td>".$univ->get_kode()."</td>";
                    $this->jur2->set_kode_jur($val->get_kd_jur());
                    $jur=$this->jur2->get_jur_by_id($this->jur2);
                    echo "<td>".$jur->get_nama()."</td>";
                    echo "<td>".$val3->thn_masuk_kontrak."</td>";
                    echo "<td>".$val->get_jml_peg()."</td>";
                    $bulan=$val->get_bln();
                    echo "<td>".Tanggal::bulan_indo($bulan)."</td>";
                    echo "<td>".$val->get_thn()."</td>";
                    echo "<td>".$val->get_total_bayar()."</td>";
                    echo "<td><a href=".URL."elemenBeasiswa/delJadup/".$val->get_kd_d().">X</a> | 
                        <a href=".URL."elemenBeasiswa/addJadup/".$val->get_kd_d().">...</a></td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
            </tbody>
    </table>
</div>
