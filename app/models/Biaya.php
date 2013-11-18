<?php

class Biaya extends BaseModel {

    public $kd_biaya;
    public $kd_kontrak;
    public $nama_biaya;
    public $biaya_per_pegawai;
    public $jml_pegawai_bayar;
    public $jml_biaya;
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

    //GET all data biaya
    // return object biaya
    public function get_All() {
        $table = "d_tagihan";
        $sql = "SELECT * FROM $table order by JADWAL_BAYAR_TAGIHAN asc";
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
            $biaya->jml_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast = date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap = date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_RING_KONTRAK_TAGIHAN'];
            $biaya->tgl_ring_kontrak = date('d-m-Y', strtotime($val['TGL_RING_KONTRAK_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_RING_KONTRAK_TAGIHAN'];
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

    //GET data biaya berdasarkan universitas
    // return object biaya
    public function get_by_univ($kd_univ) {
        //$table = "d_tagihan";
        $sql = "SELECT * FROM d_tagihan a, d_kontrak b, r_jur c, r_fakul d, r_univ e";
        $sql .= " WHERE a.KD_KON = b.KD_KON AND b.KD_JUR = c.KD_JUR AND c.KD_FAKUL = d.KD_FAKUL";
        $sql .= " AND d.KD_UNIV = e.KD_UNIV AND e.KD_UNIV='" . $kd_univ . "' order by JADWAL_BAYAR_TAGIHAN asc";
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
            $biaya->jml_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast = date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap = date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_RING_KONTRAK_TAGIHAN'];
            $biaya->tgl_ring_kontrak = date('d-m-Y', strtotime($val['TGL_RING_KONTRAK_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_RING_KONTRAK_TAGIHAN'];
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

    //GET data biaya berdasarkan status
    // return object biaya
    public function get_by_status($status) {
        $table = "d_tagihan";
        $where = "STS_TAGIHAN='" . $status . "'";
        $sql = "SELECT * FROM $table where $where order by JADWAL_BAYAR_TAGIHAN asc";
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
            $biaya->jml_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast = date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap = date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_RING_KONTRAK_TAGIHAN'];
            $biaya->tgl_ring_kontrak = date('d-m-Y', strtotime($val['TGL_RING_KONTRAK_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_RING_KONTRAK_TAGIHAN'];
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

    //GET data biaya berdasarkan tahun jadwal
    // return object biaya
    public function get_by_jadwal($jadwal) {
        $table = "d_tagihan";
        $where = "YEAR(JADWAL_BAYAR_TAGIHAN)='" . $jadwal . "'";
        $sql = "SELECT * FROM $table where $where order by JADWAL_BAYAR_TAGIHAN asc";
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
            $biaya->jml_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast = date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap = date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_RING_KONTRAK_TAGIHAN'];
            $biaya->tgl_ring_kontrak = date('d-m-Y', strtotime($val['TGL_RING_KONTRAK_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_RING_KONTRAK_TAGIHAN'];
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

    //GET data biaya berdasarkan universitas dan stats
    // return object biaya
    public function get_by_univ_status($kd_univ, $status) {
        //$table = "d_tagihan";
        $sql = "SELECT * FROM d_tagihan a, d_kontrak b, r_jur c, r_fakul d, r_univ e";
        $sql .= " WHERE a.KD_KON = b.KD_KON AND b.KD_JUR = c.KD_JUR AND c.KD_FAKUL = d.KD_FAKUL AND d.KD_UNIV = e.KD_UNIV";
        $sql .= " AND e.KD_UNIV='" . $kd_univ . "' AND STS_TAGIHAN ='" . $status . "' order by JADWAL_BAYAR_TAGIHAN asc";
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
            $biaya->jml_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast = date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap = date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_RING_KONTRAK_TAGIHAN'];
            $biaya->tgl_ring_kontrak = date('d-m-Y', strtotime($val['TGL_RING_KONTRAK_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_RING_KONTRAK_TAGIHAN'];
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

    //GET data biaya berdasarkan universitas, status, jadwal pembayaran
    // return object biaya
    public function get_by_filter($kd_univ = null, $status = null, $jadwal = null, $user=null) {
        $sql = "
            SELECT a.* 
            FROM d_tagihan a LEFT JOIN d_kontrak b ON a.KD_KON = b.KD_KON
            LEFT JOIN r_jur c ON b.KD_JUR = c.KD_JUR
            LEFT JOIN r_fakul d ON c.KD_FAKUL = d.KD_FAKUL
            LEFT JOIN r_univ e ON d.KD_UNIV = e.KD_UNIV
            ";
		
		if ($user != "") {
            $sql .= " WHERE e.KD_USER='" . $user . "'";
        }
		
        if ($kd_univ != "") {
			if($user != ""){
				$sql .= " AND e.KD_UNIV='" . $kd_univ . "'";
			} else {
				$sql .= " WHERE e.KD_UNIV='" . $kd_univ . "'";
			}
        }

        if ($status != "") { 
			if($user != "" || $kd_univ != ""){
				$sql .= " AND a.STS_TAGIHAN='" . $status . "'";
			} else {
				$sql .= " WHERE a.STS_TAGIHAN='" . $status . "'";
			}
                        }

        if ($jadwal != "") { 
			if($user != "" || $kd_univ != "" || $status != ""){
				$sql .= " AND YEAR(a.JADWAL_BAYAR_TAGIHAN)='" . $jadwal . "'";
			} else {
				$sql .= " WHERE YEAR(a.JADWAL_BAYAR_TAGIHAN)='" . $jadwal . "'";
			}
                 
        }

        $sql .= " ORDER BY a.JADWAL_BAYAR_TAGIHAN asc";

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
            $biaya->jml_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast = date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap = date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_RING_KONTRAK_TAGIHAN'];
            $biaya->tgl_ring_kontrak = date('d-m-Y', strtotime($val['TGL_RING_KONTRAK_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_RING_KONTRAK_TAGIHAN'];
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
            $biaya->jml_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast = date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap = date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_RING_KONTRAK_TAGIHAN'];
            $biaya->tgl_ring_kontrak = date('d-m-Y', strtotime($val['TGL_RING_KONTRAK_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_RING_KONTRAK_TAGIHAN'];
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
        $where = "KD_TAGIHAN='" . $id . "'";
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
            $biaya->jml_biaya = $val['JML_SUDAH_BAYAR_TAGIHAN'];
            $biaya->no_bast = $val['NO_BAST_TAGIHAN'];
            $biaya->tgl_bast = date('d-m-Y', strtotime($val['TGL_BAST_TAGIHAN']));
            $biaya->file_bast = $val['FILE_BAST_TAGIHAN'];
            $biaya->no_bap = $val['NO_BAP_TAGIHAN'];
            $biaya->tgl_bap = date('d-m-Y', strtotime($val['TGL_BAP_TAGIHAN']));
            $biaya->file_bap = $val['FILE_BAP_TAGIHAN'];
            $biaya->no_ring_kontrak = $val['NO_RING_KONTRAK_TAGIHAN'];
            $biaya->tgl_ring_kontrak = date('d-m-Y', strtotime($val['TGL_RING_KONTRAK_TAGIHAN']));
            $biaya->file_ring_kontrak = $val['FILE_RING_KONTRAK_TAGIHAN'];
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

    //menambahkan data biaya
    public function addBiaya(Biaya $biaya) {
        $table = "d_tagihan";
        //var_dump($biaya);
        $data = array(
            'KD_KON' => $biaya->kd_kontrak,
            'NM_TAGIHAN' => $biaya->nama_biaya,
            'BIAYA_PER_PEG_TAGIHAN' => $biaya->biaya_per_pegawai,
            'JML_PEG_BAYAR_TAGIHAN' => $biaya->jml_pegawai_bayar,
            'JADWAL_BAYAR_TAGIHAN' => $biaya->jadwal_bayar,
            'JML_SUDAH_BAYAR_TAGIHAN' => $biaya->jml_biaya,
            'STS_TAGIHAN' => $biaya->status_bayar
        );
        //var_dump($data);
        $this->db->insert($table, $data);
    }

    //mengupdate data biaya
    public function updateBiaya(Biaya $biaya) {
        $table = "d_tagihan";
        //var_dump($biaya);
        $data = array(
            'KD_KON' => $biaya->kd_kontrak,
            'NM_TAGIHAN' => $biaya->nama_biaya,
            'BIAYA_PER_PEG_TAGIHAN' => $biaya->biaya_per_pegawai,
            'JML_PEG_BAYAR_TAGIHAN' => $biaya->jml_pegawai_bayar,
            'JADWAL_BAYAR_TAGIHAN' => $biaya->jadwal_bayar,
            'JML_SUDAH_BAYAR_TAGIHAN' => $biaya->jml_biaya
                //'STS_TAGIHAN' => $biaya->status_bayar //untuk melakukan update biaya, maka status biaya tetap tidak berubah
        );
        $where = "KD_TAGIHAN='" . $biaya->kd_biaya . "'";
        $this->db->update($table, $data, $where);
    }

    //ubah status bayar
    public function updateStatusBayar(Biaya $biaya) {
        $table = "d_tagihan";
        $data = array(
            'STS_TAGIHAN' => $biaya->status_bayar
        );
        $where = "KD_TAGIHAN='" . $biaya->kd_biaya . "'";
        $this->db->update($table, $data, $where);
    }

    //mengupdate data tagihan
    public function updateTagihan(Biaya $biaya) {
        $table = "d_tagihan";
        //var_dump($biaya);
        $data = array(
            'NO_BAST_TAGIHAN' => $biaya->no_bast,
            'TGL_BAST_TAGIHAN' => $biaya->tgl_bast,
            'FILE_BAST_TAGIHAN' => $biaya->file_bast,
            'NO_BAP_TAGIHAN' => $biaya->no_bap,
            'TGL_BAP_TAGIHAN' => $biaya->tgl_bap,
            'FILE_BAP_TAGIHAN' => $biaya->file_bap,
            'NO_RING_KONTRAK_TAGIHAN' => $biaya->no_ring_kontrak,
            'TGL_RING_KONTRAK_TAGIHAN' => $biaya->tgl_ring_kontrak,
            'FILE_RING_KONTRAK_TAGIHAN' => $biaya->file_ring_kontrak,
            'NO_KUITANSI_TAGIHAN' => $biaya->no_kuitansi,
            'FILE_KUITANSI_TAGIHAN' => $biaya->file_kuitansi,
            'TGL_KUITANSI_TAGIHAN' => $biaya->tgl_kuitansi
        );
        $where = "KD_TAGIHAN='" . $biaya->kd_biaya . "'";
        $this->db->update($table, $data, $where);
        if ($biaya->status_bayar == "belum") {
            $biaya->status_bayar = "proses";  //mengubah status bayar dari belum menjadi proses
            $this->updateStatusBayar($biaya);
        }
    }

    //mengupdate data pembayaran tagihan
    public function updatePembayaranTagihan(Biaya $biaya) {
        $table = "d_tagihan";
        //var_dump($biaya);
        $data = array(
            'NO_SP2D_TAGIHAN' => $biaya->no_sp2d,
            'TGL_SP2D_TAGIHAN' => $biaya->tgl_sp2d,
            'FILE_SP2D_TAGIHAN' => $biaya->file_sp2d,
        );
        $where = "KD_TAGIHAN='" . $biaya->kd_biaya . "'";
        $this->db->update($table, $data, $where);
        if ($biaya->status_bayar == "proses") {
            $biaya->status_bayar = "selesai";  //mengubah status bayar dari proses menjadi selesai
            $this->updateStatusBayar($biaya);
        }
    }

    //menghapus data biaya
    public function deleteBiaya($id) {
        $table = "d_tagihan";
        $where = 'KD_TAGIHAN=' . $id;
        //echo $id;
        $this->db->delete($table, $where);
    }

    public function getStatusBayar(Biaya $biaya) {
        $status = "Belum";
    }

    public function get_biaya_by_kontrak($id) {
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

    public function get_biaya_by_kontrak_dibayar($id) {
        $table = "d_tagihan";
        $where = "KD_KON='" . $id . "' AND STS_TAGIHAN='selesai'";
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
                $biaya->jml_biaya != "" &&
                $biaya->status_bayar != ""
        ) {
            $cek = false;
        }
        return $cek;
    }

    public function isEmptyTagihan(Biaya $biaya) {
        $cek = true;
        if ($biaya->kd_biaya != "" &&
                $biaya->no_bast != "" &&
                $biaya->tgl_bast != "" &&
                $biaya->file_bast != "" &&
                $biaya->no_bap != "" &&
                $biaya->tgl_bap != "" &&
                $biaya->file_bap != "" &&
                $biaya->no_ring_kontrak != "" &&
                $biaya->tgl_ring_kontrak != "" &&
                $biaya->file_ring_kontrak != "" &&
                $biaya->no_kuitansi != "" &&
                $biaya->tgl_kuitansi != "" &&
                $biaya->file_kuitansi != "" &&
                $biaya->status_bayar != ""
        ) {
            $cek = false;
        }
        return $cek;
    }

    public function isEmptyPembayaran(Biaya $biaya) {
        $cek = true;
        if ($biaya->kd_biaya != "" && $biaya->no_sp2d != "" &&
                tgl_sp2d != "" &&
                $biaya->file_sp2d != ""
        ) {
            $cek = false;
        }
        return $cek;
    }

    public function get_cost_per_pb(Penerima $pb, $lunas = false) {

        $sql = "SELECT CONCAT(c.NO_KON,',',c.TGL_KON) as KD_KONTRAK,
            a.NM_TAGIHAN AS NM_TAGIHAN,
            a.BIAYA_PER_PEG_TAGIHAN AS BIAYA_PER_PEG_TAGIHAN,
            a.NO_SP2D_TAGIHAN as NO_SP2D_TAGIHAN,
            a.TGL_SP2D_TAGIHAN as TGL_SP2D_TAGIHAN
            FROM d_tagihan a 
            LEFT JOIN t_tagihan_kontrak b ON a.KD_TAGIHAN=b.KD_TAGIHAN
            LEFT JOIN d_kontrak c ON a.KD_KON=c.KD_KON 
            WHERE b.KD_PB=" . $pb->get_kd_pb();

        if ($lunas) {
            $sql .= " AND a.NO_SP2D_TAGIHAN<>NULL";
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $v) {
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
