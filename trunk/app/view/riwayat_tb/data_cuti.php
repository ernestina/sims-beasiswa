<div id="top"> <!-- FORM -->
    <h2>DATA SURAT TUGAS</h2>
    <div class="kolom3">
        <fieldset><legend>Tambah Surat Tugas</legend>
		<div class="kiri">
        <form method="POST" action="<?php 
                if(isset($this->d_ubah)){
                    echo URL.'cuti/updct';
                }else{
                    $_SERVER['PHP_SELF'];
                }?>" enctype="multipart/form-data">
            <?php 
                if(isset($this->d_ubah)){
                    echo "<input type=hidden name=kd_sc value=".$this->d_ubah->get_kd_sc().">";
                }
            ?>
            <div id="wnosc" class="error"></div>
            <label>no. Surat Cuti</label><input type="text" name="no_sc" id="no_sc" size="30" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nomor():'';?>">
            <div id="wjsc" class="error"></div>
            <label>Jenis Cuti</label><select name="jsc" id="jsc" >
                <?php 
                    foreach($this->d_jsc as $v){
                        echo "<option value=".$v->get_kode().">".$v->get_nama()."</option>";
                    }
                ?>
            </select>
            <div id="wtglsc" class="error"></div>
            <label>Tanggal SC</label><input type="text" name="tgl_sc" id="datepicker" value="" readonly>
            <div id="wpb" class="error"></div>
            <label>Penerima Beasiswa</label><input type="button" id="bt_pb" value="+" onClick="showDialog();">
            <input style="display:none" type="text" name="nip_pb" id="nip_pb" value="<?php echo Tanggal::ubahFormatToDatePicker(date('Y-m-d'));?>" readonly>
            <input style="display:none" type="text" name="nama_pb" id="nama_pb" value="<?php echo Tanggal::ubahFormatToDatePicker(date('Y-m-d'));?>" readonly>
            <input type="hidden" name="kd_pb" id="kd_pb" value="">
            </br><label>Universitas</label><select id="univ" name="univ" onChange="get_jurusan(this.value);">
                <option value="0">-Pilih Universitas-</option>
                <?php 
                    foreach($this->d_univ as $v){
                        echo "<option value=".$v->get_kode_in().">".$v->get_nama()."</option>";
                    }
                ?>
            </select>
            <div id="wjur" class="error"></div>
            <div style="display:none"id="div_jur">
            <label>Jurusan</label><select name="jur" id="jur"></select>
            </div>
            <div id="wprdmulai" class="error"></div>
            <label>Periode Mulai Cuti</label>
            <select name="sem_mulai" id="sem_mulai">
                <option value="1">Ganjil</option>
                <option value="2">Genap</option>
            </select>
            <select name="thn_mulai" id="thn_mulai">
                <option value="<?php echo $this->curr_year;?>"><?php echo $this->curr_year;?></option>
                <option value="<?php echo (int) $this->curr_year+1;?>"><?php echo (int) $this->curr_year+1;?></option>
            </select>
            <div id="wprdselesai" class="error"></div>
            <label>Periode Selesai Cuti</label>
            <select name="sem_sel" id="sem_sel">
                <option value="1">Ganjil</option>
                <option value="2">Genap</option>
            </select>
            <select name="thn_sel" id="thn_sel">
                <option value="<?php echo $this->curr_year;?>"><?php echo $this->curr_year;?></option>
                <option value="<?php echo (int) $this->curr_year+1;?>"><?php echo (int) $this->curr_year+1;?></option>
            </select>
            <div id="wperkstop" class="error"></div>
            <label>Perkiraan Stop</label>
            <select name="bln_stop" id="bln_stop">
                <?php 
                    for($i=1;$i<=12;$i++){
                        echo "<option value=$i>".Tanggal::bulan_indo($i)."</option>";
                    }
                ?>
            </select>
            <select name="thn_stop" id="thn_stop">
                <option value="<?php echo $this->curr_year;?>"><?php echo $this->curr_year;?></option>
                <option value="<?php echo (int) $this->curr_year+1;?>"><?php echo (int) $this->curr_year+1;?></option>
            </select>
            <div id="wperkgo" class="error"></div>
            <label>Perkiraan Go</label>
            <select name="bln_go" id="bln_go">
                <?php 
                    for($i=1;$i<=12;$i++){
                        echo "<option value=$i>".Tanggal::bulan_indo($i)."</option>";
                    }
                ?>
            </select>
            <select name="thn_go" id="thn_go">
                <option value="<?php echo $this->curr_year;?>"><?php echo $this->curr_year;?></option>
                <option value="<?php echo (int) $this->curr_year+1;?>"><?php echo (int) $this->curr_year+1;?></option>
            </select>
            <div id="wfile" class="error"></div>
            <label>Unggah SC</label><input type="file" name="fupload" id="file">
            <ul class="inline tengah">
			<li><input class="normal" type="submit" onclick="" value="BATAL"></li>
			<li><input class="sukses" type="submit" name="<?php echo isset($this->d_ubah)?'sb_upd':'sb_add';?>" value="SIMPAN" onClick="return cek();"></li>
		</ul>
<!--            <label></label><input type="reset" value="RESET"><input type="submit" name="<?php echo isset($this->d_ubah)?'sb_upd':'sb_add';?>" value="SIMPAN" onClick="return cek();">-->
        </form>
		</div>
            </fieldset>
    </div>
<div class="kolom4"> <!-- TABEL DATA -->
    
        <fieldset><legend>Daftar Surat Cuti</legend>
    
    <div>
        <table>
            <tr align="left">
                <td><label>Universitas</label><select id="univ" onchange="get_surat_tugas(this.value,document.getElementById('thn').value)" type="text">
                        <option value=0>semua</option>
                    <?php 
                        foreach($this->d_univ as $val){
                            echo "<option value=".$val->get_kode_in().">".$val->get_nama()."</option>";
                        }
                    ?>
                    </select></td>
                <td><label>Tahun Masuk</label><select id="thn" onchange="get_surat_tugas(document.getElementById('univ').value,this.value)" type="text">
                        <option value=0>semua</option>
                        <?php
                            foreach ($this->d_th_masuk as $key=>$val){
                                echo "<option value=".$key.">".$val."</option>";
                            }
                        ?>
                    </select></td>
                <td><input type="search" id="cari" size="30"></td>
            </tr>
        </table>
    </div>
    <div id="tb_st">
        <?php 
            $this->load('riwayat_tb/tabel_sc');
        ?>
    </div>
            </fieldset>
</div>
</div>


<script type="text/javascript">
    
    $(function(){
        $('#div_jur').fadeOut(0);
        hideErrorId();
        hideWarning();
    });
    
    function hideErrorId(){
        $('.error').fadeOut(0);
    }
    
    function hideWarning(){
        $('#no_sc').keyup(function(){
            if(document.getElementById('no_sc').value !=''){
                $('#wnosc').fadeOut(200);
            }
        })
        $('#datepicker').change(function(){
            if($('#datepicker').val()!=''){
                $('#wtglsc').fadeOut(200);
            }
        })
        
        $('#bt_pb').click(function(){
//            if($('#nip_pb').val()!=''){
                $('#wpb').fadeOut(200);
//            }
        })
        
        $('#jur').change(function(){
            if($('#jur').val()!=''){
                $('#wjur').fadeOut(200);
            }
        })
        
        
        $('#file').change(function(){
            if($('#file').val()!=''){
                $('#wfile').fadeOut(200);
            }
        });
        
    }
    
    function callFromDialog(kd_pb){
        $.ajax({
            type:'post',
            url:"<?php echo URL; ?>penerima/get_data_pb",
            data:'param='+kd_pb,
            dataType:'json',
            success:function(data){
               $('#nip_pb').val(data.nip);
               $('#nama_pb').val(data.nama);
               $('#kd_pb').val(data.kd_pb);
               $('#bt_pb').fadeOut(200);
               $('#nip_pb').fadeIn(200);
               $('#nama_pb').fadeIn(200);
            }
        })
    }
    
    function showDialog(){
        var URL = "<?php echo URL?>cuti/dialog_add_pb/";
        var w = 370;
        var h = 500;
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        var title = "rekam penerima beasiswa";
        window.open(URL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    }
    
    
    function get_data_sc(univ,th_masuk){
        $.post("<?php echo URL; ?>cuti/get_data_sc", {param:""+univ+","+th_masuk+""},
        function(data){                
            $('#tb_st').fadeIn(100);
            $('#tb_st').html(data);
        });
    }
    
    function get_jurusan(univ){
        $.post("<?php echo URL; ?>admin/get_jur_by_univ", {param:""+univ+""},
        function(data){
            $('#div_jur').fadeIn(200);
            $('#jur').html(data);
        });
    }
    
    function cek(){
        var string_pattern = '/^[a-zA-Z\s0-9]*$';
        var no_sc = document.getElementById('no_sc').value;
        var tgl_sc = document.getElementById('datepicker').value;
        var pb = document.getElementById('kd_pb').value;
        var jur = document.getElementById('jur').value;
        var sfile = document.getElementById('file').value;
        var jml =0;
        if(no_sc==''){
            var wnosc = 'Nomor surat harus diisi!';
            $('#wnosc').fadeIn(0);
            $('#wnosc').html(wnosc);
            jml++;
        }
        
        if(tgl_sc==''){
            var wtglsc = 'Tanggal surat cuti harus diisi!';
            $('#wtglsc').fadeIn(0);
            $('#wtglsc').html(wtglsc);
            jml++;
        }
        
        if(pb==''){
            var wpb = 'Penerima beasiswa belum dipilih!';
            $('#wpb').fadeIn(0);
            $('#wpb').html(wpb);
            jml++;
        }
        
        if(jur==''){
            var wjur = 'Jurusan belum dipilih!';
            $('#wjur').fadeIn(0);
            $('#wjur').html(wjur);
            jml++;
        }
        
        if(sfile==''){
            jml++;
            var wfile = '<div id=warning>File surat belum dipilih!</div>'
            $('#wfile').fadeIn(200);
            $('#wfile').html(wfile);
            return false;
        }else{
            var csplit = sfile.split(".");
            var ext = csplit[csplit.length-1];
            if(ext!='docx'){
                if(ext!='pdf'){
                    jml++;
                    var wfile = '<div id=warning>File surat harus dalam format pdf!</div>'
                    $('#wfile').fadeIn(200);
                    $('#wfile').html(wfile);
                }else{
                    $('#wfile').fadeOut(200);
                }
            }
        }
        
        if(jml>0){
            return false;
        }else{
            return true;
        }
        
        
    }
</script>
    
