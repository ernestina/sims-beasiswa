<div id="menu">
    <select id="menu-admin">
        <option>-pilih menu-</option>
    </select>
</div>
<div id="form">
    <div id="form-title">DATA PEMBERI BEASISWA</div>
    <div id="form-input">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'?>">
        <label>Nama</label><input type="text" name="nama" id="nama" size="50"></br>
        <label>Alamat</label><textarea name="alamat" id="alamat" cols="50" rows="10"></textarea></br>
        <label>Telepon</label><input type="text" name="telepon" id="telepon" size="15"></br>
        <label>PIC</label><input type="text" name="pic" id="PIC" size="30"></br>
        <label>Telepon PIC</label><input type="text" name="telp_pic" id="telp_pic" size="8"></br>
        <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="add_pemberi" value="SIMPAN">
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
                <th>Alamat</th>
                <th>Telepon</th>
                <th>PIC</th>
                <th>Telp. PIC</th>
                <th>Aksi</th>
            </thead>
        </table>
    </div>
</div>
