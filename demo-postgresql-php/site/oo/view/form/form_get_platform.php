<div class="col-12">
        <input type="text" name="category" value=<?= $category?> style="display:none;">
        <label name="category" value="Game"></label>

        <label for="platform" class="form-label">Plateforme</label>
        <?php
        require_once FILE::build_path(array('model', 'PlatformModel.php'));

        $arrayPlatforms = PlatformModel::getAll("platform", "PlatformModel");

        echo '<div class="row">';
        echo '<div class="col-md-6">';

        $count = count($arrayPlatforms);
        for ($i = 0; $i < $count; $i += 2) {
            $platform = $arrayPlatforms[$i];
            echo '<div class="form-check flex">';
            echo '<input class="form-check-input" type="checkbox" name="platform[]" id="platform_' . $platform->getPlatform() . '" value="' . $platform->getPlatform() . '">';
            echo '<label class="form-check-label" for="platform_' . $platform->getPlatform() . '">' . $platform->getPlatform() . '</label>';
            echo '</div>';
        }

        echo '</div>';

        echo '<div class="col-md-6">';

        for ($i = 1; $i < $count; $i += 2) {
            $platform = $arrayPlatforms[$i];
            echo '<div class="form-check flex">';
            echo '<input class="form-check-input" type="checkbox" name="platform[]" id="platform_' . $platform->getPlatform() . '" value="' . $platform->getPlatform() . '">';
            echo '<label class="form-check-label" for="platform_' . $platform->getPlatform() . '">' . $platform->getPlatform() . '</label>';
            echo '</div>';
        }

        echo '</div>';
        echo '</div>';

        ?>

</div>