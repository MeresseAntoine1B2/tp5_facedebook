<?php
// La page du formulaire de login (il ressemble étrangement à celui de création de compte
// Le formulaire sera envoyé vers ../traitement/connexion.php


session_start();
//if(isset($_GET['action']) && $_GET['action']=="deconnexion") { // Il taut détruire la session
//    session_destroy();
//    header("Location:login.php");
//}

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

    echo "<form action='../traitement/connexion.php' method='POST'>";
    echo input("text","login")."<br/>";
    echo input("password","password")."<br/>";
    echo input("submit","V");
    echo "</form> <br/>";
    
}



// Il faut faire des requêtes pour afficher ses amis, les attentes, les gens qu'on a invités qui ont pas répondu etc..
// Elles sont listées ci-dessous
// Connaitre ses amis : 



?>


<?php

include("pied.php");
?>