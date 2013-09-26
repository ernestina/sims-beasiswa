<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class StatusPB{
    
    public static function status_int_string($status){
        $sts ='';
        
        switch($status){
            case '1':
                $sts = 'Belum Lulus';
                break;
            case '2':
                $sts = 'Belum Lulus - Perpanjangan 1';
                break;
            case '3':
                $sts = 'Belum Lulus - Perpanjangan 2';
                break;
            case '4':
                $sts = 'Belum Lulus - Cuti';
                break;
            case '5':
                $sts = 'Lulus';
                break;
            case '6':
                $sts = 'Lulus - Lebih Dini';
                break;
            case '7':
                $sts = 'Lulus - Perpanjangan 1';
                break;
            case '8':
                $sts = 'Lulus - Perpanjangan 2';
                break;
            case '9':
                $sts = 'Tidak Lulus';
                break;
        }
        
        return $sts;
    }
    
    public static function status_string_int($status){
        $sts ='';
        
        switch($status){
            case 'Belum Lulus':
                $sts = '1';
                break;
            case 'Belum Lulus - Perpanjangan 1':
                $sts = '2';
                break;
            case 'Belum Lulus - Perpanjangan 2':
                $sts = '3';
                break;
            case 'Belum Lulus - Cuti':
                $sts = '4';
                break;
            case 'Lulus':
                $sts = '5';
                break;
            case 'Lulus - Lebih Dini':
                $sts = '6';
                break;
            case 'Lulus - Perpanjangan 1':
                $sts = '7';
                break;
            case 'Lulus - Perpanjangan 2':
                $sts = '8';
                break;
            case 'Tidak Lulus':
                $sts = '9';
                break;
        }
        return $sts;
    }
}
?>
