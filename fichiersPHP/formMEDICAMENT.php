
<?php
    session_start();
    include 'class.Connexion.inc.php';
    if(empty($_SESSION["identifiant"])){//Si l'identifiant est vide donc l'utilisateur n'est pas connecté.
        echo "Veuillez vous connecter pour consulter ces pages";
        header('Location: ../index.php');
    } else {
        $medic= isset($_POST['med']) ? $_POST['med'] : 0;
        $nbligne = $medic; 
        $pdo = new clstBDD();//créer un nouvel objet clstBDD
        $pdo->connecte($pdo->getDsn(), $pdo->getUtilisateur(), $pdo->getPassword());
        $sql="select * from MEDICAMENT ";//Requête permettant de récupérer tous les médiacaments
        $rs = $pdo->requeteSelect($sql);//éxécute la requête
        $ligne = $rs->fetchAll();//récupère le résultat
        $sql = "select COUNT(*) from MEDICAMENT";
        $rs = $pdo->requeteSelect($sql);
        $nbelem = $rs->fetch();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>formulaire MEDICAMENT</title>
        <script type="text/javascript" src="../fichiersJavascript/FonctionMedicament.js"></script>
	<style type="text/css">
		<!-- body {background-color: white; color:#5599EE; } 
			label.titre { display : block ; width : 180px ;  clear:left; float:left; } 
			.zone { width : 30car ; float : left; color:7091BB } -->
	</style>
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
	<form name="formMEDICAMENT" method="post" id="formMed">
		<h1> Pharmacopee </h1>
                
                <label class="titre">DEPOT LEGAL :</label><input type="text" size="10" name="MED_DEPOTLEGAL" class="zone" value="<?php echo $ligne[$nbligne][0] ?>" />
		<label class="titre">NOM COMMERCIAL :</label><input type="text" size="25" name="MED_NOMCOMMERCIAL" class="zone" value="<?php echo $ligne[$nbligne][1] ?>"/>
		<label class="titre">FAMILLE :</label><input type="text" size="3" name="FAM_CODE" class="zone" value="<?php echo $ligne[$nbligne][2] ?>"/>
                <label class="titre">COMPOSITION :</label><textarea rows="5" cols="50" name="MED_COMPOSITION" class="zone" ><?php echo utf8_encode($ligne[$nbligne][3]) ?></textarea>
		<label class="titre">EFFETS :</label><textarea rows="5" cols="50" name="MED_EFFETS" class="zone" ><?php echo utf8_encode($ligne[$nbligne][4]) ?></textarea>
		<label class="titre">CONTRE INDIC. :</label><textarea rows="5" cols="50" name="MED_CONTREINDIC" class="zone" ><?php echo utf8_encode($ligne[$nbligne][5]) ?></textarea>
		<label class="titre">PRIX ECHANTILLON :</label><input type="text" size="7" name="MED_PRIXECHANTILLON" class="zone" value="<?php echo $ligne[$nbligne][6] ?>"/>
                <label class="titre">&nbsp;</label><input class="zone" type="button" value="<" onclick="precedent(<?php echo $nbligne; ?>);"></input><input class="zone" type="button" value=">" onclick="suivant(<?php echo $nbligne; ?>);"></input>
	</form>
	</div>
</div>
</body>
</html>
