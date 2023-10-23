<!--  Script php.  --->
<?php

    // Requête SQL pour récupérer les données de la table "a_propos".
    $a_propos = $bdd -> query('SELECT * FROM a_propos LIMIT 1');

    // On effectue "fetch" sur $a_propos pour en faire un tableau.
    $a_propos = $a_propos->fetch();

    // Requête SQL pour récupérer les données de la table "carte".
    $carte = $bdd -> query('SELECT * FROM carte LIMIT 1');

    // On effectue "fetch" sur $carte pour en faire un tableau.
    $carte = $carte->fetch();
    
    // On stocke le sous titre de la base de donnée dans une variable.
    $sous_titre = $a_propos["sous_titre"];

    // On stocke le paragraphe de la base de donnée dans une variable.
    $paragraphe = $a_propos["paragraphe"];

    // On stocke les données pour la carte Leaflet de la base de donnée dans des variable.
    $latitude = $carte["latitude"];
    $longitude = $carte["longitude"];
    $marqueur_icone = $carte["marqueur_icone"];
    $marqueur_ombre = $carte["marqueur_ombre"];
    $titre_survol = $carte["titre_survol"];
    $titre = $carte["titre"];
    $image = $carte["image"];
    $image_alt = $carte["image_alt"];
    $adresse = $carte["adresse"];
    $site_web = $carte["site_web"];
    $telephone = $carte["telephone"]; 

?>

<script>
    // On recupère les tableaux php dans des tableaux javascript en parsant les données au format json.
	const latitude = <?php echo json_encode($latitude) ?>;
	const longitude = <?php echo json_encode($longitude) ?>;
	const marqueur_icone = <?php echo json_encode($marqueur_icone) ?>;
	const marqueur_ombre = <?php echo json_encode($marqueur_ombre) ?>;
	const titre_survol = <?php echo json_encode($titre_survol) ?>;
    const titre = <?php echo json_encode($titre) ?>;
	const image = <?php echo json_encode($image) ?>;
	const image_alt = <?php echo json_encode($image_alt) ?>;
	const adresse = <?php echo json_encode($adresse) ?>;
	const site_web = <?php echo json_encode($site_web) ?>;
    const telephone = <?php echo json_encode($telephone) ?>;
</script>

<!--  Balise article pour la partie À propos.  --->
<article id="a_propos">
    
    <!--  Titre de la sous page en overlay.  --->
	<h2 class="major">  À propos  </h2>
    <h3 class="major">  <?php echo $sous_titre ?>  </h3>
    <p><?php echo $paragraphe ?></p>
    <h3 class="major">  Lieu de formation  </h3> 
    <div id="map"></div>
    
</article>