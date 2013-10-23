<div id="top">
	<h2>DATA PENERIMA SURAT TUGAS</h2>
    <div class="kolom3">
        <fieldset><legend>Detil Surat Tugas</legend>
        <input type="hidden" name="kd_st" id="kd_st" value="<?php echo $this->d_st->get_kd_st();?>">
            <label>No. Surat Tugas(ST)</label><input type="text" name="no_st" id="no_st" size="30" value="<?php echo isset($this->d_st)?$this->d_st->get_nomor():'';?>" readonly></br>
           
            <label>No. ST Lama</label><input type="text" value="<?php echo $this->d_st->get_nomor(); ?>" readonly>
            
            <label>Tanggal ST</label><input type="text" name="tgl_st" value="<?php echo isset($this->d_st)?  Tanggal::tgl_indo($this->d_st->get_tgl_st()):'';?>" readonly></br>
            
            <label>Tanggal Mulai ST</label><input type="text" name="tgl_mulai" value="<?php echo isset($this->d_st)?  Tanggal::tgl_indo($this->d_st->get_tgl_mulai()):'';?>" readonly></br>
            
            <label>Tanggal Selesai ST</label><input type="text" name="tgl_selesai" value="<?php echo isset($this->d_st)?  Tanggal::tgl_indo($this->d_st->get_tgl_selesai()):'';?>" readonly></br>
        </fieldset>            
</div>
<div class="kolom4"> <!-- TABEL DATA -->
    <fieldset><legend>Daftar Penerima Beasiswa</legend>
    <div>
        <table>
            <tr align="left">
                <td><input type="search" id="cari" size="30" placeholder="Cari penerima beasiswa..." onKeyup="cari(this.value);"></td>
            </tr>
        </table>
    </div>
    <button id="bt_dialog" onClick="choose(document.getElementById('kd_st').value);" style="margin-right: 20px"><i class="icon-plus icon-white"></i>Penerima</button>
    <div id="tb_pb">
        <?php 
            $this->load('riwayat_tb/tabel_pb');
        ?>
    </div>
    </fieldset>
</div>
<div id="result"></div>
</div>

<script type="text/javascript">
    
    function callFromDialog(data){ //for callback from the dialog
//        var id_st = document.getElementById('kd_st').value;
//        var i = data.toString();
//        $('#result').html(data);
        
        $.post("<?php echo URL; ?>penerima/pb_by_st", {param:""+data+""},
        function(data){
            $('#tb_pb').fadeOut(0);
            $('#tb_pb').fadeIn(200);
            $('#tb_pb').html(data);
        })
        //langsung menyimpan ke tabel pb dengan st
        // do some thing other if you want
    }

    function choose(id){
        var URL = "<?php echo URL?>surattugas/dialog_add_pb/"+id;
        var w = 370;
        var h = 500;
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        var title = "rekam penerima beasiswa";
        window.open(URL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
//        window.open(URL,"mywindow","menubar=1,resizable=1,width=350,height=330")
    }
    
    function del_pb(kd_pb){
        var con = "Yakin menghapus data?"
        if(confirm(con)){
            var kd_st = $('#kd_st').val();
            $.post("<?php echo URL; ?>surattugas/del_pb_from_st", {param:""+kd_st+","+kd_pb+""},
            function(){
                $.post("<?php echo URL; ?>penerima/pb_by_st", {param:""+kd_st+""},
                function(data){
                    $('#tb_pb').fadeOut(0);
                    $('#tb_pb').fadeIn(50);
                    $('#tb_pb').html(data);
                })
            })
        }else{
            return false;
        }
    }
    
    function showdialog(){
        $('#dialog_pb').show();
    }
    
    function cari(key){
        $.post("<?php echo URL; ?>penerima/find_pb", {param:""+key+","+document.getElementById('kd_st').value+""},
        function(data){                
            $('#tb_pb').fadeIn(100);
            $('#tb_pb').html(data);
        });
    }
    
    function get_surat_tugas(univ,th_masuk){
        $.post("<?php echo URL; ?>surattugas/get_data_st", {param:""+univ+","+th_masuk+""},
        function(data){                
            $('#tb_pb').fadeIn(100);
            $('#tb_pb').html(data);
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
    
