<?php 
	session_start();
	if(!$_SESSION['mot_de_passe'])
	{
    header('Location: ../../connexion.php');
	}

	// Lien vers le fichier de connexion à la base de donnée.
	require_once("../../ressources/includes/connect_db.php");

	$general = $bdd -> query('SELECT * FROM general LIMIT 1');

	$general = $general->fetch();

	$nom_utilisateur = $general["nom_utilisateur"];

	// Requête SQL pour récupérer les données de la table "carte".
	$carte = $bdd -> query('SELECT * FROM carte LIMIT 1');

	// On effectue "fetch" sur $carte pour en faire un tableau.
	$carte = $carte->fetch();

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

<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Carte <?php echo $nom_utilisateur; ?></title>
		<meta charset="utf-8" />
		<!-- Ajout d'un favicon. --> 
		<link rel="shortcut icon" type="image/png" href="../ressources_admin/medias/favicon-admin.png" alt="Favicon admin indisponible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="../../ressources/css/fermer_notification.css" />
		<link rel="stylesheet" href="../ressources_admin/css/carte.css" />
		<script defer src="../../ressources/js/fermer_notification.js"></script>
		<script defer src="../ressources_admin/js/display.js"></script>
	</head>

	<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">
				
	<!-- Main -->
	<div id="main">

        <?php

        if (isset($_POST['enregistrer'])) {

        if(!empty($_POST['latitude']) && !empty($_POST['longitude']) && !empty($_POST['titre_survol']) 
        && !empty($_POST['titre']) && !empty($_POST['image_iut_alt']) && !empty($_POST['adresse']) 
		&& !empty($_POST['site_web']) && !empty($_POST['telephone'])) {

		$latitude_saisi = htmlentities($_POST['latitude']);
		$longitude_saisi = htmlentities($_POST['longitude']);
		$marqueur_icone_saisi = $_FILES['marqueur_icone']['name'];
		$marqueur_ombre_saisi = $_FILES['marqueur_ombre']['name'];
		$titre_survol_saisi = htmlentities($_POST['titre_survol']);
		$titre_saisi = htmlentities($_POST['titre']);
		$image_saisi = $_FILES['image_iut']['name'];
		$image_alt_saisi = htmlentities($_POST['image_iut_alt']);
		$adresse_saisi = htmlentities($_POST['adresse']);
		$site_web_saisi = htmlentities($_POST['site_web']);
		$telephone_saisi = htmlentities($_POST['telephone']);

		$chemin_marqueur_icone = '../../ressources/medias/' . $marqueur_icone_saisi;
        $chemin_marqueur_ombre = '../../ressources/medias/' . $marqueur_ombre_saisi;
		$chemin_image = '../../ressources/medias/' . $image_saisi;

		if(preg_match_all('!\d+(?:\.\d+)?!', $latitude_saisi) 
		&& preg_match_all('!\d+(?:\.\d+)?!', $longitude_saisi)) {

			if(move_uploaded_file($_FILES['marqueur_icone']['tmp_name'], $chemin_marqueur_icone)){


				$modifier_carte = $bdd->prepare('UPDATE carte SET latitude = ?, longitude = ?, 
				marqueur_icone = ?, titre_survol = ?, titre = ?, image_alt = ?, adresse = ?, 
				site_web = ?, telephone = ? LIMIT 1');
	
				$modifier_carte->execute(array($latitude_saisi, $longitude_saisi, 
				$marqueur_icone_saisi, $titre_survol_saisi, $titre_saisi, 
				$image_alt_saisi, $adresse_saisi, $site_web_saisi, $telephone_saisi));

				echo "<div id=containNotif>

				<section id=notificationValide>

				<p id=message_valide>Carte modifié ! <br>Mise à jour en cours...</p>
				<button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
				</section>

				<br><br>
		
				</div>";

        } 

        elseif(move_uploaded_file($_FILES['marqueur_ombre']['tmp_name'], $chemin_marqueur_ombre)){

			$modifier_carte = $bdd->prepare('UPDATE carte SET latitude = ?, longitude = ?, 
            marqueur_ombre = ?, titre_survol = ?, titre = ?, image_alt = ?, adresse = ?, 
			site_web = ?, telephone = ? LIMIT 1');

            $modifier_carte->execute(array($latitude_saisi, $longitude_saisi, 
            $marqueur_ombre_saisi, $titre_survol_saisi, $titre_saisi, 
			$image_alt_saisi, $adresse_saisi, $site_web_saisi, 
			$telephone_saisi));

			echo "<div id=containNotif>

			<section id=notificationValide>

			<p id=message_valide>Carte modifié ! <br>Mise à jour en cours...</p>
			<button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
			</section>

			<br><br>
		
			</div>";
        }

        elseif(move_uploaded_file($_FILES['image_iut']['tmp_name'], $chemin_image)){

					$modifier_carte = $bdd->prepare('UPDATE carte SET latitude = ?, longitude = ?, 
            		titre_survol = ?, titre = ?, image = ?, image_alt = ?, adresse = ?, site_web = ?, 
					telephone = ? LIMIT 1');

            		$modifier_carte->execute(array($latitude_saisi, $longitude_saisi, 
            		$titre_survol_saisi, $titre_saisi, $image_saisi, $image_alt_saisi, 
            		$adresse_saisi, $site_web_saisi, $telephone_saisi));

					echo "<div id=containNotif>

					<section id=notificationValide>

					<p id=message_valide>Carte modifié ! <br>Mise à jour en cours...</p>
					<button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
					</section>

					<br><br>
		
					</div>";

		}

					else {
					$modifier_carte = $bdd->prepare('UPDATE carte SET latitude = ?, longitude = ?, 
					titre_survol = ?, titre = ?, image_alt = ?, adresse = ?, site_web = ?, 
					telephone = ? LIMIT 1');
			
					$modifier_carte->execute(array($latitude_saisi, $longitude_saisi, $titre_survol_saisi, 
					$titre_saisi, $image_alt_saisi, $adresse_saisi, $site_web_saisi, $telephone_saisi));

					echo "<div id=containNotif>

					<section id=notificationValide>

					<p id=message_valide>Carte modifié ! <br>Mise à jour en cours...</p>
					<button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
					</section>

					<br><br>
		
					</div>";
					}

        } else{
			echo "<div id=containNotif>
                
            <section id=notificationInvalide>
    
            <p id=message_invalide>Entrez un ou des nombres valides...</p>
            <button id=bouton_fermer_erreur onclick=fermerNotification()>Fermer</button>
        
            </section>
    
            <br><br>
                
            </div>";
		}
        
	}
        else {
    
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
    
        }    
    
         ?>


        <h2 class="major">Modfier la carte</h2>
	    <form method="post" action="" enctype="multipart/form-data">
		<div class="fields">
	    	    <div class="field half">
				    	<label for="latitude">Latitude</label>
	     		    	<input type="text" name="latitude" value="<?php echo $latitude; ?>" id="latitude"/>
			    </div>

				<div class="field half">
				    	<label for="longitude">Longitude</label>
				    	<input type="text" name="longitude" value="<?php echo $longitude; ?>" id="longitude"/>
                </div>

                <div class="field half">
					<div class="marqueur_icone">
						<label for="marqueur_icone">Marqueur Icone</label>
						<img src="../../ressources/medias/<?php echo $marqueur_icone; ?>" onclick="triggerClick('#marqueur_icone')" id="marqueur_icone_display"/>
                		<input type="file" name="marqueur_icone" onchange="displayImage(this, '#marqueur_icone_display')" id="marqueur_icone" style="display: none;">
					</div>
				</div>

				<div class="field half">
					<div class="marqueur_ombre">
						<label for="marqueur_ombre">Marqueur Ombre</label>
						<img src="../../ressources/medias/<?php echo $marqueur_ombre; ?>" onclick="triggerClick('#marqueur_ombre')" id="marqueur_ombre_display"/>
                		<input type="file" name="marqueur_ombre" onchange="displayImage(this, '#marqueur_ombre_display')" id="marqueur_ombre" style="display: none;">
					</div>
				</div>

                <div class="field half">
                	<label for="name">Titre au survol</label>
	     			<input type="text" name="titre_survol" value="<?php echo $titre_survol; ?>" id="titre_au_survol" />
				</div>

				<div class="field half">
					<label for="titre">Titre</label>
					<input type="text" name="titre" value="<?php echo $titre; ?>" id="titre" />
                </div>

                <div class="field half">
					<div class="image_iut">
						<label for="image_iut">Image IUT</label>
						<img src="../../ressources/medias/<?php echo $image; ?>" onclick="triggerClick('#image_iut')" id="image_iut_display"/>
                		<input type="file" name="image_iut" onchange="displayImage(this, '#image_iut_display')" id="image_iut" style="display: none;">
					</div>
				</div>

				<div class="field half">
					<label for="image_iut_alt">Text alternatif pour l'image IUT</label>
					<input type="text" name="image_iut_alt" value="<?php echo $image_alt; ?>" id="image_iut_alt" />
                </div>

                <div class="field half">
                	<label for="adresse">adresse</label>
	     			<input type="text" name="adresse" value="<?php echo $adresse; ?>" id="adresse" />
				</div>

				<div class="field half">
					<label for="site_web">Site Web</label>
					<input type="text" name="site_web" value="<?php echo $site_web; ?>" id="site_web" />
				</div>

                <div class="field full">
					<label for="telephone">Téléphone IUT</label>
					<input type="text" name="telephone" value="<?php echo $telephone; ?>" id="telephone" placeholder="00 00 00 00 00" pattern="[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}" required/>
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