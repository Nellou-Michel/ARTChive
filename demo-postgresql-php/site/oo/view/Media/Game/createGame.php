<!-- Ajout du form de base d'un média -->
<?php
    $this->_t="Créer jeu";
    require_once FILE::build_path(array('view','form','header_forme.php'));
    require FILE::build_path(array('view','form','body_form.php'));

?>

<!-- LA STRATEGIE POUR CREER UN NOUVEAU MEDIA EST D ABORD D AJOUTER LE MEDIA DANS MEDIA
PUIS DE L AJOUTER DANS Game (OU MUSIC,MOVIES etcc) -->

<!-- AJout du platform listé pour créer un jeu -->
    <div class="col-12">
        <label name="category" value="Game"></label>

        <label for="platform" class="form-label">Platforme</label>
        <select class="form-control" name="platform" id="platform" onchange="showInputGame(this);">
            <option  value="">Sélectionnez une Platform</option>
            <option value="+">+</option>
          
            <?php
            
            require_once FILE::build_path(array('model','PlatformModel.php'));
        
            $arrayType = PlatformModel::getAll("platform","PlatformModel"); // Appel de la fonction statique

            foreach ($arrayType as $type) {
                echo '<option value="' . $type->getPlatform() . '">' . $type->getPlatform() . '</option>';
            }
            ?>
         </select>
        <input type="text" name="newGameType" id="newGameType" style="display:none;">

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