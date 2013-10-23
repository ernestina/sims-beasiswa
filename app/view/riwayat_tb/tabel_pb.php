<table width="77%">
            <thead>
            <th width="5%">No</th>
            <th width="20%">NIP</th>
            <th width="30%">Nama</th>
            <th width="30%">Unit Asal</th>
            <th width="5%">Aksi</th>
            </thead>
			<tbody style="text-align: center">
            <?php 
                $no=1;
                foreach($this->d_pb as $val){
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$val->get_nip()."</td>";
                    echo "<td style='text-align: left'>".$val->get_nama()."</td>";
                    echo "<td style='text-align: left'>".$val->get_unit_asal()."</td>";
//                    echo "<td><a href=".URL."surattugas/del_pb_from_st/".$val->get_kd_pb().">X</a></td>";
                    echo "<td>
					<a onclick='del_pb(".$val->get_kd_pb().");' title='hapus'><i class=\"icon-trash\"></i></a>
					</td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
        </tbody>
		</table>

<script type="text/javascript">
//function del_pb(nama){
//    var answer = "Data penerima beasiswa an. "+nama+" akan dihapus?";
//    if(confirm(answer)){
//        return true;
//    }else{
//        return false;
//    }
//}
</script>