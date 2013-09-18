<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Kontrak extends BaseModel {

    public $kd_kontrak;
    public $no_kontrak;
    public $tgl_kontrak;
    public $kd_jurusan;
    public $thn_masuk_kontrak;
    public $jml_pegawai_kontrak;
    public $lama_semester_kontrak;
    public $nilai_kontrak;

    public function __construct() {
        parent::__construct();
    }

    /*
     * mendapatkan seluruh data konrak dari database dalam bentuk array
     * mengubah masing-masing array ke dalam objek kontrak
     * return array objek 
     */ //date('d-M-Y',strtotime($sm->getTgl()))

    public function get_All() {
        $table = "d_kontrak";
        $sql = "SELECT * FROM $table";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $kontrak = new $this();
            $kontrak->kd_kontrak = $val['KD_KON'];
            $kontrak->no_kontrak = $val['NO_KON'];
            $kontrak->tgl_kontrak = date('d-m-Y',strtotime($val['TGL_KON'])); //$val['TGL_KON']; 
            $kontrak->kd_jurusan = $val['KD_JUR'];
            $kontrak->thn_masuk_kontrak = $val['THN_MASUK_KON'];
            $kontrak->jml_pegawai_kontrak = $val['JML_PGW_KON'];
            $kontrak->lama_semester_kontrak = $val['LAMA_SEM_KON'];
            $kontrak->nilai_kontrak = $val['NILAI_KON'];
            $data[] = $kontrak;
        }
        //var_dump($data);
        return $data;
    }
    
    /*
     * mendapatkan seluruh data konrak dari database dalam bentuk array berdasarkan kd_univ
     * mengubah masing-masing array ke dalam objek kontrak
     * return array objek 
     */ //date('d-M-Y',strtotime($sm->getTgl()))

    public function get_by_univ($kd_univ) {
        $table = "d_kontrak a, r_jur b, r_fakul c";
        $where = "a.KD_JUR=b.KD_JUR and b.KD_FAKUL=c.KD_FAKUL and c.KD_UNIV = '".$kd_univ."'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $kontrak = new $this();
            $kontrak->kd_kontrak = $val['KD_KON'];
            $kontrak->no_kontrak = $val['NO_KON'];
            $kontrak->tgl_kontrak = date('d-m-Y',strtotime($val['TGL_KON'])); //$val['TGL_KON']; 
            $kontrak->kd_jurusan = $val['KD_JUR'];
            $kontrak->thn_masuk_kontrak = $val['THN_MASUK_KON'];
            $kontrak->jml_pegawai_kontrak = $val['JML_PGW_KON'];
            $kontrak->lama_semester_kontrak = $val['LAMA_SEM_KON'];
            $kontrak->nilai_kontrak = $val['NILAI_KON'];
            $data[] = $kontrak;
        }
        //var_dump($data);
        return $data;
    }

    /*
     * mendapatkan  data kontrak dari database sesuai dengan id
     * mengubah masing-masing array ke dalam objek kontrak
     * return array objek 
     */

    public function get_by_id($id) {
        $table = "r_kontrak";
        $where = "KD_KONTRAK='" . $id . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        $kontrak = false;
        foreach ($result as $val) {
            $kontrak = new $this();
            $kontrak->kd_kontrak = $val['KD_KONTRAK'];
            $kontrak->no_kontrak = $val['NO_KONTRAK'];
            $kontrak->tgl_kontrak = $val['TGL_KONTRAK'];
            $kontrak->kd_jurusan = $val['KD_JURUSAN'];
            $kontrak->thn_masuk_kontrak = $val['THN_MASUK_KONTRAK'];
            $kontrak->jml_pegawai_kontrak = $val['JML_PEGAWAI_KONTRAK'];
            $kontrak->lama_semester_kontrak = $val['LAMA_SEMESTER_KONTRAK'];
            $kontrak->nilai_kontrak = $val['NILAI_KONTRAK'];
        }
        //var_dump($data);
        return $kontrak;
    }

    /*
     * menambahkan data strata ke dalam database
     * param objek strata diubah ke bentuk array
     * return void 
     */

    public function add(Kontrak $kontrak) {
        $table = "r_kontrak";
        $data = array(
            'KD_KONTRAK' => $kontrak->kd_kontrak,
            'NO_KONTRAK' => $kontrak->no_kontrak,
            'TGL_KONTRAK' => $kontrak->tgl_kontrak,
            'KD_JURUSAN' => $kontrak->kd_jurusan,
            'THN_MASUK_KONTRAK' => $kontrak->thn_masuk_kontrak,
            'JML_PEGAWAI_KONTRAK' => $kontrak->jml_pegawai_kontrak,
            'LAMA_SEMESTER_KONTRAK' => $kontrak->lama_semester_kontrak,
            'NILAI_KONTRAK' => $kontrak->nilai_kontrak
        );
        //var_dump($data);
        $this->db->insert($table, $data);
    }

    /*
     * menghapus data strata dari database
     * param id = kd_strata
     * return void 
     */

    public function delete($id = null) {
        $table = "r_kontrak";
        $where = 'KD_KONTRAK=' . $id;
        //echo $id;
        $this->db->delete($table, $where);
    }

    /*
     * mengupdate data strata
     * param objek strata
     * return void 
     */

    public function update(kontrak $kontrak) {
        $table = "r_kontrak";
        $data = array(
            'KD_KONTRAK' => $kontrak->kd_kontrak,
            'NO_KONTRAK' => $kontrak->no_kontrak,
            'TGL_KONTRAK' => $kontrak->tgl_kontrak,
            'KD_JURUSAN' => $kontrak->kd_jurusan,
            'THN_MASUK_KONTRAK' => $kontrak->thn_masuk_kontrak,
            'JML_PEGAWAI_KONTRAK' => $kontrak->jml_pegawai_kontrak,
            'LAMA_SEMESTER_KONTRAK' => $kontrak->lama_semester_kontrak,
            'NILAI_KONTRAK' => $kontrak->nilai_kontrak
        );
        $where = "KD_KONTRAK='" . $kontrak->kd_kontrak . "'";
        $this->db->update($table, $data, $where);
    }

    /*
     * mengecek apakah nilai objek terisi/tidak kosong
     * param objek strata
     * return boolean
     */

    public function isEmpty(Kontrak $kontrak) {
        $cek = true;
        if ($kontrak->kd_kontrak != "" && 
                $kontrak->no_kontrak != "" &&
                $kontrak->tgl_kontrak != "" &&
                $kontrak->kd_jurusan != "" &&
                $kontrak->thn_masuk_kontrak != "" &&
                $kontrak->jml_pegawai_kontrak != "" &&
                $kontrak->lama_semester_kontrak != "" &&
                $kontrak->nilai_kontrak !=""
            ) {
            $cek = false;
        }
        return $cek;
    }

}

?>
