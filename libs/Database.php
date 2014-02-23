<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Database{
    
    public $db;
    public $bind;
    protected $_fetchMode = PDO::FETCH_ASSOC;
    private $dbh;
    public static $instance = null;
	
    public function __construct($db_type=null,$db_host=null,$db_name=null,$db_user=null,$db_pass=null){
				
    }

    public static function get_instance($db_array = null){
        if(!is_null($db_array)){
            // TODO
            // 
        }
        
        if(is_null(self::$instance)){
            $class = __CLASS__;
            self::$instance = new $class; 
        }
        return self::$instance;
    }

	private function db_connect(){
		try{
			$this->dbh = new PDO(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
		} catch(Exception $e) { 
		   //header('location:error');
		   echo "Tidak dapat terhubung ke database.";
		   exit(1);
		} 
	}

	private function db_close(){
		$this->db = null;
	}
        
    public function select($sql,$array=array()){
	$this->db_connect();
        $sth = $this->dbh->prepare($sql);
        foreach ($array as $key=>$value){
            $sth->bindValue("$key", $value);
        }
        $sth->execute();
	$this->db_close();
        return $sth->fetchAll($this->_fetchMode);
    }
        
    public function update($table, $data, $where){
        $this->db_connect();
        ksort($data);
        
        $field = null;
        foreach($data as $key=>$value){
            $field .= "$key = :$key,";
        }
        
        $field =  rtrim($field,',');
        
        $wheres = null;
        if(is_array($where)){
            $wheres = implode(' AND ',$where);            
        }else{
            $wheres = $where;
        }
        
        $sql = "UPDATE $table SET $field WHERE $wheres";
        
//        echo $sql;
        $sth = $this->dbh->prepare($sql);
        
        foreach($data as $key=>$value){
            $sth->bindValue(":$key",$value);
        }
        
        $sth->execute();
        $this->db_close();
        return true;
        
        
        
    }
    
    public function insert($table, $data){
        $this->db_connect();
        ksort($data);
        
        $fieldName = implode(',',  array_keys($data));
        $fieldValue = implode(',:', array_keys($data)); 
        $fieldValue = ':'.$fieldValue;
        
        $sql = "INSERT INTO $table($fieldName) VALUES ($fieldValue)";
        
        $sth = $this->dbh->prepare($sql);
        
        foreach($data as $key=>$value){
            $sth->bindValue(":$key", $value);
        }
        
        $sth->execute();
        $this->db_close();
        return true;
    }
    
    public function delete($table, $where){
        $this->db_connect();
        $sql = "DELETE FROM $table WHERE $where";
        
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $this->db_close();
        return true;
        
    }
    
    public function countRow($table){
	$this->db_connect();
        $sql = "SELECT * FROM ".$table;
        $sth = $this->dbh->prepare($sql);
        $sth->execute();
        $return = count($sth->fetchAll($this->_fetchMode));
	$this->db_close();
        return $return;
    }
    
    public function get_column_table($table){
	$this->db_connect();
        $sql = "SHOW COLUMNS FROM ".$table;
        $data = $this->select($sql);
	$this->db_close();
        return $data;
    }
    
}
?>
