<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}
else 
{
	$sql = 'SELECT * FROM utilisateur WHERE login like "%?%"';
   $q = $pdo->prepare($sql);
   $q->execute(array($_GET['nom']));
   while($line = $q->fetch()) 
   {
   	// à compléter
   }
}
// La requete de recherche de gens par rapport à leur login
// SELECT * FROM utilisateur WHERE login like "%?%'

// Le paramètre est le $_GET['nom']


?>