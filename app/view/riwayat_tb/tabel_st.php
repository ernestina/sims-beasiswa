<div id="table-title"></div>
    <div id="table-content">
<table class="table-bordered zebra scroll">
            <thead>
            <th width="5%">No</th>
            <th width="10%">No Surat Tugas</th>
            <th width="10%">Tanggal ST</th>
            <th width="10%">Tgl Mulai</th>
            <th width="10%">Tgl AKhir</th>
            <th width="10%">Jenis ST</th>
            <th width="25%">Jurusan/Prodi</th>
            <th width="15%">Aksi</th>
            </thead>
			<tbody style="text-align: center">
            <?php 
                $no=$this->paging->page*$this->paging->batas;
                if(count($this->d_st)>0){
                    foreach($this->d_st as $val){
                        echo "<tr>";
                        echo "<td>".$no."</td>";
                        echo "<td style='text-align: left'><a style='cursor:pointer;' onClick='view(\"".$val->get_file()."\")' title='lihat surat tugas'>".$val->get_nomor()."</a></td>";
                        echo "<td>".$val->get_tgl_st()."</td>";
                        echo "<td>".$val->get_tgl_mulai()."</td>";
                        echo "<td>".$val->get_tgl_selesai()."</td>";
                        echo "<td>".$val->get_jenis_st()."</td>";
                        echo "<td style='text-align: left'>".$val->get_jur()."</td>";
                        echo "<td><center><a href=".URL."surattugas/addpb/".$val->get_kd_st()." title='tambah penerima ST'><i class=\"icon-user\"></i></a>  &nbsp 
                            <a href=".URL."surattugas/del_st/".$val->get_kd_st()." onClick='return del(\"".$val->get_nomor()."\")' title='hapus'><i class=\"icon-trash\"></i></a> &nbsp 
                            <a href=".URL."surattugas/datast/".$val->get_kd_st()." title='ubah'><i class=\"icon-pencil\"></i></a></td></center>";
                        echo "</tr>";
                        $no++;
                    }
                }else{
                    echo "<tr><td colspan=8 align=center>DATA TIDAK DITEMUKAN</td></tr>";
                }
                
            ?>
        </tbody>
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

function del(nomor){
    var answer = "Data surat tugas nomor "+nomor+" akan dihapus?";
    if(confirm(answer)){
        return true;
    }else{
        return false;
    }
}

</script>