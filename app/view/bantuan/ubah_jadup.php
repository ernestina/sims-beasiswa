<div id="top">
    <h2><a href="<?php /* $_SERVER['PHP_SELF']; */ echo URL . 'elemenBeasiswa/viewJadup' ?>">BIAYA TUNJANGAN HIDUP</a> > UBAH</h2> <!-- memakai breadcrumb -->
</div>

<div class="fitur">
    <fieldset><legend>Ubah Biaya Hidup</legend>
        <form method="POST" action="<?php echo URL; ?>elemenBeasiswa/updateJadup" enctype="multipart/form-data">
            <input  type="hidden" name="r_elem" value="1"/>       
            <div>

                <label class="isian">Universitas : </label>
                <input type="hidden" id="kode_univ" name="kode_univ" value="<?php echo $this->univ->get_kode_in(); ?>">
                <input type="text" value="<?php echo $this->univ->get_nama(); ?>" disabled>

                <label class="isian">Jurusan/Prodi : </label>
                <input type="hidden" id="kode_jur" name="kode_jur" value="<?php echo $this->jur->get_kode_jur(); ?>">
                <input type="text" value="<?php echo $this->jur->get_nama(); ?>" disabled>

                <label class="isian">Tahun Masuk : </label>
                <input type="hidden" name="tahun_masuk" id="tahun_masuk" value="<?php echo $this->elemen->get_thn_masuk(); ?>">
                <input type="text" value="<?php echo $this->elemen->get_thn_masuk(); ?>" disabled>


                <label class="isian">Bulan dan Tahun : </label>
                <?php
                if ($this->elemen->get_bln() == "1")
                    $bln = "Januari";
                if ($this->elemen->get_bln() == "2")
                    $bln = "Februari";
                if ($this->elemen->get_bln() == "3")
                    $bln = "Maret";
                if ($this->elemen->get_bln() == "4")
                    $bln = "April";
                if ($this->elemen->get_bln() == "5")
                    $bln = "Mei";
                if ($this->elemen->get_bln() == "6")
                    $bln = "Juni";
                if ($this->elemen->get_bln() == "7")
                    $bln = "Juli";
                if ($this->elemen->get_bln() == "8")
                    $bln = "Agustus";
                if ($this->elemen->get_bln() == "9")
                    $bln = "September";
                if ($this->elemen->get_bln() == "10")
                    $bln = "Oktober";
                if ($this->elemen->get_bln() == "11")
                    $bln = "Nopember";
                if ($this->elemen->get_bln() == "12")
                    $bln = "Desember";
                ?>
                <input type="hidden" id="bln" name="bln" value="<?php echo $this->elemen->get_bln(); ?>">
                <input type="hidden" id="thn" name="thn" value="<?php echo $this->elemen->get_thn(); ?>">
                <ul class="inline">
                    <li><input type="text" value="<?php echo $bln . " " . $this->elemen->get_thn(); ?>" disabled></li> 
<!--                    <li><input type="text" value="<?php echo $this->elemen->get_thn(); ?>" disabled></li>-->
                </ul>
            </div> <!--end kolom1-->
            <div>

                <label class="isian">Biaya Per Pegawai : </label>
                <input type="text" value="<?php echo $this->elemen->get_biaya_per_peg(); ?>" disabled>
                <input type="hidden" id="biaya_peg" name="biaya_peg" size="12" value="<?php echo $this->elemen->get_biaya_per_peg(); ?>" type="text"/>

                <label class="isian">Total Biaya : </label>
                <input readonly type="text" id="total_bayar" name="total_bayar" size="12" value="<?php echo $this->elemen->get_total_bayar(); ?>"/>

                <label class="isian">No. SP2D : </label>
                <input type="text" id="no_sp2d" name="no_sp2d" size="20" value="<?php echo $this->elemen->get_no_sp2d(); ?>"/>

                <label class="isian">Tgl SP2D : </label>
                <?php 
                  $tgl = date('d-m-Y', strtotime($this->elemen->get_tgl_sp2d()));      
                ?>
                <input type="text" readonly id="tgl_sp2d" name="tgl_sp2d" size="20" value="<?php if($tgl!='01-01-1970' && $tgl!='00-00-000'){echo $tgl;}; ?>"/>
                
                <?php $file= $this->elemen->get_file_sp2d();?>
                <label class="isian">File SP2D : </label>
                <ul class="inline tengah">
                    <li><input type="file" id="fupload" name="fupload" size="20" /></li>
                    <li><a href="<?php echo URL.'elemenBeasiswa/filesp2d/'.$this->elemen->get_file_sp2d(); ?>" target="_blank"><?php if($file!=""){echo "lihat file";} ?></a></li>
                </ul>
                <input type="hidden" id="fupload_lama" name="fupload_lama" value="<?php echo $this->elemen->get_file_sp2d(); ?>"/>
                
                

            </div> <!--end kolom2--> 
            <br/>
            <div> 
                <table>
                    <thead>

                    <th width= '3%'>No</th>
                    <th width= '20%'>Nama</th>
                    <th width= '10%'>Gol</th>
                    <th width= '15%'>Status</th>
                    <th width= '5%'>Jumlah Kehadiran (persentase)</th>
        <!--            <th width= '10%'>Jumlah Kotor</th>-->
                    <th width= '10%'>Pajak (persentase)</th>
        <!--            <th width= '10%'>Jumlah Bersih</th>-->
                    <th width= '5%'>Bank Penerima</th>
                    <th width= '5%'>No. Rekening</th>
                    <th></th>

                    </thead>
                    <tbody>
                    <input type="hidden" id="jml_peg" name="jml_peg" value="<?php echo count($this->penerima_elemen); ?>" />
                    <?php
                    $i = 1;
                    //var_dump($this->penerima_elemen);
                    foreach ($this->penerima_elemen as $value) {
                        $this->pb->set_kd_pb($value->kd_pb);
                        //echo $value->kd_pb;
                        $pb = $this->pb->get_penerima_by_id($this->pb);
                        $bank = $this->bank->get_bank_id($pb->get_bank());
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $pb->get_nama(); ?></td>
                            <td><?php echo Golongan::golongan_int_string($pb->get_gol()); ?></td>
                            <td><?php echo StatusPB::status_int_string($pb->get_status()); ?></td>
                            <td><input class="mini" type="text"  id="<?php echo 'jml_hadir' . $i; ?>" name="<?php echo 'jml_hadir' . $i; ?>" value="<?php echo $value->kehadiran; ?>">%</td>
                            <td><input class="mini" type="text" id="<?php echo 'pajak' . $i; ?>" name="<?php echo 'pajak' . $i; ?>" value="<?php echo $value->pajak; ?>">%</td>
                            <td><?php echo $bank->get_nama(); ?></td>
                            <td><?php echo $pb->get_no_rek(); ?></td>
                            <td>
                                <input type="hidden" id="<?php echo 'kd_pb' . $i; ?>" name="<?php echo 'kd_pb' . $i; ?>" value="<?php echo $value->kd_pb; ?>">
                                <input type="hidden" id="<?php echo 'kd_pen_el_pb' . $i; ?>" name="<?php echo 'kd_pen_el_pb' . $i; ?>" value="<?php echo $value->kd_penerima_elemen_beasiswa; ?>">         
                            </td>


                        </tr>
                        <?php
                        $i++;
                    }
                    ?>
                    </tbody>
                </table>
                Keterangan: untuk penulisan desimal gunakan tanda titik (.).
            </div>
            <div>
                <input type="hidden" id="kd_el" name="kd_el" value="<?php echo $this->elemen->get_kd_d(); ?>">
                <input name="simpan" class="sukses" type="submit" value="simpan" onClick="return konfirmasi();"/>
                <input name="batal" class="normal" type="reset" value="batal" onclick="location.href='<?php echo URL."elemenBeasiswa/viewJadup"; ?>';"/>
            </div>
        </form>
    </fieldset>
</div>


<script type="text/javascript">
    
       
    //mengubah inputan  dengan memunculkan separator ribuan
    $('#biaya_peg').number(true,0);
    $('#total_bayar').number(true,0);
    $('.mini').number(true,2);
        
    $(".mini").keyup(function(){
        jumlah_biaya();
    });
    
    $(".mini").focusout(function(){
       
        if($(this).val()==""){
            $(this).val('0');
        }
        jumlah_biaya();
    });
    
    function jumlah_biaya(){
        var jml_kehadiran = 0;
        for(var i=1; i<=$('#jml_peg').val(); i++){
            jml_kehadiran += parseFloat($('#jml_hadir'+i).val());
        }
        $("#total_bayar").val(parseFloat(jml_kehadiran*0.01*$('#biaya_peg').val()));
    }
    
    //menampilkan datepicker   
        $(function() { 
            $("#tgl_sp2d").datepicker({dateFormat: "dd-mm-yy"
                //            buttonImage:'images/calendar.gif',
                //            buttonImageOnly: true,
                //            showOn: 'button'
            }); 
        });
        
        //konfirmasi update biaya
    function konfirmasi(){
        if(confirm('Simpan data?')){
            return true;
        } else {return false;}
    }
        
</script>