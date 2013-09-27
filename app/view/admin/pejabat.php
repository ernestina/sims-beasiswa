<div id="top">
    <h2>DATA PEJABAT</h2>
    <div class="kolom3">
        <fieldset><legend>Tambah Fakultas</legend>
            <div id="form-input" >
                <form method="POST" id="myform" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'admin/addPejabat' ?>">
    <!--                <label>Kode</label><input type="text" name="kd_pejabat" id="kd_pejabat" size="8"></br>-->
                    <div class="kiri">
                        <label>NIP</label><input type="text" name="nip_pejabat" maxlength="18" id="nip_pejabat" size="18"><div id="wnip_pejabat"></div>
                        <label>Nama</label><input type="text" name="nama_pejabat" id="nama_pejabat" size="50"><div id="wnama_pejabat"></div>
                        <label>Jabatan</label><input type="text" name="nama_jabatan" id="nama_jabatan" size="50"><div id="wnama_jabatan"></div>
                        <label>Jenis Jabatan</label>
                        <select type="text" name="jenis_jabatan" id="jenis_jabatan">
                            <option value="" selected>Pilih jenis jabatan</option>
                            <option value="1">Pejabat Pembuat Komitmen</option>
                            <option value="2">Penanggung Jawab Kegiatan</option>
                            <option value="3">Bendahara</option>
                        </select><div id="wjenis_jabatan"></div>
                        <ul class="inline tengah">
                            <li><input class="normal" type="reset" value="BATAL"></li>
                            <li><input class="sukses" type="submit" name="add_pejabat" value="SIMPAN" id="simpan" onClick="return cek();"></li>
                            <input type="hidden" name="hasil" id="hasil" size="50">  <!--menyimpan value hasil ajax-->
                            </div> <!--end kiri-->
                            </form>
                            </div> <!--end form-input-->
                            </fieldset>
                            </div> <!--end kolom3-->

                            <div id="table" class="kolom4">
                                <fieldset><legend>Daftar Pejabat</legend>
                                    <div id="table-content">
                                        <table class="table-bordered zebra scroll">
                                            <thead>
                                            <th>No</th>
                                            <th>NIP Pejabat</th>
                                            <th width="100">Nama Pejabat</th>
                                            <th width="200">Jabatan</th>
                                            <th width="200">Jenis Jabatan</th>
                                            <th width="30">Aksi</th>                
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
                                                    <td>
                                                        <?php echo "<a href=" . URL . "admin/delPejabat/" . $pejabat->kd_pejabat . " onclick=\"return del()\">X</a> | 
                    <a href=" . URL . "admin/editPejabat/" . $pejabat->kd_pejabat . ">...</a>" ?>
                                                    </td>
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </fieldset>
                            </div> <!--end kolom4-->
                    </div>

                    <script type="text/javascript">
    
                        $('#nip_pejabat').keyup(function() {   
                            $('#wnip_pejabat').fadeOut(0);             
                        });
                        $('#nama_pejabat').keyup(function() {   
                            $('#wnama_pejabat').fadeOut(0);             
                        });
                        $('#nama_jabatan').keyup(function() {   
                            $('#wnama_jabatan').fadeOut(0);             
                        });
                        $('#jenis_jabatan').keyup(function() {   
                            $('#wjenis_jabatan').fadeOut(0);             
                        });
                        
                        $(document).ready(function(){
                            $("#jenis_jabatan").change(function(){
                                if($("#jenis_jabatan").val()!=""){
                                    $.ajax({
                                        type:"POST",
                                        url: "<?php echo URL; ?>admin/cekJabatan", // script to validate in server side
                                        data: 'jenis_jabatan='+$('#jenis_jabatan').val(),
                                        dataType: 'json',
                                        success: function(data1){
                                            if(data1['respon']=="FALSE"){
                                                viewError('wjenis_jabatan','Jenis jabatan sudah ada');
                                                $("#hasil").val("false");
                                            } else {
                                                //$('#wjenis_jabatan').fadeOut(0); 
                                                removeError('wjenis_jabatan');
                                                $("#hasil").val("");
                                            } 
                                        }
                                    });
                                } else {
                                    removeError('wjenis_jabatan');
                                    $("#hasil").val("");
                                }
                            });
                            
                            $.ajax({
                                type:"POST",
                                url: "<?php echo URL; ?>admin/cekJabatan", // script to validate in server side
                                data: 'jenis_jabatan='+$('#jenis_jabatan').val(),
                                dataType: 'json',
                                success: function(data1){
                                    if(data1['respon']=="FALSE"){
                                        viewError('wjenis_jabatan','Jenis jabatan sudah ada');
                                        $("#hasil").val("false");
                                    } else {
                                        //$('#wjenis_jabatan').fadeOut(0); 
                                        removeError('wjenis_jabatan');
                                        $("#hasil").val("");
                                    } 
                                }
                            });
                            
                            $('#nip_pejabat').keyup(function() { 
                                var angka = /^\d{18}$/;
                                var angka2 = /^\d{9}$/;
                                if (angka.test($('#nip_pejabat').val())==false && angka2.test($('#nip_pejabat').val())==false){
                                    viewError('wnip_pejabat','NIP harus diisi dengan 9 atau 18 digit angka!'); 
                                }             
                            });
                        
                        });
                        
                        function cek() {
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
                                var wjenis_jabatan= 'Jenis Jabatan harus dipilih!';
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
        
                            if($("#hasil").val()=="false"){
                                return false;
                            }
                            
                        }
    
    
                        function del(){
                            if(confirm('Apakah Anda yakin akan menghapus data ini?'))
                                return true;
                            else return false
                        }
    

    
                    </script>

