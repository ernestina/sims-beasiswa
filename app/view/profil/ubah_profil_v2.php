<link href="../../../public/css/style.css" rel="stylesheet" media="screen">
<body>
  
  <div id="top">
  <!--level1: Profil Penerima Beasiswa-->
  
	<h1>PROFIL PENERIMA BEASISWA</h1>
	
<div class="kolom1">
	<fieldset><legend>Profil Penerima Beasiswa</legend>


		<form action="#" method="post">
                    <input type="hidden" id="id_pb" value="<?php echo $this->d_pb->get_kd_pb();?>">
			<label class="isian">NIP :</label>
			<input type="text" id="NIP" name="NIP" disabled value="<?php echo $this->d_pb->get_nip();?>"/>
			
			<label class="isian">Nama :</label>
			<input type="text" id="nama" name="nama" disabled value="<?php echo $this->d_pb->get_nama();?>"/>

			<label class="isian">Jenis Kelamin :</label>
			<input type="text" id="jenis_kelamin" name="jenis_kelamin" disabled value="<?php echo ($this->d_pb->get_jkel()==1)?'Laki-laki':'Perempuan';?>"/>
			
			<label class="isian">Pangkat/Gol :</label>
                        <input type="text" id="pangkat" name="pangkat" disabled value="<?php echo Golongan::golongan_int_string($this->d_pb->get_gol());?>"/>
			
			<label class="isian">Unit Asal :</label>
			<input type="text" id="asal" name="asal" disabled value="<?php echo $this->d_pb->get_unit_asal();?>"/>
			
			<label class="isian">Alamat :</label>
			<textarea type="text" id="alamat" name="alamat" rows="7"/><?php echo $this->d_pb->get_alamat();?></textarea>
			
			<label class="isian">Email :</label>
			<input type="email" id="email" name="email" value="<?php echo $this->d_pb->get_email();?>"/>
			
			<label class="isian">No. HP :</label>
			<input type="text" id="hp" name="hp" value="<?php echo $this->d_pb->get_telp();?>"/>
			
			<label class="isian">Bank Penerima</label>
			<input type="text" id="bank" name="bank" value="<?php echo $this->d_bank->get_nama();?>"/>
			
			<label class="isian">No Rekening</label>
			<input type="text" id="rekening" name="rekening" value="<?php echo $this->d_pb->get_no_rek();?>"/>
			
			<label class="isian">Unggah Foto:</label>
			<ul class="inline">
				<li><input type="file" id="foto" name="fotoinput" style="display: none" onChange="FotoChange();"/>
				<input class="unggah" type="text" id="filefoto" disabled /></li>
				<li><input type="button" value="Pilih..." id="fakeBrowse" onclick="BrowseFoto();"/>
				</li>
			</ul>

	</fieldset>
</div>	
	<!--level2: Profil Beasiswa & Riwayat Pembayaran-->
	<div class="kolom2">
		<fieldset><legend>Profil Beasiswa</legend>
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
			<select type="text">
<!--				<option>belum lulus</option>
				<option>lulus</option>
				<option>lulus awal waktu</option>
				<option>lulus dengan perpanjangan 1</option>
				<option>lulus dengan perpanjangan 2</option>
				<option>tidak lulus</option>-->
                                <?php 
                                    foreach ($this->t_jst as $v){
                                        if($v->get_kode()==$this->d_jst->get_kode()){
                                            echo "<option value=".$v->get_kode()." selected>".$v->get_nama()."</option>";
                                        }else{
                                            echo "<option value=".$v->get_kode().">".$v->get_nama()."</option>";
                                        }
                                    }
                                ?>
			</select>
			<!--row berikut hanya muncul jika status TB: lulus dan/atau tidak lulus -->
			
			<label class="isian">Tanggal Akhir TB :</label>
			<input type="text" id="tgl_akhir_TB" name="tgl_akhir_TB" />
			
			<label class="isian">Unggah SKL :</label>
			<!--input type="file" id="skl" name="skl" /-->
			<ul class="inline">
				<li><input type="file" id="SKL" name="fileinput" style="display: none" onChange="Handlechange();"/>
				<input class="unggah" type="text" id="filename" disabled /></li>
				<li><input type="button" value="Pilih..." id="fakeBrowse" onclick="HandleBrowseClick();"/>
				</li>
			</ul>
			<label class="isian">Tanggal Lapor Selesai TB :</label>
			<input type="text" id="tgl_lapor" name="tgl_lapor" />
			
			<label class="isian">Unggah SPMT :</label>
			<ul class="inline">
				<li><input type="file" id="SPMT" name="fileinput" style="display: none" onChange="Change();"/>
				<input class="unggah" type="text" id="namafile" disabled /></li>
				<li><input type="button" value="Pilih..." id="fakeBrowse" onclick="BrowseClick();"/>
				</li>
			</ul>
	</fieldset>
</div>
	
	<!--level3: Riwayat Perkembangan Studi-->
	<div id="fitur">
  
	<fieldset><legend>Riwayat Perkembangan Studi</legend>
		<div class="kolom5">
		
			<label class="isian2">Judul Tugas Akhir/Skripsi/Thesis/Desertasi :</label>
			<textarea class="midi" type="text" rows="4"><?php echo $this->d_pb->get_skripsi();?></textarea>
			<label class="isian2">Permasalahan Tugas Belajar :</label>
                        <input type="button" value="+" id="add_problem">
<!--			<textarea class="midi" type="text" rows="8"></textarea>-->
                        <div id="t_masalah">
                        <?php 
                            $this->load('profil/tabel_masalah');
                        ?>
			</div> 
		</div>
		
			<label class="isian">IPK :</label>
			<input type="text" id="IPK" name="IPK" value="<?php echo $this->d_cur_ipk->get_ipk()/100;?>"/>
			
			<label class="isian">Unggah Transkrip:</label>
                        <ul class="inline">
				<li><input type="file" id="IPK" name="fileipk" style="display: none" onChange="IPKchange();"/>
				<input class="unggah" type="text" id="namafileipk" disabled /></li>
				<li><input type="button" value="Pilih..." id="fakeBrowse" onclick="Pilih();"/>
				</li>
			</ul>
			<input type="button" value="+" id="add_nilai">
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
<ul class="inline kanan">
	<li><input class="normal" type="submit" value="BATAL" style="font-size: 130%"/></li>
	<li><input class="sukses" type="submit" value="SIMPAN" style="font-size: 130%"/></li>
</form>

</div> <!--div top-->

</body>

<script language="JavaScript" type="text/javascript">
$(function(){
    $('#add_problem').click(function(){
        open_dialog(document.getElementById('id_pb').value,'problem');
    });
    
    $('#add_nilai').click(function(){
        open_dialog(document.getElementById('id_pb').value,'nilai');
    });
});

function callFromDialog(id_pb,kategori){
    switch(kategori){
        case 'problem':
            $.ajax({
                type:'POST',
                url:'<?php echo URL;?>penerima/get_masalah/'+id_pb,
                data:'',
                success:function(data){
                    $('#t_masalah').fadeIn(200);
                    $('#t_masalah').html(data);
                }
            })
            break;
        case 'nilai':
            alert(id_pb);
            break;
    }
    
}
function open_dialog(id_pb,kategori){
    switch(kategori){
        case 'problem':
            var url = "<?php echo URL;?>penerima/dialog_masalah/"+id_pb;
            break;
        case 'nilai':
            var url = "<?php echo URL;?>penerima/dialog_nilai/"+id_pb;
            break;
    }
    
    var w = 370;
    var h = 500;
    var left = (screen.width/2)-(w/2);
    var top = (screen.height/2)-(h/2);
    var title = "rekam penerima beasiswa";
    window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
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