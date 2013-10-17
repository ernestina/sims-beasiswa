<table class="table-bordered zebra scroll" >
        <thead >
        <th>no</th>
        <th width="15%">NIP</th>
        <th width="25%">Nama</th>
        <th width="15%">Gol</th>
        <th width="20%">Unit Asal</th>
        <th width="20%">Jurusan</th>
        <th width="20%">Jenis Beasiswa</th>
        </thead>
        <?php 
            $no=1;
            foreach($this->d_pb as $v){
                echo "<tr>";
                echo "<td>".$no."</td>";
                echo "<td><a href=".URL."penerima/profil/".$v->get_kd_pb().">".$v->get_nip()."</a></td>";
                echo "<td>".$v->get_nama()."</td>";
                echo "<td>".Golongan::golongan_int_string($v->get_gol())."</td>";
                echo "<td>".$v->get_unit_asal()."</td>";
                echo "<td>".$v->get_jur()."</td>";
                echo "<td><center><a href=".URL."penerima/delpb/".$v->get_kd_pb()." onClick='return del(\"".$v->get_nama()."\")'><i class=\"icon-trash\"></i></a> &nbsp
				<a href=".URL."penerima/profil/".$v->get_kd_pb()."><i class=\"icon-pencil\"></i></a>
				</center></td>";
                echo "</tr>";
                $no++;
            }
        ?>
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