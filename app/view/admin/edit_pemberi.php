<?php
    $this->load('admin/menu_admin');
?>

<div id="form">
    <div id="form-title"><h1>EDIT DATA STRATA</h1></div>
    <div id="form-input">
        <form method="POST" action="<?php /*$_SERVER['PHP_SELF']; */ echo URL.'admin/updPemberi'?>">
        <input type="hidden" name="kd_pemberi" id="kd" size="50" value="<?php echo $this->pemberi->kd_pemberi;?>">
        <label>Nama</label><input type="text" name="nama_pemberi" id="nama" size="50" value="<?php echo $this->pemberi->nama_pemberi;?>"></br>
        <label>Alamat</label><textarea name="alamat_pemberi" id="alamat" cols="50" rows="1"><?php echo $this->pemberi->alamat_pemberi;?></textarea></br>
        <label>Telepon</label><input type="text" name="telp_pemberi" id="telepon" size="15" value="<?php echo $this->pemberi->telp_pemberi;?>"></br>
        <label>PIC</label><input type="text" name="pic_pemberi" id="PIC" size="30" value="<?php echo $this->pemberi->pic_pemberi;?>"></br>
        <label>Telepon PIC</label><input type="text" name="telp_pic_pemberi" id="telp_pic" size="8" value="<?php echo $this->pemberi->telp_pic_pemberi;?>"></br>
        <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="upd_pemberi" value="SIMPAN">
        </form>
    </div>
</div>
<br />
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
            <?php $i=1; foreach($this->data as $pemberi){ ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $pemberi->nama_pemberi; ?></td>
                <td><?php echo $pemberi->alamat_pemberi; ?></td>
                <td><?php echo $pemberi->telp_pemberi;?></td>
                <td><?php echo $pemberi->pic_pemberi;?></td>
                <td><?php echo $pemberi->telp_pic_pemberi;?></td>
                <td>
                    <?php echo "<a href=".URL."admin/delPemberi/".$pemberi->kd_pemberi.">X</a> | 
                    <a href=".URL."admin/updPemberi/".$pemberi->kd_pemberi.">...</a>" ?>                    
                </td>
            </tr>
            <?php $i++; } ?>
        </table>
    </div>
</div>
