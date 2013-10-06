<table>
    <?php
        foreach($this->d_pb as $v){
            echo "<tr><td>".$v->get_nip()."</td><td align=left>".$v->get_nama()."</td><td width=20%><input type=button value=+ onClick=\"goSelect('".$v->get_kd_pb()."')\"></td>";
        }
    ?>
</table>