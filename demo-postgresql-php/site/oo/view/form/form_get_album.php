<div class="col-12">
        <input type="text" name="category" value=<?= $category?> style="display:none;">


        <label for="type" class="form-label">Album</label>
        <select class="form-control" name="album" id="type" >
            <option  value="">--Sélectionnez un album--</option>
 
            <?php
                require_once FILE::build_path(array('model','MusicModel.php'));

                $arrayType = MusicModel::getAll("music","MusicModel"); // Appel de la fonction statique

                foreach ($arrayType as $type) {
                    echo '<option value="' . $type->getAlbum() . '">' . $type->getAlbum() . '</option>';
                }
            ?>
        </select>

        </div>

