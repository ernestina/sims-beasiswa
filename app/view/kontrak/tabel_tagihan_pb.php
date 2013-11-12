<table width="100%">
    <thead>
    <th>NO</th>
    <th>NIP</th>
    <th>Nama</th>
    <th>Status</th>
    <th>Pilihan</th>
</thead>
<?php
$i = 1;
            foreach ($this->pb as $val) {
                $penerima_biaya = $this->penerima_biaya->get_by_biaya_pb($this->kd_biaya, $val->get_kd_pb());
                if($penerima_biaya!=false){
                    $check = " checked";
                } else {
                    $check = "";
                }
                        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $val->get_nip(); ?></td>
                    <td><?php echo $val->get_nama(); ?></td>
                    <td><?php echo StatusPB::status_int_string($val->get_status()); ?></td>
                    <td><input type="checkbox" value="<?php echo $val->get_kd_pb(); ?>" name="<?php echo "penerima[]"; ?>" id="<?php echo "penerima[]"; ?>" <?php echo $check; ?>/></td>
                </tr> 
                <?php
                $i++;
            }
            ?>
        </table>

		<script>
		$(":checkbox").change(function(){
						
			if(ceklist() == $('#jml_peg').val()){
				removeError('wjml_penerima');
			}
		})		
		</script>

