<div id="form">
    <div id="form-title">DATA USER</div>
    <div id="form-input">           
        <form method="POST" enctype="multipart/form-data" action=" <?php echo URL.'Admin/addUser' ?>">
            <input type="hidden" name="id" id="id" value="" size="30"></br>
            <label>NIP</label><input type="text" name="nip" id="nama" value="" size="30"/></br>
            <label>Nama</label><input type="text" name="nama" id="nama" value="" size="30"/></br>
            <label>PASS</label><input type="text" name="pass" id="nama" value="" size="30"/></br>
            <label>AKSES</label><input type="text" name="akses" id="nama" value="" size="30"/></br>
            <label>Upload Foto</label><input type="file" name="foto" id="nama" value="" size="30"/></br>
            <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="submit" value="SIMPAN">
        </form>
    </div>
</div>
<div id="table">
    <div id="table-title"></div>
    <div id="table-content">
        <table>
            <thead>
                <th>Nip</th>
                <th>Nama</th>
                <th>Pass</th>
                <th>Akses</th>
                <th>Foto</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                foreach ($this->data as $value) {
                    echo '<tr>';
                    echo '<td>'.$value->get_nip().'</td>';
                    echo '<td>'.$value->get_nmUser().'</td>';
                    echo '<td>'.$value->get_pass().'</td>';
                    echo '<td>'.$value->get_akses().'</td>';
                    echo '<td>'.$value->get_foto().'</td>';
                    echo '<td>
                        <a href="' . URL . 'Admin/editUser/' . $value->get_id() . '">Edit</a>
                        <a href="' . URL . 'Admin/deleteUser/' . $value->get_id() . '">Delete</a>
                        </td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
