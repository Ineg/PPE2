<?php 
    session_start();
    include 'fichiersPHP/class.Connexion.inc.php'; //inclus la classe connexion pour utiliser les méthodes.
    
    //vérifie que les champs ne soit pas nuls et existent
    if (isset($_POST['login']) && isset($_POST['password'])) {  
        $pdo = new clstBDD();//créer un nouvel objet clstBDD
        $pdo->connecte($pdo->getDsn(), $pdo->getUtilisateur(), $pdo->getPassword());//Se connecte à la base de données grâce au différents paramètres précisé dans le fichier class.Connexion.inc.php.
        $login = $_POST['login'];//récupère le login saisi
        $mdp = $_POST['password'];//récupère le mot de passe saisi
        //vérifie si la connexion est bien établie
        if($pdo->getConnexion()){           
            $sql="select VIS_DATEEMBAUCHE from VISITEUR where VIS_MATRICULE='".$login."'";//Requête permettant de récupérer la date embauche
            $rs = $pdo->requeteSelect($sql);//éxécute la requête
            $ligne = $rs->fetch();//récupère le résultat
            //vérifie la correspondance
            
            if($ligne[0] == $mdp){
                //lance la session
                $_SESSION["identifiant"]=$login;//met le login en variable de session
                
                header('Location: fichiersPHP/formRAPPORT_VISITE.php');
            } else {
                echo"Accès refusé, votre mot de passe ou nom d'utilisateur est incorrect !";
            }
        } else {
            echo "Connection avec la base de donnée impossible";
        }   
    }
?>
<html>
<meta charset="UTF-8">
<script type="text/javascript" src="fichiersJavascript/controlesaisie.js"></script>
<link rel="stylesheet"  media="screen"  type="text/css"  href="css/ADEC.css" /> 
<head>
  <title>Page de connexion</title>
</head>
<body class="test">

<form method="post" action="index.php" class="element" >
      Pour se connecter : <br>
      Votre pseudo : <input type="text" name="login"> <br>
      Mot de passe : <input type="password" name="password">
      <input type="submit" value="Login" onclick="return controlesaisie();">
</form>
</body>
</html>
