<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ClassXML extends DOMDocument {
    
    private $_version;
    private $_encoding;
    
    public function __construct($version='', $encoding='') {
        parent::__construct($version, $encoding);
        $this->_version = $version;
        $this->_encoding = $encoding;
    }
    
    public function readXML($file, $tag=array()){
        if(!$this->isExistFile($file.".xml")) return false;
//        if(!$this->isExistElement($tag)) return false;
        $data = simplexml_load_file( $file.".xml" );
        return $data;
        
    }
    
    /*
     * 
     */
    public function writeXML($file, $data=array(),$overwrite=true){
        if(!is_array($data)) return false;
//        if($this->isExistFile($file)) return;
        /*foreach($data as $key=>$val){
            $root = $this->createElement($key);
            if(is_array($val)){
                foreach ($val as $k=>$v){
                    $node = $this->createElement($k);
                    $nodeTxt = $this->createTextNode($v);
                    $node->appendChild($nodeTxt);
                    $root->appendChild($node);
                }
            }else{
                $rootTxt = $this->createTextNode($val);
                $root->appendChild($rootTxt);
            }
            $this->appendChild($root);
        }*/
        $this->rekursifWrite($data);
        
        $this->formatOutput = true;
        
        $this->save($file.".xml") or die("Error");
    }
    
    /*
     * versi rekursif write XML
     */
    public function rekursifWrite($data=array(),$root=null){
        
        foreach ($data as $key=>$val){
            $node = $this->createElement($key);
            if(is_array($val)){
                $this->rekursifWrite($val,$node);
            }else{
                $nodeTxt = $this->createTextNode($val);
                $node->appendChild($nodeTxt);
            }
            if(!is_null($root)){
                $root->appendChild($node);
            }
        }
        if(!is_null($root)){
            $this->appendChild($root);
        }
    }
    
    private function isExistFile($file){
        if(file_exists($file)) return true;
        return false;
    }
    
    private function isExistElement(){
        
    }
    
}
?>
