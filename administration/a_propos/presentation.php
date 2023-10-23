<?php 

session_start();
if(!$_SESSION['mot_de_passe'])
{
    header('Location: connexion.php');
}


// Lien vers le fichier de connexion à la base de donnée.
require_once("../../ressources/includes/connect_db.php");

$general = $bdd -> query('SELECT * FROM general LIMIT 1');

$general = $general->fetch();

$nom_utilisateur = $general["nom_utilisateur"];


?>

<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Présentation <?php echo $nom_utilisateur; ?></title>
		<meta charset="utf-8" />
		<!-- Ajout d'un favicon. --> 
		<link rel="shortcut icon" type="image/png" href="../ressources_admin/medias/favicon-admin.png" alt="Favicon admin indisponible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="../../ressources/css/fermer_notification.css" />
		<script defer src="../../ressources/js/fermer_notification.js"></script>
	</head>

	<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">
				
	<!-- Main -->
	<div id="main">


	<?php 

	// Lien vers le fichier de connexion à la base de donnée.
	require_once("../../ressources/includes/connect_db.php");

	// Requête SQL pour récupérer les données de la table "a_propos".
	$a_propos = $bdd -> query('SELECT * FROM a_propos LIMIT 1');

	// On effectue "fetch" sur $a_propos pour en faire un tableau.
	$a_propos = $a_propos->fetch();

	// On stocke le sous titre de la base de donnée dans une variable.
	$sous_titre = $a_propos["sous_titre"];

	// On stocke le paragraphe de la base de donnée dans une variable.
	$paragraphe = $a_propos["paragraphe"];



	if(isset($_POST["enregistrer"])){
	if (!empty($_POST["sous_titre"]) && !empty($_POST["paragraphe"])) {

	$sous_titre_saisi = htmlentities($_POST["sous_titre"]);

	$paragraphe_saisi = htmlentities($_POST["paragraphe"]);

	$modifier_a_propos = $bdd->prepare('UPDATE a_propos SET sous_titre = ?, paragraphe = ? LIMIT 1');

	$modifier_a_propos -> execute(array($sous_titre_saisi, $paragraphe_saisi));


	echo "<div id=containNotif>

	<section id=notificationValide>

	<p id=message_valide>Présentation modifié ! <br>Mise à jour en cours...</p>
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

	<h2>Présentation</h2>
	<form method="post" action="">
		<div class="fields">
	    	<div class="field full">
				<label for="name">Titre</label>
	     		<input type="text" name="sous_titre" value="<?php echo $sous_titre ?>" id="name" />
				</div>
				<div class="field full">
				<label for="message">Description</label>
				<textarea name="paragraphe" id="paragraphe" rows="10" ><?php echo $paragraphe ?></textarea>
			</div>
		</div>
        <ul class="actions">
	        <li><input type="submit" name="enregistrer" value="Enregistrer" class="primary" /></li>
			<li><a href="../a_propos.php">Retour</a></li>
	    </ul>
	</form>


</div>

				<!-- Footer -->
				<?php require_once('../../ressources/includes/footer.php');
				?>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="../../assets/js/jquery.min.js"></script>
			<script src="../../assets/js/breakpoints.min.js"></script>
			<script src="../../assets/js/util.js"></script>
			<script src="../../assets/js/main.js"></script>

	</body>
</html>