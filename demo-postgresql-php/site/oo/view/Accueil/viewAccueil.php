<head>
    <title>Page d'accueil</title>
    <style>
        /* Style du conteneur */
        .accueil-container {
            background-image: url('votre-image.jpg'); /* Remplacez 'votre-image.jpg' par le chemin de votre image de fond */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        /* Style du contenu */
        .accueil-content {
            background-color: rgba(255, 255, 255, 0.7); /* Fond semi-transparent */
            padding: 20px;
            border-radius: 10px;
        }

        /* Style du titre */
        .accueil-title {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Style du texte d'accueil */
        .accueil-text {
            font-size: 18px;
        }
    </style>


<?php $this->_t="Accueil"?>

    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
        <div class="col-lg-6 px-0">
            <h1 class="display-5 fst-italic">Bienvenue sur ARTchive !</h1>
            <p class="lead my-3">Explorez les films, les jeux et les livres préférés de chacun. Découvrez, partagez et connectez-vous avec d'autres passionnés. Rejoignez notre communauté culturelle aujourd'hui ! </p>
        </div>
    </div>
</head>