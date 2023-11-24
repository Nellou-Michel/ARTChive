<?php

require_once FILE::build_path(array('view','View.php'));
require_once FILE::build_path(array('model','MusicModel.php'));


class ControllerMusic {
    private $_model;
    private $_view;

    public function __construct(){ 
    }


    public function readAll(){
    
        $genre = ControllerMedia::check_if_set_or_not_null_post("genre_id");
        $author = ControllerMedia::check_if_set_or_not_null_post("author");
        $sb_title =   ControllerMedia::check_if_set_or_not_null_post_and_equalsto("sort_by","title");
        $sb_date =   ControllerMedia::check_if_set_or_not_null_post_and_equalsto("sort_by","date");
        $sb_note =   ControllerMedia::check_if_set_or_not_null_post_and_equalsto("sort_by","note");
        $album = ControllerMedia::check_if_set_or_not_null_post("album");

        $arrayAll = MusicModel::getAllMusicsWithFilter($genre, $album, $author, $sb_title, $sb_date, $sb_note);
        //$arrayAll = MusicModel::getAllMusics();


        //Appel de la vue 'list Music'
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