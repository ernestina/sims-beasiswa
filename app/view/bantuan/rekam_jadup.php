<div id="top">
    <h2><a href="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'elemenBeasiswa/viewJadup' ?>">BIAYA TUNJANGAN HIDUP</a> > TAMBAH</h2> <!-- memakai breadcrumb -->


<div class="fitur">
    <fieldset><legend>Rekam Biaya Hidup</legend>
	<div class="kolom1">
        <form method="POST" onSubmit="return cekField();" action="<?php echo URL; ?>elemenBeasiswa/saveJadup" enctype="multipart/form-data">
            <noscript>
            <input  type="hidden" name="js" value="1" />
            </noscript>
            <input type="hidden" name="rekam_jadup"/> 
            <input type="hidden" name="r_elem" value="1"/>       
            <div>
                <div id="wkode_univ"></div>
                <label class="isian">Universitas : </label>
                <select id="kode_univ" name="kode_univ" type="text">
                    <option value="">Pilih Universitas</option>
                    <?php
                    foreach ($this->univ as $val) {
                        echo "<option value=" . $val->get_kode_in() . ">" . $val->get_nama() . "</option>";
                    }
                    ?> 
                </select>
                <div id="wkode_jur"></div>
                <label class="isian">Jurusan/Prodi : </label>
                <select id="kode_jur" name="kode_jur" type="text">
                    <option value="">Pilih Jurusan</option>
                </select>
                <div id="wtahun_masuk"></div>
                <label class="isian">Tahun Masuk : </label>
                <select id="tahun_masuk" name="tahun_masuk" type="text">
                    <option value="">Pilih Tahun masuk</option>   
                </select>
                <div id="wbln"></div>
                <div id="wthn"></div>
                <label class="isian">Bulan dan Tahun : </label>
                <ul class="inline">
                    <li><select id="bln" name="bln" style="width: 105px" type="text">
                             <option value="">Pilih Bulan</option>
                            <?php
                            for($i=1; $i<=12; $i++){
                              if($i==date('m')){
                                  $select="selected";
                              } else {
                                  $select="";
                              } 
                              
                              echo "<option value=\"".$i."\" $select>".Tanggal::bulan_indo($i)."</option>";
                            }
                            ?>

                            <!--                            <option value="">Pilih Bulan</option>
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
                                                        <option value="12">Desember</option>-->
                        </select></li>
                    <li><select id="thn" name="thn" style="width: 100px" type="text">
                            <option value="">Pilih Tahun</option>
                            <?php
//                            for ($i = 2007; $i < date('Y') + 2; $i++) {
//                                if ($i == date('Y')) {
//                                    echo "<option value=" . $i . " selected>" . $i . "</option>";
//                                } else {
//                                    echo "<option value=" . $i . " >" . $i . "</option>";
//                                }
//                            }
                            ?>
                        </select></li>
                </ul>
            </div> <!--end kolom1-->
		</div>
            <div class="kolom2">
                <div id="wbiaya_jadup"></div>
                <label class="isian">Biaya Per Pegawai : </label>
                <input type="text" id="biaya_peg" name="biaya_peg" size="12" />
                <div id="wtotal_biaya"></div>
                <label class="isian">Total Biaya : </label>
                <input readonly type="text" id="total_bayar" name="total_bayar" size="12"/>

                <label class="isian">No. SP2D : </label>
                <input type="text" disabled />
                <input type="hidden" id="no_sp2d" name="no_sp2d" size="20" />

                <label class="isian">Tgl SP2D : </label>
                <input type="text" disabled />
                <input type="hidden" id="tgl_sp2d" name="tgl_sp2d" size="20"/>

                <label class="isian">File SP2D : </label>
                <input type="file" disabled />
                <input type="hidden" id="fupload" name="fupload" size="20" />

            </div> <!--end kolom2--> 
            <div>
                <ul class="inline" style="float: right; margin-right: 20px">
                    <li><button type="submit" name="simpan" class="sukses" onClick="formSubmit();"/><i class="icon-ok icon-white"></i>Simpan</button></li>
                    <li><button type="reset" name="batal" class="normal" onClick="location.href='<?php echo URL . "elemenBeasiswa/viewJadup"; ?>'"><i class="icon-remove icon-white"></i>Batal</li>
                </ul>
            </div>
		</fieldset>
            <br/>
		<fieldset><legend>Daftar Penerima Tunjangan Hidup</legend>
            <div id="wtabel_penerima_jadup"> </div>
            <div id="tabel_penerima_jadup"> </div>
		</fieldset>
        </form>
    
</div>
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
        
        //menampilkan daftar tahun
        $('#kode_jur').change(function(){
            //alert ($('#kode_jur').val());
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>elemenBeasiswa/get_thn_masuk_by_jur",
                data: {kd_jurusan:$('#kode_jur').val()},
                success: function(thn_masuk){
                    $('#tahun_masuk').html(thn_masuk);
                }
            });
            
            $("#total_bayar").val('0');
        })
        
        
        //menampilkan data tahun
        $('#tahun_masuk').change(function(){
            //alert ($('#kode_tahun_masuk').val());
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>elemenBeasiswa/get_thn_bayar",
                data: {thn:$('#tahun_masuk').val()},
                success: function(thn){
                    $('#thn').html(thn);
                }
            });
            
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>elemenBeasiswa/tabel_penerima_jadup",
                data: {kd_jurusan:$('#kode_jur').val(),thn_masuk:$('#tahun_masuk').val(),bln:$('#bln').val(),thn:$('#thn').val()},
                success: function(jadup){
                    $('#tabel_penerima_jadup').html(jadup);
                }
            });
            
            $("#total_bayar").val('0');
            
        })
        
        //menampilkan data penerima jadup
        $('#bln, #thn').change(function(){
            //alert ($('#kode_univ').val());
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>elemenBeasiswa/tabel_penerima_jadup",
                data: {kd_jurusan:$('#kode_jur').val(),thn_masuk:$('#tahun_masuk').val(),bln:$('#bln').val(),thn:$('#thn').val()},
                success: function(jadup){
                    $('#tabel_penerima_jadup').html(jadup);
                }
            });
            
            $("#total_bayar").val('0');
        })
        
                           
    })
    
    function cekField(){
        var jml=0;
     
        if($('#biaya_peg').val()==0 || $('#biaya_peg').val()=="" ){
            viewError("wbiaya_jadup","biaya per pegawai harus diisi");
            jml++;
        }
        if($('#kode_univ').val()==""){
            viewError("wkode_univ","Universitas harus diisi");
            jml++;
        }
     
        if($('#kode_jur').val()==""){
            viewError("wkode_jur","Jurusan harus diisi");
            jml++;
        }
     
        if($('#tahun_masuk').val()==""){
            viewError("wtahun_masuk","Tahun masuk harus diisi.");
            jml++;
        }
     
        if($('#bln').val()==""){
            viewError("wbln","Bulan harus diisi.");
            jml++;
        }
     
        if($('#thn').val()==""){
            viewError("wthn","Tahun harus diisi.");
            jml++;
        }
     
        if($('#tahun_masuk').val()==""){
            viewError("wtahun_masuk","Tahun masuk harus diisi.");
            jml++;
        }
        if($('#total_bayar').val()=="" || $('#total_bayar').val()==0){
            viewError("wtotal_biaya","Total biaya harus diisi.");
            jml++;
        }
        
        var cks = $('#jml_peg').val();
        var cek=0;
        for (var j=1; j < cks+1; j++){
            //alert('ok')
            if ($('#setuju'+j).is(':checked')){
                cek++;         
            }      
        }      
               
        if(cek<=0){
            viewError("wtabel_penerima_jadup", "Penerima tunjangan hidup belum dipilih.")
            jml++;
        }
     
        if(jml>0){
            return false;
        } else{
            return true;
        }
    }
    
    $('#kode_univ').click(function(){
        removeError('wkode_univ');
    })
    
    $('#kode_jur').click(function(){
        removeError('wkode_jur');
    })
    
    $('#tahun_masuk').click(function(){
        removeError('wtahun_masuk');
    })
    
    $('#bln').click(function(){
        removeError('wbln');
    })
    
    $('#thn').click(function(){
        removeError('wthn');
    })
    
    $('#biaya_peg').keyup(function(){
        removeError('wbiaya_jadup');
    })
        
</script>