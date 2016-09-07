<?php 
	include ("class.Connexion.inc.php");
        $laBase = new clstBDD;
	$laBase->connecte($laBase->getDsn(), $laBase->getUtilisateur(), $laBase->getPassword());
        if ($laBase->getConnexion() != null) {
            $nbligne = $_POST["vis"];
            $sql="select * from VISITEUR ";//Requête permettant de récupérer tous les médiacaments
            $rs = $laBase->requeteSelect($sql);//éxécute la requête
            $ligne = $rs->fetchAll();//récupère le résultat 
            
            foreach ($ligne as $visiteur){
                
                //on positionne les champs avec les valeurs de la table
                echo '
                <label class="titre">NOM :</label><input type="text" size="25" name="VIS_NOM" class="zone" value="'.utf8_encode($ligne[$nbligne][1]).'" />
                <label class="titre">PRENOM :</label><input type="text" size="50" name="Vis_PRENOM" class="zone" value="'.utf8_encode($ligne[$nbligne][2]).'" />
                <label class="titre">ADRESSE :</label><input type="text" size="50" name="VIS_ADRESSE" class="zone" value="'.utf8_encode($ligne[$nbligne][3]).'" />
                <label class="titre">CP :</label><input type="text" size="5" name="VIS_CP" class="zone" value="'.utf8_encode($ligne[$nbligne][4]).'" />
                <label class="titre">VILLE :</label><input type="text" size="30" name="VIS_VILLE" class="zone" value="'.utf8_encode($ligne[$nbligne][5]).'" />
                <label class="titre">SECTEUR :</label><input type="text" size="1" name="SEC_CODE" class="zone" value="'.utf8_encode($ligne[$nbligne][7]).'" />
                <label class="titre">&nbsp;</label><input class="zone"type="button" value="<"></input><input class="zone"type="button" value=">"></input>
                ';
            }
            $laBase->close();
	}
?>