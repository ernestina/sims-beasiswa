<div>
    DATA KONTRAK KERJASAMA > TAMBAH <!-- pake breadcrumb-->
</div>
<div class="kolom3" id="div_rekam">
    <form method="POST" enctype="multipart/form-data" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/rekamKontrak' ?>">
        <input type="hidden" name="rekam_kontrak">
        <label>Nomor </label><input type="text" name="nomor" id="nomor" size="30">
        <div id="wnomor"></div></br>
        <label>Tanggal </label><input type="text" name="tanggal" id="tanggal" size="30" readonly="readonly">
        <div id="wtanggal"></div></br>
        <label>Universitas </label><select name="univ" id="univ">
            <option value="" select>Pilih Universitas</option>
            <?php
            foreach ($this->univ as $univ) {
                ?>
                <option value="<?php echo $univ->get_kode_in(); ?>"><?php echo $univ->get_nama(); ?></option>
            <?php } ?>
        </select><div id="wuniv"></div></br>
        <label>Jurusan </label><select name="jur" id="jur">
            <option value="">Pilih Jurusan</option>
        </select><div id="wjur"></div></br>
        <label>Jumlah Pegawai</label><input type="text" name="jml_peg" id="jml_peg" size="4">
        <div id="wjml_peg"></div></br>
        <label>Lama Semester</label><select id="lama_semester" name="lama_semester">
            <option value="">Pilih Lama Semester</option>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select><div id="wlama_semester"></div>
        </br>
        <label>Tahun Masuk</label><select name="tahun_masuk" id="tahun_masuk">
            <option value="">Pilih Tahun Masuk</option>
            <?php
            for ($i = 2007; $i <= date('Y') + 5; $i++) {
                ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select><div id="wtahun_masuk"></div>
        </select></br>
        <label>Kontrak Lama </label><select name="kontrak_lama" id="kontrak_lama">
            <option value="">Pilih Kontrak Lama</option>
            <?php
            foreach ($this->kon as $kon) {
                ?>
                <option value="<?php echo $kon->kd_kontrak; ?>"><?php echo $kon->no_kontrak; ?></option>
            <?php } ?>
        </select><div id="wkontrak_lama"></div>
        <label>File Kontrak </label><input type="file" name="fupload" id="fupload">
        <div id="wfupload"></div></br>

        <ul class="inline tengah">
            <li><input type="reset" class="normal" value="BATAL" onClick="location.href='<?php echo URL . 'kontrak/display'; ?>'"></li>
            <li><input type="submit" class="sukses" name="sb_rekam" id="sb_rekam" value="SIMPAN" onClick="return cek();"></li>
        </ul>


    </form>
</div>

<script>
    
    $(document).ready(function(){       
        //agar ketika halaman direfresh, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $.post("<?php echo URL; ?>kontrak/get_jur_by_univ", {univ:$("#univ").val()},
        function(data){                
            $('#jur').html(data);
        });
    
        //agar ketika universitas berubah karena dipilih, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $("#univ").change(function(){
            $.post("<?php echo URL; ?>kontrak/get_jur_by_univ", {univ:$("#univ").val()},
            function(data){                
                $('#jur').html(data);
            });  
        });
    
        //menampilkan datepicker   
        $(function() { 
            $("#tanggal").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });
        
        //menghilangkan error ketika field diinput
        $('#nomor').keyup(function() {   
            removeError('wnomor');          
        });
        $('#tanggal').click(function() {   
            removeError('wtanggal');             
        });
        $('#univ').change(function() {   
            removeError('wuniv');                  
        });
        $('#jur').change(function() {   
            removeError('wjur');          
        });
        $('#jml_peg').keyup(function() {   
            removeError('wjml_peg');          
        });
        $('#lama_semester').change(function() {   
            removeError('wlama_semester');          
        });
        $('#tahun_masuk').change(function() {   
            removeError('wtahun_masuk');          
        });
        $('#fupload').click(function() {   
            removeError('wfupload');          
        });
    });
    
    //melakukan validasi input ketika tombol simpan diklik: tidak boleh kosong
    function cek(){
        var jml = 0;
        if($('#nomor').val()==""){
            viewError('wnomor','Nomor harus diisi');
            jml++;
        }
        if($('#tanggal').val()==""){
            viewError('wtanggal','Tanggal harus diisi');
            jml++;
        }
        if($('#univ').val()==""){
            viewError('wuniv','Universitas harus dipilih');
            jml++;
        }
        if($('#jur').val()==""){
            viewError('wjur','Jurusan harus dipilih');
            jml++;
        }
        if($('#jml_peg').val()==""){
            viewError('wjml_peg','Jumlah pegawai harus diisi');
            jml++;
        }
        if($('#lama_semester').val()==""){
            viewError('wlama_semester','Lama semester harus dipilih');
            jml++;
        }
        if($('#tahun_masuk').val()==""){
            viewError('wtahun_masuk','Tahun masuk harus dipilih');
            jml++;
        }
        if($('#fupload').val()==""){
            viewError('wfupload','File kontrak harus dipilih');
            jml++;
        }
        if(jml>0){
            //alert('Isian form belum lengkap');
            return false;
        }
        
        if(cekAngka($('#jml_peg').val())== false){
            viewError('wjml_peg','Jumlah pegawai harus diisi angka');
            return false;
        }
    }


   
</script>