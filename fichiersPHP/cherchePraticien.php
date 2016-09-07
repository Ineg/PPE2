
<?php 
	include ("class.Connexion.inc.php");
	$laBase = new clstBDD;
	$laBase->connecte($laBase->getDsn(), $laBase->getUtilisateur(), $laBase->getPassword());
	if ($laBase->getConnexion() != null) { 
            //on interroge la base
            $curseur = $laBase->requeteSelect('select * from PRATICIEN p,TYPE_PRATICIEN tp where p.TYP_CODE= tp.TYP_CODE and PRA_NUM='.$_POST["pratNum"]); 
            $ligne = $curseur->fetchAll();
            
            foreach ($ligne as $praticien){
                
                //on positionne les champs avec les valeurs de la table
                echo '
                <label class="titre">NUMERO :</label><label size="5" name="PRA_NUM" class="zone" >'.utf8_encode($praticien['PRA_NUM']).'</label>
                <label class="titre">NOM :</label><label size="25" name="PRA_NOM" class="zone" >'.utf8_encode($praticien["PRA_NOM"]).'</label>
                <label class="titre">PRENOM :</label><label size="30" name="PRA_PRENOM" class="zone" >'.utf8_encode($praticien["PRA_PRENOM"]).'</label>
                <label class="titre">ADRESSE :</label><label size="50" name="PRA_ADRESSE" class="zone" >'.utf8_encode($praticien["PRA_ADRESSE"]).'</label>
                <label class="titre">CP :</label><label size="5" name="PRA_CP" class="zone" >'.$praticien["PRA_CP"].' '.utf8_encode($praticien["PRA_VILLE"]).'</label>
                <label class="titre">COEFF. NOTORIETE :</label><label size="7" name="PRA_COEFNOTORIETE" class="zone" >'.utf8_encode($praticien["PRA_COEFNOTORIETE"]).'</label>
                <label class="titre">TYPE :</label><label size="3" name="TYP_CODE" class="zone" >'.utf8_encode($praticien["TYP_LIBELLE"]).'</label>
                <label class="titre">&nbsp;</label><div class="zone"><input type="button" value="<" onClick="precedent('.$praticien["PRA_NUM"].');"></input><input type="button" value=">" onClick="suivant('.$praticien["PRA_NUM"].');"></input>
                ';
            }
            
            $laBase->close();
	}
?>