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
