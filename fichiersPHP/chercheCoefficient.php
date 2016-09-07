<?php 
	include ("class.Connexion.inc.php");
	$laBase = new clstBDD;
	$laBase->connecte($laBase->getDsn(), $laBase->getUtilisateur(), $laBase->getPassword());
	if ($laBase->getConnexion() != null) { 
            //on interroge la base
            
            $laBase->close();
	}
?>