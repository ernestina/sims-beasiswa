<div id="menu">
    <select id="menu-admin">
        <option>-pilih menu-</option>
    </select>
</div>
<div id="form">
    <div id="form-title">DATA BANK</div>
    <div id="form-input">           
        <form method="POST" action="<?php echo URL . 'Admin/updateBank'; ?>">
            <label></label><input type="hidden" name="id" id="id" value="<?php echo $this->data->get_id(); ?>" size="30"></br>
            <label>Nama</label><input type="text" name="nama" id="nama" value="<?php echo $this->data->get_nama(); ?>" size="30"></br>
            <label>Keterangan</label><input type="text" name="keterangan" id="keterangan" value="<?php echo $this->data->get_keterangan(); ?>" size="50"></br>
            <label></label><input type="button" onclick="" value="BATAL"><input type="submit" name="submit" value="SIMPAN">
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
            <th>Keterangan</th>
            <th>Aksi</th>
            </thead>
            <tbody><?php
        foreach ($this->data2 as $val) {
            echo '<tr>';
            echo '<td>' . $val->get_id() . '</td>';
            echo '<td>' . $val->get_nama() . '</td>';
            echo '<td>' . $val->get_keterangan() . '</td>';
            echo
            '<td>
                        <a href="' . URL . 'Admin/editBank/' . $val->get_id() . '">Edit</a>
                        <a href="' . URL . 'Admin/' . $val->get_id() . '">Delete</a>
                    </td>';
            echo '</tr>';
        }
        ?>                          
            </tbody>
        </table>
    </div>
</div>
