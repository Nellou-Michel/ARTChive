<div class="col-12">
                            <label class="form-label">Genres</label>
                            <?php
                            require_once FILE::build_path(array('model', 'MediaModel.php'));
                            
                            $arrayType = MediaModel::getAllGenresByCategory($category); // Appel de la fonction statique

                            echo '<div class="row">';
                            echo '<div class="col-md-6">';

                            $count = count($arrayType);
                            for ($i = 0; $i < $count; $i += 2) {
                                $type = $arrayType[$i];
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="checkbox" name="genre_id[]" id="genre_' . $type->getId_genre() . '" value="' . $type->getId_genre() . '">';
                                echo '<label class="form-check-label" for="genre_' . $type->getId_genre() . '">' . $type->getGenre() . '</label>';
                                echo '</div>';
                            }

                            echo '</div>';

                            echo '<div class="col-md-6">';

                            for ($i = 1; $i < $count; $i += 2) {
                                $type = $arrayType[$i];
                                echo '<div class="form-check">';
                                echo '<input class="form-check-input" type="checkbox" name="genre_id[]" id="genre_' . $type->getId_genre() . '" value="' . $type->getId_genre() . '">';
                                echo '<label class="form-check-label" for="genre_' . $type->getId_genre() . '">' . $type->getGenre() . '</label>';
                                echo '</div>';
                            }

                            echo '</div>';
                            echo '</div>';



                            ?>
                        </div>