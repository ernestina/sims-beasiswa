<div id="top">
    <h2><a href="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'elemenBeasiswa/viewJadup' ?>">BIAYA TUNJANGAN HIDUP</a> > TAMBAH</h2> <!-- memakai breadcrumb -->
</div>

<div class="fitur">
    <fieldset><legend>Rekam Biaya Hidup</legend>
        <form method="POST" action="<?php echo URL; ?>elemenBeasiswa/saveJadup" enctype="multipart/form-data">
            <input  type="hidden" name="r_elem" value="1"/>       
            <div>

                <label class="isian">Universitas : </label>
                <select id="kode_univ" name="kode_univ">
                    <option value="">Pilih Universitas</option>
                    <?php
                    foreach ($this->univ as $val) {
                        echo "<option value=" . $val->get_kode_in() . ">" . $val->get_nama() . "</option>";
                    }
                    ?> 
                </select>

                <label class="isian">Jurusan/Prodi : </label>
                <select id="kode_jur" name="kode_jur">
                    <option value="">Pilih Jurusan</option>
                </select>

                <label class="isian">Tahun Masuk : </label>
                <select name="tahun_masuk" id="tahun_masuk">
                    <option value="">Pilih Tahun masuk</option>
                    <?php
                    for ($i = 2007; $i < date('Y') + 2; $i++) {

                        echo "<option value=" . $i . " >" . $i . "</option>";
                    }
                    ?>
                </select>

                <label class="isian">Bulan dan Tahun : </label>
                <ul class="inline">
                    <li><select id="bln" name="bln" style="width: 105px">
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
                    <li><select id="thn" name="thn" style="width: 100px">
                            <?php
                            for ($i = 2007; $i < date('Y') + 2; $i++) {
                                if ($i == date('Y')) {
                                    echo "<option value=" . $i . " selected>" . $i . "</option>";
                                } else {
                                    echo "<option value=" . $i . " >" . $i . "</option>";
                                }
                            }
                            ?>
                        </select></li>
                </ul>
            </div> <!--end kolom1-->
            <div>

                <label class="isian">Biaya Per Pegawai : </label>
                <input readonly type="text" id="biaya_peg" name="biaya_peg" size="12" value="<?php echo $this->jadup ?>" type="text"/>

                <label class="isian">Total Biaya : </label>
                <input readonly type="text" id="total_bayar" name="total_bayar" size="12" value="<?php echo isset($this->d_ubah) ? $this->d_ubah->get_total_bayar() : ''; ?>"/>

                <label class="isian">No. SP2D : </label>
                <input type="text" id="no_sp2d" name="no_sp2d" size="20" value="<?php echo isset($this->d_ubah) ? $this->d_ubah->get_no_sp2d() : ''; ?>"/>

                <label class="isian">Tgl SP2D : </label>
                <input type="text" id="tgl_sp2d" name="tgl_sp2d" size="20" value="<?php echo isset($this->d_ubah) ? $this->d_ubah->get_tgl_sp2d() : ''; ?>"/>

                <label class="isian">File SP2D : </label>
                <input type="file" id="fupload" name="fupload" size="20" />

            </div> <!--end kolom2--> 
            <br/>
            <div id="tabel_penerima_jadup"> </div>
            <div>
                <input name="simpan" class="sukses" type="submit" value="simpan"/>
                <input name="batal" class="normal" type="reset" value="batal"/>
            </div>
        </form>
    </fieldset>
</div>


<script type="text/javascript">
    
       
    //mengubah inputan  dengan memunculkan separator ribuan
    $('#biaya_peg').number(true,0);
    $('#total_bayar').number(true,0);
        
    $(document).ready(function(){ 
                
        //menampilkan data jurusan berdasarkan universitas
        $('#kode_univ').change(function(){
            //alert ($('#kode_univ').val());
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>elemenBeasiswa/get_jur_by_univ",
                data: {univ:$('#kode_univ').val()},
                success: function(jurusan){
                    $('#kode_jur').html(jurusan);
                }
            });
            
            $('#tabel_penerima_jadup').empty();
            $("#total_bayar").val('0');
        })
        
        //menampilkan data penerima jadup
        $('#kode_jur').change(function(){
            //alert ($('#kode_univ').val());
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>elemenBeasiswa/tabel_penerima_jadup",
                data: {kd_jurusan:$('#kode_jur').val(),thn_masuk:$('#tahun_masuk').val()},
                success: function(jadup){
                    $('#tabel_penerima_jadup').html(jadup);
                }
            });
            
            $("#total_bayar").val('0');
        })
        
        $('#tahun_masuk').change(function(){
            //alert ($('#kode_univ').val());
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>elemenBeasiswa/tabel_penerima_jadup",
                data: {kd_jurusan:$('#kode_jur').val(),thn_masuk:$('#tahun_masuk').val()},
                success: function(jadup){
                    $('#tabel_penerima_jadup').html(jadup);
                }
            });
            $("#total_bayar").val('0');
        })
                           
    })
        
</script>