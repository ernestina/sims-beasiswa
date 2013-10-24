<div id="top">
    <h2>MONITORING PEMBAYARAN KEUANGAN</h2>

    <div id="dropdown-menu">
        <form method="POST" action="<?php echo URL . 'elemenBeasiswa/cetak_mon_pembayaran'; ?>" target="_blank">
            <table style="margin-left: 40px" >
                <tr>
                    <td>
                        <label>Universitas</label>
                        <select name="universitas" id="universitas">
                            <option value="">Semua</option>>
                            <?php
                            foreach ($this->univ as $val) {
                                echo "<option value=" . $val->get_kode_in() . " >" . $val->get_nama() . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <label>Jurusan/Prodi</label>
                        <select name="jurusan" id="jurusan">
                            <option value="">Semua</option>
                            <?php
                            foreach ($this->jur as $val2) {
                                echo "<option value=" . $val2->get_kode_jur() . " >" . $val2->get_nama() . "</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <label>Tahun Masuk</label>
                        <select name="tahun_masuk" id="tahun_masuk">
                            <option value="">Semua</option>

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
                    <td>
                        <label>Elemen</label>
                        <select name="elemen" id="elemen">
                            <option value="">Semua</option>
                            <option value="1">Tunjangan Hidup</option>
                            <option value="2">Buku</option>
                            <option value="3">TA/Skripsi/Tesis</option>
                            
                            
                        </select>

                    </td>
                    <td>
                        <div style="margin-right: 20px">
                            <input class="sukses" type="submit" name="cetak" value="CETAK">
                        </div>
                    </td>
                </tr>
            </table>

        </form>
    </div>

    <div id="tabel_index_mon">    
    </div>

</div>
<script type="text/javascript">
    
    $.post("<?php echo URL; ?>elemenBeasiswa/data_index_mon", {univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val(),elemen:$('#elemen').val()}, 
    function (data){
        //$('#tabel_index_mon').fadeIn(100);
        $('#tabel_index_mon').html(data);
    })
    
    $(document).ready(function(){ 
    
        //agar ketika universitas berubah karena dipilih, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $("#universitas").change(function(){
            $.post("<?php echo URL; ?>elemenBeasiswa/get_jur_by_univ", {univ:$("#universitas").val()},
            function(data){                
                $('#jurusan').html(data);
            }); 
        
            $.post("<?php echo URL; ?>elemenBeasiswa/data_index_mon", {univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val(),elemen:$('#elemen').val()},
            function(data){                
                $('#tabel_index_mon').html(data);
            }); 
        });
        
        //agar ketika universitas berubah karena dipilih, pilihan jurusan menyesuaikan dengan universitas yang telah dipilih
        $("#jurusan, #tahun_masuk, #elemen").change(function(){
                  
            $.post("<?php echo URL; ?>elemenBeasiswa/data_index_mon", {univ:$('#universitas').val(),jurusan:$('#jurusan').val(),tahun:$('#tahun_masuk').val(),elemen:$('#elemen').val()},
            function(data){                
                $('#tabel_index_mon').html(data);
            }); 
        });
        
        
    })
    
    
   
</script>