<table class="table-bordered zebra" style="width:100%;margin-left: 0px;padding-left: 0px;">
				<thead>
					<th>No</th>
					<th>Uraian</th>
					<th>Sumber</th>
				</thead>
				<tbody>
                                    <?php 
                                        $no=1;
                                        foreach ($this->d_mas as $v){
                                   ?>
					<tr>
						<td><?php echo $no;?></td>
						<td><?php echo $v->get_uraian();?></td>
						<td><?php echo $v->get_sumber_masalah();?></td>
					</tr>
                                    <?php 
                                            $no++;
                                        }
                                     ?>
				</tbody>
			</table>