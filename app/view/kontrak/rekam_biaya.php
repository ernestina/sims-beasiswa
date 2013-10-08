<div>
    DATA KONTRAK KERJASAMA > BIAYA > TAMBAH <!-- entar pake breadcrumb-->
    <input type="button" value="KEMBALI" onClick="location.href='<?php echo URL . 'kontrak/biaya/' . $this->kontrak->kd_kontrak; ?>'">
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
        <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/rekamBiaya' ?>">
            <input type="hidden" name="rekam_biaya" size="50">
            <label class="isian">Nomor Kontrak</label><input type="text" size="50" name="kontrak" id="kontrak" value="<? echo $this->kontrak->no_kontrak; ?>" readonly>
            <input type="hidden" size="50" name="kd_kontrak" id="kd_kontrak" value="<? echo $this->kontrak->kd_kontrak; ?>" readonly>
            <label class="isian">Nama Biaya</label><input type="text" size="50" name="nama_biaya" id="nama_biaya">
            <div id="wnama_biaya"></div>
            <label class="isian">Biaya per Pegawai</label><input type="text" size="12" name="biaya_per_peg" id="biaya_per_peg" maxlength="14">
            <div id="wbiaya_per_peg"></div>
            <label class="isian">Jumlah Pegawai</label><input type="text" size="4" name="jml_peg" id="jml_peg" >
            <div id="wjml_peg"></div>
            <label class="isian">Jumlah Biaya</label><input type="text" size="14" name="jml_biaya" id="jml_biaya" maxlength="14" readonly>
            <div id="wjml_biaya"></div>
            <label class="isian">Jadwal dibayarkan</label><input type="text" size="20" name="jadwal_bayar" id="jadwal_bayar" readonly>
            <div id="wjadwal_bayar"></div>
            <input type="submit" class="sukses" value="simpan" onClick="return cek1();">
        </form>
    </div>
    <hr>
    <form method="POST" action="" enctype="multipart/form-data">
        <div>
            <h2>Data Tagihan Biaya</h2>
            <div>
                <label>No. BAST</label><input type="text" size="30"></br>
                <label>Tgl. BAST</label><input type="text" size="20"></br>
                <label>File BAST</label><input type="file"></br>
                <label>No. BAP</label><input type="text" size="30"></br>
                <label>Tgl. BAP</label><input type="text" size="20"></br>
                <label>File BAP</label><input type="file"></br>
            </div>
            <div>
                <label>No. Ringkasan Kontrak</label><input type="text" size="30"></br>
                <label>File Ringkasan Kontrak</label><input type="file"></br>
                <label>No. Kuitansi</label><input type="text" size="30"></br> 
                <label>File Kuitansi</label><input type="file"></br>
            </div>
        </div>
        <input type="submit" class="sukses" value="simpan" onClick="return cek2()" disabled>
    </form>
    <hr>
    <form method="POST" action="" enctype="multipart/form-data">
        <div>
            <h2>Data Pembayaran Tagihan Biaya</h2>
            <label>No. SP2D</label><input type="text" size="30"></br>
            <label>Tgl. SP2D</label><input type="text" size="20"></br>
            <label>File SP2D</label><input type="file"></br>
            <label>Jumlah dibayar</label><input type="text" size="14"></br>
            <div>Keterangan : *harus diisi</div>
            <input type="submit" class="sukses" value="simpan" onClick="return cek3()" disabled>
        </div>
    </form>
</div>
<script>
    $(document).ready(function(){ 
     
        //mengubah inputan nilai biaya per pegawai dan jumlah biaya dengan memunculkan separator ribuan
        $('#biaya_per_peg').number(true,0);
        $('#jml_biaya').number(true,0);
        
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
            $("#jadwal_bayar").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });
    })
    
    //mengecek field input tidak boleh kosong
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
        }
            
    }
</script>