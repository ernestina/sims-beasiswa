<?php
    if(count($this->d_files)!=0){
        echo "<ol>";
        foreach ($this->d_files as $file){
            echo "<li>$file&#11;<a href=".URL."admin/del_backup/$file>hapus</a> <a href=" . URL . "public/backup/$file target='_blank'>download</a></li>";
        }
        echo "</ol>";
    }else{
        echo "FILE BACKUP TIDAK DITEMUKAN";
    }
?>