<?php
// La page du formulaire de login (il ressemble étrangement à celui de création de compte
// Le formulaire sera envoyé vers ../traitement/connexion.php


session_start();

include("../divers/connexion.php");
include("../divers/balises.php");


include("entete.php");


if(isset($_SESSION['id'])) { // On est loggé
    include("menu.php");
    echo "<div class='container'>";
    echo "<div class='groupe invit'>";
echo "<h4> Invitations d'amis démons encore en attente : </h4>";

    $sql = "SELECT utilisateur.* FROM utilisateur WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente')";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    echo "<ul>";
    while($line = $q->fetch()) {
		  echo "<li><div class='nom'>";
        echo $line['login']." ";
        echo "</div>";
        echo "<a href='../traitement/valideramitie.php?etat=ami&id=".$line["id"]."'>accepter</a> 
        <a href='../traitement/valideramitie.php?etat=banni&id=".$line["id"]."'>refuser</a></p>";
        echo "</li>";
    }
    echo "</ul>";
	 echo "</div>";
	 echo "</div>";
} else {

// On est pas loggé, il faut afficher le formulaire

    
?>
<div id="loginconnexion">
<div class="container">
<h4>Déjà un des notre ?</h4>
<form action='../traitement/connexion.php' method='POST'>
 
    <input type="text" name="login" placeholder="Login"/>
    <br/>
    <input type="password" name="password" placeholder="Mot de passe"/>
    <br/>
    <input type="submit" name="connexion" value="Se connecter"/>
    
</form> 
</div>
</div>

<div id="logininscription">
<div class="container">
<?php    
        include("creer.php");
}


?>
</div>
</div>

<?php

include("pied.php");
?>