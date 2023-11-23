<button id="buttonFiltre">Filter > </button><br><br>

<form class="needs-validation" action="?controller=<?=$category?>&action=readAll" method="post">
    <div id="formFiltre" class="d-none">
        <div class="bg depop d-flex justify-content-around">
            <div>
                <h2>Filtrer les <?=$category?> : </h2>

                <label>Par Genre : </label>
                <input type="text" name="genreFilter"><br>

                <label>Par auteur : </label>
                <input type="text" name="authorFilter"><br>