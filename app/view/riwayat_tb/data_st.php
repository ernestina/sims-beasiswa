<div> <!-- FORM -->
    <div><h2>TAMBAH SURAT TUGAS</h2></div>
    <div>
        <form method="POST" action="<?php 
                if(isset($this->d_ubah)){
                    echo URL.'surattugas/updst';
                }else{
                    $_SERVER['PHP_SELF'];
                }?>" enctype="multipart/form-data">
            <div id="wnost"></div>
            <label>no. Surat Tugas(ST)</label><input type="text" name="no_st" id="no_st" size="30" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nomor():'';?>"></br>
            <div id="wstlama"></div>
            <label>No. ST Lama</label><select name="st_lama" id="st_lama">
                <?php 
                    foreach($this->d_st_lama as $val){
                        echo "<option value=".$val->get_kd_st().">".$val->get_nomor()."-".$val->get_jur()."</option>";
                    }
                ?>
            </select></br>
            <div id="wjenis"></div>
            <label>jenis ST</label><select name="jns_st" id="jenis">
                <?php 
                    foreach($this->d_jst as $val){
                        echo "<option value=".$val->get_kode().">".$val->get_nama()."</option>";
                    }
                ?>
            </select></br>
            <div id="wtglst"></div>
            <label>Tanggal ST</label><input type="date" name="tgl_st" id="tgl_st"></br>
            <div id="wtglmulai"></div>
            <label>Tanggal Mulai ST</label><input type="date" name="tgl_mulai" id="tgl_mulai"></br>
            <div id="wtglselesai"></div>
            <label>Tanggal Selesai ST</label><input type="date" name="tgl_selesai" id="tgl_selesai"></br>
            <div id="wpemberi"></div>
            <label>Pemberi Beasiswa</label><select name="pemb" id="pemberi">
                <?php 
                    foreach($this->d_pemb as $val){
                        echo "<option value=".$val->kd_pemberi.">".$val->nama_pemberi."</option>";
                    }
                ?>
            </select></br>
            <div id="wnost"></div>
            <label>Universitas</label><select name="univ" id="univ">
                <?php 
                    foreach($this->d_univ as $val){
                        echo "<option value=".$val->get_kode_in().">".$val->get_nama()."</option>";
                    }
                ?>
            </select></br>
            <div id="wjurusan"></div>
            <label>Jurusan/Prodi</label><select name="jur" id="jur">
                <?php 
                    foreach($this->d_jur as $val){
                        echo "<option value=".$val->get_kode_jur().">".$val->get_nama()." [".$val->get_kode_fakul()."]</option>";
                    }
                ?>
            </select></br>
            <div id="wthnmasuk"></div>
            <label>Tahun Masuk</label><select name="th_masuk" id="th_masuk">
                <?php
                    foreach ($this->d_th_masuk as $key=>$val){
                        echo "<option value=".$key.">".$val."</option>";
                    }
                ?>
            </select></br>
            <div id="wfile"></div>
            <label>Unggah ST</label><input type="file" name="fupload" id="file"></br>
            <label></label><input type="reset" value="RESET"><input type="submit" name="<?php echo isset($this->d_ubah)?'sb_upd':'sb_add';?>" value="SIMPAN" onClick="return cek();">
        </form>
    </div>
</div>
<div> <!-- TABEL DATA -->
    <div>
        <h2>DATA SURAT TUGAS</h2>
    </div>
    <div>
        <table>
            <tr align="left">
                <td><label>Universitas</label><select id="univ" onchange="get_surat_tugas(this.value,document.getElementById('thn').value)">
                        <option value="0">semua</option>
                    <?php 
                        foreach($this->d_univ as $val){
                            echo "<option value=".$val->get_kode_in().">".$val->get_nama()."</option>";
                        }
                    ?>
                    </select></td>
                <td><label>Tahun Masuk</label><select id="thn" onchange="get_surat_tugas(document.getElementById('univ').value,this.value)">
                        <option value="0">semua</option>
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
            $this->load('riwayat_tb/tabel_st');
        ?>
    </div>
</div>

<script type="text/javascript">
    
    function get_surat_tugas(univ,th_masuk){
        $.post("<?php echo URL; ?>surattugas/get_data_st", {param:""+univ+","+th_masuk+""},
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
        var tgl_st = document.getElementById('tgl_st').value;
        var tgl_mulai = document.getElementById('tgl_mulai').value;
        var tgl_selesai = document.getElementById('tgl_selesai').value;
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
    
