<div id="top"><h2>BACKUP</h2>
    <div class="kolom3" align="center">
        <fieldset><legend>Backup Database</legend>
            <div id="form-input">
                <form method="POST" action="<?php
$_SERVER['PHP_SELF']; //echo URL.'admin/addUniversitas'
?>">
                    <input type="file" name="fupload" id="fupload">
                    <ul class="inline tengah">
<!--                        <li><input class="normal" type="submit" onclick="" value="BATAL"></li>-->
                        <li><input class="sukses" type="button" name="add_conf" value="BACKUP" onClick="backup();"></li>
                    </ul>
                </form>

            </div>
        </fieldset>
    </div>
    <div class="kolom4">
        <fieldset><legend>Petunjuk melakukan Backup Database</legend>
            <p style="margin-top: 0px; padding-left: 20px">Backup merupakan fungsi untuk menyimpan basis data sementara, sehingga ketika terjadi kesalahan/gagal menyimpan pada server pusat dapat dikembalikan (restore) ke posisi basis data semula. Backup sebaiknya dilakukan: <br><br>
                + Setiap sebelum/selesai melakukan update terhadap data <br>
                + Setiap periode/bulan sekali <br>
                + Pada komputer selain komputer server aplikasi, misalnya CD, flashdisk, komputer pribadi, dsb. <br>

            </p>
            <div id="message"></div>
        </fieldset>
    </div> <!--kolom4-->
</div>
<fieldset><legend>File Backup</legend>
    <div id="file_backup"></div>
</fieldset>
<div class="preload">
                    <img src="<?php echo URL; ?>public/icon/loading.gif">
                </div>

<script type="text/javascript">

    $(function(){
        $('#preload').fadeOut(0);
        $('#message').fadeOut(0);
        list_backup();
    })
    function preload(){
        $('.preload').fadeIn(500);
    }
    
    function list_backup(){
        $.post("<?php echo URL;?>admin/list_backup",{},
            function(data){
                $('#file_backup').html(data);
            });
    }
    
    function backup(){
        $('#message').fadeOut();
        $('.preload').fadeIn(500);
        $.post("<?php echo URL;?>admin/backup_db",{},
            function(data){
                $('.preload').fadeOut(500);
                $('#message').fadeIn(500);
                $('#message').html(data);
                list_backup();
            });
    }   
</script>