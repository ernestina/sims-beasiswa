<div id="top">
    <div id="form">
        <h2>DATA JENIS SURAT CUTI</h2></div>
    <div class="kolom3">
        <fieldset><legend>Tambah Jenis Surat Cuti</legend>
            <div id="form-input"><div class="kiri">
                    <form method="POST" action="<?php
if (isset($this->d_ubah)) {
    echo URL . 'admin/updCuti';
} else {
    $_SERVER['PHP_SELF'];
}
?>">
                          <?php
                          if (isset($this->d_ubah)) {
                              echo "<input type=hidden name='kd_jns_srt_cuti' value=" . $this->d_ubah->get_kode() . ">";
                          }

                          if (isset($this->error)) {
                              echo "<div class=error>" . $this->error . "</div>";
                          }
                          ?>

                        <div id="wnama"  class="error"></div>
                        <label>Nama</label><input type="text" name="nama" id="nama" size="50" value="<?php echo isset($this->d_ubah) ? $this->d_ubah->get_nama() : (isset($this->d_rekam) ? $this->d_rekam->get_nama() : ''); ?>">
                        <div id="wketerangan" class="error"></div>
                        <label>Keterangan</label><textarea name="keterangan" id="keterangan" rows="8" type="text"><?php echo isset($this->d_ubah) ? $this->d_ubah->get_keterangan() : (isset($this->d_rekam) ? $this->d_rekam->get_keterangan() : ''); ?></textarea>
                        </select>
                        <ul class="inline tengah">
                            <li><input class="normal" type="submit" onclick="" value="BATAL"></li>
                            <li><input class="sukses" type="submit" name="<?php echo isset($this->d_ubah) ? 'upd_sc' : 'add_sc'; ?>" value="SIMPAN" onClick="return cek();"></li>
                        </ul>
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
                    <th width='200'>Nama</th>
                    <th width='400'>Keterangan</th>
                    <th width="50">Aksi</th>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($this->data as $val) {
                            echo "<tr>";
                            echo "<td>$no</td>";
                            echo "<td>" . $val->get_nama() . "</td>";
                            echo "<td>" . $val->get_keterangan() . "</td>";
                            echo "<td><a href=" . URL . "admin/delCuti/" . $val->get_kode() . " onclick='return del()'><i class=\"icon-trash\"></i></a>
                        <a href=" . URL . "admin/addCuti/" . $val->get_kode() . "><i class=\"icon-pencil\"></i></a></td>";
                            echo "</tr>";
                            $no++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function del(){
        if(confirm('Apakah Anda yakin akan menghapus data ini?'))
            return true;
        else return false
    }
    
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
    
        $('#keterangan').keyup(function(){
            if(document.getElementById('keterangan').value !=''){
                $('#wketerangan').fadeOut(200);
            }
        })
    }
    
    function cek(){
    
        var nama = document.getElementById('nama').value;
        var keterangan = document.getElementById('keterangan').value;
        var jml=0;
    
        if(nama==''){
            var wnama= 'Nama jenis surat tugas harus diisi!';
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