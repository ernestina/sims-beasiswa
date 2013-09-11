<div id="menu">
    <select id="menu-admin">
        <option>-pilih menu-</option>
    </select>
</div>
<div id="form">
    <div id="form-title">DATA UNIVERSITAS</div>
    <div id="form-input">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'?>">
        <label>Universitas</label><select id="status" name="universitas">
            <option value="its">Institut Teknologi Sepuluh Nopember</option>
            <option value="unibraw">Universitas Brawijaya</option>
        </select></br>
        <label>Nama</label><input type="text" name="nama" id="nama" size="50"></br>
        <label>Alamat</label><textarea name="alamat" id="alamat" cols="50" rows="10"></textarea></br>
        <label>Telepon</label><input type="text" name="telepon" id="telepon" size="15"></br>
        <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="add_fak" value="SIMPAN">
        </form>
    </div>
</div>
<div id="table">
    <div id="table-title"></div>
    <div id="table-content">
        <table>
            <thead>
                <th>No</th>
                <th>Universitas</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </thead>
            <?php 
                foreach($this->data as $val){
                    
                }
            ?>
        </table>
    </div>
</div>
