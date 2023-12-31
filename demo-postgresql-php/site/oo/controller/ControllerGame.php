<?php

require_once FILE::build_path(array('view','View.php'));
require_once FILE::build_path(array('model','GameModel.php'));

class ControllerGame {
    private $_model;
    private $_view;

    public function __construct(){ 
    }


    public function readAll(){
        
        $genre = ControllerMedia::check_if_set_or_not_null_post("genre_id");
        $author = ControllerMedia::check_if_set_or_not_null_post("author");

        $order= ControllerMedia::check_if_set_or_not_null_post("order");
        $sb_title = ControllerMedia::check_if_set_or_not_null_post_and_equalsto("sort_by","title",$order);
        $sb_date =   ControllerMedia::check_if_set_or_not_null_post_and_equalsto("sort_by","date",$order);
        $sb_note =   ControllerMedia::check_if_set_or_not_null_post_and_equalsto("sort_by","note",$order);
        $platform_game = ControllerMedia::check_if_set_or_not_null_post("platform");

      
        $arrayAll = GameModel::getAllGamesWithFilter($genre, $platform_game, $author, $sb_title, $sb_date, $sb_note);
       //$arrayAll = GameModel::getAllGames();

       
        //Appel de la vue 'list Game'
        $this->_view = new View(array('view','Media','Game','listGame.php'));
        $this->_view->generate(array('arrayAll' => $arrayAll));

    }

    public  function create() {

        $this->_view = new View(array('view','Media','Game','createGame.php'));
        
        $this->_view->generate(array(null));
    }


    public function update(){
        

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id_media'];
            $category = $_POST['category'];
        }
        ;

        $mediaUpdate = GameModel::getGameById($id);
   
        $this->_view = new View(array('view','Media','Game','createGame.php'));
        $this->_view->generate(array('mediaUpdate' => $mediaUpdate));
    }

}
?>