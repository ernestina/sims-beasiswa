<div id="top">
    <h2>DATA USER</h2>
    <div class="kolom3">
        <fieldset><legend>Tambah User</legend>
            <div id="form-input">           

                <form method="POST" enctype="multipart/form-data" name="myform" onsubmit="return (validate());" action=" <?php echo URL . 'Admin/addUser' ?>">

                    <div class= "kiri">
                        <input type="hidden" name="id" id="id" value="" size="30">
                        <label>NIP</label><input type="text" name="nip" id="nip" value="" size="30"/><div id="warningnip" ></div>
                        <label>Nama</label><input type="text" name="nama" id="nama" value="" size="30"/><div id="warningnama"></div>
                        <label>PASS</label><input type="password" name="pass" id="pass" value="" size="30"/><div id="warningpass"></div>
                        <label>CONFIRM PASS</label><input type="password" name="cpass" id="cpass" value="" size="30"/>
                        <label>AKSES</label><input type="text" name="akses" id="akses" value="" size="30"/><div id="warningakses"></div>
                        <label>Upload Foto</label><input type="file" name="foto" id="upload" value="" size="30"/>

                        <ul class="inline tengah">
                            <li><input class= "normal" type="reset" onclick="" value="BATAL"></li>
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
                    <th width="20%">Pass</th>
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
                            echo '<td>' . $value->get_pass() . '</td>';
                            echo '<td>' . $value->get_akses() . '</td>';
                            echo '<td>
                        <a href="' . URL . 'Admin/deleteUser/' . $value->get_id() . '"><i class="icon-trash"></i></a> &nbsp &nbsp
			<a href="' . URL . 'Admin/editUser/' . $value->get_id() . '"><i class="icon-pencil"></i></a>
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
    
        if (document.myform.akses.value==""){
            var warning5 = 'akses belum diisi';
            $('#warningakses').fadeIn(0);
            $('#warningakses').html(warning5);
            $('#warningakses').addClass('error');
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