<table>
    <tr><th>nama</th><th>nip</th><th>tgl masuk</th><th>keterangan</th></tr>
    <?php 
        foreach ($this->data as $val){
            echo "<tr><td>$val[nama]</td>";
            echo "<td>$val[nip]</td>";
            echo "<td>$val[tgl_masuk]</td>";
            echo "<td>$val[keterangan]</td></tr>";
        }
    ?>
</table>
