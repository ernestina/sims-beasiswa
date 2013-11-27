<div id="table-title"></div>
    <div id="table-content">
<table class="table-bordered zebra scroll">
            <thead >
            <th width="5%">No</th>
            <th width="10%">No Surat Cuti</th>
            <th width="10%">Jenis Cuti</th>
            <th width="20%">Penerima Beasiswa</th>
            <th width="8%" style="font-size: 80%">Periode Cuti</th>
            <th width="8%" style="font-size: 80%">Perk.Stop Elemen Beasiswa</th>
            <th width="8%" style="font-size: 80%">Perk. Pembayaran Kembali</th>
            <th width="15%" style="font-size: 80%">Jurusan/ Prodi</th>
            <?php if(Session::get('role')==2){ ?>
            <th width="20%">Aksi</th>
            <?php } ?>
            </thead>
			<tbody style="text-align: center">
            <?php 
                $no=($this->paging->page-1)*$this->paging->batas+1;
                foreach($this->d_ct as $val){
                    $d_pb = explode("-",$val->get_pb());
                    $perk_go = explode(" ", $val->get_perk_go());
                    $perk_stop = explode(" ", $val->get_perk_stop());;
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td><a style='cursor:pointer' onCLick='view(\"".$val->get_file()."\")' title='lihat surat cuti'>".$val->get_no_surat_cuti()."</a></br>".Tanggal::tgl_indo($val->get_tgl_surat_cuti())."</td>";
                    echo "<td>".$val->get_jenis_cuti()."</td>";
                    echo "<td style='text-align: left'>".$d_pb[0]."</br>".$d_pb[1]."</td>";
                    echo "<td>".(($val->get_prd_mulai()==1)?'ganjil':'genap')."</td>";
                    echo "<td>".Tanggal::bulan_indo($perk_stop[0])." ".$perk_stop[1]."</td>";
                    echo "<td>".Tanggal::bulan_indo($perk_go[0])." ".$perk_go[1]."</td>";
                    echo "<td style='text-align: left'>".$d_pb[2]."</td>";
                    if(Session::get('role')==2){ 
                    echo "<td><a href=".URL."cuti/del_sc/".$val->get_kode_cuti()." onClick='return del(\"$d_pb[0]\",\"".$val->get_no_surat_cuti()."\")' title='hapus'><i class=\"icon-trash\"></i></a> &nbsp
                        <a href=".URL."cuti/datasc/".$val->get_kode_cuti()." title='ubah'><i class=\"icon-pencil\"></i></a></td>";
                    }
                    echo "</tr>";
                    $no++;
                }
            ?>
        </tbody>
		</table>
    </div>
<script type="text/javascript">

function view(file){
    console.log(file);
    var url = "<?php echo URL;?>cuti/view_sc/"+file;
    
    var w = 800;
    var h = 500;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    var title = "tampilan surat tugas";
    window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

function del(name,nomor){
    var answer = "Data surat cuti nomor "+nomor+" an."+name+" akan dihapus?";
    if(confirm(answer)){
        return true;
    }else{
        return false;
    }
}

</script>