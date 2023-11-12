<h2>liste de tous les livres </h2>

<?php $this->_t="Livres";
require FILE::build_path(array('view','styleList.php'));
?>

<a href="?controller=book&action=create" class="btn btn-primary button_mode_top" id="btn_top">+ Ajouter un livre</a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
<a href="?controller=book&action=create" class="button_mode_bot" id="btn_bot"><p>+</p></a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->


<div class="row mb-2">


    <?php




    foreach ($arrayAll as $obj): ?>


    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
           
        <!-- Appel du début de la liste de base du média -->
            <?php
                require FILE::build_path(array('view','Media','listMediaBegin.php'));
            ?>

        <!-- ajout des attributs en plus -->
        <strong class="d-inline-block mb-2 text-primary-emphasis">Type : <?= $obj->getBook_type() ?></strong>



         <!-- Appel de la fin liste de base du média -->
         <?php
                require FILE::build_path(array('view','Media','listMediaEnd.php'));
            ?>

        </div>
    </div>
      

    <?php endforeach; ?>

    <script src="../../script_jolie.js"></script>
</div>