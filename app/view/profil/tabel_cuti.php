<table class="table-bordered zebra" style="display: block">
				<thead>
					<th>No</th>
					<th width="100">No. Surat Cuti</th>
					<th width="150">Tanggal Surat Cuti</th>
					<th width="150">Periode Awal Cuti</th>
					<th width="150">Periode Akhir Cuti</th>
					<th width="200">Jenis Cuti</th>
					<th width="100">File</th>
				</thead>
				<tbody>
                                    <?php 
                                        $no =1;
                                        foreach($this->d_cuti as $v) {
                                    ?>
					<tr>
						<td><?php echo $no;?></td>
                                                <td><?php echo $v->get_no_surat_cuti();?></td>
                                                <td><?php echo Tanggal::tgl_indo($v->get_tgl_surat_cuti());?></td>
                                                <td><?php echo $v->get_prd_mulai();?></td>
						<td><?php echo $v->get_prd_selesai();?></td>
                                                <td><?php echo $v->get_jenis_cuti();?></td>
						<td><?php echo $no;?></td>
					</tr>
                                        <?php $no++; } ?>
				</tbody>
		</table>