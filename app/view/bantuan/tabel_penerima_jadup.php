
<table>
    <thead>
        <tr>
            <th width= '3%'>No</th>
            <th width= '20%'>Nama</th>
            <th width= '10%'>Gol</th>
            <th width= '15%'>Status</th>
            <th width= '5%'>Jumlah Kehadiran (persentase)</th>
<!--            <th width= '10%'>Jumlah Kotor</th>-->
            <th width= '10%'>Pajak (persentase)</th>
<!--            <th width= '10%'>Jumlah Bersih</th>-->
            <th width= '5%'>Bank Penerima</th>
            <th width= '5%'>No. Rekening</th>
            <th width= '5%'></th>
            <th></th>
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
            <td><?php echo $i; ?></td>
            <td><?php echo $value->get_nama(); ?></td>
            <td><?php echo Golongan::golongan_int_string($value->get_gol()); ?></td>
            <td><?php echo StatusPB::status_int_string($value->get_status()); ?></td>
            <td><input class="mini" type="text"  id="<?php echo 'jml_hadir' . $i; ?>" name="<?php echo 'jml_hadir' . $i; ?>" value="0">%</td>
    <!--            <td><input class="mini" type="text" id="<?php echo 'jml_kotor' . $i; ?>" name="jml_kotor" value="0"></td>-->
            <td><input class="mini" type="text" id="<?php echo 'pajak' . $i; ?>" name="<?php echo 'pajak' . $i; ?>" value="<?php if($value->get_gol()>30){ echo '5';} else { echo '0';} ?>">%</td>
    <!--            <td><input class="mini" type="text" id="<?php echo 'jml_bersih' . $i; ?>" name="jml_bersih" value="0"></td>-->
            <td><?php echo $bank->get_nama(); ?></td>
            <td><?php echo $value->get_no_rek(); ?></td>
            <td><input type="hidden" id="<?php echo 'kd_pb' . $i; ?>" name="<?php echo 'kd_pb' . $i; ?>" value="<?php echo $value->get_kd_pb(); ?>"></td>
        <tr>
            <?php
            $i++;
        }
        ?>
        </tbody>
</table>
Keterangan: untuk penulisan desimal gunakan tanda titik (.).
<script>
   
    //    for(var i=1; i<=$('#jml_peg').val(); i++){
    //        $('#jml_hadir'+i).number(true,0);
    //        $('#jml_kotor'+i).number(true,0);
    //        $('#pajak'+i).number(true,0);
    //        $('#jml_bersih'+i).number(true,0);
    //    }
    
    $('.mini').number(true,2);
    
    $(".mini").keyup(function(){
        jumlah_biaya();
    });
    
    $(".mini").focusout(function(){
       
        if($(this).val()==""){
            $(this).val('0');
        }
        jumlah_biaya();
    });
    
    function jumlah_biaya(){
        var jml_kehadiran = 0;
        for(var i=1; i<=$('#jml_peg').val(); i++){
            jml_kehadiran += parseFloat($('#jml_hadir'+i).val());
        }
        $("#total_bayar").val(parseFloat(jml_kehadiran*0.01*$('#biaya_peg').val()));
    }
        
</script>
