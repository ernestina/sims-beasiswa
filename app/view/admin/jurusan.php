<div id="menu">
    <select id="menu-admin">
        <option>-pilih menu-</option>
    </select>
</div>
<div id="form">
    <div id="form-title">DATA JURUSAN</div>
    <div id="form-input">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'?>">
        <label>Fakultas</label><select id="status" name="fakultas">
            <option value="TI">Teknologi Informasi</option>
            <option value="ekonomi">Ekonomi</option>
        </select></br>
        <label>Strata</label><select id="status" name="strata">
            <option value="S1">Sarjana</option>
            <option value="S2">Magister</option>
        </select></br>
        <label>PIC</label><select id="status" name="PIC">
            <option value="firman">Firman</option>
            <option value="afis">Afis</option>
        </select></br>
        <label>Nama</label><input type="text" name="nama" id="telepon" size="40"></br>
        <label>Alamat</label><textarea name="alamat" id="alamat" cols="50" rows="10"></textarea></br>
        <label>Telepon</label><input type="text" name="telepon" id="lokasi" size="15"></br>
        <label>PIC Jurusan</label><input type="text" name="pic_jur" id="telepon" size="30"></br>
        <label>Telp PIC Jurusan</label><input type="text" name="telp_pic_jur" id="lokasi" size="15"></br>
        <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="add_jur" value="SIMPAN">
        </form>
    </div>
</div>
<div id="table">
    <div id="table-title"></div>
    <div id="table-content">
        <table>
            <thead>
                <th>No</th>
                <th>Fakultas</th>
                <th>Strata</th>
                <th>PIC</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>PIC Jurusan</th>
                <th>Telp PIC Jurusan</th>
                <th>Aksi</th>
            </thead>
        </table>
    </div>
</div>
