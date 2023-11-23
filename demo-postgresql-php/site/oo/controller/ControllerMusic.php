<?php

require_once FILE::build_path(array('view','View.php'));
require_once FILE::build_path(array('model','MusicModel.php'));


class ControllerMusic {
    private $_model;
    private $_view;

    public function __construct(){ 
    }


    public function readAll(){
    
        $genre = isset($_GET["genre"]) ? $_GET["genre"] : null;
        $author = isset($_GET["author"]) ? $_GET["author"] : null;
        $sb_title = isset($_GET["sort_by_title"]) ? $_GET["sort_by_title"] : null;
        $sb_date = isset($_GET["sort_by_date"]) ? $_GET["sort_by_date"] : null;
        $sb_note = isset($_GET["sort_by_note"]) ? $_GET["sort_by_note"] : null;
        $album = isset($_GET["album"]) ? $_GET["album"] : null;
        $arrayAll = MusicModel::getAllMusicsWithFilter($genre, $album, $author, $sb_title, $sb_date, $sb_note);

        //Appel de la vue 'list Book'
        $this->_view = new View(array('view','Media','Music','listMusic.php'));
        $this->_view->generate(array('arrayAll' => $arrayAll));

    }

    public  function create() {

        $this->_view = new View(array('view','Media','Music','createMusic.php'));
        $this->_view->generate(array(null));
    }

}
?>