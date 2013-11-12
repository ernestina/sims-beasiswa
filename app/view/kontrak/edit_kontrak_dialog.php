<fieldset>
    <form id="form_edit_kontrak2" method="POST" enctype="multipart/form-data" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/updateKontrak' ?>">
        <input type="hidden" name="update_kontrak">
        <div class="kolom1">
		<div class="kiri">
            <label>Nomor* </label><input type="text" name="nomor" id="nomor" size="30" value="<?php echo $this->data->no_kontrak; ?>">
            <div id="wnomor"></div>
            <label>Tanggal* </label><input type="text" name="tanggal" id="tanggal" size="30" readonly="readonly" value="<?php echo $this->data->tgl_kontrak; ?>">
            <div id="wtanggal"></div>
            <label>Universitas* </label><select name="univ" id="univ" type="text">
                <?php
                foreach ($this->univ as $univ) {
                    $universitas = $this->universitas->get_univ_by_jur($this->data->kd_jurusan);
                    if ($univ->get_kode_in() == $universitas->get_kode_in()) {
                        $select = "selected";
                    } else {
                        $select = "";
                    }
                    ?>
                    <option value="<?php echo $univ->get_kode_in(); ?>" <?php echo $select; ?>><?php echo $univ->get_nama(); ?></option>
                <?php } ?>
            </select><div id="wuniv"></div>
            <label>Jurusan* </label>
            <select name="jur" id="jur">
                <!--                <option value="">Pilih Jurusan</option>-->
                <?php
                foreach ($this->jur as $jur) {
                    if ($jur->get_kode_jur() == $this->data->kd_jurusan) {
                        $select = "selected";
                    } else {
                        $select = "";
                    }
                    
                ?>
                <option value="<?php echo $jur->get_kode_jur(); ?>" <?php echo $select; ?>><?php echo $jur->get_nama(); ?></option>
                <?php } ?>
            </select>
            <div id="wjur"></div>
            <label>Jumlah Pegawai*</label><input type="text" name="jml_peg" id="jml_peg" size="4" value="<?php echo $this->data->jml_pegawai_kontrak; ?>">
            <div id="wjml_peg"></div>
        </div>
		</div>
        <div class="kolom2">
		<div class="kiri">

            <label>Lama Semester*</label><select name="lama_semester" id="lama_semester" type="text">
                <!--                <option value="">Pilih Lama Semester</option>-->
                <?php
                for ($i = 1; $i <= 10; $i++) {
                    if ($i == $this->data->lama_semester_kontrak) {
                        $select = "selected";
                    } else {
                        $select = "";
                    }
                    ?>
                    <option value="<?php echo $i; ?>" <?php echo $select; ?>><?php echo $i; ?></option>
                <?php } ?>
            </select><div id="wlama_semester"></div>

            <label>Tahun Masuk*</label><select name="tahun_masuk" id="tahun_masuk" type="text">
                <!--                <option value="">Pilih Tahun Masuk</option>-->
                <?php
                for ($i = 2007; $i <= date('Y') + 5; $i++) {
                    if ($i == $this->data->thn_masuk_kontrak) {
                        $select = "selected";
                    } else {
                        $select = "";
                    }
                    ?>
                    <option value="<?php echo $i; ?>" <?php echo $select; ?>><?php echo $i; ?></option>
                <?php } ?>
            </select><div id="wtahun_masuk"></div>
            <label>Nilai kontrak* </label><input type="text" name="nilai_kontrak" id="nilai_kontrak" maxlength="14" value="<?php echo number_format($this->data->nilai_kontrak); ?>">
            <div id="wnilai_kontrak"></div>
            <label>Kontrak Lama </label>
            <input type="hidden" id="kon_def" name="kon_def" value="<?php echo $this->data->kontrak_lama; ?>">
            <select name="kontrak_lama" id="kontrak_lama">  
                <option value="">Pilih kontrak lama</option>
                 <?php
                foreach ($this->kon as $kon) {
                    if ($kon->kd_kontrak == $this->data->kontrak_lama) {
                        $select = "selected";
                    } else {
                        $select = "";
                    }
                    
                ?>
                <option value="<?php echo $kon->kd_kontrak; ?>" <?php echo $select; ?>><?php echo $kon->no_kontrak; ?></option>
                <?php } ?>
            </select>
            <div id="wkontrak_lama" name="wkontrak_lama">
                
				<label>File Kontrak </label>
			<table style="margin-left: -10px">
				<tr>
					<td>
					<div id="wfupload"></div>
					<input type="file" name="fupload" id="fupload" style="width: 170px">
					</td>
					<td><a href="<?php echo URL . "kontrak/file/" . $this->data->file_kontrak; ?>" target="kontrak_edit" onClick="cetak_dokumen('kontrak_edit');" style="background-color: #49afcd; padding: 12px 10px 7px; border-radius: 3px"><i class="icon-search icon-white"></i></a></td>
				</tr>
			</table>
				<!--input type="file" name="fupload" id="fupload" class="unggah">
				<div id="wfupload"></div>
                
				<a href="<?php //echo URL . "kontrak/file/" . $this->data->file_kontrak; ?>" target="_blank"><i class="icon-search"></i>Lihat file</a-->
			
                <input type="hidden" name="jur_def" id="jur_def" value="<?php echo $this->data->kd_jurusan; ?>">
                <input type="hidden" name="kd_kontrak" id="kd_kontrak" value="<?php echo $this->data->kd_kontrak; ?>">
                <input type="hidden" name="fupload_lama" id="fupload_lama" value="<?php echo $this->data->file_kontrak; ?>">
			</div>
            </div>
    </form>
</fieldset>
<p>Keterangan : * Field harus diisi.</p>

<script>
    
  
 
    
    $(document).ready(function(){ 
        
        //mengubah inputan nilai kontrak dengan memunculkan separator ribuan
        $('#nilai_kontrak').number(true,0);
               
        //agar ketika universitas berubah karena dipilih, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $("#univ").change(function(){
            $.post("<?php echo URL; ?>kontrak/get_jur_by_univ", {univ:$("#univ").val()},
            function(data){    
                $('#jur').empty();
                $('#jur').html(data);
                $('#kontrak_lama').html('<option value="">Pilih kontrak lama</option>');
            }); 
            
        });
        
        //menampilkan list data kontrak lama
        $("#jur").change(function(){
            $.post("<?php echo URL; ?>kontrak/getSelectByJur", {jur:$("#jur").val(),kon_def:$("#kon_def").val()},
            function(data){                
                $('#kontrak_lama').empty();
                $('#kontrak_lama').html(data);
            });  
        });
        
        //menampilkan datepicker   
        $(function() { 
            $("#tanggal").datepicker({
				dateFormat: "dd-mm-yy",
                changeMonth: true,
				changeYear: true
				
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
    function cekEdit(){
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
        if($('#fupload').val()=="" && $('#fupload_lama').val()==""){
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