<?php //include ('../Header.php');?>
<!--link href="../../../public/css/bootstrap.css" rel="stylesheet" media="screen"-->
<link href="../../../public/css/style.css" rel="stylesheet" media="screen">
<body>
  <div class="wrapper">
  <button>Kembali</button>
	<h1>PROFIL PENERIMA BEASISWA</h1>
	<fieldset><legend>Profil Penerima Beasiswa</legend>
		<div class="foto">
			<img class="frame" src="..." width="180" height="220">
			<button>Unggah</button>
			</div>
		<form action="#" method="post">
			<label class="isian">NIP :</label>
			<input type="text" id="NIP" name="NIP" disabled />
			
			<label class="isian">Nama :</label>
			<input type="text" id="nama" name="nama" disabled />

			<label class="isian">Jenis Kelamin :</label>
			<input type="text" id="jenis_kelamin" name="jenis_kelamin" disabled />
			
			<label class="isian">Pangkat/Gol :</label>
			<input type="text" id="pangkat" name="pangkat" disabled />
			
			<label class="isian">Unit Asal :</label>
			<input type="text" id="asal" name="asal" disabled />
			
			<label class="isian">Alamat :</label>
			<textarea type="text" id="alamat" name="alamat" /></textarea>
			
			<label class="isian">Email :</label>
			<input type="email" id="email" name="email" />
			
			<label class="isian">No. HP :</label>
			<input type="text" id="hp" name="hp" />
			
			<label class="isian">Bank Penerima</label>
			<input type="text" id="bank" name="bank" />
			
			<label class="isian">No Rekening</label>
			<input type="text" id="rekening" name="rekening" />
			
		</form>
	</fieldset><br>
<div class="kolom1">
	<fieldset><legend>Profil Beasiswa</legend>
		<form>
			<label class="isian">No. Surat Tugas (ST) :</label>
			<input type="text" id="st" name="st" disabled />
			
			<label class="isian">Tanggal ST :</label>
			<input type="text" id="tgl_st" name="tanggal_st" disabled />

			<label class="isian">Tanggal Mulai ST :</label>
			<input type="text" id="tgl_mulai_st" name="tgl_mulai_st" disabled />
			
			<label class="isian">Tanggal Akhir ST :</label>
			<input type="text" id="tgl_akhir_st" name="tgl_akhir_st" disabled />
			
			<label class="isian">Jenis Beasiswa :</label>
			<input type="text" id="jenis_beasiswa" name="jenis_beasiswa" disabled />
			
			<label class="isian">Universitas :</label>
			<input type="text" id="universitas" name="universitas" />
			
			<label class="isian">Jurusan :</label>
			<input type="text" id="jurusan" name="jurusan" />
			
			<label class="isian">Tahun Masuk :</label>
			<input type="text" id="th_masuk" name="th_masuk" />
			
			<label class="isian">Status Tugas Belajar (TB) :</label>
			<select type="text">
				<option>belum lulus</option>
				<option>lulus</option>
				<option>lulus awal waktu</option>
				<option>lulus dengan perpanjangan 1</option>
				<option>lulus dengan perpanjangan 2</option>
				<option>tidak lulus</option>
			</select>
			<!--row berikut hanya muncul jika status TB: lulus dan/atau tidak lulus -->
			
			<label class="isian">Tanggal Akhir TB :</label>
			<input type="text" id="tgl_akhir_TB" name="tgl_akhir_TB" />
			
			<label class="isian">Unggah SKL :</label>
			<input type="text" id="skl" name="skl" />
			
			<label class="isian">Tanggal Lapor Selesai TB :</label>
			<input type="text" id="tgl_lapor" name="tgl_lapor" />
			
			<label class="isian">Unggah SPMT :</label>
			<input type="text" id="spmt" name="spmt" />
			
		</form>
	</fieldset>
</div>
<div class="kolom2">
	<fieldset><legend>Riwayat Pembayaran</legend>
			<label class="isian">Unggah SPMT :</label>
			<input type="text" id="spmt" name="spmt" />
	</fieldset>
</div>
	<input type="submit" value="Submit"/><br>

  
</div>
<h3>Riwayat Pembayaran</h3>
<table border="1px">
	<th>No</th>
	<th>Keterangan Pembayaran</th>
	<th>Jumlah</th>
</table>

<h3>Riwayat Perkembangan Tugas Belajar</h3>
	IPK: <input type="text" name="ipk" id="ipk" size="20">
	<button>Unggah...</button>
	
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
	</table><br>
	<button>Reset</button><button>Simpan</button>
    </div>
</div>
</body>