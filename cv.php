<!--  Script php pour le cv.  --->
<?php

// Requête SQL pour la table "cv".
$cv = $bdd -> query('SELECT * FROM cv LIMIT 1');

// Requête SQL pour la table "graphique".
$DBgraphique = $bdd -> query('SELECT * FROM graphique');

	// On effectue "fetch" sur $cv pour en faire un tableau.
    $cv = $cv->fetch();

	// On stocke dans des variables les données de la table "cv".
	$nom = $cv["nom"];
	$photo_profil = $cv["photo_profil"];
	$photo_profil_alt = $cv["photo_profil_alt"];
	$experience_professionelles = $cv["experience_professionelles"];
	$competences_techniques = $cv["competences_techniques"];
	$parcours_academique = $cv["parcours_academique"];
	$competences_comportementales = $cv["competences_comportementales"];
	$competences_linguistiques = $cv["competences_linguistiques"];
	$contactez_moi = $cv["contactez_moi"]; 
	$lien_pdf = $cv["lien_pdf"];
	$text_lien = $cv["text_lien"];
	$nom_pdf = $cv["nom_pdf"];	
	
	// Boucle foreach pour récupérer tout les tableaux de "$DBgraphique" séparement.
	foreach($DBgraphique as $graphique){
		// On récupère les tableaux de la base de donnée dans des tableaux php.
		$nom_formation[] = $graphique['nom_formation'];
		$niveau[] = $graphique['niveau'];
		$couleur_arriere_plan[] = $graphique['couleur_arriere_plan'];
		$couleur_bordure[] = $graphique['couleur_bordure'];
		$couleur_text[] = $graphique['couleur_text'];
	}

?>

<!--  Premier script JS pour les données graphiques il n'est pas dans un fichier séparé car on besoin de php.  --->
<script>
	// On recupère les tableaux php dans des tableaux javascript en parsant les données au format json.
	const nom_formation = <?php echo json_encode($nom_formation) ?>;
	const niveau = <?php echo json_encode($niveau) ?>;
	const couleur_arriere_plan = <?php echo json_encode($couleur_arriere_plan) ?>;
	const couleur_bordure = <?php echo json_encode($couleur_bordure) ?>;
	const couleur_text = <?php echo json_encode($couleur_text) ?>;
</script>

<!--  Balise article pour la partie cv.  --->
<article id="cv">

	<!--  Titre de la sous page en overlay.  --->
	<h2 class="major">CV</h2>

	<!--  On affiche le nom et le prénom, les expériences professionelles, 
	les compétences techniques, le parcours académique, des coordonnées de 
	contact et on place un bouton de téléchargement pour le CV.  --->

	<h2> <?php echo $nom ?> </h2>
	<div class="imageProfil"><img src="ressources/medias/<?php echo $photo_profil ?>" alt="<?php echo $photo_profil_alt ?>" /></div>
	<br><br>
	<h2>EXPÉRIENCES PROFESSIONNELLES</h2>
	<p><?php echo $experience_professionelles ?></p>	
	<br>
	<h2>COMPÉTENCES TECHNIQUES</h2>
	<p><?php echo $competences_techniques ?></p>
	<br>
	<div class="conteneur_du_graphique">
	<div class="graphique">
        <canvas id="myChart"></canvas>
	</div>
	</div>
	<br><br>
	<h2>PARCOURS ACADÉMIQUE</h2>
	<p><?php echo $parcours_academique ?></p>
	<br>
	<h2>COMPÉTENCES COMPORTEMENTALES</h2>
	<p><?php echo $competences_comportementales ?></p>
	<br>
	<h2>COMPÉTENCES LINGUISTIQUES</h2>
	<p><?php echo $competences_linguistiques ?></p>
	<br>
	<h2>CONTACTEZ-MOI</h2>
	<p><?php echo $contactez_moi ?></p>
	<br>
	<h2>TÉLÉCHARGER MON CV</h2>
	<a href="ressources/medias/<?php echo $lien_pdf ?>" download="<?php echo $nom_pdf ?>"><?php echo $text_lien?></a>
	
</article>