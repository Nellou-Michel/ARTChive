
<body class="bg-body-tertiary">
<div class="container-md">
    <div class="col-lg-12">
        <div class="flex-row">
            <div class="col-sm-6">
                <h3 class="mb-3"><?= (isset($mediaUpdate) != null) ? "Modifier un ".$category : "Créer un nouveau ".$category ?></h3>
                <form class="needs-validation" action="?controller=media&action=<?=(isset($mediaUpdate) == null) ? "created" : "updated" ?>" method="post" novalidate>
                    <div class="row g-3">

                    <?php
                        if (isset($mediaUpdate)) {
                            echo '<div class="col-xxl-12">
                                <label for="name_media" class="form-label" >ID</label>
                                <input type="text" class="form-control" id="idmedia" name="id_media" value="' . $mediaUpdate->getId_media() . '" readonly>
                                <div class="invalid-feedback">
                                    Sélectionnez un nom de média valide
                                </div>
                            </div>';
                        }
                    ?>
                   

                        <div class="col-xxl-12">
                            <label for="name_media" class="form-label" >Nom du Média</label>
                            <input type="text" class="form-control" id="firstName" name="name_media" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getName_media() : "" ?>" required>
                            <div class="invalid-feedback">
                                Selectionnez un nom de média valid
                            </div>
                        </div>

                    
                        <?php
                        // Récupérez la liste complète d'auteurs une seule fois
                        require_once FILE::build_path(array('model','AuthorModel.php'));
                        $suggestedAuthors = AuthorModel::getAll("author","AuthorModel");
                        foreach ($suggestedAuthors as $author) {
                            $authorsHashMap[$author->getId_author()] = $author->getName_author();
                            $authorsNames[] = $author->getName_author();
                        }
                        
                        ?>

                        <div id='author_selection' class="col-12">
                            <label for="id_author" class="form-label">Auteur</label>
                            <input list="list_author" name="id_author" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getName_Author() : "" ?>"/>
                        </div>

                        <script>
                            function trouverCleParValeur(objet, valeurRecherchee) {
                                for (const cle in objet) {
                                    if (objet[cle] === valeurRecherchee) {
                                        return cle;
                                    }
                                }
                                // Si la valeur n'est pas trouvée, vous pouvez retourner null ou une autre valeur par défaut.
                                return null;
                            }

                            var listAuthorNames = <?php echo json_encode($authorsNames); ?>;
                            var authorNameIdMap = <?php echo json_encode($authorsHashMap); ?>;
                            var dataList = document.createElement('datalist');
                            dataList.id = 'list_author';

                            // Ajout d'options à la datalist
                            
                            for (var i = 0; i < listAuthorNames.length; i++) {
                                var option = document.createElement('option');
                                option.value = listAuthorNames[i];
                                //option.textContent = listAuthorNames[i];
                                //option.value = trouverCleParValeur(authorNameIdMap, listAuthorNames[i]);
                                dataList.appendChild(option);

                            document.getElementById('author_selection').appendChild(dataList);
  }
                            // function autocompleteAuthors(input) {
                               
                            // var inputValue = input.value.toLowerCase();
                            // var autocompleteList = document.getElementById("autocomplete-list");
                            // console.log(suggestedAuthors);
                            // if (Array.isArray(suggestedAuthors)) {
                            //     // Afficher la structure des objets
                            //     suggestedAuthors.forEach(function (author) {
                            //         console.log(author);

                            //         // Accéder à la propriété name_author de chaque auteur
                            //         var authorName = author.name_author;

                            //         // Filtrer les auteurs en fonction de la saisie de l'utilisateur
                            //         if (authorName.toLowerCase().includes(inputValue)) {
                            //             // Faire quelque chose avec l'auteur filtré
                            //             console.log(authorName);
                            //         }
                            //     });
                            // }

                            //     // Afficher les suggestions dans la liste d'autocomplétion
                            //     autocompleteList.innerHTML = "";
                            //     filteredAuthors.forEach(function (author) {
                            //         var option = document.createElement("div");
                            //         option.innerHTML = author.name_author;
                            //         option.addEventListener("click", function () {
                            //             // Remplir le champ d'entrée avec la suggestion sélectionnée
                            //             input.value = author.name_author;
                            //             // Cacher la liste d'autocomplétion
                            //             autocompleteList.innerHTML = "";
                            //         });
                            //         autocompleteList.appendChild(option);
                            //     });
                            // }




                        
                        </script>
                        </div>
                      

                        <div class="col-12">
                            <label class="form-label">Genres</label>
                            <?php
                            require_once FILE::build_path(array('model', 'MediaModel.php'));
                            
                            $arrayType = MediaModel::getAllGenresByCategory($category); // Appel de la fonction statique

                            // Récupérer les genres du mediaUpdate
                            if(isset($mediaUpdate)){
                                $mediaUpdateGenres = array();
                                foreach ($mediaUpdate->getGenres() as $genreModel) {
                                    $mediaUpdateGenres[] = $genreModel->getGenre();
                                }
                            }
                            
                            foreach ($arrayType as $type) {
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="checkbox" name="genre_id[]" id="genre_' . $type->getId_genre() . '" value="' . $type->getId_genre() . '"';
                                echo (isset($mediaUpdate) && in_array($type->getGenre(), $mediaUpdateGenres) ? ' checked' : '');
                                echo '>';
                                echo '<label class="form-check-label" for="genre_' . $type->getId_genre() . '">' . $type->getGenre() . '</label>';
                                echo '</div>';
                            }
                            ?>
                        </div>



                        <div class="col-12">
                            <label for="publication_date" class="form-label">Date de publication</label>
                            <div class="input-group has-validation">
                                <!-- <span class="input-group-text">@</span> -->
                                <input type="date" id="publication_date" name="publication_date" class="form-control" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getPublication_date() : "" ?>" required>
                                <div class="invalid-feedback">
                                    Selectionnez une date valide
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <div class="input-group has-validation">
                                <!-- <span class="input-group-text">@</span> -->
                                <textarea id="description" name="description" class="form-control" ><?= (isset($mediaUpdate) != null) ? $mediaUpdate->getDescription() : "" ?></textarea>
                                <div class="invalid-feedback">
                                    Selectionnez une description conforme
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="length">Durée</label>
                            <input type="text" class="form-control" name="length" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getLength() : "" ?>">
                            <div class="invalid-feedback">
                                Selectionnez une durée valide
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label" for="unite">Unité</label>
                            <select class="form-control" id="unite" name="unite">
                                <option <?= (isset($mediaUpdate) != null && $mediaUpdate->getUnite()=="minutes") ? "selected" : "" ?> value="minutes">Minutes</option>
                                <option <?= (isset($mediaUpdate) != null && $mediaUpdate->getUnite()=="heures") ? "selected" : "" ?> value="heures">Heures</option>
                                <option <?= (isset($mediaUpdate) != null && $mediaUpdate->getUnite()=="pages") ? "selected" : "" ?> value="pages">Pages</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="average_note">Note Moyenne</label>
                            <div class="input-group has-validation">
                                <input type="number" class="form-control" id="average_note" name="average_note" min="0" max="10" step="0.1" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getAverage_note() : "" ?>" required>
                                <span class="input-group-text">/10</span>
                                <div class="invalid-feedback">
                                    Selectionnez une note entre 0 et 10
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="file_path">Image</label>
                            <div class="input-group has-validation">
                                <input type="text" id="file_path" name="file_path" placeholder="url de l'image" class ="form-control" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getFile_path() : "" ?>" required>
                                <div class="invalid-feedback">
                                    Selectionnez un url valide
                                </div>
                            </div>

                        </div>

                        

