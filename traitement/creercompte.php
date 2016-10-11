<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");


// La requete de création de compte : INSERT INTO utilisateur VALUES(NULL,?,?)
// Le premier parametre de la requête est le login
// Le second parametre de la requete est le mot de passe

$sql = "INSERT INTO utilisateur VALUES(NULL,?,?)";
$query = $pdo -> prepare($sql);
$query -> execute(array($_POST["login"], $_POST["mdp"]));

$_SESSION["login"] = $_POST["login"];
$sql = "SELECT LAST_INSERT_ID() FROM utilisateur";
$query = $pdo -> prepare($sql);
$query -> execute();
$line = $query -> fetch();
$_SESSION["id"] = $line["id"];
// Ca serait bien d'être loggé !
// A la fin on retourne à la page d'amitié :  il faut bien se faire des amis !
header("Location:affichage/ami.php");
?>