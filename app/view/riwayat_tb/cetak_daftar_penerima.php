<!DOCTYPE html>
<html>
    <head>
        <title>daftar_penerima_beasiswa_<?php echo Tanggal::getTimeSekarang(); ?></title>   
        <style>
            td, th {
                border: 1px solid black;
            }
            table {
                border-collapse: collapse;
            }
            .td2{
                border: 0px ;
            }

            @media print {
                #printbtn {
                    display :  none;
                }
            }
            </style>
    </head>
    <body style="font-family:arial;color:black;font-size:10px;">
        <p align="center" style="font-weight: bold; font-size:13px;">
            DAFTAR PENERIMA BEASISWA <br />
            BEASISWA INTERNAL DIREKTORAT JENDERAL PERBENDAHARAAN <br />
            <?php
            if ($this->univ != "") {
                echo strtoupper($this->univ) . "<br />";
            }
            
            if ($this->thn != "") {
                echo " " . strtoupper($this->thn) . "<br />";
            }
            
            if ($this->status != "") {
                echo "STATUS ".strtoupper($this->status) ."<br />";
            }
            
            
            echo "PER ".strtoupper(Tanggal::getTglSekarangIndo());
            echo "<br />";
            echo "(PIC: ".strtoupper(Session::get('user')).")";
            ?>

        </p>
         <table border="0" align="center" cellspacing=0 cellpadding=0 width=97% style="border-width: 0px; font-size: 10px;">
            <tr>
                <td class="td2" align="right"> 
                    <FORM>
                        <button TYPE="button" id="printbtn" onClick="cetak();">Cetak</button>
                    </FORM>
                </td>
            </tr>
        </table>
        <br />
        <table align="center" cellspacing=0 cellpadding=4 width=95% style="border-width: 1px; font-size: 10px; border-style: solid; border-color: black;">
            <thead bgcolor="#E6F9ED">
            <th>No</th>
            <th>NIP/Nama</th>
            <th>Golongan/Unit Asal</th>
            <th>Jurusan</th>
            <th>Masa TB</th>
            <th>Status</th>
        </thead>

        <?php
        $no=1;
            foreach($this->d_pb as $v){
                $tmp = explode(";",$v->get_st());
                echo "<tr>";
                echo "<td style=\"text-align: center\">".$no."</td>";
                //echo "<td><a href=".URL."penerima/profil/".$v->get_kd_pb().">".$v->get_nip()."</a></td>";
                echo "<td>".$v->get_nip()."</br>".$v->get_nama()."</td>";
                echo "<td>".Golongan::golongan_int_string($v->get_gol())."</br>".$v->get_unit_asal()."</td>";
                echo "<td>".$v->get_jur()."</td>";
                echo "<td>dari : ".Tanggal::tgl_indo($tmp[0])."</br>sampai : ".Tanggal::tgl_indo($tmp[1])."</td>";
                echo "<td>".$v->get_status()."</td>";
                echo "</tr>";
                $no++;
            }
        ?>
    </table>
</body>
</html>
<script type="text/javascript">
    function cetak(){
		window.print();
		window.onfocus = function() { window.close(); }
	}
</script>
