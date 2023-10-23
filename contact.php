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
		<title>Contact <?php echo $nom_utilisateur; ?></title>
		<meta charset="utf-8" />
		<!-- Ajout d'un favicon. --> 
		<link rel="shortcut icon" type="image/png" href="ressources/medias/favicon.png" alt="Favicon indisponible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="ressources/css/fermer_notification.css" />
		<script defer src="ressources/js/fermer_notification.js"></script>
		<script defer src="ressources_admin/js/carte.js"></script>
	</head>

	<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">
				
	<!-- Main -->
	<div id="main">


	<!--  Script php pour le traitement du formulaire.  --->
<?php

// Vérifiction de l'envoi du formulaire.
if(isset($_POST['envoi'])){


	// Vérifie si tout les champs ont étés remplies.
    if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['objet']) && !empty($_POST['message'])) 
    {
		// Stocke les données entrés dans le formulaire dans des variables.
        $nom = htmlentities($_POST['nom']);
        $prenom = htmlentities($_POST['prenom']);
        $email = htmlentities($_POST['email']);
        $objet = htmlentities($_POST['objet']);
        $message = htmlentities($_POST['message']);

		// On récupère la date du jour.
        $date_envoi = new DateTimeImmutable();

		// Vérifie si l'e-mail entré est valide.
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

		// Requêtes SQL pour insérer les données dans la base de donnée. 
        $envoie_message = $bdd -> prepare('INSERT INTO contact(nom, prenom, email, objet, message, date_envoi) VALUES(?, ?, ?, ?, ?, ?)');
        $envoie_message -> execute(array($nom, $prenom, $email, $objet, $message, $date_envoi->format('Y-m-d H:i:s')));
		
		// Renvoie "Message envoyé !" pour affirmer que le message a bien été envoyé.
		echo "<div id=containNotif>

			  <section id=notificationValide>

	          <p id=message_valide>Message envoyé !</p>
	          <button id=bouton_fermer_succes onclick=fermerNotification()>Fermer</button>
	          </section>

	          <br><br>

	          </div>";
		}
		else {
			// Renvoie "Veuillez entrer un e-mail valide..." si l'e-mail n'est pas valide.
			echo"<div id=containNotif>
		
				<section id=notificationInvalide>

				<p id=message_invalide>Veuillez entrer un e-mail valide...</p>
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

	$delay = 3;
	header("Refresh: $delay;");
}

?>

	<h2>Contact</h2>
	<!--  Formulaire côté client avec la méthode POST.  --->
	<form action="" method="POST">
					<!--  Avec les balises labels assemblés dans une balise div on crée les champs à remplir.  --->
					<!--  Dans chaque balise le type de donnée, le nom et l'id seront précisés.  --->
					<div class="fields">
							<div class="field half">
									<label for="name">Nom</label>
											<input type="text" name="nom" id="name" />
							</div>


							<div class="field half">
									<label for="prenom">Prénom</label>
									<input type="text" name="prenom" id="prenom" />
							</div>


							<div class="field half">
									<label for="email">E-mail</label>
									<input type="text" name="email" id="email" />
							</div>
							

							<div class="field half">
									<label for="objet">Objet</label>
									<input type="text" name="objet" id="objet" />
							</div>

							
							<div class="field">
									<label for="message">Message</label>
									<textarea name="message" id="message" rows="4"></textarea>
							</div>
					</div>
			<ul class="actions">
     			<li><input type="submit" name="envoi" value="Envoyer" class="primary" /></li>
      			<li><input type="reset" value="Réinitialiser" /></li>
				<li><a href="index.php">Retour</a></li>
			</ul>
		</form>


</div>

				<!-- Footer -->
				<?php require_once('ressources/includes/footer.php');
				?>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>