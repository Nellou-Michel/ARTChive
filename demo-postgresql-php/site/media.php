<?php
// initialisation de la session
// INDISPENSABLE À CETTE POSITION SI UTILISATION DES VARIABLES DE SESSION.
session_start();
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours disponibles</title>
    
    <!-- Inclure le fichier CSS de Bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

    <!-- Inclure le fichier JavaScript de Bootstrap (et jQuery, qui est requis) -->
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-5">
    <?php
    // Connexion à la bd
    include('config.php');

    // On appelle la méthode statique get() de la classe DB qui renvoie une instance du PDO.
    $request = DB::get()->query('select * from media');
    ?>


<h1 class="mb-4">Bienvenue sur ARTChive !, voici les médias</h1>

    <div class="container">
        <div class="row">
    <?php
    // On récupère les données en utilisant une jointure entre COURSE et COURSE_TEACHER
    $query = 'SELECT * FROM media';

    $request = DB::get()->query($query);

    while ($mediaData = $request->fetch()) {
        ?>
          <div class="col-md-4 col-sm-6 col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $mediaData['name_media']; ?></h5>
                <p class="card-text">
                    <!--<strong>Type :</strong> <?php echo $mediaData['media_type']; ?><br>-->
                    <strong>Description :</strong> <?php echo $mediaData['description']; ?><br>
                    <strong>Date de publication :</strong> <?php echo $mediaData['publication_date']; ?><br>
                    <strong>Durée :</strong> <?php echo $mediaData['length'] . ' ' . $mediaData['unite']; ?><br>
                    <strong>Note moyenne :</strong> <?php echo $mediaData['average_note']; ?><br>
                </p>
            </div>
        </div>
    </div>
        <?php
        }
    $request->closeCursor();
    ?>

        </div>
    </div>





    <!-- Formulaire Bootstrap -->
   <!-- Formulaire Bootstrap pour l'ajout d'un média -->
<form method="post" action="oo/view/Media/createMedia.php" class="mt-4">
    <h2>Ajout d'un Média</h2>
    <div class="mb-3">
        <label for="name_media" class="form-label">Titre :</label>
        <input type="text" class="form-control" id="name_media" name="name_media">
    </div>
    <div class="mb-3">
        <label for="publication_date" class="form-label">Date de Publication :</label>
        <input type="date" class="form-control" id="publication_date" name="publication_date">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description :</label>
        <textarea class="form-control" id="description" name="description" rows="5"></textarea>
    </div>
    <div class="mb-3">
        <label for="length" class="form-label">Durée :</label>
        <input type="number" class="form-control" id="length" name="length">
    </div>
    <div class="mb-3">
        <label for="unite" class="form-label">Unité de Durée :</label>
        <select class="form-select" id="unite" name="unite">
            <option value="minutes">Minutes</option>
            <option value="heures">Heures</option>
            <!-- Ajoutez d'autres unités si nécessaire -->
        </select>
    </div>
    <div class="mb-3">
        <label for="average_note" class="form-label">Note Moyenne :</label>
        <input type="number" step="0.1" class="form-control" id="average_note" name="average_note">
    </div>
    <div class="mb-3">
        <label for="file_path" class="form-label">Chemin du Fichier :</label>
        <input type="text" class="form-control" id="file_path" name="file_path">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>

</div>

</body>
</html>