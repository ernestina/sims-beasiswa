<div style="float: right; width: 90%; background-color: #ffffff">
<style>
        .fotopic {
                /*border: 2px solid red;
                background-color: #ba141a;*/
                
                width: 70px;
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
        div.noti {
                font-family: Menu;
                margin-top: -10px;
                margin-left: 10px;
        }
        ul.noti {
                height: 75px; margin: 5px; 
                background-color: #F3F3F3;
                background-image: url('public/img/bg.png');
                -webkit-border-radius: 40px 0px 0px 40px;
                border-radius: 40px 0px 0px 40px;
        }
        h4 {
                font-family: Nexa;
                font-size: 120%;
                margin: 10px;
        }
        
</style>
<!--        <h2>notifikasi</h2>
        <ul class="inline noti">
                <div class="fotopic" style="background-image:url('public/img/logo2.jpg');"></div>
                <div class="detail">
                <h4>Okt 2013:<a style="color: #49afcd"> Tunjangan Hidup</a></h4>
                <div class="noti">Pembayaran Jadup UI - Sistem Informasi 2012 bulan Oktober 2013.</div>
                </div>
                <div class="flag"><img class="noti" src='public/icon/notices.png'></div>
                
        </ul>
        <ul class="inline noti">
                <div class="fotopic" style="background-image:url('public/img/android.png');"></div>
                <div class="detail"><h4>Okt 2013:<a style="color: #49afcd"> Tunjangan TA/Skripsi/Thesis</a></h4>
                <div class="noti">Pembayaran Buku UI - Sistem Informasi 2012 untuk Semester I - 2013.</div></div>
                <div class="flag"><img class="noti" src='public/icon/purges.png'></div>
        </ul>-->
</div>
<div id="beranda" class="notif">
<!--    <marquee id="marikue" scrollamount="2" behavior="scroll" direction="up" style="height:620px">-->
        <!--    <ul>
                <li class="jadup">
                    <div class="tanggal">fsdfs</div>
                    <div class="content_notif">fdsfsd</div>
                    <div class="foto_pic">fdsfsd</div>
                </li>
            </ul>-->
<!--    </marquee>-->
</div>


<script type="text/javascript">
    $(function(){
        var data_notif = <?php echo $this->d_notif; ?>;
        var length_data = data_notif.length;
//        console.log(length_data);
        var max_data = 10;
        var num_div = Math.ceil(length_data/max_data);
//        console.log(num_div);
        if(length_data>0){
            document.getElementById('beranda').className = 'notif';
            var ul = document.createElement('div');
//            ul.className = 'marquee'
            var container;
            for(var i=0;i<length_data;i++){
                var jinah = i%10;
//                console.log('p:nth-child('+(jinah+1)+')')
                
                if((jinah)==0){
                    container = document.createElement('p');
//                    var child = Math.ceil(i/10);
////                    console.log('p:nth-child('+child+')');
//                    var order = num_to_text(Math.ceil(i/10));
//                    $('p:nth-child('+child+')').css({'animation':'left-'+order+' 10s ease infinite','-moz-animation':'left-one 10s ease infinite','-webkit-animation':'left-one 10s ease infinite'}); //nambah css ke p child ke n         
                }
                var li = document.createElement('ul');
//                li.className = 'jadup';
                //                var content = data_notif[i].jenis;
                //                li.appendChild(document.createTextNode(content));
                var jenis = '';
                var judul_notif = '';
                var pesan = '';
                var jatuh_tempo = (data_notif[i].bulan).substr(0,3)+" "+data_notif[i].tahun
                switch(data_notif[i].jenis){
                    case 'jadup':
                        li.className = 'inline noti';
                        jenis = 'JADUP '
                        judul_notif = 'Tunjangan Hidup'
                        pesan = jenis+" "+data_notif[i].univ+" jur. "+data_notif[i].jurusan+" Tahun masuk "+data_notif[i].tahun_masuk+" dalam "+data_notif[i].status+" oleh "+data_notif[i].nama_pic;
                        break;
                    case 'buku':
                        li.className = 'inline noti';
                        jenis = 'UANG BUKU '
                        judul_notif = 'Bantuan Buku'
                        pesan = jenis+" "+data_notif[i].univ+" jur. "+data_notif[i].jurusan+" Tahun masuk "+data_notif[i].tahun_masuk+" dalam "+data_notif[i].status+" oleh "+data_notif[i].nama_pic;
                        break;
                    case 'skripsi':
                        li.className = 'inline noti';
                        jenis = 'UANG SKRIPSI '
                        judul_notif = 'Bantuan Skripsi'
                        pesan = jenis+" "+data_notif[i].univ+" jur. "+data_notif[i].jurusan+" Tahun masuk "+data_notif[i].tahun_masuk+" dalam "+data_notif[i].status+" oleh "+data_notif[i].nama_pic;
                        break;
                    case 'lulus':
                        li.className = 'inline noti';
                        jenis = 'Pegawai TB dari '
                        judul_notif = 'Masa Tugas Belajar'
                        pesan = jenis+" "+data_notif[i].univ+" jur. "+data_notif[i].jurusan+" Tahun masuk "+data_notif[i].tahun_masuk+" : "+ data_notif[i].nama_pic;
                        break;
                    case 'kontrak':
                        li.className = 'inline noti';
                        jenis = 'TAGIHAN '
                        judul_notif = 'Pembayaran Kontrak'
                        pesan = jenis+" "+data_notif[i].univ+" jur. "+data_notif[i].jurusan+" Tahun masuk "+data_notif[i].tahun_masuk+" dalam "+data_notif[i].status+" oleh "+data_notif[i].nama_pic;
                        break;
                }
                judul_notif.toUpperCase();
                var tgl = document.createElement('div');
                var content_notif = document.createElement('div');
                var pic = document.createElement('div');
                var flag = document.createElement('div');
                var h4 = document.createElement('h4');
                var a = document.createElement('a');
                var img = document.createElement('img');
                
                pic.style.backgroundImage='url(\'public/img/'+data_notif[i].foto_pic+'\')';
                
                a.style.color = '#49afcd'
                a.appendChild(document.createTextNode(judul_notif));
                h4.appendChild(document.createTextNode(jatuh_tempo+':'))
                h4.appendChild(a);
                
                tgl.appendChild(document.createTextNode(jatuh_tempo));
                var judul = document.createElement('p');
                judul.appendChild(document.createTextNode(judul_notif))
                
                var p = document.createElement('div');
                p.className= 'noti'
                p.appendChild(document.createTextNode(pesan));
                //                content_notif.appendChild(judul)
                content_notif.appendChild(h4);
                content_notif.appendChild(p);
                
                img.className='noti'
                var status_proses = data_notif[i].status==='proses'
                console.log(status_proses); 
                if(status_proses){
                    img.src = 'public/icon/purges.png'
                }else{
                    img.src = 'public/icon/notices.png'
                }
                
                flag.appendChild(img);
                
//                tgl.className = "tanggal";
                content_notif.className = "detail";
                pic.className = 'fotopic';
                flag.className = 'flag'
                
//                content_notif.appendChild(tgl);
                li.appendChild(pic);
                li.appendChild(content_notif);
                li.appendChild(flag);
                
                container.appendChild(li);
                ul.appendChild(container);
                //                console.log(data_notif[i])
            }
            document.getElementById('beranda').appendChild(ul);
        }
        
        for(var i=1;i<=num_div;i++){
            var order = num_to_text(i)+'';
//            console.log(order+' '+i);
            var num = i+'';
            var timing = num_div*3; //ntar diganti 10
            var animation = 'left-'+order+' 20s ease infinite';
            $('p:nth-child('+num+')').css({'animation':'left-'+order+' '+timing+'s ease infinite','-moz-animation':'left-'+order+' '+timing+'s ease infinite','-webkit-animation':'left-'+order+' '+timing+'s ease infinite'}); //nambah css ke p child ke n         
        }
        
//        for(i=0;i<21;i++){
//            num_to_text(i);
//        }
        add_keyframe(num_div);
    });
    
    var add_keyframe = function(num_elemen){
        var div = split_persen(num_elemen);
//        console.log(div)
        var cssAnimation = document.createElement('style');
        cssAnimation.type = 'text/css';
        var persen = 0;
        var step_frame = Math.floor(div/5);
        for(var i=0;i<num_elemen;i++){
            var order = num_to_text(i+1);
            var frame_one = i*div;
            var frame_two = frame_one+step_frame; //mulai bergerak
            var frame_four = (i+1)*div;
            var frame_three = frame_four-step_frame; 
//            console.log(frame_one+' '+frame_two+' '+frame_three+' '+frame_four)
            var rules = document.createTextNode('@-webkit-keyframes left-'+order+' {'+
            '0% { -webkit-transform:translateX(100%); }'+
            ''+frame_one+'% { -webkit-transform:translateX(100%); }'+
            ''+frame_two+'% { -webkit-transform:translateX(0); }'+
            ''+frame_three+'% { -webkit-transform:translateX(0); }'+
            ''+frame_four+'% { -webkit-transform:translateX(-100%); }'+
            '100% { -webkit-transform:translateX(-100%); }'+
            '}'+
            '@-moz-keyframes left-'+order+' {'+
            '0% { left:100%; }'+
            ''+frame_one+'% { left:100%; }'+
            ''+frame_two+'% { left:0; }'+
            ''+frame_three+'% { left:0; }'+
            ''+frame_four+'% { left:-100; }'+
            '100% { left:-100%; }'+
            '}');
            console.log(rules);
            cssAnimation.appendChild(rules);
        }
        
        document.getElementsByTagName("head")[0].appendChild(cssAnimation);
    }
    
    var split_persen = function(num){
        return Math.floor(100/num);
    }
    
    var num_to_text = function(num){
            var len = (num.toString()).length;
            if(len===1){
                return num_below_ten(num)
            }else{
                return num_ten_to_twenty(num);
            }
            
        }
        
    var num_below_ten = function(num){
        var len = (num.toString()).length;
        var is_above_zero = num>=0;
        var is_below_ten = num<10;
        if(!is_above_zero || !is_below_ten){
            alert("angka harus antara 0 sampai 9");
        }
        var hasil = '';
        switch(num){
            case 0:
                hasil = 'zero';
                break;
            case 1:
                hasil = 'one';
                break;
            case 2:
                hasil = 'two';
                break;
            case 3:
                hasil = 'three';
                break;
            case 4:
                hasil = 'four';
                break;
            case 5:
                hasil = 'five';
                break;
            case 6:
                hasil = 'six';
                break;
            case 7:
                hasil = 'seven';
                break;
            case 8:
                hasil = 'eight';
                break;
            case 9:
                hasil = 'nine';
                break;     
        }
        return hasil;
    }

    var num_ten_to_twenty = function(num){
//            var len = (num.toString()).length;
        if(num>20 || num<10){
            alert('angka harus antara 10 sampai 20');
        }

        var tens = Math.floor(num/10);
        var denomination = num%10;
        if(tens===1 && denomination===0){
            return 'ten';
        }else if(denomination===1){
            return 'eleven';
        }else if(denomination===2){
            return 'twelve';
        }else if(denomination===3){
            return 'thirteen';
        }else if(denomination==5){
            return 'fifteen';
        }else if(tens==2){
            return 'twenty';
        }else{
            return num_below_ten(denomination)+'teen';
        }

    }
    
    var num_above_twenty_to_hundred = function(num){
        if(num<21 || num>99){
            alert('angka harus antara 21 sampai 99')
        }
        
        var ten = 'ty';
        var tens = Math.floor(num/10);
        var denomination = num%10;
        if(tens===5){
            return 'fif'+ten+' '+num_below_ten(denomination)
        }else{
            return num_below_ten(tens)+ty+' '+num_below_ten(denomination)
        }
    }

</script>