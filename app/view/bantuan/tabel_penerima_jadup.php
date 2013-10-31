
<table class="table-bordered zebra">
    <thead>
        <tr>
            <th width= '3%'>No</th>
            <th width= '20%'>Nama</th>
            <th width= '15%'>Gol</th>
            <th width= '10%'>Status</th>
            <th style="display:none;">Jumlah Kehadiran (persentase)</th>
<!--            <th width= '10%'>Jumlah Kotor</th>-->
            <th width= '10%'>Pajak (persentase)</th>
<!--            <th width= '10%'>Jumlah Bersih</th>-->
            <th width= '15%'>Bank Penerima</th>
            <th width= '5%'>No. Rekening</th>
            <th width= '5%'>Pilih</th>
            
        </tr>
    </thead>
    <tbody>
    <input type="hidden" id="jml_peg" name="jml_peg" value="<?php echo count($this->pb); ?>">
    <?php
    $i = 1;

    foreach ($this->pb as $value) {
        $bank = $this->bank->get_bank_id($value->get_bank());
        ?>
        <tr>
            <td style="text-align: center"><?php echo $i; ?></td>
            <td><?php echo $value->get_nama() . "<br/>NIP." . $value->get_nip(); ?></td>
            <td><?php echo Golongan::golongan_int_string($value->get_gol()); ?></td>
            <td style="text-align: center"><?php echo StatusPB::status_int_string($value->get_status()); ?></td>
            <td style="display:none;"><input class="mini" type="hidden"  id="<?php echo 'jml_hadir' . $i; ?>" name="<?php echo 'jml_hadir' . $i; ?>" value="100">%</td>
    <!--            <td><input class="mini" type="text" id="<?php echo 'jml_kotor' . $i; ?>" name="jml_kotor" value="0"></td>-->
            <td><input class="mini" type="text" id="<?php echo 'pajak' . $i; ?>" name="<?php echo 'pajak' . $i; ?>" value="<?php
    if ($value->get_gol() > 30) {
        echo '5';
    } else {
        echo '0';
    }
        ?>" style="margin-left: 20px; text-align: right"></td>
    <!--            <td><input class="mini" type="text" id="<?php echo 'jml_bersih' . $i; ?>" name="jml_bersih" value="0"></td>-->
            <td><?php echo $bank->get_nama(); ?></td>
            <td><?php echo $value->get_no_rek(); ?></td>
            <td>
                <input type="checkbox" id="<?php echo 'setuju' . $i; ?>" name="<?php echo 'setuju' . $i; ?>" 
                       value="<?php echo $value->get_kd_pb(); ?>" 
                       <?php
                       if ($value->get_status() == 1) { //mengecek status yang bisa dibisa dibayarkan hanya 1=belum lulus
                           if ($this->penerima_elemen->cek_jadup_by_pb($value->get_kd_pb(), $this->bln, $this->thn) == TRUE) { //mengecek apakah ob pernah dibauarkan pada semester dan tahun tertentu
                               echo " onclick='return false' title='Sedang proses/selesai dibayar.'";
                           } else {
                               echo " checked";
                           }
                       } else {
                           echo " onclick='return false' title='Tidak berhak dibayar.'";
                       }
                       ?>
                       />

            </td>
        </tr>
            <?php
            $i++;
        }
        ?>
        </tbody>
</table>
<p style="margin-left: 20px">Keterangan: untuk penulisan desimal gunakan tanda titik (.).</p>
<script>
   
    //    for(var i=1; i<=$('#jml_peg').val(); i++){
    //        $('#jml_hadir'+i).number(true,0);
    //        $('#jml_kotor'+i).number(true,0);
    //        $('#pajak'+i).number(true,0);
    //        $('#jml_bersih'+i).number(true,0);
    //    }
    ceklist();
    $('.mini').number(true,2);
    
    $(".mini").keyup(function(){
        ceklist();
    });
    
    $(".mini").focusout(function(){
       
        if($(this).val()==""){
            $(this).val('0');
        }
        ceklist();
    });
    
    $("#biaya_peg").keyup(function(){
        ceklist();
    });
        
    function ceklist(){
        var jml = $('#jml_peg').val();
        //alert(jml);
        var cek=0;
        var total_biaya=0;
        for (var j=1; j <jml+1; j++){
            //alert('ok')
            if ($('#setuju'+j).is(':checked')){
                cek++;         
                total_biaya = total_biaya + ($('#jml_hadir'+j).val()*0.01*$('#biaya_peg').val());
            }      
        }
        $("#total_bayar").val(total_biaya);
        
        
        if(cek>0){
            removeError('wtabel_penerima_jadup');
            removeError('wtotal_biaya');
            
        }
    }
    
        
    $(":checkbox").change(function(){
        ceklist();
    })
        
</script>
