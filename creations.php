<!--  Balise article pour la partie Création.  --->

<article id="creations">

    <!--  Titre de la sous page en overlay.  --->
	<h2 class="major">Création</h2>

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
    
    // Requête SQL qui récupère tout de la table "creations".
	$DBcreations = $bdd -> query('SELECT * FROM creations');
    // Boucle While qui affiche les projets tant qu'il y'a des données.
    while($creations = $DBcreations -> fetch())
    {
        ?>            

            <tbody>
            <!--  On affiche le titre, l'image et le paragraphe du projet.  --->
            <td>
            <td><br><?= $creations['titre']; ?></td>
            <td><br><img src="ressources/medias/<?= $creations['image']; ?>" alt="<?= $creations['image_alt']; ?>" /></td>
            <td><br><?= $creations['categorie']; ?></td>
            <td><br><?= $creations['paragraphe']; ?></td>
            </td>
            </tbody>       

            <?php
    } 

        ?>

    </table>

</article>

