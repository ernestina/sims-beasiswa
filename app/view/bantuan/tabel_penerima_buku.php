<fieldset>
    <table class="table-bordered zebra">
        <thead>
        <th>No</th>
        <th>Nama</th>
        <th>Gol</th>
        <th>Status</th>
        <th>Bank Penerima</th>
        <th>No. Rekening</th>
        <th>Pilih</th>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($this->pb as $val4) {
                echo "<tr>";
                echo "<td>$no</td>";
                echo "<td>" . $val4->get_nama() . " / " . $val4->get_nip() . "</td>";
                echo "<td>" . $val4->get_gol() . "</td>";
                echo "<td>" . $val4->get_status() . "</td>";
                echo "<td>" . $val4->get_bank() . "</td>";
                echo "<td>" . $val4->get_no_rek() . "</td>";
                ?>
            <td><input type="checkbox" id="setuju" name="setuju" /></td>
            <?php
            $no++;
        }
        ?>         
        </tbody>
    </table>


    <div>
        <div>Keterangan : *Data harus diisi</div>
        <div>
            <input type="submit" name="simpan" value="simpan" class="sukses"/>
            <input type="reset" name="baral" value="batal" class="normal">
        </div>
    </div>
</fieldset>