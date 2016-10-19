<?php
session_start();

include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}

$date = date('Y-m-d H:i:s');
// Ecrire un message
$sql = "INSERT INTO ecrit VALUES (NULL, ?, ?, ?, ?, ?, ?)";
$q = $pdo->prepare($sql);
$q->execute(array($_POST["titre"], $_POST["contenu"], $date, 'NULL', $_SESSION["id"], $_POST["idAmi"]));

header("Location:".$_SERVER['HTTP_REFERER']);
?>