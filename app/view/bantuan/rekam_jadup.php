<div id="top">
    <h2><a href="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'elemenBeasiswa/viewJadup' ?>">BIAYA TUNJANGAN HIDUP</a> > TAMBAH</h2> <!-- memakai breadcrumb -->

    <form method="POST" action="
          <?php
                echo URL.'elemenBeasiswa/viewJadup'
          ?>
          " enctype="multipart/form-data">
        <?php 
            if(isset($this->d_ubah)){
                echo "<input type='hidden' name='kode_d' id='kode_d' value=".$this->d_ubah->get_kd_d().">";
            }
        ?>
		
        <input type="hidden" id="kode_r" name="kode_r" size="12" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_kd_r():'1';?>">
        <input type="hidden" id="jml_peg" name="jml_peg" size="12" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_jml_peg():'';?>">
   <fieldset><legend>Rekam Biaya Hidup</legend>
	<div class="kolom1">
		
			<label class="isian">Universitas : </label>
				<select id="universitas" name="universitas" type="text">
					<?php 
						foreach ($this->fakul as $val){
                        echo "<option value=".$val->get_kode_fakul()." >".$val->get_kode_univ()." - ".$val->get_nama()."</option>";
						}
					?> 
				</select>
			
			<label class="isian">Jurusan/Prodi : </label>
				<select id="kode_jur" name="kode_jur" type="text">
                        <?php 
                            foreach ($this->jur as $val2){
                                echo "<option value=".$val2->get_kode_jur()." >".$val2->get_nama()."</option>";
                            }
                        ?>
				</select>
			
			<label class="isian">Tahun Masuk : </label>
				<select type="text">
                        <?php 
                            foreach ($this->kon as $val3){
                                echo "<option value=".$val3->thn_masuk_kontrak." >".$val3->thn_masuk_kontrak."</option>";
                            }
                        ?>
				</select>
			
			<label class="isian">Bulan dan Tahun : </label>
				<ul class="inline">
                        <li><select id="bln" name="bln" style="width: 105px" type="text">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">Nopember</option>
                            <option value="12">Desember</option>
                        </select></li>
                        <li><select id="thn" name="thn" style="width: 100px" type="text">
                            <option value="2012">2012</option>
                            <option value="2013">2013</option>
                            <option value="2014">2014</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                        </select></li>
			
	</div> <!--end kolom1-->
	<div class="kolom2">
		
			<label class="isian">Biaya Per Pegawai : </label>
			<input disabled type="text" id="biaya_peg" name="biaya_peg" size="12" value="520.000" type="text">
			
			<label class="isian">Total Biaya : </label>
                        <input type="text" id="total_bayar" name="total_bayar" size="12" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_total_bayar():'';?>">
			
			<label class="isian">No. SP2D : </label>
                        <input type="text" id="no_sp2d" name="no_sp2d" size="20" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_no_sp2d():'';?>">
			
			<label class="isian">Tgl SP2D : </label>
                        <input type="text" id="tgl_sp2d" name="tgl_sp2d" size="20" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_tgl_sp2d():'';?>">
			
			<label class="isian">File SP2D : </label>
                        <input type="file" id="fupload" name="fupload" size="20" >
					
	</div> <!--end kolom2--> <BR><hr>
  </fieldset> 
<br>
<div style="float: right">
	<button href="#"><i class="icon-print icon-white"></i> &nbsp  CETAK</button>
	
</div><br><br><br>
  
  <fieldset><legend>Data Penerima Tunjangan Hidup</legend>

    <table class="table-bordered zebra">
        <thead>
            <th width= '3%'>No</th>
            <th width= '20%'>Nama/NIP</th>
            <th width= '15%'>Gol</th>
            <th width= '15%'>Status</th>
            <th width= '5%'>Jumlah Hari Masuk</th>
            <th width= '10%'>Jumlah Kotor</th>
            <th width= '10%'>Pajak</th>
            <th width= '10%'>Jumlah Bersih</th>
            <th width= '5%'>Bank Penerima</th>
            <th width= '5%'>No. Rekening</th>
            <th width= '5%'>Pilih</th>
        </thead>
        <tbody style="text-align: center">
            <?php
                $no = 1;
                foreach ($this->pb as $val4){
                    if ($val4->get_jur()==$this->d_ubah->get_kd_jur()){
                        echo "<tr>";
                        echo "<td>$no</td>";
                        echo "<td>".$val4->get_nama()." / ".$val4->get_nip()."</td>";
                        echo "<td>".Golongan::golongan_int_string($val4->get_gol())."</td>";
                        echo "<td>".StatusPB::status_int_string($val4->get_status())."</td>";
                        $jml_jadup=520000;
                        $jml_hr_msk=100;
                        echo "<td width= '10%'>".$jml_hr_msk." %</td>";
                        $jml_kotor=($jml_hr_msk*$jml_jadup/100);
                        echo "<td>Rp. ".$jml_kotor."</td>";
                        $pajak=0;
                        if ($val4->get_gol()>30){
                            $pajak=5;
                        }
                        $jml_pajak=($pajak*$jml_kotor/100);
                        echo "<td>Rp. ".$jml_pajak."</td>";
                        $jml_bersih = ($jml_kotor-$jml_pajak);
                        echo "<td>Rp. ".$jml_bersih."</td>";
                        echo "<td>".$val4->get_bank()."</td>";
                        echo "<td>".$val4->get_no_rek()."</td>";
            ?>
                        <td width= '5%'><input class= "mini" type="checkbox" id="setuju" name="setuju" value=""></td>
            <?php
                        $no++;
                    }
                }
            ?>         
        </tbody>
    </table>


    <!--div style="margin-left: 20px">Keterangan : *Data harus diisi</div-->
    <div>
		<ul class= "inline" style="float: right; margin-right: 20px; margin-top: 10px">
			<li><input class="normal" type="submit" onclick="" value="BATAL"></li>
			<li><input class="sukses" type="submit" name="<?php echo isset($this->d_ubah)?'update_elem':'add_elem';?>" value="SIMPAN" onClick="return cek();"></li>
		</ul>
    </div>

    </form>
</div>
</div>