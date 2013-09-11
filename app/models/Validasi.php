<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Validasi{
    
    public function __construct() {
        ;
    }
    
    /*
     * validasi format nomor telepon
     * @param nomor telepon
     * return boolean
     */
    public static function validate_telephone($number){
        
    }
    
    /*
     * validasi alamat email
     * @param alamat email
     * return boolean
     */
    public static function validate_email($email){
        
    }
    
    /*
     * validasi panjang karakter
     * @param text, panjang minimal
     * return boolean
     */
    public static function validate_len_text($text,$num){
        
    } 
    
    /*
     * validasi kolom kosong di isian form
     * @param array isian form, array nama kolom
     * return boolean
     */
    public static function validate_isian($content=array(),$fields=array()){
        
    }
    
    /*
     * validasi inputan harus string
     * @param text
     * return boolean
     */
    public static function validate_string($text){
        $pola = '';
        
    }
    
    /*
     * validasi inputan harus angka
     * @param text
     * return boolean
     */
    public static function validate_number($number){
        
    }

    public function __destruct() {
        ;
    }
}
?>
