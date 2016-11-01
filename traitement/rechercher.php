<?php
if(isset($_GET['search'])) 
{
	$sql = 'SELECT * FROM utilisateur WHERE login like ?';
   $q = $pdo->prepare($sql);
   $q->execute(array("%".$_GET['search']."%"));
   while($line = $q->fetch()) 
   {
   	echo $line["login"]."<br />";
   	echo lien("../traitement/demanderamitie.php?id=".$line["id"], "Demander en ami")."<br />";
   }
}
// La requete de recherche de gens par rapport à leur login
// SELECT * FROM utilisateur WHERE login like "%?%'

// Le paramètre est le $_GET['nom']


?>