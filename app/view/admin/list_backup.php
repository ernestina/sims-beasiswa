<?php
    if(count($this->d_files)!=0){
        echo "<ol>";
        foreach ($this->d_files as $file){
            $temp = explode("-",$file);
            $date = Tanggal::tgl_indo(date('Y-m-d',$temp[3]));
            $time = date('H:i:s',$temp[3]);
            echo "<li>$file&#11 [$date $time]; <a href=".URL."admin/del_backup/$file>hapus</a> <a href=" . URL . "public/backup/$file target='_blank'>download</a></li>";
        }
        echo "</ol>";
    }else{
        echo "FILE BACKUP TIDAK DITEMUKAN";
    }
?>