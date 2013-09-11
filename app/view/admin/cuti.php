<div id="menu">
    <select id="menu-admin">
        <option>-pilih menu-</option>
    </select>
</div>
<div id="form">
    <div id="form-title">DATA JENIS SURAT CUTI</div>
    <div id="form-input">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'?>">
        <label>Nama</label><input type="text" name="nama" id="nama" size="30"></br>
        <label>Keterangan</label><input type="text" name="keterangan" id="keterangan" size="50"></br>
        <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="add_cuti" value="SIMPAN">
        </form>
    </div>
</div>
<div id="table">
    <div id="table-title"></div>
    <div id="table-content">
        <table>
            <thead>
                <th>No</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </thead>
        </table>
    </div>
</div>
