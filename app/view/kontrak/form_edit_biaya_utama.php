 
<!--h1>Data Biaya Utama </h1-->
<div id="proses_biaya" title="Informasi" style="display:none">
    <p> Sistem sedang melakukan proses update data biaya.....</p>
</div>
<form method="POST" id="form_biaya" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/updateBiaya' ?>" onSubmit="return konfirmasi_biaya();">
    <input type="hidden" name="update_biaya" size="50">
    <input type="hidden" name="tab" value="0">
    <!--    <label class="isian">Nomor Kontrak</label>-->
    <!--    <input type="text" size="50" name="kontrak" id="kontrak" value="<? echo $this->kontrak->no_kontrak; ?>" readonly disabled>-->
    <label class="isian">Nama Biaya</label><input type="text" size="50" name="nama_biaya" id="nama_biaya" value="<?php echo $this->biaya->nama_biaya; ?>">
    <div id="wnama_biaya"></div>
	<label class="isian">Jumlah Biaya</label><input type="text" size="14" name="jml_biaya" id="jml_biaya" maxlength="14"  value="<?php echo $this->biaya->jml_biaya; ?>">
    <div id="wjml_biaya"></div>
    <label class="isian">Jumlah Pegawai</label><input type="text" size="4" name="jml_peg" id="jml_peg" value="<?php echo $this->biaya->jml_pegawai_bayar; ?>">
    <div id="wjml_peg"></div>
	<label class="isian">Biaya per Pegawai</label><input type="text" size="12" name="biaya_per_peg" id="biaya_per_peg" readonly value="<?php echo $this->biaya->biaya_per_pegawai; ?>" maxlength="14">
    <div id="wbiaya_per_peg"></div>
    <label class="isian">Jadwal dibayarkan</label><input type="text" size="20" name="jadwal_bayar" id="jadwal_bayar" readonly value="<?php echo $this->biaya->jadwal_bayar; ?>">
    <div id="wjadwal_bayar"></div>
    <input type="hidden" id="kd_biaya" name="kd_biaya" value="<?php echo $this->biaya->kd_biaya; ?>">
    <input type="hidden" name="kd_kontrak" id="kd_kontrak" value="<? echo $this->kontrak->kd_kontrak; ?>" readonly>
    <ul class="inline" style="float: right; margin-right: 20px">
        <li><button type="submit" name="simpan" class="sukses" onClick="formSubmit();"/><i class="icon-ok icon-white"></i>Simpan</button></li>
        <li><button type="reset" name="batal" id="batal" class="normal" onClick="location.href='<?php echo URL . 'kontrak/biaya/'.$this->kontrak->kd_kontrak; ?>'"><i class="icon-remove icon-white"></i>Batal</li>
    </ul>
	<input type="hidden" name="max_peg" id="max_peg" value="<?php echo $this->kontrak->jml_pegawai_kontrak; ?>">
	<input type="hidden" name="min_tgl" id="min_tgl" value="<?php echo $this->kontrak->tgl_kontrak; ?>">

</form>

<script>
    //****
    // memproses update data utama biaya
    //****
    //mengubah inputan nilai biaya per pegawai dan jumlah biaya dengan memunculkan separator ribuan
    $('#biaya_per_peg').number(true,0);
    $('#jml_biaya').number(true,0);
    
    $(document).ready(function(){  //mulai jquery
                     
        //validasi inputan jumlah pegawai harus angka ketika diinput
        $('#jml_peg').keyup(function() {   
            
                removeError('wjml_peg');  
                if($('#biaya_per_peg').val!=""){
                    removeError('wbiaya_per_peg');
                }
            

			if($('#jml_peg').val()>$('#max_peg').val()){
				$('#jml_peg').val($('#max_peg').val());
			}
        });
        
        //menghilangkan class error ketika field diketik atau dipilih
        $('#nama_biaya').keyup(function() {   
            removeError('wnama_biaya');         
        });
        
        $('#biaya_per_peg').keyup(function() {   
            removeError('wbiaya_per_peg');         
        });
        
        $('#jml_biaya').keyup(function() {   
            removeError('wjml_biaya');  
            if($('#jml_peg').val!=""){
                removeError('wbiaya_per_peg');
            }
        });
        
        $('#jadwal_bayar').click(function() {   
            removeError('wjadwal_bayar');         
        });
        
        //menampilkan nilai jumlah biaya secara otomatis     
        if($('#jml_biaya').val!="" && $('#jml_peg').val!=""){
            $('#jml_biaya').keyup(function() {   
                $('#biaya_per_peg').val($('#jml_biaya').val() / $('#jml_peg').val());        
            });
            $('#jml_peg').keyup(function() {   
                $('#biaya_per_peg').val($('#jml_biaya').val() / $('#jml_peg').val());       
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
        
    }) //selesai jquery
       
    //konfirmasi update biaya
    function konfirmasi_biaya(){
        if(confirm('Simpan data utama biaya?')){
            if(cekBiaya()==true){
                $('#proses_biaya').show();
            } else {
                return false;
            };
        } else {return false;}
    }
    
    //mengecek field input tidak boleh kosong pada form biaya utama
    function cekBiaya(){
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
        } else {
            return true;
        }
                    
    }
   
    $('#batal').click(function(){
        removeError('wnama_biaya');       
        removeError('wbiaya_per_peg');  
        removeError('wjml_peg');   
        removeError('wjml_biaya');  
        removeError('wjadwal_bayar');     
    })
    
</script>