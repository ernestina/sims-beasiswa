<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Golongan{
    
    public static function golongan_int_string($golongan){
        $gol ='';
        
        switch($golongan){
            case '11':
                $gol = 'Juru Muda - I/a';
                break;
            case '12':
                $gol = 'Juru Muda Tk.I - I/b';
                break;
            case '13':
                $gol = 'Juru - I/c';
                break;
            case '14':
                $gol = 'Juru Tk.I - I/d';
                break;
            case '21':
                $gol = 'Pengatur Muda - IIa';
                break;
            case '22':
                $gol = 'Pengatur Muda Tk.I - II/b';
                break;
            case '23':
                $gol = 'Pengatur - II/c';
                break;
            case '24':
                $gol = 'Pengatur Tk.I - II/d';
                break;
            case '31':
                $gol = 'Penata Muda III/a';
                break;
            case '32':
                $gol = 'Penata Muda Tk.I - III/b';
                break;
            case '33':
                $gol = 'Penata - III/c';
                break;
            case '34':
                $gol = 'Penata Tk.I - III/d';
                break;
            case '41':
                $gol = 'Pembina - IV/a';
                break;
            case '42':
                $gol = 'Pembina Tk.I - IV/b';
                break;
            case '43':
                $gol = 'Pembina Utama Muda - IV/c';
                break;
            case '44':
                $gol = 'Pembina Utama Madya - IV/d';
                break;
            case '45':
                $gol = 'Pembina Utama - IV/e';
                break;
        }
        
        return $gol;
    }
    
    public static function golongan_string_int($golongan){
        $gol ='';
        
        switch($golongan){
            case 'Januari':
                $gol = '01';
                break;
            case 'Februari':
                $gol = '02';
                break;
            case 'Maret':
                $gol = '03';
                break;
            case 'April':
                $gol = '04';
                break;
            case 'Mei':
                $gol = '05';
                break;
            case 'Juni':
                $gol = '06';
                break;
            case 'Juli':
                $gol = '07';
                break;
            case 'Agustus':
                $gol = '08';
                break;
            case 'September':
                $gol = '09';
                break;
            case 'Oktober':
                $gol = '10';
                break;
            case 'November':
                $gol = '11';
                break;
            case 'Desember':
                $gol = '12';
                break;
        }
        
        return $gol;
    }
}
?>
