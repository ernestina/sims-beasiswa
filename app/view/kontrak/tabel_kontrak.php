<div id="table-content" >
    <table class="table-bordered zebra scroll" id="table">
        <thead>
        <th width="5%">No</th>
        <th width="10%">No. Kontrak</th>
        <th width="10%">Tgl. Kontrak</th>
        <th width="10%">Jurusan</th>
        <th width="10%">Tahun Masuk</th>
        <th width="10%">Jml Pegawai</th>
        <th width="10%">Lama Semester</th>
        <th width="10%">Nilai Kontrak</th>
        <th width="10%">Jumlah dibayarkan</th>
        <th width="10%">Aksi</th>
        </thead>
        <?php
        $i = 1;
        foreach ($this->data as $val) {
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>
                    <a href="<?php echo URL . "kontrak/file/" . $val->file_kontrak; ?>" target="_blank"><?php echo $val->no_kontrak; ?></a>
                    <?php $kontrak_lama = $this->kontrak->get_by_id($val->kontrak_lama);
                    //var_dump($kontrak_lama);
                    if($kontrak_lama != false){
                        echo "<br /> (Amandemen: "; ?>
                        <a href="<?php echo URL . "kontrak/file/" . $kontrak_lama->file_kontrak; ?>" target="_blank"><?php echo $kontrak_lama->no_kontrak; ?></a>
                        <?php
                        echo " )";
                    }
                    ?>
                </td>
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
                <td><?php echo number_format($val->nilai_kontrak); ?></td>
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