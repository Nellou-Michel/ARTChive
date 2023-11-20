<!-- Ajout du form de base d'un média -->
<?php
    $this->_t="Créer jeu";
    $category = "Game";
    require_once FILE::build_path(array('view','form','header_forme.php'));
    require FILE::build_path(array('view','form','body_form.php'));

?>

<!-- LA STRATEGIE POUR CREER UN NOUVEAU MEDIA EST D ABORD D AJOUTER LE MEDIA DANS MEDIA
PUIS DE L AJOUTER DANS Game (OU MUSIC,MOVIES etcc) -->

<!-- AJout du platform listé pour créer un jeu -->
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
        <input type="text" name="newPlatformName" id="newPlatformName" style="display:none;">

        </div>
        <script>
                function showInputGame(select) {
                    var newInput = document.getElementById("newGameType");

                    if (select.value === "+") {
                        // Affiche l'input s'il est caché
                        newInput.style.display = "block";
                    } else {
                        // Cache l'input s'il est visible
                        newInput.style.display = "none";
                    }
                }
        </script>
     

<!-- Ajout du submit button, c'est la fin du formulaire -->
<?php
    require FILE::build_path(array('view','form','submit_form.php'));

    ?>