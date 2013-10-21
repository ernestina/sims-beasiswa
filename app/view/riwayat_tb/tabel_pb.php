<table>
            <thead>
            <th>No</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Unit Asal</th>
            <th>Aksi</th>
            </thead>
            <?php 
                $no=1;
                foreach($this->d_pb as $val){
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$val->get_nip()."</td>";
                    echo "<td>".$val->get_nama()."</td>";
                    echo "<td>".$val->get_unit_asal()."</td>";
//                    echo "<td><a href=".URL."surattugas/del_pb_from_st/".$val->get_kd_pb().">X</a></td>";
                    echo "<td>
					<a onclick='del_pb(".$val->get_kd_pb().");'><i class=\"icon-trash\"></i></a>
					</td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
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