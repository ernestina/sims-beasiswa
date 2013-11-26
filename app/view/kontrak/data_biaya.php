
<div id="top">
    <h2><a href="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/display' ?>">DATA KONTRAK KERJASAMA</a> > BIAYA</h2> <!-- ntar pake breadcrumb -->
    <!--input type="button" value="KEMBALI" onClick="location.href='<?php echo URL . 'kontrak/display'; ?>'"-->

            <label class="isian">Nomor / Tanggal Kontrak</label><input type="text" size="50" readonly value="<?php echo $this->data_kontrak->no_kontrak . " / " . $this->data_kontrak->tgl_kontrak; ?>" disabled>
            <label class="isian">Program Studi</label><textarea type="text" rows="1" disabled><?php echo $this->nama_jur . " " . $this->nama_univ . " " . $this->data_kontrak->thn_masuk_kontrak; ?></textarea>
            <label class="isian">Jumlah Pegawai</label><input type="text" size="4" readonly value="<?php echo $this->data_kontrak->jml_pegawai_kontrak; ?>" disabled>
            <label class="isian">Lama Semester</label><input type="text" size="4" readonly value="<?php echo $this->data_kontrak->lama_semester_kontrak; ?>" disabled>
            <label class="isian">Nilai Kontrak</label><input type="text" size="14" readonly value="<?php echo number_format($this->data_kontrak->nilai_kontrak); ?>" disabled>
            <label class="isian">Kontrak Lama</label><input type="text" size="40" readonly value="<?php echo $this->kon_lama; ?>" disabled>
       
<!--            <input type="button" value="TAMBAH" onClick="location.href='<?php echo URL . 'kontrak/viewRekamBiaya/' . $this->data_kontrak->kd_kontrak; ?>'">-->
            <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/viewRekamBiaya' ?>">
            <input type="hidden" id="kd_kontrak" name="kd_kontrak" value="<?php echo $this->data_kontrak->kd_kontrak; ?>">
		<table width="95%">
			<tr><td align="right">
			<?php 
					if(Session::get('role')==2){
					?>
			<button onClick="formSubmit" id="tambah_kontrak" style="margin-top:0px; margin-right: -8px" title="Rekam biaya kontrak"><i class="icon-plus icon-white"></i> Tambah</button>
			<?php } ?>
			<!--input class="biru" type="submit" value="TAMBAH" -->
			</td></tr>
		</table>
            </form>
       

    <div id="table-content">
        <table class="table-bordered zebra scroll" id="table">
            <thead>
            <th width="4%">No</th>
            <th width="20%">Nama Biaya</th>
            <th width="10%">Biaya per Pegawai</th>
            <th width="5%">Jumlah Pegawai <br/>dibayarkan</th>
            <th width="10%">Total Biaya</th>
            <th width="5%">Jadwal <br />dibayarkan</th>
            <th width="5%">No SP2D</th>
            <th width="5%">Tgl SP2D</th>
            <th width="5%">Status <br />Pembayaran</th>
			<th width="7%"><?php if(Session::get('role')==2){ echo "Aksi";} else { echo "Dokumen/file";} ?></th>
            </thead>
		<tbody style="text-align: center">

            <?php
            $i = 1;
            foreach ($this->data_biaya as $val) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td style="text-align: left"><?php echo $val->nama_biaya; ?></td>
                    <td style="text-align: right"><?php echo number_format($val->biaya_per_pegawai); ?></td>
                    <td><?php echo $val->jml_pegawai_bayar; ?></td>
                    <td style="text-align: right"><?php echo number_format($val->jml_biaya); ?></td>
                    <td><?php echo $val->jadwal_bayar; ?></td>
                    <td><?php $x = ($val->no_sp2d != "") ? $val->no_sp2d : "-"; echo $x; ?></td>
                    <td><?php
            if ($val->tgl_sp2d != "01-01-1970" && $val->tgl_sp2d != "00-00-0000") {
                echo $val->tgl_sp2d;
            } else {
                echo "-";
            }
                ?></td>
                    <td><?php echo $val->status_bayar; ?></td>
					
                    <td>
					<?php 
					if(Session::get('role')==2){
					?>
                        <a href="<?php echo URL . "kontrak/delBiaya/" . $val->kd_biaya; ?>" onClick="return del('<?php echo $val->nama_biaya; ?>');" title="hapus"><i class="icon-trash"></i></a> &nbsp
                        <a href="<?php echo URL . "kontrak/editBiaya/" . $val->kd_biaya; ?> " title="ubah"><i class="icon-pencil"></i></a>
                    <?php } else { 
					
						//file bast
						$file_bast = $val->file_bast;
						if ($file_bast != "") {
							$file_bast_ = $file_bast;
						} else {
							$file_bast_ = "";
						}
											
						//file bap
						$file_bap = $val->file_bap;
						if ($file_bap != "") {
							$file_bap_ = $file_bap;
						} else {
							$file_bap_ = "";
						}
						
						//file ringkasan kontrak
						$file_ring_kontrak = $val->file_ring_kontrak;
						if ($file_ring_kontrak != "") {
							$file_ring_kontrak_ = $file_ring_kontrak;
						} else {
							$file_ring_kontrak_ = "";
						}
						
						//file kuitansi
						$file_kuitansi = $val->file_kuitansi;
						if ($file_kuitansi != "") {
							$file_kuitansi_ = $file_kuitansi;
						} else {
							$file_kuitansi_ = "";
						}
						
						//file sp2d
						$file_sp2d = $val->file_sp2d;
						if ($file_sp2d != "") {
							$file_sp2d_ = $file_sp2d;
						} else {
							$file_sp2d_ = "";
						}
						?>
						
						<a href="<?php echo URL . "kontrak/fileBast/" . $file_bast_; ?>"target="file_bast" onClick="cetak_dokumen('file_bast');" title="BAST"><?php if ($file_bast_ != "") echo "BS"; ?></a>
						<a href="<?php echo URL . "kontrak/fileBap/" . $file_bap_; ?>"target="file_bap" onClick="cetak_dokumen('file_bap');" title="BAP"><?php if ($file_bap_ != "") echo "BP"; ?></a>
						<a href="<?php echo URL . "kontrak/fileRingKontrak/" . $file_ring_kontrak_; ?>"target="file_ring" onClick="cetak_dokumen('file_ring');" title="ringkasan Kontrak"><?php if ($file_ring_kontrak_ != "") echo "RK"; ?></a>
						<a href="<?php echo URL . "kontrak/fileKuitansi/" . $file_kuitansi_; ?>"target="file_kuitansi" onClick="cetak_dokumen('file_kuitansi');" title="Kwitansi"><?php if ($file_kuitansi_ != "") echo "KW"; ?></a>
						<a href="<?php echo URL . "kontrak/fileSp2d/" . $file_sp2d_; ?>"target="file_sp2d" onClick="cetak_dokumen('file_sp2d');" title="SP2D"><?php if ($file_sp2d_ != "") echo "SP"; ?></a>
					<?php } ?>
					</td>
					
                </tr>
                <?php
                $i++;
            }
            if (!empty($this->data_biaya)) {
                echo "<tr style=\"font-size: 120%\">
                <td colspan=8 align=\"right\"><strong>Total biaya:</strong></td>
                <td colspan=2 align=\"right\"><strong>" . number_format($this->total_biaya) . "</strong></td>
                </tr>";
            } else {
                echo "<tr><td colspan=10>Biaya tidak ditemukan.</td></tr>";
            }
            ?>
        </tbody>
		</table>
    </div>
</div>

<script>
    //konfirmasi hapus biaya
    function del(biaya){
	 var txt = "Yakin data biaya "+biaya+" akan dihapus?";
        if(confirm(txt))
            return true;
        else return false
    }
</script>