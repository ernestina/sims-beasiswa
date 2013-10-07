<h2>Data Pembayaran Tagihan Biaya</h2>
<div id="proses_pembayaran" style="display:none" align="center">
    <p> Sistem sedang melakukan proses update pembayaran tagihan biaya.....</p>
</div>
<form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/updatePembayaran' ?>" enctype="multipart/form-data">
    <input type="hidden" name="update_pembayaran">

    <label class="isian">No. SP2D</label>
    <input type="text" name="no_sp2d" id="no_sp2d" size="30" value="<?php echo $this->biaya->no_sp2d; ?>">
    <label class="isian">Tgl. SP2D</label>
    <input type="text" name="tgl_sp2d" id="tgl_sp2d" size="20" value="<?php
if ($this->biaya->tgl_sp2d != "01-01-1970") {
    echo $this->biaya->tgl_sp2d;
}
?>">
    <label class="isian">File SP2D</label><input type="file" name="file_sp2d" id="file_sp2d">
<!--            <label>Jumlah dibayar</label><input type="text" size="14">-->

    <input type="hidden" id="kd_biaya" name="kd_biaya" value="<?php echo $this->biaya->kd_biaya; ?>">
    <input type="hidden" name="file_sp2d_lama" id="file_sp2d_lama" value="<?php echo $this->biaya->file_sp2d; ?>">
    <input type="submit" class="sukses" value="simpan" onClick="return konfirmasi_pembayaran();">

</form>

<script>
    //****
    // memproses update data pembayaran
    //****
    
    $(document).ready(function(){  //mulai jquery
      
        $(function() { 
            $("#tgl_sp2d").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });

    })
    
    //konfirmasi update tagihan
    function konfirmasi_pembayaran(){
        if(confirm('Simpan perubahan data pembayaran?')){
            $('#proses_pembayaran').show();
            return true;
        } else {return false;}
    }
</script>

