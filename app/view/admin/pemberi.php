<div id="top">
    <!--div id="form-title"-->

    <h2>DATA PEMBERI BEASISWA</h2>
    <div class="kolom3">
        <fieldset><legend>Tambah Pemberi Beasiswa</legend>
            <div id="form-input">
                <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'admin/addPemberi' ?>">
                    <div class="kiri">
                        <label>Nama</label><input type="text" name="nama_pemberi" id="nama" size="50"><div id="wnama"></div>

                        <label>Alamat</label><textarea type="text" name="alamat_pemberi" id="alamat" rows="8"></textarea><div id="walamat"></div>

                        <label>Telepon</label><input type="text" name="telp_pemberi" id="telepon" size="15"><div id="wtelepon"></div>

                        <label>PIC</label><input type="text" name="pic_pemberi" id="PIC" size="30"><div id="wPIC"></div>

                        <label>Telepon PIC</label><input type="text" name="telp_pic_pemberi" id="telp_pic" size="8"><div id="wtelp_pic"></div>

                        <ul class="inline tengah">
                            <li><input class="normal" type="reset" onclick="" value="BATAL"></li>
                            <li><input class="sukses" type="submit" name="add_pemberi" value="SIMPAN" onclick="return cek();"></li>
                        </ul>
                    </div>
                </form>
            </div>
        </fieldset>
    </div>

    <div class="kolom4" id="table">
        <fieldset><legend>Daftar Pemberi Beasiswa</legend>

            <div id="table-title"></div>
            <div id="table-content">
                <table class="table-bordered zebra scroll">
                    <thead>
                    <th>No</th>
                    <th width="200">Nama</th>
                    <th width="200">Alamat</th>
                    <th width="50">Telepon</th>
                    <th width="70">PIC</th>
                    <th width="70">Telp. PIC</th>
                    <th width="45">Aksi</th>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                        foreach ($this->data as $pemberi) { ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $pemberi->nama_pemberi; ?></td>
                                <td><?php echo $pemberi->alamat_pemberi; ?></td>
                                <td><?php echo $pemberi->telp_pemberi; ?></td>
                                <td><?php echo $pemberi->pic_pemberi; ?></td>
                                <td><?php echo $pemberi->telp_pic_pemberi; ?></td>
                                <td>
                                    <?php echo "<a href=" . URL . "admin/delPemberi/" . $pemberi->kd_pemberi . " onclick=\"return del()\"><i class=\"icon-trash\"></i></a>
                    <a href=" . URL . "admin/editPemberi/" . $pemberi->kd_pemberi . "><i class=\"icon-pencil\"></i></a>" ?>                    
                                </td>
                            </tr>
    <?php $i++;
} ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>
<script type="text/javascript">
    
    $('#nama').keyup(function() {   
        $('#wnama').fadeOut(0);             
    });
    $('#alamat').keyup(function() {   
        $('#walamat').fadeOut(0);             
    });
    $('#telepon').keyup(function() {   
        $('#wtelepon').fadeOut(0);             
    });
    $('#PIC').keyup(function() {   
        $('#wPIC').fadeOut(0);             
    });
    $('#telp_pic').keyup(function() {   
        $('#wtelp_pic').fadeOut(0);             
    });
	
    function del(){
        if(confirm('Apakah Anda yakin akan menghapus data ini?'))
            return true;
        else return false
    }
	
	
    function cek(){    
        var jml = 0;
        if($('#nama').val()==''){
            var wnama= 'Nama harus diisi!';
            $('#wnama').fadeIn(0);
            $('#wnama').html(wnama);
            $('#wnama').addClass('error');
            jml++;
        }
    
        if($('#alamat').val()==''){
            var walamat= 'Alamat harus diisi!';
            $('#walamat').fadeIn(0);
            $('#walamat').html(walamat);
            $('#walamat').addClass('error');
            jml++;
        }
        
        if($('#telepon').val()==''){
            var wtelepon= 'Telepon harus diisi!';
            $('#wtelepon').fadeIn(0);
            $('#wtelepon').html(wtelepon);
            $('#wtelepon').addClass('error');
            jml++;
        }
    
        if($('#PIC').val()==''){
            var wPIC= 'PIC harus diisi!';
            $('#wPIC').fadeIn(0);
            $('#wPIC').html(wPIC);
            $('#wPIC').addClass('error');
            jml++;
        }
        
        if($('#telp_pic').val()==''){
            var wtelp_pic= 'Telepon PIC harus diisi!';
            $('#wtelp_pic').fadeIn(0);
            $('#wtelp_pic').html(wtelp_pic);
            $('#wtelp_pic').addClass('error');
            jml++;
        }
    
    
    
        if(jml>0){
            //alert('Isian form belum lengkap');
            return false;
        }
    }
    
</script>
