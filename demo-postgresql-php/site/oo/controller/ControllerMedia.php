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

       $this->_view = new View('create','Media');
       $this->_view->generate(array(null));
    }

    // Ajoutez ici d'autres fonctions pour gérer les actions CRUD

    public function created(){
       
        $data = [
            'name_media' => $_POST['name_media'],
            'publication_date' => $_POST['publication_date'],
            'description' => $_POST['description'],
            'length' => $_POST['length'],
            'unite' => $_POST['unite'],
            'average_note' => $_POST['average_note'],
            'file_path' => $_POST['file_path'],
            'id_author' =>    $_POST['id_author']
        ];
    
        // Créer un nouvel objet Media
        $media = new MediaModel($data);   
        // Enregistrer le média en base de données
        $media->save();       
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
