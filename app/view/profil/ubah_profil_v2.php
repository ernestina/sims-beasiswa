<!--<link href="../../../public/css/style.css" rel="stylesheet" media="screen">
<body>-->
  
  <div id="top">
  <!--level1: Profil Penerima Beasiswa-->
  
	<h1>PROFIL PENERIMA BEASISWA</h1>
			<form method="POST" action="<?php echo URL;?>penerima/updprofil" enctype="multipart/form-data">
<div class="kolom1">
	<fieldset><legend>Profil Penerima Beasiswa</legend>
<?php
    $url = "edit";
//    echo $url;
    if(isset($this->error)){
        echo "<div class=error>".$this->error."</div>";
    }
?>

<!--		<form action="<?php echo URL;?>penerima/updprofil" method="post" enctype="multipart/form-data">-->
                    <input type="hidden" id="id_pb" name="kd_pb" value="<?php echo $this->d_pb->get_kd_pb();?>">
                    <input type="hidden" id="nip" name="nip" value="<?php echo $this->d_pb->get_nip();?>">
			<label class="isian">NIP :</label>
			<input type="text" id="NIP" name="NIP" disabled value="<?php echo $this->d_pb->get_nip();?>"/>
			
			<label class="isian">Nama :</label>
			<input type="text" id="nama" name="nama" disabled value="<?php echo $this->d_pb->get_nama();?>"/>

			<label class="isian">Jenis Kelamin :</label>
			<input type="text" id="jenis_kelamin" name="jenis_kelamin" disabled value="<?php echo ($this->d_pb->get_jkel()==1)?'Laki-laki':'Perempuan';?>"/>
			
			<label class="isian">Pangkat/Gol :</label>
                        <input type="text" id="pangkat" name="pangkat" disabled value="<?php echo Golongan::golongan_int_string($this->d_pb->get_gol());?>"/>
			
			<label class="isian">Unit Asal :</label>
			<input type="text" id="asal" name="asal" value="<?php echo $this->d_pb->get_unit_asal();?>"/>
                        <div id="walamat" class="error" ></div>
			<label class="isian">Alamat :</label>
			<textarea type="text" id="alamat" name="alamat" rows="7"/><?php echo isset($this->alamat)?$this->alamat:$this->d_pb->get_alamat();?></textarea>
			<div class="error" id="wemail"></div>
			<label class="isian">Email :</label>
			<input type="text" id="email" name="email" value="<?php echo isset($this->email)?$this->email:$this->d_pb->get_email();?>"/>
			<div class="error" id="wtelp"></div>
			<label class="isian">No. HP :</label>
			<input type="text" id="hp" name="hp" value="<?php echo isset($this->telp)?$this->telp:$this->d_pb->get_telp();?>"/>
			
			<label class="isian">Bank Penerima</label>
<!--			<input type="text" id="bank" name="bank" value="<?php echo isset($this->bank)?$this->bank:$this->d_bank->get_id();?>"/>-->
                        <select id="bank" name="bank" type="text">
                            <?php 
                                foreach ($this->t_bank as $v){
                                    if($v->get_id()==$this->d_pb->get_bank()){
                                        echo "<option value=".$v->get_id()." selected>".$v->get_nama()."</option>";
                                    }else{
                                        echo "<option value=".$v->get_id().">".$v->get_nama()."</option>";
                                    }
                                }
                            ?>
                        </select>
			<label class="isian">No Rekening</label>
			<input type="text" id="rekening" name="rekening" value="<?php echo isset($this->no_rek)?$this->no_rek:$this->d_pb->get_no_rek();?>"/>
			<div class="error" id="wfoto"></div>
			<label class="isian">Unggah Foto:</label>
<!--                        <input type="file" id="foto" name="fotoinput">-->
			<ul class="inline">
				<li><input type="file" id="foto" name="fotoinput" style="display: none" onChange="FotoChange();"/>
				<input class="unggah" type="text" id="filefoto" disabled /></li>
				<li><input type="button" class="lihat" value="Pilih..." id="fakeBrowse" onclick="BrowseFoto();"/>
				</li>
<!--				<li><input type="button" class="lihat" onclick="view_file('<?php echo $this->d_pb->get_foto();?>','foto');" value="Lihat Foto"></li>-->
                                <li><a style="cursor:pointer;color:blue" onclick="view_file('<?php echo $this->d_pb->get_foto();?>','foto');" >lihat foto</a></li>
			</ul>
                        

	</fieldset>
</div>	
	<!--level2: Profil Beasiswa & Riwayat Pembayaran-->
	<div class="kolom2">
		<fieldset><legend>Profil Beasiswa</legend>
                        <input type="hidden" id="id_st" name="kd_st" value="<?php echo $this->d_st->get_kd_st();?>">
                        <input type="hidden" id="no_st" name="no_st" value="<?php echo $this->d_st->get_nomor();?>"/>
                        <input type="hidden" id="tgl_sel_st" name="tgl_sel_st" value="<?php echo $this->d_st->get_tgl_selesai();?>"/>
			<label class="isian">No. Surat Tugas (ST) :</label>
			<input type="text" id="st" name="st" disabled value="<?php echo $this->d_st->get_nomor();?>"/>
			
			<label class="isian">Tanggal ST :</label>
                        <input type="text" id="tgl_st" name="tanggal_st" disabled value="<?php echo Tanggal::tgl_indo($this->d_st->get_tgl_st());?>"/>

			<label class="isian">Tanggal Mulai ST :</label>
			<input type="text" id="tgl_mulai_st" name="tgl_mulai_st" disabled value="<?php echo Tanggal::tgl_indo($this->d_st->get_tgl_mulai());?>"/>
			
			<label class="isian">Tanggal Akhir ST :</label>
			<input type="text" id="tgl_akhir_st" name="tgl_akhir_st" disabled value="<?php echo Tanggal::tgl_indo($this->d_st->get_tgl_selesai());?>"/>
			
			<label class="isian">Jenis Beasiswa :</label>
			<input type="text" id="jenis_beasiswa" name="jenis_beasiswa" disabled value="<?php // echo $this->d_st->get_jns_beasiswa();?>"/>
			
			<label class="isian">Universitas :</label>
			<input type="text" id="universitas" name="universitas" disabled value="<?php echo $this->d_univ->get_nama();?>"/>
			
			<label class="isian">Jurusan :</label>
			<input type="text" id="jurusan" name="jurusan"disabled value="<?php echo $this->d_jur->get_nama();?>"/>
			
			<label class="isian">Tahun Masuk :</label>
			<input type="text" id="th_masuk" name="th_masuk" disabled value="<?php echo $this->d_st->get_th_masuk();?>"/>
			
			<label class="isian">Status Tugas Belajar (TB) :</label>
<!--			<select type="text">
				<option>belum lulus</option>
				<option>lulus</option>
				<option>lulus awal waktu</option>
				<option>lulus dengan perpanjangan 1</option>
				<option>lulus dengan perpanjangan 2</option>
				<option>tidak lulus</option>-->
                        <ul class="inline">
                            <li><input type="text" id="sts_tb" disabled value="<?php echo StatusPB::status_int_string($this->d_pb->get_status());?>"></li>
                            <?php if($this->d_pb->get_status()<5) {?>
                            <li><input class="lihat" type="button" value="<->" id="off" title="ubah status tidak lulus"/></li>
                            <?php } ?>
                        </ul>
                        
                                <?php 
//                                    foreach ($this->t_jst as $v){
//                                        if($v->get_kode()==$this->d_jst->get_kode()){
//                                            echo $this->d_jst->get_nama();
//                                        }
//                                        else{
//                                            echo "<option value=".$v->get_kode().">".$v->get_nama()."</option>";
//                                        }
//                                    }
                                ?>
<!--			</select>-->
			<!--row berikut hanya muncul jika status TB: lulus dan/atau tidak lulus -->
			
<!--			<label class="isian">Tanggal Akhir TB :</label>
			<input type="text" id="tgl_akhir_TB" name="tgl_akhir_TB" disabled     />-->
			
                        <label class="isian">Tanggal Lapor Selesai TB :</label>

                        <input type="text" id="datepicker" name="tgl_lapor" value="<?php echo isset($this->tgl_lapor)?$this->tgl_lapor:(($this->d_pb->get_tgl_lapor()=='0000-00-00' OR $this->d_pb->get_tgl_lapor()=='')?'':(Tanggal::ubahFormatToDatePicker($this->d_pb->get_tgl_lapor())));?>"/>

			<div class="error" id="wskl"></div>
			<label class="isian">Unggah SKL :</label>
			<!--input type="file" id="skl" name="skl" /-->
			<ul class="inline">
				<li><input type="file" id="SKL" name="sklinput" style="display: none" onChange="Handlechange();"/>
				<input class="unggah" type="text" id="filename" disabled /></li>
				<li><input class="lihat" type="button" value="Pilih..." id="fakeBrowse" onclick="HandleBrowseClick();"/>
				</li>
<!--				<li><input type="button" class="lihat" onclick="view_file('<?php echo $this->d_pb->get_skl();?>','skl');" value="Lihat SKL"></li>-->
                                <li><a style="cursor:pointer;color: blue" onclick="view_file('<?php echo $this->d_pb->get_skl();?>','skl');">lihat skl</a></li>
                        </ul>
                        
			<div class="error" id="wspmt"></div>
			<label class="isian">Unggah SPMT :</label>
<!--                        <input type="file" id="SPMT" name="spmtinput">-->
			<ul class="inline">
				<li><input type="file" id="SPMT" name="spmtinput" style="display: none" onChange="Change();"/>
				<input class="unggah" type="text" id="namafile" disabled /></li>
				<li><input class="lihat" type="button" value="Pilih..." id="fakeBrowse" onclick="BrowseClick();"/>
				</li>
				<!--li><input class="lihat" type="button" value="Lihat SPMT" id="" onclick="view_file('<?php //echo $this->d_pb->get_spmt();?>','skl');"/></li-->
<!--				<li><input type="button" class="lihat" onclick="view_file('<?php echo $this->d_pb->get_spmt();?>','spmt');" value="Lihat SPMT"></li>-->
                                <li><a style="cursor:pointer;color:blue" onclick="view_file('<?php echo $this->d_pb->get_spmt();?>','spmt');" value="Lihat SPMT">lihat spmt</a></li>
			</ul>
                        
	</fieldset>
</div>
	
	<!--level3: Riwayat Perkembangan Studi-->
	<div id="fitur">
  
	<fieldset><legend>Riwayat Perkembangan Studi</legend>
		<div class="kolom5">
                        <div class="error" id="wskripsi"></div>
			<label class="isian2">Judul Tugas Akhir/Skripsi/Thesis/Desertasi :</label>
			<textarea class="midi" type="text" rows="4" name="skripsi" id="skripsi"><?php echo isset($this->skripsi)?$this->skripsi:$this->d_pb->get_skripsi();?></textarea>
			<label class="isian2" style="margin-right: -135px">Permasalahan Tugas Belajar :</label>
			<ul class="inline">
                        <li><input type="button" value="+" id="add_problem" class="lihat"></li>
					</ul>
<!--			<textarea class="midi" type="text" rows="8"></textarea>-->
                        <div id="t_masalah">
                        <?php 
                            $this->load('profil/tabel_masalah');
                        ?>
			</div> 
		</div>
		
			<label class="isian">IPK :</label>
			<input type="text" id="IPK" name="IPK" disabled value="<?php echo $this->d_cur_ipk->get_ipk();?>"/>
			
			<label class="isian">Unggah Transkrip:</label>
			<ul class="inline">
				<li><input type="button" class="lihat" id="add_nilai" value="+"></li>
			</ul>
<!--                        <input type="file" id="IPK" name="fileipk">-->
<!--                        <ul class="inline">
				<li><input type="file" id="IPK" name="fileipk" style="display: none" onChange="IPKchange();"/>
				<input class="unggah" type="text" id="namafileipk" disabled /></li>
				<li><input type="button" value="Pilih..." id="fakeBrowse" onclick="Pilih();"/>
				</li>
			</ul>-->
			
                        <div id="t_nilai">
                        <?php 
                            $this->load("profil/tabel_nilai");
                        ?>
                            </div>
<!--			<ul class="inline">
				<li><input type="file" id="IPK" name="fileipk" style="display: none" onChange="IPKchange();"/>
				<input class="unggah" type="text" id="namafileipk" disabled /></li>
				<li><input type="button" value="Pilih..." id="fakeBrowse" onclick="Pilih();"/>
				</li>
			</ul>
			<input type="button" value=" Tambah" style="margin-right: 40px"/>
			<table class="table-bordered zebra">
				<thead>
					<th>No</th>
					<th>Keterangan</th>
					<th>IP</th>
					<th>File</th>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td><input class="keterangan" type="text" id="ket" name="ket" /></td>
						<td><input class="mini" type="text" id="IP" name="IP" /></td>
						<td><input type="button" value="Pilih..." id="uplod_ip" name="uplod_ip" /></td>
					</tr>
					<tr>
						<td>2</td>
						<td><input class="keterangan" type="text" id="ket" name="ket" /></td>
						<td><input class="mini" type="text" id="IP" name="IP" /></td>
						<td><input type="button" value="Pilih..." id="uplod_ip" name="uplod_ip" /></td>
					</tr>
				</tbody>
			</table>-->
		
		</fieldset>
	</div>
        <div>
<ul class="inline kanan">
	<li><input class="normal" type="button" value="BATAL" style="font-size: 100%" onClick="location.href = '<?php echo URL;?>penerima/profil/<?php echo $this->d_pb->get_kd_pb();?>'"/></li>
	<li><input class="sukses" type="submit" value="SIMPAN" style="font-size: 100%" onclick="return cek();"/></li></ul></div>
</form>

</div> 
<div id="dialog_add_problem">
    <div id="dialog_pb" style="text-align: left;">
    
    <form id="form_add_problem" method="POST" action="">
        <table>
            <input type="hidden" id="cek" value="">
            <input type="hidden" id="kd_pb" name="kd_pb" value="<?php echo $this->d_pb->get_kd_pb();?>">
            <tr><td colspan="2"><h3>REKAM PERMASALAHAN</h3></td></tr>
            <tr><td>Nama</td><td><?php echo $this->d_pb->get_nama();?></td></tr>
            <tr><td>NIP</td><td><?php echo $this->d_pb->get_nip();?></td></tr>
            <div id="winput_mas" class="error"></div>
            <tr><td><label>Uraian</label></td><td><textarea id="uraian" name="uraian" cols="40" rows="10"></textarea></td></tr>
            <tr><td><label>Sumber Permasalahan</label></td><td><input type="text" id="sumber" name="sumber"></td></tr>
<!--            <tr><td colspan="2"><input type="button" id="bt_ok" value="simpan" onclick="return goSelect();"></td></tr>-->
        </table>
    </form>
</div>
</div>
<div id="dialog_add_nilai">
    <div id="dialog_pb" style="text-align: left;">
    
    <form id="form_add_nilai" method="POST" action="">
        <table>
            <input type="hidden" id="kd_pb" name="kd_pb" value="<?php echo $this->d_pb->get_kd_pb();?>">
            <tr><td colspan="2"><h3>REKAM NILAI SEMESTER</h3></td></tr>
            <tr><td>Nama</td><td><?php echo $this->d_pb->get_nama();?></td></tr>
            <tr><td>NIP</td><td><?php echo $this->d_pb->get_nip();?></td></tr>
            <div id="winput_nil" class="error"></div>
            <tr><td><label>IPS</label></td><td><input type="text" id="ips" name="ips"></td></tr>
            <tr><td><label>IPK</label></td><td><input type="text" id="ipk" name="ipk"></td></tr>
            <tr><td><label>Semester</label></td><td><select id="semester" name="semester">
                        <?php 
                            for($i=1;$i<=10;$i++){
                                echo "<option value=$i>Semester $i</option>";
                            }
                        ?>
                    </select></td></tr>
            <tr><td><label>File</label></td><td><input type="file" id="sfile" name="sfile"></td></tr>
<!--            <tr><td colspan="2"><input type="button" id="bt_ok" value="simpan" onclick="return goSelect();"></td></tr>-->
        </table>
    </form>
</div>
</div>
<!--div top-->

<!--</body>-->

<script language="JavaScript" type="text/javascript">
$(function(){
    $('#add_problem').click(function(){
        open_dialog(document.getElementById('id_pb').value,'problem');
    });
    
    $('#add_nilai').click(function(){
        open_dialog(document.getElementById('id_pb').value,'nilai');
    });
    
    $('#off').click(function(){
        var id_pb = document.getElementById('id_pb').value;
        var quest = "Anda yakin merubah status pegawai ini menjadi TIDAK LULUS?";
        if(confirm(quest)){
            $.post('<?php echo URL;?>penerima/set_tidak_lulus',{id_pb:id_pb},
            function(data){
                document.getElementById('sts_tb').value = data;
                $('#off').fadeOut();
            })
        }
        
    })
//    document.write("jvascript gak jalan coii");
    hideErrorId();
    hideWarning();
});

function hideErrorId(){
    $('.error').fadeOut(0);
}

function hideWarning(){
    $('#email').keyup(function(){
        if(document.getElementById('email').value !=''){
            $('#wemail').fadeOut(200);
        }
    })
    
    $('#hp').keyup(function(){
        if(document.getElementById('hp').value !=''){
            $('#wtelp').fadeOut(200);
        }
    })
    
    $('#foto').change(function(){
        if(document.getElementById('foto').value !=''){
            $('#wfoto').fadeOut(200);
        }
    })
    
    $('#SKL').change(function(){
        if(document.getElementById('SKL').value !=''){
            $('#wskl').fadeOut(200);
        }
    })
    
    $('#SPMT').change(function(){
        if(document.getElementById('SPMT').value !=''){
            $('#wspmt').fadeOut(200);
        }
    })
    
    $('#skripsi').keyup(function(){
        if(document.getElementById('skripsi').value !=''){
            $('#wskripsi').fadeOut(200);
        }
    })
    
    $('#uraian').keyup(function(){
            $('#winput_mas').fadeOut(100);
        })
        
    $('#sumber').keyup(function(){
        $('#winput_mas').fadeOut(100);
    })
    
    $('#ips').keyup(function(){
        $('#winput_nil').fadeOut(100);
    })

    $('#ipk').keyup(function(){
        $('#winput_nil').fadeOut(100);
    })

    $('#sfile').change(function(){
        $('#winput_nil').fadeOut(100);
    })

}

function callFromDialog(id_pb,kategori){
    switch(kategori){
        case 'problem':
            $.ajax({
                type:'POST',
                url:'<?php echo URL;?>penerima/get_masalah/'+id_pb+'/editpb',
                data:'',
                success:function(data){
                    $('#t_masalah').fadeIn(200);
                    $('#t_masalah').html(data);
                }
            })
            break;
        case 'nilai':
            $.ajax({
                type:'POST',
                url:'<?php echo URL;?>penerima/get_nilai/'+id_pb+'/editpb',
                data:'',
                success:function(data){
                    $('#t_nilai').fadeIn(200);
                    $('#t_nilai').html(data);
                }
            });
            break;
    }
    
}
function open_dialog(id_pb,kategori){
    switch(kategori){
        case 'problem':
            var url = "<?php echo URL;?>penerima/dialog_masalah/"+id_pb;
            $('#dialog_add_problem').dialog('open');
            break;
        case 'nilai':
            var url = "<?php echo URL;?>penerima/dialog_nilai/"+id_pb;
            $('#dialog_add_nilai').dialog('open');
            break;
    }
    
    var w = 370;
    var h = 500;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    var title = "rekam penerima beasiswa";
//    window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
}

function cek(){
    var alamat = document.getElementById('alamat').value;
    var email = document.getElementById('email').value;
    var telp = document.getElementById('hp').value;
    var foto = document.getElementById('foto').value;
    var skl = document.getElementById('SKL').value;
    var spmt = document.getElementById('SPMT').value;
    var tgl_lapor = document.getElementById('datepicker').value;
    var skripsi = document.getElementById('skripsi').value;
    var jml=0;
    
    
    if(email!=''){
        var pattern = '^[a-zA-Z0-9]*(|[-._][a-zA-Z0-9]*)\@([a-z]*)[.]([a-z]{3,4})';
        if(!email.match(pattern)){
            var wemail = "format email masih salah! [ex.mail@mail.com]";
            $('#wemail').fadeIn(200);
            $('#wemail').html(wemail);
            jml++;
        }
    }
    
    if(telp!=''){
        var pattern = '^0[0-9]{7,15}$';
        if(!telp.match(pattern)){
            var wtelp = "format telepon masih salah! [ex. 0XXXXXXXX]";
            $('#wtelp').fadeIn(200);
            $('#wtelp').html(wtelp);
            jml++;
        }
    }
    
    if(foto!=''){
        var csplit = foto.split(".");
        var ext = csplit[csplit.length-1];
        if(ext!='jpg' && ext!='jpeg'){
            var wfoto = "format file foto harus jpg/jpeg!";
            $('#wfoto').fadeIn(200);
            $('#wfoto').html(wfoto);
            jml++;
        }
    }
    
    if(spmt!=''){
        var csplit = spmt.split(".");
        var ext = csplit[csplit.length-1];
        if(ext!='pdf'){
            var wspmt = "format file SPMT harus pdf!";
            $('#wspmt').fadeIn(200);
            $('#wspmt').html(wspmt);
            jml++;
        }
    }
    
    if(skripsi!=''){
        if(skripsi.length<40){
            var wskripsi = "judul skripsi minimal 40 karakter!";
            $('#wskripsi').fadeIn(200);
            $('#wskripsi').html(wskripsi);
            jml++;
        }
    }
    
    if(tgl_lapor!=''){
        if(skl!=''){
            var csplit = skl.split(".");
            var ext = csplit[csplit.length-1];
            if(ext!='pdf'){
                var wskl = "format file SKL harus pdf!";
                $('#wskl').fadeIn(200);
                $('#wskl').html(wskl);
                jml++;
            }
        }else{
            $.post('<?php echo URL.'penerima/cekfile/'.$this->d_pb->get_kd_pb().'/skl';?>',{kd_pb:''+document.getElementById().value+''},function(data){
//                $('#cek_skl').val(data);
                if(data==0){
                    var wskl = "file SKL harus dipilih!";
                    $('#wskl').fadeIn(200);
                    $('#wskl').html(wskl);
                    jml++;
                }
            });
        }
    }
    
    if(jml>0){
        return false;
    }else{
        return true;
    }
    
    
}

function view_file(file,dokumen){
    var url = '';
    switch(dokumen){
        case 'foto':
            url = "<?php echo URL;?>penerima/view_foto/"+file;
            break;
        case 'skl':
            url = "<?php echo URL;?>penerima/view_skl/"+file;
            break;
        case 'spmt':
            url = "<?php echo URL;?>penerima/view_spmt/"+file;
            break;
    }
    
    var w = 800;
    var h = 500;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    var title = "tampilan transkrip";
    window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    
    
}

var kd_pb = document.getElementById('kd_pb').value;
$( "#dialog_add_problem" ).dialog({
        autoOpen: false,
        height: 450,
        width: 400,
        modal: true,
        buttons: {
            "Simpan": function() {
                var cek_isian = true;
                cek_isian = add_problem();
                if(cek_isian){
                    var formData = new FormData($('#form_add_problem')[0]);

                    $.ajax({
                        url: '<?php echo URL; ?>penerima/add_problem',
                        type: 'POST',
                        data: formData,
                        async: false,
                        success: function () {
                                callFromDialog(kd_pb,'problem'); //or use //window.opener.document.getElementById(idFromCallPage).value = data;
                                document.getElementById('uraian').value='';
                                document.getElementById('sumber').value='';
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    });
                    $( this ).dialog( "close" );
                }


        }
    },
    close: function() {
//                allFields.val( "" ).removeClass( "ui-state-error" );
    }
});
    
    function add_problem(){
        var kd_pb = document.getElementById('kd_pb').value;
        var uraian = document.getElementById('uraian').value;
        var sumber = document.getElementById('sumber').value;
        
        if(uraian==""){
            var winput = "uraian permasalahan harus diisi!"
            $('#winput_mas').html(winput);
            $('#winput_mas').fadeIn(200);
            
            return false;
        }
        
        if(sumber==""){
            var winput = "sumber permasalahan harus diisi!"
            $('#winput_mas').html(winput);
            $('#winput_mas').fadeIn(200);
            
            return false;
        }
        
        return true;
        
    }
    
    $( "#dialog_add_nilai" ).dialog({
            autoOpen: false,
            height: 450,
            width: 400,
            modal: true,
            buttons: {
                "Simpan": function() {
                    var cek_isian = true;
                    cek_isian = add_nilai();
                    if(cek_isian){
                        var formData = new FormData($('#form_add_nilai')[0]);
        
                        $.ajax({
                            url: '<?php echo URL; ?>penerima/add_nilai',
                            type: 'POST',
                            data: formData,
                            async: false,
                            success: function (data) {
                                    callFromDialog(kd_pb,'nilai'); //or use //window.opener.document.getElementById(idFromCallPage).value = data;
                                    document.getElementById('ips').value='';
                                    document.getElementById('ipk').value='';
                            },
                            cache: false,
                            contentType: false,
                            processData: false
                        });
                        $( this ).dialog( "close" );
                    }
                    
                    
            }
        },
        close: function() {
//                allFields.val( "" ).removeClass( "ui-state-error" );
        }
    });
    
    function add_nilai(){
        var kd_pb = document.getElementById('kd_pb').value;
        var ips = document.getElementById('ips').value;
        var ipk = document.getElementById('ipk').value;
        var sem = document.getElementById('semester').value;
        var sfile = document.getElementById('sfile').value;
        var pattern = '^[0-4]{1}[\.][0-9]{1,2}$';
        if(ips==""){
            var winput = "Indeks Prestasi Semester harus diisi!"
            $('#winput_nil').html(winput);
            $('#winput_nil').fadeIn(200);
            
            return false;
        }else if(!ips.match(pattern)){
            var winput = "Indeks Prestasi Semester tidak sesuai format!";
            $('#winput_nil').html(winput);
            $('#winput_nil').fadeIn(200);
            
            return false;
        }else if(ips>4.00){
            var winput = "Tidak ada Indeks Prestasi Semester lebih dari 4.00 [SUPERRR SEKALIIII]!";
            $('#winput_nil').html(winput);
            $('#winput_nil').fadeIn(200);
            
            return false;
        }
        
        if(ipk==""){
            var winput = "Indeks Prestasi Kumulatif harus diisi!";
            $('#winput_nil').html(winput);
            $('#winput_nil').fadeIn(200);
            
            return false;
        }else if(!ipk.match(pattern)){
            var winput = "Indeks Prestasi Kumulatif tidak sesuai format!";
            $('#winput_nil').html(winput);
            $('#winput_nil').fadeIn(200);
            
            return false;
        }else if(ipk>4.00){
            var winput = "Tidak ada Indeks Prestasi Kumulatif lebih dari 4.00 [SUPERRR SEKALIIII]!";
            $('#winput_nil').html(winput);
            $('#winput_nil').fadeIn(200);
            
            return false;
        }
        
        if(sfile==""){
            var winput = "File harus dipilih!"
            $('#winput_nil').html(winput);
            $('#winput_nil').fadeIn(200);
            
            return false;
        }else{
            var fsplit = sfile.split(".");
            var ext = fsplit[fsplit.length-1];
            if(ext!='pdf'){
                var winput = "Format file harus pdf!"
                $('#winput_nil').html(winput);
                $('#winput_nil').fadeIn(200);

                return false;
            }
        }
        
        return true;
        
    }
    
function HandleBrowseClick()
{
    var fileinput = document.getElementById("SKL");
    fileinput.click();
}
function Handlechange()
{
var fileinput = document.getElementById("SKL");
var textinput = document.getElementById("filename");
textinput.value = fileinput.value;
}

function BrowseClick()
{
    var file = document.getElementById("SPMT");
    file.click();
}
function Change()
{
var file = document.getElementById("SPMT");
var text = document.getElementById("namafile");
text.value = file.value;
}

function BrowseFoto()
{
    var fotoinput = document.getElementById("foto");
    fotoinput.click();
}
function FotoChange()
{
var fotoinput = document.getElementById("foto");
var foto = document.getElementById("filefoto");
foto.value = fotoinput.value;
}

function Pilih()
{
    var fileipk = document.getElementById("IPK");
    fileipk.click();
}
function IPKchange()
{
var fileipk = document.getElementById("IPK");
var filenya = document.getElementById("namafileipk");
filenya.value = fileipk.value;
}
</script>