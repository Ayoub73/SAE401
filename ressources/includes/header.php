<?php 

$nom_utilisateur = $general["nom_utilisateur"];
$prenom_utilisateur = $general["prenom_utilisateur"];
$introduction_front_office = $general["introduction_front_office"];

?>

<header id="header">
				<div class="logo">
					<span class="icon fa-gem"></span>
				</div>
				<div class="content">
					<div class="inner">
						<!-- Titre de la page. -->
						<h1><?php echo $prenom_utilisateur . " " . $nom_utilisateur; ?></h1>
						<!-- Chapô. -->
						<p><?php echo $introduction_front_office; ?></p>
					</div>
				</div>
				<nav>
					<ul>
						<!-- Menu. -->
                        <li><a href="#a_propos">À propos</a></li>
						<li><a href="#cv">CV</a></li>
						<li><a href="#creations">Créations</a></li>			
						<li><a href="contact.php">Contact</a></li>
					</ul>
				</nav>
</header>