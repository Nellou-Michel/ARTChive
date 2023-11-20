<?php

require_once FILE::build_path(array('view','View.php'));
require_once FILE::build_path(array('model','MovieModel.php'));


class ControllerMovie {
    private $_model;
    private $_view;

    public function __construct(){ 
    }

    public  function create() {

        $this->_view = new View(array('view','Media','Movie','createMovie.php'));
        $this->_view->generate(array(null));
    }

    public function readAll(){
       
        $arrayAll = MovieModel::getAllMovies();

        //Appel de la vue 'list Book'
        $this->_view = new View(array('view','Media','Movie','listMovie.php'));
        $this->_view->generate(array('arrayAll' => $arrayAll));

    }

}
?>