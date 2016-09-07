
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>formulaire VISITEUR</title>
	<style type="text/css">
		<!-- body {background-color: white; color:#5599EE; } 
			label.titre { display : block ; width : 180px ;  clear:left; float:left; } 
			.zone { width : 300 ; float : left; color:black } -->
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
				 var formulaire = document.getElementById("formVISITEUR");
				formulaire.innerHTML=xhr_object.responseText;			} 
		   }
		   //communication vers le serveur
		   xhr_object.open("POST", "chercheVisiteur.php", true); 
		   xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); 
		   var data = "visNum=" + $pNumero ;
		   xhr_object.send(data); 
		   
	   }
	</script>
</head>
<?php
    session_start();
    include 'class.Connexion.inc.php';
    if(empty($_SESSION["identifiant"])){//Si l'identifaint est vide donc l'utilisateur n'est pas connecté.
        echo "Veuillez vous connecter pour consulter ces pages";
        header('Location: ../index.php');
    } else {
        $pdo = new clstBDD();//créer un nouvel objet clstBDD
        $pdo->connecte($pdo->getDsn(), $pdo->getUtilisateur(), $pdo->getPassword());
        
        $sql1 = 'select departement_nom, departement_code from DEPARTEMENT';  //Requête permettant de récupérer le nom et le code de tous les départements       
        $rs1 = $pdo->requeteSelect($sql1);  //éxécute la requête                  
        $ligne1 = $rs1->fetchAll();  //récupère le résultat
                                              
        $sql2 = 'select VIS_NOM, Vis_PRENOM, VIS_MATRICULE from VISITEUR';  //Requête permettant de récupérer le nom, le prénom et le matricule des visiteurs                 
        $rs2 = $pdo->requeteSelect($sql2);                  
        $ligne2 = $rs2->fetchAll();
        
        $sql3='select * from VISITEUR ';  //Requête permettant de récupérer tous les infos des visiteurs    
        $rs3 = $pdo->requeteSelect($sql3);
        $ligne3 = $rs3->fetchAll();
    } 
?>



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
<div name="droite" style="float:left;width:80%;background-color:#77AADD;color:black;height:88%;">
	<div name="bas" style="margin : 10 2 2 2;clear:left;height:88%;">
	<form name="formVISITEUR" method="post" action="recupVISITEUR.php">
		<h1> Visiteurs </h1>
                    <?php
                        echo '<select name="lstDepartement" class="titre" onClick="chercher(this.value);">';
                        echo '<option value="">DEPARTEMENT</option>';
                        foreach ($ligne1 as $departement){
                            echo "<option value=".$departement['departement_code'].">".utf8_encode($departement['departement_nom'])."</option>";
                        }
                        echo '</select>';
                    ?>
                    <?php
                        echo '<select name="lstVisiteur" class="titre" onClick="chercher(this.value);">';
                        echo '<option value="">VISITEUR</option>';
                        foreach ($ligne2 as $visiteur){
                            echo "<option value=".$visiteur['VIS_MATRICULE'].">".utf8_encode($visiteur['VIS_NOM'])." ".utf8_encode($visiteur['Vis_PRENOM'])."</option>";
                        }
                        echo '</select>';
                    ?>
                    <label class="titre">NOM :</label><input type="text" size="25" name="VIS_NOM" class="zone" />
                    <label class="titre">PRENOM :</label><input type="text" size="50" name="Vis_PRENOM" class="zone" />
                    <label class="titre">ADRESSE :</label><input type="text" size="50" name="VIS_ADRESSE" class="zone" />
                    <label class="titre">CP :</label><input type="text" size="5" name="VIS_CP" class="zone" />
                    <label class="titre">VILLE :</label><input type="text" size="30" name="VIS_VILLE" class="zone" /> 
                    <label class="titre">SECTEUR :</label><input type="text" size="1" name="SEC_CODE" class="zone" />
                    <label class="titre">&nbsp;</label><input class="zone"type="button" value="<"></input><input class="zone"type="button" value=">"></input>
                    
        </form>
	</div>
</div>
</body>
</html>