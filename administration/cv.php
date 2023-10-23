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
		<title>CV <?php echo $nom_utilisateur; ?></title>
		<meta charset="utf-8" />
		<!-- Ajout d'un favicon. --> 
		<link rel="shortcut icon" type="image/png" href="ressources_admin/medias/favicon-admin.png" alt="Favicon admin indisponible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="../ressources/css/style.css" />
		<link rel="stylesheet" href="../ressources/css/fermer_notification.css">
		<link rel="stylesheet" href="ressources_admin/css/details.css">
		<link rel="stylesheet" href="ressources_admin/css/graphique.css">		
		<script dfeer src="../ressources/js/fermer_notification.js"></script>
		<script defer src="ressources_admin/js/supprimer_competence.js"></script>
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
					<h1>CV</h1>
					</div>
    				</div>
						<nav>
							<ul>
								<li><a href="index.php">Accueil</a></li>
								<li><a href="cv/profile.php">Profile</a></li>
								<li><a href="#graphique">Graphique</a></li>
							</ul>
						</nav>
				</header>	

					<!-- Main -->
					<div id="main">

					<!-- Compétences. -->
					<?php

					// Requête SQL pour la table "graphique".
					$DBgraphique = $bdd -> query('SELECT * FROM graphique');

					?>



					<article id="graphique">
					<h2 class="major">Compétences</h2>


					<details open>
    				<summary><h3>Voir les compétences</h3></summary>
    				<!--  Balise <table> pour afficher les données sous forme de tableau.  --->
					<table class="table-style">

					<thead>
            		<td>
                		<th>Nom formation</th>
                		<th>Niveau</th>
                		<th>Couleur arrière plan / bordure / text</th>
           			 </td>
        			</thead>

					<!--  Script php pour afficher les projets.  --->
					<?php

					// Boucle While qui affiche les projets tant qu'il y'a des données.
					while($graphique = $DBgraphique -> fetch())
					{
					?>            

					<tbody>
					<!--  On affiche le titre, l'image et le paragraphe du projet.  --->
					<td>
					<td><?= $graphique['nom_formation']; ?>  <br><br> <a href="ressources_admin/includes/modifier_graphique.php?id=<?= $graphique['id']; ?>" id="modifier_competence">Modifier</a>
					<br><a href="ressources_admin/includes/supprimer_graphique.php?id=<?= $graphique['id']; ?>" onclick="return supprimer_competence()" id="supprimer_competence">Supprimer</a></td>
					<td><?= $graphique['niveau']." %"; ?></td>
					<td><?= $graphique['couleur_arriere_plan']; ?> / <?= $graphique['couleur_bordure']; ?> / <?= $graphique['couleur_text']; ?></td>
					</td>
					</tbody>       

					<?php
					} 

					?>

					</table>

					</details>

					<br><br>

					<a href="ressources_admin/includes/ajouter_competence.php">Ajouter</a>

					</article>	

						

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
