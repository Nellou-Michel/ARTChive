<!-- Ajout du form de base d'un média -->
<?php
    $this->_t="Créer Livre";
    require_once FILE::build_path(array('view','form','header_forme.php'));
    require FILE::build_path(array('view','form','body_form.php'));

?>

<!-- LA STRATEGIE POUR CREER UN NOUVEAU MEDIA EST D ABORD D AJOUTER LE MEDIA DANS MEDIA
PUIS DE L AJOUTER DANS BOOK (OU MUSIC,MOVIES etcc) -->

<!-- AJout du BookType listé pour créer un livre -->
    <div class="col-12">
        <label for="book_type" class="form-label">Type</label>
        <select class="form-control" name="book_type" id="book_type" onchange="showInput(this);">
            <option  value="">Sélectionnez un Type</option>
            <option value="ajouter">+</option>
          
            <?php
            
            require_once FILE::build_path(array('model','BookTypeModel.php'));
        
            $arrayType = BookTypeModel::getAll("bookType","BookTypeModel"); // Appel de la fonction statique

            foreach ($arrayType as $type) {
                echo '<option value="' . $type->getBook_type() . '">' . $type->getBook_type() . '</option>';
            }
            ?>
        </select>
     

<!-- Ajout du submit button, c'est la fin du formulaire -->
<?php
    require FILE::build_path(array('view','form','submit_form.php'));

    ?>
