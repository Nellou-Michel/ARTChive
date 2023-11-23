<button id="buttonFiltre">Filter > </button><br><br>

<form class="needs-validation" action="?controller=<?=strtolower($category)?>&action=readAll" method="post">
    <div id="formFiltre" class="d-none">
        <div class="bg depop d-flex justify-content-around">
            <div>
                <h2>Filtrer les <?=$category?> : </h2>
                <input type="text" name="type" value=<?=$category?> hidden>




                <?php require_once FILE::build_path(array('view','form','form_get_genres.php')); ?>


                <div class="col-12">
                    <label for="author" class="form-label">Auteurs</label>
                    <select class="form-control" name="author" id="author">
                        <option  value="">Sélectionnez un Auteur</option>
                    
                        <?php
                        
                        require_once FILE::build_path(array('model','AuthorModel.php'));
                    
                        $arrayType = AuthorModel::getAll("author","AuthorModel");
                        foreach ($arrayType as $type) {
                            echo '<option value="' . $type->getId_author() . '">' . $type->getName_author() . '</option>';
                        }
                        ?>
                    </select>
                </div>
