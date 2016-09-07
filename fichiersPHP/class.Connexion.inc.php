<?php
/*-------------------------- Déclaration de la classe -----------------------------*/
class clstBDD {
/*----------------Propriétés de la classe  -----------------------------------*/
var $connexion ; 
var $dsn = 'mysql:host=localhost;dbname=16ppe2g04' ;
var $util = "16ppe2g04";
var $passe ="simple@49";
/*---------------------- Accés aux propriétés --------------------------------------*/
	function getConnexion() {return $this->connexion;}
        function getDsn() {return $this->dsn;}
        function getUtilisateur() {return $this->util;}
        function getPassword() {return $this->passe;}
/* --------------   Connexion à une base via PDO-------------- ------------------- */
	function connecte($pNomDSN, $pUtil, $pPasse) {
		//tente d'établir une connexion à une base de données 
		//connexion à la base de données version PHP5
		$this->connexion= new PDO($pNomDSN,$pUtil,$pPasse);
		// version ODBC php4
		//$this->connexion = odbc_connect( $pNomDSN , $pUtil, $pPasse );	
                
		return $this->connexion; 		
	}
/* --------------   Requetes sur la base -------------- ------------------- */
	function requeteAction($req) {
		//exécute une requête action (insert, update, delete), ne retourne pas de résultat
		// version PDO php5
		$nombre_element= $this->connexion->exec($req);
		return $nombre_element;
		// version PHP4
		//odbc_do($this->connexion,$req);
	}
	function requeteSelect($req) {
		//interroge la base (select) et retourne le curseur correspondant
		// version PDO php5
		$lesenregistrements= $this->connexion->query($req) ;
		// version PHP4
		//$lesenregistrements = odbc_do($this->connexion,$req) ;
		return $lesenregistrements;
	}
	
	function close() {
		// version PDO php5
		$this->connexion= null;
		// version PHP4
		//odbc_close($this->connexion);
	}
}
?>