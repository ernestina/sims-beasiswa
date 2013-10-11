<div>
    DAFTAR BIAYA BUKU
</div>
<div id="dropdown-menu">
    <div>
        <table>
            <tr>
                <td>
                    <label class="isian">Universitas : </label>
                    <select id="universitas" name="universitas" type="text">
                        <option value="">Semua</option>
                        <?php
                        foreach ($this->univ as $val) {
                            echo "<option value=" . $val->get_kode_in() . ">" . $val->get_nama() . "</option>";
                        }
                        ?> 
                    </select>
                </td>
                <td>
                    <label>Jurusan/Prodi</label>
                    <select type="text">
                        <option value="">Semua</option>
                        <?php
                        foreach ($this->jur as $val2) {
                            echo "<option value=" . $val2->get_kode_jur() . " >" . $val2->get_nama() . "</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <label>Tahun Masuk</label>
                    <select type="text">
                        <option value="">Semua</option>
                        <?php
                        foreach ($this->kon as $val3) {
                            echo "<option value=" . $val3->thn_masuk_kontrak . " >" . $val3->thn_masuk_kontrak . "</option>";
                        }
                        ?>
                    </select>
                </td>
                <td><input type="search" name="cari" id="cari" value="cari" size="30"></td>
            </tr>
        </table>
    </div>
</div>
<div>
    <input type="button" id="add" value="TAMBAH" onClick="location.href='<?php echo URL . 'elemenBeasiswa/addUangBuku' ?>'">
</div>


