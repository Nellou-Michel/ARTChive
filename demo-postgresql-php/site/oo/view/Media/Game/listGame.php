<h2>liste de tous les Jeux </h2>

<?php $this->_t="Jeux";
require FILE::build_path(array('view','styleList.php'));
$category="Game";
?>

<a href="?controller=game&action=create" class="btn btn-primary button_mode_top" id="btn_top">+ Ajouter un jeu</a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
<a href="?controller=game&action=create" class="button_mode_bot" id="btn_bot"><p>+</p></a> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->

<br>
<button id="buttonFiltre">Filter > </button><br><br>

<div id="formFiltreLivre" class="d-none">
    <div  class="bg depop d-flex justify-content-around">
        <div>
        <h2>Filtrer les Jeux : </h2>
        <form>
            <label>Par Genre : </label>
            <input type="checkbox" name="toggleGroup" value="genre"></input>
            <input type="option"></input><br>

            <label>Par plateforme : </label>
            <input type="checkbox" name="toggleGroup" value="plateforme"></input>
            <input type="option"></input><br>

            <label>Par auteur : </label>
            <input type="checkbox" name="toggleGroup" value="auteur"></input>
            <input type="option"></input><br>


       </div>
       <div>
            <h2>Classer les Jeux : </h2>

            <label>Alphabetique : </label>
            <input checked type="radio" name="toggleGroup2" value="Alphabetique"></input>
            <br>

            <label>Par date : </label>
            <input type="radio" name="toggleGroup2" value="date"></input>
            <br>

            <label>Par Note : </label>
            <input type="radio" name="toggleGroup2" value="Note"></input><br><br>

            <span>Décroissant :</span> <input type="checkbox"></input>
        </form>
       </div>

    </div>
           <button type submit>Filtrer</button>
</div>
            <br>

    <script>
            var formFiltreLivre = document.getElementById('formFiltreLivre');
            var buttonFiltre = document.getElementById('buttonFiltre');

            buttonFiltre.addEventListener('click', depop);

            function depop()
            {
                if (formFiltreLivre.classList.contains('d-none'))
                {
                    formFiltreLivre.classList.remove('d-none');
                    buttonFiltre.innerHTML = " Filter <";
                }
                else
                {
                    formFiltreLivre.classList.add('d-none');
                    buttonFiltre.innerHTML = " Filter >";
                }
            }
    </script>

<div class="row mb-2">


<?php

foreach ($arrayAll as $obj): ?>
    
    
    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative maxed-h">
        
        
        <!-- Appel de la liste de base du média -->
        <?php
        require FILE::build_path(array('view','Media','listMediaBegin.php'));
        ?>
        
        <!-- ajout des attributs en plus -->
        <!-- Liste des platformes -->
        <?php
            $platforms = $obj->getPlatforms();
            echo('<h6 class="mb-0"> Platformes : </h6>
            <ul>');
            foreach($platforms as $platform){
                echo ' <li>'.$platform->getPlatform().' </li> ' ;
            }
            echo('</ul>');
        ?>
        
         <!-- Appel de la fin liste de base du média -->
         <?php
                require FILE::build_path(array('view','Media','listMediaEnd.php'));
            ?>
        </div>
    </div>
        
        
    <?php endforeach; ?>
    
    <script src="../../script_jolie.js"></script>
</div>