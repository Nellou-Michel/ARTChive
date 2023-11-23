<h2>Liste de tous les livres </h2>

<?php $this->_t="Livres";
require FILE::build_path(array('view','styleList.php'));
$category="Book";
?>

<a href="?controller=book&action=create" class="btn btn-primary button_mode_top" id="btn_top">+ Ajouter un livre</a><br> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
<a href="?controller=book&action=create" class="button_mode_bot" id="btn_bot"><p>+</p></a> <!-- Remplacez 'votre-lien' par l'URL souhaitée-->



<!-- Appel du début du form des filtres -->
<?php
require FILE::build_path(array('view','form','header_form_filter.php'));
?>
            <label>Par Type : </label>
            <input type="option" name="typeFilter"><br>


<!-- Fin du form des filtres -->
<?php
require FILE::build_path(array('view','form','ending_form_filter.php'));
?>



<div class="row mb-2">


    <?php foreach ($arrayAll as $obj): ?>


    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative maxed-h">
           
        <!-- Appel du début de la liste de base du média -->
            <?php
                require FILE::build_path(array('view','Media','listMediaBegin.php'));
            ?>

        <!-- ajout des attributs en plus -->
        <strong class="d-inline-block mb-2 text-primary-emphasis">Type : <?= $obj->getBook_type() ?></strong>



         <!-- Appel de la fin liste de base du média -->
         <?php require FILE::build_path(array('view','Media','listMediaEnd.php')); ?>

        </div>
    </div>
      

    <?php endforeach; ?>

    <script src="../../script_jolie.js"></script>
</div>