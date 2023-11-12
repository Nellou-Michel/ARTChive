<style>
        .image-container {
            width: 30%; /* Largeur du conteneur à 50% de la largeur de la fenêtre */
        }

        .image-container img {
            width: 100%; /* Largeur de l'image à 100% de la largeur du conteneur */
            height: auto; /* La hauteur est automatiquement ajustée pour conserver les proportions de l'image */
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
