<div class="col-12">
        <label for="type" class="form-label">Type</label>
        <select class="form-control" name="type" id="type" onchange="showInputMovie(this);">
            <option  value="">Sélectionnez un Type</option>
          
            <?php
            
            require_once FILE::build_path(array('model','MovieTypeModel.php'));
        
            $arrayType = MovieTypeModel::getAll("movieType","MovieTypeModel"); // Appel de la fonction statique

            foreach ($arrayType as $type) : ?>
            <option <?= (isset($mediaUpdate) && $mediaUpdate->getMovie_type() == $type->getMovie_type()) ? "selected" : "" ?> value="<?= $type->getMovie_type() ?>">
                <?= $type->getMovie_type() ?>
            </option>
            <?php endforeach; ?>
        </select>

        </div>