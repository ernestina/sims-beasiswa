<div>
    DATA KONTRAK KERJASAMA > BIAYA > UBAH <!-- entar pake breadcrumb-->
    <input type="button" value="KEMBALI" onClick="location.href='<?php echo URL . 'kontrak/biaya/' . $this->kontrak->kd_kontrak; ?>'">
</div>
<!--<div>
    <label>Nomor / Tgl Kontrak</label><input type="text" size="50"></br>
    <label>Program Studi</label><input type="text" size="70"></br>
    <label>Jumlah Pegawai</label><input type="text" size="4">
    <label>Lama Semester</label><input type="text" size="4">
</div>-->
<div>
    <div>
        <?php $this->load('kontrak/form_edit_biaya_utama'); ?>
    </div>
    <div> 
        <?php $this->load('kontrak/form_edit_tagihan'); ?>
    </div>
    <div class="kolom1">
        <?php $this->load('kontrak/form_edit_pembayaran'); ?>
    </div>
</div>


<script>
   
 
</script>