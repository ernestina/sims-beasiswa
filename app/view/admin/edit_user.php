<div id="top">
    <h2>UBAH DATA USER</h2>
    <div class="kolom3">
        <fieldset><legend>Ubah User</legend>

            <div id="form-input">           
                <form method="POST" enctype="multipart/form-data" name="myform" onsubmit="return (validate());" action=" <?php echo URL . 'Admin/updateUser' ?>">

                    <div class="kiri">
                        <input type="hidden" name="id" id="id" value="<?php echo $this->data->get_id(); ?>" size="30">
                        <label>NIP</label><input type="text" name="nip" id="nip" value="<?php echo $this->data->get_nip(); ?>" size="30"/><div id="warningnip" ></div>
                        <label>Nama</label><input type="text" name="nama" id="nama" value="<?php echo $this->data->get_nmUser(); ?>" size="30"/><div id="warningnama" ></div>
                        <label>Password</label><input type="password" name="pass" id="pass" value="no_change" size="30"/><div id="warningpass" ></div>
                        <label>Confirm Password</label><input type="password" name="cpass" id="cpass" value="no_change" size="30"/>
                        <label>AKSES</label>
                        <select type="text" name="akses">
                            <option value="1">Admin</option>
                            <option value="2">User</option>                          
                        </select>
                        <label>Upload Foto</label><input type="file" name="foto" id="foto" value="" size="30"/>
                        <ul class="inline tengah">
                            <li><input class="normal" type="reset" onclick="window.location.href='<?php echo URL . "admin/listUser"; ?>'" value="BATAL"></li>
                            <li><input class="sukses" type="submit" name="submit" value="SIMPAN" onclick=""></li>
                        </ul>
                    </div>

                </form>
            </div>
        </fieldset>
    </div>
    <div class="kolom4" id="table">
        <fieldset><legend>Daftar User</legend>
            <div id="table-title"></div>
            <div id="table-content">
                <table class="table-bordered zebra scroll">
                    <thead>                   
                    <th width="5%">No</th>
                    <th width="30%">NIP</th>
                    <th width="40%">Nama</th>

                    <th width="15%">Akses</th>                     
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($this->data2 as $value) {
                            echo '<tr>';
                            echo '<td>' . $i . '</td>';
                            echo '<td>' . $value->get_nip() . '</td>';
                            echo '<td>' . $value->get_nmUser() . '</td>';
                            $akses = $value->get_akses();
                            if ($akses == 1) {
                                echo '<td>admin</td>';
                            } else if ($akses == 2) {
                                echo '<td>user</td>';
                            } else {
                                echo '<td>akses tidak diketahui</td>';
                            }
                            echo '</tr>';

                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </div>

</div>
<script type="text/javascript">
    function validate(){
        var jml=0;
        
        if (document.myform.nip.value==""){
            var warning1 = 'nip harus diisi';
            $('#warningnip').fadeIn(0);
            $('#warningnip').html(warning1);
            $('#warningnip').addClass('error');        
            jml++;
        }
        if (document.myform.nama.value==""){
            var warning2 = 'nama harus diisi';
            $('#warningnama').fadeIn(0);
            $('#warningnama').html(warning2);
            $('#warningnama').addClass('error');
            jml++;
        }
        if(document.myform.pass.value!==document.myform.cpass.value){
            var warning4 = 'password tidak sama dengan confirm password nya';
            $('#warningpass').fadeIn(0);
            $('#warningpass').html(warning4);
            $('#warningpass').addClass('error');
            jml++;
        }
          
        if (jml>0){
            return false;
        }
        
    }
    
</script>

