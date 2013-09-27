
<div id="top">
    <h2>DATA PEJABAT</h2>
    <div class="kolom3">
        <fieldset><legend>Ubah Data Pejabat</legend>
            <div id="form-input" >
                <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'admin/updPejabat' ?>">
                    <input type="hidden" name="kd_pejabat" id="kd_pejabat" size="8" value="<?php echo $this->pejabat->kd_pejabat; ?>">
                    <div class="kiri">
                        <label>NIP</label><input type="text" name="nip_pejabat" maxlength="18" id="nip_pejabat" size="18" value="<?php echo $this->pejabat->nip_pejabat; ?>"><div id="wnip_pejabat"></div>
                        <label>Nama</label><input type="text" name="nama_pejabat" id="nama_pejabat" size="50" value="<?php echo $this->pejabat->nama_pejabat; ?>"><div id="wnama_pejabat"></div>
                        <label>Jabatan</label><input type="text" name="nama_jabatan" id="nama_jabatan" size="50" value="<?php echo $this->pejabat->nama_jabatan; ?>"><div id="wnama_jabatan"></div>
                        <label>Jenis Jabatan</label>
                        <select type="text" name="jenis_jabatan" readonly id="jenis_jabatan">
                            <?php if ($this->pejabat->jenis_jabatan == '1') { ?>
                                <option value="1" >Pejabat Pembuat Komitmen</option>
                            <?php } ?>
                            <?php if ($this->pejabat->jenis_jabatan == '2') { ?>
                                <option value="2" >Pejabat Pembuat Komitmen</option>
                            <?php } ?>
                            <?php if ($this->pejabat->jenis_jabatan == '3') { ?>
                                <option value="3" >Pejabat Pembuat Komitmen</option>
                            <?php } ?>


                        </select><div id="wjenis_jabatan"></div>
                        <ul class="inline tengah">
                            <li><input class="normal" type="submit" onclick="window.location.href='<?php echo URL . "admin/addPejabat"; ?>'" value="BATAL"></li>

                            <li><input class="sukses" type="submit" name="upd_pejabat" value="SIMPAN" id="simpan"></li>
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
                    <?php
                    $i = 1;
                    foreach ($this->data as $pejabat) {
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $pejabat->nip_pejabat; ?></td>
                            <td><?php echo $pejabat->nama_pejabat; ?></td>
                            <td><?php echo $pejabat->nama_jabatan; ?></td>
                            <td><?php
                    if ($pejabat->jenis_jabatan == 1) {
                        echo "Pejabat Pembuat Komitment";
                    }
                    if ($pejabat->jenis_jabatan == 2) {
                        echo "Penanggung Jawab Kegiatan";
                    }
                    if ($pejabat->jenis_jabatan == 3) {
                        echo "Bendahara";
                    }
                        ?></td>

                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                </table>
            </div>
        </fieldset>
    </div>
</div>
<script type="text/javascript">
    
    
    $('#nama_pejabat').keyup(function() {   
        $('#wnama_pejabat').fadeOut(0);             
    });
    $('#nama_jabatan').keyup(function() {   
        $('#wnama_jabatan').fadeOut(0);             
    });
    $('#jenis_jabatan').keyup(function() {   
        $('#wjenis_jabatan').fadeOut(0);             
    });
    
                              
    $('#nip_pejabat').keyup(function() { 
        var angka = /^\d{18}$/;
        var angka2 = /^\d{9}$/;
        if (angka.test($('#nip_pejabat').val())==false && angka2.test($('#nip_pejabat').val())==false){
            viewError('wnip_pejabat','NIP harus diisi dengan 9 atau 18 digit angka!'); 
        } else{
            removeError('wnip_pejabat'); 
        }             
    });
                        
   
	
	
    $("#simpan").click(function() {
        var angka = /^\d{18}$/;
        var angka2 = /^\d{9}$/;
        var jml = 0;
        
        if($('#nip_pejabat').val()==''){
            var wnip_pejabat= 'NIP harus diisi!';
            $('#wnip_pejabat').fadeIn(0);
            $('#wnip_pejabat').html(wnip_pejabat);
            $('#wnip_pejabat').addClass('error');
            jml++;
        }
    
        if($('#nama_pejabat').val()==''){
            var wnama_pejabat= 'Nama harus diisi!';
            $('#wnama_pejabat').fadeIn(0);
            $('#wnama_pejabat').html(wnama_pejabat);
            $('#wnama_pejabat').addClass('error');
            jml++;
        }
        
        if($('#nama_jabatan').val()==''){
            var wnama_jabatan= 'Jabatan harus diisi!';
            $('#wnama_jabatan').fadeIn(0);
            $('#wnama_jabatan').html(wnama_jabatan);
            $('#wnama_jabatan').addClass('error');
            jml++;
        }
    
        if($('#jenis_jabatan').val()==''){
            var wjenis_jabatan= 'Jenis Jabatan harus diisi!';
            $('#wjenis_jabatan').fadeIn(0);
            $('#wjenis_jabatan').html(wjenis_jabatan);
            $('#wjenis_jabatan').addClass('error');
            jml++;
        }
                
        if(jml>0){
            //alert('Isian form belum lengkap');
            return false;
        }
        
        if (angka.test($('#nip_pejabat').val())==false && angka2.test($('#nip_pejabat').val())==false){
            var wnip_pejabat= 'NIP harus diisi dengan 9 atau 18 digit angka!';
            $('#wnip_pejabat').fadeIn(0);
            $('#wnip_pejabat').html(wnip_pejabat);
            $('#wnip_pejabat').addClass('error');
            return false;
        }
        
    });
    
    
    
</script>
