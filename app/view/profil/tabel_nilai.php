<ul class="inline">
				<!--li><input class="unggah" type="text" id="tgl_lapor" disabled /></li-->
				<li><input type="text" id="IPK" name="IPK" value="<?php echo $this->d_cur_ipk->get_ipk()/100;?>" disabled class="unggah"/></li>
				<li><input type="button" value="Lihat" id="fileIPK" class="lihat"/><!--View file transkrip IPK akhir-->
				</li>
			</ul>
			
			<table class="table-bordered zebra">
				<thead>
					<th>No</th>
					<th>Keterangan</th>
					<th>IP</th>
					<th>File</th>
				</thead>
				<tbody>
                                    <?php 
                                        $no=1;
                                        foreach ($this->d_nil as $v){
                                   ?>
					<tr>
						<td><?php echo $no;?></td>
						<td><input class="keterangan" type="text" id="ket" name="ket" value="<?php echo "Semester ".$v->get_semester()." dengan IPS ".($v->get_ips()/100); ?>"/></td>
						<td><input class="mini" type="text" id="IP" name="IP" value="<?php echo $v->get_ipk()/100;?>"/></td>
						<td><input type="button" value="Pilih..." id="uplod_ip" name="uplod_ip" /></td>
					</tr>
                                    <?php 
                                            $no++;
                                        }
                                     ?>
				</tbody>
			</table>