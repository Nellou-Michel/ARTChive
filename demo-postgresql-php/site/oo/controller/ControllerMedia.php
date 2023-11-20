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
            // Récupérez le tableau d'ID de genre depuis le formulaire
            // Récupérez le tableau d'ID de genre depuis le formulaire
            $genreIdArray = isset($_POST["genre_id"]) ? $_POST["genre_id"] : array();
            

            $category = $_POST["category"];
            $type = isset($_POST["type"]) ? $_POST["type"] : null;
            $album = isset($_POST["album"]) ? $_POST["album"] : null;
            $actors = isset($_POST["actors"]) ? $_POST["actors"] : null;
            $platforms = isset($_POST["platform"]) ? $_POST["platform"] :array();

 
            // Appelez la fonction create avec les données du formulaire
            MediaModel::create($name, $publicationDate, $description, $length, $unit, $authorId, $averageNote, $filePath, $genreIdArray, $category, $type, $actors,  $album, $platforms);
        }


        $this->_view = new View(array('view','Media','createdMedia.php'));
        $this->_view->generate(array(null));
    }


    public function delete(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST['id_media'];
                $category = $_POST['category'];
        }
       
        MediaModel::delete($id,$category);
        $this->_view = new View(array('view','Media','deletedMedia.php'));
        $this->_view->generate(array(null));       
    }



}
?>
