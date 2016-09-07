/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function getcoefficient(numpra){
    var requeteHttp=getRequeteHttp();
    if (requeteHttp==null)
    {
        alert("Impossible d'utiliser Ajax sur ce navigateur");
    }
    else
    {
        // declenche un post sur la page getinfoclasse.php puis declenchera recevoirInfoClasse
        requeteHttp.open('POST','chercheCoefficient.php',true);
	requeteHttp.onreadystatechange=function() {recevoirInfoPra(requeteHttp);};
	requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	requeteHttp.send('numero_pra=' + escape(numpra));
    }
}
function recevoirInfoPra(requeteHttp)
{
    if (requeteHttp.readyState==4){
	if (requeteHttp.status==200)
	{
		document.getElementById("coeff").innerHTML=requeteHttp.responseText;
	}
	else
	{
		alert("La requête ne s'est pas correctement exécutée");
	}
    }
}


