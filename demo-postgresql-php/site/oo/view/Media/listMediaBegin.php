<div class="col p-4 d-flex flex-column position-static maxed-w">

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