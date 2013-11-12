<div id="top">
    <h2>MONITORING PEMBAYARAN KONTRAK</h2>

        <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/cetakBiayaKontrak' ?>" onSubmit="cetak_dokumen('cetak_mon');" target="cetak_mon">
		<ul class="inline">
            <li><label>Universitas</label></li>
            <li><select name="univ" id="univ" type="text">
                <option value="">- semua -</option>
                <?php foreach ($this->univ as $univ) { ?>
                    <option value="<?php echo $univ->get_kode_in(); ?>"><?php echo $univ->get_nama(); ?></option>
                <?php } ?>
            </select></li> &nbsp &nbsp 
            <li><label>Status pembayaran</label></li>
            <li><select id="status" name="status" type="text">
                <option value="">- semua -</option>
                <option value="belum">belum</option>
                <option value="proses">proses</option>
                <option value="selesai">selesai</option>
            </select></li> &nbsp &nbsp
            <li><label>Jadwal Pembayaran</label></li>
            <li><select id="jadwal" name="jadwal" type="text">
                <option value="">- semua -</option>
                <?php
                for ($i = 2007; $i <= date('Y') + 1; $i++) {
                                        ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select></li>
		</ul>
            <table width="97%">
                <tr><td><input class="sukses" type="submit" value="CETAK"></td></tr>
            </table>
        </form>
    
<form>
<div id="tb_biaya">
</div>
<table width=99% style="margin-left: 0px">
<td width="100%">
<span class=prevnext><input type=button id="last" class=btn value='>|' ></span>
<span class=prevnext><input type=button id="next" class=btn value='>' ></span>
<span class=prevnext><input type=button id="prev" class=btn value='<' ></span>
<span class=prevnext><input type=button id="first" class=btn value='|<' ></span>
</td>
</table>
</form>
</div>
<script>
    
    //menampilkan data biaya kontrak ketika halaman direfresh
    $.post("<?php echo URL; ?>kontrak/dataBiayaKontrak", {univ:$('#univ').val(),status:$('#status').val(),jadwal:$('#jadwal').val()},
    function(data){                
        $('#tb_biaya').fadeIn(100);
        $('#tb_biaya').html(data);
    });
    
    //menampilkan data biaya kontrak jika user memilih pilihan universitas dan/atau status 
    $(document).ready(function(){ 
        //jika ada event onchange pilihan universitas, status dan jadwal ambil data dari database
        $("#univ, #status, #jadwal").change(function(){
            $.post("<?php echo URL; ?>kontrak/dataBiayaKontrak", {univ:$('#univ').val(),status:$('#status').val(),jadwal:$('#jadwal').val()},
            function(data){                
                $('#tb_biaya').fadeIn(100);
                $('#tb_biaya').html(data);
            });
            
        });
		
		$("#next").click(function(){
            var page = parseInt($("#cur_page").val())+ 1;
			$.post("<?php echo URL; ?>kontrak/dataBiayaKontrak", {univ:$('#univ').val(),status:$('#status').val(),jadwal:$('#jadwal').val(), cur_page:page},
            function(data){                
                $('#tb_biaya').fadeIn(100);
                $('#tb_biaya').html(data);
            });
            
        });
		
		$("#prev").click(function(){
			var page = parseInt($("#cur_page").val())- 1;
			$.post("<?php echo URL; ?>kontrak/dataBiayaKontrak", {univ:$('#univ').val(),status:$('#status').val(),jadwal:$('#jadwal').val(), cur_page:page},
            function(data){                
                $('#tb_biaya').fadeIn(100);
                $('#tb_biaya').html(data);
            });
            
        });
		
		$("#first").click(function(){
			var page = 1;
			$.post("<?php echo URL; ?>kontrak/dataBiayaKontrak", {univ:$('#univ').val(),status:$('#status').val(),jadwal:$('#jadwal').val(), cur_page:page},
            function(data){                
                $('#tb_biaya').fadeIn(100);
                $('#tb_biaya').html(data);
            });
            
        });
		$("#last").click(function(){
			var page = parseInt($("#last_page").val())
			$.post("<?php echo URL; ?>kontrak/dataBiayaKontrak", {univ:$('#univ').val(),status:$('#status').val(),jadwal:$('#jadwal').val(), cur_page:page},
            function(data){                
                $('#tb_biaya').fadeIn(100);
                $('#tb_biaya').html(data);
            });
            
        });
                
    })
    
</script>