<div id="top">
    <h2>DAFTAR BIAYA BUKU</h2>

        <div id="dropdown-menu">

            <table width="97%">
                <tr>
                    <td>
                        <label>Universitas</label>
                        <select name="universitas" id="universitas" style="width:auto;">
                            <option value="">- semua -</option>>
                            <?php
                            foreach ($this->univ as $val) {
                                echo "<option value=" . $val->get_kode_in() . " >" . $val->get_nama() . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <label>Jurusan/Prodi</label>
                        <select name="jurusan" id="jurusan" type="text">
                            <option value="">- semua -</option>>

                        </select>
                    </td>
                    <td>
                        <label>Tahun Masuk</label>
                        <select name="tahun_masuk" id="tahun_masuk" type="text">
                            <option value="">- semua -</option>>
                            
                        </select>
                    </td>
                    <td style="float: right"><input type="hidden" name="cari" id="cari" placeholder="Cari dengan kata kunci nomor SP2D..." size="30" title="Cari"></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top: 0px">
                        <!--input type="button" id="add" value="TAMBAH" onClick="location.href='<?php echo URL . 'elemenBeasiswa/addUangBuku' ?>'"-->
                        <?php 
						if(Session::get('role')==2){ ?>
						<button type="button" id="add" onClick="location.href='<?php echo URL . "elemenBeasiswa/addUangBuku"; ?>'" ><i class="icon-plus icon-white"></i>  TAMBAH</button>
						<?php } ?>
                    </td>
                </tr>
            </table>

            <div>

            </div>
        </div>
	<form>
    <div id="tabel_index_buku">
    </div>
	<table width=99% style="margin-left: 0px">
	<td width="100%">
	<input type="button" id="last" class="paging-kecil" value='>>' title="Halaman Terakhir">
	<input type="button" id="next" class="paging-kecil" value='>' title="Halaman Berikutnya">
	<input type="button" id="prev" class="paging-kecil" value='<' title="Halaman Sebelumnya">
	<input type="button" id="first" class="paging-kecil" value='<<' title="Halaman Pertama">
	</td>
	</table>
	</form>
</div>
<script type="text/javascript">
    
    displayElemenBuku();
    function displayElemenBuku(){
        $.post("<?php echo URL; ?>elemenBeasiswa/data_index_buku", { univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val()}, 
        function (data){
            $('#tabel_index_buku').html(data);
        }); 
        
        $('#cari').val('');
    }
    
    $(document).ready(function(){ 
    
        //agar ketika universitas berubah karena dipilih, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $("#universitas").change(function(){
            $.post("<?php echo URL; ?>elemenBeasiswa/get_jur_by_univ", {univ:$("#universitas").val()},
            function(data){                
                $('#jurusan').html(data);
            }); 
        
            displayElemenBuku();
        });
        
         $('#jurusan').change(function(){
            //alert ($('#kode_jur').val());
            displayElemenBuku();
            
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>elemenBeasiswa/get_thn_masuk_by_jur",
                data: {kd_jurusan:$('#jurusan').val()},
                success: function(thn_masuk){
                    $('#tahun_masuk').html(thn_masuk);
                }
            }); 
        })
        
        $("#tahun_masuk").change(function(){             
            displayElemenBuku();
        });
		$("#next").click(function(){
            $("#loading").show();
			var page = parseInt($("#cur_page").val())+ 1;
			$.post("<?php echo URL; ?>elemenBeasiswa/data_index_buku", {univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val(),cur_page:page}, 
			function(data){                
				$('#tabel_index_buku').html(data);
			});
			$("#loading").hide();
            
        });
		
		$("#prev").click(function(){
            $("#loading").show();
			var page = parseInt($("#cur_page").val())- 1;
			$.post("<?php echo URL; ?>elemenBeasiswa/data_index_buku", {univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val(),cur_page:page},
			function(data){                
				$('#tabel_index_buku').html(data);
			});
			$("#loading").hide();
            
        });
		
		$("#first").click(function(){
            $("#loading").show();
			var page = 1;
			$.post("<?php echo URL; ?>elemenBeasiswa/data_index_buku", {univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val(),cur_page:page},
			function(data){                
				$('#tabel_index_buku').html(data);
			});
			$("#loading").hide();
            
        });
		$("#last").click(function(){
            $("#loading").show();
			var page = parseInt($("#last_page").val())
			$.post("<?php echo URL; ?>elemenBeasiswa/data_index_buku", {univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val(),cur_page:page},
			function(data){                
				$('#tabel_index_buku').html(data);
			});
			$("#loading").hide();
            
        });
        
        $("#cari").keyup(function(){
                           
            if($("#cari").val()==""){
                displayElemenBuku();
            } else {
                $.post("<?php echo URL; ?>elemenBeasiswa/data_index_buku2", { sp2d:$('#cari').val()}, 
                function (data){
                    $('#tabel_index_buku').html(data);
                });
                $("#jurusan, #tahun_masuk, #universitas").val('');
            }
        });
        
       
    })
</script>



