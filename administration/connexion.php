<html>
	<head>
		<title>Connexion au Backoffice</title>
		<meta charset="utf-8" />
		<!-- Ajout d'un favicon. --> 
		<link rel="shortcut icon" type="image/png" href="ressources_admin/medias/favicon-admin.png" alt="Favicon admin indisponible">
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="../assets/css/main.css" />
		<noscript><link rel="stylesheet" href="../assets/css/noscript.css" /></noscript>
		<link rel="stylesheet" href="../ressources/css/fermer_notification.css" />
		<script defer src="../ressources/js/fermer_notification.js"></script>
		<script defer src="ressources_admin/js/carte.js"></script>
	</head>

	<body class="is-preload">

	<!-- Wrapper -->
	<div id="wrapper">
				
	<!-- Main -->
	<div id="main">

<?php
session_start();
require_once("../ressources/includes/connect_db.php");

$general = $bdd -> query('SELECT * FROM general LIMIT 1');

$general = $general->fetch();

if(isset($_POST['connexion']))
{
    if(!empty($_POST['identifiant']) && !empty($_POST['mot_de_passe']))
    {
        $identifiant = $general["identifiant"];

        $mot_de_passe = $general["mot_de_passe"];

        $identifiant_saisi = htmlentities($_POST["identifiant"]);

	    $mot_de_passe_saisi = htmlentities($_POST["mot_de_passe"]);

        if($identifiant_saisi == $identifiant && $mot_de_passe_saisi == $mot_de_passe)
        {
            $_SESSION['mot_de_passe'] = $mot_de_passe_saisi;
            header('Location: index.php');
        }
        else{
            echo "<div id=containNotif>
		
	              <section id=notificationInvalide>

	              <p id=message_invalide>Votre identifiant ou mot de passe est incorrect</p>
	              <button id=bouton_fermer_erreur onclick=fermerNotification()>Fermer</button>

	              </section>

	              <br><br>
		
	              </div>";
        }
    }
    else
    {
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

<h2>Connexion</h2>
	<form method="post" action="">
		<div class="fields">

			<div class="field full">
				<label for="identifiant">Identifiant</label>
	     		<input type="text" name="identifiant" id="identifiant" />
			</div>

			<div class="field full">
				<label for="mot_de_passe">Mot de passe</label>
	     		<input type="password" name="mot_de_passe" id="mot_de_passe" />
			</div>

		</div>
        <ul class="actions">
	        <li><input type="submit" name="connexion" value="Connexion" class="primary" /></li>
	    </ul>
	</form>


</div>

				<!-- Footer -->
				<?php require_once('../ressources/includes/footer.php');
				?>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="../assets/js/jquery.min.js"></script>
			<script src="../assets/js/breakpoints.min.js"></script>
			<script src="../assets/js/util.js"></script>
			<script src="../assets/js/main.js"></script>

	</body>
</html>



