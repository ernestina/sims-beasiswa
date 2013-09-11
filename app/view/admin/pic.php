<div id="menu">
    <select id="menu-admin">
        <option>-pilih menu-</option>
    </select>
</div>
<div id="form">
    <div id="form-title">DATA BANK</div>
    <div id="form-input">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'?>">
            <label>Nama</label><select name="nama" id="nama">
                <option value="firman">FIRMAN</option>
                <option value="afis">AFIS</option>
            </select></br>
        <label>Keterangan</label><input type="text" name="keterangan" id="keterangan" size="50"></br>
        <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="add_pic" value="SIMPAN">
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
