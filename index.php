<!--  Script php général.  --->
<?php 

// Lien vers le fichier de connexion à la base de donnée.
require_once("ressources/includes/connect_db.php");

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
		<title>Portfolio <?php echo $nom_utilisateur ?></title>
		<meta charset="utf-8" />
		<!-- Ajout d'un favicon. --> 
		<link rel="shortcut icon" type="image/png" href="ressources/medias/favicon.png" alt="Favicon indisponible.">
		<!-- Ajout des feuilles de style pour l'API Leaflet. -->
		<link rel="stylesheet" href="ressources/api/leaflet/leaflet.css"/>
		<!-- Ajout des feuiles de style supplémentaires pour la balise <article>. -->
		<link rel="stylesheet" href="ressources/css/style.css" />
		<!-- Ajout des feuiles de style supplémentaires pour la page À propos. -->
		<link rel="stylesheet" href="ressources/css/a_propos.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!-- Ajout des feuiles de style supplémentaires pour la page CV. -->
		<link rel="stylesheet" href="ressources/css/cv.css" />
		<!-- Ajout des feuiles de style supplémentaires pour la page Création. -->
		<link rel="stylesheet" href="ressources/css/creations.css" />
		<!-- Ajout des feuiles de style supplémentaires pour la page Contact. -->
		<link rel="stylesheet" href="ressources/css/fermer_notification.css" />
		<link rel="stylesheet" href="ressources/css/contact.css" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<!-- Ajout de l'API Leaflet. -->
		<script src="ressources/api/leaflet/leaflet.js" defer></script>
    	<script src="ressources/api/leaflet/leaflet-src.js" defer></script>
		<!-- Ajout du script JS pour la page À propos. -->
    	<script defer src="ressources/js/a_propos.js"></script>
		<!-- Ajout de l'API Chart JS. -->
		<script defer src="https://cdn.jsdelivr.net/npm/chart.js"></script>
		<!-- Ajout de l'extension ChartDataLabels pour l'API Chart JS. -->
		<script defer
		src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" 
		integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" 
		crossorigin="anonymous" referrerpolicy="no-referrer">
		</script>
		<!-- Ajout du script JS pour la page CV. -->
    	<script defer src="ressources/js/cv.js"></script>
		<!-- Ajout du script JS pour la page Contact. -->
		<script defer src="ressources/js/fermer_notification.js"></script>
	</head>
	<body class="is-preload">

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header. -->
				<?php require_once('ressources/includes/header.php');
				?>	

				<!-- Main -->
					<div id="main">	

						<!-- À propos. -->
						<?php require_once('a_propos.php');
						?>	

						<!-- CV. -->
						<?php require_once('cv.php');
						?>

						<!-- Création. -->
						<?php require_once('creations.php');
						?>	

					</div>

				<!-- Footer. -->
				<?php require_once('ressources/includes/footer.php');
				?>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
