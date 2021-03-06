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
<div id="bandesearch">
<div class="container">
<form action="#" method="get" id="formsearch">
<input type="search" name="search" placeholder="Rechercher des démons" id="search"/>
<input type="submit" value="Chercher" id="recherche"/>
</form>

<?php

include("../traitement/rechercher.php");
?>
</div>
</div>
<?php
// Connaitre les gens que l'on a invité et qui n'ont pas répondu : 
// SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON utilisateur.id=idUtilisateur2 AND etat='attente' AND idUtilisateur1=?
// Paramètre 1 : le $_SESSION['id']
echo '<div class="container">';
echo "<div class='groupe'>";
echo "<h4> Amis démons invités : </h4>";

    $sql = "SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON utilisateur.id=idUtilisateur2 AND etat='attente' AND     idUtilisateur1=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id']));
    echo "<ul>";
    while($line = $q->fetch()) {
		echo "<li><div class='nom'>";
        echo $line['login']." ";
        echo "</div></li>";
    }
    echo "</ul>";
    echo "</div>";



// Connaitre les gens qui nous ont invité et pour lequel on a pas répondu 
// SELECT utilisateur.* FROM utilisateur WHERE id IN(SELECT idUtilisateur1 FROM lien WHERE idUtilisateur2=? AND etat='attente'
// Paramètre 1 : le $_SESSION['id']

echo "<div class='groupe invit'>";
echo "<h4> Invitations d'amis démons : </h4>";

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

// Connaitre ses amis : SELECT * FROM utilisateur WHERE id IN (SELECT )
// SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur1=utilisateur.id AND etat='ami' AND idUTilisateur2=? UNION SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur2=utilisateur.id AND etat='ami' AND idUTilisateur1=?
// Les deux paramètres sont le $_SESSION['id']

echo "<div class='groupe ami'>";
echo "<h4> Mes amis démons : </h4>";

    $sql = "SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur1=utilisateur.id AND etat='ami' AND idUTilisateur2=? UNION SELECT utilisateur.* FROM utilisateur INNER JOIN lien ON idUtilisateur2=utilisateur.id AND etat='ami' AND idUTilisateur1=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_SESSION['id'], $_SESSION['id']));
    echo "<ul>";
    while($line = $q->fetch()) {

        echo "<li>".lien("mur.php?id=".$line["id"], $line['login'])."</li>";
    }
    echo "</ul>";
echo "</div>";

?>

</div> <!-- fin container -->

<?php

include("pied.php");
?>