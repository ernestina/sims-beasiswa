<div id="top">
    <!--div id="form-title"-->
    <h2>DATA STRATA</h2>
    <div class="kolom3">
        <fieldset><legend>Tambah Strata</legend>
            <div id="form-input" class="kiri" >
                <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'admin/addStrata' ?>">
                    <label>Kode</label><input type="text" name="kode_strata" id="kode" size="8"><div id="wkode_strata"></div>
                    <label>Strata</label><input type="text" name="nama_strata" id="nama" size="50"><div id="wnama_strata"></div>
                    <ul class="inline tengah">  
                        <li><input class="normal" type="submit" value="BATAL"></li>
                        <li><input class="sukses" type="submit" name="add_strata" value="SIMPAN" onClick="return cek();"></li>
                    </ul>
                </form>
            </div>
        </fieldset>
    </div>

    <div class="kolom4">
        <fieldset><legend>Daftar Strata</legend>
            <div id="table">
                <div id="table-content">
                    <table class="table-bordered zebra scroll">
                        <thead>
                        <th>No</th>
                        <th width="20%">Kode</th>
                        <th width="60%">Nama</th>
                        <th width="20%">Aksi</th>
                        </thead>
                        <?php
                        foreach ($this->data as $strata) {
                            ?>
                            <tr>
                                <td><?php echo $strata->no; ?></td>
                                <td><?php echo $strata->kode_strata; ?></td>
                                <td><?php echo $strata->nama_strata; ?></td>
                                <td align="center">
                                    <?php echo "<a href=" . URL . "admin/delStrata/" . $strata->kd_strata . " onclick=\"return del()\"><i class=\"icon-trash\"></i></a>
									&nbsp
									<a href=" . URL . "admin/editStrata/" . $strata->kd_strata . "><i class=\"icon-pencil\"></i></a>" ?>
                                </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </table>
                </div>
            </div>


            <div>
                <?php
                if ($this->jmlData > 0) {
                    $jmlhal = $this->paging->jml_halaman($this->jmlData);
                    $paging = $this->paging->navHalaman($jmlhal);
                    echo $paging;
                }
                ?>
            </div>
        </fieldset>
    </div>
</div>
<script type="text/javascript">
    
    function del(){
        if(confirm('Apakah Anda yakin akan menghapus data ini?'))
            return true;
        else return false
    }
	
    $('#kode').keyup(function() {   
        $('#wkode_strata').fadeOut(0);             
    });
	
    $('#nama').keyup(function() {   
        $('#wnama_strata').fadeOut(0);             
    });
	
    function cek(){    
        var jml = 0;		
        if($('#kode').val()==''){
            var wkode_strata= 'Kode harus diisi!';
            $('#wkode_strata').fadeIn(0);
            $('#wkode_strata').html(wkode_strata);
            $('#wkode_strata').addClass('error');
            jml++;
        }
    
        if($('#nama').val()==''){
            var wnama_strata= 'Nama harus diisi!';
            $('#wnama_strata').fadeIn(0);
            $('#wnama_strata').html(wnama_strata);
            $('#wnama_strata').addClass('error');
            jml++;
        }
    
        if(jml>0){
            //alert('Isian form belum lengkap');
            return false;
        }
    }
    
</script>
