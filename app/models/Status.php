<?php

class Status extends BaseModel{
    public $kd_status;
    public $nm_status;
    
    public function __construct() {
        parent::__construct();
    }
    
    function get_by_id($id){
        $table = "r_stb";
        $where = "KD_STS_TB='" . $id . "'";
        $sql = "SELECT * FROM $table where $where";
        $result = $this->db->select($sql);
        //var_dump($result);
        $status = false;
        foreach ($result as $val) {
            $status = new Status();
            $status->kd_status = $val["KD_STS_TB"];
            $status->nm_status = $val["NM_STS_TB"];
            
        }
        //var_dump($data);
        return $status;
    }
    
    function get_status(){
        $table = "r_stb";
        $sql = "SELECT * FROM $table";
        $result = $this->db->select($sql);
        //var_dump($result);
        $data = array();
        foreach ($result as $val) {
            $status = new Status();
            $status->kd_status = $val["KD_STS_TB"];
            $status->nm_status = $val["NM_STS_TB"];
            $data[] = $status;
        }
        //var_dump($data);
        return $data;
    }
}