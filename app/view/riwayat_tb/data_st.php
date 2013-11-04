<div id="top"> <!-- FORM -->
    <h2>DATA SURAT TUGAS</h2>
    <div class="kolom3">
        <fieldset><legend>Tambah Surat Tugas</legend>
		<div class="kiri">
        <form method="POST" action="<?php 
                if(isset($this->d_ubah)){
                    echo URL.'surattugas/updst';
                }else{
                    $_SERVER['PHP_SELF'];
                }?>" enctype="multipart/form-data">
            <?php 
                if(isset($this->d_ubah)){
                    echo "<input type=hidden name=kd_st value=".$this->d_ubah->get_kd_st().">";
                }
            ?>
            <div id="wnost" class="error"></div>
            <label>No. Surat Tugas(ST)</label><input type="text" name="no_st" id="no_st" size="30" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nomor():'';?>">
            <div id="wstlama" class="error"></div>
            <label>No. ST Lama</label><select name="st_lama" id="st_lama" type="text">
                <option value="0"> Pilih Surat Tugas Lama </option>
                <?php 
                    foreach($this->d_st_lama as $val){
                        if(isset($this->d_ubah)){
                            if($this->d_ubah->get_st_lama()==$val->get_kd_st()){
                                echo "<option value=".$val->get_kd_st()." selected>".$val->get_nomor()." [".$val->get_jur()."]</option>";
                            }else{
                                echo "<option value=".$val->get_kd_st().">".$val->get_nomor()." [".$val->get_jur()."]</option>";
                            }
                        }else{
                            echo "<option value=".$val->get_kd_st().">".$val->get_nomor()." [".$val->get_jur()."]</option>";
                        }
                        
                    }
                ?>
            </select>
            <div id="wjenis" class="error"></div>
            <label>jenis ST</label><select name="jns_st" id="jenis" type="text">
                <?php 
                    foreach($this->d_jst as $val){
                        if(isset($this->d_ubah)){
                            if($this->d_ubah->get_jenis_st()==$val->get_kode()){
                                echo "<option value=".$val->get_kode()." selected>".$val->get_nama()."</option>";
                            }else{
                                echo "<option value=".$val->get_kode().">".$val->get_nama()."</option>";
                            }
                        }else{
                            echo "<option value=".$val->get_kode().">".$val->get_nama()."</option>";
                        }
                        
                    }
                ?>
            </select>
            <div id="wtglst" class="error"></div>
            <label>Tanggal ST</label><input type="text" name="tgl_st" id="datepicker" value="<?php echo isset($this->d_ubah)?  Tanggal::ubahFormatToDatePicker($this->d_ubah->get_tgl_st()):Tanggal::ubahFormatToDatePicker(date('Y-m-d'));?>" readonly>
            <div id="wtglmulai" class="error"></div>
            <label>Tanggal Mulai ST</label><input type="text" name="tgl_mulai" id="datepicker1"  value="<?php echo isset($this->d_ubah)?Tanggal::ubahFormatToDatePicker($this->d_ubah->get_tgl_mulai()):Tanggal::ubahFormatToDatePicker(date('Y-m-d'));?>" readonly>
            <div id="wtglselesai" class="error"></div>
            <label>Tanggal Selesai ST</label><input type="text" name="tgl_selesai" id="datepicker2"  value="<?php echo isset($this->d_ubah)?Tanggal::ubahFormatToDatePicker($this->d_ubah->get_tgl_selesai()):Tanggal::ubahFormatToDatePicker(date('Y-m-d'));?>" readonly>
            <div id="wpemberi" class="error"></div>
            <label>Pemberi Beasiswa</label><select name="pemb" id="pemberi" type="text">
                <?php 
                    foreach($this->d_pemb as $val){
                        if(isset($this->d_ubah)){
                            if($this->d_ubah->get_pemberi()==$val->kd_pemberi){
                                echo "<option value=".$val->kd_pemberi." selected>".$val->nama_pemberi."</option>";
                            }else{
                                echo "<option value=".$val->kd_pemberi.">".$val->nama_pemberi."</option>";
                            }
                        }else{
                            echo "<option value=".$val->kd_pemberi.">".$val->nama_pemberi."</option>";
                        }
                        
                    }
                ?>
            </select>
            <div id="wuniv"  class="error"></div>
            <label>Universitas</label><select name="univ" id="univ" onchange="get_jurusan(this.value)" type="text">
                <?php 
                    foreach($this->d_univ as $val){
//                        if(isset($this->d_ubah)){
//                            if($this->d_ubah->get_univ()==$val->get_kode_in()){
//                                echo "<option value=".$val->get_kode_in()." selected>".$val->get_nama()."</option>";
//                            }else{
//                                echo "<option value=".$val->get_kode_in().">".$val->get_nama()."</option>";
//                            }
//                        }else{
                        if(isset($this->d_ubah)){
                            if($this->univ == $val->get_kode_in()){
                                echo "<option value=".$val->get_kode_in()." selected>".$val->get_nama()."</option>";
                            }else{
                                echo "<option value=".$val->get_kode_in().">".$val->get_nama()."</option>";
                            }
                        }else{
                            echo "<option value=".$val->get_kode_in().">".$val->get_nama()."</option>";
                        }
                            
//                        }
                        
                    }
                ?>
            </select>
            <div id="wjurusan" class="error"></div>
            <label>Jurusan/Prodi</label><select name="jur" id="jur" type="text">
                <?php 
                    foreach($this->d_jur as $val){
                        if(isset($this->d_ubah)){
                            if($this->d_ubah->get_jur()==$val->get_kode_jur()){
                                echo "<option value=".$val->get_kode_jur()." selected>".$val->get_nama()." [".$val->get_kode_fakul()."]</option>";
                            }else{
                                echo "<option value=".$val->get_kode_jur().">".$val->get_nama()." [".$val->get_kode_fakul()."]</option>";
                            }
                        }else{
                            echo "<option value=".$val->get_kode_jur().">".$val->get_nama()." [".$val->get_kode_fakul()."]</option>";
                        }
                        
                    }
                ?>
            </select>
            <div id="wthnmasuk" class="error"></div>
            <label>Tahun Masuk</label><select name="th_masuk" id="th_masuk" type="text">
                <?php
                    foreach ($this->d_th_masuk_input as $key=>$val){
                        if(isset($this->d_ubah)){
                            if($this->d_ubah->get_th_masuk()==$key){
                                echo "<option value=".$key." selected>".$val."</option>";
                            }else{
                                echo "<option value=".$key.">".$val."</option>";
                            }
                        }else{
                            echo "<option value=".$key.">".$val."</option>";
                        }
                        
                    }
                ?>
            </select>
            <div id="wfile" class="error"></div>
            <label>Unggah ST</label><input type="file" name="fupload" id="file">
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
    
        <fieldset><legend>Daftar Surat Tugas</legend>
    
    
        <table>
            <tr align="left">
                <td><label>Universitas</label><select id="cuniv" onchange="get_surat_tugas(this.value,document.getElementById('thn').value)" type="text">
                        <option value=0>- semua -</option>
                    <?php 
                        foreach($this->d_univ as $val){
                            echo "<option value=".$val->get_kode_in().">".$val->get_nama()."</option>";
                        }
                    ?>
                    </select></td>
                <td><label>Tahun Masuk</label><select id="thn" onchange="get_surat_tugas(document.getElementById('cuniv').value,this.value)" type="text">
                        <option value=0>- semua -</option>
                        <?php
                            foreach ($this->d_th_masuk as $key=>$val){
                                echo "<option value=".$key.">".$val."</option>";
                            }
                        ?>
                    </select></td>
                <td><input type="search" id="cari" size="30" placeholder="Cari..."></td>
            </tr>
        </table>
    
    <div id="tb_st">
        <?php 
            $this->load('riwayat_tb/tabel_st');
        ?>
    </div>
            </fieldset>
</div>
</div>
</div>


<script type="text/javascript">
    
    $(function(){
        hideErrorId();
        hideWarning();
//        get_jurusan(document.getElementById('univ').value);
//        var file_exist = <?php echo $this->d_file_exist;?>;
//        console.log(file_exist.file_exist);
        $('#no_st').keyup(function(){
            var nomor = document.getElementById('no_st').value;
//            console.log(nomor);
            cek_exist_nomor(nomor);
//            console.log('test');
        })
        
        $('#cari').keyup(function(){
            var keyword = document.getElementById('cari').value;
            console.log(keyword);
            cari_st(keyword);
        })
    });
    
    function hideErrorId(){
        $('.error').fadeOut(0);
    }
    
    function hideWarning(){
//        $('#no_st').keyup(function(){
//            if(document.getElementById('no_st').value !=''){
//                $('#wnost').fadeOut(200);
//            }
//        })
        
        if($('#datepicker').val()!=''){
            $('wtglst').fadeOut(200);
        }
        
        if($('#datepicker1').val()!=''){
            $('wtglmulai').fadeOut(200);
        }
        
        if($('#datepicker2').val()!=''){
            $('wtglselesai').fadeOut(200);
        }
        
        $('#file').change(function(){
            if($('#file').val()!=''){
                $('#wfile').fadeOut(200);
            }
        });
        
    }
    
    function get_surat_tugas(univ,th_masuk){
//        alert(document.getElementById('cuniv').value);
        var kd_user = <?php echo Session::get('kd_user');?>;
        $.post("<?php echo URL; ?>surattugas/get_data_st", {param:""+univ+","+th_masuk+","+kd_user+""},
        function(data){                
            $('#tb_st').fadeIn(100);
            $('#tb_st').html(data);
        });
    }
    
    function cek_exist_nomor(no_st){
//        alert(document.getElementById('cuniv').value);
        $.post("<?php echo URL; ?>surattugas/cek_exist_nomor", {nomor:""+no_st+""},
        function(data){
            if(data==1){
                console.log(data);
                var wnost = 'Nomor surat pernah direkam!';
                $('#wnost').fadeIn(0);
                $('#wnost').html(wnost);
                return false;
            }else{
                $('#wnost').fadeOut(200);
            }
            
        });
    }
    
    function get_jurusan(univ){
        $.post("<?php echo URL; ?>admin/get_jur_by_univ", {param:""+univ+""},
        function(data){
            $('#jur').html(data);
        });
    }
    
    
    function cari_st(key){
        $.post("<?php echo URL; ?>surattugas/cari_st", {param:""+key+""},
        function(data){
            $('#tb_st').fadeIn(100);
            $('#tb_st').html(data);
        });
    }
    
    function cek(){
        var string_pattern = '/^[a-zA-Z\s0-9]*$';
        var no_st = document.getElementById('no_st').value;
        var st_lama = document.getElementById('st_lama').value;
        var jenis = document.getElementById('jenis').value;
        var tgl_st = document.getElementById('datepicker').value;
        var tgl_mulai = document.getElementById('datepicker1').value;
        var tgl_selesai = document.getElementById('datepicker2').value;
        var pemberi = document.getElementById('pemberi').value;
        var jurusan = document.getElementById('jur').value;
        var thn_masuk = document.getElementById('th_masuk').value;
        var sfile = document.getElementById('file').value;
        var jml =0;
        if(no_st==''){
            var wnost = 'Nomor surat harus diisi!';
            $('#wnost').fadeIn(0);
            $('#wnost').html(wnost);
            jml++;
        }
        
        if(jenis==0){
            var wjenis = 'Jenis surat tugas harus dipilih!';
            $('wjenis').fadeIn(0);
            $('wjenis').html(wjenis);
            jml++;
        }
        
        if(tgl_st==''){
            var wtglst = 'Tanggal surat tugas harus diisi!';
            $('wtglst').fadeIn(0);
            $('wtglst').html(wtglst);
            jml++;
        }
        
        if(tgl_mulai==''){
            var wtglmulai = 'Tanggal mulai harus diisi!';
            $('wtglmulai').fadeIn(0);
            $('wtglmulai').html(wtglmulai);
            jml++;
        }
        
        if(tgl_selesai==''){
            var wtglselesai = 'Tanggal selesai harus diisi!';
            $('wtglselesai').fadeIn(0);
            $('wtglselesai').html(wtglselesai);
            jml++;
        }
        
        if(pemberi==0){
            var wpemberi = 'Pemberi Beasiswa harus dipilih!';
            $('#wpemberi').fadeIn();
            $('#wpemberi').html(wpemberi);
            jml++;
        }
        
        if(jurusan==0){
            var wjurusan = 'Jurusan harus dipilih!';
            $('#wjurusan').fadeIn(0);
            $('#wjurusan').html(wjurusan);
            jml++;
        }
        
        if(thn_masuk==0){
            var wthnmasuk = 'Tahun masuk harus diisi!';
            $('#wthnmasuk').fadeIn(0);
            $('#wthnmasuk').html(wthnmasuk);
            jml++;
        }
        
        if(sfile==''){ 
            
            var file_exist = <?php echo $this->d_file_exist;?>;
            if(file_exist.file_exist===false){
                jml++;
                var wfile = '<div id=warning>File surat belum dipilih!</div>'
                $('#wfile').fadeIn(200);
                $('#wfile').html(wfile);
                return false;
            }
            
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
    
