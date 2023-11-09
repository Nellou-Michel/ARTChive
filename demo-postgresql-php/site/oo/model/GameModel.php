<?php
require_once File::build_path(array("model","Model.php"));//Model.php

class GameModel extends MediaModel{

    private $idMedia;
    
   

    public function getId_media(){
        return $this->idMedia;
    }

    public function setId_media($idMedia){
        $this->idMedia = $idMedia;
    }


    public static function getAllGames(){
        $var = [];
        $req = DB::get()->prepare('SELECT * FROM game, media
        WHERE game.id_media = media.id_media');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new GameModel($data);
          
        }
        return $var;
        $req->closeCursor();
    }


}