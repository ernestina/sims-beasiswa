<?php

class Biaya extends BaseModel {

    public $kd_biaya;
    public $kd_kontrak;
    public $nama_biaya;
    public $biaya_per_pegawai;
    public $jml_pegawai_bayar;
    public $jumlah_biaya;
    public $jadwal_bayar;
    public $no_bast;
    public $tgl_bast;
    public $file_bast;
    public $no_bap;
    public $tgl_bap;
    public $file_bap;
    public $no_ring_kontrak;
    public $tgl_ring_kontrak;
    public $file_ring_kontrak;
    public $no_kuitansi;
    public $tgl_kuitansi;
    public $file_kuitansi;
    public $no_sp2d;
    public $tgl_sp2d;
    public $file_sp2d;
    public $status_bayar;

    public function __construct() {
        parent::__construct();
    }

    public function get_All() {
        $table = "d_tagihan";
        $sql = "SELECT * FROM $table order by kd_biaya desc";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $biaya = new $this();
            $biaya->kd_biaya = $val['KD_TAGIHAN'];
            $biaya->kd_kontrak = $val['KD_KON'];
            $biaya->nama_biaya = $val['NM_TAGIHAN'];
            $biaya->biaya_per_pegawai = $val['BIAYA_PER_PEG_TAGIHAN'];
            $biaya->jml_pegawai_bayar = $val['JML_PEG_BAYAR_TAGIHAN'];
            $biaya->jadwal_bayar = date('d-m-Y', strtotime($val['JADWAL_BAYAR_TAGIHAN'])); //$val['TGL_KON']; 
            $biaya->jumlah_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast = date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap = date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_ring_kontrak_TAGIHAN'];
            $biaya->tgl_ring_kontrak = date('d-m-Y', strtotime($val['TGL_ring_kontrak_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_ring_kontrak_TAGIHAN'];
            $biaya->no_kuitansi = $val['NO_KUITANSI_TAGIHAN'];
            $biaya->file_kuitansi = $val['FILE_KUITANSI_TAGIHAN'];
            $biaya->tgl_kuitansi = date('d-m-Y', strtotime($val['TGL_KUITANSI_TAGIHAN']));
            $biaya->no_sp2d = $val['NO_SP2D_TAGIHAN'];
            $biaya->file_sp2d = $val['FILE_SP2D_TAGIHAN'];
            $biaya->tgl_sp2d = date('d-m-Y', strtotime($val['TGL_SP2D_TAGIHAN']));
            $data[] = $biaya;
        }
        //var_dump($data);
        return $data;
    }

    public function get_by_kontrak($id) {
        $table = "d_tagihan";
        $where = "KD_KON='" . $id . "'";
        $sql = "SELECT * FROM $table where $where order by KD_TAGIHAN desc";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $biaya = new $this();
            $biaya->kd_biaya = $val['KD_TAGIHAN'];
            $biaya->kd_kontrak = $val['KD_KON'];
            $biaya->nama_biaya = $val['NM_TAGIHAN'];
            $biaya->biaya_per_pegawai = $val['BIAYA_PER_PEG_TAGIHAN'];
            $biaya->jml_pegawai_bayar = $val['JML_PEG_BAYAR_TAGIHAN'];
            $biaya->jadwal_bayar = date('d-m-Y', strtotime($val['JADWAL_BAYAR_TAGIHAN'])); //$val['TGL_KON']; 
            $biaya->jumlah_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast = date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap = date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_ring_kontrak_TAGIHAN'];
            $biaya->tgl_ring_kontrak = date('d-m-Y', strtotime($val['TGL_ring_kontrak_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_ring_kontrak_TAGIHAN'];
            $biaya->no_kuitansi = $val['NO_KUITANSI_TAGIHAN'];
            $biaya->file_kuitansi = $val['FILE_KUITANSI_TAGIHAN'];
            $biaya->tgl_kuitansi = date('d-m-Y', strtotime($val['TGL_KUITANSI_TAGIHAN']));
            $biaya->no_sp2d = $val['NO_SP2D_TAGIHAN'];
            $biaya->file_sp2d = $val['FILE_SP2D_TAGIHAN'];
            $biaya->tgl_sp2d = date('d-m-Y', strtotime($val['TGL_SP2D_TAGIHAN']));
            $biaya->status_bayar = $val['STS_TAGIHAN'];
            $data[] = $biaya;
        }
        //var_dump($data);
        return $data;
    }

    public function get_by_id($id) {
        $table = "d_tagihan";
        $where = "kd_biaya='" . $id . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        $biaya = false;
        foreach ($result as $val) {
            $biaya = new $this();
            $biaya->kd_biaya = $val['KD_TAGIHAN'];
            $biaya->kd_kontrak = $val['KD_KON'];
            $biaya->nama_biaya = $val['NM_TAGIHAN'];
            $biaya->biaya_per_pegawai = $val['BIAYA_PER_PEG_TAGIHAN'];
            $biaya->jml_pegawai_bayar = $val['JML_PEG_BAYAR_TAGIHAN'];
            $biaya->jadwal_bayar = date('d-m-Y', strtotime($val['JADWAL_BAYAR_TAGIHAN'])); //$val['TGL_KON']; 
            $biaya->jumlah_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast = date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap = date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_ring_kontrak_TAGIHAN'];
            $biaya->tgl_ring_kontrak = date('d-m-Y', strtotime($val['TGL_ring_kontrak_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_ring_kontrak_TAGIHAN'];
            $biaya->no_kuitansi = $val['NO_KUITANSI_TAGIHAN'];
            $biaya->file_kuitansi = $val['FILE_KUITANSI_TAGIHAN'];
            $biaya->tgl_kuitansi = date('d-m-Y', strtotime($val['TGL_KUITANSI_TAGIHAN']));
            $biaya->no_sp2d = $val['NO_SP2D_TAGIHAN'];
            $biaya->file_sp2d = $val['FILE_SP2D_TAGIHAN'];
            $biaya->tgl_sp2d = date('d-m-Y', strtotime($val['TGL_SP2D_TAGIHAN']));
            $biaya->status_bayar = $val['STS_TAGIHAN'];
        }
        //var_dump($data);
        return $biaya;
    }

    public function add(Biaya $biaya) {
        $table = "d_tagihan";
        //var_dump($biaya);
        $data = array(
            'KD_KON' => $biaya->kd_kontrak,
            'NM_TAGIHAN' => $biaya->nama_biaya,
            'BIAYA_PER_PEG_TAGIHAN' => $biaya->biaya_per_pegawai,
            'JML_PEG_BAYAR_TAGIHAN' => $biaya->jml_pegawai_bayar,
            'JADWAL_BAYAR_TAGIHAN' => $biaya->jadwal_bayar,
            'JML_SUDAH_BAYAR_TAGIHAN' => $biaya->jumlah_biaya,
            'STS_TAGIHAN' => $biaya->status_bayar
        );
        var_dump($data);
        $this->db->insert($table, $data);
    }
    
    public function getStatusBayar(Biaya $biaya){
        $status = "Belum";
        
    }
    
    public function get_biaya_by_kontrak($id){
        $table = "d_tagihan";
        $where = "KD_KON='" . $id . "'";
        $sql = "SELECT SUM(JML_SUDAH_BAYAR_TAGIHAN) AS TOTAL_BIAYA FROM $table where $where";
        $result = $this->db->select($sql);
        $total_biaya = 0;
        foreach ($result as $val) {
            $total_biaya = $val['TOTAL_BIAYA'];
        }
        return $total_biaya;
    }

    public function isEmptyBiaya(Biaya $biaya) {
        $cek = true;
        if ($biaya->kd_kontrak != "" &&
                $biaya->nama_biaya != "" &&
                $biaya->biaya_per_pegawai != "" &&
                $biaya->jml_pegawai_bayar != "" &&
                $biaya->jadwal_bayar != "" &&
                $biaya->jumlah_biaya != "" &&
                $biaya->status_bayar != ""
        ) {
            $cek = false;
        }
        return $cek;
    }

public function get_cost_per_pb(Penerima $pb,$lunas=false){
        
        $sql = "SELECT CONCAT(c.NO_KON,',',c.TGL_KON) as KD_KONTRAK,
            a.NM_TAGIHAN AS NM_TAGIHAN,
            a.BIAYA_PER_PEG_TAGIHAN AS BIAYA_PER_PEG_TAGIHAN,
            a.NO_SP2D_TAGIHAN as NO_SP2D_TAGIHAN,
            a.TGL_SP2D_TAGIHAN as TGL_SP2D_TAGIHAN
            FROM d_tagihan a 
            LEFT JOIN t_tagihan_kontrak b ON a.KD_TAGIHAN=b.KD_TAGIHAN
            LEFT JOIN d_kontrak c ON a.KD_KON=c.KD_KON 
            WHERE b.KD_PB=".$pb->get_kd_pb();
        
        if($lunas){
            $sql .= " AND a.NO_SP2D_TAGIHAN<>NULL";
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $v){
            $bea = new $this;
            $bea->kd_kontrak = $v['KD_KONTRAK'];
            $bea->nama_tagihan = $v['NM_TAGIHAN'];
            $bea->biaya_per_pegawai = $v['BIAYA_PER_PEG_TAGIHAN'];
            $bea->no_sp2d = $v['NO_SP2D_TAGIHAN'];
            $bea->tgl_sp2d = $v['TGL_SP2D_TAGIHAN'];
            $data[] = $bea;
        }
        
        return $data;
    }

}

?>
