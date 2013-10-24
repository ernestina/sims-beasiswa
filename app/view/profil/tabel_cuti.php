<table class="table-bordered zebra" width="95%">
				<thead>
					<th width="5%">No</th>
					<th width="15%">No. Surat Cuti</th>
					<th width="15%">Tgl Surat Cuti</th>
					<th width="15%">Periode Awal Cuti</th>
					<th width="15%">Periode Akhir Cuti</th>
					<th width="20%">Jenis Cuti</th>
					<th width="25%">File</th>
				</thead>
				<tbody style="text-align: center">
                                    <?php 
                                        $no =1;
                                        foreach($this->d_cuti as $v) {
                                    ?>
					<tr>
						<td><?php echo $no;?></td>
                        <td style="text-align: left"><?php echo $v->get_no_surat_cuti();?></td>
                        <td><?php echo Tanggal::tgl_indo($v->get_tgl_surat_cuti());?></td>
                        <td><?php echo $v->get_prd_mulai();?></td>
						<td><?php echo $v->get_prd_selesai();?></td>
                        <td style="text-align: left"><?php echo $v->get_jenis_cuti();?></td>
						<td style="text-align: left"><?php echo $no;?></td>
					</tr>
                                        <?php $no++; } ?>
				</tbody>
		</table>