
<?php 
	include ("class.Connexion.inc.php");
        $laBase = new clstBDD;
	$laBase->connecte($laBase->getDsn(), $laBase->getUtilisateur(), $laBase->getPassword());
        if ($laBase->getConnexion() != null) {
            $nbligne = $_POST['med'];
            $sql="select * from MEDICAMENT ";//Requête permettant de récupérer tous les médiacaments
            $rs = $laBase->requeteSelect($sql);//éxécute la requête
            $ligne = $rs->fetchAll();//récupère le résultat 
            $sql = "select COUNT(*) from MEDICAMENT";
            $rs2 = $laBase->requeteSelect($sql);
            $nbelem = $rs2->fetch();
            echo '
                <label class="titre">DEPOT LEGAL :</label><input type="text" size="10" name="MED_DEPOTLEGAL" class="zone" value="'.utf8_encode($ligne[$nbligne][0]).'" />
                <label class="titre">NOM COMMERCIAL :</label><input type="text" size="25" name="MED_NOMCOMMERCIAL" class="zone" value="'.utf8_encode($ligne[$nbligne][1]).'"/>
                <label class="titre">FAMILLE :</label><input type="text" size="3" name="FAM_CODE" class="zone" value="'.utf8_encode($ligne[$nbligne][2]).'"/>
                <label class="titre">COMPOSITION :</label><textarea rows="5" cols="50" name="MED_COMPOSITION" class="zone" >'.utf8_encode($ligne[$nbligne][3]).'</textarea>
                <label class="titre">EFFETS :</label><textarea rows="5" cols="50" name="MED_EFFETS" class="zone" >'.utf8_encode($ligne[$nbligne][4]).'</textarea>
                <label class="titre">CONTRE INDIC. :</label><textarea rows="5" cols="50" name="MED_CONTREINDIC" class="zone" >'.utf8_encode($ligne[$nbligne][5]).'</textarea>
                <label class="titre">PRIX ECHANTILLON :</label><input type="text" size="7" name="MED_PRIXECHANTILLON" class="zone" value="'.$ligne[$nbligne][6].'"/>
                <label class="titre">&nbsp;</label><input class="zone" type="button" value="<" onclick="precedent('.$nbligne.');"></input><input class="zone" type="button" value=">" onclick="suivant('.$nbligne,$nbelem[0].');"></input>
            ';
            $laBase->close();
        }
?>