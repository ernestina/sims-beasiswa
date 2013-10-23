<?php 
    /*
     * isinya input pencarian
     * tabel mahasiswa dengan button add
     */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Rekam penerima beasiswa</title>
        <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
        <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
    </head>
    <body style="max-width: 370px;max-height: 500px; text-align: center; overflow:no-content;">
<div id="dialog_pb" style="text-align: left;">
        <table>        
            <tr><td><label>Cari : </label></td><td><input type="text" id="cari_pb" name="nama" onkeyup="cari(this.value);" placeholder="Nama penerima beasiswa"></td></tr>
        </table>
</div>
<div id="tb_pb">
    <?php 
        $this->load('riwayat_tb/tabel_pb_sc');
    ?>
</div>
    </body>
<script>
    $(function(){
        $('#cari_pb').focus();
    });
    
    function cari(nama){
//        $.post("<?php echo URL; ?>penerima/get_nama_peg", {param:""+nip+""},
//        function(data){
//            $('#t_nm').val(data);
//        });
        $.ajax({
           type:"post",
           url: "<?php echo URL; ?>penerima/get_tabel_peg",
           data:"param="+nama,
           success:function(data){
               $('#tb_pb').fadeIn(200);
               $('#tb_pb').html(data);
           }
        });
    }
    
    function goSelect(kd_pb){
        
        window.opener.callFromDialog(kd_pb);
        window.close();
    }
    
</script>