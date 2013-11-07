<?php
if($this->is_pic){
    foreach ($this->d_notif as $v){
        switch($v['jenis']){
            case 'jadup':
                $jenis = 'Pembayaran Jadup ';
                $judul_notif = 'JADUP';
                $pesan = $jenis." ".$v['univ']." - ".$v['jurusan']." ".$v['tahun_masuk']." bulan ".$v['bulan']." ".$v['tahun'];
                break;
            case 'buku':
                $tmp = $v['jatuh_tempo'];
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
                $judul_notif = 'UANG SKRIPSI';
                $pesan = $jenis." ".$v['univ']." - ".$v['jurusan']." ".$v['tahun_masuk'];
                break;
            case 'lulus':
                $jenis = 'Pegawai TB dari ';
                $judul_notif = 'MASA TUGAS BELAJAR';
                $pesan = $jenis." ".$v['univ']." - ".$v['jurusan']." ".$v['tahun_masuk']." selesai bulan ".$v['bulan']." ".$v['tahun'];
                break;
            case 'kontrak':
                $jenis = 'Tagihan Kontrak ';
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
        echo "<div class='detail'>";
        echo "<h4>$jatuh_tempo : <a style='color: #49afcd' href=''>$judul_notif</a></h4>";
        echo "<div class='noti'>$pesan</div>";
        echo "</div>";
        echo "<div class='flag'><img class='noti pic' src='$img'></div></ul>";

    }
}
?>