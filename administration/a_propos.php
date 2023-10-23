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
		<title>À propos <?php echo $nom_utilisateur; ?></title>
		<meta charset="utf-8" />
		<!-- Ajout d'un favicon. --> 
		<link rel="shortcut icon" type="image/png" href="ressources_admin/medias/favicon-admin.png" alt="Favicon admin indisponible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="../ressources/css/style.css" />
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
				<header id="header">
					<div class="logo">
					<span class="icon fa-gem"></span>
					</div>
					<div class="content">
					<div class="inner">
					<h1>À propos</h1>
					</div>
    				</div>
					<nav>
						<ul>
							<li><a href="index.php">Accueil</a></li>
							<li><a href="a_propos/presentation.php">Présentation</a></li>
							<li><a href="a_propos/carte.php">Carte</a></li>
						</ul>
					</nav>
				</header>	

				<!-- Footer -->
				<?php require_once('../ressources/includes/footer.php');
				?>

			</div>../

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

