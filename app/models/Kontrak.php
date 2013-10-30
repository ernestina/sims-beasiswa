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
    public $file_kontrak;
    public $kontrak_lama;

    public function __construct() {
        parent::__construct();
    }

    /*
     * mendapatkan seluruh data konrak dari database dalam bentuk array
     * mengubah masing-masing array ke dalam objek kontrak
     * return array objek 
     */ //date('d-M-Y',strtotime($sm->getTgl()))

    public function get_All($user = null) {
        $table = "d_kontrak";
        if ($user != "") {
            $sql = "
                SELECT a.* 
                FROM d_kontrak a, r_jur b, r_fakul c, r_univ d
                WHERE a.KD_JUR = b.KD_JUR AND
                    b.KD_FAKUL = c.KD_FAKUL AND
                    c.KD_UNIV = d.KD_UNIV AND
                    d.KD_USER = '" . $user . "'
                ORDER BY a.KD_KON desc
                ";
        } else {
            $sql = "SELECT * FROM $table order by KD_KON desc";
        }

        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $kontrak = new $this();
            $kontrak->kd_kontrak = $val['KD_KON'];
            $kontrak->no_kontrak = $val['NO_KON'];
            $kontrak->tgl_kontrak = date('d-m-Y', strtotime($val['TGL_KON'])); //$val['TGL_KON']; 
            $kontrak->kd_jurusan = $val['KD_JUR'];
            $kontrak->thn_masuk_kontrak = $val['THN_MASUK_KON'];
            $kontrak->jml_pegawai_kontrak = $val['JML_PGW_KON'];
            $kontrak->lama_semester_kontrak = $val['LAMA_SEM_KON'];
            $kontrak->nilai_kontrak = $val['NILAI_KON'];
            $kontrak->file_kontrak = $val['FILE_KON'];
            $kontrak->kontrak_lama = $val['KONTRAK_LAMA'];
            $data[] = $kontrak;
        }
        //var_dump($data);
        return $data;
    }

    /*
     * mendapatkan seluruh data konrak dari database dalam bentuk array berdasarkan kd_univ
     * mengubah masing-masing array ke dalam objek kontrak
     * return array objek 
     */

    public function get_by_univ($kd_univ) {
        $table = "d_kontrak a, r_jur b, r_fakul c";
        $where = "a.KD_JUR=b.KD_JUR and b.KD_FAKUL=c.KD_FAKUL and c.KD_UNIV = '" . $kd_univ . "'";
        $sql = "SELECT * FROM $table where $where order by KD_KON desc";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $kontrak = new $this();
            $kontrak->kd_kontrak = $val['KD_KON'];
            $kontrak->no_kontrak = $val['NO_KON'];
            $kontrak->tgl_kontrak = date('d-m-Y', strtotime($val['TGL_KON'])); //$val['TGL_KON']; 
            $kontrak->kd_jurusan = $val['KD_JUR'];
            $kontrak->thn_masuk_kontrak = $val['THN_MASUK_KON'];
            $kontrak->jml_pegawai_kontrak = $val['JML_PGW_KON'];
            $kontrak->lama_semester_kontrak = $val['LAMA_SEM_KON'];
            $kontrak->nilai_kontrak = $val['NILAI_KON'];
            $kontrak->file_kontrak = $val['FILE_KON'];
            $kontrak->kontrak_lama = $val['KONTRAK_LAMA'];
            $data[] = $kontrak;
        }
        //var_dump($data);
        return $data;
    }

    public function get_by_nomor($key, $user) {

        $sql = "SELECT * FROM d_kontrak a 
                LEFT JOIN r_jur b ON  a.KD_JUR=b.KD_JUR
                LEFT JOIN r_fakul c ON b.KD_FAKUL=c.KD_FAKUL
                LEFT JOIN r_univ d ON c.KD_UNIV = d.KD_UNIV 
                WHERE
                a.NO_KON LIKE '" . $key . "%' 
               AND d.KD_USER ='" . $user . "'
            ";

        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $kontrak = new $this();
            $kontrak->kd_kontrak = $val['KD_KON'];
            $kontrak->no_kontrak = $val['NO_KON'];
            $kontrak->tgl_kontrak = date('d-m-Y', strtotime($val['TGL_KON'])); //$val['TGL_KON']; 
            $kontrak->kd_jurusan = $val['KD_JUR'];
            $kontrak->thn_masuk_kontrak = $val['THN_MASUK_KON'];
            $kontrak->jml_pegawai_kontrak = $val['JML_PGW_KON'];
            $kontrak->lama_semester_kontrak = $val['LAMA_SEM_KON'];
            $kontrak->nilai_kontrak = $val['NILAI_KON'];
            $kontrak->file_kontrak = $val['FILE_KON'];
            $kontrak->kontrak_lama = $val['KONTRAK_LAMA'];
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
        $table = "d_kontrak";
        $where = "KD_KON='" . $id . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        $kontrak = false;
        foreach ($result as $val) {
            $kontrak = new $this();
            $kontrak->kd_kontrak = $val['KD_KON'];
            $kontrak->no_kontrak = $val['NO_KON'];
            $kontrak->tgl_kontrak = date('d-m-Y', strtotime($val['TGL_KON'])); //$val['TGL_KON']; 
            $kontrak->kd_jurusan = $val['KD_JUR'];
            $kontrak->thn_masuk_kontrak = $val['THN_MASUK_KON'];
            $kontrak->jml_pegawai_kontrak = $val['JML_PGW_KON'];
            $kontrak->lama_semester_kontrak = $val['LAMA_SEM_KON'];
            $kontrak->nilai_kontrak = $val['NILAI_KON'];
            $kontrak->file_kontrak = $val['FILE_KON'];
            $kontrak->kontrak_lama = $val['KONTRAK_LAMA'];
        }
        //var_dump($data);
        return $kontrak;
    }

    public function get_by_jur($jur) {
        $table = "d_kontrak";
        $where = "KD_JUR='" . $jur . "'";
        $sql = "SELECT * FROM $table where $where order by KD_KON desc";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $kontrak = new $this();
            $kontrak->kd_kontrak = $val['KD_KON'];
            $kontrak->no_kontrak = $val['NO_KON'];
            $kontrak->tgl_kontrak = date('d-m-Y', strtotime($val['TGL_KON'])); //$val['TGL_KON']; 
            $kontrak->kd_jurusan = $val['KD_JUR'];
            $kontrak->thn_masuk_kontrak = $val['THN_MASUK_KON'];
            $kontrak->jml_pegawai_kontrak = $val['JML_PGW_KON'];
            $kontrak->lama_semester_kontrak = $val['LAMA_SEM_KON'];
            $kontrak->nilai_kontrak = $val['NILAI_KON'];
            $kontrak->file_kontrak = $val['FILE_KON'];
            $kontrak->kontrak_lama = $val['KONTRAK_LAMA'];
            $data[] = $kontrak;
        }
        //var_dump($data);
        return $data;
    }

    public function get_list_thn_masuk() {
        $table = "d_kontrak";
        //$where = "KD_JUR='" . $jur . "'";
        $sql = "SELECT distinct(THN_MASUK_KON) AS THN_MASUK_KON FROM $table order by THN_MASUK_KON desc";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $data[] = $val['THN_MASUK_KON'];
        }
        //var_dump($data);
        return $data;
    }

    public function get_list_thn_masuk_by_jur($jur) {
        $table = "d_kontrak";
        $where = "KD_JUR='" . $jur . "'";
        $sql = "SELECT distinct THN_MASUK_KON FROM $table 
                WHERE $where
                order by THN_MASUK_KON desc
                ";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $data[] = $val['THN_MASUK_KON'];
        }
        //var_dump($data);
        return $data;
    }

    /*
     * menambahkan data strata ke dalam database
     * param objek strata diubah ke bentuk array
     * return void 
     */

    public function add(Kontrak $kontrak) {
        $table = "d_kontrak";
        //var_dump($kontrak);
        $data = array(
            'NO_KON' => $kontrak->no_kontrak,
            'TGL_KON' => $kontrak->tgl_kontrak,
            'KD_JUR' => $kontrak->kd_jurusan,
            'THN_MASUK_KON' => $kontrak->thn_masuk_kontrak,
            'JML_PGW_KON' => $kontrak->jml_pegawai_kontrak,
            'LAMA_SEM_KON' => $kontrak->lama_semester_kontrak,
            'NILAI_KON' => $kontrak->nilai_kontrak,
            'FILE_KON' => $kontrak->file_kontrak,
            'KONTRAK_LAMA' => $kontrak->kontrak_lama
        );
        //var_dump($data);
        $this->db->insert($table, $data);
    }

    /*
     * menghapus data kontrak dari database
     * param id = kd_kontrak
     * return void 
     */

    public function delete($id) {
        $table = "d_kontrak";
        $where = 'KD_KON=' . $id;
        //echo $id;
        $this->db->delete($table, $where);
    }

    /*
     * mengupdate data strata
     * param objek strata
     * return void 
     */

    public function update(kontrak $kontrak) {
        $table = "d_kontrak";
        $data = array(
            'NO_KON' => $kontrak->no_kontrak,
            'TGL_KON' => $kontrak->tgl_kontrak,
            'KD_JUR' => $kontrak->kd_jurusan,
            'THN_MASUK_KON' => $kontrak->thn_masuk_kontrak,
            'JML_PGW_KON' => $kontrak->jml_pegawai_kontrak,
            'LAMA_SEM_KON' => $kontrak->lama_semester_kontrak,
            'NILAI_KON' => $kontrak->nilai_kontrak,
            'FILE_KON' => $kontrak->file_kontrak,
            'KONTRAK_LAMA' => $kontrak->kontrak_lama
        );
        $where = "KD_KON='" . $kontrak->kd_kontrak . "'";
        $this->db->update($table, $data, $where);
    }

    /*
     * mengecek apakah nilai objek terisi/tidak kosong
     * param objek strata
     * return boolean
     */

    public function isEmpty(Kontrak $kontrak) {
        $cek = true;
        if ($kontrak->no_kontrak != "" &&
                $kontrak->tgl_kontrak != "" &&
                $kontrak->kd_jurusan != "" &&
                $kontrak->thn_masuk_kontrak != "" &&
                $kontrak->jml_pegawai_kontrak != "" &&
                $kontrak->lama_semester_kontrak != "" &&
                $kontrak->file_kontrak !== ""
        ) {
            $cek = false;
        }
        return $cek;
    }

}

?>
