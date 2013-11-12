<div id="top"> 
    <h2><a href="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'elemenBeasiswa/viewJadup' ?>">BIAYA TUNJANGAN HIDUP</a> > UBAH</h2> <!-- memakai breadcrumb -->
<form method="POST" action="<?php echo URL; ?>elemenBeasiswa/updateJadup" onSubmit="return cekField();" enctype="multipart/form-data">
    <div>
        <fieldset><legend>Parameter Ubah Tunjangan Hidup</legend>

            
                <div class="kolom1">
                    <noscript>
                    <input name="js" type="hidden" value="1">
                    </noscript>
                    <input type="hidden" name="ubah_jadup"/> 
                    <input type="hidden" name="r_elem" value="1"/>       


                    <label class="isian">Universitas : </label>
                    <input type="hidden" id="kode_univ" name="kode_univ" value="<?php echo $this->univ->get_kode_in(); ?>">
                    <input type="text" value="<?php echo $this->univ->get_nama(); ?>" disabled>

                    <label class="isian">Jurusan/Prodi : </label>
                    <input type="hidden" id="kode_jur" name="kode_jur" value="<?php echo $this->jur->get_kode_jur(); ?>">
                    <input type="text" value="<?php echo $this->jur->get_nama(); ?>" disabled>

                    <label class="isian">Tahun Masuk : </label>
                    <input type="hidden" name="tahun_masuk" id="tahun_masuk" value="<?php echo $this->elemen->get_thn_masuk(); ?>">
                    <input type="text" value="<?php echo $this->elemen->get_thn_masuk(); ?>" disabled>


                    <label class="isian">Bulan dan Tahun : </label>
                    <?php
                    if ($this->elemen->get_bln() == "1")
                        $bln = "Januari";
                    if ($this->elemen->get_bln() == "2")
                        $bln = "Februari";
                    if ($this->elemen->get_bln() == "3")
                        $bln = "Maret";
                    if ($this->elemen->get_bln() == "4")
                        $bln = "April";
                    if ($this->elemen->get_bln() == "5")
                        $bln = "Mei";
                    if ($this->elemen->get_bln() == "6")
                        $bln = "Juni";
                    if ($this->elemen->get_bln() == "7")
                        $bln = "Juli";
                    if ($this->elemen->get_bln() == "8")
                        $bln = "Agustus";
                    if ($this->elemen->get_bln() == "9")
                        $bln = "September";
                    if ($this->elemen->get_bln() == "10")
                        $bln = "Oktober";
                    if ($this->elemen->get_bln() == "11")
                        $bln = "Nopember";
                    if ($this->elemen->get_bln() == "12")
                        $bln = "Desember";
                    ?>
                    <input type="hidden" id="bln" name="bln" value="<?php echo $this->elemen->get_bln(); ?>">
                    <input type="hidden" id="thn" name="thn" value="<?php echo $this->elemen->get_thn(); ?>">
                    <ul class="inline">
                        <li><input type="text" value="<?php echo $bln . " " . $this->elemen->get_thn(); ?>" disabled></li> 
    <!--                    <li><input type="text" value="<?php echo $this->elemen->get_thn(); ?>" disabled></li>-->
                    </ul>
                </div> <!--end kolom1-->
                <div class="kolom2">
                    <div id="wbiaya_jadup"></div>
                    <label class="isian">Biaya Per Pegawai : </label>
                    <input type="text" value="<?php echo number_format($this->elemen->get_biaya_per_peg()); ?>" disabled>
                    <input type="hidden" id="biaya_peg" name="biaya_peg" size="12" value="<?php echo $this->elemen->get_biaya_per_peg(); ?>" />

                    <div id="wtotal_biaya"></div>
                    <label class="isian">Total Biaya : </label>
                    <input readonly type="text" id="total_bayar" name="total_bayar" size="12" value="<?php echo $this->elemen->get_total_bayar(); ?>"/>

                    <div id="wno_sp2d"></div>
                    <label class="isian">No. SP2D : </label>
                    <input type="text" id="no_sp2d" name="no_sp2d" size="20" value="<?php echo $this->elemen->get_no_sp2d(); ?>"/>
                    <div id="wtgl_sp2d"></div>
                    <label class="isian">Tgl SP2D : </label>
                    <?php
                    $tgl = date('d-m-Y', strtotime($this->elemen->get_tgl_sp2d()));
                    ?>
                    <input type="text" readonly id="tgl_sp2d" name="tgl_sp2d" size="20" value="<?php
                    if ($tgl != '01-01-1970' && $tgl != '00-00-000') {
                        echo $tgl;
                    };
                    ?>"/>

                    <?php $file = $this->elemen->get_file_sp2d(); ?>
                    <div id="wfile_sp2d"></div>
                    <label class="isian">File SP2D : </label>
                    <ul class="inline tengah">
                        <li><input type="file" id="fupload" name="fupload" size="20" /></li>
                        <li><a href="<?php echo URL . 'elemenBeasiswa/filesp2d/' . $this->elemen->get_file_sp2d(); ?>" target="file_sp2d" onClick="cetak_dokumen('file_sp2d');"><?php
                    if ($file != "") {
                        echo "lihat file";
                    }
                    ?></a></li>
                    </ul>
                    <input type="hidden" id="fupload_lama" name="fupload_lama" value="<?php echo $this->elemen->get_file_sp2d(); ?>"/>



                </div> <!--end kolom2--> 
                <br/>

                <div>
                    <input type="hidden" id="kd_el" name="kd_el" value="<?php echo $this->elemen->get_kd_d(); ?>">
                    <ul class="inline tengah" style="float: right; margin-right: 20px">
                        <li><button type="submit" name="simpan" class="sukses" onClick="formSubmit();"/><i class="icon-ok icon-white"></i>Simpan</button></li>
                        <li><button type="reset" name="batal" class="normal" onClick="location.href='<?php echo URL . "elemenBeasiswa/viewJadup"; ?>'"><i class="icon-remove icon-white"></i>Batal</li>
                    </ul>
                </div>

        </fieldset>
    </div>
    <br>
    <div>
        <fieldset>
            <legend>Daftar Penerima Tunjangan Hidup</legend>
            <div id="wtabel_penerima_jadup"> </div>
            <div id="tabel_penerima_jadup"> </div>
        </fieldset>
    </div>
</form>

</div>


<script type="text/javascript">
    
    $.ajax({
        type:"POST",
        url: "<?php echo URL; ?>elemenBeasiswa/tabel_penerima_jadup2",
        data: {kd_jurusan:$('#kode_jur').val(),thn_masuk:$('#tahun_masuk').val(),bln:$('#bln').val(),thn:$('#thn').val(),kd_el:$('#kd_el').val()},
        success: function(jadup){
            $('#tabel_penerima_jadup').html(jadup);
        }
    });
    //mengubah inputan  dengan memunculkan separator ribuan
    $('#biaya_peg').number(true,0);
    $('#total_bayar').number(true,0);
        
    //menampilkan datepicker   
    $(function() { 
        $("#tgl_sp2d").datepicker({
		dateFormat: "dd-mm-yy",
                changeMonth: true,
				changeYear: true
        }); 
    });
    
    function cekField(){
        //alert($('#jml_peg').val());
        var jml=0;
     
        if($('#biaya_peg').val()==0 || $('#biaya_peg').val()=="" ){
            viewError("wbiaya_jadup","biaya per pegawai harus diisi");
            jml++;
        }

     
        if($('#total_bayar').val()=="" || $('#total_bayar').val()==0){
            viewError("wtotal_biaya","Total biaya harus diisi.");
            jml++;
        }
        
        var cks = $('#jml_peg').val();
        var cek=0;
        for (var j=1; j < cks+1; j++){
            //alert('ok')
            if ($('#setuju'+j).is(':checked')){
                cek++;         
            }      
        }      
               
        if(cek<=0){
            viewError("wtabel_penerima_jadup", "Penerima tunjangan hidup belum dipilih.")
            jml++;
        }
        
        if($('#no_sp2d').val()!=""){
            if($('#tgl_sp2d').val()==""){
                viewError("wtgl_sp2d","Tanggal SP2D harus diisi."); 
                jml++;
            }
            if($('#fupload').val()=="" && $('#fupload_lama').val()=="" ){
                viewError("wfile_sp2d","File SP2D harus diisi."); 
                jml++;
            }
        }
        
        if($('#no_sp2d').val()==""){                    
            if($('#tgl_sp2d').val()!="" || $('#fupload').val()!="" && $('#fupload_lama').val()!=""){
                viewError("wno_sp2d","Nomor sp2d harus diisi."); 
                jml++;
            }    
            
        }
        
        //        var file = $('#fupload').val();
        //        var ext = file.split('.');
        //        var no = ext.length;
        //        if($('#fupload').val()!="" && ext[no-1] != "pdf"){
        //            viewError("wfile_sp2d","File SP2D harus pdf."); 
        //            jml++;
        //        }
        
     
        if(jml>0){
            return false;
        } else{
            return true;
        }
    }
    
    
    $('#biaya_peg').keyup(function(){
        removeError('wbiaya_jadup');
    })
    
    $('#no_sp2d').keyup(function(){
        removeError('wno_sp2d');
    })
    $('#tgl_sp2d').click(function(){
        removeError('wtgl_sp2d');
    })
    $('#fupload').click(function(){
        removeError('wfile_sp2d');
    })
            
</script>