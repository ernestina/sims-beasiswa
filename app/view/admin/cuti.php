<?php
    $this->load('admin/menu_admin');
?>
<div id="top">
    <div><h2>DATA JENIS SURAT CUTI</h2>
    <div class="kolom3">
	  <fieldset><legend>Tambah Jenis Surat Cuti</legend>
		<div id="form-input">
        <form method="POST" action="<?php 
            if(isset($this->d_ubah)){
                echo URL.'admin/updCuti';
            }else{
                $_SERVER['PHP_SELF']; 
            }
            
            ?>">
        <?php 
            if(isset($this->d_ubah)){
                echo "<input type=hidden name='kd_jns_srt_cuti' value=".$this->d_ubah->get_kode().">";
            }
            
            if(isset($this->error)){
                echo "<div class=error>".$this->error."</div>";
            }
        ?>
        <div id="wnama" class="warning_field"></div>
        <div class="kiri">
		<label>Nama</label><input type="text" name="nama" id="nama" size="50" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nama():'';?>">
        <div id="wketerangan"></div>
        <label>Keterangan</label><textarea name="keterangan" id="keterangan" rows="8" type="text"><?php echo isset($this->d_ubah)?$this->d_ubah->get_keterangan():'';?></textarea>
        <ul class="inline tengah">
			<li><input class="normal" type="submit" onclick="" value="BATAL"></li>
			<li><input class="sukses" type="submit" name="<?php echo isset($this->d_ubah)?'upd_sc':'add_sc';?>" value="SIMPAN" onClick="return cek();"></li>
		</ul>
		</div>
        </form>
    </div>
	</div>
   </fieldset>
</div>
<div class="kolom4" id="table">
	<fieldset><legend>Daftar Jenis Surat Cuti</legend>
    <div id="table-title"></div>
    <div id="table-content">
        <table class="table-bordered zebra scroll">
            <thead>
                <th>No</th>
                <th width="300">Nama</th>
                <th width="300">Keterangan</th>
                <th width="30">Aksi</th>
            </thead>
            <tbody>
            <?php
                $no = 1;
                foreach ($this->data as $val){
                    echo "<tr>";
                    echo "<td>$no</td>";
                    echo "<td>".$val->get_nama()."</td>";
                    echo "<td>".$val->get_keterangan()."</td>";
                    echo "<td><a href=".URL."admin/delCuti/".$val->get_kode().">X</a> | 
                        <a href=".URL."admin/addCuti/".$val->get_kode().">...</a></td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<script type="text/javascript">
function cek(){
    var nama = document.getElementById('nama').value;
    var keterangan = document.getElementById('keterangan').value;
    var jml=0;    
    if(nama==''){
        var wnama= '<font color="red">Nama Jenis Surat Cuti harus diisi!</font>';
        $('#wnama').fadeIn(0);
        $('#wnama').html(wnama);
        jml++;
    }
    
    if(keterangan==''){
        var wketerangan= 'Keterangan harus diisi!';
        $('#wketerangan').fadeIn(0);
        $('#wketerangan').html(wketerangan);
        jml++;
    }
    
    if(jml>0){
        return false
    }else{
        return true;
    }
    
}
</script>