
<body class="bg-body-tertiary">
<div class="container-md">
    <div class="col-lg-12">
        <div class="flex-row">
            <div class="col-sm-6">
                <h3 class="mb-3"><?= (isset($mediaUpdate) != null) ? "Modifier un ".$category : "Créer un nouveau ".$category ?></h3>
                <form class="needs-validation" action="?controller=media&action=<?=(isset($mediaUpdate) == null) ? "created" : "updated" ?>" method="post" novalidate>
                    <div class="row g-3">

                    <?php
                        if (isset($mediaUpdate)) {
                            echo '<div class="col-xxl-12">
                                <label for="name_media" class="form-label" >ID</label>
                                <input type="text" class="form-control" id="idmedia" name="id_media" value="' . $mediaUpdate->getId_media() . '" readonly>
                                <div class="invalid-feedback">
                                    Sélectionnez un nom de média valide
                                </div>
                            </div>';
                        }
                    ?>
                   

                        <div class="col-xxl-12">
                            <label for="name_media" class="form-label" >Nom du Média</label>
                            <input type="text" class="form-control" id="firstName" name="name_media" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getName_media() : "" ?>" required>
                            <div class="invalid-feedback">
                                Selectionnez un nom de média valid
                            </div>
                        </div>

                        <!-- FORM AUTHORS -->
                        <?php require_once FILE::build_path(array('view','form','form_get_authors.php')); ?>

                      
                        <!-- FORM GENRES -->
                        <?php require_once FILE::build_path(array('view','form','form_get_genres.php')); ?>



                        <div class="col-12">
                            <label for="publication_date" class="form-label">Date de publication</label>
                            <div class="input-group has-validation">
                                <!-- <span class="input-group-text">@</span> -->
                                <input type="date" id="publication_date" name="publication_date" class="form-control" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getPublication_date() : "" ?>" required>
                                <div class="invalid-feedback">
                                    Selectionnez une date valide
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Description</label>
                            <div class="input-group has-validation">
                                <!-- <span class="input-group-text">@</span> -->
                                <textarea id="description" name="description" class="form-control" ><?= (isset($mediaUpdate) != null) ? $mediaUpdate->getDescription() : "" ?></textarea>
                                <div class="invalid-feedback">
                                    Selectionnez une description conforme
                                </div>
                            </div>

                        </div>

                        <div class="col-6">
                            <label class="form-label" for="length">Durée</label>
                            <input type="text" class="form-control" name="length" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getLength() : "" ?>">
                            <div class="invalid-feedback">
                                Selectionnez une durée valide
                            </div>
                        </div>

                        <div class="col-6">
                            <label class="form-label" for="unite">Unité</label>
                            <select class="form-control" id="unite" name="unite">
                                <option <?= (isset($mediaUpdate) != null && $mediaUpdate->getUnite()=="minutes") ? "selected" : "" ?> value="minutes">Minutes</option>
                                <option <?= (isset($mediaUpdate) != null && $mediaUpdate->getUnite()=="heures") ? "selected" : "" ?> value="heures">Heures</option>
                                <option <?= (isset($mediaUpdate) != null && $mediaUpdate->getUnite()=="pages") ? "selected" : "" ?> value="pages">Pages</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="average_note">Note Moyenne</label>
                            <div class="input-group has-validation">
                                <input type="number" class="form-control" id="average_note" name="average_note" min="0" max="10" step="0.1" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getAverage_note() : "" ?>" required>
                                <span class="input-group-text">/10</span>
                                <div class="invalid-feedback">
                                    Selectionnez une note entre 0 et 10
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label" for="file_path">Image</label>
                            <div class="input-group has-validation">
                                <input type="text" id="file_path" name="file_path" placeholder="url de l'image" class ="form-control" value="<?= (isset($mediaUpdate) != null) ? $mediaUpdate->getFile_path() : "" ?>" required>
                                <div class="invalid-feedback">
                                    Selectionnez un url valide
                                </div>
                            </div>

                        </div>

                        

