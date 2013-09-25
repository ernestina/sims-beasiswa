<div>
    DATA KONTRAK KERJASAMA
</div>
<div>
    <div>
        <label>Universitas</label>
        <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/display' ?>">
<!--            <input type="hidden" name="pilih_univ">-->
            <select name="universitas" id="univ">
                <option value="0">Semua</option>
                <?php
                foreach ($this->univ as $univ) {
                    if ($this->pil == $univ->get_kode_in()) {
                        $select = "selected";
                    } else {
                        $select = "";
                    }
                    ?>
                    <option value="<?php echo $univ->get_kode_in(); ?>" <?php echo $select; ?>><?php echo $univ->get_nama(); ?></option>
                <?php } ?>
            </select>
<!--            <input type="button" value="SUBMIT">-->
    </div>
    <div><input type="button" value="TAMBAH" onClick="location.href='<?php echo URL . 'kontrak/rekamKontrak'; ?>'"></div>
</form>
</div>
<div id="tb_kontrak">
   
</div>

<script>
     if($("#univ").val() == "0"){
            univ = "0";
            $.post("<?php echo URL; ?>kontrak/get_data_kontrak", {univ:""+univ},
            function(data){                
                $('#tb_kontrak').fadeIn(100);
                $('#tb_kontrak').html(data);
            });
        } else {
            $.post("<?php echo URL; ?>kontrak/get_data_kontrak", {univ:""+$("#univ").val()},
            function(data){                
                $('#tb_kontrak').fadeIn(100);
                $('#tb_kontrak').html(data);
            });
        }
        
    $(document).ready(function(){ 
        //jika ada event onchange ambil data dari database
        $("#univ").change(function(){
            //ambil nilai univ dan url dari form
            univ = $("#univ").val();
            //url = $("#url").val();
            $.post("<?php echo URL; ?>kontrak/get_data_kontrak", {univ:""+univ},
            function(data){                
                $('#tb_kontrak').fadeIn(100);
                $('#tb_kontrak').html(data);
            });
            
        });
        
    })
    
</script>