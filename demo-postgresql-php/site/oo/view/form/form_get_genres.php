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