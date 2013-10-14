<fieldset>
    <table>
        <thead>
            <tr>
                <th width= '3%'>No</th>
                <th width= '20%'>Nama</th>
                <th width= '10%'>Gol</th>
                <th width= '15%'>Status</th>
                <th width= '5%'>Jumlah Kehadiran</th>
                <th width= '10%'>Jumlah Kotor</th>
                <th width= '10%'>Pajak</th>
                <th width= '10%'>Jumlah Bersih</th>
                <th width= '5%'>Bank Penerima</th>
                <th width= '5%'>No. Rekening</th>
                <th width= '5%'>Pilih</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no=1;
            foreach ($this->pb as $value) { 
                echo '<tr>';
                echo '<td>'.$no.'</td>';
                echo '<td>'.$value->get_nama().'</td>';
                echo '<td>'.$value->get_gol().'</td>';
                echo '<td>'.$value->get_status().'</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '<td>'.$value->get_bank().'</td>';
                echo '<td>'.$value->get_no_rek().'</td>';
                echo '<td><input type="checkbox"></td>';
                echo '<tr>';
                $no++;
                }              
                ?>
        </tbody>
    </table>
</fieldset>