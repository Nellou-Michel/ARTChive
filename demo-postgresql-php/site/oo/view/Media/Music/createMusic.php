<!-- Ajout du form de base d'un média -->
<?php
 
    $category = "Music";

    if(isset($mediaUpdate)){
        $this->_t="Modifier musique";
    }
    else{
        $this->_t="Créer musique";
    }
    require_once FILE::build_path(array('view','form','header_forme.php'));
    require FILE::build_path(array('view','form','body_form.php'));

?>

<!-- LA STRATEGIE POUR CREER UN NOUVEAU MEDIA EST D ABORD D AJOUTER LE MEDIA DANS MEDIA
PUIS DE L AJOUTER DANS BOOK (OU MUSIC,MOVIES etcc) -->

<!-- AJout du Album listé pour créer un livre -->
    <div class="col-12">
    <input type="text" name="category" value=<?= $category?> style="display:none;">

        <label for="album" class="form-label">(Nom de l'album)</label>
        <input type="text" class="form-control" id="album" name="album" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getAlbum() : "" ?>">
            <div class="invalid-feedback">
                    Selectionnez un nom de média valide
            </div>
     

<!-- Ajout du submit button, c'est la fin du formulaire -->
<?php
    require FILE::build_path(array('view','form','submit_form.php'));

    ?>
