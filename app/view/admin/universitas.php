<div id="menu">
    <select id="menu-admin">
        <option>-pilih menu-</option>
    </select>
</div>
<div id="form">
    <div id="form-title">DATA UNIVERSITAS</div>
    <div id="form-input">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'?>">
        <label>Kode</label><input type="text" name="kode" id="kode" size="8"></br>
        <label>Nama</label><input type="text" name="nama" id="nama" size="50"></br>
        <label>Alamat</label><textarea name="alamat" id="alamat" cols="50" rows="10"></textarea></br>
        <label>Telepon</label><input type="text" name="telepon" id="telepon" size="15"></br>
        <label>Lokasi</label><input type="text" name="lokasi" id="lokasi" size="30"></br>
        <label>Status</label><select id="status" name="status">
            <option value="aktif">aktif</option>
            <option value="non_aktif">non aktif</option>
        </select></br>
        <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="add_univ" value="SIMPAN">
        </form>
    </div>
</div>
<div id="table">
    <div id="table-title"></div>
    <div id="table-content">
        <table>
            <thead>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Status</th>
                <th>Aksi</th>
            </thead>
            <?php 
            
            ?>
        </table>
    </div>
</div>
