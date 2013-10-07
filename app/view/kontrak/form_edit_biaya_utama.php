 
<h2>Data Biaya Utama </h2>
<div id="proses_biaya" title="Informasi" style="display:none">
    <p> Sistem sedang melakukan proses update data biaya.....</p>
</div>
<form method="POST" id="form_biaya" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/updateBiaya' ?>">
    <input type="hidden" name="update_biaya" size="50">
    <label class="isian">Nomor Kontrak</label><input type="text" size="50" name="kontrak" id="kontrak" value="<? echo $this->kontrak->no_kontrak; ?>" readonly disabled>
    <label class="isian">Nama Biaya</label><input type="text" size="50" name="nama_biaya" id="nama_biaya" value="<? echo $this->biaya->nama_biaya; ?>">
    <div id="wnama_biaya"></div>
    <label class="isian">Biaya per Pegawai</label><input type="text" size="12" name="biaya_per_peg" id="biaya_per_peg" value="<? echo $this->biaya->biaya_per_pegawai; ?>" maxlength="14">
    <div id="wbiaya_per_peg"></div>
    <label class="isian">Jumlah Pegawai</label><input type="text" size="4" name="jml_peg" id="jml_peg" value="<? echo $this->biaya->jml_pegawai_bayar; ?>">
    <div id="wjml_peg"></div>
    <label class="isian">Jumlah Biaya</label><input type="text" size="14" name="jml_biaya" id="jml_biaya" maxlength="14" readonly value="<? echo $this->biaya->jml_biaya; ?>">
    <div id="wjml_biaya"></div>
    <label class="isian">Jadwal dibayarkan</label><input type="text" size="20" name="jadwal_bayar" id="jadwal_bayar" readonly value="<? echo $this->biaya->jadwal_bayar; ?>">
    <div id="wjadwal_bayar"></div>
    <input type="hidden" id="kd_biaya" name="kd_biaya" value="<?php echo $this->biaya->kd_biaya; ?>">
    <input type="hidden" name="kd_kontrak" id="kd_kontrak" value="<? echo $this->kontrak->kd_kontrak; ?>" readonly>
    <input type="submit" class="sukses" value="simpan" id="update_biaya" onClick="return konfirmasi_biaya();">
</form>

<script>
    //****
    // memproses update data utama biaya
    //****
    
    $(document).ready(function(){  //mulai jquery
              
       
        //mengubah inputan nilai biaya per pegawai dan jumlah biaya dengan memunculkan separator ribuan
        $('#biaya_per_peg').number(true,0);
        $('#jml_biaya').number(true,0);
        
        //validasi inputan jumlah pegawai harus angka ketika diinput
        $('#jml_peg').keyup(function() {   
            if(cekAngka($('#jml_peg').val())== false){
                viewError('wjml_peg','Jumlah pegawai harus diinput angka.');
            } else {
                removeError('wjml_peg');  
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
            $("#jadwal_bayar").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });
        
    }) //selesai jquery
       
    //konfirmasi update biaya
    function konfirmasi_biaya(){
        if(confirm('Simpan perubahan data biaya?')){
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
</script>