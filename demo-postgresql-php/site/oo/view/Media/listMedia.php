<h2>liste de tous les medias </h2>

<?php $this->_t="Medias"?>

<a href="?url=media&action=create" class="btn btn-primary">+ Ajouter un media</a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->

<style>
        .image-container {
            width: 30%; /* Largeur du conteneur à 50% de la largeur de la fenêtre */
        }

        .image-container img {
            width: 100%; /* Largeur de l'image à 100% de la largeur du conteneur */
            height: auto; /* La hauteur est automatiquement ajustée pour conserver les proportions de l'image */
        }

        .leftObj{
            left:0;
        }

        
    </style>

<div class="row mb-2">


    <?php

    foreach ($medias as $media): ?>


    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
            <div class="col p-4 d-flex flex-column position-static">
                <h3 class="mb-0"><?= $media->getName_media() ?></h3>
                <strong class="d-inline-block mb-2 text-primary-emphasis"><?= $media->getLength() . ' ' . $media->getUnite(); ?></strong>
                <div class="mb-1 text-body-secondary">Date de publication : <?= $media->getPublication_date() ?></div>
                <p class="card-text mb-auto"><?= $media->getDescription() ?></p>
                <p ><?= $media->getAverage_Note() ?>/10</p>

                <form method="post" action="?url=media&action=delete">
                <div class="leftObj">
                    <button type=submit class="btn btn-outline-secondary rounded-pill">- supprimer -</a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
                    <input type='hidden' id='id_media' name='id_media' value=<?= $media->getId_media()?>>
                </div>
                </form>

            </div>
            
            <div class="image-container">                              
                    <img  src=<?= $media->getFile_path() ?> alt='img'>
            </div>


        </div>
    </div>
      

    <?php endforeach; ?>

        
</div>