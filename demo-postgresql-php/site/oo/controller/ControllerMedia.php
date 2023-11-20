<?php

require_once FILE::build_path(array('view','View.php'));
require_once FILE::build_path(array('model','MediaModel.php'));

class ControllerMedia {
    private $_model;
    private $_view;

    public function __construct(){     
    }


    public function readAll(){
        $medias = MediaModel::getAllMedias();

        //Marche mais pas sécurisé
        //require_once FILE::build_path(array('view','Media','listMedia.php'));

        //Appel de la vue 'list Media'
        $this->_view = new View('list','Media');
        $this->_view->generate(array('medias' => $medias));

    }


    public  function create() {

    }

    // Ajoutez ici d'autres fonctions pour gérer les actions CRUD

    public function created(){
       
            // Supposons que les données du formulaire sont envoyées via POST
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérez les données du formulaire
            $name = $_POST["name_media"];
            $publicationDate = $_POST["publication_date"];
            $description = $_POST["description"];
            $length = $_POST["length"];
            $unit = $_POST["unite"];
            $authorId = $_POST["id_author"];
            $averageNote = $_POST["average_note"];
            $filePath = $_POST["file_path"];
            $genreId = $_POST["genre_id"];
            $category = $_POST["category"];
            $type = isset($_POST["type"]) ? $_POST["type"] : null;
            $album = isset($_POST["album"]) ? $_POST["album"] : null;
            $actors = isset($_POST["actors"]) ? $_POST["actors"] : null;
            $platformId = isset($_POST["platform_id"]) ? $_POST["platform_id"] : null;

            // Appelez la fonction create avec les données du formulaire
            MediaModel::create($name, $publicationDate, $description, $length, $unit, $authorId, $averageNote, $filePath, $genreId, $category, $type, $actors,  $album, $platformId);
        }


        $this->_view = new View('created','Media');
        $this->_view->generate(array(null));
    }


    public function delete(){
        $id = $_POST['id_media'];
        $media = MediaModel::getMediaById($id);     
        $media->delete();
        $this->_view = new View('deleted','Media');
        $this->_view->generate(array(null));       
    }



}
?>
