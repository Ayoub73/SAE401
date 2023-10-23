<?php
session_start();
if(!$_SESSION['mot_de_passe'])
{
    header('Location: ../../connexion.php');
}

require_once("../../../ressources/includes/connect_db.php");
if(isset($_GET['id']) && !empty($_GET['id']))
{
    $getid = $_GET['id'];
    $graphique = $bdd -> prepare('SELECT * FROM graphique WHERE id = ?');
    $graphique -> execute(array($getid));
    if($graphique -> rowCount() > 0)
    {
        	$deleteGraphique = $bdd -> prepare('DELETE FROM graphique WHERE id = ?');
            $deleteGraphique -> execute(array($getid));

            header('Location: ../../cv.php#graphique');
    }
    else
    {
        header('Location: ../../cv.php#graphique');
    }
}
else
{
    header('Location: ../../cv.php#graphique');
}
?>