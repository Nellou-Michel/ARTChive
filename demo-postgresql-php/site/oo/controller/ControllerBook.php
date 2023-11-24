<?php

require_once FILE::build_path(array('view','View.php'));
require_once FILE::build_path(array('model','BookModel.php'));

class ControllerBook {
    private $_model;
    private $_view;

    public function __construct(){     
    }


    public function readAll(){
      
        $genre = ControllerMedia::check_if_set_or_not_null_post("genre_id");
        $author = ControllerMedia::check_if_set_or_not_null_post("author");
        $sb_title = ControllerMedia::check_if_set_or_not_null_post_and_equalsto("sort_by","title");
        $sb_date = ControllerMedia::check_if_set_or_not_null_post_and_equalsto("sort_by","date");
        $sb_note = ControllerMedia::check_if_set_or_not_null_post_and_equalsto("sort_by","note");
        $type = ControllerMedia::check_if_set_or_not_null_post("type");

        $arrayAll = BookModel::getAllBooksWithFilter($genre, $type, $author, $sb_title, $sb_date, $sb_note);
        // $arrayAll = BookModel::getAllBooks();

        //Appel de la vue 'list Book'
        $this->_view = new View(array('view','Media','Book','listBook.php'));
       
        $this->_view->generate(array('arrayAll' => $arrayAll));
    

    }

    public  function create() {

        $this->_view = new View(array('view','Media','Book','createBook.php'));
        $this->_view->generate(array(null));
    }

    public function update(){
        

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id_media'];
            $category = $_POST['category'];
        }
        ;

        $mediaUpdate = BookModel::getBookById($id);
   
        $this->_view = new View(array('view','Media','Book','createBook.php'));
        $this->_view->generate(array('mediaUpdate' => $mediaUpdate));
    }

}
?>
