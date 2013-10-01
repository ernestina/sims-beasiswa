<?php

class Biaya extends BaseModel{

    public $kd_tagihan;
    public $kd_kontrak;
    public $nama_tagihan;
    public $biaya_per_pegawai;
    public $jmlh_pegawai_bayar;
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

    public function __construct() {
        parent::__construct();
    }

    public function get_All() {
        $table = "d_tagihan";
        $sql = "SELECT * FROM $table order by KD_TAGIHAN desc";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $biaya= new $this();
            $biaya->kd_tagihan = $val['KD_TAGIHAN'];
            $biaya->kd_biaya = $val['KD_biaya'];
            $biaya->nama_tagihan = $val['NM_TAGIHAN'];
            $biaya->biaya_per_pegawai = $val['BIAYA_PER_PEG_TAGIHAN'];
            $biaya->jmlh_pegawai_bayar = $val['JML_PEG_BAYAR_TAGIHAN'];
            $biaya->tgl_biaya = date('d-m-Y', strtotime($val['JADWAL_BAYAR_TAGIHAN'])); //$val['TGL_KON']; 
            $biaya->jumlah_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast =  date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap =  date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_RING_biaya_TAGIHAN'];
            $biaya->tgl_ring_kontrak =  date('d-m-Y', strtotime($val['TGL_RING_biaya_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_RING_biaya_TAGIHAN'];
            $biaya->no_kuitansi = $val['NO_KUITANSI_TAGIHAN'];
            $biaya->file_kuitansi = $val['FILE_KUITANSI_TAGIHAN'];
            $biaya->tgl_kuitansi =  date('d-m-Y', strtotime($val['TGL_KUITANSI_TAGIHAN']));
            $biaya->no_sp2d = $val['NO_SP2D_TAGIHAN'];
            $biaya->file_sp2d = $val['FILE_SP2D_TAGIHAN'];
            $biaya->tgl_sp2d =  date('d-m-Y', strtotime($val['TGL_SP2D_TAGIHAN']));
            $data[] = $biaya;
        }
        //var_dump($data);
        return $data;
    }
    
    public function get_by_kontrak($id) {
        $table = "d_tagihan";
        $where = "KD_KONTRAK='" . $id . "'";
        $sql = "SELECT * FROM $table where $where order by KD_TAGIHAN desc";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $biaya= new $this();
            $biaya->kd_tagihan = $val['KD_TAGIHAN'];
            $biaya->kd_biaya = $val['KD_biaya'];
            $biaya->nama_tagihan = $val['NM_TAGIHAN'];
            $biaya->biaya_per_pegawai = $val['BIAYA_PER_PEG_TAGIHAN'];
            $biaya->jmlh_pegawai_bayar = $val['JML_PEG_BAYAR_TAGIHAN'];
            $biaya->tgl_biaya = date('d-m-Y', strtotime($val['JADWAL_BAYAR_TAGIHAN'])); //$val['TGL_KON']; 
            $biaya->jumlah_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast =  date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap =  date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_RING_biaya_TAGIHAN'];
            $biaya->tgl_ring_kontrak =  date('d-m-Y', strtotime($val['TGL_RING_biaya_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_RING_biaya_TAGIHAN'];
            $biaya->no_kuitansi = $val['NO_KUITANSI_TAGIHAN'];
            $biaya->file_kuitansi = $val['FILE_KUITANSI_TAGIHAN'];
            $biaya->tgl_kuitansi =  date('d-m-Y', strtotime($val['TGL_KUITANSI_TAGIHAN']));
            $biaya->no_sp2d = $val['NO_SP2D_TAGIHAN'];
            $biaya->file_sp2d = $val['FILE_SP2D_TAGIHAN'];
            $biaya->tgl_sp2d =  date('d-m-Y', strtotime($val['TGL_SP2D_TAGIHAN']));
            $data[] = $biaya;
        }
        //var_dump($data);
        return $data;
    }
    
    
    public function get_by_id($id) {
        $table = "d_tagihan";
        $where = "KD_TAGIHAN='" . $id . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        $biaya = false;
        foreach ($result as $val) {
            $biaya= new $this();
            $biaya->kd_tagihan = $val['KD_TAGIHAN'];
            $biaya->kd_biaya = $val['KD_biaya'];
            $biaya->nama_tagihan = $val['NM_TAGIHAN'];
            $biaya->biaya_per_pegawai = $val['BIAYA_PER_PEG_TAGIHAN'];
            $biaya->jmlh_pegawai_bayar = $val['JML_PEG_BAYAR_TAGIHAN'];
            $biaya->tgl_biaya = date('d-m-Y', strtotime($val['JADWAL_BAYAR_TAGIHAN'])); //$val['TGL_KON']; 
            $biaya->jumlah_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast =  date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap =  date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_RING_biaya_TAGIHAN'];
            $biaya->tgl_ring_kontrak =  date('d-m-Y', strtotime($val['TGL_RING_biaya_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_RING_biaya_TAGIHAN'];
            $biaya->no_kuitansi = $val['NO_KUITANSI_TAGIHAN'];
            $biaya->file_kuitansi = $val['FILE_KUITANSI_TAGIHAN'];
            $biaya->tgl_kuitansi =  date('d-m-Y', strtotime($val['TGL_KUITANSI_TAGIHAN']));
            $biaya->no_sp2d = $val['NO_SP2D_TAGIHAN'];
            $biaya->file_sp2d = $val['FILE_SP2D_TAGIHAN'];
            $biaya->tgl_sp2d =  date('d-m-Y', strtotime($val['TGL_SP2D_TAGIHAN']));
        }
        //var_dump($data);
        return $biaya;
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
