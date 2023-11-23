<!-- Ajout du form de base d'un média -->
<?php
    $category = "Game";

    if(isset($mediaUpdate)){
        $this->_t="Modifier jeu";
    }
    else{
        $this->_t="Créer jeu";
    }

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

        if(isset($mediaUpdate)){
            $mediaUpdatePlatforms = array();
            foreach ($mediaUpdate->getPlatforms() as $platform) {
                $mediaUpdatePlatforms[] = $platform->getPlatform();
            }
        }

        foreach ($arrayPlatforms as $platform) {
            echo '<div class="form-check">';
            // echo '<input class="form-check-input" type="checkbox" name="platform[]" id="platform_' . $platform->getPlatform() . '" value="' . $platform->getPlatform() . '">';
            
            echo '<input class="form-check-input" type="checkbox" name="platform[]" id="platform_' . $platform->getPlatform() . '" value="' . $platform->getPlatform() . '"';
            echo (isset($mediaUpdate) && in_array($platform->getPlatform(), $mediaUpdatePlatforms) ? ' checked' : '');
            echo '>';
           
            echo '<label class="form-check-label" for="platform_' . $platform->getPlatform() . '">' . $platform->getPlatform() . '</label>';
            echo '</div>';
        }

          // Récupérer les genres du mediaUpdate
  

       
        ?>

        </div>
        
        </script>
     

<!-- Ajout du submit button, c'est la fin du formulaire -->
<?php
    require FILE::build_path(array('view','form','submit_form.php'));
?>