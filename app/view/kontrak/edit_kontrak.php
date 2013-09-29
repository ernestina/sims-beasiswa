<div id="top">
    <h2><a href="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/display' ?>">DATA KONTRAK KERJASAMA</a> > UBAH</h2> <!-- pake breadcrumb-->

<div class="kolom3">
   <fieldset><legend>Ubah Kontrak</legend>
	<div class="kiri">
    <form method="POST" enctype="multipart/form-data" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/updateKontrak' ?>">
        <input type="hidden" name="update_kontrak">
        <label>Nomor </label><input type="text" name="nomor" id="nomor" size="30" value="<?php echo $this->data->no_kontrak; ?>">
        <label>Tanggal </label><input type="text" name="tanggal" id="tanggal" size="30" readonly="readonly" value="<?php echo $this->data->tgl_kontrak; ?>">
        <label>Universitas </label><select name="univ" id="univ">

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
        </select>
        <label>Jurusan </label>
        <select name="jur" id="jur">
            <option value="">Pilih Jurusan</option>
        </select>
        <label>Jumlah Pegawai</label><input type="text" name="jml_peg" id="jml_peg" size="4" value="<?php echo $this->data->jml_pegawai_kontrak; ?>"></br>
        <label>Lama Semester</label><select name="lama_semester">
            <option value="">Pilih Lama Semester</option>
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
        </select>
        
        <label>Tahun Masuk</label><select name="tahun_masuk">
            <option value="">Pilih Tahun Masuk</option>
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
        </select>
        <label>Kontrak Lama </label><select name="kontrak_lama">
            <option value="">Pilih Kontrak Lama</option>
            <?php
            foreach ($this->kon as $kon) {
                if ($i == $this->data->kontrak_lama) {
                    $select = "selected";
                } else {
                    $select = "";
                }
                ?>
                <option value="<?php echo $kon->kd_kontrak; ?>" <?php echo $select; ?>><?php echo $kon->no_kontrak; ?></option>
            <?php } ?>
        </select>
        <label>File Kontrak </label><input type="file" name="fupload" id="fupload">  
        <a href="<?php echo URL . "kontrak/file/" . $this->data->file_kontrak; ?>" target="_blank"><?php echo $this->data->file_kontrak; ?></a>
        
        <input type="hidden" name="jur_def" id="jur_def" value="<?php echo $this->data->kd_jurusan; ?>">
        <input type="hidden" name="kd_kontrak" id="kd_kontrak" value="<?php echo $this->data->kd_jurusan; ?>">
        <input type="hidden" name="fupload_lama" id="fupload_lama" value="<?php echo $this->data->file_kontrak; ?>">
        <ul class="inline tengah">
            <li><input type="button" class="normal" value="BATAL" onClick="location.href='<?php echo URL . 'kontrak/display'; ?>'"></li>
            <li><input type="submit" class="sukses" value="SIMPAN"></li>
        </ul>




		</div>
    </form>
   </fieldset>
</div>
</div>
<script>
    
   
    univ = $("#univ").val();
    jur_def = $("#jur_def").val();
    $.post("<?php echo URL; ?>kontrak/get_jur_by_univ", {univ:univ,jur_def:jur_def},
    function(data){                
        $('#jur').html(data);
    });
            
       
     
    $(document).ready(function(){ 
        $("#univ").change(function(){
            univ = $("#univ").val();
            $.post("<?php echo URL; ?>kontrak/get_jur_by_univ", {univ:univ},
            function(data){                
                $('#jur').html(data);
            });
            
        });
    })
    
    $(function() { 
        $("#tanggal").datepicker({dateFormat: "dd-mm-yy"
            //            buttonImage:'images/calendar.gif',
            //            buttonImageOnly: true,
            //            showOn: 'button'
        }); 
    });
</script>