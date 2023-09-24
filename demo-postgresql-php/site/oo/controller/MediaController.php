<?php

require_once FILE::build_path(array('view','View.php'));
require_once FILE::build_path(array('model','MediaModel.php'));

class MediaController {
    private $_model;
    private $_view;

    public function __construct($url){
     
        

        if(isset($url) && count($url)>1){
            echo 'page introuvable pour media controller';
            throw new Exception('Page introuvable');

        }
        else{
           if(isset($_GET['action'])){
                $action = $_GET['action'];
                switch ($action){
                    case 'create':
                        
                        $this->createMedia();
                        break;

                    case 'created':
                      
                        $this->createdMedia();
                        break;
                    case 'delete':
                      
                        $this->deleteMedia();
                        break;
                }
              
           
            }
            else{
                $this->getAllMedia();
            }
           
          
        }
    }


    private function getAllMedia(){
        $medias = MediaModel::getAllMedias();

        //Marche mais pas sécurisé
        //require_once FILE::build_path(array('view','Media','listMedia.php'));


        //Appel de la vue 'list Media'
        $this->_view = new View('list','Media');
        $this->_view->generate(array('medias' => $medias));


    }


    public  function createMedia() {
       // return $this->_model->createMedia($data);

       $this->_view = new View('create','Media');
       $this->_view->generate(array(null));
    }

    // Ajoutez ici d'autres fonctions pour gérer les actions CRUD

    public function createdMedia(){
       
        $data = [
            'name_media' => $_POST['name_media'],
            'publication_date' => $_POST['publication_date'],
            'description' => $_POST['description'],
            'length' => $_POST['length'],
            'unite' => $_POST['unite'],
            'average_note' => $_POST['average_note'],
            'file_path' => $_POST['file_path']
        ];
    
        // Créer un nouvel objet Media
        $media = new MediaModel($data);
    
        // Enregistrer le média en base de données
        $media->save();

       
        $this->_view = new View('created','Media');
        $this->_view->generate(array(null));

   
    }


    public function deleteMedia(){

       

        $id = $_POST['id_media'];

       


        $media = MediaModel::getMediaById($id);

        
        $media->delete();

        $this->_view = new View('deleted','Media');
        $this->_view->generate(array(null));


        
    }



}
?>
