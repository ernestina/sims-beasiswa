<div id="table-title"></div>
    <div id="table-content">
<table class="table-bordered zebra scroll">
            <thead>
            <th>No</th>
            <th width="170">No Surat Cuti</th>
            <th>Jenis Cuti</th>
            <th>Penerima Beasiswa</th>
            <th>Periode Cuti</th>
            <th>Perk.Stop Elemen Beasiswa</th>
            <th>Perk. Pembayaran Kembali</th>
            <th>Jurusan/ Prodi</th>
            <th width="88">Aksi</th>
            </thead>
            <?php 
                $no=1;
                foreach($this->d_ct as $val){
                    $d_pb = explode("-",$val->get_pb());
                    $perk_go = explode(" ", $val->get_perk_go());
                    $perk_stop = explode(" ", $val->get_perk_stop());;
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$val->get_no_surat_cuti()."</br>".Tanggal::tgl_indo($val->get_tgl_surat_cuti())."</td>";
                    echo "<td>".$val->get_jenis_cuti()."</td>";
                    echo "<td>".$d_pb[0]."</br>".$d_pb[1]."</td>";
                    echo "<td>".(($val->get_prd_mulai()==1)?'ganjil':'genap')."</td>";
                    echo "<td>".Tanggal::bulan_indo($perk_stop[0])." ".$perk_stop[1]."</td>";
                    echo "<td>".Tanggal::bulan_indo($perk_go[0])." ".$perk_go[1]."</td>";
                    echo "<td>".$d_pb[2]."</td>";
                    echo "<td><a href=".URL."cuti/del_sc/".$val->get_kode_cuti()."><i class=\"icon-trash\"></i></a> &nbsp &nbsp
                        <a href=".URL."cuti/datasc/".$val->get_kode_cuti()."><i class=\"icon-pencil\"></i></a></td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
        </table>
    </div>
<script type="text/javascript">

function view(file){
    var url = "<?php echo URL;?>surattugas/view_st/"+file;
    
    var w = 800;
    var h = 500;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    var title = "tampilan surat tugas";
    window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

</script>