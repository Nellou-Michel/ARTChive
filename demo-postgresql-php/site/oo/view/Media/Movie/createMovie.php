<!-- Ajout du form de base d'un média -->
<?php

    $category = "Movie";

    if(isset($mediaUpdate)){
        $this->_t="Modifier Film";
    }
    else{
        $this->_t="Créer Film";
    }

    require_once FILE::build_path(array('view','form','header_forme.php'));
    require FILE::build_path(array('view','form','body_form.php'));

?>

<!-- LA STRATEGIE POUR CREER UN NOUVEAU MEDIA EST D ABORD D AJOUTER LE MEDIA DANS MEDIA
PUIS DE L AJOUTER DANS Movie (OU MUSIC,MOVIES etcc) -->

<!-- AJout du MovieType et des acteurs listé pour créer un Film -->
<div class="col-12">
        <input type="text" name="category" value=<?= $category?> style="display:none;">
        <label for="actors" class="form-label">(Acteurs)</label>
        <input type="text" class="form-control" id="actors" name="actors" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getActors() : "" ?>" >
            <div class="invalid-feedback">
                    Selectionnez un nom d'acteur valide
</div>

    <div class="col-12">
        <label for="type" class="form-label">Type</label>
        <select class="form-control" name="type" id="type" onchange="showInputMovie(this);">
            <option  value="">Sélectionnez un Type</option>
            <option value="+">+</option>
          
            <?php
            
            require_once FILE::build_path(array('model','MovieTypeModel.php'));
        
            $arrayType = MovieTypeModel::getAll("movieType","MovieTypeModel"); // Appel de la fonction statique

            foreach ($arrayType as $type) : ?>
            <option <?= (isset($mediaUpdate) && $mediaUpdate->getMovie_type() == $type->getMovie_type()) ? "selected" : "" ?> value="<?= $type->getMovie_type() ?>">
                <?= $type->getMovie_type() ?>
            </option>
            <?php endforeach; ?>
        </select>
        <input type="text" name="newMovieType" id="newMovieType" style="display:none;">

        </div>
        <script>
                function showInputMovie(select) {
                    var newInput = document.getElementById("newMovieType");

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
