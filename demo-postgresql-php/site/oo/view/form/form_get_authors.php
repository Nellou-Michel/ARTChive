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

                        
                        </script>
                        </div>