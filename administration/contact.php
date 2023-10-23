<?php

// Requête SQL pour la table "contact".
$DBmessages = $bdd -> query('SELECT * FROM contact ORDER BY id DESC');

?>

<article id="contact">
	<h2 class="major">Messages</h2>


	<details open>
    <summary><h3>Voir les messages</h3></summary>
    <!--  Balise <table> pour afficher les données sous forme de tableau.  --->
<table class="table-style">

<thead>
            <td>
                <th>Nom / Prénom</th>
                <th>E-mail</th>
				<th>Objet / Message</th>
				<th>Date d'envoi</th>
            </td>
        </thead>

<!--  Script php pour afficher les projets.  --->
<?php

// Boucle While qui affiche les projets tant qu'il y'a des données.
while($messages = $DBmessages -> fetch())
{
	?>            

		<tbody>
		<!--  On affiche le titre, l'image et le paragraphe du projet.  --->
		<td>

		<td><br><?= $messages['nom']; ?><br><?= $messages['prenom']; ?>
		<br><br>
		<a href="ressources_admin/includes/supprimer_message.php?id=<?= $messages['id']; ?>" onclick="return supprimer_message()" id="supprimer_message">Supprimer</a></td>
		<td><br><?= $messages['email']; ?></td>
		<td><br><?= $messages['objet']; ?><br><?= $messages['message']; ?></td>
		<td><br><?= $messages['date_envoi']; ?></td>
		</td>
		</tbody>       

		<?php
} 

	?>

</table>

	</details>

	<br><br>

</article>