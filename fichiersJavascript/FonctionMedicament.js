/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function suivant(pNumero) {  
    alert(pNumero);
    alert(pElem);
    var xhr_object = null; 
    var data;
    if(window.XMLHttpRequest) // Firefox 
	xhr_object = new XMLHttpRequest(); 
    else if(window.ActiveXObject) // Internet Explorer 
	xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); 
    else { // XMLHttpRequest non supporté par le navigateur 
	alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
	return; 
    }   
    //traitement à la réception des données
    xhr_object.onreadystatechange = function() { 
        if(xhr_object.readyState == 4 && xhr_object.status == 200) { 
            //var formulaire = document.getElementsByName("formMEDICAMENT");
             var formulaire = document.getElementById("formMed");
            formulaire.innerHTML=xhr_object.responseText;
        }
    }
    //alert(pNumero);
    //communication vers le serveur
    xhr_object.open("POST", "chercheMedicament.php", true); 
    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //if((pNumero+1)>pElem){
        data = "med=" + pNumero;
    //}else{
       // data =  "med=" + (pNumero+1);
    //}
    xhr_object.send(data); 
}

function precedent(pNumero) {
    var xhr_object = null; 
    var data;
    if(window.XMLHttpRequest) // Firefox 
	xhr_object = new XMLHttpRequest(); 
    else if(window.ActiveXObject) // Internet Explorer 
	xhr_object = new ActiveXObject("Microsoft.XMLHTTP"); 
    else { // XMLHttpRequest non supporté par le navigateur 
	alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest..."); 
	return; 
    }   
    //traitement à la réception des données
    xhr_object.onreadystatechange = function() { 
        if(xhr_object.readyState == 4 && xhr_object.status == 200) { 
            //var formulaire = document.getElementsByName("formMEDICAMENT");
             var formulaire = document.getElementById("formMed");
            formulaire.innerHTML=xhr_object.responseText;
        }
    }
    
    //communication vers le serveur
    xhr_object.open("POST", "chercheMedicament.php", true); 
    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    if((pNumero-1)<0){
        data = "med=" + 0;
    }
    else{
        data = "med=" + (pNumero-1);
    }
    
    xhr_object.send(data); 
}
