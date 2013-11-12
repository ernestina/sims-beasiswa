<?php 
    if($this->jmlData>0){
            $jmlhal = $this->paging->jml_halaman($this->jmlData);
            $paging = $this->paging->navHalaman($jmlhal);
            echo $paging; }
?>
    </br>
    <div id="tb_pb_child">
<table class="table-bordered zebra scroll" >
        <thead>
        <th>No</th>
        <th width="20%">NIP/Nama</th>
        <th width="20%">Golongan/Unit Asal</th>
        <th width="23%">Jurusan</th>
        <th width="17%">Masa TB</th>
        <th width="10%">Status</th>
        <th width="7%">Aksi</th>
        </thead>
		<tbody>
        <?php 
            $no=$this->paging->page*$this->paging->batas;
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
    </div>
<input type="text" id="posisi" value="1">
<input type="text" id="jmlhal" value="1">
<script type="text/javascript">
function del(nama){
    var answer = "Data penerima beasiswa an. "+nama+" akan dihapus?";
    if(confirm(answer)){
        return true;
    }else{
        return false;
    }
}
//var next = document.getElementById('next').value;
//var prev = document.getElementById('prev').value;
//var last = document.getElementById('last').value;
//var first = document.getElementById('first').value;
var hal = parseInt(document.getElementById('posisi').value);
console.log(hal);
if($('#next').length > 0){
    $('#next').click(function(){
        
        $.post('<?php echo URL.'/'.$this->url;?>/'+hal,{},function(data){
            
        })
        hal++;
        document.getElementById('page').value = hal;
    
    });
}

if($('#prev').length > 0){
    $('#prev').click(function(){
    
    });
}

if($('#last').length > 0){
    $('#last').click(function(){
    
    });
}

if($('#first').length > 0){
    $('#first').click(function(){
    
    });
}



</script>