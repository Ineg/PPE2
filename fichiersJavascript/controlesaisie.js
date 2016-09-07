/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function controlesaisie(){
    var login;
    var mdp;
    var Rep = true;
    login = document.getElementsByName("login")[0].value;
    mdp = document.getElementsByName("password")[0].value;
    if (login == "" && mdp == ""){
        alert("Saisir vos informations de saisie ! ");
        Rep = false;
    } else {
        if(login ==""){
            alert("Saisir votre login ! ");
            Rep = false;
        } else {
            if(mdp ==""){
               alert("Saisir votre mot de passe ! "); 
               Rep = false;
            }
        }
    }  
    return Rep;
}

function controleremplaçant(){
    var practicien;
    var remplaçant;
     //practicien=PRA_NUM.options[PRA_NUM.selectedIndex].value;
    practicien=document.getElementsByName("PRA_NUM")[0].value;
    remplaçant=document.getElementsByName("PRA_REMPLACANT")[0].value;
    if (practicien==remplaçant){
        return false;
        alert("Le praticien et le remplaçant sont la même personne!");
    }
}
