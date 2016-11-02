<?php
session_start();
include("../divers/connexion.php");
include("../divers/balises.php");

if(!isset($_SESSION['id'])) {
	// On n'est pas connecté, il faut retourner à la pgae de login
	header("Location:login.php");
}


include("entete.php");
include("menu.php");

	
	$sql="SELECT * FROM utilisateur where id=?";
	$who = $pdo->prepare ($sql);
	$who -> execute(array($_GET['id']));
	$line = $who -> fetch();
	echo "<h1>Mur de ".$line['login']."</h1>";
   echo "<div class='container'>";
	
if(!isset($_GET['id']) || !is_numeric($_GET['id'])) {
	// On n a pas donné le numéro de l'id de la personne dont on veut afficher le mur.
	// On affiche un message et on meurt
	echo "Bizarre !!!!";die(1);
}

// On veut afficher notre mur ou celui d'un de nos amis et pas faire n'importe quoi 

$ok = false;
if($_GET['id']==$_SESSION['id']) {
	$ok = true; // C notre mur, pas de soucis
} else {
	// Verifions si on est amis avec cette personne
	$sql = "SELECT * FROM lien WHERE etat='ami' 
		AND ((idUtilisateur1=? AND idUtilisateur2=?) OR ((idUtilisateur1=? AND idUtilisateur2=?)))";
	$ami = $pdo->prepare($sql);
	$ami -> execute(array($_GET['id'],$_SESSION['id'],$_SESSION['id'],$_GET['id']));
	$line= $ami -> fetch();
	if ($line!==false) {
	$ok = true;
	}	
	 
	
	// les deux ids à tester sont : $_GET['id'] et $_SESSION['id']		
	// A completer. Il faut récupérer une ligne, si il y en a pas ca veut dire que l'on est pas ami avec cette personne
	

	

 }
if($ok==false) {
	echo "<br/> Vous n'êtes pas encore ami, vous ne pouvez voir son mur !!<br/> ".lien('../traitement/demanderamitie.php?id='.$_GET['id'],'Demander en ami');
} else {

// Tout va bien, il maintenant possible d'afficher le mur en question.
// A completer
// Requête de sélection des éléments d'un mur
// le paramètre  est le $_GET['id']

 $sql="SELECT * FROM ecrit WHERE idAmi=?";
 $querry = $pdo->prepare ($sql);
 $querry -> execute(array($_GET['id']));
 
 while ($line = $querry -> fetch()){
	echo "<h2> ";
	echo $line['titre']."<br/>";
	echo "</h2><p class='txtmur'> ";
	echo $line['contenu']."</p>";
 
	$sql="SELECT * FROM utilisateur where id=?";
	$q = $pdo->prepare ($sql);
	$q -> execute(array($line['idAuteur']));
	 $line2 = $q -> fetch();
		echo '<p class="qui">Ecrit par ';
	echo lien('mur.php?id='.$line['idAuteur'],$line2['login']);	
		echo " le ";
	echo $line['dateEcrit'];
    echo "<br/>";
	if($_SESSION['id'] == $_GET['id'] || $_SESSION['id'] == $line['idAuteur']){
	echo lien("../traitement/effacer.php?id=".$line['id'],"Supprimer");
		echo "</p>" ;
	}
	
}





?>

<form action="../traitement/ecrire.php" method="POST">
	<input type="text" name="titre" placeholder="Titre" id="titremur"><br>
	<input type="hidden" name="idAmi" value="<?php echo $_GET['id'];?>"><br>	
	<textarea placeholder="Parle nous de tes exploits démoniaques" name="contenu" id="txtboxmur"></textarea><br/>
	<input type="submit" name="Envoyer" value="Envoyer">
</form>	
</div> <!-- fin container -->
<?php
} // else pas ami 
// On termine par le pied de page

include("pied.php");


?>