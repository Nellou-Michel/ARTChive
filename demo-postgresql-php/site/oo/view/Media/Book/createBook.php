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


<?php
    require FILE::build_path(array('view','form','form_get_type_book.php'));

    ?>
     

<!-- Ajout du submit button, c'est la fin du formulaire -->
<?php
    require FILE::build_path(array('view','form','submit_form.php'));
?>
