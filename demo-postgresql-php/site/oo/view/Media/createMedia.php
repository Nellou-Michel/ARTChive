<head>
    <script src="../assets/js/color-modes.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.118.2">
    <title>Checkout example · Bootstrap v5.3</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        preview {
            position: relative;
            left: 700px;
            top : -750px;
        }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        footer {
            margin-top: 50px;
        }
        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="checkout.css" rel="stylesheet">
</head>

<?php
    $this->_t="Créer Média";
    require_once FILE::build_path(array('model','AuthorModel.php'));
?>

<body class="bg-body-tertiary">
<div class="container-md">
    <div class="col-lg-12">
        <div class="flex-row">
            <div class="col-sm-6">
                <h3 class="mb-3">Créer un Nouveau Média</h3>
                <form class="needs-validation" action="?controller=media&action=created" method="post" novalidate>
                    <div class="row g-3">

                        <div class="col-xxl-12">
                            <label for="name_media" class="form-label" >Nom du Média</label>
                            <input type="text" class="form-control" id="firstName" name="name_media" required>
                            <div class="invalid-feedback">
                                Selectionnez un nom de média valid
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="id_author" class="form-label">Auteur</label>
                            <select class="form-control" name="id_author" id="auteur" onchange="showInput(this);">
                                <option  value="">Sélectionnez un auteur</option>
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
                        </div>

                        <div class="col-12">
                            <label for="publication_date" class="form-label">Date de publication</label>
                            <div class="input-group has-validation">
                                <!-- <span class="input-group-text">@</span> -->
                                <input type="date" id="publication_date" name="publication_date" class="form-control" required>
                                <div class="invalid-feedback">
                                    Selectionnez une date valide
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <div class="input-group has-validation">
                                <!-- <span class="input-group-text">@</span> -->
                                <textarea id="description" name="description" class="form-control"></textarea>
                                <div class="invalid-feedback">
                                    Selectionnez une description conforme
                                </div>
                            </div>

                        </div>

                        <div class="col-12">
                            <label for="name_media" class="form-label" >Nom du Média</label>
                            <input type="text" class="form-control" id="firstName" name="name_media" required>
                            <div class="invalid-feedback">
                                Selectionnez un nom de média valid
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="length">Durée</label>
                            <input type="text" class="form-control" name="length">
                            <div class="invalid-feedback">
                                Selectionnez une durée valide
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="unite">Unité</label>
                            <select class="form-control" id="unite" name="unite">
                                <option value="minutes">Minutes</option>
                                <option value="heures">Heures</option>
                                <option value="pages">Pages</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="average_note">Note Moyenne</label>
                            <div class="input-group has-validation">
                                <input type="number" class="form-control" id="average_note" name="average_note" min="0" max="10" step="0.1" required>
                                <span class="input-group-text">/10</span>
                                <div class="invalid-feedback">
                                    Selectionnez une note entre 0 et 10
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="file_path">Image</label>
                            <div class="input-group has-validation">
                                <input type="text" id="file_path" name="file_path" placeholder="url de l'image" class ="form-control" required>
                                <div class="invalid-feedback">
                                    Selectionnez un url valide
                                </div>
                            </div>
                        </div>

                        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
                        <script src="checkout.js"></script>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<footer></footer>
</body>
