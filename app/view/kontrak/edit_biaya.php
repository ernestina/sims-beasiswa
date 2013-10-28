<div id="top">
    <h2><a href="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/display' ?>">DATA KONTRAK KERJASAMA</a> > <a href="<?php echo URL . 'kontrak/biaya/' . $this->kontrak->kd_kontrak ?>">BIAYA</a> > UBAH <!-- entar pake breadcrumb--></h2>
    <!--input type="button" value="KEMBALI" onClick="location.href='<?php echo URL . 'kontrak/biaya/' . $this->kontrak->kd_kontrak; ?>'"-->

<div>
    <label class="isian">Nomor / Tanggal Kontrak</label><input type="text" size="50" readonly value="<?php echo $this->kontrak->no_kontrak . " / " . $this->kontrak->tgl_kontrak; ?>" disabled>
    <label class="isian">Program Studi</label><textarea type="text" rows="1" disabled><?php echo $this->nama_jur . " " . $this->nama_univ . " " . $this->kontrak->thn_masuk_kontrak; ?></textarea>
    <label class="isian">Jumlah Pegawai</label><input type="text" size="4" readonly value="<?php echo $this->kontrak->jml_pegawai_kontrak; ?>" disabled>
    <label class="isian">Lama Semester</label><input type="text" size="4" readonly value="<?php echo $this->kontrak->lama_semester_kontrak; ?>" disabled>
<!--    <label class="isian">Nilai Kontrak</label><input type="text" size="14" readonly value="<?php echo number_format($this->kontrak->nilai_kontrak); ?>" disabled>
    <label class="isian">Kontrak Lama</label><input type="text" size="40" readonly value="<?php echo $this->kon_lama; ?>" disabled>-->
</div>
<div>
    <div>
        <fieldset><legend>Data Biaya Utama</legend>
            <?php $this->load('kontrak/form_edit_biaya_utama'); ?>
        </fieldset>
    </div>
    <br />

    <div> 
        <fieldset><legend>Data Tagihan Biaya</legend>
            <?php $this->load('kontrak/form_edit_tagihan'); ?>
        </fieldset>
    </div>
    <br />
    <div>
        <fieldset><legend>Data Pembayaran Tagihan Biaya</legend>
            <?php $this->load('kontrak/form_edit_pembayaran'); ?>
        </fieldset>
    </div>
</div>
</div>

<script>
   
 
</script>