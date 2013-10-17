<div id="top">
    <h2>DAFTAR BIAYA TUGAS AKHIR/SKRIPSI/TESIS/DESERTASI</h2>

<div id="dropdown-menu">

		<table style="margin-left: 10px" width="98%">
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
                <td ><input type="search" name="cari" id="cari" value="cari" style="float: right"> </td>
            </tr>
        </table>
   
        <button href="<?php echo URL.'elemenBeasiswa/addSkripsi'?>" style="margin-right:20px"><i class="icon-plus icon-white"></i>  TAMBAH</button>
		
		<!--input type="button" id="add" value="TAMBAH" onClick="location.href=''"-->
    
</div>
<BR><BR><br>
<div id="table">
    <table class="table-bordered zebra" >
        <thead>
        <th width='3%'>No</th>
        <th width='10%'>No dan Tgl SP2D</th>
        <th width='20%'>Universitas</th>
        <th width='20%'>Jurusan/Prodi</th>
        <th width='5%'>Th. Masuk</th>
        <th width='5%'>Jumlah Pegawai</th>
        <th width='5%'>Tahun</th>
        <th width='10%'>Total Bayar</th>
        <th width='7%'>Aksi</th>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach ($this->data as $val){
                    echo "<tr>";
                    echo "<td>$no</td>";
                    echo "<td>".$val->get_no_sp2d()." ".$val->get_tgl_sp2d()."</td>";
                    echo "<td>ITS</td>";
                    echo "<td>Sistem Informasi</td>";
                    echo "<td>2013</td>";
                    echo "<td>".$val->get_jml_peg()."</td>";
                    echo "<td>".$val->get_thn()."</td>";
                    echo "<td>".$val->get_total_bayar()."</td>";
                    echo "<td width='60'><a href=".URL."elemenBeasiswa/delSkripsi/".$val->get_kd_d()."><i class=\"icon-trash\"></i></a> &nbsp &nbsp 
                        <a href=".URL."elemenBeasiswa/addSkripsi/".$val->get_kd_d()."><i class=\"icon-pencil\"></i></a></td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
        </tbody>
    </table>
    
</div>
</div>

