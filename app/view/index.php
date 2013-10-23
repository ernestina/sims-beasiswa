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