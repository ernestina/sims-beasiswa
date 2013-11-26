<!DOCTYPE html>
<html>
<head>
    <title>.:Treascho:. Notifikasi</title>
    <script src="<?php echo URL; ?>public/js/jquery-2.0.3.min.js"></script>
    <style>
        body{
            background-image:url('../../public/img/bg.png');
        }
        
        .notif{
            padding: 5px 5% 5px 5%;
            border-radius:5px;
            width: 100%;
            /*    text-align: center;*/
            overflow: hidden;
            /*    position: relative;*/
            -webkit-transition: background-color 350ms;
            -moz-transition: background-color 350ms;
            transition: background-color 350ms;
        }
        
        p {
            position: absolute;

            width: 100%;
            height: 100%;

            margin: 0;

            text-align: left;

            filter: dropshadow(color=#000000, offx=1, offy=1);

            transform:translateX(100%);
            -moz-transform:translateX(100%);
            -webkit-transform:translateX(100%);
        }
        
        .inline{
/*            background: rgba(215, 215, 215, 0.5); */
            margin: 0px 0px 10px 0px;
        }
        
        .box-pic{
            display: inline-block;
            background-color: #c73b1b;
/*            background: rgba(215, 215, 215, 0.5); */
/*            border: 1px solid grey;*/
            width: 45%;
            height: 340px;
            margin: 5px 5px 5px 2px;
        }
        
        .foto{
/*            background-color: blue;*/
            display: block;
            width: 200px;
            height: 340px;
/*            border: 1px solid #fff;*/
            float: left;
            text-align: center;
        }
        
        .foto img{
            height: 200px;
            margin: 5px;
            text-align: center;
            border: 2px solid #fff;
            display: block;
        }
        
        .foto.name{
            font: 35px FZLiShu-S01,'Capture it', Helvetica, Georgia, Serif;
            margin: 15px 5px 5px 5px;
            color : #fff;
            display:block;
        }
        
        .pesan-container{
/*            background-color: #c73;*/
            display: block;
            margin: 3px;
            width: 330px;
            height: 330px;
            color:white;
            padding: 3px 3px 0px 3px;
            float: right;
/*            border: 1px solid #fff;*/
        }
        
        .pesan{
            margin-bottom: 2px;
            display:block;
            height: 50px;
            font: 22px 'AvantGarde LT Medium',Georgia, Serif;
        }
        
        .info {
            border-color: red;
            border-radius: 0%;
            width: 40px;
            height: 40px;
            margin-left: 2px;
            padding-left: 7px;
            padding-right: 7px;
            padding-top: 10px;
            display:inline-block;
            float:right;
            font: 22px 'AvantGarde LT Medium','hooge 05_53',Georgia, Serif;
            text-align: center;
        }
        
        .info.warning {
            background-color: orange;
        }
        
        .info.proses {
            background-color: #3399FF; /*greenyellow*/
        }
        
        .jenis{
            display:inline-block
        }
    </style>
</head>
<body>
    <div id="notif_pic">
    <?php 
        /*$data = json_decode($this->d_notif);
        $count = 0;
        foreach ($data as $data){
//            var_dump($data);
            if($count==0){
                echo "<div class=inline>";
            }
            echo "<div class=box-pic>";
            echo "<div class=foto><img src='files/foto/".$data->pic->foto."'>";
            echo "<div class='foto name'>";
            foreach($data as $ky=>$val){
                if($ky=='pic'){
                    foreach ($val as $k=>$v){
                        if($k=='nama'){
                            $pic = explode(' ', $v);
                            echo strtoupper($pic[0]);
                        }
                        
                    }
                    
                }
            }
            echo "</div></div>";
            echo "<div class=pesan-container>";
            foreach ($data as $ky=>$val){
                
                if($ky!='pic'){
                    echo "<div class=pesan><div class=jenis style='display:inline-block'>".$ky."</div> ";
                    foreach ($val as $k=>$v){
                            if($k=='proses'){
                                echo "<div class='info proses' style='display:inline-block;float:right'>".$v."</div>";
                            }  else {
                                echo "<div class='info warning' style='display:inline-block;float:right'>".$v."</div>";
                            }
                            
                    }
                    echo "</div>";
                }
                
                
                
            }
            echo "</div>";
            echo "</div>";
            $count++;
            if($count==2){
                echo "</div>";
            }
            
            if($count==2) $count=0;
        }*/
    ?>

    </div>
</body>
</html>

<script type="text/javascript">
$(document).ready(function(){
    var data_notif = <?php echo $this->d_notif;?>;
    console.log(data_notif);
    var screen_w = screen.availWidth;
    var screen_h = screen.availHeight;
    var w_div_pic;
    var h_div_pic;

    var max_data = 4; //max data per page
    var time_per_item = 20; //on second
    var div_container = 'notif_pic';
    var timer = 1000*60*60*1; //milisecond*second*minute*hour
    setInterval(function(){
    //            create_element(data_notif,max_data, time_per_item, div_container)
            location.reload();
        },timer
    );

    create_element(data_notif,max_data, time_per_item, div_container);
})

var create_element = function(data_notif,max_data, time_per_item, div_container){
    var length_data = data_notif.length; //amount of data
    var num_div = Math.ceil(length_data/max_data); //num of page
    if(length_data>0){
        document.getElementById(div_container).className = 'notif';
        var ul = document.createElement('div');
        var container;
        var count = 0;
        for(var i=0;i<length_data;i++){
            var jinah = i%max_data;

            if((jinah)==0){
                container = document.createElement('p');   
            }
            
            if(count==0){
                var li = document.createElement('div');
                li.className='inline';
            }
            var box_pic = document.createElement('div');
            box_pic.className = 'box-pic';
            var foto = document.createElement('div');
            foto.className = 'foto';
            var img = document.createElement('img');
            img.src = '<?php echo URL; ?>files/foto/'+data_notif[i].pic.foto;
            console.log(data_notif[i].pic.foto);
            /*
             * cek file exist
             */
            var imgsrc = '<?php echo URL;?>files/foto/'+data_notif[i].pic.foto;
            var img1 = new Image();
            img1.src = imgsrc;
            if (img1.width!= 0) {
//                console.log('ya')
                img.src = '<?php echo URL;?>files/foto/'+data_notif[i].pic.foto;
            }else{
//                console.log('no')
                img.src = '<?php echo URL;?>files/foto/android.png';
            }

            foto.appendChild(img);
            var nama = document.createElement('div');
            nama.className = 'foto name';
            var pic_name = data_notif[i].pic.nama;
            var pic_name_split = pic_name.split(" "); 
            pic_name = pic_name_split[0].toUpperCase();
            nama.appendChild(document.createTextNode(pic_name));
            foto.appendChild(nama);
            box_pic.appendChild(foto);
            li.appendChild(box_pic);
            var pesan_container = document.createElement('div');
            pesan_container.className='pesan-container';
            
            if(data_notif[i].hasOwnProperty('jadup')){
                var pesan = document.createElement('div');
                pesan.className = 'pesan';
                var jadup = document.createElement('div');
                jadup.className = 'jenis';
                jadup.appendChild(document.createTextNode('Tunjangan Hidup'));
                pesan.appendChild(jadup);
                var data = data_notif[i].jadup;
                if(data.hasOwnProperty('proses')){
                    var proses = document.createElement('div');
                    proses.className = 'info proses';
                    proses.appendChild(document.createTextNode(data_notif[i].jadup.proses));
                    pesan.appendChild(proses);
                }
                if(data.hasOwnProperty('belum')){
                    var belum = document.createElement('div');
                    belum.className = 'info warning';
                    belum.appendChild(document.createTextNode(data_notif[i].jadup.belum));
                    pesan.appendChild(belum);
//                    console.log(document.createTextNode(data_notif[i].jadup.belum));
                }
                pesan_container.appendChild(pesan);
                
            }
            
            if(data_notif[i].hasOwnProperty('buku')){
                var pesan = document.createElement('div');
                pesan.className = 'pesan';
                var buku = document.createElement('div');
                buku.className = 'jenis';
                buku.appendChild(document.createTextNode('Tunjangan Buku'));
                pesan.appendChild(buku);
                if(data_notif[i].buku.hasOwnProperty('proses')){
                    var proses = document.createElement('div');
                    proses.className = 'info proses';
                    proses.appendChild(document.createTextNode(data_notif[i].buku.proses));
                    pesan.appendChild(proses);
                }
                if(data_notif[i].buku.hasOwnProperty('belum')){
                    var belum = document.createElement('div');
                    belum.className = 'info warning';
                    belum.appendChild(document.createTextNode(data_notif[i].buku.belum));
                    pesan.appendChild(belum);
                }
                pesan_container.appendChild(pesan);
            }
            
            if(data_notif[i].hasOwnProperty('skripsi')){
                var pesan = document.createElement('div');
                pesan.className = 'pesan';
                var skripsi = document.createElement('div');
                skripsi.className = 'jenis';
                skripsi.appendChild(document.createTextNode('Bantuan Skripsi'));
                pesan.appendChild(skripsi);
                if(data_notif[i].skripsi.hasOwnProperty('proses')){
                    var proses = document.createElement('div');
                    proses.className = 'info proses';
                    proses.appendChild(document.createTextNode(data_notif[i].skripsi.proses));
                    pesan.appendChild(proses);
                }
                if(data_notif[i].skripsi.hasOwnProperty('belum')){
                    var belum = document.createElement('div');
                    belum.className = 'info warning';
                    belum.appendChild(document.createTextNode(data_notif[i].skripsi.belum));
                    pesan.appendChild(belum);
                }
                pesan_container.appendChild(pesan);
            }
            
            if(data_notif[i].hasOwnProperty('lulus')){
                var pesan = document.createElement('div');
                pesan.className = 'pesan';
                var lulus = document.createElement('div');
                lulus.className = 'jenis';
                lulus.appendChild(document.createTextNode('Selesai TB'));
                pesan.appendChild(lulus);
                if(data_notif[i].lulus.hasOwnProperty('proses')){
                    var proses = document.createElement('div');
                    proses.className = 'info proses';
                    proses.appendChild(document.createTextNode(data_notif[i].lulus.proses));
                    pesan.appendChild(proses);
                }
                if(data_notif[i].lulus.hasOwnProperty('belum')){
                    var belum = document.createElement('div');
                    belum.className = 'info warning';
                    belum.appendChild(document.createTextNode(data_notif[i].lulus.belum));
                    pesan.appendChild(belum);
                }
                pesan_container.appendChild(pesan);
            }
            
            if(data_notif[i].hasOwnProperty('kontrak')){
                var pesan = document.createElement('div');
                pesan.className = 'pesan';
                var kontrak = document.createElement('div');
                kontrak.className = 'jenis';
                kontrak.appendChild(document.createTextNode('Tagihan Kontrak'));
                pesan.appendChild(kontrak);
                if(data_notif[i].kontrak.hasOwnProperty('proses')){
                    var proses = document.createElement('div');
                    proses.className = 'info proses';
                    proses.appendChild(document.createTextNode(data_notif[i].kontrak.proses));
                    pesan.appendChild(proses);
                }
                if(data_notif[i].kontrak.hasOwnProperty('belum')){
                    var belum = document.createElement('div');
                    belum.className = 'info warning';
                    belum.appendChild(document.createTextNode(data_notif[i].kontrak.belum));
                    pesan.appendChild(belum);
                }
                pesan_container.appendChild(pesan);
            }
            
            count++;
            if(count==2) count=0;
            box_pic.appendChild(pesan_container);

            li.appendChild(box_pic);

            container.appendChild(li);
            ul.appendChild(container);
        }
        document.getElementById(div_container).appendChild(ul);
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
    var div = split_persen(num_elemen); //persen per grup item
    var cssAnimation = document.createElement('style'); //menciptakan tag style
    cssAnimation.type = 'text/css';
    var persen = 0;
    var step_frame = Math.floor(div/5); //step per frame, dibagi 5 frame animasi per grup
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

</script>
    
