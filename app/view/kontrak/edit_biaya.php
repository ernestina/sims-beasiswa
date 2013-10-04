<div>
    DATA KONTRAK KERJASAMA > BIAYA > UBAH <!-- entar pake breadcrumb-->
    <input type="button" value="KEMBALI" onClick="location.href='<?php echo URL . 'kontrak/biaya/' . $this->kontrak->kd_kontrak; ?>'">
</div>

<input type="hidden" id="kd_jurusan" value="<?php echo $this->kontrak->kd_jurusan; ?>">
<input type="hidden" id="thn_masuk" value="<?php echo $this->kontrak->thn_masuk_kontrak; ?>">
<!--<div>
    <label>Nomor / Tgl Kontrak</label><input type="text" size="50"></br>
    <label>Program Studi</label><input type="text" size="70"></br>
    <label>Jumlah Pegawai</label><input type="text" size="4">
    <label>Lama Semester</label><input type="text" size="4">
</div>-->
<div>
    <div >
        <h2>Data Utama Biaya</h2>
        <div id="proses_biaya" title="Informasi" style="display:none" align="center">
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
    </div>
    
    <form method="POST" id="form_tagihan" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/updateTagihan' ?>" enctype="multipart/form-data">
        <input type="hidden" name="update_tagihan">
        <div>
            <h2>Data Tagihan Biaya</h2>
            <div id="proses_tagihan" title="Informasi" style="display:none" align="center">
                <p> Sistem sedang melakukan proses update data tagihan biaya.....</p>
            </div>
            <div class="kolom1">
                <label class="isian">No. BAST</label><input type="text" size="30" name="no_bast" id="no_bast" value="<?php echo $this->biaya->no_bast; ?>">
                <div id="wno_bast"></div>
                <label class="isian">Tgl. BAST</label><input type="text" size="20" name="tgl_bast" id="tgl_bast" value="<?php
if ($this->biaya->tgl_bast != "01-01-1970") {
    echo $this->biaya->tgl_bast;
}
?>">
                <div id="wtgl_bast"></div>
                <label class="isian">File BAST</label>
                <ul class="inline">
                   <li><input type="file" name="file_bast" id="file_bast"/></li>
                   <li><a href="<?php echo URL . "kontrak/fileBast/" . $this->biaya->file_bast; ?>" target="_blank"><?php if($this->biaya->file_bast != ""){ echo "...";} ?></a></li>
                </ul><div id="wfile_bast"></div>
                <label class="isian">No. BAP</label><input type="text" size="30" name="no_bap" id="no_bap" value="<?php echo $this->biaya->no_bap; ?>">
                <div id="wno_bap"></div>
                <label class="isian">Tgl. BAP</label><input type="text" size="20" name="tgl_bap" id="tgl_bap" value="<?php
                                                             if ($this->biaya->tgl_bap != "01-01-1970") {
                                                                 echo $this->biaya->tgl_bap;
                                                             }
?>">
                <div id="wtgl_bap"></div>
                <label class="isian">File BAP</label><input type="file" name="file_bap" id="file_bap">
                <div id="wfile_bap"></div>
            </div>
            <div class="kolom2">
                <label class="isian">No. Ringkasan Kontrak</label><input type="text" size="30" name="no_ring_kon" id="no_ring_kon" value="<?php echo $this->biaya->no_ring_kontrak; ?>">
                <div id="wno_ring_kon"></div>
                <label class="isian">Tgl Ringkasan Kontrak</label><input type="text"name="tgl_ring_kon" id="tgl_ring_kon" value="<?php
                                                            if ($this->biaya->tgl_ring_kontrak != "01-01-1970") {
                                                                echo $this->biaya->tgl_ring_kontrak;
                                                            }
?>">
                <div id="wtgl_ring_kon"></div>
                <label class="isian">File. Ringkasan Kontrak</label><input type="file"size="30" name="file_ring_kon" id="file_ring_kon">
                <div id="wfile_ring_kon"></div>
                <label class="isian">No. Kuitansi</label><input type="text" size="30" name="no_kuitansi" id="no_kuitansi" value="<?php echo $this->biaya->no_kuitansi; ?>"> 
                <div id="wno_kuitansi"></div>
                <label class="isian">Tgl. Kuitansi</label><input type="text" size="30" name="tgl_kuitansi" id="tgl_kuitansi" value="<?php
                                                                         if ($this->biaya->tgl_kuitansi != "01-01-1970") {
                                                                             echo $this->biaya->tgl_kuitansi;
                                                                         }
?>">
                <div id="wtgl_kuitansi"></div>
                <label class="isian">File Kuitansi</label><input type="file" name="file_kuitansi" id="file_kuitansi">
                <div id="wfile_kuitansi"></div>
            </div>
        </div>
        <input type="hidden" id="kd_biaya" name="kd_biaya" value="<?php echo $this->biaya->kd_biaya; ?>">
        <input type="hidden" name="file_bast_lama" id="file_bast_lama" value="<?php echo $this->biaya->file_bast; ?>">
        <input type="hidden" name="file_bap_lama" id="file_bap_lama" value="<?php echo $this->biaya->file_bap; ?>">
        <input type="hidden" name="file_ring_kon_lama" id="file_ring_kon_lama" value="<?php echo $this->biaya->file_ring_kontrak; ?>">
        <input type="hidden" name="file_kuitansi_lama" id="file_kuitansi_lama" value="<?php echo $this->biaya->file_kuitansi; ?>">
        <input type="submit" class="sukses" value="simpan" id="update_tagihan" onClick="return konfirmasi_tagihan();">
    </form>
    <hr>
    <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/updatePembayaran' ?>" enctype="multipart/form-data">
        <input type="hidden" name="update_pembayaran">
        <div class="kolom1">
            <h2>Data Pembayaran Tagihan Biaya</h2>
            <div id="proses_pembayaran" title="Informasi" style="display:none" align="center">
                <p> Sistem sedang melakukan proses update pembayaran tagihan biaya.....</p>
            </div>
            <label class="isian">No. SP2D</label><input type="text" name="no_sp2d" id="no_sp2d" size="30" value="<?php echo $this->biaya->no_sp2d; ?>">
            <label class="isian">Tgl. SP2D</label><input type="text" name="tgl_sp2d" id="tgl_sp2d" size="20" value="<?php
                                                                 if ($this->biaya->tgl_sp2d != "01-01-1970") {
                                                                     echo $this->biaya->tgl_sp2d;
                                                                 }
?>">
            <label class="isian">File SP2D</label><input type="file" name="file_sp2d" id="file_sp2d">
<!--            <label>Jumlah dibayar</label><input type="text" size="14">-->

            <input type="hidden" id="kd_biaya" name="kd_biaya" value="<?php echo $this->biaya->kd_biaya; ?>">
            <input type="hidden" name="file_sp2d_lama" id="file_sp2d_lama" value="<?php echo $this->biaya->file_sp2d; ?>">
            <input type="submit" class="sukses" value="simpan" onClick="return konfirmasi_pembayaran();">
        </div>
    </form>
</div>


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
            $('#proses_biaya').show();
            cekBiaya();
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
    
    
    //****
    // memproses update data tagihan
    //****
    
    $(document).ready(function(){  //mulai jquery
      
        //menampilkan datepicker   
        $(function() { 
            $("#tgl_bast").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });
        $(function() { 
            $("#tgl_bap").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });
        $(function() { 
            $("#tgl_ring_kon").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });
        $(function() { 
            $("#tgl_kuitansi").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });

    })
    
    //konfirmasi update tagihan
    function konfirmasi_tagihan(){
        if(confirm('Simpan perubahan data tagihan?')){
            $('#proses_tagihan').show();
            return true;
        } else {return false;}
    }
    
    
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