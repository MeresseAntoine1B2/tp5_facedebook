<?php
// La page de gestion des amis.
// Amis, attente, invitation (les bannis on les aime pas, on les affiche pas)
// Formulaire d'acceptation/refus amitié
// formulaire de demande d'amitié


session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la page de login
	header("Location:login.php");
}


include("entete.php");
include("menu.php");


// Il faut faire des requêtes pour afficher ses amis, les attentes, les gens qu'on a invités qui ont pas répondu etc..
// Elles sont listées ci-dessous

?>

<form action="#" method="get">
<input type="search" name="search" placeholder="Rechercher des démons"/>
<input type="submit" value="Chercher"/>
</form>

<?php

// Connaitre les gens que l'on a invité et qui n'ont pas répondu : 
// SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON utilisateur.id=idUtilisateur2 AND etat='attente' AND idUtilisateur1=?
// Paramètre 1 : le $_SESSION['id']

echo "<h4> Amis démons invités : </h4>";

    $sql = "SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON utilisateur.id=idUtilisateur2 AND etat='attente' AND     idUtilisateur1=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    while($line = $q->fetch()) {

        echo $line['login']." ";
        echo "<br />"; 
    }



// Connaitre les gens qui nous ont invité et pour lequel on a pas répondu 
// SELECT utilisateur.* FROM utilisateur WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente'
// Paramètre 1 : le $_SESSION['id']

echo "<h4> Invitations d'amis démons : </h4>";

    $sql = "SELECT utilisateur.* FROM utilisateur WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente')";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    while($line = $q->fetch()) {
		  echo "<p>";
        echo $line['login']." ";
        echo "<br />";
        echo "<a href='../traitement/valideramitie.php?etat=ami&id=".$line["id"]."'>accepter</a> 
        <a href='../traitement/valideramitie.php?etat=ami&id=".$line["id"]."'>refuser</a></p>";
    }


// Connaitre ses amis : SELECT * FROM utilisateur WHERE id IN (SELECT )
// SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur1=utilisateur.id AND etat='ami' AND idUTilisateur2=? UNION SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur2=utilisateur.id AND etat='ami' AND idUTilisateur1=?
// Les deux paramètres sont le $_SESSION['id']

echo "<h4> Mes amis démons : </h4>";

    $sql = "SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur1=utilisateur.id AND etat='ami' AND idUTilisateur2=? UNION SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur2=utilisateur.id AND etat='ami' AND idUTilisateur1=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id'], $_SESSION['id']));
    while($line = $q->fetch()) {

        echo $line['login']." ";
        echo "<br />"; 
    }


?>



<?php

include("pied.php");
?>