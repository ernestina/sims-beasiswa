<div>
    DATA KONTRAK KERJASAMA
</div>
<div>
    <div>
        <label>Universitas</label>
        <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/display' ?>">
            <input type="hidden" name="pilih_univ">
            <select name="universitas" onChange='this.form.submit()'>
                <option value="">Semua</option>
                <?php
                foreach ($this->univ as $univ) {
                    if ($this->pil == $univ->get_kode_in()) {
                        $select = "selected";
                    } else {
                        $select = "";
                    }

                    ?>
                    <option value="<?php echo $univ->get_kode_in(); ?>" <?php echo $select; ?>><?php echo $univ->get_nama(); ?></option>
<?php } ?>
            </select>
            <input type="button" value="SUBMIT">
            </div>
            <div><input type="button" value="TAMBAH" onClick="location.href='<?php echo URL . 'kontrak/rekam'; ?>'"></div>
        </form>
    </div>
    <div>
        <table>
            <thead>
            <th>No</th>
            <th>No. Kontrak</th>
            <th>Tgl. Kontrak</th>
            <th>Jurusan</th>
            <th>Jml Pegawai</th>
            <th>Lama Semester</th>
            <th>Nilai Kontrak</th>
            <th>Jumlah dibayarkan</th>
            <th>Aksi</th>
            </thead>
<?php $i = 1;
foreach ($this->data as $val) {
    ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $val->no_kontrak; ?></td>
                    <td><?php echo $val->tgl_kontrak; ?></td>
                    <td><?php echo $val->kd_jurusan; ?></td>
                    <td><?php echo $val->jml_pegawai_kontrak; ?></td>
                    <td><?php echo $val->lama_semester_kontrak; ?></td>
                    <td><?php echo $val->nilai_kontrak; ?></td>
                    <td><?php ?></td>
                    <td>Aksi</td>   
                </tr>
    <?php $i++;
}
?>
        </table>
    </div>
