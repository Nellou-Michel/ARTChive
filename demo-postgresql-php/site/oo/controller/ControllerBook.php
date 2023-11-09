<?php

require_once FILE::build_path(array('view','View.php'));
require_once FILE::build_path(array('model','BookModel.php'));

class ControllerBook {
    private $_model;
    private $_view;

    public function __construct(){     
    }


    public function readAll(){
        $books = BookModel::getAllBooks();

        //Appel de la vue 'list Book'
        $this->_view = new View(array('view','Media','Book','listBook.php'));
        $this->_view->generate(array('books' => $books));

    }

}
?>
