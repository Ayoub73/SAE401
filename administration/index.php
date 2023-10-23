<!--  Script php général.  --->
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
		<title>Backoffice <?php echo $nom_utilisateur; ?></title>
		<meta charset="utf-8" />
		<!-- Ajout d'un favicon. --> 
		<link rel="shortcut icon" type="image/png" href="ressources_admin/medias/favicon-admin.png" alt="Favicon admin indisponible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="../ressources/css/style.css" />
		<!-- Ajout des feuiles de style supplémentaires pour la page Création. -->
		<link rel="stylesheet" href="../ressources/css/creations.css" />
		<link rel="stylesheet" href="ressources_admin/css/creations.css" />
		<link rel="stylesheet" href="ressources_admin/css/contact.css" />
		<link rel="stylesheet" href="ressources_admin/css/details.css" />
		<script defer src="ressources_admin/js/supprimer_creation.js"></script>
		<script defer src="ressources_admin/js/supprimer_message.js"></script>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
				<?php 

				$nom_utilisateur = $general["nom_utilisateur"];
				$prenom_utilisateur = $general["prenom_utilisateur"];
				$introduction_back_office = $general["introduction_back_office"];

				?>

				<header id="header">
					<div class="logo">
						<span class="icon fa-gem"></span>
					</div>
					<div class="content">
						<div class="inner">
							<h1><?php echo $prenom_utilisateur . " " . $nom_utilisateur; ?></h1>
							<p><?php echo $introduction_back_office; ?></p>
						</div>
    				</div>
					<nav>
					<ul>
						<li><a href="general.php">Général</a></li>
						<li><a href="deconnexion.php">Déconnexion</a></li>
					</ul>
					</nav>
					<nav>
					<ul>
						<li><a href="a_propos.php">À propos</a></li>
						<li><a href="cv.php">CV</a></li>
						<li><a href="#creations">Créations</a></li>		
    					<li><a href="#contact">Contact</a></li>
					</ul>
					</nav>
				</header>	

				<!-- Main -->
					<div id="main">	
					
						<!-- Créations. -->
						<?php require_once('creations.php');
						?>

						<!-- Contact. -->
						<?php require_once('contact.php');
						?>	

					</div>

				<!-- Footer -->
				<?php require_once('../ressources/includes/footer.php');
				?>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/browser.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>
