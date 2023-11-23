<div class="col-12">
        <label for="type" class="form-label">Type</label>
            <select class="form-control" name="type" id="type">
                <option  value="">Sélectionnez un Type</option>          
                <?php
                
                require_once FILE::build_path(array('model','MovieTypeModel.php'));
            
                $arrayType = MovieTypeModel::getAll("movieType","MovieTypeModel"); // Appel de la fonction statique

                foreach ($arrayType as $type) {
                    echo '<option value="' . $type->getMovie_type() . '">' . $type->getMovie_type() . '</option>';
                }
                ?>
            </select>
        </div>