<h2>Liste de tous les livres </h2>

<?php $this->_t="Livres";
require FILE::build_path(array('view','styleList.php'));
$category="Book";
?>

<a href="?controller=book&action=create" class="btn btn-primary button_mode_top" id="btn_top">+ Ajouter un livre</a><br> <!-- Remplacez 'votre-lien' par l'URL souhaitée -->
<a href="?controller=book&action=create" class="button_mode_bot" id="btn_bot"><p>+</p></a> <!-- Remplacez 'votre-lien' par l'URL souhaitée-->



<button id="buttonFiltre">Filter > </button><br><br>

<div id="formFiltreLivre" class="d-none">
    <div  class="bg depop d-flex justify-content-around">
        <div>
        <h2>Filtrer les livres : </h2>
        <form>
            <label>Par Genre : </label>
            <input type="checkbox" name="toggleGroup" value="genre"></input>
            <input type="option"></input><br>

            <label>Par Auteur : </label>
            <input type="checkbox" name="toggleGroup" value="auteur"></input>
            <input type="option"></input><br>

            <label>Par Type : </label>
            <input type="checkbox" name="toggleGroup" value="type"></input>
            <input type="option"></input><br>


       </div>
       <div>
            <h2>Classer les livres : </h2>

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


    <?php foreach ($arrayAll as $obj): ?>


    <div class="col-md-6">
        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative maxed-h">
           
        <!-- Appel du début de la liste de base du média -->
            <?php
                require FILE::build_path(array('view','Media','listMediaBegin.php'));
            ?>

        <!-- ajout des attributs en plus -->
        <strong class="d-inline-block mb-2 text-primary-emphasis">Type : <?= $obj->getBook_type() ?></strong>



         <!-- Appel de la fin liste de base du média -->
         <?php require FILE::build_path(array('view','Media','listMediaEnd.php')); ?>

        </div>
    </div>
      

    <?php endforeach; ?>

    <script src="../../script_jolie.js"></script>
</div>