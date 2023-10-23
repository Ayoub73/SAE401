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
    $creations = $bdd -> prepare('SELECT * FROM creations WHERE id = ?');
    $creations -> execute(array($getid));
    if($creations -> rowCount() > 0)
    {
        	$supprimer_creation = $bdd -> prepare('DELETE FROM creations WHERE id = ?');
            $supprimer_creation -> execute(array($getid));

            header('Location: ../../index.php#creations');
    }
    else
    {
        header('Location: ../../index.php#creations');
    }
}
else
{
    header('Location: ../../index.php#creations');
}
?>