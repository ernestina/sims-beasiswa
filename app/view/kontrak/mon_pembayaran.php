<div>
    MONITORING PEMBAYARAN KONTRAK
</div>
<div>
    <div>
        <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/cetakBiayaKontrak' ?>" target="_blank">
        <label>Universitas</label>
        <select name="univ" id="univ">
            <option value="">Semua</option>
            <?php foreach ($this->univ as $univ) { ?>
                <option value="<?php echo $univ->get_kode_in(); ?>"><?php echo $univ->get_nama(); ?></option>
            <?php } ?>
        </select>
        <label>Status pembayaran</label>
        <select id="status" name="status">
            <option value="">semua</option>
            <option value="belum">belum</option>
            <option value="proses">proses</option>
            <option value="selesai">selesai</option>
        </select>

        <div>
            <input type="submit" value="CETAK">
        </div>
        </form>
    </div>

</div>
<div id="tb_biaya">

</div>

<script>
    
    //menampilkan data biaya kontrak ketika halaman direfresh
    $.post("<?php echo URL; ?>kontrak/dataBiayaKontrak", {univ:$('#univ').val(),status:$('#status').val()},
    function(data){                
        $('#tb_biaya').fadeIn(100);
        $('#tb_biaya').html(data);
    });
    
    //menampilkan data biaya kontrak jika user memilih pilihan universitas dan/atau status 
    $(document).ready(function(){ 
        //jika ada event onchange pilihan universitas ambil data dari database
        $("#univ").change(function(){
            $.post("<?php echo URL; ?>kontrak/dataBiayaKontrak", {univ:$('#univ').val(),status:$('#status').val()},
            function(data){                
                $('#tb_biaya').fadeIn(100);
                $('#tb_biaya').html(data);
            });
            
        });
        
        //jika ada event onchange pilihan status ambil data dari database
        $("#status").change(function(){
            $.post("<?php echo URL; ?>kontrak/dataBiayaKontrak", {univ:$('#univ').val(),status:$('#status').val()},
            function(data){                
                $('#tb_biaya').fadeIn(100);
                $('#tb_biaya').html(data);
            });
            
        });
        
    })
    
</script>