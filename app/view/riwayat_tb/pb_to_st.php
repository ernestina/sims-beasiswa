<div><h2>TAMBAH SURAT TUGAS</h2></div>
    <div class="kolom3">
        <input type="hidden" name="kd_st" id="kd_st" value="<?php echo $this->d_st->get_kd_st();?>">
            <label>no. Surat Tugas(ST)</label><input type="text" name="no_st" id="no_st" size="30" value="<?php echo isset($this->d_st)?$this->d_st->get_nomor():'';?>"></br>
           
            <label>No. ST Lama</label><input type="text" value="<?php echo $this->d_st->get_nomor(); ?>">
            
            <label>Tanggal ST</label><input type="text" name="tgl_st" id="datepicker" value="<?php echo isset($this->d_st)?  Tanggal::ubahFormatToDatePicker($this->d_st->get_tgl_st()):'';?>" readonly></br>
            
            <label>Tanggal Mulai ST</label><input type="text" name="tgl_mulai" id="datepicker1" value="<?php echo isset($this->d_st)?  Tanggal::ubahFormatToDatePicker($this->d_st->get_tgl_mulai()):'';?>" readonly></br>
            
            <label>Tanggal Selesai ST</label><input type="text" name="tgl_selesai" id="datepicker2" value="<?php echo isset($this->d_st)?  Tanggal::ubahFormatToDatePicker($this->d_st->get_tgl_selesai()):'';?>" readonly></br>
            
</div>
<div class="kolom4"> <!-- TABEL DATA -->
    <div>
        <h2>DATA SURAT TUGAS</h2>
    </div>
    <div>
        <table>
            <tr align="left">
                <td><input type="search" id="cari" size="30" placeholde="cari penerima beasiswa"></td>
            </tr>
        </table>
    </div>
    <input type="button" id="bt_dialog" value="buka dialog" onClick="choose(document.getElementById('kd_st').value);">
    <div id="tb_st">
        <?php 
            $this->load('riwayat_tb/tabel_pb');
        ?>
    </div>
</div>
<div id="result"></div>


<script type="text/javascript">
    
    function callFromDialog(data){ //for callback from the dialog
//        var id_st = document.getElementById('kd_st').value;
//        var i = data.toString();
//        $('#result').html(data);
        
        $.post("<?php echo URL; ?>penerima/pb_by_st", {param:""+data+""},
        function(data){
            $('#tb_st').fadeOut(0);
            $('#tb_st').fadeIn(200);
            $('#tb_st').html(data);
        })
        //langsung menyimpan ke tabel pb dengan st
        // do some thing other if you want
    }

    function choose(id){
        var URL = "<?php echo URL?>surattugas/dialog_add_pb/"+id;
        window.open(URL,"mywindow","menubar=1,resizable=1,width=350,height=330")
    }
    
    function showdialog(){
        $('#dialog_pb').show();
    }
    
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
    
