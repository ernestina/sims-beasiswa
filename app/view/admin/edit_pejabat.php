<?php
$this->load('admin/menu_admin');
//var_dump($this->pejabat);
?>

<div>

    <div id="form">
        <div id="form-title"><h1>DATA PEJABAT</h1></div>
        <div id="form-input" >
            <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'admin/updPejabat' ?>">
            <input type="hidden" name="kd_pejabat" id="kd_pejabat" size="8" value="<?php echo $this->pejabat->kd_pejabat;?>"></br>
                <label>NIP</label><input type="text" name="nip_pejabat" id="nip_pejabat" size="18" value="<?php echo $this->pejabat->nip_pejabat; ?>"></br>
                <label>Nama</label><input type="text" name="nama_pejabat" id="nama_pejabat" size="50" value="<?php echo $this->pejabat->nama_pejabat; ?>"></br>
                <label>Jabatan</label><input type="text" name="nama_jabatan" id="nama_jabatan" size="50" value="<?php echo $this->pejabat->nama_jabatan; ?>"></br>
                <label>Jenis Jabatan</label>
                <select name="jenis_jabatan" readonly>
                    <?php if($this->pejabat->jenis_jabatan == '1'){ ?>
                    <option value="1" >Pejabat Pembuat Komitmen</option>
                    <?php } ?>
                     <?php if($this->pejabat->jenis_jabatan == '2'){ ?>
                    <option value="2" >Pejabat Pembuat Komitmen</option>
                    <?php } ?>
                     <?php if($this->pejabat->jenis_jabatan == '3'){ ?>
                    <option value="3" >Pejabat Pembuat Komitmen</option>
                    <?php } ?>
                    
                    
                </select>
                </br>
                <label></label><input type="button" onclick="window.location.href='<?php echo URL."admin/addPejabat"; ?>'" value="BATAL"><input type="submit" name="upd_pejabat" value="SIMPAN">
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

