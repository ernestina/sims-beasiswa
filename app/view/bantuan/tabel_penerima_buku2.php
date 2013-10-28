<!--ubah buku-->
<table class="table-bordered zebra">
    <thead>
    <th width="5%">No</th>
    <th width="25%">Nama</th>
    <th width="20%">Gol</th>
    <th width="10%">Status</th>
    <th width="15%">Bank Penerima</th>
    <th width="15%">No. Rekening</th>
    <th width="10%">Pilih</th>
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
        <td style="text-align: center"><?php echo $i; ?></td>
        <td><?php echo $pb->get_nama(); ?></td>
        <td><?php echo Golongan::golongan_int_string($pb->get_gol()); ?></td>
        <td><?php echo StatusPB::status_int_string($pb->get_status()); ?></td>
        <td><?php echo $bank->get_nama(); ?></td>
        <td><?php echo $pb->get_no_rek(); ?></td>
        <td>
            <?php if ($this->penerima_elemen->get_by_elemen_pb($this->kd_el, $pb->get_kd_pb()) == true) { //mengecek apakah pb dibayarkan berdasark kd_elemen_beasiswa
                ?> 
                <input type="checkbox" id="setuju[]" name="setuju[]" value="<?php echo $pb->get_kd_pb(); ?>" checked />
            <?php } else { ?>
                <input type="checkbox" id="setuju[]" name="setuju[]" value="<?php echo $pb->get_kd_pb(); ?>" 
                <?php
                if ($this->penerima_elemen->cek_buku_by_pb($pb->get_kd_pb(), $this->semester, $this->thn) == TRUE) { //mengecek apakah ob pernah dibauarkan pada semester dan tahun tertentu
                    echo " disabled title='Sedang proses/selesai dibayar.'";
                }
                ?>
                       />
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