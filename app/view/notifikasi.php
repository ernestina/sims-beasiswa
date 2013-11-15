<!DOCTYPE html>
<html>
    <head>
        <title>.:Treascho:.</title>   
        <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
        <link rel="stylesheet" href="<?php echo URL; ?>public/js/jquery-ui-1.10.3/themes/base/jquery.ui.all.css">
        <script src="<?php echo URL; ?>public/js/jquery-ui.js"></script>
        <script src="<?php echo URL; ?>public/js/jquery.form.js"></script>
        <script src="<?php echo URL; ?>public/js/myjs.js"></script>
        <script src="<?php echo URL; ?>public/js/teamdf-jquery-number/jquery.number.js"></script>
        <link href="<?php echo URL; ?>public/css/style.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/dialog.css" rel="stylesheet">
        <link href="<?php echo URL; ?>public/css/notifikasi.css" rel="stylesheet">
    </head>
<body>
<div id="beranda" class="notif">
</div>
</body>
</html>
<script type="text/javascript">
    $(function(){
        var data_notif = <?php echo $this->d_notif; ?>;
        var max_data = 6; //max data per page
        var time_per_item = 10; //on second
        var div_container = 'beranda';
        var timer = 1000*60*60*1; //milisecond*second*minute*hour
        setInterval(function(){
//            create_element(data_notif,max_data, time_per_item, div_container)
                location.reload();
            },timer
        );
        create_element(data_notif,max_data, time_per_item, div_container);
    });
    
    var create_element = function(data_notif,max_data, time_per_item, div_container){
        var length_data = data_notif.length; //amount of data
        var num_div = Math.ceil(length_data/max_data); //num of page
        if(length_data>0){
            document.getElementById(div_container).className = 'notif';
            var notif_container = document.createElement('div');
            notif_container.className = 'marquee';
            var ul = document.createElement('div');
            var container;
            for(var i=0;i<length_data;i++){
                var jinah = i%max_data;
                
                if((jinah)==0){
                    container = document.createElement('p');   
                }
                var li = document.createElement('ul');
                var jenis = '';
                var judul_notif = ''; //judul notifikasi
                var pesan = ''; //detail pesan notifikasi
                var jatuh_tempo = data_notif[i].tgl+" "+(data_notif[i].bulan).substr(0,3)+" "+data_notif[i].tahun
                if(data_notif[i].jenis==='buku'){
                    if(data_notif[i].bulan=='ganjil'){
                        jatuh_tempo = "Semester Ganjil "+data_notif[i].tahun
                    }else{
                        jatuh_tempo = "Semester Genap "+data_notif[i].tahun
                    }
                }
                var bul_sem = data_notif[i].jatuh_tempo; //bulan untuk semester
                switch(data_notif[i].jenis){
                    case 'jadup':
                        li.className = 'inline noti jadup';
                        jenis = 'Pembayaran Jadup '
                        judul_notif = 'JADUP'
                        pesan = jenis+" "+data_notif[i].univ+" - "+data_notif[i].jurusan+" "+data_notif[i].tahun_masuk+" bulan "+data_notif[i].bulan+" "+data_notif[i].tahun;
                        break;
                    case 'buku':
                        //bagian ini belum selesai
                        //masih terkendala dengan penentuan jatuh tempo pembayaran
                        //kapan trigger notif dimunculkan
                        var tmp = data_notif[i].jatuh_tempo;
//                        console.log(tmp)
                        var bul_sem = tmp.substr(4,2);
//                        console.log(bul_sem);
                        li.className = 'inline noti buku';
                        jenis = 'Pembayaran Uang Buku '
                        judul_notif = 'UANG BUKU'
                        pesan = jenis+" "+data_notif[i].univ+" - "+data_notif[i].jurusan+" "+data_notif[i].tahun_masuk+" untuk semester "+data_notif[i].bulan+" "+data_notif[i].tahun;
                        break;
                    case 'skripsi':
                        li.className = 'inline noti skripsi';
                        jenis = 'Pembayaran Uang Skripsi '
                        judul_notif = 'UANG SKRIPSI'
                        pesan = jenis+" "+data_notif[i].univ+" - "+data_notif[i].jurusan+" "+data_notif[i].tahun_masuk;
                        break;
                    case 'lulus':
                        li.className = 'inline noti lulus';
                        jenis = 'Pegawai TB dari '
                        judul_notif = 'MASA TUGAS BELAJAR'
                        pesan = jenis+" "+data_notif[i].univ+" - "+data_notif[i].jurusan+" "+data_notif[i].tahun_masuk+" selesai bulan "+data_notif[i].bulan+" "+data_notif[i].tahun;
                        break;
                    case 'kontrak':
                        li.className = 'inline noti kontrak';
                        jenis = 'Tagihan Kontrak '
                        judul_notif = 'PEMBAYARAN KONTRAK'
                        pesan = jenis+" "+data_notif[i].univ+" - "+data_notif[i].jurusan+" "+data_notif[i].tahun_masuk+" bulan "+data_notif[i].bulan+" "+data_notif[i].tahun;
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
                h4.appendChild(document.createTextNode(jatuh_tempo+' : '))
                h4.appendChild(a);
                
                tgl.appendChild(document.createTextNode(jatuh_tempo));
                var judul = document.createElement('p');
                judul.appendChild(document.createTextNode(judul_notif))
                
                var p = document.createElement('div');
                p.className= 'noti'
                p.appendChild(document.createTextNode(pesan));
                content_notif.appendChild(h4);
                content_notif.appendChild(p);
                
                img.className='noti'
                var status_proses = data_notif[i].status==='proses'
//                console.log(status_proses); 
                if(status_proses){
                    img.src = 'public/icon/purges.png'
                }else{
                    img.src = 'public/icon/notices.png'
                }
                
                flag.appendChild(img);
                
                content_notif.className = "detail";
                pic.className = 'fotopic';
                flag.className = 'flag'
                
                li.appendChild(pic);
                li.appendChild(content_notif);
                li.appendChild(flag);
                
                container.appendChild(li);
                ul.appendChild(container);
            }
            notif_container.appendChild(ul);
            document.getElementById('beranda').appendChild(notif_container);
        }
        
        add_css_child(num_div,time_per_item);
        add_keyframe(num_div);
    }
    
    var add_css_child = function(num_div,time_per_item){
        for(var i=1;i<=num_div;i++){
            var order = num_to_text(i)+''; //untuk penamaan animasi
            var num = i+''; //child ke-
            var timing = num_div*time_per_item; //ntar diganti 10
            var animation = 'left-'+order+' 20s ease infinite';
            $('p:nth-child('+num+')').css({'animation':'left-'+order+' '+timing+'s ease infinite','-moz-animation':'left-'+order+' '+timing+'s ease infinite','-webkit-animation':'left-'+order+' '+timing+'s ease infinite'}); //nambah css ke p child ke n         
        }
    }
    
    var add_keyframe = function(num_elemen){
        var div = split_persen(num_elemen); 
        var cssAnimation = document.createElement('style');
        cssAnimation.type = 'text/css';
        var persen = 0;
        var step_frame = Math.floor(div/5);
        for(var i=0;i<num_elemen;i++){
            var order = num_to_text(i+1);
            var frame_one = i*div;
            var frame_two = frame_one+step_frame; //mulai bergerak
            if((num_elemen-1)==i){
                var frame_four = 100;
            }else{
                var frame_four = (i+1)*div;
            }
            
            var frame_three = frame_four-step_frame;
//            console.log(frame_one+' '+frame_two+' '+frame_three+' '+frame_four)
            var rules = document.createTextNode('@-webkit-keyframes left-'+order+' {'+
            '0% { -webkit-transform:translateX(100%); }'+
            ''+frame_one+'% { -webkit-transform:translateX(100%); }'+
            ''+frame_two+'% { -webkit-transform:translateX(0); }'+
            ''+frame_three+'% { -webkit-transform:translateX(0); }'+
            ''+frame_four+'% { -webkit-transform:translateX(-110%); }'+
            '100% { -webkit-transform:translateX(-110%); }'+
            '}'+
            '@-moz-keyframes left-'+order+' {'+
            '0% { -moz-transform:translateX(100%); }'+
            ''+frame_one+'% { -moz-transform:translateX(100%); }'+
            ''+frame_two+'% { -moz-transform:translateX(0); }'+
            ''+frame_three+'% { -moz-transform:translateX(0); }'+
            ''+frame_four+'% { -moz-transform:translateX(-110%); }'+
            '100% { -moz-transform:translateX(-110%); }'+
            '}');
//            console.log(rules);
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
        if(num>20 || num<10){
            alert('angka harus antara 10 sampai 20');
            return false;
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
            return false;
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
    
    var get_semester = function(bulan){
        if(bulan<8){
            return 'genap';
        }else{
            return 'ganjil';
        }
    }

</script>