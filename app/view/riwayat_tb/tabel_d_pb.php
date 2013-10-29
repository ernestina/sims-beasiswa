<table class="table-bordered zebra scroll" >
        <thead >
        <th>No</th>
        <th width="20%">NIP/Nama</th>
        <th width="15%">Golongan/Unit Asal</th>
        <th width="25%">Jurusan</th>
        <th width="15%">Masa TB</th>
        <th width="15%">Status</th>
        <th width="7%">Aksi</th>
        </thead>
		<tbody>
        <?php 
            $no=1;
            foreach($this->d_pb as $v){
                $tmp = explode(";",$v->get_st());
                echo "<tr>";
                echo "<td style=\"text-align: center\">".$no."</td>";
                //echo "<td><a href=".URL."penerima/profil/".$v->get_kd_pb().">".$v->get_nip()."</a></td>";
                echo "<td>".$v->get_nip()."</br>".$v->get_nama()."</td>";
                echo "<td>".Golongan::golongan_int_string($v->get_gol())."</br>".$v->get_unit_asal()."</td>";
                echo "<td>".$v->get_jur()."</td>";
                echo "<td>dari : ".Tanggal::tgl_indo($tmp[0])."</br>sampai : ".Tanggal::tgl_indo($tmp[1])."</td>";
                echo "<td>".$v->get_status()."</td>";
                echo "<td><center><a href=".URL."penerima/delpb/".$v->get_kd_pb()." onClick='return del(\"".$v->get_nama()."\")' title=\"hapus\"><i class=\"icon-trash\"></i></a> &nbsp
				<a href=".URL."penerima/profil/".$v->get_kd_pb()." title='ubah'><i class=\"icon-pencil\"></i></a>
				</center></td>";
                echo "</tr>";
                $no++;
            }
        ?>
    </tbody>
	</table>

<script type="text/javascript">
function del(nama){
    var answer = "Data penerima beasiswa an. "+nama+" akan dihapus?";
    if(confirm(answer)){
        return true;
    }else{
        return false;
    }
}
</script>