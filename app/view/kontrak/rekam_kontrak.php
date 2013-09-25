<div>
    DATA KONTRAK KERJASAMA > TAMBAH <!-- pake breadcrumb-->
</div>
<div class="kolom3">
    <form method="POST" enctype="multipart/form-data" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/rekamKontrak' ?>">
        <input type="hidden" name="rekam_kontrak">
        <label>Nomor </label><input type="text" name="nomor" id="nomor" size="30"></br>
        <label>Tanggal </label><input type="text" name="tanggal" id="tanggal" size="30" readonly="readonly"></br>
        <label>Universitas </label><select name="univ" id="univ">
            <option value="" select>Pilih Universitas</option>
            <?php
            foreach ($this->univ as $univ) {
                ?>
                <option value="<?php echo $univ->get_kode_in(); ?>"><?php echo $univ->get_nama(); ?></option>
            <?php } ?>
        </select></br>
        <label>Jurusan </label><select name="jur" id="jur">
            <option value="">Pilih Jurusan</option>
        </select></br>
        <label>Jumlah Pegawai</label><input type="text" name="jml_peg" id="jml_peg" size="4"></br>
        <label>Lama Semester</label><select name="lama_semester">
            <option value="">Pilih Lama Semester</option>
            <?php
            for ($i = 1; $i <= 10; $i++) {
                ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
        </br>
        <label>Tahun Masuk</label><select name="tahun_masuk">
            <option value="">Pilih Tahun Masuk</option>
            <?php
            for ($i = 2007; $i <= date('Y') + 5; $i++) {
                ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
        </select></br>
        <label>Kontrak Lama </label><select name="kontrak_lama">
            <option value="">Pilih Kontrak Lama</option>
            <?php
            foreach ($this->kon as $kon) {
                ?>
                <option value="<?php echo $kon->kd_kontrak; ?>"><?php echo $kon->no_kontrak; ?></option>
            <?php } ?>
        </select>
        <label>File Kontrak </label><input type="file" name="fupload" id="fupload"></br>
        
        <ul class="inline tengah">
            <li><input type="button" class="normal" value="BATAL" onClick="location.href='<?php echo URL . 'kontrak/display'; ?>'"></li>
            <li><input type="submit" class="sukses" name="sb_rekam" id="sb_rekam" value="SIMPAN"></li>
        </ul>


    </form>
</div>

<script>
    $("#univ").change(function(){
        univ = $("#univ").val();
        $.post("<?php echo URL; ?>kontrak/get_jur_by_univ", {univ:univ},
        function(data){                
            $('#jur').html(data);
        });
            
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