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
                    <?php
                    $kontrak_lama = $this->kontrak->get_by_id($val->kontrak_lama);
                    //var_dump($kontrak_lama);
                    if ($kontrak_lama != false) {
                        echo "<br /> (Adendum: ";
                        ?>
                        <a href="<?php echo URL . "kontrak/file/" . $kontrak_lama->file_kontrak; ?>" target="_blank"><?php echo $kontrak_lama->no_kontrak; ?></a>
                        <?php
                        echo ")";
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
                    echo $jurusan->get_nama() . " " . $universitas->get_kode();
                } else {
                    echo "";
                }
                    ?></td>
                <td><?php echo $val->thn_masuk_kontrak; ?></td>
                <td><?php echo $val->jml_pegawai_kontrak; ?></td>
                <td><?php echo $val->lama_semester_kontrak; ?></td>
                <td>
                    <?php 
                    echo number_format($val->nilai_kontrak); 
                    if($this->biaya->get_biaya_by_kontrak($val->kd_kontrak) != $val->nilai_kontrak){
                        echo "*";
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    echo number_format($this->biaya->get_biaya_by_kontrak_dibayar($val->kd_kontrak));
                    ?>
                </td>
                <td><?php
                echo "<a href=" . URL . "kontrak/delKontrak/" . $val->kd_kontrak . " onClick=\"return del();\"><i class=\"icon-trash\"></i></a> &nbsp &nbsp
                     <a href=" . URL . "kontrak/editKontrak/" . $val->kd_kontrak . "><i class=\"icon-pencil\"></i></a> &nbsp &nbsp
                     <a href=" . URL . "kontrak/biaya/" . $val->kd_kontrak . "><i class=\"icon-tag\"></i></a>";
                //echo $val->kd_kontrak;
                    ?>   
            </tr>
            <?php
            $i++;
        }
        if (empty($this->data)) {
            echo "<tr><td colspan=10>Kontrak tidak ditemukan.</td></tr>";
        }
        ?>

    </table>
</div>
<script>
    function del(){
        if(confirm('Apakah Anda yakin akan menghapus data ini?'))
            return true;
        else return false
    }
</script>