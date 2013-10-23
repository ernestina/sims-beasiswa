			<table class="table-bordered zebra" style="width:45%;margin-left: 20px;padding-left: 0px;">
				<thead>
					<th width="5%">No</th>
					<th width="50%">Keterangan</th>
					<th width="15%">IP</th>
					<th width="25%">File</th>
                    <th width="5%">Aksi</th>
				</thead>
				<tbody>
                                    <?php 
                                        $no=1;
                                        foreach ($this->d_nil as $v){
                                   ?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo "Semester ".$v->get_semester()." dengan IPS ".($v->get_ips()); ?></td>
						<td><?php echo $v->get_ipk();?></td>
						<td><input type="button" value="Transkrip" id="uplod_ip" name="uplod_ip" onClick="view('<?php echo $v->get_file();?>');"/></td>
                                                <td><a href="<?php echo URL;?>penerima/delnilai/<?php echo $v->get_kode().'/'.$this->d_pb->get_kd_pb().'/'.$this->url; ?>" title="hapus"><i class="icon-trash" onClick="return del_nil('<?php echo $this->d_pb->get_nama();?>','<?php echo $v->get_semester();?>')"></i></a>
                                                    </td>
					</tr>
                                    <?php 
                                            $no++;
                                        }
                                     ?>
				</tbody>
			</table>
<script type="text/javascript">

function view(file){
    var url = "<?php echo URL;?>penerima/view_transkrip/"+file;
    
    var w = 800;
    var h = 500;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    var title = "tampilan transkrip";
    window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

function del_nil(nama_pb,semester){
    var txt = "Yakin data nilai semester "+semester+" an "+nama_pb+" akan dihapus!"
    if(confirm(txt)){
        return true;
    }else{
        return false;
    }
}

</script>