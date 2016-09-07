<?php
    session_start();
    include 'class.Connexion.inc.php';
    if(empty($_SESSION["identifiant"])){//Si l'identifaint est vide donc l'utilisateur n'est pas connecté.
        echo "Veuillez vous connecter pour consulter ces pages";
        header('Location: ../index.php');
    } else {       
    
        $pdo = new clstBDD();//créer un nouvel objet clstBDD
        $pdo->connecte($pdo->getDsn(), $pdo->getUtilisateur(), $pdo->getPassword());
        $requete1="select MAX(RAP_NUM) from RAPPORT_VISITE";//Requête permettant de récupérer le numéro du dernier compte rendu réalisé
        $rs = $pdo->requeteSelect($requete1);//éxécute la requête
        $resul1= $rs->fetch();
        
        
        $date = date("m.d.y");
        
        $requete2="select PRA_NUM,PRA_NOM,PRA_PRENOM,PRA_COEFNOTORIETE from PRATICIEN";//Requête permettant de récupérer les informations du practicien
        $rs2=$pdo->requeteSelect($requete2);
        $resul2=$rs2->fetchall();
        
        $requete3="select MED_NOMCOMMERCIAL,MED_DEPOTLEGAL from MEDICAMENT";//Requête permettant de récupérer les noms des médicaments
        $rs3=$pdo->requeteSelect($requete3);
        $resul3=$rs3->fetchall();
        
        
    }

?>
<!DOCTYPE html>

<html><head>
        
	<meta charset="UTF-8">
        <script type="text/javascript" src="fichiersJavascript/controlesaisie.js"></script>
        <script type="text/javascript" src="../fichiersJavascript/coefficient.js"></script>
	<title>formulaire RAPPORT_VISITE</title>
	<style type="text/css">
		<!-- body {background-color: white; color:5599EE; } 
			label.titre { display : block ; width : 180px ;  clear:left; float:left; } 
			.zone { width : 30car ; float : left; color:5599EE } -->
	</style>
	<script language="javascript">
		function selectionne(pValeur, pSelection,  pObjet) {
			//active l'objet pObjet du formulaire si la valeur sélectionnée (pSelection) est égale à la valeur attendue (pValeur)
			if (pSelection!==pValeur) 
				{ formRAPPORT_VISITE.elements[pObjet].disabled=true; }
			else {
                            formRAPPORT_VISITE.elements[pObjet].disabled=false; 
                            
                        }
		}
	</script>
	 <script language="javascript">
        function ajoutLigne( pNumero){//ajoute une ligne de produits/qté à la div "lignes"     
			//masque le bouton en cours
			document.getElementById("but"+pNumero).setAttribute("hidden","true");	
			pNumero++;										//incrémente le numéro de ligne
            var laDiv=document.getElementById("lignes");	//récupère l'objet DOM qui contient les données
			var titre = document.createElement("label") ;	//crée un label
			laDiv.appendChild(titre) ;						//l'ajoute à la DIV
			titre.setAttribute("class","titre") ;			//définit les propriétés
			titre.innerHTML= "   Produit : ";
			var liste = document.createElement("select");	//ajoute une liste pour proposer les produits
			laDiv.appendChild(liste) ;
			liste.setAttribute("name","PRA_ECH"+pNumero) ;
			liste.setAttribute("class","zone");
			//remplit la liste avec les valeurs de la première liste construite en PHP à partir de la base
			liste.innerHTML=formRAPPORT_VISITE.elements["PRA_ECH1"].innerHTML;
			var qte = document.createElement("input");
			laDiv.appendChild(qte);
			qte.setAttribute("name","PRA_QTE"+pNumero);
			qte.setAttribute("size","2"); 
			qte.setAttribute("class","zone");
			qte.setAttribute("type","text");
			var bouton = document.createElement("input");
			laDiv.appendChild(bouton);
			//ajoute une gestion évenementielle en faisant évoluer le numéro de la ligne
			bouton.setAttribute("onClick","ajoutLigne("+ pNumero +");");
			bouton.setAttribute("type","button");
			bouton.setAttribute("value","+");
			bouton.setAttribute("class","zone");	
			bouton.setAttribute("id","but"+ pNumero);				
        }
    </script>
</head>

<body>
<div id="haut" style="margin: 2 2 2 2 ;height:6%;color:#5599EE;"><h1><img src="../images/logo.jpg" width="100" height="60"/>Gestion des visites</h1></div>
<div id="gauche" style="float:left;width:18%; background-color:white;color:#77AADD;height:100%;">
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
<div id="droite" style="float:left;width:80%;background-color:#77AADD;">
	<div id="bas" style="margin : 10 2 2 2;clear:left;background-color:#77AADD;color:white;height:88%;">
		<form name="formRAPPORT_VISITE" method="post" action="recupRAPPORT_VISITE.php"onsubmit="controleremplaçant();">
			<h1> Rapport de visite </h1>
			<label class="titre">NUMERO :</label><input type="text" size="10" name="RAP_NUM" class="zone"value="<?php echo $resul1[0]+1 ?>" />
			<label class="titre">DATE VISITE :</label><input type="text" size="10" name="RAP_DATEVISITE" class="zone"  />
			<label class="titre">PRATICIEN :</label>
                            <?php 
                                echo '<select name="PRA_NUM" class="zone" onClick="getcoefficient(this.value) ">';
                                foreach ($resul2 as $praticien){
                                    echo "<option value=".$praticien['PRA_NUM'].">".utf8_encode($praticien['PRA_NOM'])." ".utf8_encode($praticien['PRA_PRENOM']);
                                }
                                echo '</select>';
                                
                            ?>                                               
			<label class="titre">COEFFICIENT :</label><input type="text" size="6" name="PRA_COEFF" class="zone" value= "" id="coeff" />
			<label class="titre">REMPLACANT :</label><input type="checkbox" class="zone"  onClick="selectionne(true,this.checked,'PRA_REMPLACANT');"/>
                         <?php 
                                echo '<select name="PRA_REMPLACANT" class="zone" disabled="disabled" ">';
                                echo "<option value=''>Aucun";
                                foreach ($resul2 as $praticien){
                                    echo "<option  value=".$praticien['PRA_NUM'].">".utf8_encode($praticien['PRA_NOM'])." ".utf8_encode($praticien['PRA_PRENOM']);
                                }
                                echo '</select>';
                                
                            ?> 
                       
			<label class="titre">DATE :</label><input type="text" size="19" name="RAP_DATE" class="zone"disabled="disabled"value="<?php echo $date?>" />
			<label class="titre">MOTIF :</label><select  name="RAP_MOTIF" class="zone" onClick="selectionne('AUT',this.value,'RAP_MOTIFAUTRE');">
											<option value="PRD">Périodicité</option>
											<option value="ACT">Actualisation</option>
											<option value="REL">Relance</option>
											<option value="SOL">Sollicitation praticien</option>
											<option value="AUT">Autre</option>
										</select><input type="text" name="RAP_MOTIFAUTRE" class="zone" disabled="disabled" />
			<label class="titre">BILAN :</label><textarea rows="5" cols="50" name="RAP_BILAN" class="zone" ></textarea>
			<label class="titre" ><h3> Eléments présentés </h3></label>
                        <label class="titre" >PRODUIT 1 : </label>
                                 <?php 
                                    echo '<select name="PROD1" class="zone" onClick="chercher(this.value);">';
                                    echo "<option value=''>Aucun" ;
                                    foreach ($resul3 as $medicament){
                                        echo "<option value=".$medicament['MED_DEPOTLEGAL'].">".utf8_encode($medicament['MED_NOMCOMMERCIAL']);
                                    }
                                    echo '</select>';
                                ?>   
                        <label class="titre" >PRODUIT 2 : </label>
                                 <?php 
                                    echo '<select name="PROD2" class="zone" onClick="chercher(this.value);">';
                                    echo "<option value=''>Aucun " ;
                                    foreach ($resul3 as $medicament){
                                        echo "<option value=".$medicament['MED_DEPOTLEGAL'].">".utf8_encode($medicament['MED_NOMCOMMERCIAL']);
                                    }
                                    echo '</select>';
                                ?>   
			<label class="titre">DOCUMENTATION OFFERTE :</label><input name="RAP_DOC" type="checkbox" class="zone"  />
			<label class="titre"><h3>Echanitllons</h3></label>
			<div class="titre" id="lignes">
				<label class="titre" >Produit : </label>                               
				<select name="PRA_ECH1" class="zone">
                                <option>Aucun</option>
                                    <?php
                                        foreach ($resul3 as $medicament){
                                        echo "<option value=".$medicament['MED_DEPOTLEGAL'].">".utf8_encode($medicament['MED_NOMCOMMERCIAL']);
                                        }
                                    ?>
                                </select>
                                <input type="text" name="PRA_QTE1" size="2" class="zone"/>
				<input type="button" id="but1" value="+" onclick="ajoutLigne(1);" class="zone" />			
			</div>		
			<!-- <label class="titre">SAISIE DEFINITIVE :</label><input name="RAP_LOCK" type="checkbox" class="zone" checked="false" /> -->
                        <label class="titre"></label><div class="zone"><input type="reset" value="annuler"></input><input type="submit" ></input>
		</form>
	</div>
</div>
</body>
</html>