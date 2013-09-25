<div id="table-title"></div>
    <div id="table-content">
<table class="table-bordered zebra scroll">
            <thead>
            <th>No</th>
            <th>No Surat Tugas</th>
            <th>Tanggal ST</th>
            <th>Tgl Mulai</th>
            <th>Tgl AKhir</th>
            <th>Jenis ST</th>
            <th>Jurusan/Prodi</th>
            <th>Aksi</th>
            </thead>
            <?php 
                $no=1;
                foreach($this->d_st as $val){
                    echo "<tr>";
                    echo "<td>".$no."</td>";
                    echo "<td>".$val->get_nomor()."</td>";
                    echo "<td>".$val->get_tgl_st()."</td>";
                    echo "<td>".$val->get_tgl_mulai()."</td>";
                    echo "<td>".$val->get_tgl_selesai()."</td>";
                    echo "<td>".$val->get_jenis_st()."</td>";
                    echo "<td>".$val->get_jur()."</td>";
                    echo "<td><a href=".URL."surattugas/addpb/".$val->get_kd_st().">[+]pb</a> | 
                        <a href=".URL."surattugas/del_st/".$val->get_kd_st().">X</a> | 
                        <a href=".URL."surattugas/datast/".$val->get_kd_st().">...</a></td>";
                    echo "</tr>";
                    $no++;
                }
            ?>
        </table>
    </div>