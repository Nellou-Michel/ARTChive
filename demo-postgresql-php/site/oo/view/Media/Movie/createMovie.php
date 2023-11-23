<!-- Ajout du form de base d'un média -->
<?php
    $this->_t="Créer Film";
    $category = "Movie";
    require_once FILE::build_path(array('view','form','header_forme.php'));
    require FILE::build_path(array('view','form','body_form.php'));

?>

<!-- LA STRATEGIE POUR CREER UN NOUVEAU MEDIA EST D ABORD D AJOUTER LE MEDIA DANS MEDIA
PUIS DE L AJOUTER DANS Movie (OU MUSIC,MOVIES etcc) -->

<!-- AJout du MovieType et des acteurs listé pour créer un Film -->
<div class="col-12">
        <input type="text" name="category" value=<?= $category?> style="display:none;">
        <label for="actors" class="form-label">(Acteurs)</label>
        <input type="text" class="form-control" id="actors" name="actors">
            <div class="invalid-feedback">
                    Selectionnez un nom d'acteur valide
</div>

<!-- Ajout formulaire de typeMovie -->
<?php
    require FILE::build_path(array('view','form','form_get_type_movie.php'));

    ?>
     

<!-- Ajout du submit button, c'est la fin du formulaire -->
<?php
    require FILE::build_path(array('view','form','submit_form.php'));

    ?>
