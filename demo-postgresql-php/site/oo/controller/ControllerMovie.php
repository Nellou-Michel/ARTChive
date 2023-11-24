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
        $genre = ControllerMedia::check_if_set_or_not_null_post("genre_id");
        $author = ControllerMedia::check_if_set_or_not_null_post("author");
        $order= ControllerMedia::check_if_set_or_not_null_post("order");
        $sb_title = ControllerMedia::check_if_set_or_not_null_post_and_equalsto("sort_by","title",$order);
        $sb_date =   ControllerMedia::check_if_set_or_not_null_post_and_equalsto("sort_by","date",$order);
        $sb_note =   ControllerMedia::check_if_set_or_not_null_post_and_equalsto("sort_by","note",$order);
        $type = ControllerMedia::check_if_set_or_not_null_post("type");

        $arrayAll = MovieModel::getAllMoviesWithFilter($genre, $type, $author, $sb_title, $sb_date, $sb_note);
       //$arrayAll = MovieModel::getAllMovies();

        //Appel de la vue 'list Movie'
        $this->_view = new View(array('view','Media','Movie','listMovie.php'));
        $this->_view->generate(array('arrayAll' => $arrayAll));

    }

}
?>