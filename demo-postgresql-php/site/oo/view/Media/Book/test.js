


var formFiltreLivre = document.getElementById('formFiltreLivre');
var buttonFiltre = document.getElementById('buttonFiltre');

buttonFiltre.addEventListener('onclick', depop());

function depop()
{
    if (formFiltreLivre.classList.contains('d-none'))
    {
        formFiltreLivre.classList.remove('d-none');
        console.log("uwuwuwuwuw");
    }
    else
    {
        maDiv.classList.add('d-none');
        console.log("uwuwuwuwuw");
    }
}