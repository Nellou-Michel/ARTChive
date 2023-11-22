<?php

require_once FILE::build_path(array('view','View.php'));
require_once FILE::build_path(array('model','MusicModel.php'));


class ControllerMusic {
    private $_model;
    private $_view;

    public function __construct(){ 
    }


    public function readAll(){
       
        $arrayAll = MusicModel::getAllMusics();

        //Appel de la vue 'list Book'
        $this->_view = new View(array('view','Media','Music','listMusic.php'));
        $this->_view->generate(array('arrayAll' => $arrayAll));

    }

    public  function create() {

        $this->_view = new View(array('view','Media','Music','createMusic.php'));
        $this->_view->generate(array(null));
    }

    public function update(){
        

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id_media'];
            $category = $_POST['category'];
        }
        ;

        $mediaUpdate = MusicModel::getMusicById($id);
   
        $this->_view = new View(array('view','Media','Music','createMusic.php'));
        $this->_view->generate(array('mediaUpdate' => $mediaUpdate));
    }

}
?>