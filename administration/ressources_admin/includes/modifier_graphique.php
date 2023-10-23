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
		<title>Modfier le graphique</title>
		<meta charset="utf-8" />
		<!-- Ajout d'un favicon. --> 
		<link rel="shortcut icon" type="image/png" href="../medias/favicon-admin.png" alt="Favicon admin indisponible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../../../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../../../assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="../../../ressources/css/fermer_notification.css" />
		<link rel="stylesheet" href="../css/couleurs.css" />
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

    // Requête SQL pour la table "graphique".
    $DBgraphique = $bdd -> prepare('SELECT * FROM graphique WHERE id = ?');
    $DBgraphique -> execute(array($getid));

    
    if($DBgraphique -> rowCount() > 0){
        $graphique = $DBgraphique -> fetch();
        $nom_formation = $graphique['nom_formation'];
        $niveau = $graphique['niveau'];
        $couleur_arriere_plan = $graphique['couleur_arriere_plan'];
        $couleur_bordure = $graphique['couleur_bordure'];
        $couleur_text = $graphique['couleur_text'];

        /* On ne vérifie pas si des couleurs ont étés entrez car il y'a toujours une couleur par défaut 
		et impossible de vider ce champ */

		if(isset($_POST['enregistrer'])){ 
        if(!empty($_POST['nom_formation']) && !empty($_POST['niveau'])){
            
        $nom_formation_saisi = htmlentities($_POST['nom_formation']);
        $niveau_saisi = htmlentities($_POST['niveau']);
        $couleur_arriere_plan_saisi = htmlentities($_POST['couleur_arriere_plan']);
        $couleur_bordure_saisi = htmlentities($_POST['couleur_bordure']);
        $couleur_text_saisi = htmlentities($_POST['couleur_text']);

		if(preg_match_all('!\d+(?:\.\d+)?!', $niveau_saisi)) {
 
			if($niveau_saisi <= 100) {
        $updateGraphique = $bdd->prepare('UPDATE graphique SET nom_formation = ?, niveau = ?, couleur_arriere_plan = ?, couleur_bordure = ?, couleur_text = ? WHERE id = ?');
        $updateGraphique->execute(array($nom_formation_saisi, $niveau_saisi, $couleur_arriere_plan_saisi, $couleur_bordure_saisi, $couleur_text_saisi, $getid));
		
		echo "<div id=containNotif>
		
		<section id=notificationValide>

		<p id=message_valide>Compétence modifié ! <br>Mise à jour en cours...</p>
		<button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
		</section>

		<br><br>
		
		</div>";
		} else {
			echo "<div id=containNotif>
			
			<section id=notificationInvalide>

			<p id=message_invalide>Entrez un nombre inférieure ou égale à 100...</p>
			<button id=bouton_fermer_erreur onclick=fermerNotification()>Fermer</button>
	
			</section>

			<br><br>
			
			</div>";
		}
	}
		else { 
			echo"<div id=containNotif>
			
			<section id=notificationInvalide>

			<p id=message_invalide>Entrez un nombre valide...</p>
			<button id=bouton_fermer_erreur onclick=fermerNotification()>Fermer</button>
	
			</section>

			<br><br>
			
			</div>";
		  }
        }
        else{ 
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
        
        

    }else
    {
        header('Location: ../../cv.php#graphique');
    }

}else{
    header('Location: ../../cv.php#graphique');
}

?>
                    
	<h2 class="major">Modifier <?php echo $nom_formation; ?></h2>

	<br><br>

	<form method="post" action="#">
		<div class="fields">
	    	<div class="field half">
				<label for="nom_formation">Nom formation</label>
	     		<input type="text" name="nom_formation" value="<?php echo $nom_formation ?>" id="nom_formation" />
				</div>
				<div class="field half">
				<label for="niveau">Niveau (en pourcentage)</label>
				<input type="text" name="niveau" value="<?php echo $niveau ?>" id="niveau" />
				</div>

				<div class="field half">
					<div id="couleur_conteneur">
						<label for="couleur_arriere_plan">Couleur arrière plan</label>
						<input type="color" name="couleur_arriere_plan" value="<?php echo $couleur_arriere_plan ?>" id="couleur_arriere_plan" />
					</div>
				</div>

				<div class="field half">
					<div id="couleur_conteneur">
						<label for="couleur_bordure">Couleur bordure</label>
						<input type="color" name="couleur_bordure" value="<?php echo $couleur_bordure ?>" id="couleur_bordure" />
					</div>
				</div>

				<div class="field half">
					<div id="couleur_conteneur">
						<label for="couleur_text">Couleur text</label>
						<input type="color" name="couleur_text" value="<?php echo $couleur_text ?>" id="couleur_text" />
					</div>
				</div>
		</div>
        <ul class="actions">
	        <li><input type="submit" name="enregistrer" value="Enregistrer" class="primary" /></li>
			<li><a href="../../cv.php#graphique">Retour</a></li>
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