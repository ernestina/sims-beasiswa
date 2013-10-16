<div id="top">
    <h2>MONITORING PEMBAYARAN KONTRAK</h2>

    
        <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/cetakBiayaKontrak' ?>" target="_blank">
		<ul class="inline">
            <li><label>Universitas</label></li>
            <li><select name="univ" id="univ" type="text">
                <option value="">Semua</option>
                <?php foreach ($this->univ as $univ) { ?>
                    <option value="<?php echo $univ->get_kode_in(); ?>"><?php echo $univ->get_nama(); ?></option>
                <?php } ?>
            </select></li> &nbsp &nbsp 
            <li><label>Status pembayaran</label></li>
            <li><select id="status" name="status" type="text">
                <option value="">Semua</option>
                <option value="belum">belum</option>
                <option value="proses">proses</option>
                <option value="selesai">selesai</option>
            </select></li>
            <li><label>Jadwal Pembayaran</label></li>
            <li><select id="jadwal" name="jadwal" type="text">
                <option value="">Semua</option>
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
    

<div id="tb_biaya">

</div>
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
        //jika ada event onchange pilihan universitas ambil data dari database
        $("#univ").change(function(){
            $.post("<?php echo URL; ?>kontrak/dataBiayaKontrak", {univ:$('#univ').val(),status:$('#status').val(),jadwal:$('#jadwal').val()},
            function(data){                
                $('#tb_biaya').fadeIn(100);
                $('#tb_biaya').html(data);
            });
            
        });
        
        //jika ada event onchange pilihan status ambil data dari database
        $("#status").change(function(){
            $.post("<?php echo URL; ?>kontrak/dataBiayaKontrak", {univ:$('#univ').val(),status:$('#status').val(),jadwal:$('#jadwal').val()},
            function(data){                
                $('#tb_biaya').fadeIn(100);
                $('#tb_biaya').html(data);
            });
            
        });
        
        //jika ada event onchange pilihan tahun ambil data dari database
        $("#jadwal").change(function(){
            $.post("<?php echo URL; ?>kontrak/dataBiayaKontrak", {univ:$('#univ').val(),status:$('#status').val(),jadwal:$('#jadwal').val()},
            function(data){                
                $('#tb_biaya').fadeIn(100);
                $('#tb_biaya').html(data);
            });
            
        });
        
    })
    
</script>