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
    $request = DB::get()->query('select * from course');
    ?>


<h1 class="mb-4">Bienvenue sur ARTChive !</h1>

    <div class="container">
        <div class="row">
    <?php
    // On récupère les données en utilisant une jointure entre COURSE et COURSE_TEACHER
    $query = 'SELECT c.code, c.name, c.description, p.first_name AS teacher_first_name, p.last_name AS teacher_last_name
              FROM COURSE c
              LEFT JOIN COURSE_TEACHER ct ON c.code = ct.code
              LEFT JOIN PERSON p ON ct.teacher = p.email';
    $request = DB::get()->query($query);

    while ($data = $request->fetch()) {
    ?>

                <div class="col-md-4 col-sm-6 col-12"> <!-- 3 colonnes sur grand écran, 2 colonnes sur tablette, 1 colonne sur mobile -->
                    <div class="card">
                        <div class="card-body">


                            <h5 class="card-title"><?php echo $data['name']; ?></h5>
                            <p class="card-text">
                                <br>
                                code du cours : <?php echo $data['code']; ?><br>
                                description du cours :
                                <?php echo $data['description']; ?><br></p>
                        </div>
                    </div>
                </div>

                <!-- Ajouter autant de blocs que nécessaire avec la même structure -->



        <?php
    }
    $request->closeCursor();
    ?>

        </div>
    </div>




 <div class="container">
        <div class="row">
    <?php
    // On récupère les données en utilisant une jointure entre COURSE et COURSE_TEACHER
    $query = getCourses();
    $request = DB::get()->query($query);

    while ($data = $request->fetch()) {
    ?>

                <div class="col-md-4 col-sm-6 col-12"> <!-- 3 colonnes sur grand écran, 2 colonnes sur tablette, 1 colonne sur mobile -->
                    <div class="card">
                        <div class="card-body">


                            <h5 class="card-title"><?php echo $data['name']; ?></h5>
                            <p class="card-text">
                                <br>
                                code du cours : <?php echo $data['code']; ?><br>
                                description du cours :
                                <?php echo $data['description']; ?><br></p>
                        </div>
                    </div>
                </div>

                <!-- Ajouter autant de blocs que nécessaire avec la même structure -->



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