<?php
session_start();
if(!$_SESSION['mot_de_passe'])
{
    header('Location: connexion.php');
}

// Lien vers le fichier de connexion à la base de donnée.
require_once("../ressources/includes/connect_db.php");

$general = $bdd -> query('SELECT * FROM general LIMIT 1');

$general = $general->fetch();

$identifiant = $general["identifiant"];

$mot_de_passe = $general["mot_de_passe"];

$nom_utilisateur = $general["nom_utilisateur"];

$prenom_utilisateur = $general["prenom_utilisateur"];

$introduction_front_office = $general["introduction_front_office"];

$introduction_back_office = $general["introduction_back_office"];

$copyright = $general["copyright"];


?>

<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Général <?php echo $nom_utilisateur; ?></title>
		<meta charset="utf-8" />
		<!-- Ajout d'un favicon. --> 
		<link rel="shortcut icon" type="image/png" href="ressources_admin/medias/favicon-admin.png" alt="Favicon admin indisponible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="../ressources/css/fermer_notification.css" />
		<script defer src="../ressources/js/fermer_notification.js"></script>
	</head>

	<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">
				
	<!-- Main -->
	<div id="main">


	<?php

	if(isset($_POST["enregistrer"])){
	if (!empty($_POST["identifiant"]) && !empty($_POST["mot_de_passe"])
		&& !empty($_POST["nom_utilisateur"]) && !empty($_POST["prenom_utilisateur"]) 
		&& !empty($_POST["introduction_front_office"]) && !empty($_POST["introduction_back_office"]) 
		&& !empty($_POST["copyright"])) {

	$identifiant_saisi = htmlentities($_POST["identifiant"]);

	$mot_de_passe_saisi = htmlentities($_POST["mot_de_passe"]);

	$nom_utilisateur_saisi = htmlentities($_POST['nom_utilisateur']);

	$prenom_utilisateur_saisi = htmlentities($_POST['prenom_utilisateur']);

	$introduction_front_office_saisi = htmlentities($_POST['introduction_front_office']);

	$introduction_back_office_saisi = htmlentities($_POST['introduction_back_office']);

	$copyright_saisi = htmlentities($_POST['copyright']);

	$modifier_general = $bdd->prepare('UPDATE general SET identifiant = ?, mot_de_passe = ?, nom_utilisateur = ?, 
	prenom_utilisateur = ?, introduction_front_office = ?, introduction_back_office = ?, copyright = ? LIMIT 1');

	$modifier_general -> execute(array($identifiant_saisi, $mot_de_passe_saisi, 
	$nom_utilisateur_saisi, $prenom_utilisateur_saisi, $introduction_front_office_saisi, 
	$introduction_back_office_saisi, $copyright_saisi));


	echo "<div id=containNotif>

	<section id=notificationValide>

	<p id=message_valide>Informations générales modifié ! <br>Mise à jour en cours...</p>
	<button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
	</section>

	<br><br>

	</div>";
		
	} else {

	echo"<div id=containNotif>
		
	<section id=notificationInvalide>

	<p id=message_invalide>Veuillez compléter tous les champs...</p>
	<button id=bouton_fermer_erreur onclick=fermerNotification()>Fermer</button>

	</section>

	<br><br>
		
	</div>";
	
}

	$delay = 3; 
	header("Refresh: $delay;");

} ?>

	<h2>Général</h2>
	<form method="post" action="">
		<div class="fields">

			<div class="field half">
				<label for="identifiant">Identifiant</label>
	     		<input type="text" name="identifiant" value="<?php echo $identifiant; ?>" id="identifiant" />
			</div>

			<div class="field half">
				<label for="mot_de_passe">Mot de passe</label>
	     		<input type="text" name="mot_de_passe" value="<?php echo $mot_de_passe; ?>" id="mot_de_passe" />
			</div>

	    	<div class="field half">
				<label for="nom_utilisateur">Nom utilisateur</label>
	     		<input type="text" name="nom_utilisateur" value="<?php echo $nom_utilisateur; ?>" id="nom_utilisateur" />
			</div>

			<div class="field half">
				<label for="prenom_utilisateur">Prénom utilisateur</label>
	     		<input type="text" name="prenom_utilisateur" value="<?php echo $prenom_utilisateur; ?>" id="prenom_utilisateur" />
			</div>

			<div class="field half">
				<label for="introduction_front_office">Introduction Front Office</label>
				<textarea name="introduction_front_office" id="introduction_front_office" rows="10" ><?php echo $introduction_front_office ?></textarea>
			</div>

			<div class="field half">
				<label for="introduction_back_office">Introduction Back Office</label>
				<textarea name="introduction_back_office" id="introduction_back_office" rows="10" ><?php echo $introduction_back_office ?></textarea>
			</div>

			<div class="field full">
				<label for="copyright">Copyright</label>
	     		<input type="text" name="copyright" value="<?php echo $copyright ?>" id="copyright" />
			</div>
		</div>
        <ul class="actions">
	        <li><input type="submit" name="enregistrer" value="Enregistrer" class="primary" /></li>
			<li><a href="index.php">Retour</a></li>
	    </ul>
	</form>


</div>

				<!-- Footer -->
				<?php require_once('../ressources/includes/footer.php');
				?>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>







