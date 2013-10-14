<div>
    DAFTAR BIAYA BUKU
</div>
<form method="POST">
    <div id="dropdown-menu">

        <table width="97%">
            <tr>
                <td>
                    <label>Universitas</label>
                    <select name="universitas" id="universitas" type="text">
                        <option value="0">Semua</option>>
                        <?php
                        foreach ($this->univ as $val) {
                            echo "<option value=" . $val->get_kode_in() . " >" . $val->get_nama() . "</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <label>Jurusan/Prodi</label>
                    <select name="jurusan" id="jurusan" type="text">
                        <option value="0">Semua</option>>
                        <?php
                        foreach ($this->jur as $val2) {
                            echo "<option value=" . $val2->get_kode_jur() . " >" . $val2->get_nama() . "</option>";
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <label>Tahun Masuk</label>
                    <select name="tahun_masuk" id="tahun_masuk" type="text">
                        <option value="0">Semua</option>>
                        <?php
                        foreach ($this->kon as $val3) {
                            echo "<option value=" . $val3->thn_masuk_kontrak . " >" . $val3->thn_masuk_kontrak . "</option>";
                        }
                        ?>
                    </select>
                </td>
                <td style="float: right"><input type="search" name="cari" id="cari" value="cari" size="30"></td>
            </tr>
            <tr>
                <td colspan="4" style="padding-top: 0px">
                    <input type="button" id="add" value="TAMBAH" onClick="location.href='<?php echo URL . 'elemenBeasiswa/addUangBuku' ?>'">
                </td>
            </tr>
        </table>

        <div>

        </div>
    </div>
</form>
<div id="tabel_index_buku">
    
</div>

<script type="text/javascript">
    
    $.post("<?php echo URL;?>elemenBeasiswa/data_index_buku", { univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val()}, 
    function (data){
        $('#tabel_index_buku').fadeIn(100);
        $('#tabel_index_buku').html(data);
    })
</script>



