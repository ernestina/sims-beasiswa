<div id="form">
    <div id="form-title">DATA USER</div>
    <div id="form-input">           
        <form method="POST" enctype="multipart/form-data" action=" <?php echo URL.'Admin/updateUser' ?>">
            <input type="hidden" name="id" id="id" value="<?php echo $this->data->get_id(); ?>" size="30"></br>
            <label>NIP</label><input type="text" name="nip" id="nama" value="<?php echo $this->data->get_nip(); ?>" size="30"/></br>
            <label>Nama</label><input type="text" name="nama" id="nama" value="<?php echo $this->data->get_nmUser(); ?>" size="30"/></br>
            <label>PASS</label><input type="text" name="pass" id="nama" value="<?php echo $this->data->get_pass(); ?>" size="30"/></br>
            <label>AKSES</label><input type="text" name="akses" id="nama" value="<?php echo $this->data->get_akses(); ?>" size="30"/></br>
            <label>Upload Foto</label><input type="file" name="foto" id="nama" value="" size="30"/></br>
            <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="submit" value="SIMPAN">
        </form>
    </div>
</div>


