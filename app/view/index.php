<?php if($this->is_pic){ ?>
<div id="beranda" style="margin: 20px 20px 5px 20px; border: solid 1px;width:70%;display:inline-block; float:left">
<?php
    foreach ($this->d_notif as $v){
        switch($v['jenis']){
            case 'jadup':
                $jenis = 'Pembayaran Jadup ';
                $url = URL.'elemenBeasiswa/addJadup';
                $judul_notif = 'JADUP';
                $pesan = $jenis." ".$v['univ']." - ".$v['jurusan']." ".$v['tahun_masuk']." bulan ".$v['bulan']." ".$v['tahun'];
                break;
            case 'buku':
                $tmp = $v['jatuh_tempo'];
                $url = URL.'elemenBeasiswa/addUangBuku';
                $jenis = 'Pembayaran Uang Buku ';
                $judul_notif = 'UANG BUKU';
                $sem = (int) Tanggal::bulan_num($v['bulan']);
                if($bln==9){
                    $sem = 'ganjil';
                }else{
                    $sem = 'genap';
                }
                $pesan = $jenis." ".$v['univ']." - ".$v['jurusan']." ".$v['tahun_masuk']." untuk semester ".$sem." ".$v['tahun'];
                break;
            case 'skripsi':
                $jenis = 'Pembayaran Uang Skripsi ';
                $url = URL.'elemenBeasiswa/addSkripsi';
                $judul_notif = 'UANG SKRIPSI';
                $pesan = $jenis." ".$v['univ']." - ".$v['jurusan']." ".$v['tahun_masuk'];
                break;
            case 'lulus':
                $jenis = 'Pegawai TB dari ';
                $url = URL.'penerima/datapb';
                $judul_notif = 'MASA TUGAS BELAJAR';
                $pesan = $jenis." ".$v['univ']." - ".$v['jurusan']." ".$v['tahun_masuk']." selesai bulan ".$v['bulan']." ".$v['tahun'];
                break;
            case 'kontrak':
                $jenis = 'Tagihan Kontrak ';
                $url = URL.'kontrak/display';
                $judul_notif = 'PEMBAYARAN KONTRAK';
                $pesan = $jenis." ".$v['univ']." - ".$v['jurusan']." ".$v['tahun_masuk']." bulan ".$v['bulan']." ".$v['tahun'];
                break;
        }
        $jatuh_tempo = "01 ".$v['bulan']." ".$v['tahun'];
        $tmp = explode('-',$v['jatuh_tempo']);
        if(count($tmp)>2){
            $jatuh_tempo = Tanggal::tgl_indo($v['jatuh_tempo']);
        }
        
        if($v['status']=='proses'){
            $img = 'public/icon/purges.png';
        }else{
            $img = 'public/icon/notices.png';
        }
        echo "<ul class='inline noti pic'>";
        echo "<div class='detail' id='halpic'>";
        echo "<h4>$jatuh_tempo : <a style='color: #49afcd' href='$url'>$judul_notif</a></h4>";
        echo "<div class='noti'>$pesan</div>";
        echo "</div>";
        echo "<div class='flag'><img class='noti pic' src='$img'></div></ul>";

    }
?>
    
</div>
<div style="float:left; width:24%; margin: 20px 0% 5px 0px;border: solid 1px">
    <div><img class="frame" src="files/foto/<?php echo $this->d_user->get_foto();?>" style="width:80%;margin: 5px 8% 5px 8%;"></div>
    <div><h4><?php echo strtoupper($this->d_user->get_nmUser());?></h4></div>
    <div><h4>Universitas :</h4>
        <div style="margin:10px 5px 10px 10px">
        <?php 
            foreach ($this->d_univ as $univ){
                echo $univ[0]." ".$univ[1]." pegawai</br>";
            }
        ?>
        </div>
    </div>
    
</div>
<?php } ?>
<input type="hidden" id="jml_notif" value="<?php echo $this->count_notif;?>">
<script type="text/javascript">

$(function(){
//    display_notif();
    var time = 5*1000;
    setInterval(function(){
        count_notif();
    },time);
})

function count_notif(){
    $.post('<?php echo URL; ?>notifikasi/count_notif',{param:""+<?php echo Session::get('kd_user');?>+""},
    function(data){
        var old_count = parseInt(document.getElementById('jml_notif').value);
        if(parseInt(data)>old_count){
            console.log(data);
            $('#jml_notif').val(data);
            $('<audio id="chatAudio"><source src="public/sound/sounds-847-office-2.mp3" type="audio/mpeg"></audio>').appendTo('body');
            $('#chatAudio')[0].play();
//            document.getElementById("sound").innerHTML="<embed src='"+'public/sound/sounds-847-office-2.mp3'+"' hidden=true autostart=true loop=false>";
            display_notif();
        }
    })
}

function display_notif(){
    $.post('<?php echo URL;?>notifikasi/display_notif_pic',{param:""+<?php echo Session::get('kd_user');?>+""},
    function(data){
        $('#beranda').fadeIn(200);
        $('#beranda').html(data);
    })
}
</script>