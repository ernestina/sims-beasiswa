<div>
    <br/>
<div id="form">
    <div id="form-title"><h1>EDIT DATA STRATA</h1></div>
    <div id="form-input" >
        <form method="POST" action="<?php /*$_SERVER['PHP_SELF'];*/ echo URL.'admin/updStrata'?>">
         <input type="hidden" name="kd_strata" id="kd" value="<?php echo $this->strata->kd_strata;?>">
        <label>Kode</label><input type="text" name="kode_strata" id="kode" size="8" value="<?php echo $this->strata->kode_strata;?>"></br>
        <label>Nama</label><input type="text" name="nama_strata" id="nama" size="50" value="<?php echo $this->strata->nama_strata;?>"></br>
        <label></label><input type="button" onclick="window.location.href='<?php echo URL."admin/addStrata"; ?>'" value="BATAL"><input type="submit" name="upd_strata" value="SIMPAN">
        </form>
    </div>
</div>
    <br />
<div id="table">
    <div id="table-content">
        <table>
            <thead>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Aksi</th>
            </thead>
            <?php $i=1; foreach($this->data as $strata){ ?>
            <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $strata->kode_strata; ?></td>
                <td><?php echo $strata->nama_strata; ?></td>
                <td>
                    <?php echo "<a href=".URL."admin/delStrata/".$strata->kd_strata.">X</a> | 
                    <a href=".URL."admin/editStrata/".$strata->kd_strata.">...</a>" ?>
                </td>
            </tr>
            <?php $i++; } ?>
        </table>
    </div>
</div>
</div>
