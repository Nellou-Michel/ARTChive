
</div>
            <div>
                <h2>Classer les <?=$category?> : </h2>

                <label>Alphabétique : </label>
                <input checked type="radio" name="sort_by" value="title"><br>

                <label>Par date : </label>
                <input type="radio" name="sort_by" value="date"><br>

                <label>Par Note : </label>
                <input type="radio" name="sort_by" value="note"><br><br>

                <label>Croissant : </label>
                <input checked type="radio" name="order" value="asc">
                <label>Décroissant : </label>
                <input type="radio" name="order" value="desc"><br><br>
            </div>
        </div>
    </div>
    <button type="submit">Filtrer</button>
</form>

<br>

<script>
        var formFiltre = document.getElementById('formFiltre');
        var buttonFiltre = document.getElementById('buttonFiltre');

        buttonFiltre.addEventListener('click', depop);

        function depop()
        {
            if (formFiltre.classList.contains('d-none'))
            {
                formFiltre.classList.remove('d-none');
                buttonFiltre.innerHTML = " Filter <";
            }
            else
            {
                formFiltre.classList.add('d-none');
                buttonFiltre.innerHTML = " Filter >";
            }
        }
</script>