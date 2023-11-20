<!-- Ajout du form de base d'un média -->
<?php
    $this->_t="Créer Livre";
    $category = "Book";
    require_once FILE::build_path(array('view','form','header_forme.php'));
    require FILE::build_path(array('view','form','body_form.php'));

?>

<!-- LA STRATEGIE POUR CREER UN NOUVEAU MEDIA EST D ABORD D AJOUTER LE MEDIA DANS MEDIA
PUIS DE L AJOUTER DANS BOOK (OU MUSIC,MOVIES etcc) -->

<!-- AJout du BookType listé pour créer un livre -->
    <div class="col-12">
        <input type="text" name="category" value=<?= $category?> style="display:none;">


        <label for="type" class="form-label">Type</label>
        <select class="form-control" name="type" id="type" onchange="showInputBook(this);">
            <option  value="">--Sélectionnez un Type--</option>
            <option value="+">+</option>
          
            <?php
            
            require_once FILE::build_path(array('model','BookTypeModel.php'));
        
            $arrayType = BookTypeModel::getAll("bookType","BookTypeModel"); // Appel de la fonction statique

            foreach ($arrayType as $type) {
                echo '<option value="' . $type->getBook_type() . '">' . $type->getBook_type() . '</option>';
            }
            ?>


         
        </select>
        <input type="text" name="newBookType" id="newBookType" style="display:none;">

        </div>
        <script>
                function showInputBook(select) {
                    var newInput = document.getElementById("newBookType");

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
