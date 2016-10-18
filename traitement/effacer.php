<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}

	$sql = 'DELETE FROM ecrit where id=? AND (idAuteur=? OR idAmi=?)'; // vérifie qu'on est bien l'auteur du post a supprimer ou qu'il est sur notre mur
   $q = $pdo->prepare($sql);
   $q->execute(array($_GET['id'], $_SESSION["id"], $_SESSION["id"]));
   
// La requete de suppression d'un écrit (il faut le donner en get : DELETE FROM ecrit where id=?
// Le paramètre est le $_GET['id']

// A la fin on retourne d'où on vient
header("Location:".$_SERVER['HTTP_REFERER']);

?>