<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Devilbook</title>
  <link rel="stylesheet" href="../css/reset.css">
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php
// Ici il faut mettre l'entete de la page pour pas la réécrire à chaque fois !
// Style l'image du site
echo "<header>";
echo "<img src='logo.png' id='logo' alt='logo'>";
echo "<h3> Devilbook </h3>";
if(isset($_SESSION['id'])) { // On est loggé
    echo "<div id='login'>";
    echo "Bonjour ".$_SESSION['login']." ";
    echo lien("../traitement/deconnexion.php","Déconnexion");
    echo "</div>";
 }
  echo "</header>";
    
?>