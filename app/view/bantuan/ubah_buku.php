<div id="top">
    <h2>Tunjangan Buku > Ubah</h2> <!-- memakai breadcrumb -->

    <form method="POST" onSubmit="return cekField();" action="<?php echo URL . 'elemenBeasiswa/updateUangBuku' ?> " enctype="multipart/form-data">
        <div>
            <noscript>
            <input  type="hidden" name="js" value="1" />
            </noscript>
             <input  type="hidden" name="ubah_buku" />
            <input  type="hidden" name="r_elem" value="2"/>
            <fieldset><legend>Parameter Ubah Tunjangan Buku</legend>
                <!--div class="tigakolom"-->
                <div class="kolom1" style="margin-right: -100px">
                    <div id="wkode_univ"></div>
                    <label class="isian">Universitas : </label>
                    <input type="hidden" id="kode_univ" name="kode_univ" value="<?php echo $this->univ->get_kode_in(); ?>">
                    <input type="text" value="<?php echo $this->univ->get_nama(); ?>" disabled>

                    <div id="wkode_jur"></div>
                    <label class="isian">Jurusan/Prodi : </label>
                    <input type="hidden" id="kode_jur" name="kode_jur" value="<?php echo $this->jur->get_kode_jur(); ?>">
                    <input type="text" value="<?php echo $this->jur->get_nama(); ?>" disabled>

                    <div id="wtahun_masuk"></div>
                    <label class="isian">Tahun Masuk : </label>
                    <input type="hidden" name="tahun_masuk" id="tahun_masuk" value="<?php echo $this->elemen->get_thn_masuk(); ?>">
                    <input type="text" value="<?php echo $this->elemen->get_thn_masuk(); ?>" disabled>

                    <div id="wsemester"></div>
                    <div id="wthn"></div>
                    <label class="isian">Semester dan Tahun : </label>
                    <?php
                    if ($this->elemen->get_bln() == "1")
                        $bln = "Semester 1";
                    if ($this->elemen->get_bln() == "2")
                        $bln = "Semester 2";
                    ?>
                    <input type="hidden" id="semester" name="semester" value="<?php echo $this->elemen->get_bln(); ?>">
                    <input type="hidden" id="thn" name="thn" value="<?php echo $this->elemen->get_thn(); ?>">
                    <ul class="inline" style="margin-bottom: 0px">
                        <li>
                            <input type="text" value="<?php echo $bln . " " . $this->elemen->get_thn(); ?>" disabled>
                        </li>


                    </ul>
                </div>

                <div class="kolom2" style="margin-right: -60px; margin-left:100px">
                    <div id="wbiaya_buku"></div>
                    <label class="isian">Biaya Per Pegawai : </label>
                    <input type="text" id="biaya_buku" name="biaya_buku" size="12" value="<?php echo $this->elemen->get_biaya_per_peg(); ?>"/>

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
                        <li><a href="<?php echo URL . 'elemenBeasiswa/filesp2d/' . $this->elemen->get_file_sp2d(); ?>" target="_blank"><?php
                           if ($file != "") {
                               echo "lihat file";
                           }
                           ?></a></li>
                    </ul>
                    <input type="hidden" id="fupload_lama" name="fupload_lama" value="<?php echo $this->elemen->get_file_sp2d(); ?>"/>

                </div>


                <input type="hidden" id="kd_el" name="kd_el" value="<?php echo $this->elemen->get_kd_d(); ?>">
                <ul class="inline" style="float: right; margin-right: 20px">
                    <li><button type="submit" name="simpan" class="sukses" onClick="formSubmit();"/><i class="icon-ok icon-white"></i>Simpan</button></li>
                    <li><button type="reset" name="batal" class="normal" onClick="location.href='<?php echo URL . "elemenBeasiswa/viewUangBuku"; ?>'"><i class="icon-remove icon-white"></i>Batal</li>
                </ul>

        </div>
		</fieldset>
		<br>

        <!--        <div>
                    <div>Data Penerima Biaya Buku</div>
                    <div>file link print</div>
                </div>-->
        <fieldset><legend>Daftar Penerima Tunjangan Buku</legend>
		<div id="wtabel_penerima_buku"></div>
        <div id="tabel_penerima_buku">
        </div>
        </fieldset>
    </form>
</div>
<script type="text/javascript">
    
       
    //mengubah inputan  dengan memunculkan separator ribuan
    $('#biaya_peg').number(true,0);
    $('#total_bayar').number(true,0);
    $('#biaya_buku').number(true,0);
    
    //menampilkan datepicker   
    $(function() { 
        $("#tgl_sp2d").datepicker({dateFormat: "dd-mm-yy"
            //            buttonImage:'images/calendar.gif',
            //            buttonImageOnly: true,
            //            showOn: 'button'
        }); 
    });
    
    //menampilkan data penerima jadup
    display_penerima();
    function display_penerima(){
        $.ajax({
            type:"POST",
            url: "<?php echo URL; ?>elemenBeasiswa/tabel_penerima_buku2",
            data: {kd_jurusan:$('#kode_jur').val(),thn_masuk:$('#tahun_masuk').val(),kd_el:$('#kd_el').val(),semester:$('#semester').val(),thn:$('#thn').val()},
            success: function(jadup){
                $('#tabel_penerima_buku').html(jadup);
            }
        });    
    }
         
        
       
    function cekField(){
        $jml=0;
     
        if($('#biaya_buku').val()==0 || $('#biaya_buku').val()=="" ){
            viewError("wbiaya_buku","biaya per pegawai harus diisi");
            $jml++;
        }
        if($('#kode_univ').val()==""){
            viewError("wkode_univ","Universitas harus diisi");
            $jml++;
        }
     
        if($('#kode_jur').val()==""){
            viewError("wkode_jur","Jurusan harus diisi");
            $jml++;
        }
     
        if($('#tahun_masuk').val()==""){
            viewError("wtahun_masuk","Tahun masuk harus diisi.");
            $jml++;
        }
     
        if($('#semester').val()==""){
            viewError("wsemester","Semester harus diisi.");
            $jml++;
        }
     
        if($('#thn').val()==""){
            viewError("wthn","Tahun harus diisi.");
            $jml++;
        }
     
        if($('#tahun_masuk').val()==""){
            viewError("wtahun_masuk","Tahun masuk harus diisi.");
            $jml++;
        }
        if($('#total_bayar').val()=="" || $('#total_bayar').val()==0){
            viewError("wtotal_biaya","Total biaya harus diisi.");
            $jml++;
        }
        
        if($('#no_sp2d').val()!=""){
            if($('#tgl_sp2d').val()==""){
                viewError("wtgl_sp2d","Tanggal SP2D harus diisi."); 
                $jml++;
            }
             if($('#fupload').val()=="" && $('#fupload_lama').val()=="" ){
                viewError("wfile_sp2d","File SP2D harus diisi."); 
                $jml++;
            }
        }
        
        if($('#no_sp2d').val()==""){                    
            if($('#tgl_sp2d').val()!="" || $('#fupload').val()!="" && $('#fupload_lama').val()!=""){
                viewError("wno_sp2d","Nomor sp2d harus diisi."); 
                $jml++;
            }
             
            
        }
        
        var chks = document.getElementsByName('setuju[]');
        var hasChecked = false;
        for (var i = 0; i < chks.length; i++){
            if (chks[i].checked){
                hasChecked = true;
                break;
            }
        }
        
        if(hasChecked==false){
            viewError("wtabel_penerima_buku", "Penerima biaya buku belum dipilih.")
            $jml++;
        }
     
        if($jml>0){
            return false;
        } else{
            return true;
        }
    }
    
    $("#biaya_buku").focusout(function(){
        if($("#biaya_buku").val() ==""){
            $("#biaya_buku").val("0");
        }
    })
    
    
    $('#kode_univ').click(function(){
        removeError('wkode_univ');
    })
    
    $('#kode_jur').click(function(){
        removeError('wkode_jur');
    })
    
    $('#tahun_masuk').click(function(){
        removeError('wtahun_masuk');
    })
    
    $('#biaya_buku').keyup(function(){
        removeError('wbiaya_buku');
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