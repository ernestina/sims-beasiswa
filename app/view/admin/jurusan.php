<div id="top">
    
	<!--div id="form-title"--><h2>DATA JURUSAN</h2>
	<div class="kolom3">
	  <fieldset><legend><?php 
                if(isset($this->d_ubah)){
                    echo 'Ubah Jurusan';
                }else{
                    echo 'Tambah Jurusan'; //echo URL.'admin/addUniversitas'
                }
          ?></legend>
		<div id="form-input">
        <form method="POST" action="<?php 
            if(isset($this->d_ubah)){
                echo URL.'admin/updJurusan';
            }else{
                $_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'
            }?>">
        <?php 
            if(isset($this->d_ubah)){
                echo "<input type=hidden name='kd_jur' value=".$this->d_ubah->get_kode_jur().">";
            }
        ?>
	  <div class="kiri">
              <div id="wfakul" class="error"></div>
        <label>Fakultas</label><select type="text" id="fakultas" name="fakultas">
            <?php 
                    foreach ($this->fakul as $val){
                        if(isset($this->d_ubah)){
                            if($val->get_kode_fakul()==$this->d_ubah->get_kode_fakul()){
                                echo "<option value=".$val->get_kode_fakul()." selected>[".$val->get_kode_univ()."] ".$val->get_nama()."</option>";
                            }else{
                                echo "<option value=".$val->get_kode_fakul()." >[".$val->get_kode_univ()."] ".$val->get_nama()."</option>";
                            }
                        }elseif(isset($this->d_rekam)){
                            if($val->get_kode_fakul()==$this->d_rekam->get_kode_fakul()){
                                echo "<option value=".$val->get_kode_fakul()." selected>[".$val->get_kode_univ()."] ".$val->get_nama()."</option>";
                            }else{
                                echo "<option value=".$val->get_kode_fakul()." >[".$val->get_kode_univ()."] ".$val->get_nama()."</option>";
                            }
                        }else{
                            echo "<option value=".$val->get_kode_fakul()." >[".$val->get_kode_univ()."] ".$val->get_nama()."</option>";
                        }
                    }
            ?>
        </select>
        <div id="wstrata" class="error"></div>
        <label>Strata</label><select type="text" id="strata" name="strata">
            <?php 
                        foreach ($this->strata as $val){
                            if(isset($this->d_ubah)){
                                if($val->kd_strata==$this->d_ubah->get_kode_strata()){
                                    echo "<option value=".$val->kd_strata." selected>[".$val->kode_strata."] ".$val->nama_strata."</option>";
                                }else{
                                    echo "<option value=".$val->kd_strata." >[".$val->kode_strata."] ".$val->nama_strata."</option>";
                                }
                            }elseif(isset($this->d_rekam)){
                                if($val->kd_strata==$this->d_rekam->get_kode_strata()){
                                    echo "<option value=".$val->kd_strata." selected>[".$val->kode_strata."] ".$val->nama_strata."</option>";
                                }else{
                                    echo "<option value=".$val->kd_strata." >[".$val->kode_strata."] ".$val->nama_strata."</option>";
                                }
                            }else{
                                echo "<option value=".$val->kd_strata." >[".$val->kode_strata."] ".$val->nama_strata."</option>";
                            }
                        }
            ?>
        </select>
<!--        <label>PIC</label><select id="status" name="PIC">
            <option value="1">Firman</option>
            <option value="2">Afis</option>
        </select></br-->
        <div id="wnama" class="error"></div>
        <label>Jurusan</label><input type="text" name="nama" id="nama" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_nama():(isset($this->d_rekam)?$this->d_rekam->get_nama():'');?>">
        <div id="walamat" class="error"></div>
		<label>Alamat</label><textarea type="text" name="alamat" id="alamat" rows="8"><?php echo isset($this->d_ubah)?$this->d_ubah->get_alamat():(isset($this->d_rekam)?$this->d_rekam->get_alamat():'');?></textarea>
        <div id="wtelepon" class="error"></div>
		<label>Telepon</label><input type="text" name="telepon" id="telepon" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telepon():(isset($this->d_rekam)?$this->d_rekam->get_telepon():'');?>">
		<div id="wpic_jur" class="error"></div>
        <label>PIC Jurusan</label><input type="text" name="pic_jur" id="pic_jur" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_pic():(isset($this->d_rekam)?$this->d_rekam->get_pic():'');?>">
	<div id="wtelp_pic_jur" class="error"></div>	
        <label>Telp PIC Jurusan</label><input type="text" name="telp_pic_jur" id="telp_pic_jur" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_telp_pic():(isset($this->d_rekam)?$this->d_rekam->get_telp_pic():'');?>">
	<div id="wstatus" class="error"></div>	
        <label>Status</label>
			<select type="text" name="status" id="status" value="<?php echo isset($this->d_ubah)?$this->d_ubah->get_status():'';?>">
				<option value="1">Aktif</option>
				<option value="2">Non-aktif</option>
			</select>
        
		<ul class="inline tengah">
			<li><input class="normal" type="submit" onclick="" value="BATAL"></li>
			<li><input class="sukses" type="submit" name="<?php echo isset($this->d_ubah)?'upd_jur':'add_jur';?>" value="SIMPAN" onClick="return cek();"></li>
		</ul>
        </form>
		</div>
	</div> <!--end form input-->
   </fieldset>
</div> <!--end kolom3-->

<div class="kolom4" id="table">
   <fieldset><legend>Daftar Jurusan</legend>
    <div id="table-title"></div>
    <div id="table-content">
        <table class="table-bordered zebra scroll">
            <thead>
                <th>No</th>
                <th width="70">Fakultas</th>
                <th width="30">Strata</th>
                <th width="70">Jurusan</th>
                <th width="200">Alamat</th>
                <th width="70">Telepon</th>
                <th>PIC Jurusan</th>
                <th width="50">Telp PIC Jurusan</th>
                <th>Status</th>
                <th width="70">Aksi</th>
            </thead>
			<tbody>
            <?php
                $no=1;
                foreach ($this->data as $val){
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$val->get_kode_fakul()."</td>";
                    echo "<td>".$val->get_kode_strata()."</td>";
                    echo "<td>".$val->get_nama()."</td>";
                    echo "<td>".$val->get_alamat()."</td>";
                    echo "<td>".$val->get_telepon()."</td>";
                    echo "<td>".$val->get_pic()."</td>";
                    echo "<td>".$val->get_telp_pic()."</td>";
                    echo "<td>";
                    echo ($val->get_status()==1)?"Aktif":"Non-aktif";
                    echo "</td>";
                    echo "<td><a href=".URL."admin/delJurusan/".$val->get_kode_jur()." onclick=\"return del('".$val->get_nama()."')\"><i class=\"icon-trash\"></i></a>
                        <a href=".URL."admin/addJurusan/".$val->get_kode_jur()."><i class=\"icon-pencil\"></i></a></td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
        </tbody>
		</table>
    </div>
</div> <!--end kolom4-->
</div>

<script type="text/javascript">
$(function(){
        hideErrorId();
        hideWarning();
        
    });
    
function hideErrorId(){
    $('.error').fadeOut(0);
}

function hideWarning(){
    
    $('#nama').keyup(function(){
        if(document.getElementById('nama').value !=''){
            $('#wnama').fadeOut(200);
        }
    })
    
    $('#alamat').keyup(function(){
        if(document.getElementById('alamat').value !=''){
            $('#walamat').fadeOut(200);
        }
    })
    
    $('#telepon').keyup(function(){
        if(document.getElementById('telepon').value !=''){
            $('#wtelepon').fadeOut(200);
        }
    })
    
    $('#pic_jur').keyup(function(){
        if(document.getElementById('pic_jur').value !=''){
            $('#wpic_jur').fadeOut(200);
        }
    })
    
    $('#telp_pic_jur').keyup(function(){
        if(document.getElementById('telp_pic_jur').value !=''){
            $('#wtelp_pic_jur').fadeOut(200);
        }
    })

}

function del(jurusan){
    var text = "Yakin data jurusan "+jurusan+" akan dihapus?";
    if(confirm(text)){
        return true;
    }else{
        return false;
    }
}

function cek(){
    var fakul = document.getElementById('fakultas').value;
    var strata = document.getElementById('strata').value;
    var nama = document.getElementById('nama').value;
    var alamat = document.getElementById('alamat').value;
    var telepon = document.getElementById('telepon').value;
    var pic_jur = document.getElementById('pic_jur').value;
    var telp_pic_jur = document.getElementById('telp_pic_jur').value;
    var status = document.getElementById('status').value;
    var jml=0;
    if(fakul=''){
        var wfakul= 'Fakultas harus dipilih!';
        $('#wfakul').fadeIn(0);
        $('#wfakul').html(wfakul);
        jml++;
    }
    
    if(strata==''){
        var wstrata= 'Strata harus dipilih!';
        $('#wstrata').fadeIn(0);
        $('#wstrata').html(wstrata);
        jml++;
    }
    
    if(nama==''){
        var wnama= 'Nama Jurusan harus diisi!';
        $('#wnama').fadeIn(0);
        $('#wnama').html(wnama);
        jml++;
    }
    
    if(alamat==''){
        var walamat= 'Alamat jurusan harus diisi!';
        $('#walamat').fadeIn(0);
        $('#walamat').html(walamat);
        jml++;
    }
    
    if(telepon==''){
        var wtelepon= 'Telepon jurusan harus diisi!';
        $('#wtelepon').fadeIn(0);
        $('#wtelepon').html(wtelepon);
        jml++;
    }
    
    if(pic_jur==''){
        var wpic_jur= 'PIC perguruan tinggi harus diisi!';
        $('#wpic_jur').fadeIn(0);
        $('#wpic_jur').html(wpic_jur);
        jml++;
    }
    
    if(telp_pic_jur==''){
        var wtelp_pic_jur= 'telepon PIC harus diisi!';
        $('#wtelp_pic_jur').fadeIn(0);
        $('#wtelp_pic_jur').html(wtelp_pic_jur);
        jml++;
    }
    
    if(status==''){
        var wstatus= 'status harus diisi!';
        $('#wstatus').fadeIn(0);
        $('#wstatus').html(wstatus);
        jml++;
    }
    
    if(jml>0){
        return false
    }else{
        return true;
    }
    
}
</script>
