<?php
$this->load('admin/menu_admin');
?>

<div>

    <div id="form">
        <div id="form-title"><h1>DATA STRATA</h1></div>
        <div id="form-input" >
            <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'admin/addStrata' ?>">
                <label>Kode</label><input type="text" name="kode_strata" id="kode" size="8"></br>
                <label>Nama</label><input type="text" name="nama_strata" id="nama" size="50"></br>
                <label></label><input type="reset" value="BATAL"><input type="submit" name="add_strata" value="SIMPAN">
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
                <?php $i = 1;
                foreach ($this->data as $strata) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $strata->kode_strata; ?></td>
                        <td><?php echo $strata->nama_strata; ?></td>
                        <td>
                            <?php echo "<a href=" . URL . "admin/delStrata/" . $strata->kd_strata . ">X</a> | 
                    <a href=" . URL . "admin/updStrata/" . $strata->kd_strata . ">...</a>" ?>
                        </td>
                    </tr>
    <?php $i++;
} ?>
            </table>
        </div>
    </div>
</div>

