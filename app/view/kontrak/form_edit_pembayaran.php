<!--h1>Data Pembayaran Tagihan Biaya</h1-->
<div id="proses_pembayaran" style="display:none" align="left">
    <p> Sistem sedang melakukan proses update pembayaran tagihan biaya.....</p>
</div>
<form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/updatePembayaran' ?>" enctype="multipart/form-data">
    <input type="hidden" name="update_pembayaran">

    <label class="isian">No. SP2D</label>
    <input type="text" name="no_sp2d" id="no_sp2d" size="30" value="<?php echo $this->biaya->no_sp2d; ?>">
    <div id="wno_sp2d"></div>
    <label class="isian">Tgl. SP2D</label>
    <input type="text" name="tgl_sp2d" id="tgl_sp2d" size="20" 
           value="<?php if ($this->biaya->tgl_sp2d != "01-01-1970" && $this->biaya->tgl_sp2d != "00-00-0000") {
    echo $this->biaya->tgl_sp2d;
}
?>" readonly>
    <div id="wtgl_sp2d"></div>
    <label class="isian">File sp2d</label>
    <?php
    $file_sp2d = $this->biaya->file_sp2d;
    if ($file_sp2d != "") {
        $file_sp2d_ = $file_sp2d;
    } else {
        $file_sp2d_ = "";
    }
    ?>
    <ul class="inline">
        <li><input type="file" name="file_sp2d" id="file_sp2d"></li>
        <li><a href="<?php echo URL . "kontrak/fileSp2d/" . $file_sp2d_; ?>"target="file_sp2d" onClick="cetak_dokumen('file_sp2d');"><?php if($file_sp2d_ !="") echo "lihat file"; ?></a></li>
    </ul>
<!--            <label>Jumlah dibayar</label><input type="text" size="14">-->

    <input type="hidden" id="kd_biaya" name="kd_biaya" value="<?php echo $this->biaya->kd_biaya; ?>">
    <input type="hidden" name="file_sp2d_lama" id="file_sp2d_lama" value="<?php echo $this->biaya->file_sp2d; ?>">
    <input type="submit" class="sukses" value="SIMPAN" onClick="return konfirmasi_pembayaran();">

</form>

<script>
    //****
    // memproses update data pembayaran
    //****
    
    $('#no_sp2d').keyup(function() {   
        removeError('wno_sp2d');         
    });  
    
    $('#tgl_sp2d').click(function() {   
        removeError('wtgl_sp2d');         
    });
    
    $('#file_sp2d').click(function() {   
        removeError('wfile_sp2d');         
    });
    
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
        if(confirm('Simpan data pembayaran?')){
            if(cekFieldPembayaran()!=false){
                $('#proses_pembayaran').show();
                return true;
            } else {
                return false;
            }
        } else {return false;}
    }
    
    function cekFieldPembayaran(){
        var jml = 0;
        if($('#no_sp2d').val()==''){
            viewError('wno_sp2d','Nomor SP2D harus diisi harus diisi.');
            jml++;
        }
            
        if($('#tgl_sp2d').val()==''){
            viewError('wtgl_sp2d','Tanggal SP2D harus diisi.');
            jml++;
        }
            
        if($('#file_sp2d').val()==''){
            if($('#file_sp2d_lama').val()==''){
                viewError('wfile_sp2d','File SP2D harus diisi.');
                jml++;
            }
        }
        
        if(jml>0){
            return false;
        } else {
            return true;
        }
    }
</script>

