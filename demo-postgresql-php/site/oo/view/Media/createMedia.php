<?php $this->_t="Créer Média"?>

<h2>Créer un Nouveau Média</h2>
    <form action="?controller=media&action=created" method="post">
        <label for="name_media">Nom du Média :</label>
        <input type="text" id="name_media" name="name_media" required><br><br>

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
