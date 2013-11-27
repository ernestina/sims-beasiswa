<div id="top">
	<h2>DATA PENERIMA SURAT TUGAS</h2>
    <div class="kolom3">
        <fieldset><legend>Detil Surat Tugas</legend>
        <input type="hidden" name="kd_st" id="kd_st" value="<?php echo $this->d_st->get_kd_st();?>">
        <input type="hidden" name="kd_st" id="st_lama" value="<?php echo $this->d_st->get_st_lama();?>">
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
    <?php if(Session::get('role')==2){ ?>
    <button id="bt_dialog" onClick="choose(document.getElementById('kd_st').value);" style="margin-right: 20px"><i class="icon-plus icon-white"></i>Penerima</button>
    <?php } ?>
    <div id="tb_pb">
        <?php 
            $this->load('riwayat_tb/tabel_pb');
        ?>
    </div>
    </fieldset>
</div>
<div id="result">
    <table id="test"></table>
</div>
</div>
<div id="dialog-form" title="Tambah Penerima Beasiswa">
    <form id="form_add_pb" method="POST" action="">
        <table>
            <input type="hidden" id="cek" value="">
            <input type="hidden" id="kd_st" name="st" value="<?php echo $this->d_st->get_kd_st();?>">
            <input type="hidden" id="st_parent" name="st_parent" value="<?php echo $this->d_st->get_st_lama();?>">
            <input type="hidden" id="kd_peg" name="kd_peg" value="">
            <div id="winput" class="error"></div>
            <tr><td><label>NIP</label></td><td><input type="text" id="t_nip" name="nip" onkeyup="getNama(this.value);"></td></tr>
            <div id="suggestions" style="display:none"><div class="suggestionList"></div></div>
            <tr><td><label>Nama</label></td><td><input type="text" id="t_nm" name="nama" readonly></td></tr>
            <tr><td><label>Jenis Kelamin</label></td><td><input type="text" id="t_jk" name="jkel" readonly></td></tr>
            <tr><td><label>Golongan</label></td><td><input type="text" id="t_gol" name="gol" readonly></td></tr>
            <tr><td><label>Unit Asal</label></td><td><input type="text" id="t_unit" name="unit"></td></tr>
            <tr><td><label>Email</label></td><td><input type="text" id="t_email" name="email"></td></tr>
            <tr><td><label>No. HP</label></td><td><input type="text" id="t_hp" name="telp"></td></tr>
            <tr><td><label>Bank Penerima</label></td><td>
                    <select id="t_bank" name="bank" type="text">
                        <?php 
                            foreach($this->d_bank as $val){
                                echo "<option value=".$val->get_id().">".$val->get_nama()."</option>";
                            }
                        ?>
                    </select>
                </td></tr>
<!--            <tr><td><label>Cabang</label></td><td><input type="text" id="t_cb" name="t_cb"></td></tr>-->
            <tr><td><label>No. Rekening</label></td><td><input type="text" id="t_rek" name="no_rek"></td></tr>
<!--            <tr><td colspan="2"><input type="button" id="bt_ok" value="SIMPAN" onclick="return goSelect();"></td></tr>-->
        </table>
    </form>
</div>

<script type="text/javascript">
    $(function(){
        $('.error').fadeOut(0);
//        $('#atc_nip').fadeOut(0);
//        alert($("#st_lama").val());
        hideError();
        $('#t_nip').focus();
        $('#t_nip').keyup(function(){
           if($('#t_nip').val()==''){
                $('#suggestions').fadeOut(0);
           }else{
               auto_nip(this.value);
           } 
        });
    });
    
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
    }

    function choose(id){
        var URL = "<?php echo URL?>surattugas/dialog_add_pb/"+id;
        var w = 370;
        var h = 500;
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        var title = "rekam penerima beasiswa";
        $('#dialog-form').dialog('open'); //modal dialog
//        window.open(URL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
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
//        $('#dialog_pb').show(); //native window
        $('#dialog-form').dialog('open'); //modal dialog
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
    
//    ******from dialog pb to st*****
    function hideError(){
        $('#t_nip').keyup(function(){
            $('.error').fadeOut(100);
        })
    }
    
    function auto_nip(nip){
        var st_lama = document.getElementById("st_lama").value;
//        console.log(st_lama);
        $.post('<?php echo URL;?>penerima/get_nip_data',{param:""+nip+","+st_lama+""},
            function(data){
                $('#suggestions').fadeIn(10);
                $('.suggestionList').html(data);
            }
        );
    }
    
    function fill(nip){
        $('#t_nip').val(nip);
        getNama(nip);
        $('#suggestions').fadeOut(100);
    }
    
    function getNama(nip){
        $.ajax({
           type:"post",
           url: "<?php echo URL; ?>penerima/get_nama_peg",
           data:"nip="+nip+"&kd_st="+document.getElementById('kd_st').value+"&st_lama="+document.getElementById("st_lama").value,
           dataType:"json",
           success:function(data){
               $('#kd_peg').val(data.kd_peg);
               $('#t_nm').val(data.nama);
               $('#t_jk').val(data.jkel);
               $('#t_gol').val(data.gol);
               $('#t_unit').val(data.unit);
               $('#cek').val(data.registered);
           },
           error:function(){
               alert("nip tidak ada dalam database!");
           }
        });
    }
    
    function goSelect(){
        var kd = document.getElementById('kd_st').value;
        var st_lama = document.getElementById('st_lama').value;
        var nip = document.getElementById('t_nip').value;
        var nm = document.getElementById('t_nm').value;
        var email = document.getElementById('t_email').value;
        var hp = document.getElementById('t_hp').value;
        var bank = document.getElementById('t_bank').value;
        var rek = document.getElementById('t_rek').value;
        var cek = document.getElementById('cek').value;
        
        if(nip==""){
            var winput = "masukkan nip pegawai!"
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }
        
        if(nm==""){
            var winput = "pegawai ini tidak terdaftar di database"
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }
        
        if(cek!=0){
            var winput = "pegawai ini pernah terdaftar sebagai penerima beasiswa pada strata yang sama";
            $('#winput').html(winput);
            $('#winput').fadeIn(200);
            
            return false;
        }
        return true;
        
    }
    
    if(st_lama==0){
        function validate(nip,kd_st){
            var cek;
            $.ajax({
                type:'POST',
                url:'<?php echo URL?>surattugas/cek_pb_on_st',
                data:'nip='+nip+'&kd_st='+kd_st,
                dataType:'json',
                success:function(data){
                    if(data.cek==1){
                        var winput = "pegawai ini pernah terdaftar sebagai penerima beasiswa pada strata yang sama"
                        $('#winput').html(winput);
                        return false;
                    }
    //                $('#cek').val(data.cek);
    //*******************************
    //                cek = data.cek;
    //                return cek;
                }
            });
        }
    }
    
    
//    function cek(){
//        var string_pattern = '/^[a-zA-Z\s0-9]*$';
//        var no_st = document.getElementById('no_st').value;
//        var st_lama = document.getElementById('st_lama').value;
//        var jenis = document.getElementById('jenis').value;
//        var tgl_st = document.getElementById('datepicker').value;
//        var tgl_mulai = document.getElementById('datepicker1').value;
//        var tgl_selesai = document.getElementById('datepicker2').value;
//        var pemberi = document.getElementById('pemberi').value;
//        var jurusan = document.getElementById('jur').value;
//        var thn_masuk = document.getElementById('th_masuk').value;
//        var sfile = document.getElementById('file').value;
//        var jml =0;
//        if(no_st==''){
//            var wnost = 'Nomor surat harus diisi!';
//            $('#wnost').fadeIn(0);
//            $('#wnost').html(wnost);
//            jml++;
//        }
//        
//        if(jenis==0){
//            var wjenis = 'Jenis surat tugas harus dipilih!';
//            $('wjenis').fadeIn(0);
//            $('wjenis').html(wjenis);
//            jml++;
//        }
//        
//        if(tgl_st==''){
//            var wtglst = 'Tanggal surat tugas harus diisi!';
//            $('wtglst').fadeIn(0);
//            $('wtglst').html(wtglst);
//            jml++;
//        }
//        
//        if(tgl_mulai==''){
//            var wtglmulai = 'Tanggal mulai harus diisi!';
//            $('wtglmulai').fadeIn(0);
//            $('wtglmulai').html(wtglmulai);
//            jml++;
//        }
//        
//        if(tgl_selesai==''){
//            var wtglselesai = 'Tanggal selesai harus diisi!';
//            $('wtglselesai').fadeIn(0);
//            $('wtglselesai').html(wtglselesai);
//            jml++;
//        }
//        
//        if(pemberi==0){
//            var wpemberi = 'Pemberi Beasiswa harus dipilih!';
//            $('#wpemberi').fadeIn();
//            $('#wpemberi').html(wpemberi);
//            jml++;
//        }
//        
//        if(jurusan==0){
//            var wjurusan = 'Jurusan harus dipilih!';
//            $('#wjurusan').fadeIn(0);
//            $('#wjurusan').html(wjurusan);
//            jml++;
//        }
//        
//        if(thn_masuk==0){
//            var wthnmasuk = 'Tahun masuk harus diisi!';
//            $('#wthnmasuk').fadeIn(0);
//            $('#wthnmasuk').html(wthnmasuk);
//            jml++;
//        }
//        
//        if(sfile==''){
//            jml++;
//            var wfile = '<div id=warning>File surat belum dipilih!</div>'
//            $('#wfile').fadeIn(200);
//            $('#wfile').html(wfile);
//            return false;
//        }else{
//            var csplit = sfile.split(".");
//            var ext = csplit[csplit.length-1];
//            if(ext!='docx'){
//                if(ext!='pdf'){
//                    jml++;
//                    var wfile = '<div id=warning>File surat harus dalam format pdf!</div>'
//                    $('#wfile').fadeIn(200);
//                    $('#wfile').html(wfile);
//                }else{
//                    $('#wfile').fadeOut(200);
//                }
//            }
//        }
//        
//        if(jml>0){
//            return false;
//        }else{
//            return true;
//        }
//        
//        
//    }

    var kd = $('#kd_st');
    var nip = $('#t_nip');
    var nm = $('#t_nm');
    var email = $('#t_email');
    var hp = $('#t_hp');
    var bank = $('#t_bank');
    var rek = $('#t_rek');
    var cek = $('#cek');

    $( "#dialog-form" ).dialog({
            autoOpen: false,
            height: 600,
            width: 350,
            modal: true,
            buttons: {
                "Simpan": function() {
                    var cek_isian = true;
                    cek_isian = goSelect();
                    console.log(cek_isian);
                    if ( cek_isian ) {
//                        validate(nip.val(),kd.val());
                        var formData = new FormData($('#form_add_pb')[0]);

                        $.ajax({
                            url: '<?php echo URL; ?>penerima/add_from_dialog_to_st',
                            type: 'POST',
                            data: formData,
                            async: false,
                            success: function () {
                                    callFromDialog(kd.val());
                                    $('#t_nip').val('');
                                    $('#t_nm').val('');
                                    $('#t_email').val('');
                                    $('#t_hp').val('');
    //                                $('#t_bank');
                                    $('#t_rek').val('');
                                    $('#t_gol').val('');
                                    $('#t_unit').val('');
                                    $('#t_jk').val('');
    //                                $('#cek');
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });


                        $( this ).dialog( "close" );
                    }
                },
            Cancel: function() {
                    $('#t_nip').val('');
                    $('#t_nm').val('');
                    $('#t_email').val('');
                    $('#t_hp').val('');
//                                $('#t_bank');
                    $('#t_rek').val('');
                    $('#t_gol').val('');
                    $('#t_unit').val('');
                    $('#t_jk').val('');
                    $( this ).dialog( "close" );
            }
        },
        close: function() {
//                allFields.val( "" ).removeClass( "ui-state-error" );
        }
    });
</script>
    
