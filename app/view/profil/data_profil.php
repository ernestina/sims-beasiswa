<?php //include ('../Header.php');?>
<!--link href="../../../public/css/bootstrap.css" rel="stylesheet" media="screen"-->
<div class="container">
    
	<h1>Profil Penerima Beasiswa</h1>
	<h3>Profil Penerima Beasiswa</h3>

	<img src="<?php echo URL.'files/'.$this->d_pb->get_foto();?>" width="150" height="150"><br><br>
<table>
  <!--form method="POST" action="<?php //$_SERVER['PHP_SELF']; echo URL.'admin/addUniversitas'?>"-->
	<tr>
		<td>NIP</td><td>:</td>
		<td><input type="text" name="NIP" id="NIP" size="50" value="<?php echo isset($this->d_pb)?$this->d_pb->get_nip():'';?>"></td>
	</tr>
	<tr>
		<td>Nama</td><td>:</td>
		<td><input type="text" name="nama" id="nama" size="50" value="<?php echo isset($this->d_pb)?$this->d_pb->get_nama():'';?>"></td>
	</tr>
	<tr>
		<td>Jenis Kelamin</td><td>:</td>
		<td><input type="text" name="jeniskelamin" id="jeniskelamin" size="50" value="<?php echo isset($this->d_pb)?$this->d_pb->get_jkel():'';?>"></td>
	</tr>
	<tr>
		<td>Pangkat/Gol</td><td>:</td>
		<td><input type="text" name="pangkat" id="pangkat" size="50" value="<?php echo isset($this->d_pb)?$this->d_pb->get_gol():'';?>"></td>
	</tr>
	<tr>
		<td>Unit asal</td><td>:</td>
		<td><input type="text" name="asal" id="asal" size="50" value="<?php echo isset($this->d_pb)?$this->d_pb->get_unit_asal():'';?>"></td>
	</tr>
	<tr>
		<td>Email</td><td>:</td>
		<td><input type="text" name="email" id="email" size="50" value="<?php echo isset($this->d_pb)?$this->d_pb->get_email():'';?>"></td>
	</tr>
	<tr>
		<td>No. HP</td><td>:</td>
		<td><input type="text" name="hp" id="hp" size="50" value="<?php echo isset($this->d_pb)?$this->d_pb->get_telp():'';?>"></td>
	</tr>
	<tr>
		<td>Bank Penerima</td><td>:</td>
		<td><input type="text" name="bank" id="bank" size="10" value="<?php echo isset($this->d_pb)?$this->d_pb->get_bank():'';?>"> 
		Cabang:<input type="text" name="cabang" id="cabang" size="25"></td>
	</tr>
	<tr>
		<td>No. Rekening</td><td>:</td>
		<td><input type="text" name="rekening" id="rekening" size="50" value="<?php echo isset($this->d_pb)?$this->d_pb->get_no_rek():'';?>"></td>
	</tr>
  <!--/form-->
</table><br>

<h3>Profil Beasiswa</h3>

<table>
  <!--form method="POST" action="<?php //$_SERVER['PHP_SELF']; echo URL.'admin/addUniversitas'?>"-->
	<tr>
		<td>No. Surat Tugas (ST)</td><td>:</td>
		<td><input type="text" name="no_st" id="no_st" size="50"></td>
	</tr>
	<tr>
		<td>Tanggal ST</td><td>:</td>
		<td><input type="text" name="tgl_st" id="tgl_st" size="50"></td>
	</tr>
	<tr>
		<td>Tanggal Mulai ST</td><td>:</td>
		<td><input type="text" name="tgl_mulai_st" id="tgl_mulai_st" size="50"></td>
	</tr>
	<tr>
		<td>Tanggal Akhir ST</td><td>:</td>
		<td><input type="text" name="pangkat" id="pangkat" size="50"></td>
	</tr>
	<tr>
		<td>Jenis Beasiswa</td><td>:</td>
		<td><input type="text" name="jenis_beasiswa" id="jenis_beasiswa" size="50"></td>
	</tr>
	<tr>
		<td>Universitas</td><td>:</td>
		<td><input type="text" name="universitas" id="universitas" size="50"></td>
	</tr>
	<tr>
		<td>Jurusan/Prodi</td><td>:</td>
		<td><input type="text" name="jurusan" id="jurusan" size="50"></td>
	</tr>
	<tr>
		<td>Tahun Masuk</td><td>:</td>
		<td><input type="text" name="th_masuk" id="th_masuk" size="50"></td>
	</tr>
	<tr>
		<td>Status Tugas Belajar</td><td>:</td>
		<td><input type="text" name="status_tb" id="status_tb" size="50"></td>
	</tr>
	<!--row berikut hanya muncul jika status TB: lulus dan/atau tidak lulus -->
	<tr>
		<td>Tanggal Akhir TB</td><td>:</td>
		<td><input type="text" name="status_tb" id="status_tb" size="10">
		No. SKL: <input type="text" name="status_tb" id="status_tb" size="20">
		<button>Lihat...</button>
		</td>
	</tr>
	<tr>
		<td>No. SPMT</td><td>:</td>
		<td><input type="text" name="status_tb" id="status_tb" size="39">
		<button>Lihat...</button>
		</td>
	</tr>
  <!--/form-->
</table>

<h3>Riwayat Pembayaran</h3>
<table border="1px">
	<th>No</th>
	<th>Keterangan Pembayaran</th>
	<th>Jumlah</th>
</table>

<h3>Riwayat Perkembangan Tugas Belajar</h3>
	IPK: <input type="text" name="ipk" id="ipk" size="20">
	<button>Lihat...</button>
	
	<table border="1px">
		<th>No</th>
		<th>Keterangan</th>
		<th>Indeks Prestasi</th>
		<th>&nbsp;</th>
	</table>
	<br>
	<!--Judul TA sebagai trigger munculnya nama mahasiswa ke List Penerima Biaya Skripsi-->
	Judul Tugas Akhir: <br>
		<textarea type="text" name="judul_ta" id="judul_ta" width="150"></textarea><br><br>
	Permasalahan Tugas Belajar: <br>
		<textarea type="text" name="masalah_tb" id="masalah_tb" width="150"></textarea><br>

<h3>Riwayat Penerimaan Beasiswa</h3>

	<table border="1px">
		<th>No</th>
		<th>No. Surat Tugas</th>
		<th>Universitas</th>
		<th>Jurusan/Prodi</th>
		<th>Tahun Masuk</th>
		<th>Status TB</th>
	</table>
    </div>
</div>
