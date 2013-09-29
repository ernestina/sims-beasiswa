<div id="top">
    <h2>DATA KONTRAK KERJASAMA</h2>
	
	<table width=100% style="margin-left: 0px">
				<tr>
					<td width="95px" ><label >Pilih Universitas :</label></td>
					<td style="padding-top:15px;">
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
					
					</td>
				
				<td><input type="button" value="TAMBAH" onClick="location.href='<?php echo URL . 'kontrak/rekamKontrak'; ?>'"style="margin-top:0px; margin-right: -8px"><!--View file SKL-->
				</form>
				</td>
				</tr>
			</table>

     
        
    

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