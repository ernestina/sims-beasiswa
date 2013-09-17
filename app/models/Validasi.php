<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Validasi{
    
    const NUM_PATTERN = '/^[0-9]*$/';
    const TELP_PATTERN = '/^0([1-9]{2,3})[-. ]([0-9]{5,7})$/';
    const EMAIL_PATTERN = '/^[a-zA-Z0-9]*(|[-._][a-zA-Z0-9]*)\@([a-z]*)[.]([a-z]{3,4})/';
    const STRING_PATTERN = '/^[_a-zA-Z- ]*$/';
    const NIP1_PATTERN = '/^060[0-9]{6}$/';
    const NIP2_PATTERN = '/^19([0-9]{14})([1-2]{1})([0]{1})([0-9]{2})$/';
    const SP2D_PATTERN = '/^([0-9]{6})([A-Z]{1})/';
    
    
    public function __construct() {
        ;
    }
    
    /*
     * validasi format nomor telepon
     * @param nomor telepon
     * return boolean
     */
    public static function validate_telephone($number){
        if(!preg_match('/^0([1-9]{2,3})[-. ]([0-9]{5,7})$/', $number)) return FALSE;
        return TRUE;
    }
    
    /*
     * validasi alamat email
     * @param alamat email
     * return boolean
     */
    public static function validate_email($email){
        if(!preg_match('/^[a-zA-Z0-9]*(|[-._][a-zA-Z0-9]*)\@([a-z]*)[.]([a-z]{3,4})/', $email)) return FALSE;
        return TRUE;
    }
    
    /*
     * validasi panjang karakter
     * @param text, panjang minimal
     * return boolean
     */
    public static function validate_len_text($text,$num){
        $len_text = strlen($text);
        $num = (int) $num;
        if($num >= $len_text) return TRUE;
        return FALSE;
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
        if(!preg_match('/^[_a-zA-Z- ]*$/', $text)) return FALSE;
        return TRUE;
        
    }
    
    /*
     * validasi inputan harus angka
     * @param text
     * return boolean
     */
    public static function validate_number($number){
        if(!preg_match('/^[0-9]*$/', $number)) return FALSE;
        return TRUE;
    }
    
    /*
     * validasi nomor sp2d
     * return boolean
     */
    public static function validate_sp2d($sp2d){
        if(!preg_match('/^([0-9]{6})([A-Z]{1})/', $sp2d)) return FALSE;
        return TRUE;
    }
    
    /*
     * validasi nip
     * return boolean
     */
    public static function validate_nip($nip){
        $nip_9 = strlen($nip)==9?TRUE:FALSE;
        $nip_18 = strlen($nip)==18?TRUE:FALSE;
        
        if(Validasi::validate_number($nip)==FALSE) return FALSE;
        
        if($nip_9 OR $nip_18){
            if(strlen($nip)==9){
                return preg_match('/^060[0-9]{6}$/',$nip);
            }else if(strlen($nip)==18){
                $th_lhr = (int) substr($nip, 0,4);
                $bl_lhr = (int) substr($nip, 4,2);
                $bl_angkat = (int) substr($nip,12,2);
                $year = (int) date('Y');
                $resign = $year-50;
                if($resign<$th_lhr AND $th_lhr<($year-18)){
                    if(0<$bl_lhr AND $bl_lhr<13 AND 0<$bl_angkat AND $bl_angkat<13){
                        if(preg_match('/^19([0-9]{12})([1-2]{1})([0]{1})([0-9]{2})$/', $nip)) return TRUE;
                        return FALSE;
                    }
                }
                
            }
        }else{
            return FALSE;
        }
    } 

    public function __destruct() {
        ;
    }
}
?>
