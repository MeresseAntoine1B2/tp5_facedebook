<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");


// La requete de création de compte : INSERT INTO utilisateur VALUES(NULL,?,?)
// Le premier parametre de la requête est le login
// Le second parametre de la requete est le mot de passe
$sql = "SELECT * FROM utilisateur WHERE login=?";
$q = $pdo -> prepare($sql);
$q -> execute(array($_POST["login"]));

if($line = $q->fetch()) 
{
	header("Location:../affichage/login.php?inscription=error1");
}
elseif(isset($_POST["passwd"]) && isset($_POST["confpasswd"]) && isset($_POST["login"])) 
{
	if ($_POST["passwd"] != $_POST["confpasswd"])
		header("Location:../affichage/login.php?inscription=error2");
	else
	{
		$sql = "INSERT INTO utilisateur VALUES(NULL,?,?)";
		$query = $pdo -> prepare($sql);
		$query -> execute(array($_POST["login"], $_POST["passwd"]));
		
		$_SESSION["login"] = $_POST["login"];
		$sql = "SELECT LAST_INSERT_ID() FROM utilisateur";
		$query = $pdo -> prepare($sql);
		$query -> execute();
		$line = $query -> fetch();
		$_SESSION["id"] = $line["LAST_INSERT_ID()"];
		$_SESSION['login'] = $_POST['login'];
		
		echo $_SESSION["id"]." ".$_SESSION["login"];
		// Ca serait bien d'être loggé !
		// A la fin on retourne à la page d'amitié :  il faut bien se faire des amis !
		//header("Location:../affichage/ami.php");
		header("Location:../affichage/login.php");
	}
}
else 
{
	header("Location:../affichage/login.php?inscription=error3");
}
?>