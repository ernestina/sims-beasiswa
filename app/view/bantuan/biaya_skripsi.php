<div id="top">
    <h2>DAFTAR BIAYA TUGAS AKHIR/SKRIPSI/TESIS/DESERTASI</h2>

    <div id="dropdown-menu">

        <table style="margin-left: 10px" width="98%">
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
                       
                    </select>
                </td>
                <td>
                    <label>Tahun Masuk</label>
                    <select name="tahun_masuk" id="tahun_masuk" type="text">
                        <option value="">Semua</option>>
                        
                    </select>
                </td>
                <td ><input type="search" name="cari" id="cari" placeholder="Cari dengan kata kunci nomor SP2D..." style="float: right"> </td>
            </tr>
        </table>

        <button onClick="location.href='<?php echo URL . "elemenBeasiswa/addSkripsi"; ?>'" style="margin-right:20px"><i class="icon-plus icon-white"></i>  TAMBAH</button>

        <!--input type="button" id="add" value="TAMBAH" onClick="location.href=''"-->

    </div>
    <BR><BR><br>
    <div id="tabel_index_skripsi" class="kolom4"></div>

    <div class="kolom3" align="right">
        Jumlah Mahasiswa sedang penelitian:
        <ul>
            <?php
            //var_dump($this->arr);
            $i = 0;
            foreach ($this->arr as $key => $arr) {
                if ($arr['jml'] > 0 && $arr['byr'] != $arr['jml']) {
                    echo "<li title=\"Telah dibayarkan: " . $arr['byr'] . " orang. Proses dibayar: " . $arr['pros'] . "\">" . $arr['jur'] . " " . $arr['thn'] . " (" . $arr['jml'] . " orang)</li>";

                    echo "<br/>";
                    $i++;
                }
            }
            ?>
        </ul>
    </div>

</div>

<script type="text/javascript">
    
    displayElemenSkripsi();
    function displayElemenSkripsi(){
        $.post("<?php echo URL; ?>elemenBeasiswa/data_index_skripsi", { univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val()}, 
        function (data){
            $('#tabel_index_skripsi').html(data);
        })
        
        $('#cari').val('');
    }
    $(document).ready(function(){ 
    
        //agar ketika universitas berubah karena dipilih, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $("#universitas").change(function(){
            $.post("<?php echo URL; ?>elemenBeasiswa/get_jur_by_univ", {univ:$("#universitas").val()},
            function(data){                
                $('#jurusan').html(data);
            }); 
        
            displayElemenSkripsi();
        });
        
         $('#jurusan').change(function(){
            //alert ($('#kode_jur').val());
            displayElemenSkripsi();
            
            $.ajax({
                type:"POST",
                url: "<?php echo URL; ?>elemenBeasiswa/get_thn_masuk_by_jur",
                data: {kd_jurusan:$('#jurusan').val()},
                success: function(thn_masuk){
                    $('#tahun_masuk').html(thn_masuk);
                }
            }); 
        })
        
        //agar ketika universitas berubah karena dipilih, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $("#tahun_masuk").change(function(){
                  
            displayElemenSkripsi();
        });
               
        
        $("#cari").keyup(function(){
                  
                       
            if($("#cari").val()==""){
                displayElemenSkripsi();
            } else {
                $.post("<?php echo URL; ?>elemenBeasiswa/data_index_skripsi2", { sp2d:$('#cari').val()}, 
                function (data){
                    $('#tabel_index_skripsi').html(data);
                });
                $("#jurusan, #tahun_masuk, #universitas").val('');
            }
        });
        
       
    })
    
    
</script>


