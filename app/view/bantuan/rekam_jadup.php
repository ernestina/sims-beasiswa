<div id="top">
    <h2><a href="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'elemenBeasiswa/viewJadup' ?>">BIAYA TUNJANGAN HIDUP</a> > TAMBAH</h2> <!-- memakai breadcrumb -->

    <form method="POST" action="<?php echo URL; ?>elemenBeasiswa/saveJadup" enctype="multipart/form-data">

        
        <input hidden type="text" name="r_elem" value="1"/>       
        <fieldset>
            <legend>Rekam Biaya Hidup</legend>
            <div class="kolom1">

                <label class="isian">Universitas : </label>
                <select id="universitas" name="universitas" type="text">
                    <?php
                    foreach ($this->univ as $val) {
                        echo "<option value=" . $val->get_kode_in() . ">" . $val->get_nama() . "</option>";
                    }
                    ?> 
                </select>

                <label class="isian">Jurusan/Prodi : </label>
                <select id="kode_jur" name="kode_jur" type="text">
                    <?php
                    foreach ($this->jur as $val2) {
                        echo "<option value=" . $val2->get_kode_jur() . " >" . $val2->get_nama() . "</option>";
                    }
                    ?>
                </select>

                <label class="isian">Tahun Masuk : </label>
                <select name="tahun_masuk" type="text">
                    <?php
                    foreach ($this->kon as $val3) {
                        echo "<option value=" . $val3->thn_masuk_kontrak . " >" . $val3->thn_masuk_kontrak . "</option>";
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
                </ul>
            </div> <!--end kolom1-->
            <div class="kolom2">

                <label class="isian">Biaya Per Pegawai : </label>
                <input disabled type="text" id="biaya_peg" name="biaya_peg" size="12" value="<?php echo $this->jadup ?>" type="text"/>

                <label class="isian">Total Biaya : </label>
                <input type="text" id="total_bayar" name="total_bayar" size="12" value="<?php echo isset($this->d_ubah) ? $this->d_ubah->get_total_bayar() : ''; ?>"/>

                <label class="isian">No. SP2D : </label>
                <input type="text" id="no_sp2d" name="no_sp2d" size="20" value="<?php echo isset($this->d_ubah) ? $this->d_ubah->get_no_sp2d() : ''; ?>"/>

                <label class="isian">Tgl SP2D : </label>
                <input type="text" id="tgl_sp2d" name="tgl_sp2d" size="20" value="<?php echo isset($this->d_ubah) ? $this->d_ubah->get_tgl_sp2d() : ''; ?>"/>

                <label class="isian">File SP2D : </label>
                <input type="file" id="fupload" name="fupload" size="20" />

            </div> <!--end kolom2--> <BR><hr>
            <div>
                <input name="simpan" class="sukses" type="submit" value="simpan"/>
                <input name="batal" class="normal" type="reset" value="batal"/>
            </div>
        </fieldset>
    </form>
    <div id="tabel_penerima_jadup">
        
    </div>
</div>
<scrip type="text/javascript">
    
</scrip>