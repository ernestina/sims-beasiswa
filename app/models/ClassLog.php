<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ClassLog{
    
    public static function write_log($modul,$aksi,$referensi){
        $db = new Database();
        $pesan = "modul ".strtoupper($modul)." aksi ".strtoupper($aksi)." referensi ".$referensi;
        $ip = '';
        if($_SERVER['HTTP_CLIENT_IP']){
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif($_SERVER['HTTP_X_FORWARDED_FOR']){
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }elseif($_SERVER['HTTP_X_FORWARDED']){
            $ip = $_SERVER['HTTP_X_FORWARDED'];
        }elseif($_SERVER['HTTP_FORWARDED_FOR']){
            $ip = $_SERVER['HTTP_FORWARDED_FOR'];
        }elseif($_SERVER['HTTP_FORWARDED']){
            $ip = $_SERVER['HTTP_FORWARDED'];
        }elseif($_SERVER['REMOTE_ADDR']){
            $ip = $_SERVER['REMOTE_ADDR'];
        }else{
            $ip = 'UNKNOWN';
        }
        
        $now = date('Y-m-d h:i:s');
        $data = array(
                'KD_USER'=>  Session::get('user'),
                'AKTIFITAS_EL'=>$pesan,
                'TIME_STAMP_EL'=>$now,
                'IP_ADDRESS_EL'=>$ip
        );
//        var_dump($data);
//        echo Session::get('user')." ".$pesan." ".$ip." ".$now;
        $db->insert('d_entry_log', $data);
        
        
    }
}
?>
