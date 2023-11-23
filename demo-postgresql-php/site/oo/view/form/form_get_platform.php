<div class="col-12">
        <input type="text" name="category" value=<?= $category?> style="display:none;">
        <label name="category" value="Game"></label>

        <label for="platform" class="form-label">Plateforme</label>
        <?php
        require_once FILE::build_path(array('model', 'PlatformModel.php'));

        $arrayPlatforms = PlatformModel::getAll("platform", "PlatformModel");

        foreach ($arrayPlatforms as $platform) {
            echo '<div class="form-check">';
            echo '<input class="form-check-input" type="checkbox" name="platform[]" id="platform_' . $platform->getPlatform() . '" value="' . $platform->getPlatform() . '">';
            echo '<label class="form-check-label" for="platform_' . $platform->getPlatform() . '">' . $platform->getPlatform() . '</label>';
            echo '</div>';
        }

        echo '<div class="form-check">';
        echo '<input class="form-check-input" type="checkbox" name="newPlatform" id="newPlatform">';
        echo '<label class="form-check-label" for="newPlatform">Ajouter une nouvelle plateforme</label>';
        echo '</div>';
        ?>

</div>