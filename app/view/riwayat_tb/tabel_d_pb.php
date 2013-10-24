<table class="table-bordered zebra scroll" >
        <thead >
        <th>no</th>
        <th width="15%">NIP</th>
        <th width="25%">Nama</th>
        <th width="15%">Golongan</th>
        <th width="20%">Unit Asal</th>
        <th width="20%">Jurusan</th>
        <th width="20%">Jenis Beasiswa</th>
        </thead>
		<tbody>
        <?php 
            $no=1;
            foreach($this->d_pb as $v){
                echo "<tr>";
                echo "<td style=\"text-align: center\">".$no."</td>";
                echo "<td><a href=".URL."penerima/profil/".$v->get_kd_pb().">".$v->get_nip()."</a></td>";
                echo "<td>".$v->get_nama()."</td>";
                echo "<td>".Golongan::golongan_int_string($v->get_gol())."</td>";
                echo "<td>".$v->get_unit_asal()."</td>";
                echo "<td>".$v->get_jur()."</td>";
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