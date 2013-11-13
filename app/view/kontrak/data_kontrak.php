<div id="top">
    <h2>DATA KONTRAK KERJASAMA</h2>

	<div>
	
    <table width=98% style="margin-left: 0px">
        <tr>
			<td width="1%"></td>
            <td width="11%" ><label >Pilih Universitas :</label>
                       <select name="universitas" id="kd_univ" type="text">
                        <option value="">- semua -</option>
                        <?php
                        foreach ($this->kd_univ as $univ) {
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
            <td width="20%" style="float: left"><input type="search" name="cari" id="cari" placeholder="cari" title="Cari dengan kata kunci nomor kontrak"></td>

            <td width="45%">
<!--                <input type="button" value="TAMBAH" onClick="location.href='<?php echo URL . 'kontrak/rekamKontrak'; ?>'"style="margin-top:0px; margin-right: -8px">-->
                <button type="button" id="tambah_kontrak" style="margin-top:0px; margin-right: -8px" title="Rekam kontrak baru"><i class="icon-plus icon-white"></i> Tambah</button>
                
            </td>
        </tr>
    </table>

	</div>

<form>
<div id="tb_kontrak" >
</div>
<table width=99% style="margin-left: 0px">
<td width="100%">
<input type=button id="last" class="paging-kecil" value='>>' title="Halaman Terakhir">
<input type=button id="next" class="paging-kecil" value='>' title="Halaman Berikutnya">
<input type=button id="prev" class="paging-kecil" value='<' title="Halaman Sebelumnya">
<input type=button id="first" class="paging-kecil" value='<<' title="Halaman Pertama">
</td>
</table>
</form>
<div class="fitur">
    <br/>
    <p style="margin-left: 30px">
        Keterangan:
        * Nilai kontrak dengan nilai total biaya kontrak tidak sama.
    </p>
</div>
<div id="loading" class="loading" style="display: none"><img src="<?php echo URL . 'public/icon/loading.gif'; ?>" /></div>
<div>
    <div id="dialog_rekam_kontrak" title ="Rekam Kontrak Kerja Sama"></div>

    <div id="dialog_edit_kontrak" title="Ubah Data Kontrak Kerja Sama" > </div>
</div>

</div>
<script>
    
    //menjalankan fungsi displayKontrak() ketika halaman diload.
    displayKontrak();
    
    //fungsi untuk menampilkan data kontrak
    function displayKontrak(){
        $("#loading").show();
        $.post("<?php echo URL; ?>kontrak/get_data_kontrak", {univ:$("#kd_univ").val()},
        function(data){                
            $('#tb_kontrak').fadeIn(100);
            $('#tb_kontrak').html(data);
        });
        $("#loading").hide();
		$('#prev,#next,#first,#last').attr("disabled", false);
    }
	
	    
    //ketika link edit diklik pada halaman tabel_kontrak.php
    function edit(id){
        $("#dialog_rekam_kontrak, #dialog_edit_kontrak").empty();
        $("#dialog_edit_kontrak").load("<?php echo URL; ?>kontrak/viewEditKontrak/"+id);
        $("#dialog_edit_kontrak").dialog( "open" );
       
    }
    
    $(document).ready(function(){ 
        //jika ada event onchange ambil data dari database
        $("#kd_univ").change(function(){
            displayKontrak();
            $("#cari").val('');
            
        });
		
		$("#next").click(function(){
            $("#loading").show();
			var page = parseInt($("#cur_page").val())+ 1;
			$.post("<?php echo URL; ?>kontrak/get_data_kontrak", {univ:$("#kd_univ").val(), cur_page:page},
			function(data){                
            $('#tb_kontrak').fadeIn(100);
            $('#tb_kontrak').html(data);
			});
			$("#loading").hide();
            
        });
		
		$("#prev").click(function(){
            $("#loading").show();
			var page = parseInt($("#cur_page").val())- 1;
			$.post("<?php echo URL; ?>kontrak/get_data_kontrak", {univ:$("#kd_univ").val(), cur_page:page},
			function(data){                
            $('#tb_kontrak').fadeIn(100);
            $('#tb_kontrak').html(data);
			});
			$("#loading").hide();
            
        });
		
		$("#first").click(function(){
            $("#loading").show();
			var page = 1;
			$.post("<?php echo URL; ?>kontrak/get_data_kontrak", {univ:$("#kd_univ").val(), cur_page:page},
			function(data){                
            $('#tb_kontrak').fadeIn(100);
            $('#tb_kontrak').html(data);
			});
			$("#loading").hide();
            
        });
		$("#last").click(function(){
            $("#loading").show();
			var page = parseInt($("#last_page").val())
			$.post("<?php echo URL; ?>kontrak/get_data_kontrak", {univ:$("#kd_univ").val(), cur_page:page},
			function(data){                
            $('#tb_kontrak').fadeIn(100);
            $('#tb_kontrak').html(data);
			});
			$("#loading").hide();
            
        });
		        
        //trigger ketika tombol tambah diklik akan menampilkan modal form rekam
        $("#tambah_kontrak").click(function() {
            $("#dialog_rekam_kontrak, #dialog_edit_kontrak").empty();
            $("#dialog_rekam_kontrak").load("<?php echo URL; ?>kontrak/viewRekamKontrak");
            $("#dialog_rekam_kontrak").dialog( "open" );
        });
        
        
        //modal form rekam
        $("#dialog_rekam_kontrak").dialog({
            autoOpen: false,
            height: 550,
            width: 800,
            modal: true,
            show: "fade",
            hide: "clip",
            //bgiframe: true,
            position: 'top',
            draggable: false,
            buttons: {
                Simpan: function() {
                    //fungsi cek rekam untuk validasi form rekam_kontrak pada rekam_kontrak_dialog.php
                    if(cekRekam()!=false){
                        $("#loading").show();
                        var formData = new FormData($('#form_rekam_kontrak2')[0]);
                        //alert(formData);
                        $.ajax({
                            url: '<?php echo URL; ?>kontrak/rekamKontrak2',
                            type: 'POST',
                            data: formData,
                            cache: false,
                            //dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function () {
                                $('#form_rekam_kontrak2')[0].reset();
                                displayKontrak();
                                $("#loading").hide(); 
                                alert('Data berhasil disimpan');
                                
 
                            }                       
                        });
                        $(this ).dialog("close"); 
                    }
                         
                },
                Batal: function() {
                    $( this ).dialog( "close" );
                    
                }
            }
        });
                 
           
        //modal form edit
        $("#dialog_edit_kontrak").dialog({
            autoOpen: false,
            height: 550,
            width: 800,
            modal: true,
            show: "fade",
            hide: "clip",
            cache:false,
            //bgiframe: true,
            position: 'top', 
            draggable: false,
            buttons: {
                "Simpan": function() {
                    //fungsi cek update untuk validasi form edit_kontrak pada edit_kontrak_dialog.php
                    if(cekEdit()!=false){
                        $("#loading").show();
                        var formData = new FormData($('#form_edit_kontrak2')[0]);
                        //alert(formData);
                        $.ajax({
                            url: '<?php echo URL; ?>kontrak/updateKontrak2',
                            type: 'POST',
                            data: formData,
                            cache: false,
                            //dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function () {
                                displayKontrak();
                                $("#loading").hide();
                                alert('Perubahan data berhasil disimpan');   
                            },
                            error: function(jq,status,message) {
                                alert('Jquery error. Status: ' + status + ' - Message: ' + message);
                            }
                        });
                        //$( this ).dialog( "close" );
                    }
                },
                Batal: function() {
                    $( this ).dialog( "close" );
                    $("#dialog_edit_kontrak").empty();
                }
            }
        });
        
        
        $("#cari").keyup(function(){
                             
            if($("#cari").val()==""){
                displayKontrak();
				$('#prev,#next,#first,#last').attr("disabled", false);
            } else {
                $.post("<?php echo URL; ?>kontrak/get_data_kontrak2", {key:$('#cari').val()}, 
                function(data){
                    $('#tb_kontrak').fadeIn(100);
                    $('#tb_kontrak').html(data);
                });
                $("#kd_univ").val('');
				$('#prev,#next,#first,#last').attr("disabled", true);
            }
        });
        
    })
    
    

    
</script>