<?php
if(isset($_GET['search'])) 
{
	$sql = 'SELECT * FROM utilisateur WHERE login like ?';
   $q = $pdo->prepare($sql);
   $q->execute(array("%".$_GET['search']."%"));
   echo "<ul>";
   while($line = $q->fetch()) 
   {
   	echo "<li>".$line["login"]."<br />";
   	echo lien("../traitement/demanderamitie.php?id=".$line["id"], "Demander en ami")."</li>";
   }
   echo "</ul>";
}
// La requete de recherche de gens par rapport à leur login
// SELECT * FROM utilisateur WHERE login like "%?%'

// Le paramètre est le $_GET['nom']


?>