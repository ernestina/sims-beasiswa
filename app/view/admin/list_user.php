<div id="top">
    <h2>DATA USER</h2>
    <div class="kolom3">
        <fieldset><legend>Tambah User</legend>
            <div id="form-input">           

                <form method="POST" enctype="multipart/form-data" name="myform" onsubmit="return (validate());" action=" <?php echo URL . 'admin/addUser' ?>">

                    <div class= "kiri">
                        <input type="hidden" name="id" id="id" value="" size="30">
                        <div id="warningnip" ></div>
                        <label>NIP</label><input type="text" name="nip" id="nip" value="" size="30"/>
                        <div id="warningnama"></div>
                        <label>Nama</label><input type="text" name="nama" id="nama" value="" size="30"/>
                        <div id="warningpass"></div>
                        <label>PASS</label><input type="password" name="pass" id="pass" value="" size="30"/>
                        <label>CONFIRM PASS</label><input type="password" name="cpass" id="cpass" value="" size="30"/>
                        <label>AKSES</label>
                        <select type="text" name="akses">
                            <option value="1">Admin</option>
                            <option value="2">User</option>                          
                        </select>
                        <label>Upload Foto</label><input type="file" name="upload" id="upload" value="" size="30"/>

                        <ul class="inline tengah">
                            <li><input class= "normal" type="reset" onclick="window.location.href='<?php echo URL . "admin/listUser"; ?>'" value="BATAL"></li>
                            <li><input class= "sukses" type="submit" name="submit" value="SIMPAN"></li>
                        </ul>
                    </div> <!--end class kiri-->
                </form>
            </div>
        </fieldset>
    </div> <!--end kolom3-->


    <div class="kolom4" id="table">
        <fieldset><legend>Daftar User</legend>
            <div id="table-title"></div>
            <div id="table-content">
                <table class="table-bordered zebra scroll">
                    <thead>
                    <th width="5%">No</th>
                    <th width="20%">NIP</th>
                    <th width="30%">Nama</th>

                    <th width="5%">Akses</th>               
                    <th width="9%">Aksi</th>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($this->data as $value) {
                            echo '<tr>';
                            echo '<td>' . $i . '</td>';
                            echo '<td>' . $value->get_nip() . '</td>';
                            echo '<td>' . $value->get_nmUser() . '</td>';
                            echo '<td>' . $value->get_akses() . '</td>';
                            echo '<td>
                        <a href="' . URL . 'admin/deleteUser/' . $value->get_id() . '" onclick="return del()"><i class="icon-trash"></i></a>
			<a href="' . URL . 'admin/editUser/' . $value->get_id() . '"><i class="icon-pencil"></i></a>
                        </td>';
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
    
    $('#nip').keyup(function() {   
        $('#warningnip').fadeOut(0);             
    });
    $('#nama').keyup(function() {   
        $('#warningnama').fadeOut(0);             
    });
    $('#pass').keyup(function() {   
        $('#warningpass').fadeOut(0);             
    });
    $('#nip').keyup(function() { 
        var angka = /^\d{18}$/;
        var angka2 = /^\d{9}$/;
        if (angka.test($('#nip').val())==false && angka2.test($('#nip').val())==false){
            viewError('warningnip','NIP harus diisi dengan 9 atau 18 digit angka!'); 
        }             
    });
    
    function del(){
        if(confirm('Apakah Anda yakin akan menghapus data ini?'))
            return true;
        else return false
    }
   
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
        if(document.myform.pass.value==""){
            var warning3 = 'password harus diisi';
            $('#warningpass').fadeIn(0);
            $('#warningpass').html(warning3);
            $('#warningpass').addClass('error');
            jml++;
        } else {
            if(document.myform.pass.value!==document.myform.cpass.value){
                var warning4 = 'password tidak sama dengan confirm password nya';
                $('#warningpass').fadeIn(0);
                $('#warningpass').html(warning4);
                $('#warningpass').addClass('error');
                jml++;
            }
        }
        
        if (jml>0){
            return false;
        }
        
    }
    
</script>