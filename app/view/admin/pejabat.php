<?php
$this->load('admin/menu_admin');
?>

<div>

    <div id="form">
        <div id="form-title"><h1>DATA PEJABAT</h1></div>
        <div id="form-input" >
            <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'admin/addPejabat' ?>">
<!--                <label>Kode</label><input type="text" name="kd_pejabat" id="kd_pejabat" size="8"></br>-->
                <label>NIP</label><input type="text" name="nip_pejabat" id="nip_pejabat" size="18"></br>
                <label>Nama</label><input type="text" name="nama_pejabat" id="nama_pejabat" size="50"></br>
                <label>Jabatan</label><input type="text" name="nama_jabatan" id="nama_jabatan" size="50"></br>
                <label>Jenis Jabatan</label>
                <select name="jenis_jabatan">
                    <option value="1">Pejabat Pembuat Komitmen</option>
                    <option value="2">Penanggung Jawab Kegiatan</option>
                    <option value="3">Bendahara</option>
                </select>
                </br>
                <label></label><input type="reset" value="BATAL"><input type="submit" name="add_pejabat" value="SIMPAN">
            </form>
        </div>
    </div>
    <br />
    <div id="table">
        <div id="table-content">
            <table>
                <thead>
                <th>No</th>
                <th>NIP Pejabat</th>
                <th>Nama Pejabat</th>
                <th>Jabatan</th>
                <th>Jenis Jabatan</th>
                <th></th>                
                </thead>
                <?php $i = 1;
                foreach ($this->data as $pejabat) { ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $pejabat->nip_pejabat; ?></td>
                        <td><?php echo $pejabat->nama_pejabat; ?></td>
                        <td><?php echo $pejabat->nama_jabatan; ?></td>
                        <td><?php 
                        if($pejabat->jenis_jabatan==1){ echo "Pejabat Pembuat Komitment";}
                        if($pejabat->jenis_jabatan==2){ echo "Penanggung Jawab Kegiatan";}
                        if($pejabat->jenis_jabatan==3){ echo "Bendahara";}
                         
                        ?></td>
                        <td>
                            <?php echo "<a href=" . URL . "admin/delPejabat/" . $pejabat->kd_pejabat . ">X</a> | 
                    <a href=" . URL . "admin/editPejabat/" . $pejabat->kd_pejabat . ">...</a>" ?>
                        </td>
                    </tr>
    <?php $i++;
} ?>
            </table>
        </div>
    </div>
</div>

