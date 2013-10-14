<div>
    BIAYA BUKU > TAMBAH <!-- memakai breadcrumb -->
</div>
<div>
    <form method="POST" action="<?php
echo URL;
'elemenBeasiswa/viewUangBuku'
?> " enctype="multipart/form-data">
              <?php
              if (isset($this->d_ubah)) {
                  echo "<input type='hidden' name='kode_d' id='kode_d' value=" . $this->d_ubah->get_kd_d() . ">";
              }
              ?>
        <div>
            <input type="hidden" id="kode_r" name="kode_r" size="12" value="<?php echo isset($this->d_ubah) ? $this->d_ubah->get_kd_r() : '2'; ?>">
            <input type="hidden" id="jml_peg" name="jml_peg" size="12" value="<?php echo isset($this->d_ubah) ? $this->d_ubah->get_jml_peg() : ''; ?>">
            <fieldset>
                <table>
                    <tr>
                        <td>
                            <label>Universitas : </label>
                            <select type="text" id="universitas" name="universitas">
                                <?php
                                foreach ($this->univ as $val) {
                                    echo "<option value=" . $val->get_kode_in() . " >" . $val->get_nama() . "</option>";
                                }
                                ?> 
                            </select>
                            <label>Jurusan/Prodi : </label>
                            <select type="text" id="jurusan" name="jurusan">
                                <?php
                                foreach ($this->jur as $val2) {
                                    echo "<option value=" . $val2->get_kode_jur() . " >" . $val2->get_nama() . "</option>";
                                }
                                ?>
                            </select>
                            <label>Tahun Masuk : </label>
                            <select type="text" name="tahun_masuk">
                                <?php
                                foreach ($this->kon as $val3) {
                                    echo "<option value=" . $val3->thn_masuk_kontrak . " >" . $val3->thn_masuk_kontrak . "</option>";
                                }
                                ?>
                            </select>
                        </td>
                        <td>
                            <label>Semester dan Tahun : </label>
                            <select type="text" id="bln" name="bln" >
                                <option value="1">Semester I</option>
                                <option value="2">Semester II</option>
                            </select>
                            <select type="text" id="thn" name="thn">
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                            </select>
                            <label>Biaya Per Pegawai : </label>
                            <input disabled type="text" id="biaya_buku" name="biaya_buku" size="12" value="<?php echo $this->buku ?>"/>
                            <label>Total Biaya : </label>
                            <input type="text" id="total_bayar" name="total_bayar" size="12" value="<?php echo isset($this->d_ubah) ? $this->d_ubah->get_total_bayar() : ''; ?>">
                        </td>
                        <td>
                            <label>No. SP2D : </label>
                            <input type="text" id="no_sp2d" name="no_sp2d" size="20" value="<?php echo isset($this->d_ubah) ? $this->d_ubah->get_no_sp2d() : ''; ?>"/>
                            <label>Tgl SP2D : </label>
                            <input type="text" id="tgl_sp2d" name="tgl_sp2d" size="20" value="<?php echo isset($this->d_ubah) ? $this->d_ubah->get_tgl_sp2d() : ''; ?>"/>
                            <label>File SP2D : </label>
                            <input type="file" id="fupload" name="fupload" size="20" />
                        </td>
                    </tr>
                </table>
                <div>
                    <input type="submit" name="simpan" value="simpan" class="sukses"/>
                    <input type="reset" name="baral" value="batal" class="normal">
                </div>
            </fieldset>
        </div>

        <div>
            <div>Data Penerima Biaya Buku</div>
            <div>file link print</div>
        </div>


    </form>
</div>
<div id="tabel_penerima_buku">
    
</div>
