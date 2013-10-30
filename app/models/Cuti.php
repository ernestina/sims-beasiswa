<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Cuti{
    public $registry;
    private $_db;
    private $t_cuti = 'd_cuti';
    private $_kd_cuti;
    private $_jsc;
    private $_pb;
    private $_no_sc;
    private $_tgl_sc;
    private $_periode_mul; //periode mulai cuti/semester
    private $_periode_sel;
    private $_perk_go; //perkiraan bulan dihentikan pembayaran elemen beasiswa
    private $_perk_stop; //perkiraan bulan dimulai pembayaran elemen beasiswa
    private $_file;
    
    public function __construct($registry = Registry){
        $this->registry = $registry;
        $this->_db = $registry->db;
    }
    
    public function get_cuti($kd_user=1,Penerima $pb=null){
        $sql = "SELECT a.KD_CUTI as KD_CUTI,a.KD_PB as KD_PB,";
        if(!is_null($pb)){
            $sql .= " b.NM_PB as KD_PB,";
        }else{
            $sql .= "a.KD_PB as KD_PB,";
        }
        
        $sql .= "
            c.NM_JNS_SRT_CUTI as KD_JNS_SRT_CUTI,
            a.NO_CUTI as NO_CUTI,
            a.TGL_CUTI as TGL_CUTI,
            a.PRD_MUL_CUTI as PRD_MUL_CUTI,
            a.PRD_SEL_CUTI as PRD_SEL_CUTI,
            a.PERK_STOP as PERK_STOP,
            a.PERK_GO as PERK_GO,
            a.FILE_CUTI as FILE_CUTI
            FROM ".$this->t_cuti." a ";
        
//        if(!is_null($pb)){
            $sql .= " LEFT JOIN d_pb b ON a.KD_PB=b.KD_PB";
//        }    
                
            $sql .= " LEFT JOIN r_jsc c ON a.KD_JNS_SRT_CUTI=c.KD_JNS_SRT_CUTI";
            $sql .= " LEFT JOIN r_jur d ON b.KD_JUR=d.KD_JUR
                    LEFT JOIN r_fakul e ON d.KD_FAKUL=e.KD_FAKUL
                    LEFT JOIN r_univ f ON e.KD_UNIV=f.KD_UNIV ";
        if(!is_null($pb)){
            $sql .= " WHERE a.KD_PB=".$pb->get_kd_pb()." AND f.KD_USER=".$kd_user;
        }else{
            $sql .= " WHERE  f.KD_USER=".$kd_user;
        }
//        echo $sql;
        $result = $this->_db->select($sql);
        $data = array();
        foreach ($result as $v){
            $cuti = new $this($this->registry);
            $cuti->set_kode_cuti($v['KD_CUTI']);
            $cuti->set_jenis_cuti($v['KD_JNS_SRT_CUTI']);
            $pb = new Penerima($this->registry);
            $pb->set_kd_pb($v['KD_PB']);
            $d_pb = $pb->get_penerima_by_id($pb,$kd_user);
            $jur = new Jurusan($this->registry);
            $jur->set_kode_jur($d_pb->get_jur());
            $d_jur = $jur->get_jur_by_id($jur);
            $cuti->set_pb($d_pb->get_nama()."-".$d_pb->get_nip()."-".$d_jur->get_nama());
            $cuti->set_no_surat_cuti($v['NO_CUTI']);
            $cuti->set_tgl_surat_cuti($v['TGL_CUTI']);
            $cuti->set_prd_mulai($v['PRD_MUL_CUTI']);
            $cuti->set_prd_selesai($v['PRD_SEL_CUTI']);
            $cuti->set_perk_stop($v['PERK_STOP']);
            $cuti->set_perk_go($v['PERK_GO']);
            $cuti->set_file($v['FILE_CUTI']);
            unset($pb);
            unset($jur);
            $data[] = $cuti;
        }
        return $data;
    }
    
    public function get_cuti_by_id(Cuti $ct,$kd_user){
        $sql = "SELECT * FROM ".$this->t_cuti;
        $sql .= " a LEFT JOIN d_pb b ON a.KD_PB=b.KD_PB";
        $sql .= " LEFT JOIN r_jur c ON b.KD_JUR=c.KD_JUR
                LEFT JOIN r_fakul d ON c.KD_FAKUL=d.KD_FAKUL
                LEFT JOIN r_univ e ON d.KD_UNIV=e.KD_UNIV ";
        $sql .= " WHERE a.KD_CUTI=".$ct->get_kode_cuti();
        $sql .= " AND e.KD_USER=".$kd_user;
        $result = $this->_db->select($sql);
        foreach ($result as $v){
            $this->set_kode_cuti($v['KD_CUTI']);
            $this->set_jenis_cuti($v['KD_JNS_SRT_CUTI']);
            $this->set_no_surat_cuti($v['NO_CUTI']);
            $this->set_tgl_surat_cuti($v['TGL_CUTI']);
            $this->set_pb($v['KD_PB']);
            $this->set_prd_mulai($v['PRD_MUL_CUTI']);
            $this->set_prd_selesai($v['PRD_SEL_CUTI']);
            $this->set_perk_stop($v['PERK_STOP']);
            $this->set_perk_go($v['PERK_GO']);
            $this->set_file($v['FILE_CUTI']);
        }
        return $this;
    }
    
    public function get_cuti_by_univ_thn_masuk($univ,$thn,$kd_user=1){
        $sql = "SELECT a.KD_CUTI as KD_CUTI,
                a.KD_JNS_SRT_CUTI as KD_JNS_SRT_CUTI,
                a.KD_PB as KD_PB,
                a.NO_CUTI as NO_CUTI,
                a.TGL_CUTI AS TGL_CUTI,
                a.PRD_MUL_CUTI as PRD_MUL_CUTI,
                a.PRD_SEL_CUTI as PRD_SEL_CUTI,
                a.PERK_STOP as PERK_STOP,
                a.PERK_GO as PERK_GO,
                a.FILE_CUTI as FILE_CUTI
                FROM ".$this->t_cuti." a ";
               if($univ==0 && $thn!=0){
                    $sql .= " LEFT JOIN d_pb b ON a.KD_PB=b.KD_PB
                            LEFT JOIN d_srt_tugas c ON b.KD_ST=c.KD_ST
                            LEFT JOIN r_jur d ON b.KD_JUR=d.KD_JUR
                            LEFT JOIN r_fakul e ON d.KD_FAKUL=e.KD_FAKUL
                            LEFT JOIN r_univ f ON e.KD_UNIV=f.KD_UNIV
                            WHERE c.THN_MASUK=".$thn;
               }else if($univ!=0 && $thn==0){
                    $sql .= " LEFT JOIN d_pb b ON a.KD_PB=b.KD_PB
                            LEFT JOIN r_jur d ON b.KD_JUR=d.KD_JUR
                            LEFT JOIN r_fakul e ON d.KD_FAKUL=e.KD_FAKUL
                            LEFT JOIN r_univ f ON e.KD_UNIV=f.KD_UNIV
                            WHERE f.KD_UNIV=".$univ;
               }else{
                    $sql .= " LEFT JOIN d_pb b ON a.KD_PB=b.KD_PB
                            LEFT JOIN d_srt_tugas c ON b.KD_ST=c.KD_ST
                            LEFT JOIN r_jur d ON b.KD_JUR=d.KD_JUR
                            LEFT JOIN r_fakul e ON d.KD_FAKUL=e.KD_FAKUL
                            LEFT JOIN r_univ f ON e.KD_UNIV=f.KD_UNIV
                            WHERE f.KD_UNIV=".$univ." AND c.THN_MASUK=".$thn;
               }
               $sql .= " AND f.KD_USER=".$kd_user;
//               echo $sql;
        $result = $this->_db->select($sql);
        $data = array();
        foreach ($result as $v){
            $cuti = new $this($this->registry);
            $cuti->set_kode_cuti($v['KD_CUTI']);
            $cuti->set_jenis_cuti($v['KD_JNS_SRT_CUTI']);
            $pb = new Penerima($this->registry);
            $pb->set_kd_pb($v['KD_PB']);
            $d_pb = $pb->get_penerima_by_id($pb);
            $jur = new Jurusan($this->registry);
            $jur->set_kode_jur($d_pb->get_jur());
            $d_jur = $jur->get_jur_by_id($jur);
            $cuti->set_pb($d_pb->get_nama()."-".$d_pb->get_nip()."-".$d_jur->get_nama());
            $cuti->set_no_surat_cuti($v['NO_CUTI']);
            $cuti->set_tgl_surat_cuti($v['TGL_CUTI']);
            $cuti->set_prd_mulai($v['PRD_MUL_CUTI']);
            $cuti->set_prd_selesai($v['PRD_SEL_CUTI']);
            $cuti->set_perk_stop($v['PERK_STOP']);
            $cuti->set_perk_go($v['PERK_GO']);
            unset($pb);
            unset($jur);
            $data[] = $cuti;
        }
        return $data;
    }
    
    public function get_cuti_by_pb_name($name,$kd_user){
        $sql = "SELECT a.KD_CUTI as KD_CUTI,
                a.KD_JNS_SRT_CUTI as KD_JNS_SRT_CUTI,
                a.KD_PB as KD_PB,
                a.NO_CUTI as NO_CUTI,
                a.TGL_CUTI AS TGL_CUTI,
                a.PRD_MUL_CUTI as PRD_MUL_CUTI,
                a.PRD_SEL_CUTI as PRD_SEL_CUTI,
                a.PERK_STOP as PERK_STOP,
                a.PERK_GO as PERK_GO,
                a.FILE_CUTI as FILE_CUTI
                FROM ".$this->t_cuti." a 
                LEFT JOIN d_pb b ON a.KD_PB=b.KD_PB
                LEFT JOIN r_jur c ON b.KD_JUR=c.KD_JUR
                LEFT JOIN r_fakul d ON c.KD_FAKUL=d.KD_FAKUL
                LEFT JOIN r_univ e ON d.KD_UNIV=e.KD_UNIV
                WHERE b.NM_PB LIKE '%".$name."%' AND e.KD_USER=".$kd_user;
        $result = $this->_db->select($sql);
        $data = array();
        foreach ($result as $v){
            $cuti = new $this($this->registry);
            $cuti->set_kode_cuti($v['KD_CUTI']);
            $jsc = new JenisSuratCuti($this->registry);
            $jsc->set_kode($v['KD_JNS_SRT_CUTI']);
            $d_jsc = $jsc->get_jsc_by_id($jsc);
            $cuti->set_jenis_cuti($d_jsc->get_nama());
            $pb = new Penerima($this->registry);
            $pb->set_kd_pb($v['KD_PB']);
            $d_pb = $pb->get_penerima_by_id($pb,$kd_user);
            $jur = new Jurusan($this->registry);
            $jur->set_kode_jur($d_pb->get_jur());
            $d_jur = $jur->get_jur_by_id($jur);
            $cuti->set_pb($d_pb->get_nama()."-".$d_pb->get_nip()."-".$d_jur->get_nama());
            $cuti->set_no_surat_cuti($v['NO_CUTI']);
            $cuti->set_tgl_surat_cuti($v['TGL_CUTI']);
            $cuti->set_prd_mulai($v['PRD_MUL_CUTI']);
            $cuti->set_prd_selesai($v['PRD_SEL_CUTI']);
            $cuti->set_perk_stop($v['PERK_STOP']);
            $cuti->set_perk_go($v['PERK_GO']);
            unset($pb);
            unset($jur);
            $data[] = $cuti;
        }
        return $data;
    }

    public function add_cuti(){
        $data = array(
            'KD_JNS_SRT_CUTI'=>$this->get_jenis_cuti(),
            'KD_PB'=>$this->get_pb(),
            'NO_CUTI'=>$this->get_no_surat_cuti(),
            'TGL_CUTI'=>$this->get_tgl_surat_cuti(),
            'PRD_MUL_CUTI'=>$this->get_prd_mulai(),
            'PRD_SEL_CUTI'=>$this->get_prd_selesai(),
            'PERK_STOP'=>$this->get_perk_stop(),
            'PERK_GO'=>$this->get_perk_go(),
            'FILE_CUTI'=>$this->get_file()
        );
        
        return $this->_db->insert($this->t_cuti,$data);
    }
    
    public function update_cuti(){
        $where = " KD_CUTI=".$this->get_kode_cuti();
        $data = array(
            'KD_JNS_SRT_CUTI'=>$this->get_jenis_cuti(),
            'KD_PB'=>$this->get_pb(),
            'NO_CUTI'=>$this->get_no_surat_cuti(),
            'TGL_CUTI'=>$this->get_tgl_surat_cuti(),
            'PRD_MUL_CUTI'=>$this->get_prd_mulai(),
            'PRD_SEL_CUTI'=>$this->get_prd_selesai(),
            'PERK_STOP'=>$this->get_perk_stop(),
            'PERK_GO'=>$this->get_perk_go(),
            'FILE_CUTI'=>$this->get_file()
        );
        
        return $this->_db->update($this->t_cuti,$data,$where);
    }


    public function del_ct(){
        $where = " KD_CUTI=".$this->get_kode_cuti();
        return $this->_db->delete($this->t_cuti,$where);
    }
    
    /*
     * cek apakah nomor st pernah direkam
     */
    public function cek_exist_nomor($nomor){
        $sql = "SELECT NO_CUTI FROM ".$this->t_cuti;
        $data = $this->_db->select($sql);
        foreach ($data as $v){
            $tmp = Validasi::remove_space($v['NO_CUTI']);
            $cek = $nomor==$tmp;
            if($cek) return true;
        }
        return false;
    }

    /*
     * setter
     */
    public function set_kode_cuti($kd_cuti){
        $this->_kd_cuti = $kd_cuti;
    }
    public function set_jenis_cuti($jns_cuti){
        $this->_jsc = $jns_cuti;
    }
    public function set_pb($pb){
        $this->_pb = $pb;
    }
    public function set_no_surat_cuti($no_sc){
        $this->_no_sc = $no_sc;
    }
    public function set_tgl_surat_cuti($tgl_sc){
        $this->_tgl_sc = $tgl_sc;
    }
    public function set_prd_mulai($prd_mul){
        $this->_periode_mul = $prd_mul;
    }
    public function set_prd_selesai($prd_sel){
        $this->_periode_sel = $prd_sel;
    }
    public function set_perk_stop($perk_stop){
        $this->_perk_stop = $perk_stop;
    }
    public function set_perk_go($perk_go){
        $this->_perk_go = $perk_go;
    }
    public function set_file($file){
        $this->_file=$file;
    }
    
    /*
     * getter
     */
    public function get_kode_cuti(){
        return $this->_kd_cuti;
    }
    public function get_jenis_cuti(){
        return $this->_jsc;
    }
    public function get_pb(){
        return $this->_pb;
    }
    public function get_no_surat_cuti(){
        return $this->_no_sc;
    }
    public function get_tgl_surat_cuti(){
        return $this->_tgl_sc;
    }
    public function get_prd_mulai(){
        return $this->_periode_mul;
    }
    public function get_prd_selesai(){
        return $this->_periode_sel;
    }
    public function get_perk_stop(){
        return $this->_perk_stop;
    }
    public function get_perk_go(){
        return $this->_perk_go;
    }
    public function get_file(){
        return $this->_file;
    }
    
    public function __destruct() {
        ;
    }
}
?>
