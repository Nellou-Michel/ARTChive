<h2>liste de tous les films </h2>

<?php $this->_t="Films";
require FILE::build_path(array('view','styleList.php'));
$category="Movie";
?>

<a href="?controller=movie&action=create" class="btn btn-primary button_mode_top" id="btn_top">+ Ajouter un film</a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
<a href="?controller=movie&action=create" class="button_mode_bot" id="btn_bot"><p>+</p></a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->



<div class="row mb-2">


    <?php

    foreach ($arrayAll as $obj): ?>
        
        <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            
                <!-- Appel de la liste de base du média -->
                <?php
                require FILE::build_path(array('view','Media','listMediaBegin.php'));
                ?>
                
                <!-- ajout des attributs en plus -->
                <strong class="d-inline-block mb-2 text-primary-emphasis">Type : <?= $obj->getMovie_type() ?></strong>
                <div class="mb-1 text-body-secondary">Acteurs : <?= $obj->getActors() ?></div>


                 <!-- Appel de la fin liste de base du média -->
                <?php
                    require FILE::build_path(array('view','Media','listMediaEnd.php'));
                ?>
                
            
            </div>
        </div>
        
        
    <?php endforeach; ?>
    
    <script src="../../script_jolie.js"></script>
</div>