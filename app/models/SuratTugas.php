<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class SuratTugas {

    public $registry;
    public $db;
    private $_kd_st;
    private $_jur;
    private $_jenis_st;
    private $_st_lama;
    private $_nomor;
    private $_pemberi;
    private $_tgl_st;
    private $_tgl_mulai;
    private $_tgl_selesai;
    private $_th_masuk;
    private $_file;
    private $_tb_st = 'd_srt_tugas';

    /*
     * Konstruktor
     */
    public function __construct($registry) {
        $this->registry = $registry;
        $this->db = $registry->db;
    }

    /*
     * method untuk mndapatkan semua surat tugas
     * @param id_sutat_tugas
     */
    public function get_surat_tugas($id = null) {
        $sql = "SELECT * FROM " . $this->_tb_st;
        if (!is_null($id)) {
            $sql .= ' WHERE KD_ST<>' . $id;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $st = new $this($this->registry);
            $st->set_kd_st($val['KD_ST']);
            $jur = new Jurusan($this->registry);
            $jur->set_kode_jur($val['KD_JUR']);
            $d_jur = $jur->get_jur_by_id($jur);
            $st->set_jur($d_jur->get_nama());
            $st->set_nomor($val['NO_ST']);
            $st->set_pemberi($val['KD_PEMB']);
            $st->set_st_lama($val['KD_ST_LAMA']);
            $jst = new JenisSuratTugas($this->registry);
            $jst->set_kode($val['KD_JENIS_ST']);
            $d_jst = $jst->get_jst_by_id($jst);
            $st->set_jenis_st($d_jst->get_nama());
            $st->set_tgl_st($val['TGL_ST']);
            $st->set_tgl_mulai($val['TGL_MUL_ST']);
            $st->set_tgl_selesai($val['TGL_SEL_ST']);
            $st->set_th_masuk($val['THN_MASUK']);
            $st->set_file($val['FILE_ST']);
            unset($jur);
            unset($jst);
            $data[] = $st;
        }
        return $data;
    }

    /*
     * method untuk mndapatkan surat tugas berdasarkan id
     * @param id_sutat_tugas
     */
    public function get_surat_tugas_by_id($st = SuratTugas) {
        $sql = "SELECT * FROM " . $this->_tb_st . " WHERE KD_ST=" . $st->get_kd_st();
        $result = $this->db->select($sql);
        foreach ($result as $val) {
            $this->set_kd_st($val['KD_ST']);
            $this->set_jur($val['KD_JUR']);
            $this->set_nomor($val['NO_ST']);
            $st->set_pemberi($val['KD_PEMB']);
            $this->set_st_lama($val['KD_ST_LAMA']);
            $this->set_jenis_st($val['KD_JENIS_ST']);
            $this->set_tgl_st($val['TGL_ST']);
            $this->set_tgl_mulai($val['TGL_MUL_ST']);
            $this->set_tgl_selesai($val['TGL_SEL_ST']);
            $this->set_th_masuk($val['THN_MASUK']);
            $this->set_file($val['FILE_ST']);
        }
        return $this;
    }
    
    
    public function get_thn_masuk_by_jur($kd_jur) {
        $sql = "SELECT distinct THN_MASUK as TAHUN_MASUK  FROM " . $this->_tb_st . " WHERE KD_JUR=" . $kd_jur. " order by TAHUN_MASUK desc";
        $result = $this->db->select($sql);
        $data = array();    
        foreach ($result as $val) {
            $data[] = $val['TAHUN_MASUK'];
            
        }
        return $data;
    }

    public function get_surat_tugas_by_univ_thn_masuk($univ, $thn) {
        $sql = "SELECT 
            a.KD_ST as KD_ST,
            a.KD_JUR as KD_JUR,
            a.KD_PEMB as KD_PEMB,
            a.KD_JENIS_ST as KD_JENIS_ST,
            a.KD_ST_LAMA as KD_ST_LAMA,
            a.NO_ST as NOMOR_ST,
            a.TGL_ST as TANGGAL_ST,
            a.TGL_MUL_ST as TANGGAL_MULAI_ST,
            a.TGL_SEL_ST as TANGGAL_SELESAI_ST,
            a.THN_MASUK as TAHUN_MASUK,
            a.FILE_ST as FILE_ST
            FROM " . $this->_tb_st . " a";
        if ($univ == 0 AND $thn != 0) {
            $sql .=" WHERE a.THN_MASUK=" . $thn;
        } else if ($univ != 0 AND $thn == 0) {
            $sql .=" LEFT JOIN r_jur b ON a.KD_JUR=b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL=c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV=d.KD_UNIV
                WHERE d.KD_UNIV=" . $univ;
        } else {
            $sql .=" LEFT JOIN r_jur b ON a.KD_JUR=b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL=c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV=d.KD_UNIV
                WHERE d.KD_UNIV=" . $univ . " AND a.THN_MASUK=" . $thn;
        }
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $st = new $this($this->registry);
            $st->set_kd_st($val['KD_ST']);
            $jur = new Jurusan($this->registry);
            $jur->set_kode_jur($val['KD_JUR']);
            $d_jur = $jur->get_jur_by_id($jur);
            $st->set_jur($d_jur->get_nama());
            $st->set_nomor($val['NOMOR_ST']);
            $st->set_pemberi($val['KD_PEMB']);
            $st->set_st_lama($val['KD_ST_LAMA']);
            $jst = new JenisSuratTugas($this->registry);
            $jst->set_kode($val['KD_JENIS_ST']);
            $d_jst = $jst->get_jst_by_id($jst);
            $st->set_jenis_st($d_jst->get_nama());
            $st->set_tgl_st($val['TANGGAL_ST']);
            $st->set_tgl_mulai($val['TANGGAL_MULAI_ST']);
            $st->set_tgl_selesai($val['TANGGAL_SELESAI_ST']);
            $st->set_th_masuk($val['TAHUN_MASUK']);
            $st->set_file($val['FILE_ST']);
            unset($jur);
            unset($jst);
            $data[] = $st;
        }
        return $data;
    }

    /*
     * rekam surat tugas
     * param data array
     */

    public function add_st($data = array()) {
        if (!is_array($data))
            return false;
        $this->db->insert($this->_tb_st, $data);
    }

    /*
     * hapus surat tugas, kd st harus diset terlebih dahulu
     */

    public function del_st() {
        $where = " KD_ST=" . $this->get_kd_st();
        $this->db->delete($this->_tb_st, $where);
    }

    /*
     * ubah surat tugas, kode harus di set dahulu
     * param array data
     */

    public function update_st($data = array()) {
        if (!is_array($data))
            return false;
        $where = " KD_ST=" . $this->get_kd_st();
        return $this->db->update($this->_tb_st, $data, $where);
    }

    /*
     * mendapatkan data tahun masuk
     * param 
     */
    public function get_list_th_masuk($st=true) {
        $data = array();
        if($st){
            $sql = "SELECT DISTINCT(THN_MASUK) as THN FROM ".$this->_tb_st." ORDER BY THN DESC";
            $d_thn = $this->db->select($sql);
            foreach ($d_thn as $v){
                $data[$v['THN']] = $v['THN'];
            }
        }else{
            $this_year = (int) date('Y');
            $begin_list = $this_year - 3;
            $end_list = $this_year + 3;
            
            for ($begin_list; $begin_list <= $end_list; $begin_list++) {
                $data[$begin_list] = $begin_list;
            }
        }
        return $data;
    }

    /*
     * mendapatkan jenis surat tugas
     * param 
     */
    public function get_st_class() {
        $sql = "SELECT * FROM r_jst";
        $result = $this->db->select($sql);
        $data = array();
        foreach ($result as $val) {
            $jst = new JenisSuratTugas();
            $jst->set_kode($val['KD_JENIS_ST']);
            $jst->set_nama($val['NM_JNS_ST']);
            $jst->set_keterangan($val['KET_JNS_ST']);
            $data[] = $jst;
        }

        return $data;
    }
    
    /*
     * get parent
     */
    private function get_parent(Surattugas $st){
        $parent = $st->get_st_lama();
        if(is_null($parent) OR $parent='') return false;
        $p_st = new $this($this->registry);
        $parent = $p_st->get_surat_tugas_by_id($p_st);
        return $parent;
        
    }
    
    /*
     * setter
     */

    public function set_table($table) {
        $this->_tb_st = $table;
    }

    public function set_kd_st($kd) {
        $this->_kd_st = $kd;
    }

    public function set_jur($jur) {
        $this->_jur = $jur;
    }

    public function set_jenis_st($jns) {
        $this->_jenis_st = $jns;
    }

    public function set_st_lama($st_lama) {
        $this->_st_lama = $st_lama;
    }

    public function set_nomor($nomor) {
        $this->_nomor = $nomor;
    }
    
    public function set_pemberi($pemberi) {
        $this->_pemberi = $pemberi;
    }

    public function set_tgl_st($tgl) {
        $this->_tgl_st = $tgl;
    }

    public function set_tgl_mulai($tgl) {
        $this->_tgl_mulai = $tgl;
    }

    public function set_tgl_selesai($tgl) {
        $this->_tgl_selesai = $tgl;
    }

    public function set_th_masuk($thn) {
        $this->_th_masuk = $thn;
    }

    public function set_file($file) {
        $this->_file = $file;
    }

    /*
     * getter
     */

    public function get_kd_st() {
        return $this->_kd_st;
    }

    public function get_jur() {
        return $this->_jur;
    }

    public function get_jenis_st() {
        return $this->_jenis_st;
    }

    public function get_st_lama() {
        return $this->_st_lama;
    }

    public function get_nomor() {
        return $this->_nomor;
    }
    
    public function get_pemberi() {
        return $this->_pemberi;
    }

    public function get_tgl_st() {
        return $this->_tgl_st;
    }

    public function get_tgl_mulai() {
        return $this->_tgl_mulai;
    }

    public function get_tgl_selesai() {
        return $this->_tgl_selesai;
    }

    public function get_th_masuk() {
        return $this->_th_masuk;
    }

    public function get_file() {
        return $this->_file;
    }

}

?>
