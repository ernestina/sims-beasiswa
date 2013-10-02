<div id="top">
    <h2>DAFTAR BIAYA TUNJANGAN HIDUP</h2>


<div id="dropdown-menu">
    
        <table width="97%">
            <tr>
                <td>
                    <label>Universitas</label>
                    <select type="text">
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
                    <select type="text">
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
                    <select type="text">
                        <option value="0">Semua</option>>
                        <?php 
                            foreach ($this->kon as $val3){
                                echo "<option value=".$val3->thn_masuk_kontrak." >".$val3->thn_masuk_kontrak."</option>";
                            }
                        ?>
                    </select>
                </td>
                <td style="float: right"><input type="search" name="cari" id="cari" value="cari" size="30"></td>
            </tr>
			<tr>
				<td colspan="4" style="padding-top: 0px">
					<input type="button" id="add" value="TAMBAH" onClick="location.href='<?php echo URL.'elemenBeasiswa/addJadup'?>'">
				</td>
			</tr>
        </table>
    
    <div>
        
    </div>
</div>
<div id="table">
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
                    echo "<td><a href=".URL."elemenBeasiswa/delJadup/".$val->get_kd_d()."><i class=\"icon-trash\"></i></a> &nbsp &nbsp 
                        <a href=".URL."elemenBeasiswa/addJadup/".$val->get_kd_d()."><i class=\"icon-pencil\"></i></a></td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
            </tbody>
    </table>
</div>
</div>