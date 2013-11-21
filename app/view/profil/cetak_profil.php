<!DOCTYPE html>
<html>
    <head>
        <title>profil_pb_<?php echo $this->d_pb->get_nip(); ?></title>   
        <style>
            td, th {
/*                border: 1px solid black;*/
                border:none;
            }
            table {
                border-collapse: collapse;
            }
            .td2{
                border: 0px ;
            }

            @media print {
                #printbtn {
                    display :  none;
                }
            }
            h3 {
                font-style: bold;
                border-bottom: 1px solid blue;
            }
            
            h4 {
                font-style: bold;
                color:blue;
                margin: 0;
                border-bottom: 1px solid background;
            }
            </style>
    </head>
    <body style="font-family:arial;color:black;font-size:10px;">
        <p align="center" style="font-weight: bold; font-size:13px;">
            DAFTAR PENERIMA BEASISWA <br />
            BEASISWA INTERNAL DIREKTORAT JENDERAL PERBENDAHARAAN <br />
            <?php
                echo strtoupper($this->d_univ->get_nama()) . " ";
            
                echo " " . strtoupper($this->d_st->get_th_masuk()) . "<br />";
            
                echo "PER ".strtoupper(Tanggal::getTglSekarangIndo());
            ?>

        </p>
         <table border="0" align="center" cellspacing=0 cellpadding=0 width=97% style="border-width: 0px; font-size: 10px;">
            <tr>
                <td class="td2" align="right"> 
                    <FORM>
                        <button TYPE="button" id="printbtn" onClick="cetak();">Cetak</button>
                    </FORM>
                </td>
            </tr>
        </table>
        <br />
        <table align="center" cellspacing=0 cellpadding=4 width=95% style="border-width: 1px; font-size: 10px; border-style: solid; border-color: black;">
            
        <!-- profil penerima -->    
        <tr><td width="50%">
                <table>
                    <tr><td width ="25%"></td><td width ="5%"></td><td width ="60%"></td></tr>
                    <tr><td colspan="3"><h3>INFORMASI PENERIMA BEASISWA :</h3></td></tr>
                    <tr><td colspan="3"><h4>INFORMASI PEGAWAI :</h4></td></tr>
                    <tr><td>Nama</td><td> : </td><td><?php echo $this->d_pb->get_nama();?></td></tr>
                    <tr><td>NIP</td><td> : </td><td><?php echo $this->d_pb->get_nip();?></td></tr>
                    <tr><td>Jenis Kelamin</td><td> : </td><td><?php echo ($this->d_pb->get_jkel()=="L")?'Laki-laki':'Perempuan';?></td></tr>
                    <tr><td>Pangkat/Gol</td><td> : </td><td><?php echo Golongan::golongan_int_string($this->d_pb->get_gol());?></td></tr>
                    <tr><td>Unit Asal</td><td> : </td><td><?php echo $this->d_pb->get_unit_asal();?></td></tr>
                    <tr><td>Alamat</td><td> : </td><td><?php echo $this->d_pb->get_alamat();?></td></tr>
                    <tr><td>Email</td><td> : </td><td><?php echo $this->d_pb->get_email();?></td></tr>
                    <tr><td>No. HP</td><td> : </td><td><?php echo $this->d_pb->get_telp();?></td></tr>
                    <tr><td>Bank Penerima</td><td> : </td><td><?php echo $this->d_bank->get_nama();?></td></tr>
                    <tr><td>No. Rekening</td><td> : </td><td><?php echo $this->d_pb->get_no_rek();?></td></tr>
                    <tr><td>Jenis Beasiswa</td><td> : </td><td><?php echo $this->d_pemb;?></td></tr>
                    <tr><td>Universitas</td><td> : </td><td><?php echo $this->d_univ->get_nama();?></td></tr>
                    <tr><td>Jurusan</td><td> : </td><td><?php echo $this->d_jur->get_nama();?></td></tr>
                    <tr><td>Tahun Masuk</td><td> : </td><td><?php echo $this->d_st->get_th_masuk();?></td></tr>
                    <tr><td>Status Tugas Belajar</td><td> : </td><td><?php echo StatusPB::status_int_string($this->d_pb->get_status());?></td></tr>
                    <tr><td colspan="3"><h4>SURAT TUGAS :</h4></td></tr>
                    <tr><td>Nomor</td><td> : </td><td><?php echo $this->d_st->get_nomor();?></td></tr>
                    <tr><td>Tanggal</td><td> : </td><td><?php echo Tanggal::tgl_indo($this->d_st->get_tgl_st());?></td></tr>
                    <tr><td>Tanggal Mulai</td><td> : </td><td><?php echo Tanggal::tgl_indo($this->d_st->get_tgl_mulai());?></td></tr>
                    <tr><td>Tanggal AKhir</td><td> : </td><td><?php echo Tanggal::tgl_indo($this->d_st->get_tgl_selesai());?></td></tr>
                </table>
            </td>
        <!-- foto profil -->
        <td width="50%" align="center" valign="top">
            <img class="frame" src="<?php 
                            if($this->d_pb->get_foto()!='' && !is_null($this->d_pb->get_foto()) && file_exists('files/foto/'.$this->d_pb->get_foto())){
                                echo URL; ?>files/foto/<?php echo $this->d_pb->get_foto();
                            }else{
                                echo URL.'public/img/unknown.png';
                            } 
                            ?>" width="185" height="220">
        </td></tr>
        
        <!-- perkembangan studi -->
        <tr><td colspan="2"><h3>RIWAYAT PERKEMBANGAN STUDI</h3></td></tr>
        <tr><td colspan="2">
                <table width="50%">
                    <tr><td colspan="3"><h4>SKRIPSI/TESIS</h4></td></tr>
                    <tr><td width="25%" valign="top">Judul</td><td width="5%" valign="top"> : </td><td width="60%" valign="top"><?php echo $this->d_pb->get_skripsi()!=''?$this->d_pb->get_skripsi():'belum terdapat judul tugas akhir';?></td></tr>
                </table>
            </td></tr>
        <tr><td width="50%"><h4>RIWAYAT IPK</h4></td><td width="50%"><h4>RIWAYAT PERMASALAHAN</h4></td></tr>
        <tr><td width="50%" valign="top">
            <table>
                <thead bgcolor="#E6F9ED"><th width="5%">NO</th><th width="20%">SEMESTER</th><th width="10%">IPS</th><th width="10%">IPK</th></thead>
                <?php 
                    $no=1;
                    foreach ($this->d_nil as $v){
                ?>
                    <tr>
                            <td valign="top" align="center"><?php echo $no;?></td>
                            <td style="text-align: center" valign="top" align="center"><?php echo $v->get_semester(); ?></td>
                            <td style="text-align: center" valign="top" align="center"><?php echo $v->get_ips(); ?></td>
                            <td valign="top" align="center"><?php echo $v->get_ipk();?></td>
                    </tr>
                <?php 
                        $no++;
                    }
                    ?>
            </table></td>
            <td width="50%" valign="top">
            <table>
                <thead bgcolor="#E6F9ED"><th width="5%">NO</th><th width="60%">URAIAN</th><th width="30%">SUMBER</th></thead>
                <?php 
                    $no=1;
                    foreach ($this->d_mas as $v){
                ?>
                    <tr>
                            <td style="text-align: center"><?php echo $no;?></td>
                            <td><?php echo $v->get_uraian();?></td>
                            <td><?php echo $v->get_sumber_masalah();?></td>
                    </tr>
                <?php 
                        $no++;
                    }
                    ?>
            </table>   
        </td></tr>
        <!-- riwayat cuti -->
        <tr><td colspan="2"><h3>RIWAYAT CUTI</h3></td></tr>
        <tr><td colspan="2">
            <table width="100%">
                <thead bgcolor="#E6F9ED"><th width="5%">NO</th><th width="30%">NO. SURAT</th><th width="20%">TANGGAL</th><th width="30%">MASA CUTI</th><th width="15%">JENIS CUTI</th></thead>
                <?php 
                    $no =1;
                    foreach($this->d_cuti as $v) {
                        $tmp_mul = explode(" ", $v->get_prd_mulai());
                        $bln_mul = Tanggal::bulan_indo($tmp_mul[0])." ".$tmp_mul[1];
                        $tmp_sel = explode(" ", $v->get_prd_selesai());
                        $bln_sel = Tanggal::bulan_indo($tmp_sel[0])." ".$tmp_sel[1];
                ?>
                    <tr>
                        <td valign="top" align="center"><?php echo $no;?></td>
                        <td valign="top" style="text-align: left"><?php echo $v->get_no_surat_cuti();?></td>
                        <td valign="top" align="center"><?php echo Tanggal::tgl_indo($v->get_tgl_surat_cuti());?></td>
                        <td valign="top"><?php echo "Mulai dari : ".$bln_mul."</br>Sampai dengan : ".$bln_sel;?></td>
                        <td valign="top" style="text-align: left"><?php echo $v->get_jenis_cuti();?></td>
                    </tr>
                <?php $no++; } ?>
            </table>
        </td></tr>
        <!-- riwayat pembayaran -->
        <tr><td colspan="2"><h3>RIWAYAT PEMBAYARAN</h3></td></tr>
        <tr><td colspan="2">
            <table width="100%">
                <thead bgcolor="#E6F9ED"><th width="5%">NO</th><th  width="50%">KETERANGAN PEMBAYARAN</th><th  width="30%">JUMLAH (RP)</th></thead>
                <?php $no=1;
                        $jml_biaya = 0;
                    foreach($this->d_bea as $v){ ?>
                <tr>
                        <td valign="top"  align="center"><?php echo $no ;?></td>
                        <td valign="top"><?php echo strtoupper($v->get_nama_biaya());?></td>
                        <td align="right" valign="top">
                                <?php 
                                echo number_format($v->get_jumlah_biaya(),2,',','.'); ?>
                        </td>
                </tr>
                <?php $jml_biaya += (int) $v->get_jumlah_biaya();$no++; } ?>
                <tr>
                        <td></td>
                        <td valign="top"><b>Jumlah</b></td>
                        <td align="right" valign="top">
                                <?php 
                                echo "<b>".number_format($jml_biaya,2,',','.')."</b>"; ?>
                        </td>
                </tr>
            </table>
        </td></tr>
        <!-- riwayat beasiswa -->
        <tr><td colspan="2"><h3>RIWAYAT PENERIMAAN BEASISWA</h3></td></tr>
        <tr><td colspan="2">
            <table width="100%">
                <thead bgcolor="#E6F9ED"><th width="5%">NO</th><th width="20%">NO. SURAT</th><th width="45%">JURUSAN</th><th  width="15%">TAHUN MASUK</th><th  width="15%">STATUS TB</th></thead>
                <?php $no=1;
                    foreach($this->d_rwt_beas as $v){
                        $d_st = explode(",", $v->get_st());
                        $no_st = $d_st[0];
                        $tgl_st = $d_st[1];
                        $thn_masuk = $d_st[2];
                        $d_jur = explode(",", $v->get_jur());
                        $univ = $d_jur[1];
                        $jur = $d_jur[0];
                        $strata = $d_jur[2];
                ?>
                <tr>
                        <td valign="top" style="text-align: center"><?php echo $no;?></td>
                        <td valign="top" ><?php echo $no_st."</br>".Tanggal::tgl_indo($tgl_st);?></td>
                        <td valign="top"  style="text-align: left"><?php echo $jur." [".$strata."]</br>".$univ;?></td>
                        <td valign="top"  style="text-align: center"><?php echo $thn_masuk;?></td>
                        <td valign="top"  style="text-align: center"><?php echo $v->get_status();?></td>
                </tr>
                <?php 
                $no++;
                } ?>
            </table>
        </td></tr>
        </table>
</body>
</html>
<script type="text/javascript">
    function cetak(){
		window.print();
		window.onfocus = function() { window.close(); }
	}
</script>
