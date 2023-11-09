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

                        <div class="col-4">
                            <br>
                            <input type="submit" value="Créer" class="form-control btn-bd uwu"> </input>
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
