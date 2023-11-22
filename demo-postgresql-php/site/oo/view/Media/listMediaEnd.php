<p class="card-text mb-auto"><?= $obj->getDescription() ?></p>
                <p ><?= $obj->getAverage_Note() ?>/10</p>
                <form method="post" action="?controller=media&action=delete">
                    <input type="text" name="category" value=<?= $category?> style="display:none;">

                    <div class="leftObj">
                        <button type=submit class="btn btn-outline-secondary rounded-pill">- supprimer -</a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
                        <input type='hidden' id='id_media' name='id_media' value=<?= $obj->getId_media()?>>
                    </div>
                </form>
                
            

</div>
<div class="image-container">                              
        <img  src=<?= $obj->getFile_path() ?> alt='img'>
</div>

<!-- description + image = fin du média -->