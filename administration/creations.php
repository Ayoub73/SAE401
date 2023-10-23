<?php

// Requête SQL pour la table "creations".
$DBcreations = $bdd -> query('SELECT * FROM creations');

?>

<article id="creations">
	<h2 class="major">Création</h2>


	<details open>
    <summary><h3>Voir les créations</h3></summary>
    <!--  Balise <table> pour afficher les données sous forme de tableau.  --->
<table class="table-style">

<thead>
            <td>
                <th>Nom</th>
                <th>Illustration</th>
                <th>Catégorie</th>
				<th>Description</th>
            </td>
        </thead>

<!--  Script php pour afficher les projets.  --->
<?php

// Boucle While qui affiche les projets tant qu'il y'a des données.
while($creations = $DBcreations -> fetch())
{
	?>            

		<tbody>
		<!--  On affiche le titre, l'image et le paragraphe du projet.  --->
		<td>

		<td id="titre"><br><?= $creations['titre']; ?>  <br><br> <a href="ressources_admin/includes/modifier_creation.php?id=<?= $creations['id']; ?>" id="modifier_creation">Modifier</a>
		<a href="ressources_admin/includes/supprimer_creation.php?id=<?= $creations['id']; ?>" onclick="return supprimer_creation()" id="supprimer_creation">Supprimer</a></td>
        <td><br><img src="../ressources/medias/<?= $creations['image']; ?>" alt="<?= $creations['image_alt']; ?>" /></td>
        <td id="categorie"><br><?= $creations['categorie']; ?></td>
		<td id="description"><br><?= $creations['paragraphe']; ?></td>
		</td>
		</tbody>       

		<?php
} 

	?>

</table>

	</details>

	<br><br>

	<a href="ressources_admin/includes/ajouter_creation.php">Ajouter</a>

</article>