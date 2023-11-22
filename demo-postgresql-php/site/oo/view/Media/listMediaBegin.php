<div class="col p-4 d-flex flex-column position-static">

                <!-- UpdateForm -->
                <form method="post" action="?controller=<?=strtolower($category)?>&action=update">
                    <input type="text" name="category" value=<?= $category?> style="display:none;">

                    <div class="leftObj">
                        <button type=submit class="btn btn-outline-secondary rounded-pill">- update -</a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
                        <input type='hidden' id='id_media' name='id_media' value=<?= $obj->getId_media()?>>
                    </div>
                </form>

                <h3 class="mb-0"><?= $obj->getName_media() ?></h3>
              
                <h5 class="mb-0">Auteur : <?= $obj->getName_author() ?></h5>
                <strong class="d-inline-block mb-2 text-primary-emphasis"><?= $obj->getLength() . ' ' . $obj->getUnite(); ?></strong>
                <!-- Liste des Genres -->
                <?php
                    $genres = $obj->getGenres();
                    echo('<h6 class="mb-0"> Genres : </h6>
                    <ul>');
                    foreach($genres as $genre){
                        echo ' <li>'.$genre->getGenre().'('.$genre->getCategory().')</li> ' ;
                    }
                    echo('</ul>');


                ?>
                <div class="mb-1 text-body-secondary">Date de publication : <?= $obj->getPublication_date() ?></div>
               
<!-- début du média = nom, auteur, unité, genres, date de publication -->