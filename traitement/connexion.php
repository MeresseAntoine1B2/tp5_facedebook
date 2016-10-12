<?php
session_start();
//Celui la ressemble au TD4 exo 3. 
// A vous l'honneur

if(isset($_POST['login'])) 
{ // Le formulaire a été soumis
    $sql = "SELECT * FROM utilisateur WHERE login=? AND passwd=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($_POST['login'],$_POST['password']));
    $line = $q->fetch();
    if($line != false)
    {
        $_SESSION['login'] = $_POST['login'];
        $_SESSION['id'] = $line['id'];
        header("Location:mur.php?id=".$_SESSION['id']);
    }
}
// Si ça marche on est redirigé vers son mur

?>