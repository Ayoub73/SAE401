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
    $message = $bdd -> prepare('SELECT * FROM contact WHERE id = ?');
    $message -> execute(array($getid));
    if($message -> rowCount() > 0)
    {
        	$supprimer_message = $bdd -> prepare('DELETE FROM contact WHERE id = ?');
            $supprimer_message -> execute(array($getid));

            header('Location: ../../index.php#contact');
    }
    else
    {
        header('Location: ../../index.php#contact');
    }
}
else
{
    header('Location: ../../index.php#contact');
}
?>