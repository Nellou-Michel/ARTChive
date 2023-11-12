<h2>liste de tous les films </h2>

<?php $this->_t="Films";
require FILE::build_path(array('view','styleList.php'));
?>

<a href="?controller=movie&action=create" class="btn btn-primary button_mode_top" id="btn_top">+ Ajouter un film</a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
<a href="?controller=movie&action=create" class="button_mode_bot" id="btn_bot"><p>+</p></a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->



<div class="row mb-2">


    <?php

    foreach ($arrayAll as $obj): ?>


    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <h3 class="mb-0"><?= $obj->getName_media() ?></h3>
                <h5 class="mb-0">Auteur : <?= $obj->getName_author() ?></h5>
                <strong class="d-inline-block mb-2 text-primary-emphasis"><?= $obj->getLength() . ' ' . $obj->getUnite(); ?></strong>
                <strong class="d-inline-block mb-2 text-primary-emphasis">Type : <?= $obj->getMovie_type() ?></strong>
                <div class="mb-1 text-body-secondary">Date de publication : <?= $obj->getPublication_date() ?></div>
                <div class="mb-1 text-body-secondary">Acteurs : <?= $obj->getActors() ?></div>
                <p class="card-text mb-auto"><?= $obj->getDescription() ?></p>
                <p ><?= $obj->getAverage_Note() ?>/10</p>
                <form method="post" action="?controller=obj&action=delete">
                <div class="leftObj">
                    <button type=submit class="btn btn-outline-secondary rounded-pill">- supprimer -</a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
                    <input type='hidden' id='id_media' name='id_media' value=<?= $obj->getId_media()?>>
                </div>
                </form>

            </div>
            
            <div class="image-container">                              
                    <img  src=<?= $obj->getFile_path() ?> alt='img'>
            </div>


        </div>
    </div>
      

    <?php endforeach; ?>

    <script src="../../script_jolie.js"></script>
</div>