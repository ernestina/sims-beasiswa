<!--<fieldset>-->
<table class="table-bordered zebra">
    <thead>
    <th>No</th>
    <th>Nama</th>
    <th>Gol</th>
    <th>Status</th>
    <th>Bank Penerima</th>
    <th>No. Rekening</th>
    <th>Judul Penelitian</th>
    <th>Pilih</th>
</thead>
<tbody>
    <?php
    $no = 0;
    $i = 1;

    foreach ($this->pb as $val4) {
        $bank = $this->bank->get_bank_id($val4->get_bank());
        echo "<tr>";
        echo "<td>" . $i . "</td>";
        echo "<td>" . $val4->get_nama() . " / " . $val4->get_nip() . "</td>";
        echo "<td>" . Golongan::golongan_int_string($val4->get_gol()) . "</td>";
        echo "<td>" . StatusPB::status_int_string($val4->get_status()) . "</td>";
        echo "<td>" . $bank->get_nama() . "</td>";
        echo "<td>" . $val4->get_no_rek() . "</td>";
        echo "<td>" . $val4->get_skripsi() . "</td>";
        ?>
    <td>
        <?php if ($this->penerima_el->get_by_elemen_pb($this->kd_el, $val4->get_kd_pb()) == true) { ?>
            <input type="checkbox" id="setuju[]" name="setuju[]" value="<?php echo $val4->get_kd_pb(); ?>" checked />
        <?php } else { ?>
            <input type="checkbox" id="setuju[]" name="setuju[]" value="<?php echo $val4->get_kd_pb(); ?>" 
            <?php
            if ($this->penerima_el->cek_skripsi_by_pb($val4->get_kd_pb()) == TRUE) {
                echo " disabled title='Sedang proses bayar.'";
            }
            if ($val4->get_skripsi() == "") {
                echo " disabled title='Belum ada judul penelitian.'";
            } 
            ?>/>
               <?php } ?>
    </td>
    <?php
    $no++;
    $i++;
}
?>         
</tbody>
</table>
<input type="hidden" name="jml_peg" id="jml_peg" value="<?php echo count($this->pb); ?>"


       <div>
    <!--        <div>Keterangan : *Data harus diisi</div>
            <div>
                <input type="submit" name="simpan" value="simpan" class="sukses"/>
                <input type="reset" name="baral" value="batal" class="normal">
            </div>-->
</div>
<!--</fieldset>-->

<script>
    $(":checkbox").change(function(){
        var cks = document.getElementsByName('setuju[]');
        var cek=0;
        for (var j = 0; j < cks.length; j++){
            if (cks[j].checked){
                cek++;
            }
        }
        
        if(cek>0){
            removeError('wtabel_penerima_skripsi');
            removeError('wtotal_biaya');
        }
        $('#total_bayar').val(cek*$('#biaya_skripsi').val());
        
    })
    
    
</script>