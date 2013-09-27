<div id="table-content" >
    <table class="table-bordered zebra scroll" id="table">
        <thead>
        <th>No</th>
        <th>No. Kontrak</th>
        <th>Tgl. Kontrak</th>
        <th>Jurusan</th>
        <th>Tahun Masuk</th>
        <th>Jml Pegawai</th>
        <th>Lama Semester</th>
        <th>Nilai Kontrak</th>
        <th>Jumlah dibayarkan</th>
        <th>Aksi</th>
        </thead>
        <?php
        $i = 1;
        foreach ($this->data as $val) {
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $val->no_kontrak; ?></td>
                <td><?php 
                echo $val->tgl_kontrak; 
                ?></td>
                <td><?php
            if ($val->kd_jurusan != "") {
                $this->jurusan->set_kode_jur($val->kd_jurusan);
                //echo $val->kd_jurusan;
                $jurusan = $this->jurusan->get_jur_by_id($this->jurusan);
                $universitas = $this->universitas->get_univ_by_jur($val->kd_jurusan);
                //var_dump($universitas);
                 echo $jurusan->get_nama()." ".$universitas->get_kode();
            } else {
                echo "";
            }
            ?></td>
                <td><?php echo $val->thn_masuk_kontrak; ?></td>
                <td><?php echo $val->jml_pegawai_kontrak; ?></td>
                <td><?php echo $val->lama_semester_kontrak; ?></td>
                <td><?php echo $val->nilai_kontrak; ?></td>
                <td><?php ?></td>
                <td><?php
                 echo "<a href=" . URL . "kontrak/delKontrak/" . $val->kd_kontrak . ">X</a>|
                     <a href=" . URL . "kontrak/editKontrak/" . $val->kd_kontrak . ">...</a>|
                     <a href=" . URL . "kontrak/biaya/" . $val->kd_kontrak . ">Biaya</a>";
                 //echo $val->kd_kontrak;
                ?>   
            </tr>
            <?php
            $i++;
        }
        if(empty($this->data)){
            echo "<tr><td colspan=10>Kontrak tidak ditemukan.</td></tr>";
        }
        ?>
            
    </table>
</div>
