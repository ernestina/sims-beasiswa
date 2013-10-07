<form method="POST" id="form_tagihan" action="<?php echo URL . 'kontrak/updateTagihan' ?>" enctype="multipart/form-data">
    <input type="hidden" name="update_tagihan">
    <h2>Data Tagihan Biaya</h2>
    <div id="proses_tagihan" title="Informasi" style="display:none" align="center">
        <p> Sistem sedang melakukan proses update data tagihan biaya.....</p>
    </div>

    <div class="kolom1">

        <label class="isian">No. BAST</label>
        <input type="text" size="30" name="no_bast" id="no_bast" value="<?php echo $this->biaya->no_bast; ?>">
        <div id="wno_bast"></div>
        <label class="isian">Tgl. BAST</label>
        <?php
        $tgl_bast = date('d-m-Y', strtotime($this->biaya->tgl_bast));
        if ($tgl_bast != "01-01-1970" && $tgl_bast != "00-00-0000") {
            $tgl_bast_ = $tgl_bast;
        } else {
            $tgl_bast_ = "";
        }
        ?>
        <input type="text" size="20" name="tgl_bast" id="tgl_bast" value="<?php echo $tgl_bast_ ?>">
        <div id="wtgl_bast"></div>
        <label class="isian">File BAST</label>
        <?php
        $file_bast = $this->biaya->file_bast;
        if ($file_bast != "") {
            $file_bast_ = $file_bast;
        } else {
            $file_bast_ = "";
        }
        ?>
        <ul class="inline">
            <li><input type="file" name="file_bast" id="file_bast"/></li>
            <li><a href="<?php echo URL . "kontrak/fileBast/" . $file_bast_; ?>"target="_blank"><?php echo $file_bast_; ?></a></li>
        </ul>
        <div id="wfile_bast"></div>

        <label class="isian">No. BAP</label>
        <input type="text" size="30" name="no_bap" id="no_bap" value="<?php echo $this->biaya->no_bap; ?>">
        <div id="wno_bap"></div>
        <label class="isian">Tgl. BAP</label>
        <?php
        $tgl_bap = date('d-m-Y', strtotime($this->biaya->tgl_bap));
        if ($tgl_bap != "01-01-1970" && $tgl_bap != "00-00-0000") {
            $tgl_bap_ = $tgl_bap;
        } else {
            $tgl_bap_ = "";
        }
        ?>
        <input type="text" size="20" name="tgl_bap" id="tgl_bap" value="<?php echo $tgl_bap_; ?>">            
        <div id="wtgl_bap"></div>
        <label class="isian">File BAP</label>
        <?php
        $file_bap = $this->biaya->file_bap;
        if ($file_bap != "") {
            $file_bap_ = $file_bap;
        } else {
            $file_bap_ = "";
        }
        ?>
        <ul class="inline">
            <li><input type="file" name="file_bap" id="file_bap"/></li>
            <li><a href="<?php echo URL . "kontrak/fileBap/" . $file_bap_; ?>"target="_blank"><?php echo $file_bap_; ?></a></li>
        </ul>
        <div id="wfile_bap"></div>
    </div>

    <div class="kolom2">
        <label class="isian">No. Ringkasan Kontrak</label>
        <input type="text" size="30" name="no_ring_kon" id="no_ring_kon" value="<?php echo $this->biaya->no_ring_kontrak; ?>">
        <div id="wno_ring_kon"></div>
        <label class="isian">Tgl Ringkasan Kontrak</label>
        <?php
        $tgl_ring_kontrak = date('d-m-Y', strtotime($this->biaya->tgl_ring_kontrak));
        if ($tgl_ring_kontrak != "01-01-1970" && $tgl_ring_kontrak != "00-00-0000") {
            $tgl_ring_kontrak_ = $tgl_ring_kontrak;
        } else {
            $tgl_ring_kontrak_ = "";
        }
        ?>
        <input type="text"name="tgl_ring_kon" id="tgl_ring_kon" 
               value="<?php echo $tgl_ring_kontrak_; ?>">
        <div id="wtgl_ring_kon"></div>
        <label class="isian">File. Ringkasan Kontrak</label>
        <?php
        $file_ring_kontrak = $this->biaya->file_ring_kontrak;
        if ($file_ring_kontrak != "") {
            $file_ring_kontrak_ = $file_ring_kontrak;
        } else {
            $file_ring_kontrak_ = "";
        }
        ?>
        <ul class="inline">
            <li><input type="file"size="30" name="file_ring_kon" id="file_ring_kon"></li>
            <li><a href="<?php echo URL . "kontrak/fileRingKontrak/" . $file_ring_kontrak_; ?>"target="_blank"><?php echo $file_ring_kontrak_; ?></a></li>
        </ul>
        <div id="wfile_ring_kon"></div>

        <label class="isian">No. Kuitansi</label>
        <input type="text" size="30" name="no_kuitansi" id="no_kuitansi" value="<?php echo $this->biaya->no_kuitansi; ?>"> 
        <div id="wno_kuitansi"></div>
        <label class="isian">Tgl. Kuitansi</label>
        <?php
        $tgl_kuitansi = date('d-m-Y', strtotime($this->biaya->tgl_kuitansi));
        if ($tgl_kuitansi != "01-01-1970" && $tgl_kuitansi != "00-00-0000") {
            $tgl_kuitansi_ = $tgl_kuitansi;
        } else {
            $tgl_kuitansi_ = "";
        }
        ?>
        <input type="text" size="30" name="tgl_kuitansi" id="tgl_kuitansi" 
               value="<?php echo $tgl_kuitansi_; ?>">
        <div id="wtgl_kuitansi"></div>
        <label class="isian">File Kuitansi</label>
        <?php
        $file_kuitansi = $this->biaya->file_kuitansi;
        if ($file_kuitansi != "") {
            $file_kuitansi_ = $file_kuitansi;
        } else {
            $file_kuitansi_ = "";
        }
        ?>
        <ul class="inline">
            <li><input type="file" name="file_kuitansi" id="file_kuitansi"></li>
            <li><a href="<?php echo URL . "kontrak/fileKuitansi/" . $file_kuitansi_; ?>"target="_blank"><?php echo $file_kuitansi_; ?></a></li>
        </ul>
        <div id="wfile_kuitansi"></div>
    </div>
    <ul class="inline">
        <li>Data Penerima Pembayaran :</li> 
        <li id="tambah_penerima">(tambah)</li>
    </ul>
    <div class="kolom4" id="tabel_penerima_biaya">
    </div>

    <div>
        <input type="hidden" id="jml_peg" name="jml_peg" value="<?php echo $this->biaya->jml_pegawai_bayar; ?>">
        <input type="hidden" id="kd_biaya" name="kd_biaya" value="<?php echo $this->biaya->kd_biaya; ?>">
        <input type="hidden" name="file_bast_lama" id="file_bast_lama" value="<?php echo $this->biaya->file_bast; ?>">
        <input type="hidden" name="file_bap_lama" id="file_bap_lama" value="<?php echo $this->biaya->file_bap; ?>">
        <input type="hidden" name="file_ring_kon_lama" id="file_ring_kon_lama" value="<?php echo $this->biaya->file_ring_kontrak; ?>">
        <input type="hidden" name="file_kuitansi_lama" id="file_kuitansi_lama" value="<?php echo $this->biaya->file_kuitansi; ?>">
        <input type="submit" class="sukses" value="simpan" id="update_tagihan" onClick="return konfirmasi_tagihan();">
    </div>
</form>

<div id="dialog_form" title="Menambahkan Penerima Beasiswa ke Tagihan">
    <form id="form_pb">
        <table >
            <thead>
            <th>NO</th>
            <th>NIP</th>
            <th>Nama</th>
            <th>Status</th>
            <th>Pilihan</th>
            </thead>
            <?php
            $i = 1;
            foreach ($this->penerima_pb as $val) {
                $penerima_biaya_kontrak = new PenerimaBiayaKontrak();
                $penerima_biaya = $penerima_biaya_kontrak->get_by_biaya_pb($this->biaya->kd_biaya, $val->get_kd_pb());
                $status = new Status();
                $status_pb = $status->get_by_id($val->get_status());
                //var_dump($penerima_biaya);
                //echo $this->biaya->kd_biaya;
                //echo $val->get_kd_pb();
                if($penerima_biaya!=false){
                    $disable = " disabled";
                } else {
                    $disable = "";
                }
                        ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $val->get_nip(); ?></td>
                    <td><?php echo $val->get_nama(); ?></td>
                    <td><?php echo $status_pb->nm_status; ?></td>
                    <td><input type="checkbox" value="<?php echo $val->get_kd_pb(); ?>" name="<?php echo "penerima[]"; ?>" id="<?php echo "penerima[]"; ?>" <?php echo $disable; ?>/></td>
                </tr> 
                <?php
                $i++;
            }
            ?>
        </table>
        <input type="hidden" id="kd_biaya" name="kd_biaya" value="<?php echo $this->biaya->kd_biaya; ?>">
    </form>

</div>

<script>
    //****
    // memproses update data tagihan
    //****
    
    $(document).ready(function(){  //mulai jquery
        
        //menampilkan tebel biaya pb
        displayTabelBiayaPb();
        
        //menampilkan datepicker   
        $(function() { 
            $("#tgl_bast").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });
        $(function() { 
            $("#tgl_bap").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });
        $(function() { 
            $("#tgl_ring_kon").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });
        $(function() { 
            $("#tgl_kuitansi").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });
        
        $("#tambah_penerima").mouseover(function() {
            $(this).css('cursor', 'pointer');
        });
        
        
        $("#tambah_penerima").click(function() {
            $( "#dialog_form" ).dialog( "open" );
        });  
        
        function ceklist(){
            var chks = document.getElementsByName('penerima[]');
            var hasChecked = false;
            for (var i = 0; i < chks.length; i++){
                if (chks[i].checked){
                    hasChecked = true;
                    break;
                }
            }
            return hasChecked;
        }
        
        $("#dialog_form").dialog({
            autoOpen: false,
            height: 600,
            width: 800,
            modal: true,
            bgiframe: true,
            position: 'top',
            draggable: false,
            buttons: {
                "Tambahkan ke tagihan": function() {
                    if(ceklist()==true){
                        //var penerima = document.getElementsByName('penerima[]');
                        var kd_biaya =  $("#kd_biaya").val();
                        var vals = []
                        $('input:checkbox[name="penerima[]"]').each(function() {
                            if (this.checked) {
                                vals.push(this.value);
                            }
                        });
                       
                        $.ajax({
                            type:"POST",
                            url: "<?php echo URL; ?>kontrak/addTagihanPb",
                            data: {penerima:vals,kd_biaya:kd_biaya},
                            cache: false,
                            dataType: 'json',
                            success: function(msg){
                                if(msg.respon=="sukses"){
                                    displayTabelBiayaPb();
                                    alert('Data berhasil ditambahkan');   
                                }
                            },
                            error: function(XMLHttpRequest, textStatus, errorThrown) {                          
                                alert('tidak dapat memproses saat ini.');
                            }
                        });
                        $( this ).dialog( "close" );
                    } else {
                        alert("Pilihan ceklist belum diisi.");
                    }
                    
                },
                Cancel: function() {
                    $( this ).dialog( "close" );
                }
            }
        });
  

    })
    
    //menampilkan data penerima biaya
    function displayTabelBiayaPb(){
        $.ajax({
            type:"POST",
            url: "<?php echo URL; ?>kontrak/getTagihanPbByBiaya",
            data: {kd_biaya:$("#kd_biaya").val()},
            cache: false,
            success: function(penerima){
                $('#tabel_penerima_biaya').fadeIn(100);
                $('#tabel_penerima_biaya').html(penerima);
            }
        });
    }
    
    //konfirmasi update tagihan
    function konfirmasi_tagihan(){
        if(confirm('Simpan perubahan data tagihan?')){
            $('#proses_tagihan').show();
            return true;
        } else {return false;}
    }
</script>