<div>
    DATA KONTRAK KERJASAMA > BIAYA > UBAH <!-- entar pake breadcrumb-->
    <input type="button" value="KEMBALI" onClick="location.href='<?php echo URL . 'kontrak/biaya/' . $this->kontrak->kd_kontrak; ?>'">
</div>
<div id="LoadingImage" style="display: none">
<!--    <img src="<?php echo URL . 'public/icon/loading.gif'; ?>" alt="Sedang menyimpan..."/>-->
    <p>Sedang menyimpan......</p>
</div>


<!--<div>
    <label>Nomor / Tgl Kontrak</label><input type="text" size="50"></br>
    <label>Program Studi</label><input type="text" size="70"></br>
    <label>Jumlah Pegawai</label><input type="text" size="4">
    <label>Lama Semester</label><input type="text" size="4">
</div>-->
<div>
    <div >
        <h2>Data Utama Biaya</h2>
        <form method="POST" id="form_biaya" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/updateBiaya' ?>">
            <input type="hidden" name="update_biaya" size="50">
            <label class="isian">Nomor Kontrak</label><input type="text" size="50" name="kontrak" id="kontrak" value="<? echo $this->kontrak->no_kontrak; ?>" readonly disabled>
            <input type="hidden" size="50" name="kd_kontrak" id="kd_kontrak" value="<? echo $this->kontrak->kd_kontrak; ?>" readonly>
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
            <input type="button" class="sukses" value="simpan" id="update_biaya">
        </form>
    </div>
    <hr>
    <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/updateTagihan' ?>" enctype="multipart/form-data">
        <div>
            <h2>Data Tagihan Biaya</h2>
            <div>
                <label class="isian">No. BAST</label><input type="text" size="30" name="no_bast" id="no_bast" value="<?php echo $this->biaya->no_bast; ?>">
                <div id="wno_bast"></div>
                <label class="isian">Tgl. BAST</label><input type="text" size="20" name="tgl_bast" id="tgl_bast" value="<?php echo $this->biaya->no_bast; ?>">
                <div id="wtgl_bast"></div>
                <label class="isian">File BAST</label><input type="file" name="file_bast" id="file_bast">
                <div id="wfile_bast"></div>
                <label class="isian">No. BAP</label><input type="text" size="30" name="no_bap" id="no_bap" value="<?php echo $this->biaya->no_bast; ?>">
                <div id="wno_bap"></div>
                <label class="isian">Tgl. BAP</label><input type="text" size="20" name="tgl_bap" id="tgl_bap" value="<?php echo $this->biaya->no_bast; ?>">
                <div id="wtgl_bap"></div>
                <label class="isian">File BAP</label><input type="file" name="file_bap" id="file_bap">
                <div id="wfile_bap"></div>
            </div>
            <div>
                <label class="isian">No. Ringkasan Kontrak</label><input type="text" size="30" name="no_ring_kon" id="no_ring_kon" value="<?php echo $this->biaya->no_bast; ?>">
                <div id="wno_ring_kon"></div>
                <label class="isian">Tgl Ringkasan Kontrak</label><input type="text"name="tgl_ring_kon" id="tgl_ring_kon" value="<?php echo $this->biaya->no_bast; ?>">
                <div id="wtgl_ring_kon"></div>
                <label class="isian">File. Kuitansi</label><input type="file"size="30" name="file_ring_kon" id="file_ring_kon">
                <div id="wfile_ring_kon"></div>
                <label class="isian">No. Kuitansi</label><input type="text" size="30" name="no_kuitansi" id="no_kuitansi" value="<?php echo $this->biaya->no_bast; ?>"> 
                <div id="wno_kuitansi"></div>
                <label class="isian">Tgl. Kuitansi</label><input type="text" size="30" name="tgl_kuitansi" id="file_kuitansi" value="<?php echo $this->biaya->no_bast; ?>">
                <div id="wtgl_kuitansi"></div>
                <label class="isian">File Kuitansi</label><input type="file" name="file_kuitansi" id="file_kuitansi">
                <div id="wfile_kuitansi"></div>
            </div>
        </div>
        <input type="submit" class="sukses" value="simpan" onClick="return cek2()">
    </form>
    <hr>
    <form method="POST" action="" enctype="multipart/form-data">
        <div>
            <h2>Data Pembayaran Tagihan Biaya</h2>
            <label>No. SP2D</label><input type="text" size="30"></br>
            <label>Tgl. SP2D</label><input type="text" size="20"></br>
            <label>File SP2D</label><input type="file"></br>
            <label>Jumlah dibayar</label><input type="text" size="14"></br>

            <input type="submit" class="sukses" value="simpan" onClick="return cek3()" disabled>
        </div>
    </form>
</div>


<div id="update_biaya_sukses" title="Informasi">
    <p> Perubahan data biaya berhasil disimpan.</p>

</div>
<div id="update_biaya_gagal" title="Informasi">
    <p>Perubahan data biaya gagal disimpan.</p>

</div>

<script>
    
    $(document).ajaxStart(function () {
        $('#LoadingImage').show();
    }).ajaxStop(function () {
        $('#LoadingImage').hide();
    });
    
    //****
    // memproses update data biaya
    //****
    
    $(document).ready(function(){  //mulai jquery
        //menyembunyikan dialog
        $('#update_biaya_sukses').hide();
        $('#update_biaya_gagal').hide();
       
       
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
        

        //ketika tombol simpan diklik
        $('#update_biaya').click(function(){ 
            if(cek()==true){
                
                if(cek1()==true){
                    var myform = $('#form_biaya').serialize();
                    $.ajax({
                        type:"POST",
                        url: "<?php echo URL; ?>kontrak/updateBiaya",
                        data: myform,
                        cache: false,
                        dataType: 'json',
                        success: function(msg){
                            if(msg.respon=="sukses"){
                                
                                $( "#update_biaya_sukses" ).dialog({
                                    modal: true,
                                    buttons: {
                                        Ok: function() {
                                            $( this ).dialog( "close" );
                                        }
                                    }
                                });
                            }else{
                                
                                $( "#update_biaya_gagal" ).dialog({
                                    modal: true,
                                    buttons: {
                                        Ok: function() {
                                            $( this ).dialog( "close" );
                                        }
                                    }
                                });
                            }   
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            
                            $( "#update_biaya_gagal" ).dialog({
                                modal: true,
                                buttons: {
                                    Ok: function() {
                                        $( this ).dialog( "close" );
                                    }
                                }
                            });
                        }
                    });  
                }
            }
        })
        
        
        
    }) //selesai jquery
       
    //konfirmasi update biaya
    function cek(){
        if(confirm('Simpan perubahan data biaya?')){
            return true;
        } else {return false;}
    }
    
    //mengecek field input tidak boleh kosong pada form biaya utama
    function cek1(){
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
        } else {return true;
        }
                    
    }
 
</script>