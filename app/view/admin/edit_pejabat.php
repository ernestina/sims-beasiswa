
    <div id="top">
        <h2>DATA PEJABAT</h2>
		<div class="kolom3">
			<fieldset><legend>Ubah Data Pejabat</legend>
			<div id="form-input" >
            <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'admin/updPejabat' ?>">
            <input type="hidden" name="kd_pejabat" id="kd_pejabat" size="8" value="<?php echo $this->pejabat->kd_pejabat;?>">
				<div class="kiri">
                <label>NIP</label><input type="text" name="nip_pejabat" id="nip_pejabat" size="18" value="<?php echo $this->pejabat->nip_pejabat; ?>">
                <label>Nama</label><input type="text" name="nama_pejabat" id="nama_pejabat" size="50" value="<?php echo $this->pejabat->nama_pejabat; ?>">
                <label>Jabatan</label><input type="text" name="nama_jabatan" id="nama_jabatan" size="50" value="<?php echo $this->pejabat->nama_jabatan; ?>">
                <label>Jenis Jabatan</label>
                <select type="text" name="jenis_jabatan" readonly>
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
                <ul class="inline tengah">
					<li><input class="normal" type="submit" onclick="window.location.href='<?php echo URL."admin/addPejabat"; ?>'" value="BATAL"></li>
					
					<li><input class="sukses" type="submit" name="upd_pejabat" value="SIMPAN"></li>
				</ul>
			</div> <!--end class kiri-->
            </form>
        </div>
		</fieldset>
    </div> <!--end kolom3-->

	
<div class="kolom4" id="table">
	<fieldset><legend>Daftar Pejabat</legend>
   
        <div id="table-content">
            <table class="table-bordered zebra scroll">
                <thead>
                <th width="5px">No</th>
                <th width="20%">NIP Pejabat</th>
                <th width="20%">Nama Pejabat</th>
                <th width="30%">Jabatan</th>
                <th width="30%">Jenis Jabatan</th>
                              
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
                        
                    </tr>
    <?php $i++;
} ?>
            </table>
        </div>
	</fieldset>
    </div>
</div>

