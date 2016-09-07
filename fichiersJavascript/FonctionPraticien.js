function suivant(pNumero) {  
    var xhr_object = null; 	    
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
            var formulaire = document.getElementById("formPraticien");
            formulaire.innerHTML=xhr_object.responseText;			} 
    }
    //communication vers le serveur
    xhr_object.open("POST", "cherchePraticien.php", true); 
    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var data = "pratNum=" + (pNumero+1) ;
    xhr_object.send(data); 
		   
}

function precedent(pNumero) {  
    var xhr_object = null; 	    
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
            var formulaire = document.getElementById("formPraticien");
            formulaire.innerHTML=xhr_object.responseText;			} 
    }
    //communication vers le serveur
    xhr_object.open("POST", "cherchePraticien.php", true); 
    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var data = "pratNum=" + (pNumero-1) ;
    xhr_object.send(data); 
		   
}
a