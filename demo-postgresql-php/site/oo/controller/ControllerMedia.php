<?php

require_once FILE::build_path(array('view','View.php'));
require_once FILE::build_path(array('model','MediaModel.php'));

class ControllerMedia {
    private $_model;
    private $_view;

    public function __construct(){     
    }


    public function readAll(){
        
    }


    public  function create() {

    }

    public function update() {

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




    public function updated() {
        // Récupérer les données du formulaire ou de la requête
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupérez les données du formulaire
            $id = $_POST["id_media"];
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

            // Appeler la méthode de mise à jour du modèle
            MediaModel::update($id, $name, $publicationDate, $description, $length, $unit, $authorId, $averageNote, $filePath, $genreIdArray, $category, $type, $actors, $album, $platforms);      
        }

        // Rediriger ou afficher une vue
        $this->_view = new View(array('view','Media','modifiedMedia.php'));
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


    public static function check_if_set_or_not_null_post($var){
       
        if(isset($_POST[$var])){
            if($_POST[$var]==""){
                return null;
            }
            return $_POST[$var];
        }
        else{
            return null;
        }
    }

    public static function check_if_set_or_not_null_post_and_equalsto($var, $val, $order){
        $result =ControllerMedia::check_if_set_or_not_null_post($var);
       if($result!=null && $result==$val){
            return $order;
       }
       return null;
      
    }



}
?>
