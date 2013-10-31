/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function viewError(id,message){
    $('#'+id).fadeIn(0);
    $('#'+id).html(message);
    $('#'+id).addClass('error'); 
}

function removeError(id){
    $('#'+id).fadeOut(0);
    $('#'+id).removeClass('error'); 
}

function cekAngka(val){
    var angka = /^[0-9]+$/;
    if (angka.test(val)==false){	  
        return false;
    }
}

//dsiplay popup with target window
function cetak_dokumen(target){
    window.open('',target,'toolbar=no, location=no, addressbar=no, directories=no, status=no, menubar=no, width=1000,height=500,scrollbars=yes')
}


// Popup window code
function newPopup(url) {
	popupWindow = window.open(
		url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}


function jam(){ 

                    Hari = new Array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat","Sabtu");
                    Bulan = new Array("Januari", "Februari", "Maret", "April", "Mei","Juni", "Juli","Agustus", "September", "Oktober", "November", "Desember");
	
                    var waktu = new Date(); 
                    var jam = waktu.getHours(); 
                    var menit = waktu.getMinutes(); 
                    var detik = waktu.getSeconds(); 
                    var tahun = waktu.getFullYear();
                    var bulan = Bulan[waktu.getMonth()];
                    var tgl = waktu.getDate();
                    var hari = Hari[waktu.getDay()]; 
	
	
	
                    if (jam < 10){ jam = "0" + jam; } 
                    if (menit < 10){ menit = "0" + menit; } 
                    if (detik < 10){ detik = "0" + detik; } 
                    var jam_div = document.getElementById('jam'); 
                    jam_div.innerHTML = hari+", "+tgl+" "+bulan+" "+tahun+"  "+jam + ":" + menit + ":" + detik; setTimeout("jam()", 1000); 
                } 
                
                