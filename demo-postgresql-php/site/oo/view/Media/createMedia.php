<?php 
$this->_t="Créer Média";
require_once FILE::build_path(array('model','AuthorModel.php'));


?>

<h2>Créer un Nouveau Média</h2>
    <form action="?controller=media&action=created" method="post">
        <label for="name_media">Nom du Média :</label>
        <input type="text" id="name_media" name="name_media" required><br><br>

        <label for="id_author">Auteur :</label>
        <select name="auteur" id="auteur" onchange="showInput(this);">
            <option value="">Sélectionnez un auteur</option>
            <option value="ajouter">+</option>
            <?php
            $authors = AuthorModel::getAllAuthors(); // Appel de la fonction statique

            foreach ($authors as $author) {
                echo '<option value="' . $author->getId_author() . '">' . $author->getName_author() . '</option>';
            }
            ?>
         </select>

         <!--<input type="text" name="nouvel_auteur" id="nouvel_auteur" style="display:none;">
        <button type="button" id="ajouter_auteur" style="display:none;">Ajouter</button>-->
       

    <script>
    function showInput(select) {
    var nouvelAuteurInput = document.getElementById("nouvel_auteur");
    var ajouterAuteurButton = document.getElementById("ajouter_auteur");

    if (select.value === "ajouter") {
        nouvelAuteurInput.style.display = "block";
        ajouterAuteurButton.style.display = "block";
        select.style.display = "none";
    } else {
        nouvelAuteurInput.style.display = "none";
        ajouterAuteurButton.style.display = "none";
        select.style.display = "block";
    }
}
</script>

        <label for="publication_date">Date de Publication :</label>
        <input type="date" id="publication_date" name="publication_date" required><br><br>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="length">Durée :</label>
        <input type="number" id="length" name="length" required> minutes<br><br>

        <label for="unite">Unité :</label>
        <select id="unite" name="unite">
            <option value="minutes">Minutes</option>
            <option value="heures">Heures</option>
            <option value="pages">Pages</option>
            <!-- Ajoutez d'autres unités au besoin -->
        </select><br><br>

        <label for="average_note">Note Moyenne :</label>
        <input type="number" id="average_note" name="average_note" min="0" max="10" step="0.1" required><br><br>

        <label for="file_path">Chemin du Fichier :</label>
        <input type="text" id="file_path" name="file_path" required><br><br>

        <input type="submit" value="Créer le Média">
        <input type='hidden' name='action' value='created'>
    </form>
