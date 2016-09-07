<?php
    session_start();
    include 'class.Connexion.inc.php';
    if(empty($_SESSION["identifiant"])){//Si l'identifaint est vide donc l'utilisateur n'est pas connecté.
        echo "Veuillez vous connecter pour consulter ces pages";
        header('Location: ../index.php');
    } else { 
        $pdo = new clstBDD();//créer un nouvel objet clstBDD
        $pdo->connecte($pdo->getDsn(), $pdo->getUtilisateur(), $pdo->getPassword());
        $sql="select PRA_NUM, PRA_NOM from PRATICIEN";//Requête permettant de récupérer tous les médiacaments
        $rs = $pdo->requeteSelect($sql);//éxécute la requête
        $ligne = $rs->fetchAll();//récupère le résultat
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>formulaire PRATICIEN</title>
	<style type="text/css">
		<!-- body {background-color: white; color:#5599EE; } 
			label.titre { display : block ; width : 180px ;  clear:left; float:left; } 
			.zone { width : 300 ; float : left; color:white } -->
	</style>
        <script type="text/javascript" src="../fichiersJavascript/FonctionPraticien.js"></script>
	<script language = "javascript">
		function chercher($pNumero) {  
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
		   var data = "pratNum=" + $pNumero ;
		   xhr_object.send(data); 
		   
	   }
	</script>
</head>
<body>	
<div name="haut" style="margin: 2 2 2 2 ;height:6%;"><h1><img src="../images/logo.jpg" width="100" height="60"/>Gestion des visites</h1></div>
<div id="gauche" style="float:left;width:18%; background-color:white; height:100%;">
	<h2>Outils</h2>
	<ul><li>Comptes-Rendus</li>
		<ul>
                    <li><a href="formRAPPORT_VISITE.php" >Nouveaux</a></li>
                    <li>Consulter</li>
		</ul>
		<li>Consulter</li>
		<ul>
                    <li><a href="formMEDICAMENT.php" >Médicaments</a></li>
                    <li><a href="formPRATICIEN.php" >Praticiens</a></li>
                    <li><a href="formVISITEUR.php" >Autres visiteurs</a></li>
		</ul>
                <li>Deconnection</li>
                <ul>
                    <li><a href="logout.php" >déconnecter</a></li>
                </ul>
	</ul>
</div>
<div name="droite" style="float:left;width:80%;background-color:#77AADD;color:white;">
	<div name="bas" style="margin : 10 2 2 2;clear:left;height:88%;">
		<h1> Praticiens </h1>
		<form name="formListeRecherche" > 
                            <?php
                                echo '<select name="lstPrat" class="titre" onClick="chercher(this.value);">';
                                foreach ($ligne as $praticien){
                                    echo "<option value=".$praticien['PRA_NUM'].">".utf8_encode($praticien['PRA_NOM']);
                                }
                                echo '</select>';
                            ?>
                    
		</form>
		<form id="formPraticien">
                    
		</form>
	</div>
</div>
</body>
</html>
