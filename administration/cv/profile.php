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

    // Requête SQL pour la table "cv".
    $cv = $bdd -> query('SELECT * FROM cv LIMIT 1');

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

?>

<script>
	// On recupère les tableaux php dans des tableaux javascript en parsant les données au format json.
	const lien_pdf = <?php echo json_encode($lien_pdf) ?>;
</script>

<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Profile <?php echo $nom_utilisateur; ?></title>
		<meta charset="utf-8" />
		<!-- Ajout d'un favicon. --> 
		<link rel="shortcut icon" type="image/png" href="../ressources_admin/medias/favicon-admin.png" alt="Favicon admin indisponible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../../assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="../../ressources/css/fermer_notification.css" />
		<link rel="stylesheet" href="../ressources_admin/css/profile.css" />
		<script defer src="../../ressources/js/fermer_notification.js"></script>
		<script defer src="../ressources_admin/js/profile.js"></script>
		<script defer src="../ressources_admin/js/display.js"></script>
	</head>

	<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">
				
	<!-- Main -->
	<div id="main">

        <?php

        require_once("../../ressources/includes/connect_db.php");

        if (isset($_POST['enregistrer'])) {

        if(!empty($_POST['nom']) && !empty($_POST['photo_profil_alt']) && !empty($_POST['experience_professionelles']) 
        && !empty($_POST['competences_techniques']) && !empty($_POST['parcours_academique']) 
        && !empty($_POST['competences_comportementales']) && !empty($_POST['competences_linguistiques']) 
        && !empty($_POST['contactez_moi']) && !empty($_POST['text_lien']) && !empty($_POST['nom_pdf'])) {

        $nom_saisi = htmlentities($_POST['nom']);          
        $photo_profil_saisi = $_FILES['photo_profil']['name'];
        $photo_profil_alt_saisi = htmlentities($_POST['photo_profil_alt']);
        $experience_professionelles_saisi = htmlentities($_POST['experience_professionelles']);
        $competences_techniques_saisi = htmlentities($_POST['competences_techniques']);
        $parcours_academique_saisi = htmlentities($_POST['parcours_academique']);
        $competences_comportementales_saisi = htmlentities($_POST['competences_comportementales']);
        $competences_linguistiques_saisi = htmlentities($_POST['competences_linguistiques']);
        $contactez_moi_saisi = htmlentities($_POST['contactez_moi']);
        $lien_pdf_saisi = $_FILES['lien_pdf']['name'];
        $text_lien_saisi = htmlentities($_POST['text_lien']);
        $nom_pdf_saisi = htmlentities($_POST['nom_pdf']);

        $chemin_photo_profil = '../../ressources/medias/' . $photo_profil_saisi;
        $chemin_pdf = '../../ressources/medias/' . $lien_pdf_saisi;
    
            // Premier cas de figure où les 2 medias ont étés entrés.
    
        if (move_uploaded_file($_FILES['photo_profil']['tmp_name'], $chemin_photo_profil) && 
            move_uploaded_file($_FILES['lien_pdf']['tmp_name'], $chemin_pdf)) {
                $modifier_profil = $bdd->prepare('UPDATE cv SET nom = ?, photo_profil = ?, 
            photo_profil_alt = ?, experience_professionelles = ?, competences_techniques = ?, 
            parcours_academique = ?, competences_comportementales = ?, competences_linguistiques = ?, 
            contactez_moi = ?, lien_pdf = ?, text_lien = ?, nom_pdf = ? LIMIT 1');

            $modifier_profil->execute(array($nom_saisi, $photo_profil_saisi, 
            $photo_profil_alt_saisi, $experience_professionelles_saisi, $competences_techniques_saisi, 
            $parcours_academique_saisi, $competences_comportementales_saisi, $competences_linguistiques_saisi, 
            $contactez_moi_saisi, $lien_pdf_saisi, $text_lien_saisi, $nom_pdf_saisi));
 
		
		    echo "<div id=containNotif>
		
		    <section id=notificationValide>

		    <p id=message_valide>Profile modifié ! <br>Mise à jour en cours...</p>
		    <button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
		    </section>

		    <br><br>
		
	    	</div>";
                
            } 
        
            // Deuxième cas de figure où la photo de profil à été modifié mais pas le pdf.
        
            elseif(move_uploaded_file($_FILES['photo_profil']['tmp_name'], $chemin_photo_profil)){

            $modifier_profil = $bdd->prepare('UPDATE cv SET nom = ?, photo_profil = ?, 
            photo_profil_alt = ?, experience_professionelles = ?, competences_techniques = ?, 
            parcours_academique = ?, competences_comportementales = ?, competences_linguistiques = ?, 
            contactez_moi = ?, text_lien = ?, nom_pdf = ? LIMIT 1');

            $modifier_profil->execute(array($nom_saisi, $photo_profil_saisi, 
            $photo_profil_alt_saisi, $experience_professionelles_saisi, $competences_techniques_saisi, 
            $parcours_academique_saisi, $competences_comportementales_saisi, $competences_linguistiques_saisi, 
            $contactez_moi_saisi, $text_lien_saisi, $nom_pdf_saisi)); 
		
		    echo "<div id=containNotif>
		
		    <section id=notificationValide>

		    <p id=message_valide>Profile modifié ! <br>Mise à jour en cours...</p>
		    <button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
		    </section>

		    <br><br>
		
	    	</div>";

        } 

        // Troisième cas de figure où le pdf à été modifié mais pas la photo de profil.

        elseif(move_uploaded_file($_FILES['lien_pdf']['tmp_name'], $chemin_pdf)){

            $modifier_profil = $bdd->prepare('UPDATE cv SET nom = ?, photo_profil_alt = ?, 
            experience_professionelles = ?, competences_techniques = ?, parcours_academique = ?, 
            competences_comportementales = ?, competences_linguistiques = ?, contactez_moi = ?, 
            lien_pdf = ?, text_lien = ?, nom_pdf = ? LIMIT 1');

            $modifier_profil->execute(array($nom_saisi, $photo_profil_alt_saisi, $experience_professionelles_saisi, 
            $competences_techniques_saisi, $parcours_academique_saisi, $competences_comportementales_saisi, 
            $competences_linguistiques_saisi, $contactez_moi_saisi, $lien_pdf_saisi, $text_lien_saisi, 
            $nom_pdf_saisi));
		
		    echo "<div id=containNotif>
		
		    <section id=notificationValide>

		    <p id=message_valide>Profile modifié ! <br>Mise à jour en cours...</p>
		    <button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
		    </section>

		    <br><br>
		
	    	</div>";

        }

        // 4ème cas de figure où ni la photo de profile, ni le pdf sont entrés.

        elseif(!move_uploaded_file($_FILES['photo_profil']['tmp_name'], $chemin_photo_profil) && 
                !move_uploaded_file($_FILES['lien_pdf']['tmp_name'], $chemin_pdf)){

                    $modifier_profil = $bdd->prepare('UPDATE cv SET nom = ?, photo_profil_alt = ?, 
                     experience_professionelles = ?, competences_techniques = ?, parcours_academique = ?, 
                     competences_comportementales = ?, competences_linguistiques = ?, contactez_moi = ?, 
                     text_lien = ?, nom_pdf = ? LIMIT 1');

                     $modifier_profil->execute(array($nom_saisi, $photo_profil_alt_saisi, $experience_professionelles_saisi, 
                     $competences_techniques_saisi, $parcours_academique_saisi, $competences_comportementales_saisi, 
                     $competences_linguistiques_saisi, $contactez_moi_saisi, $text_lien_saisi, 
                     $nom_pdf_saisi)); 
		
		    echo "<div id=containNotif>
		
		    <section id=notificationValide>

		    <p id=message_valide>Profile modifié ! <br>Mise à jour en cours...</p>
		    <button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
		    </section>

		    <br><br>
		
	    	</div>";


        }

        }
        
        
        else {

            // 5ème cas de figure où un champ autre que la photo et le pdf sont vide.
    
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

        <h2 class="major">Modfier le Profile</h2>
	    <form method="post" action="" enctype="multipart/form-data">
		<div class="fields">

	    		<div class="field half">
				<label for="nom">Titre</label>
	     		<input type="text" name="nom" value="<?php echo $nom; ?>" id="nom" />
				</div>

				<div class="field half">
				<div class="photo_profil">
				<label for="photo_profil">Photo de profil</label>
				<img src="../../ressources/medias/<?php echo $photo_profil; ?>" onclick="triggerClick('#photo_profil')" id="profileDisplay"/>
                <input type="file" name="photo_profil" onchange="displayImage(this, '#profileDisplay')" id="photo_profil" style="display: none;">
				</div>
				</div>

				<div class="field half">
				<label for="photo_profil_alt">Photo de profil Alt</label>
				<input type="text" name="photo_profil_alt" value="<?php echo $photo_profil_alt; ?>" id="photo_profil_alt" />
				</div>

				<div class="field half">
				<label for="experience_professionelles">Éxperience professionelles</label>
				<textarea name="experience_professionelles" id="experience_professionelles" rows="7"><?php echo $experience_professionelles; ?></textarea>
				</div>

				<div class="field half">
				<label for="competences_techniques">Compétences techniques</label>
				<textarea name="competences_techniques" id="competences_techniques" rows="4"><?php echo $competences_techniques; ?></textarea>
				</div>

				<div class="field half">
				<label for="parcours_academique">Parcours academique</label>
				<textarea name="parcours_academique" id="parcours_academique" rows="7"><?php echo $parcours_academique; ?></textarea>
				</div>

				<div class="field half">
				<label for="competences_comportementales">Compétences comportementales</label>
				<textarea name="competences_comportementales" id="competences_comportementales" rows="4"><?php echo $competences_comportementales; ?></textarea>
				</div>

				<div class="field half">
				<label for="competences_linguistiques">Compétences linguistiques</label>
				<textarea name="competences_linguistiques" id="competences_linguistiques" rows="4"><?php echo $competences_linguistiques; ?></textarea>
				</div>

				<div class="field half">
				<label for="contactez_moi">Contactez moi</label>
				<textarea name="contactez_moi" id="contactez_moi" rows="4"><?php echo $contactez_moi; ?></textarea>
				</div>
				
				<div class="field half">
				<label for="lien_pdf">PDF</label>
                <input type="file" name="lien_pdf" id="lien_pdf" class="form-control">
				</div>

				<div class="field half">
				<label for="nom_pdf">Nom pdf</label>
				<input type="text" name="nom_pdf" value="<?php echo $nom_pdf; ?>" id="nom_pdf" />
				</div>

				<div class="field half">
				<label for="text_lien">Text lien</label>
				<input type="text" name="text_lien" value="<?php echo $text_lien; ?>" id="text_lien" />
				</div>
				</div>
				
        <ul class="actions">
	        <li><input type="submit" name="enregistrer" value="Enregistrer" class="primary" /></li>
	        <li><a href="../cv.php">Retour</a></li>
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