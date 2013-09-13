
<div id="menu">
    <select id="menu-admin">
        <option>-pilih menu-</option>
    </select>
</div>
<div>
    <br/>
<div id="form">
    <div id="form-input" >
        <form method="POST" name="add_strata" action="<?php /*$_SERVER['PHP_SELF'];*/ echo URL.'app/admin/addStrata'?>">
        <label>Kode</label><input type="text" name="kode" id="kode" size="8"></br>
        <label>Nama</label><input type="text" name="nama" id="nama" size="50"></br>
        <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="add_strata" value="SIMPAN">
        </form>
    </div>
</div>
    <br />
<div id="table">
    <div id="table-content">
        <table border="1">
            <thead>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </thead>
            <?php $i=1; foreach($this->data as $strata){ ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $strata->get_kode_strata(); ?></td>
                <td><?php echo $strata->get_nama_strata(); ?></td>
                <td> &nbsp; </td>
            </tr>
            <?php $i++; } ?>
        </table>
    </div>
</div>
</div>
