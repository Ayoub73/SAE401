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
		<title>Ajouter une compétence</title>
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



<!--  Script php pour l'ajout d'une compétence.  --->

<?php

require_once("../../../ressources/includes/connect_db.php");

if(isset($_POST['enregistrer'])){


	// Vérifie si tout les champs ont étés remplies.
    if(!empty($_POST['nom_formation']) && !empty($_POST['niveau'])) 
    {
		// Stocke les données entrés du formulaire dans des variables.
		$nom_formation = htmlentities($_POST['nom_formation']);
        $niveau = htmlentities($_POST['niveau']);
        $couleur_arriere_plan = htmlentities($_POST['couleur_arriere_plan']);
        $couleur_bordure = htmlentities($_POST['couleur_bordure']);
        $couleur_text = htmlentities($_POST['couleur_text']);

		// Vérifie si l'e-mail entré est valide.
		if (preg_match_all('!\d+(?:\.\d+)?!', $niveau)) {

		if($niveau <= 100) {			

		// Requêtes SQL pour insérer les données dans la base de donnée. 
        $ajouter_competences = $bdd -> prepare('INSERT INTO graphique(nom_formation, niveau, couleur_arriere_plan, couleur_bordure, couleur_text) VALUES(?, ?, ?, ?, ?)');
        $ajouter_competences -> execute(array($nom_formation, $niveau, $couleur_arriere_plan, $couleur_bordure, $couleur_text));

		$delai = 3; 
		header("Refresh: $delai;");

		// Renvoie "Compétence ajouté !" pour affirmer que la compétence a bien été envoyé.
		echo "<div id=containNotif>
		
		<section id=notificationValide>

		<p id=message_valide>Compétence ajouté !</p>
		<button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
		<br><br>
		</section>

		<br><br>
		
		</div>";
		} 
		
		else {
		
		$delai = 3; 
		header("Refresh: $delai;");

		echo"<div id=containNotif>
			
				<section id=notificationInvalide>

				<p id=message_invalide>Entrez un nombre inférieure ou égale à 100...</p>
				<button id=bouton_fermer_erreur onclick=fermerNotification()>Fermer</button>
	
				</section>

				<br><br>
				
				</div>";
		}

		}
		else {

			$delai = 3; 
			header("Refresh: $delai;");
			
			// Renvoie "Veuillez entrer un nombre valide..." si le nombre n'est pas valide.
			echo"<div id=containNotif>
			
				<section id=notificationInvalide>

				<p id=message_invalide>Veuillez entrer un nombre valide...</p>
				<button id=bouton_fermer_erreur onclick=fermerNotification()>Fermer</button>
	
				</section>

				<br><br>
				
				</div>";
		  }
    }    
    else
    {
		// Renvoie "Veuillez compléter tous les champs..." si tout les champs ne sont pas complétés.
        echo "<div id=containNotif>
		
		<section id=notificationInvalide>

		<p id=message_invalide>Veuillez compléter tous les champs...</p>
		<button id=bouton_fermer_erreur onclick=fermerNotification()>Fermer</button>

		</section>

		<br><br>
		
		</div>";
    }
}

?>

<h2>Ajouter une compétence</h2>
	<br><br>
	<form method="post" action="#">
		<div class="fields">
	    	<div class="field half">
				<label for="nom_formation">Nom formation</label>
	     		<input type="text" name="nom_formation" id="nom_formation" />
				</div>
				<div class="field half">
				<label for="niveau">Niveau</label>
				<input type="text" name="niveau" id="niveau" />
				</div>

				<div class="field half">
					<div id="couleur_conteneur">
						<label for="couleur_arriere_plan">Couleur arrière plan</label>
						<input type="color" name="couleur_arriere_plan" value="#ffffff" id="couleur_arriere_plan" />
					</div>
				</div>

				<div class="field half">					
					<div id="couleur_conteneur">
						<label for="couleur_bordure">Couleur bordure</label>
						<input type="color" name="couleur_bordure" value="#ffffff" id="couleur_bordure" />
					</div>
				</div>

				<div class="field half">
					<div id="couleur_conteneur">
						<label for="couleur_text">Couleur text</label>
						<input type="color" name="couleur_text" value="#ffffff" id="couleur_text" />
					</div>
				</div>
		</div>
        <ul class="actions">
	        <li><input type="submit" name="enregistrer" value="Enregistrer" class="primary" /></li>
	        <li><input type="reset" value="Réinitialiser" /></li>
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