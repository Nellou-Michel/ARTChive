<style>



    h3 {
        font-size: 27px;
        font-family: "Microsoft PhagsPa";
        font-width: 700;
    }
    
    .bouton-node{
        position: relative;
        width: 5vh;
        height: 5vh;
        top: -23vh;
        left: 10vh;
        z-index: 88;
        color: transparent;
        border: transparent;
    }

    .maxed-h:hover button{
        background-color: red;
        color: white;
        font-family: Arial;
        font-weight: 700;
    }

    .image-container {
        width: 40%; /* Largeur du conteneur à 50% de la largeur de la fenêtre */
        transition: 1s;
        max-height: 400px;
        min-height: 400px;
    }

    .maxed-h:hover img{
        filter: grayscale(100%);
        transition: .3s;
    }

    .maxed-w {
        max-width: 60%;
    }

    .maxed-h {
        max-height: 400px;
        min-height: 400px;
        word-wrap: break-word;
        overflow-y: auto;
    }

    .image-container img {
        width: 100%; /* Largeur de l'image à 100% de la largeur du conteneur */
        height: 100%; /* La hauteur est automatiquement ajustée pour conserver les proportions de l'image */
        filter: grayscale(0%);
        /* Spécifier la manière dont l'image doit être ajustée */
        object-fit: cover;

        /* Spécifier la position de l'image dans son conteneur */
        object-position: center;
    }

    .leftObj{
        left:0;
    }

    .button_mode_top {
        margin-bottom: 10px;
        display: inline-block;
    }

    .button_mode_bot {
        display: flex;
        justify-content: center;
        background-color: #0D6EFD;
        width: 40px;
        height: 40px;
        border-radius: 50px;
        position: fixed;
        bottom: 5vh;
        right: 5vh;
        z-index: 58;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        text-decoration: none;
        display: none   ;
    }

    .button_mode_bot p {
        color: white;
        font-size: 24.5px;
        font-weight: 600;
    }


        
    </style>
