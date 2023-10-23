<?php 

session_start();
if(!$_SESSION['mot_de_passe'])
{
    header('Location: ../../connexion.php');
}

?>

<!DOCTYPE HTML>
<!--
	Dimension by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Modfier la création</title>
		<meta charset="utf-8" />
		<!-- Ajout d'un favicon. --> 
		<link rel="shortcut icon" type="image/png" href="../medias/favicon-admin.png" alt="Favicon admin indisponible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../../../assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="../../../ressources/css/fermer_notification.css" />
		<link rel="stylesheet" href="../css/creations.css" />
		<script defer src="../js/display.js"></script>
		<script defer src="../../../ressources/js/fermer_notification.js"></script>
	</head>

	<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">
				
	<!-- Main -->
	<div id="main">

<?php

require_once("../../../ressources/includes/connect_db.php");

if(isset($_GET['id']) && !empty($_GET['id'])){
    $getid = $_GET['id'];

    // Requête SQL pour la table "creations".
    $DBcreations = $bdd -> prepare('SELECT * FROM creations WHERE id = ?');
    $DBcreations -> execute(array($getid));

    
    if($DBcreations -> rowCount() > 0){

        $creations = $DBcreations -> fetch();

        $titre = $creations['titre'];
        $image = $creations['image'];
        $image_alt = $creations['image_alt'];
		$categorie = $creations['categorie'];
        $paragraphe = $creations['paragraphe'];

		if(isset($_POST['enregistrer'])){
                        
        $titre_saisi = htmlentities($_POST['titre']);
        $image_saisi = htmlentities($_FILES['image']['name']);
        $image_alt_saisi = htmlentities($_POST['image_alt']);
		$categorie_saisi = htmlentities($_POST['categorie']);
        $paragraphe_saisi = htmlentities($_POST['paragraphe']);

		$chemin_image = '../../../ressources/medias/' . $image_saisi;

        if(!empty($_POST['titre']) && move_uploaded_file($_FILES['image']['tmp_name'], $chemin_image) 
           && !empty($_POST['image_alt']) && !empty($_POST['categorie']) && !empty($_POST['paragraphe'])){
                   

        $modifier_creation = $bdd->prepare('UPDATE creations SET titre = ?, image = ?, image_alt = ?, categorie = ?, paragraphe = ? WHERE id = ?');
        $modifier_creation->execute(array($titre_saisi, $image_saisi, $image_alt_saisi, $categorie_saisi, $paragraphe_saisi, $getid));
		
		echo "<div id=containNotif>
		
		<section id=notificationValide>

		<p id=message_valide>Création modifié ! <br>Mise à jour en cours...</p>
		<button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
		</section>

		<br><br>
		
		</div>";


		} elseif(!empty($_POST['titre']) && !empty($_POST['image_alt']) && !empty($_POST['categorie']) && !empty($_POST['paragraphe'])) {

        $modifier_creation = $bdd->prepare('UPDATE creations SET titre = ?, image_alt = ?, categorie = ?, paragraphe = ? WHERE id = ?');
        $modifier_creation->execute(array($titre_saisi, $image_alt_saisi, $categorie_saisi, $paragraphe_saisi, $getid));
		
		echo "<div id=containNotif>
		
		<section id=notificationValide>

		<p id=message_valide>Création modifié ! <br>Mise à jour en cours...</p>
		<button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
		</section>

		<br><br>
		
		</div>";

        } else{
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
        }

    } else {

        header('Location: ../../index.php#creations');
    
	}

?>
                    
	<h2 class="major">Modifier <?php echo $titre; ?></h2>

	<br><br>

    <form method="post" action="" enctype="multipart/form-data">
		<div class="fields">

	    		<div class="field half">
				<label for="titre">Titre</label>
	     		<input type="text" name="titre" value="<?php echo $titre; ?>" id="titre" />
				</div>

				<div class="field half">
					<div class="illustration">
						<label for="illustration">Image</label>
						<img src="../../../ressources/medias/<?php echo $image; ?>" onclick="triggerClick('#illustration')" id="illustration_display"/>
                		<input type="file" name="image" onchange="displayImage(this, '#illustration_display')" id="illustration" style="display: none;">
					</div>
				</div>

				<div class="field half">
				<label for="image_alt">Image Alt</label>
				<input type="text" name="image_alt" value="<?php echo $image_alt; ?>" id="image_alt" />
				</div>

				<div class="field half">
					<label for="categorie">Catégorie</label>
					<select name="categorie" id="categorie">
  						<option value="Développement web">Développement web</option>
 						<option value="Stratégie de communication">Stratégie de communication</option>
  						<option value="Création numérique">Création numérique</option>
					</select>
				</div>

				<div class="field full">
				<label for="paragraphe">Paragraphe</label>
				<textarea name="paragraphe" id="paragraphe" rows="7"><?php echo $paragraphe; ?></textarea>
				</div>
				</div>
				
        <ul class="actions">
	        <li><input type="submit" name="enregistrer" value="Enregistrer" class="primary" /></li>
			<li><a href="../../index.php#creations">Fermer</a></li>
	    </ul>
	</form>

					</div>

				<!-- Footer -->
				<?php require_once('../../../ressources/includes/footer.php');
				?>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="../../../assets/js/jquery.min.js"></script>
			<script src="../../../assets/js/breakpoints.min.js"></script>
			<script src="../../../assets/js/util.js"></script>
			<script src="../../../assets/js/main.js"></script>

	</body>
</html>