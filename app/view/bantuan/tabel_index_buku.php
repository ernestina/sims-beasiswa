<div id="no_hal">
<table width=100% style="margin-left: 0px padding-left: 10px">
<td width=100%><?php 
if($this->cur_page !="" && $this->page_num!="") echo "HALAMAN ".$this->cur_page." DARI ".$this->page_num; 
?></td>
</table>
</div>

<input type="hidden" id="cur_page" name="cur_page" value="<?php echo $this->cur_page; ?>"/>
<input type="hidden" id="last_page" name="last_page" value="<?php echo $this->page_num; ?>"/>
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
		$num=$no+($this->per_page*($this->cur_page-1));
        echo "<tr>";
        echo "<td>".$num."</td>";
        $tgl = "";
        if (date('d-m-Y', strtotime($val->get_tgl_sp2d())) != "01-01-1970" && date('d-m-Y', strtotime($val->get_tgl_sp2d())) != "00-00-0000") {
            $tgl = date('d-m-Y', strtotime($val->get_tgl_sp2d()));
        }
        echo "<td>" . $val->get_no_sp2d() . " / " . $tgl . "</td>";

        echo "<td style='text-align: left'>" . $val->get_univ() . "</td>";
//                    $this->jur->set_kode_jur($val->get_kd_jur());
//                    $jur = $this->jur2->get_jur_by_id($this->jur2);
        echo "<td style='text-align: left'>" . $val->get_kd_jur() . "</td>";
        echo "<td>" . $val->get_thn_masuk() . "</td>";
        echo "<td>" . $val->get_jml_peg() . "</td>";

        if ($val->get_bln() == 1) {
            $semester = "Ganjil";
        } else {
            $semester = "Genap";
        }
        echo "<td>" . $semester . "</td>";
        echo "<td>" . $val->get_thn() . "</td>";
        echo "<td style=\"text-align: right\">" . number_format($val->get_total_bayar()) . "</td>";
		if(Session::get('role')==2){ 
		$ket = $semester." ".$val->get_thn()." Jurusan ".$val->get_kd_jur()." ".$val->get_univ()." ".$val->get_thn_masuk();
        echo "<td><a href=" . URL . "elemenBeasiswa/delUangBuku/" . $val->get_kd_d() . " onClick=\"return del('".$ket."');\" title=\"hapus\"><i class=\"icon-trash\"></i></a> &nbsp
                        <a href=" . URL . "elemenBeasiswa/editUangBuku/" . $val->get_kd_d() . "><i class=\"icon-pencil\" title=\"ubah\"></i></a> &nbsp
                            <a href='#' onClick='cetak_ubuku(" . $val->get_kd_d() . "); return false;' title='cetak'><i class=\"icon-print\"></i></a>
                            
        </td>";
        echo "</tr>";
		}
		if(Session::get('role')==3){ 
        echo "<td><a href='#' onClick='cetak_ubuku(" . $val->get_kd_d() . "); return false;' title='cetak'><i class=\"icon-print\"></i></a>
                            
        </td>";
        echo "</tr>";
		}
        $no++;
    }
    ?>
</tbody>
</table>

<script>
    function del(ket){
        var txt = "Yakin data uang buku semester "+ket+" akan dihapus?";
        if(confirm(txt))
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