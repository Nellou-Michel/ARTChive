<!-- AJout du BookType listé pour créer un livre -->
<div class="col-12">
        <input type="text" name="category" value=<?= $category?> style="display:none;">


        <label for="type" class="form-label">Type</label>
        <select class="form-control" name="type" id="type">
            <option  value="">--Sélectionnez un Type--</option>
          
            <?php
            
            require_once FILE::build_path(array('model','BookTypeModel.php'));
        
            $arrayType = BookTypeModel::getAll("bookType","BookTypeModel"); // Appel de la fonction statique

            foreach ($arrayType as $type) : ?>
                <option <?= (isset($mediaUpdate) && $mediaUpdate->getBook_type() == $type->getBook_type()) ? "selected" : "" ?> value="<?= $type->getBook_type() ?>">
                    <?= $type->getBook_type() ?>
                </option>
            <?php endforeach; ?>


         
        </select>

        </div>