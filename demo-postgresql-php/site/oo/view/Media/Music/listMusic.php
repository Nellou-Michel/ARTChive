<h2>liste de toutes les musiques </h2>

<?php $this->_t="Films";
require FILE::build_path(array('view','styleList.php'));
$category="Music";
?>

<a href="?controller=music&action=create" class="btn btn-primary button_mode_top" id="btn_top">+ Ajouter une musique</a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
<a href="?controller=music&action=create" class="button_mode_bot" id="btn_bot"><p>+</p></a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->

<br>
<!-- Appel du début du form des filtres -->
<?php
require FILE::build_path(array('view','form','header_form_filter.php'));
?>

<!-- Albums  -->
<?php
require FILE::build_path(array('view','form','form_get_album.php'));
?>

<!-- Fin du form des filtres -->
<?php
require FILE::build_path(array('view','form','ending_form_filter.php'));
?>


<div class="row mb-2">


    <?php

    foreach ($arrayAll as $obj): ?>


    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative maxed-h">
        
          
            <!-- Appel de la liste de base du média -->
            <?php
                require FILE::build_path(array('view','Media','listMediaBegin.php'));
            ?>
            <!-- ajout des attributs en plus -->
            <h6 class="d-inline-block mb-2 text-primary-emphasis">Album : <?= $obj->getAlbum() ?></h6> 


             <!-- Appel de la fin liste de base du média -->
             <?php
                require FILE::build_path(array('view','Media','listMediaEnd.php'));
             ?>

        </div>
    </div>
      

    <?php endforeach; ?>

    <script src="../../script_jolie.js"></script>
</div>