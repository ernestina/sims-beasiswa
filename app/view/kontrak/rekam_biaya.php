<div id="top">
    <h2><a href="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/display' ?>">DATA KONTRAK KERJASAMA</a> > <a href="<?php echo URL . 'kontrak/biaya/' . $this->kontrak->kd_kontrak ?>">BIAYA</a> > TAMBAH <!-- entar pake breadcrumb--></h2>
    <!--input type="button" value="KEMBALI" onClick="location.href='<?php echo URL . 'kontrak/biaya/' . $this->kontrak->kd_kontrak; ?>'"-->


    <div>
        <label class="isian">Nomor / Tanggal Kontrak</label><input type="text" size="50" readonly value="<?php echo $this->kontrak->no_kontrak . " / " . $this->kontrak->tgl_kontrak; ?>" disabled>
        <label class="isian">Program Studi</label><textarea type="text" rows="1" disabled><?php echo $this->nama_jur . " " . $this->nama_univ . " " . $this->kontrak->thn_masuk_kontrak; ?></textarea>
        <label class="isian">Jumlah Pegawai</label><input type="text" size="4" readonly value="<?php echo $this->kontrak->jml_pegawai_kontrak; ?>" disabled>
        <label class="isian">Lama Semester</label><input type="text" size="4" readonly value="<?php echo $this->kontrak->lama_semester_kontrak; ?>" disabled>
    <!--    <label class="isian">Nilai Kontrak</label><input type="text" size="14" readonly value="<?php echo number_format($this->kontrak->nilai_kontrak); ?>" disabled>
        <label class="isian">Kontrak Lama</label><input type="text" size="40" readonly value="<?php echo $this->kon_lama; ?>" disabled>-->
    </div>
    <br>
    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Biaya Utama</a></li>
            <li><a href="#tabs-2">Tagihan</a></li>
            <li><a href="#tabs-3">Pembayaran</a></li>
        </ul>
        <div id="tabs-1">
            <!--            <fieldset>-->
            <form id="form_rekam_biaya" method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/rekamBiaya'; ?>" onSubmit="return cekField();;">
                <input type="hidden" name="rekam_biaya" size="50">
<!--                    <label class="isian">Nomor Kontrak*</label><input type="text" size="50" name="kontrak" id="kontrak" value="<? echo $this->kontrak->no_kontrak; ?>" readonly>-->
      <div class="kolom1">
				<!--label class="isian">Kode Kontrak</label--><input type="hidden" size="50" name="kd_kontrak" id="kd_kontrak" value="<?php echo $this->kontrak->kd_kontrak; ?>" readonly >
                <label class="isian">Nama Biaya*</label><input type="text" size="50" name="nama_biaya" id="nama_biaya">
                <div id="wnama_biaya"></div>
                <label class="isian">Biaya per Pegawai*</label><input type="text" size="12" name="biaya_per_peg" id="biaya_per_peg" maxlength="14">
                <div id="wbiaya_per_peg"></div>
                <label class="isian">Jumlah Pegawai*</label><input type="text" size="4" name="jml_peg" id="jml_peg" >
                <div id="wjml_peg"></div>
                <label class="isian">Jadwal dibayarkan*</label><input type="text" size="20" name="jadwal_bayar" id="jadwal_bayar" readonly>
                <div id="wjadwal_bayar"></div>
                <label class="isian">Total Biaya*</label><input type="text" size="14" name="jml_biaya" id="jml_biaya" maxlength="14" readonly>
                <div id="wjml_biaya"></div>
                <ul class="inline" style="float: right; margin-right: 20px">
                    <li><button type="submit" name="simpan" class="sukses" onClick="formSubmit();"><i class="icon-ok icon-white"></i>Simpan</button></li>
                    <li><button type="reset" name="batal" id="batal" class="normal" onClick="location.href='<?php echo URL . 'kontrak/biaya/'.$this->kontrak->kd_kontrak; ?>'"><i class="icon-remove icon-white"></i>Batal</li>
                </ul>
            </form>
			<div>Keterangan : *harus diisi</div>
		</div>
            <!--            </fieldset>-->
        </div>
        <div id="tabs-2">
            <!--            <fieldset>-->
            <div>
                <div class="kolom1">
                    <label class="isian">No. BAST*</label><input type="text" size="30" disabled>
                    <label class="isian">Tgl. BAST*</label><input type="text" size="20" disabled>
                    <label class="isian">File BAST*</label><input type="file" disabled>
                    <label class="isian">No. BAP*</label><input type="text" size="30" disabled>
                    <label class="isian">Tgl. BAP*</label><input type="text" size="20" disabled>
                    <label class="isian">File BAP*</label><input type="file" disabled>
                </div>
                <div class="kolom2">
                    <label class="isian">No. Ringkasan Kontrak*</label><input type="text" size="30" disabled>
                    <label class="isian">Tgl. Ringkasan Kontrak*</label><input type="text" size="20" disabled>
                    <label class="isian">File Ringkasan Kontrak*</label><input type="file" disabled>
                    <label class="isian">No. Kuitansi*</label><input type="text" size="30" disabled>
                    <label class="isian">Tgl. Kuitansi*</label><input type="text" size="20" disabled>
                    <label class="isian">File Kuitansi*</label><input type="file" disabled>
                </div>
            </div>
            <input type="button" class="sukses" value="SIMPAN">
            </form>
            <!--            </fieldset>-->
        </div>
        <br />
        <div id="tabs-3">
            <!--            <fieldset>-->

            <form method="POST" action="" enctype="multipart/form-data">
                <label class="isian">No. SP2D*</label><input type="text" size="30" disabled>
                <label class="isian">Tgl. SP2D*</label><input type="text" size="20" disabled>
                <label class="isian">File SP2D*</label><input type="file" disabled>
<!--                            <label>Jumlah dibayar</label><input type="text" size="14" disabled></br>-->

                <input type="button" class="sukses" value="SIMPAN">


            </form>
            <!--            </fieldset>-->
        </div>
    </div>
    <br />
    
</div>
<div id="loading" class="loading" style="display: none"><img src="<?php echo URL . 'public/icon/loading.gif'; ?>" /></div>
</div>
<script>
    
    $(function() {
        $("#tabs").tabs({ active: 0 },{disabled: [1,2]});
        //$("#tabs").tabs({disabled: [0,1]});  
    });
    
    $(document).ready(function(){ 
     
        //mengubah inputan nilai biaya per pegawai dan jumlah biaya dengan memunculkan separator ribuan
        $('#biaya_per_peg').number(true,0);
        $('#jml_biaya').number(true,0);
        $('#jml_peg').number(true,0);
        
        //validasi inputan jumlah pegawai harus angka ketika diinput
        $('#jml_peg').keyup(function() {   
            if(cekAngka($('#jml_peg').val())== false){
                viewError('wjml_peg','Jumlah pegawai harus diinput angka.');
            } else {
                removeError('wjml_peg');  
                if($('#biaya_per_peg').val!=""){
                    removeError('wjml_biaya');
                }
            }         
        });
        
        $('#nama_biaya').keyup(function() {   
            removeError('wnama_biaya');         
        });
        
        $('#biaya_per_peg').keyup(function() {   
            removeError('wbiaya_per_peg');  
            if($('#jml_peg').val!=""){
                removeError('wjml_biaya');
            }
        });
        
        $('#jml_biaya').keyup(function() {   
            removeError('wjml_biaya');         
        });
        
        $('#jadwal_bayar').click(function() {   
            removeError('wjadwal_bayar');         
        });
        
        //menampilkan nilai jumlah biaya secara otomatis     
        if($('#biaya_per_peg').val!="" && $('#jml_peg').val!=""){
            $('#biaya_per_peg').keyup(function() {   
                $('#jml_biaya').val($('#biaya_per_peg').val() * $('#jml_peg').val());        
            });
            $('#jml_peg').keyup(function() {   
                $('#jml_biaya').val($('#biaya_per_peg').val() * $('#jml_peg').val());        
            });
        }
        
        //menampilkan datepicker   
        $(function() { 
            $("#jadwal_bayar").datepicker({
				dateFormat: "dd-mm-yy",
                changeMonth: true,
				changeYear: true
            }); 
        });
    })
    
    //mengecek field input tidak boleh kosong
    function cekField(){
        var jml = 0;
        if($('#nama_biaya').val()==''){
            viewError('wnama_biaya','Nama biaya harus diisi.');
            jml++;
        }
            
        if($('#biaya_per_peg').val()==''){
            viewError('wbiaya_per_peg','Biaya per pegawai harus diisi.');
            jml++;
        }
            
        if($('#jml_peg').val()==''){
            viewError('wjml_peg','Jumlah pegawai harus diisi.');
            jml++;
        }
        
        if($('#jml_biaya').val()==''){
            viewError('wjml_biaya','Jumlah biaya harus diisi.');
            jml++;
        }
            
        if($('#jadwal_bayar').val()==''){
            viewError('wjadwal_bayar','Jadwal bayar harus diisi.');
            jml++;
        }
            
        if(jml>0){
            return false;
        }
            
    }
        
//    function simpan(){
//        if(cekField()!=false){
//            $("#loading").show();
//            var formData = new FormData($('#form_rekam_biaya')[0]);
//            //alert(formData);
//            $.ajax({
//                url: '<?php echo URL; ?>kontrak/rekamBiaya2',
//                type: 'POST',
//                data: formData,
//                cache: false,
//                //dataType: 'json',
//                processData: false,
//                contentType: false,
//                success: function () {
//                    $("#loading").hide(); 
//                    alert('Data berhasil disimpan');
//                    $('#form_rekam_biaya')[0].reset();
//                }                       
//            });
//        }
//            
//        return false;
//    }
    
    $('#batal').click(function(){
        removeError('wnama_biaya');       
        removeError('wbiaya_per_peg');  
        removeError('wjml_peg');   
        removeError('wjml_biaya');  
        removeError('wjadwal_bayar');     
    })
</script>