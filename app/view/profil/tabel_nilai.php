			<table class="table-bordered zebra" style="width:45%;margin-left: 0px;padding-left: 0px;">
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
						<td><?php echo "Semester ".$v->get_semester()." dengan IPS ".($v->get_ips()/100); ?></td>
						<td><?php echo $v->get_ipk()/100;?></td>
						<td><input type="button" value="Pilih..." id="uplod_ip" name="uplod_ip" /></td>
					</tr>
                                    <?php 
                                            $no++;
                                        }
                                     ?>
				</tbody>
			</table>