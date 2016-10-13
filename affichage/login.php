<?php
// La page du formulaire de login (il ressemble étrangement à celui de création de compte
// Le formulaire sera envoyé vers ../traitement/connexion.php


session_start();

include("../divers/connexion.php");
include("../divers/balises.php");


include("entete.php");


if(isset($_SESSION['id'])) { // On est loggé
    echo "Bonjour ".$_SESSION['login']." ";
    echo lien("../traitement/deconnexion.php","Déconnexion");
    echo "<br/>";
    include("menu.php");
} else {

// On est pas loggé, il faut afficher le formulaire

    
?>

<h4> Connexion </h4>

<form action='../traitement/connexion.php' method='POST'>
 
    <input type="text" name="login" placeholder="Login"/>
    <br/>
    <input type="password" name="password" placeholder="Mot de passe"/>
    <br/>
    <input type="submit" name="connexion" value="Se connecter"/>
    
</form> 
<br/>


<?php    
        include("creer.php");
}


?>


<?php

include("pied.php");
?>