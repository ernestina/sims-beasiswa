<div id="top">
    <h2>DATA KONTRAK KERJASAMA</h2>

    <table width=100% style="margin-left: 0px">
        <tr>
            <td width="95px" ><label >Pilih Universitas :</label></td>
            <td style="padding-top:15px;">
                <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'kontrak/display' ?>">
<!--            <input type="hidden" name="pilih_univ">-->
                    <select name="universitas" id="kd_univ">
                        <option value="">Semua</option>
                        <?php
                        foreach ($this->kd_univ as $univ) {
                            if ($this->pil == $univ->get_kode_in()) {
                                $select = "selected";
                            } else {
                                $select = "";
                            }
                            ?>
                            <option value="<?php echo $univ->get_kode_in(); ?>" <?php echo $select; ?>><?php echo $univ->get_nama(); ?></option>
                        <?php } ?>
                    </select>
        <!--            <input type="button" value="SUBMIT">-->

            </td>

            <td>
<!--                <input type="button" value="TAMBAH" onClick="location.href='<?php echo URL . 'kontrak/rekamKontrak'; ?>'"style="margin-top:0px; margin-right: -8px">-->
                <input type="button" id="tambah_kontrak" value="TAMBAH" style="margin-top:0px; margin-right: -8px">
                </form>
            </td>
        </tr>
    </table>





</div>
<div id="tb_kontrak">
</div>
<div class="kolom1">
    <p>
        Keterangan:
        * Nilai kontrak dengan nilai total biaya kontrak tidak sama.
    </p>
</div>
<div id="loading" class="loading" style="display: none"><img src="<?php echo URL . 'public/icon/loading.gif'; ?>" /></div>
<div id="dialog_rekam_kontrak" title="Menambahkan Data Kontrak Kerja Sama">
    <div id="dialog_edit_kontrak" title="Ubah Data Kontrak Kerja Sama"> </div>
</div>


<script>
    
    //menjalankan fungsi displayKontrak() ketika halaman diload.
    displayKontrak();
    
    //fungsi untuk menampilkan data kontrak
    function displayKontrak(){
        $("#loading").show();
        if($("#kd_univ").val() == ""){
            univ = "";
            $.post("<?php echo URL; ?>kontrak/get_data_kontrak", {univ:""+univ},
            function(data){                
                $('#tb_kontrak').fadeIn(100);
                $('#tb_kontrak').html(data);
            });
        } else {
            $.post("<?php echo URL; ?>kontrak/get_data_kontrak", {univ:""+$("#kd_univ").val()},
            function(data){                
                $('#tb_kontrak').fadeIn(100);
                $('#tb_kontrak').html(data);
            });
        } 
        $("#loading").hide();
    }
    
    //ketika link edit diklik pada halaman tabel_kontrak.php
    function edit(id){
        $("#loading").show();
        $("#dialog_edit_kontrak").empty();
        $("#dialog_edit_kontrak").load("<?php echo URL; ?>kontrak/viewEditKontrak/"+id);
        $("#dialog_edit_kontrak").hide();
        $("#dialog_edit_kontrak").dialog( "open" );
        $("#loading").hide();
    }
    
    $(document).ready(function(){ 
        //jika ada event onchange ambil data dari database
        $("#kd_univ").change(function(){
            //ambil nilai univ dan url dari form
            $("#loading").show();
            univ = $("#kd_univ").val();
            //url = $("#url").val();
            $.post("<?php echo URL; ?>kontrak/get_data_kontrak", {univ:""+univ},
            function(data){                
                $('#tb_kontrak').fadeIn(100);
                $('#tb_kontrak').html(data);
            });
            $("#loading").hide();
            
        });
        
        //trigger ketika tombol tambah diklik akan menampilkan modal form rekam
        $("#tambah_kontrak").click(function() {
            $("#dialog_rekam_kontrak").load("<?php echo URL; ?>kontrak/viewRekamKontrak");
            $("#dialog_rekam_kontrak").hide();
            $("#dialog_rekam_kontrak").dialog( "open" );
        });

        //modal form rekam
        $("#dialog_rekam_kontrak").dialog({
            autoOpen: false,
            height: 550,
            width: 800,
            modal: true,
            show: "fade",
            hide: "clip",
            //bgiframe: true,
            position: 'top',
            draggable: false,
            buttons: {
                "Simpan": function() {
                    //fungsi cek rekam untuk validasi form rekam_kontrak pada rekam_kontrak_dialog.php
                    if(cekRekam()!=false){
                        $("#loading").show();
                        var formData = new FormData($('#form_rekam_kontrak2')[0]);
                        //alert(formData);
                        $.ajax({
                            url: '<?php echo URL; ?>kontrak/rekamKontrak2',
                            type: 'POST',
                            data: formData,
                            cache: false,
                            //dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function () {
                                $('#form_rekam_kontrak2')[0].reset();
                                displayKontrak();
                                $("#loading").hide(); 
                                //$( this ).dialog( "close" );
                                alert('Data berhasil disimpan');
 
                            }                       
                        });
                    }
                },
                Batal: function() {
                    $( this ).dialog( "close" );
                    
                }
            }
        });
                 
           
        //modal form edit
        $("#dialog_edit_kontrak").dialog({
            autoOpen: false,
            height: 550,
            width: 800,
            modal: true,
            show: "fade",
            hide: "clip",
            cache:false,
            //bgiframe: true,
            position: 'top', 
            draggable: false,
            buttons: {
                "Simpan": function() {
                    //fungsi cek update untuk validasi form edit_kontrak pada edit_kontrak_dialog.php
                    if(cekEdit()!=false){
                        $("#loading").show();
                        var formData = new FormData($('#form_edit_kontrak2')[0]);
                        //alert(formData);
                        $.ajax({
                            url: '<?php echo URL; ?>kontrak/updateKontrak2',
                            type: 'POST',
                            data: formData,
                            cache: false,
                            //dataType: 'json',
                            processData: false,
                            contentType: false,
                            success: function () {
                                displayKontrak();
                                $("#loading").hide();
                                alert('Perubahan data berhasil disimpan');   
                            },
                            error: function(jq,status,message) {
                                alert('Jquery error. Status: ' + status + ' - Message: ' + message);
                            }
                        });
                        //$( this ).dialog( "close" );
                    }
                },
                Batal: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
    })
    
    

    
</script>