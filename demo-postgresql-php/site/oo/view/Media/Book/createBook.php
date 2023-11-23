<!-- Ajout du form de base d'un média -->
<?php
 
    $category = "Book";

    if(isset($mediaUpdate)){
        $this->_t="Modifier livre";
    }
    else{
        $this->_t="Créer livre";
    }

    
    require_once FILE::build_path(array('view','form','header_forme.php'));
    require FILE::build_path(array('view','form','body_form.php'));

    //FOR UPDATE ONLY
  

    

?>


<!-- LA STRATEGIE POUR CREER UN NOUVEAU MEDIA EST D ABORD D AJOUTER LE MEDIA DANS MEDIA
PUIS DE L AJOUTER DANS BOOK (OU MUSIC,MOVIES etcc) -->

<!-- AJout du BookType listé pour créer un livre -->
    <div class="col-12">
        <input type="text" name="category" value=<?= $category?> style="display:none;">


        <label for="type" class="form-label">Type</label>
        <select class="form-control" name="type" id="type" onchange="showInputBook(this);">
            <option  value="">--Sélectionnez un Type--</option>
          
            <?php
            
            require_once FILE::build_path(array('model','BookTypeModel.php'));
        
            $arrayType = BookTypeModel::getAll("bookType","BookTypeModel"); // Appel de la fonction statique

            foreach ($arrayType as $type) : ?>
                <option <?= (isset($mediaUpdate) && $mediaUpdate->getBook_type() == $type->getBook_type()) ? "selected" : "" ?> value="<?= $type->getBook_type() ?>">
                    <?= $type->getBook_type() ?>
                </option>
            <?php endforeach; ?>


         
        </select>

        </div>


<!-- Ajout du submit button, c'est la fin du formulaire -->
<?php
    require FILE::build_path(array('view','form','submit_form.php'));

    ?>
