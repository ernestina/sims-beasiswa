<div>
    DATA KONTRAK KERJASAMA > TAMBAH <!-- pake breadcrumb-->
</div>
<div>
    <form method="POST" action="" enctype="multipart/form-data" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/rekam' ?>">
        <input type="hidden" name="rekam_kontrak">
        <label>Nomor </label><input type="text" name="nomor" id="nomor" size="30"></br>
        <label>Tanggal </label><input type="text" name="tanggal" id="tanggal" size="30" readonly="readonly"></br>
        <label>Universitas </label><select name="univ" id="univ">
            <option value="">Pilih Universitas</option>
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
        <label>Kontrak Lama </label><select>
            <option value="">Pilih Kontrak Lama</option>
            <?php
            foreach ($this->kon as $kon) {
                ?>
                <option value="<?php echo $kon->kd_kontrak; ?>"><?php echo $kon->no_kontrak; ?></option>
            <?php } ?>
        </select>
        <label>File Kontrak </label><input type="file" name="fupload" id="fupload"></br>
        <input type="hidden" name="url" id="url" value="<?php echo URL . 'kontrak/univ/'; ?>">
        <label></label><input type="button" value="BATAL" onClick="location.href='<?php echo URL . 'kontrak/display'; ?>'">
        <input type="submit" name="sb_rekam" id="sb_rekam" value="SIMPAN"></br>
    </form>
</div>
<div>

</div>

<script>
    $(document).ready(function(){
       
        //jika ada event onchange ambil data dari database
        $("#univ").change(function(){
            //ambil nilai univ dan url dari form
            univ = $("#univ").val();
            url = $("#url").val();
            $("#jur").load("<?php echo URL; ?>kontrak/univ/"+univ);
            
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