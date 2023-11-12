<h2>liste de tous les livres </h2>

<?php $this->_t="Livres";
require FILE::build_path(array('view','styleList.php'));
?>

<a href="?controller=book&action=create" class="btn btn-primary button_mode_top" id="btn_top">+ Ajouter un livre</a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
<a href="?controller=book&action=create" class="button_mode_bot" id="btn_bot"><p>+</p></a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->


<div class="row mb-2">


    <?php




    foreach ($books as $book): ?>


    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <h3 class="mb-0"><?= $book->getName_media() ?></h3>
                <h5 class="mb-0">Auteur : <?= $book->getName_author() ?></h5>
                <strong class="d-inline-block mb-2 text-primary-emphasis"><?= $book->getLength() . ' ' . $book->getUnite(); ?></strong>
                <strong class="d-inline-block mb-2 text-primary-emphasis">Type : <?= $book->getBook_type() ?></strong>
                <div class="mb-1 text-body-secondary">Date de publication : <?= $book->getPublication_date() ?></div>
                <p class="card-text mb-auto"><?= $book->getDescription() ?></p>
                <p ><?= $book->getAverage_Note() ?>/10</p>
             
                <form method="post" action="?controller=book&action=delete">
                <div class="leftObj">
                    <button type=submit class="btn btn-outline-secondary rounded-pill">- supprimer -</a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
                    <input type='hidden' id='id_media' name='id_media' value=<?= $book->getId_media()?>>
                </div>
                </form>

            </div>
            
            <div class="image-container">                              
                    <img  src=<?= $book->getFile_path() ?> alt='img'>
            </div>


        </div>
    </div>
      

    <?php endforeach; ?>

    <script src="../../script_jolie.js"></script>
</div>