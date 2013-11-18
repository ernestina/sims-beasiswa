<div id="top">
    <h2>DATA PENERIMA BEASISWA</h2>

<div>
    <form method="POST" action="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'penerima/cetak_daftar_penerima' ?>" onSubmit="cetak_dokumen('cetak_penerima');" target="cetak_penerima">
    <table style="margin-left:10px; margin-right: 10px" width="100%" >
        <tr>
            <td><label>Universitas</label><select type="text" id="univ" name="univ">
                    <option value="0">- semua -</option>
                    <?php 
                        foreach ($this->univ as $val){
                            echo "<option value=".$val->get_kode_in().">".$val->get_nama()."</option>";
                        }
                    ?>
                </select></td>
            <td><label>Tahun Masuk</label><select type="text" id="thn" name="thn">
                    <option value="0">- semua -</option>
                    <?php 
                       foreach ($this->th_masuk as $key=>$val){
                            echo "<option value=".$key.">".$val."</option>";
                        }
                    ?>
                </select></td>
            <td><label>Status</label><select type="text" id="status" name="status">
                    <option value="0">- semua -</option>
                    <?php 
                       foreach ($this->d_sts as $val){
                            echo "<option value=".$val->kd_status.">".$val->nm_status."</option>";
                        }
                    ?>
                </select></td>
            <td><input type="search" name="cari" id="cari" size="30" placeholder="Cari berdasarkan nama pegawai" title="pencarian penerima beasiswa"></td>
            <td>
                <div style="margin-right: 20px">
                    <button onClick="formSubmit" style="margin-right:20px"><i class="icon-print icon-white"></i>  CETAK</button>
                </div>
            </td>
        </tr>
        <!--tr><td colspan="3"></td><td style="padding-right: 45px; padding-top: 0px"><input type="button" value="TAMBAH" onclick="location.href='<?php echo URL.'penerima/penerima'?>'"></td></tr-->
    </table>
    </form>
</div>
<div id="tb_pb">
    <?php 
    if($this->jmlData>0){
            $jmlhal = $this->paging->jml_halaman($this->jmlData);
            $paging = $this->paging->navHalaman($jmlhal);
            if($this->jmlData>$this->paging->batas)
                echo $paging; 
            
            }
?>
<!--    </br>-->
<br><br><br>
    <?php 
        $this->load('riwayat_tb/tabel_d_pb');
    ?>
</div>
</div>

<script type="text/javascript">
$(function(){
    var univ = 0;
    var thn_masuk = 0;
    var status = 0;
    
    $('#cari').keyup(function(){
        cari($('#cari').val());
    })
    $('#univ').change(function(){
        univ = $('#univ').val();
        console.log(univ);
        filter(univ,document.getElementById('thn').value,document.getElementById('status').value);
    })
    $('#thn').change(function(){
        thn_masuk = $('#thn').val();
        filter(document.getElementById('univ').value,thn_masuk,document.getElementById('status').value);
    })
    $('#status').change(function(){
        status = $('#status').val();
        filter(document.getElementById('univ').value,document.getElementById('thn').value,status);
    })
    
//    filter(univ,thn_masuk,status);
    
})

function cari(key){
    $.post('<?php echo URL;?>penerima/cari',{name:""+key+""},function(data){
        $('#tb_pb').fadeIn(200);
        $('#tb_pb').html(data);
    })
}

function filter(univ,thn_masuk,status){
    $.post('<?php echo URL;?>penerima/filter_pb/',{univ:univ,thn_masuk:thn_masuk,status:status},
        function(data){
            $('#tb_pb').fadeIn(200);
            $('#tb_pb').html(data);
    })
}
</script>