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
<?php
    require FILE::build_path(array('view','form','form_get_platform.php'));
?>
     

<!-- Ajout du submit button, c'est la fin du formulaire -->
<?php
    require FILE::build_path(array('view','form','submit_form.php'));
?>