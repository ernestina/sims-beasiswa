<table>
    <thead>

    <th>No</th>
    <th>Nama</th>
    <th>Gol</th>
    <th>Status</th>
    <th>Bank Penerima</th>
    <th>No. Rekening</th>
    <th>Pilih</th>

</thead>
<tbody>
<input type="hidden" id="jml_peg" name="jml_peg" value="<?php echo count($this->penerima_elemen); ?>" />
<?php
$i = 1;
//var_dump($this->penerima_elemen);
foreach ($this->pb as $pb) {
    $bank = $this->bank->get_bank_id($pb->get_bank());
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $pb->get_nama(); ?></td>
        <td><?php echo Golongan::golongan_int_string($pb->get_gol()); ?></td>
        <td><?php echo StatusPB::status_int_string($pb->get_status()); ?></td>
        <td><?php echo $bank->get_nama(); ?></td>
        <td><?php echo $pb->get_no_rek(); ?></td>
        <td>
            <?php if ($this->penerima_elemen->get_by_elemen_pb($this->kd_el, $pb->get_kd_pb()) == true) { ?>
                <input type="checkbox" id="setuju[]" name="setuju[]" value="<?php echo $pb->get_kd_pb(); ?>" checked />
            <?php } else { ?>
                <input type="checkbox" id="setuju[]" name="setuju[]" value="<?php echo $pb->get_kd_pb(); ?>" <?php if($this->penerima_el->cek_skripsi_by_pb($val4->get_kd_pb())==TRUE){echo " disabled";} ?>/>
            <?php } ?>
        </td>



    </tr>
    <?php
    $i++;
}
?>
</tbody>
</table>
<div id="tes"></div>
<div id="tes2"></div>
<script>
    $(':checkbox').change(function(){
        var cks = document.getElementsByName('setuju[]');
        var cek=0;
        for (var j = 0; j < cks.length; j++){
            if (cks[j].checked){
                cek++;
            }
        }
        
        if(cek>0){
            removeError('wtabel_penerima_buku');
            removeError('wtotal_biaya');
           
        }
         $('#total_bayar').val(cek*$('#biaya_buku').val());
    })
    
    
</script>