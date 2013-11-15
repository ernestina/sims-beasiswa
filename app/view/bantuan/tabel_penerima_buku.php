<!--table class="table-bordered zebra"-->
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
    <?php
    $no = 0;
    $i = 1;

    foreach ($this->pb as $val4) {
        $bank = $this->bank->get_bank_id($val4->get_bank());
        echo "<tr>";
        echo "<td style=\"text-align: center\">" . $i . "</td>";
        echo "<td>" . $val4->get_nama() . " / " . $val4->get_nip() . "</td>";
        echo "<td>" . Golongan::golongan_int_string($val4->get_gol()) . "</td>";
        echo "<td style=\"text-align: center\">" . StatusPB::status_int_string($val4->get_status()) . "</td>";
        echo "<td>" . $bank->get_nama() . "</td>";
        echo "<td>" . $val4->get_no_rek() . "</td>";
        ?>
    <td style="text-align: center"><input type="checkbox" id="setuju[]" name="setuju[]" value="<?php echo $val4->get_kd_pb(); ?>" 
        <?php
        if ($val4->get_status() == 1) { //mengecek status yang bisa dibisa dibayarkan hanya 1=belum lulus
            if($this->penerima_elemen->cek_buku_by_pb($val4->get_kd_pb(), $this->semester, $this->thn)==TRUE){ //mengecek apakah ob pernah dibauarkan pada semester dan tahun tertentu
                echo " disabled title='Sedang proses/selesai dibayar.'";
            } else {
                echo " checked";
            }
        }else {
            echo " onclick='return false' title='Tidak berhak dibayar.'";
        }
        ?>/></td>
        <?php
        $no++;
        $i++;
    }
    ?>         
</tbody>
</table>
<!--<input type="text" name="jml_peg" id="jml_peg" value="<?php echo $this->thn; ?>"-->


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
            removeError('wtabel_penerima_buku');
            removeError('wtotal_biaya');
            $('#total_bayar').val(cek*$('#biaya_buku').val());
        }
        
    })
    
    $("#biaya_buku").keyup(function(){
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
            $('#total_bayar').val(cek*$('#biaya_buku').val());
        }
        
    })
    
</script>