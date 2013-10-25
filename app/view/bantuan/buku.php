<div id="top">
    <h2>DAFTAR BIAYA BUKU</h2>

    <form method="POST">
        <div id="dropdown-menu">

            <table width="97%">
                <tr>
                    <td>
                        <label>Universitas</label>
                        <select name="universitas" id="universitas" type="text">
                            <option value="">- semua -</option>>
                            <?php
                            foreach ($this->univ as $val) {
                                echo "<option value=" . $val->get_kode_in() . " >" . $val->get_nama() . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <label>Jurusan/Prodi</label>
                        <select name="jurusan" id="jurusan" type="text">
                            <option value="">- semua -</option>>
                            <?php
                            foreach ($this->jur as $val2) {
                                echo "<option value=" . $val2->get_kode_jur() . " >" . $val2->get_nama() . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <label>Tahun Masuk</label>
                        <select name="tahun_masuk" id="tahun_masuk" type="text">
                        <option value="">- semua -</option>>
                        <?php
                        for ($i = 2007; $i <= date('Y') + 2; $i++) {
                            ?>
                            <option value="<?php echo $i; ?>" <?php
                        if ($i == date('Y')) {
                            echo "selected";
                        }
                            ?>><?php echo $i; ?></option>
                                <?php } ?>
                    </select>
                    </td>
                    <td style="float: right"><input type="search" name="cari" id="cari" placeholder="Cari dengan kata kunci nomor SP2D" size="30" title="Cari"></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top: 0px">
                        <input type="button" id="add" value="TAMBAH" onClick="location.href='<?php echo URL . 'elemenBeasiswa/addUangBuku' ?>'">
                        
                    </td>
                </tr>
            </table>

            <div>

            </div>
        </div>
    </form>
    <div id="tabel_index_buku">

    </div>
</div>
<script type="text/javascript">
    
    $.post("<?php echo URL; ?>elemenBeasiswa/data_index_buku", { univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val()}, 
    function (data){
        $('#tabel_index_buku').html(data);
    })
    
    $(document).ready(function(){ 
    
        //agar ketika universitas berubah karena dipilih, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $("#universitas").change(function(){
            $.post("<?php echo URL; ?>elemenBeasiswa/get_jur_by_univ", {univ:$("#universitas").val()},
            function(data){                
                $('#jurusan').html(data);
            }); 
        
            $.post("<?php echo URL; ?>elemenBeasiswa/data_index_buku", { univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val()}, 
            function (data){
                $('#tabel_index_buku').html(data);
            })
        });
        
        //agar ketika universitas berubah karena dipilih, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $("#jurusan").change(function(){
                  
            $.post("<?php echo URL; ?>elemenBeasiswa/data_index_buku", { univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val()}, 
            function (data){
                $('#tabel_index_buku').html(data);
            })
        });
        
        //agar ketika universitas berubah karena dipilih, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $("#tahun_masuk").change(function(){
                  
            $.post("<?php echo URL; ?>elemenBeasiswa/data_index_buku", { univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val()}, 
            function (data){
                $('#tabel_index_buku').html(data);
            })
        });
        
        
        $("#cari").keyup(function(){
                  
            $.post("<?php echo URL; ?>elemenBeasiswa/data_index_buku2", { sp2d:$('#cari').val()}, 
            function (data){
                $('#tabel_index_buku').html(data);
            })
            
            if($("#cari").val()==""){
                $.post("<?php echo URL; ?>elemenBeasiswa/data_index_buku", { univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val()}, 
                function (data){
                    $('#tabel_index_buku').html(data);
                })
            }
        });
        
       
    })
</script>



