<?php
require_once File::build_path(array("model","Model.php"));//Model.php

class PlayableOn extends Model{

    private $idGame;
    private $platform;
    
   

    public function getId_game(){
        return $this->idGame;
    }

    public function setId_game($idGame){
        $this->idGame = $idGame;
    }

    public function setPlatform($platform){
        $this->platform = $platform;
    }
    public function getPlatform(){
        return $this->platform;
    }


    public static function getPlatformsByIdGame($idMedia){
        $var = [];
        $req = DB::get()->prepare('SELECT * FROM PlayableOn
        WHERE id_game = :id_media');
        $values = array("id_media" => $idMedia);
        $req->execute($values);
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new PlayableOn($data);
          
        }
        return $var;
        $req->closeCursor();
    }


}