<div style="float: right; width: 450px; background-color: #ffffff">
<style>
	.fotopic {
		/*border: 2px solid red;
		background-image:url('public/img/bg.png');*/
		background-color: #ba141a;
		color: #ffffff;
		width: 17%;
		float: left;
		margin: 4px 5px 0px -35px;
		height: 90%;
		text-align: center;
		border-radius: 40px;
		box-shadow: 1px 1px 3px #B8B8B8;
	}
	.detail {
		/*border: 2px solid blue;
		background-color: #F3F3F3;*/
		width: 80%;
		float: left;
		margin-right: 0%;
		height: 100%;
	}
	.flag {
		float: left;
		height: 100%;
		width: 30px;
		/*background-image:url('public/icon/notice.png');*/
		background-repeat: no-repeat;
		/*background-color: #F0F0F0;*/
		margin-left: 0px;
	}
	img.noti {
		/*height: 40%;*/
		margin: 20px 0px 0px -10px;
	}
	p.noti {
		font-family: Menu;
		margin-top: -10px;
		margin-left: 10px;
	}
	ul.noti {
		height: 75px; margin: 5px; 
		background-color: #F3F3F3;
		-webkit-border-radius: 40px 0px 0px 40px;
        border-radius: 40px 0px 0px 40px;
	}
	h4 {
		font-family: Nexa;
		font-size: 120%;
		margin: 10px;
	}
	
</style>
	<h2>notifikasi</h2>
	<ul class="inline noti">
		<div class="fotopic"><h3>foto</h3></div>
		<div class="detail">
		<h4>Okt 2013:<a style="color: #49afcd"> Tunjangan Hidup</a></h4>
		<p class="noti">Pembayaran Jadup UI - Sistem Informasi 2012 bulan Oktober 2013.</p>
		</div>
		<div class="flag"><img class="noti" src='public/icon/notices.png'></div>
		
	</ul>
	<ul class="inline noti">
		<div class="fotopic"><h3>foto</h3></div>
		<div class="detail"><h4>Okt 2013:<a style="color: #49afcd"> Tunjangan TA/Skripsi/Thesis</a></h4>
		<p class="noti">Pembayaran Buku UI - Sistem Informasi 2012 untuk Semester I - 2013.</p></div>
		<div class="flag"><img class="noti" src='public/icon/purges.png'></div>
	</ul>
</div>

<div id="beranda" class="notif">
<!--    <ul>
        <li class="jadup">
            <div class="tanggal">fsdfs</div>
            <div class="content_notif">fdsfsd</div>
            <div class="foto_pic">fdsfsd</div>
        </li>
    </ul>-->
</div>


<script type="text/javascript">
    $(function(){
        var data_notif = <?php echo $this->d_notif; ?>;
        var length_data = data_notif.length;
        if(length_data>0){
            document.getElementById('beranda').className = 'notif';
            var ul = document.createElement('ul');
            
            for(var i=0;i<length_data;i++){
                var li = document.createElement('li');
//                li.className = 'jadup';
//                var content = data_notif[i].jenis;
//                li.appendChild(document.createTextNode(content));
                var jenis = '';
                var judul_notif = '';
                var pesan = '';
                switch(data_notif[i].jenis){
                    case 'jadup':
                        li.className = 'jadup';
                        jenis = 'Pembayaran tunjangan hidup '
                        judul_notif = 'Tunjangan Hidup'
                        pesan = jenis+" "+data_notif[i].univ+" jurusan "+data_notif[i].jurusan+" Tahun masuk "+data_notif[i].tahun_masuk+" dalam "+data_notif[i].status+" oleh "+data_notif[i].nama_pic;
                        break;
                    case 'buku':
                        li.className = 'buku';
                        jenis = 'Pembayaran bantuan buku '
                        judul_notif = 'Bantuan Buku'
                        pesan = jenis+" "+data_notif[i].univ+" jurusan "+data_notif[i].jurusan+" Tahun masuk "+data_notif[i].tahun_masuk+" dalam "+data_notif[i].status+" oleh "+data_notif[i].nama_pic;
                        break;
                    case 'skripsi':
                        li.className = 'skripsi';
                        jenis = 'Pembayaran bantuan skripsi '
                        judul_notif = 'Bantuan Skripsi'
                        pesan = jenis+" "+data_notif[i].univ+" jurusan "+data_notif[i].jurusan+" Tahun masuk "+data_notif[i].tahun_masuk+" dalam "+data_notif[i].status+" oleh "+data_notif[i].nama_pic;
                        break;
                    case 'lulus':
                        li.className = 'lulus';
                        jenis = 'Masa tugas belajar penerima beasiswa '
                        judul_notif = 'Masa Tugas Belajar'
                        pesan = jenis+" "+data_notif[i].univ+" jurusan "+data_notif[i].jurusan+" Tahun masuk "+data_notif[i].tahun_masuk+" : "+ data_notif[i].nama_pic;
                        break;
                    case 'kontrak':
                        li.className = 'kontrak';
                        jenis = 'Pembayaran kontrak '
                        judul_notif = 'Pembayaran Kontrak'
                        pesan = jenis+" "+data_notif[i].univ+" jurusan "+data_notif[i].jurusan+" Tahun masuk "+data_notif[i].tahun_masuk+" dalam "+data_notif[i].status+" oleh "+data_notif[i].nama_pic;
                        break;
                }
                judul_notif.toUpperCase();
                var tgl = document.createElement('div');
                var content_notif = document.createElement('div');
                var pic = document.createElement('div');
               
                
                tgl.appendChild(document.createTextNode(data_notif[i].jatuh_tempo));
                var judul = document.createElement('p');
                judul.appendChild(document.createTextNode(judul_notif))
                
                var p = document.createElement('p');
                p.appendChild(document.createTextNode(pesan));
//                content_notif.appendChild(judul)
                content_notif.appendChild(p);
                
                tgl.className = "tanggal";
                content_notif.className = "content_notif";
                pic.className = 'foto_pic';
                
                li.appendChild(tgl);
                li.appendChild(content_notif);
                li.appendChild(pic);
                ul.appendChild(li);
//                console.log(data_notif[i])
            }
            document.getElementById('beranda').appendChild(ul);
        }
        
    });

</script>