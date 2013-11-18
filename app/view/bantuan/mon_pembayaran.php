<div id="top">
    <h2>MONITORING PEMBAYARAN KEUANGAN</h2>

    <div id="dropdown-menu">
        <form method="POST" action="<?php echo URL . 'elemenBeasiswa/cetak_mon_pembayaran'; ?>" onsubmit="window.open('','cetak_mon','toolbar=no, location=no, addressbar=no, directories=no, status=no, menubar=no, width=1000,height=500,scrollbars=yes');" target="cetak_mon">
            <table width="100%">
                <tr>
                    <td>
                        <label>Universitas</label>
                        <select name="universitas" id="universitas" type="text">
                            <option value="">- semua -</option>>
                            <?php
                            //var_dump($this->univ);
                            foreach ($this->univ as $val) {
                                echo "<option value=" . $val->get_kode_in() . " >" . $val->get_nama() . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <label>Jurusan/Prodi</label>
                        <select name="jurusan" id="jurusan" type="text">
                            <option value="">- semua -</option>

                        </select>
                    </td>
                    <td>
                        <label>Tahun Masuk</label>
                        <select name="tahun_masuk" id="tahun_masuk" type="text">
                            <option value="">- semua -</option>
                        </select>

                    </td>
                    <td>
                        <label>Elemen</label>
                        <select name="elemen" id="elemen" type="text">
                            <option value="">- semua -</option>
                            <option value="1">Tunjangan Hidup</option>
                            <option value="2">Buku</option>
                            <option value="3">TA/Skripsi/Tesis</option>


                        </select>

                    </td>
                </tr><tr>
                    <td colspan="4">
                        <div style="margin-right: 20px">
                            <!--input class="sukses" type="submit" name="cetak" value="CETAK" style="margin-right: 10px"-->
                            <button onClick="formSubmit" style="margin-right:20px"><i class="icon-print icon-white"></i>  CETAK</button>
                        </div>
                    </td>
                </tr>
            </table>

        </form>
    </div>
	<form>
    <div id="tabel_index_mon">    
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
    
    displayMonElemen();
    function displayMonElemen(){   
        $.post("<?php echo URL; ?>elemenBeasiswa/data_index_mon", {univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val(),elemen:$('#elemen').val()}, 
        function (data){
            //$('#tabel_index_mon').fadeIn(100);
            $('#tabel_index_mon').html(data);
        })
    }
    
    $(document).ready(function(){ 
    
        //agar ketika universitas berubah karena dipilih, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $("#universitas").change(function(){
            $.post("<?php echo URL; ?>elemenBeasiswa/get_jur_by_univ", {univ:$("#universitas").val()},
            function(data){                
                $('#jurusan').html(data);
            }); 
        
            displayMonElemen();
        });
        
        $('#jurusan').change(function(){
            //alert ($('#kode_jur').val());
            displayMonElemen();
            
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>elemenBeasiswa/get_thn_masuk_by_jur",
                data: {kd_jurusan:$('#jurusan').val()},
                success: function(thn_masuk){
                    $('#tahun_masuk').html(thn_masuk);
                }
            });
            
        })
        
        //agar ketika universitas berubah karena dipilih, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $("#tahun_masuk, #elemen").change(function(){           
            displayMonElemen();
        });
		
		$("#next").click(function(){
            $("#loading").show();
			var page = parseInt($("#cur_page").val())+ 1;
			$.post("<?php echo URL; ?>elemenBeasiswa/data_index_mon", {univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val(),elemen:$('#elemen').val(),cur_page:page}, 
			function(data){                
				$('#tabel_index_mon').html(data);
			});
			$("#loading").hide();
            
        });
		
		$("#prev").click(function(){
            $("#loading").show();
			var page = parseInt($("#cur_page").val())- 1;
			$.post("<?php echo URL; ?>elemenBeasiswa/data_index_mon", {univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val(),elemen:$('#elemen').val(),cur_page:page}, 
			function(data){                
				$('#tabel_index_mon').html(data);
			});
			$("#loading").hide();
            
        });
		
		$("#first").click(function(){
            $("#loading").show();
			var page = 1;
			$.post("<?php echo URL; ?>elemenBeasiswa/data_index_mon", {univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val(),elemen:$('#elemen').val(),cur_page:page}, 
			function(data){                
				$('#tabel_index_mon').html(data);
			});
			$("#loading").hide();
            
        });
		$("#last").click(function(){
            $("#loading").show();
			var page = parseInt($("#last_page").val())
			$.post("<?php echo URL; ?>elemenBeasiswa/data_index_mon", {univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val(),elemen:$('#elemen').val(),cur_page:page}, 
			function(data){                
				$('#tabel_index_mon').html(data);
			});
			$("#loading").hide();
            
        });
        
        
    })
    
    
   
</script>