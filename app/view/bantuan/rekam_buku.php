<div id="top">
    <h2>BIAYA BUKU > TAMBAH</h2> <!-- memakai breadcrumb -->


    <form method="POST" onSubmit="return cekField();" action="<?php echo URL . 'elemenBeasiswa/saveUangBuku' ?> " enctype="multipart/form-data">
        <div>
            <input  type="hidden" name="r_elem" value="2"/>
            <fieldset><legend>Parameter Bantuan Buku</legend>
                <!--div class="tigakolom"-->
                <div class="kolom1" style="margin-right: -100px">
                    <div id="wkode_univ"></div>
                    <label class="isian">Universitas : </label>
                    <select type="text" id="kode_univ" name="kode_univ">
                        <option value="">Pilih Universitas</option>
                        <?php
                        foreach ($this->univ as $val) {
                            echo "<option value=" . $val->get_kode_in() . " >" . $val->get_nama() . "</option>";
                        }
                        ?> 
                    </select>
                    <div id="wkode_jur"></div>
                    <label class="isian">Jurusan/Prodi : </label>
                    <select type="text" id="kode_jur" name="kode_jur">
                        <option value="">Pilih Jurusan</option>
                    </select>
                    <div id="wtahun_masuk"></div>
                    <label class="isian">Tahun Masuk : </label>
                    <select type="text" name="tahun_masuk" id="tahun_masuk">
                        <option value="">Pilih Tahun masuk</option>
                        <?php
                        for ($i = 2007; $i < date('Y') + 2; $i++) {

                            if ($i == date('Y') - 3) {
                                echo "<option value=" . $i . " selected>" . $i . "</option>";
                            } else {
                                echo "<option value=" . $i . " >" . $i . "</option>";
                            }
                        }
                        ?>
                    </select>
                    <div id="wsemester"></div>
                    <div id="wthn"></div>
                    <label class="isian">Semester dan Tahun : </label>
                    <ul class="inline" style="margin-bottom: 0px">
                        <li><select type="text" id="semester" name="semester" class="unggah">
                                <option value="1">Semester I</option>
                                <option value="2">Semester II</option>
                            </select></li> &nbsp
                        <li><select type="text" id="thn" name="thn" style="width: 68px">
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
                </div>

                <div class="kolom2" style="margin-right: -60px; margin-left:100px">
                    <div id="wbiaya_buku"></div>
                    <label class="isian">Biaya Per Pegawai : </label>
                    <input type="text" maxlength=11 id="biaya_buku" name="biaya_buku" size="12"/>
                    <div id="wtotal_biaya"></div>
                    <label class="isian">Total Biaya : </label>
                    <input readonly type="text" id="total_bayar" name="total_bayar" size="12" value="0" />


                    <label class="isian">No. SP2D : </label>
                    <input type="text" disabled />
                    <input type="hidden" id="no_sp2d" name="no_sp2d" size="20" />
                    <label class="isian">Tgl SP2D : </label>
                    <input type="text" disabled />
                    <input type="hidden" id="tgl_sp2d" name="tgl_sp2d" size="20" />
                    <label class="isian">File SP2D : </label>
                    <input type="text" disabled />
                    <input type="hidden" id="fupload" name="fupload" size="20" />
                </div>

                <ul class="inline" style="float: right; margin-right: 20px">
                    <li><button type="submit" name="simpan" class="sukses" onClick="formSubmit();"/><i class="icon-ok icon-white"></i>Simpan</button></li>
                    <li><button type="reset" name="batal" class="normal" onClick="location.href='<?php echo URL . "elemenBeasiswa/viewUangBuku"; ?>'"><i class="icon-remove icon-white"></i>Batal</li>
                </ul>
			</fieldset>
        </div>

        <!--        <div>
                    <div>Data Penerima Biaya Buku</div>
                    <div>file link print</div>
                </div>-->
		<br>
        <fieldset><legend>Daftar Penerima Bantuan Buku</legend>
		<div id="wtabel_penerima_buku"></div>
        <div id="tabel_penerima_buku">
           
			<table class="table-bordered zebra" width="95%">
                <thead>
                <th width="5%">No</th>
                <th width="25%">Nama</th>
                <th width="15%">Gol</th>
                <th width="10%">Status</th>
                <th width="15%">Bank Penerima</th>
                <th width="20%">No. Rekening</th>
                <th width="10%">Pilih</th>
                </thead>
            </table>
			</fieldset>
        </div>
        
    </form>
</div>
<script type="text/javascript">
    
       
    //mengubah inputan  dengan memunculkan separator ribuan
    $('#biaya_peg').number(true,0);
    $('#total_bayar').number(true,0);
    $('#biaya_buku').number(true,0);
        
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
            
            $('#tabel_penerima_buku').empty();
            $("#total_bayar").val('0');
        })
        
        //menampilkan data penerima jadup
        $('#kode_jur').change(function(){
            //alert ($('#kode_univ').val());
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>elemenBeasiswa/tabel_penerima_buku",
                data: {kd_jurusan:$('#kode_jur').val(),thn_masuk:$('#tahun_masuk').val()},
                success: function(jadup){
                    $('#tabel_penerima_buku').html(jadup);
                }
            });
            
            $("#total_bayar").val('0');
        })
        
        $('#tahun_masuk').change(function(){
            //alert ($('#kode_univ').val());
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>elemenBeasiswa/tabel_penerima_buku",
                data: {kd_jurusan:$('#kode_jur').val(),thn_masuk:$('#tahun_masuk').val()},
                success: function(jadup){
                    $('#tabel_penerima_buku').html(jadup);
                }
            });
            $("#total_bayar").val('0');
        })
                           
    })
    
    function cekField(){
        $jml=0;
     
        if($('#biaya_buku').val()==0 || $('#biaya_buku').val()=="" ){
            viewError("wbiaya_buku","biaya per pegawai harus diisi");
            $jml++;
        }
        if($('#kode_univ').val()==""){
            viewError("wkode_univ","Universitas harus diisi");
            $jml++;
        }
     
        if($('#kode_jur').val()==""){
            viewError("wkode_jur","Jurusan harus diisi");
            $jml++;
        }
     
        if($('#tahun_masuk').val()==""){
            viewError("wtahun_masuk","Tahun masuk harus diisi.");
            $jml++;
        }
     
        if($('#semester').val()==""){
            viewError("wsemester","Semester harus diisi.");
            $jml++;
        }
     
        if($('#thn').val()==""){
            viewError("wthn","Tahun harus diisi.");
            $jml++;
        }
     
        if($('#tahun_masuk').val()==""){
            viewError("wtahun_masuk","Tahun masuk harus diisi.");
            $jml++;
        }
        if($('#total_bayar').val()=="" || $('#total_bayar').val()==0){
            viewError("wtotal_biaya","Total biaya harus diisi.");
            $jml++;
        }
        
        var chks = document.getElementsByName('setuju[]');
        var hasChecked = false;
        for (var i = 0; i < chks.length; i++){
            if (chks[i].checked){
                hasChecked = true;
                break;
            }
        }
        
        if(hasChecked==false){
            viewError("wtabel_penerima_buku", "Penerima biaya buku belum dipilih.")
            $jml++;
        }
     
        if($jml>0){
            return false;
        } else{
            return true;
        }
    }
    
    $("#biaya_buku").focusout(function(){
        if($("#biaya_buku").val() ==""){
            $("#biaya_buku").val("0");
        }
    })
    
    
    $('#kode_univ').click(function(){
        removeError('wkode_univ');
    })
    
    $('#kode_jur').click(function(){
        removeError('wkode_jur');
    })
    
    $('#tahun_masuk').click(function(){
        removeError('wtahun_masuk');
    })
    
    $('#biaya_buku').keyup(function(){
        removeError('wbiaya_buku');
    })
        
</script>