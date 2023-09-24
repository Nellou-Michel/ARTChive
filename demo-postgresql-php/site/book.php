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
    $request = DB::get()->query('select * from book');
    ?>


<h1 class="mb-4">Bienvenue sur ARTChive !, voici les books</h1>

    <div class="container">
        <div class="row">
    <?php
    // On récupère les données en utilisant une jointure entre COURSE et COURSE_TEACHER
    $query = 'SELECT 
    B.id_media AS book_id,
    B.book_type AS book_type,
    M.name_media AS book_title,
    M.description AS book_description,
    M.publication_date AS book_publication_date,
    M.length AS book_length,
    M.unite AS book_length_unit,
    M.average_note AS book_average_note,
    M.file_path AS book_file_path,
    G.genre AS book_genre,
    G.category AS book_category
FROM 
    Book AS B
INNER JOIN 
    Media AS M ON B.id_media = M.id_media
INNER JOIN 
    Genre AS G ON M.id_media = G.id_genre';
    $request = DB::get()->query($query);

    while ($data = $request->fetch()) {
        ?>
        <div class="col-md-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['book_title']; ?></h5>
                    <p class="card-text">
                        <strong>Auteur :</strong> <?php echo $data['book_author']; ?><
                        <strong>Genre :</strong> <?php echo $data['book_genre']; ?>
                        <strong>Description :</strong> <?php echo $data['book_description']; ?>
                        <strong>Date de publication :</strong> <?php echo $data['book_publication_date']; ?>
                        <strong>Longueur :</strong> <?php echo $data['book_length'] . ' ' . $data['book_length_unit']; ?>
                        <strong>Note moyenne :</strong> <?php echo $data['book_average_note']; ?>
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
    <form method="post" action="insertCourse.php" class="mt-4">
        <h2>Ajout d'un cours</h2>
        <div class="mb-3">
            <label for="code" class="form-label">Code :</label>
            <input type="text" class="form-control" id="code" name="code">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nom :</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description :</label>
            <textarea class="form-control" id="description" name="description" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
    </form>
</div>

</body>
</html>