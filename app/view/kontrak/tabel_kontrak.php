<div id="table-content" >
    <table class="table-bordered zebra scroll">
        <thead>
        <th width="5%">No</th>
        <th width="20%">No. Kontrak</th>
        <th width="7%">Tgl. Kontrak</th>
        <th width="20%">Jurusan</th>
        <th width="5%">Tahun Masuk</th>
        <th width="5%">Jml Pegawai</th>
        <th width="5%">Lama Semester</th>
        <th width="10%">Nilai Kontrak</th>
        <th width="10%">Jumlah dibayarkan</th>
        <th width="10%">Aksi</th>
        </thead>
        <tbody style="text-align: center">
            <?php
            $i = 1;
            foreach ($this->data as $val) {
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td style="text-align: left">
                        <a href="<?php echo URL . "kontrak/file/" . $val->file_kontrak; ?>" target="kontrak" onClick="cetak_dokumen('kontrak');"><?php echo $val->no_kontrak; ?></a>
                        <?php
                        $kontrak_lama = $this->kontrak->get_by_id($val->kontrak_lama);
                        //var_dump($kontrak_lama);
                        if ($kontrak_lama != false) {
                            echo "<br /> (Adendum: ";
                            ?>
                            <a href="<?php echo URL . "kontrak/file/" . $kontrak_lama->file_kontrak; ?>" target="kontrak_lama" onClick="cetak_dokumen('kontrak_lama');">><?php echo $kontrak_lama->no_kontrak; ?></a>
                            <?php
                            echo ")";
                        }
                        ?>
                    </td>
                    <td><?php
                    echo $val->tgl_kontrak;
                        ?></td>
                    <td style="text-align: left"><?php
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
                    <td style="text-align: right">
                        <?php
                        echo number_format($val->nilai_kontrak);
                        if ($this->biaya->get_biaya_by_kontrak($val->kd_kontrak) != $val->nilai_kontrak) {
                            echo "*";
                        }
                        ?>
                    </td>
                    <td style="text-align: right">
                        <?php
                        echo number_format($this->biaya->get_biaya_by_kontrak_dibayar($val->kd_kontrak));
                        ?>
                    </td>
                    <td>
                        <a href="#" onClick="edit(<?php echo $val->kd_kontrak; ?>); return false;"><i class=\"icon-pencil\"></i></a>
                        <?php
                        echo "<a href=" . URL . "kontrak/delKontrak/" . $val->kd_kontrak . " onClick=\"return del();\" title=\"hapus\"><i class=\"icon-trash\"></i></a> &nbsp
                     <a href=\"#\" onClick=\"edit(" . $val->kd_kontrak . "); return false;\"><i class=\"icon-pencil\" title=\"ubah\"></i></a> &nbsp
                     <a href=" . URL . "kontrak/biaya/" . $val->kd_kontrak . "><i class=\"icon-tag\" title=\"tambah detail biaya\"></i></a>";
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
        </tbody>
    </table>
</div>

</div>
<script>
    function del(){
        if(confirm('Apakah Anda yakin akan menghapus data ini?'))
            return true;
        else return false
    }
      
    
</script>