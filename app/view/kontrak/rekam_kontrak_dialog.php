<fieldset>
    <form method="POST" id="form_rekam_kontrak2" enctype="multipart/form-data" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/rekamKontrak' ?>">
        <input type="hidden" name="rekam_kontrak">
        <div class="kolom1">
		<div class="kiri">
            <label>Nomor* </label><input type="text" name="nomor" id="nomor" size="30">
            <div id="wnomor"></div>
            <label>Tanggal* </label><input type="text" name="tanggal" id="tanggal" size="30" readonly="readonly">
            <div id="wtanggal"></div>
            <label>Universitas* </label>
            <select name="univ" id="univ" type="text">
                <option value="" select>Pilih Universitas</option>
                <?php
                foreach ($this->univ as $univ) {
                    ?>
                    <option value="<?php echo $univ->get_kode_in(); ?>"><?php echo $univ->get_nama(); ?></option>
                <?php } ?>
            </select><div id="wuniv"></div>
            <label>Jurusan* </label>
            <select name="jur" id="jur" type="text">
                <option value="">Pilih Jurusan</option>
            </select><div id="wjur"></div>
            <label>Jumlah Pegawai*</label><input type="text" name="jml_peg" id="jml_peg" size="4">
            <div id="wjml_peg"></div>
		</div>
        </div>
        <div class="kolom2">
		<div class="kiri">

            <label>Lama Semester*</label>
            <select id="lama_semester" name="lama_semester" type="text">
                <option value="">Pilih Lama Semester</option>
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><div id="wlama_semester"></div>
            <label>Tahun Masuk</label>
            <select name="tahun_masuk" id="tahun_masuk" type="text">
                <?php
                for ($i = 2007; $i <= date('Y') + 2; $i++) {
                    ?>
                    <option value="<?php echo $i; ?>" <?php
                if ($i == date('Y')) {
                    echo "selected";
                }
                    ?>><?php echo $i; ?></option>
                        <?php } ?>
            </select><div id="wtahun_masuk"></div>
            <label>Nilai kontrak* </label><input type="text" name="nilai_kontrak" id="nilai_kontrak" maxlength="14">
            <div id="wnilai_kontrak"></div>
            <label>Kontrak Lama </label>
			<select name="kontrak_lama" id="kontrak_lama" type="text">
                <option value="">Pilih Kontrak Lama</option>
                <?php
                foreach ($this->kon as $kon) {
                    ?>
                    <option value="<?php echo $kon->kd_kontrak; ?>"><?php echo $kon->no_kontrak; ?></option>
                <?php } ?>
            </select><div id="wkontrak_lama"></div>
            <label>File Kontrak* </label><input type="file" name="fupload" id="fupload">
            <div id="wfupload"></div>
        </div>
		</div>
    </form>
</fieldset>
<p class="ui-dialog-content">Keterangan : * Field harus diisi.</p>

<script>
    
    $(document).ready(function(){  
        
        //mengubah inputan nilai kontrak dengan memunculkan separator ribuan
        $('#nilai_kontrak').number(true,0);
        $('#jml_peg').number(true,0);
        
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
        $('#nilai_kontrak').keyup(function() {   
            removeError('wnilai_kontrak');            
        });
        $('#fupload').click(function() {   
            removeError('wfupload');          
        });
    });
    
    
    //melakukan validasi input ketika tombol simpan diklik: tidak boleh kosong
    function cekRekam(){
        var jml = 0;
        var jml2 = 0;
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
        if($('#nilai_kontrak').val()==""){
            viewError('wnilai_kontrak','Nilai kontrak harus diisi');
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
            jml2++;
        }
        
        if(cekAngka($('#nilai_kontrak').val())== false){
            viewError('wnilai_kontrak','Nilai kontrak harus diisi angka');
            jml2++;
        }
        
        if(jml2>0){
            //alert('Isian form belum lengkap');
            return false;
        }
    }

   
</script>