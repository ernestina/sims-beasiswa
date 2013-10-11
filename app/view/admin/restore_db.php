<div id="top"><h2>RESTORE</h2>
<div class="kolom3" align="centre">
    <fieldset><legend>Restore Database</legend>
        <div id="form-input"><div class="kiri">
<!--                <form id="form-restore" method ="POST" action ="<?php echo URL;?>admin/restore_db" enctype="multipart/form-data">-->
                <form id="form-restore" enctype="multipart/form-data">
                    <label></label><input type="file" name="file" id="fupload">
                    <ul class="inline tengah">
<!--                        <li><input class="normal" type="submit" onclick="" value="BATAL"></li>-->
                        <li><input class="sukses" type="button" name="sb_restore" value="RESTORE" onClick="restore_db();"></li>
                    </ul>
                </form>
            </div>
        </div>
    </fieldset>
</div>
<div class="kolom4">
	<fieldset><legend>Petunjuk melakukan Restore Database</legend>
		<p style="margin-top: 0px; padding-left: 20px">Backup merupakan fungsi untuk mengembalikan basis data ke posisi terakhir data yang telah disimpan pada backup. Restore sebaiknya dilakukan: <br><br>
			+ Jika terjadi kesalahan input yang besarnya signifikan dan lebih memakan waktu jika harus menghapus data satu per satu, <br>
			+ Jika terjadi gagal simpan/basis data pada server pusat bermasalah.
		
		</p>
                <div id="message" style="display:none"></div>
	</fieldset>
</div> <!--kolom4-->
</div>

<script type="text/javascript">

    $(function(){
       $('#fupload').change(function(){
           $('#message').fadeOut(200);
       })
    })
    
    function restore_db(){
        var formData = new FormData($('#form-restore')[0]);
        
        $.ajax({
            type:'post',
            url:'<?php echo URL?>admin/restore_db',
            data:formData,
            async:false,
            success:function(data){
                $('#message').html(data);
                $('#message').fadeIn(200);
            },
            cache:false,
            contentType:false,
            processData:false
            
        });
        
        return false;
    }
</script>