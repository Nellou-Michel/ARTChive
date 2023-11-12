<?php
require_once File::build_path(array("model","Model.php"));//Model.php

class MovieModel extends MediaModel{

    private $idMedia;
    private $actors;
    private $movieType;
   

    public function getId_media(){
        return $this->idMedia;
    }

    public function setId_media($idMedia){
        $this->idMedia = $idMedia;
    }

    public function setActors($actors){
        $this->actors = $actors;
    }

    public function getActors(){
        return $this->actors;
    }

    public function setMovie_type($movieType){
        $this->movieType = $movieType;
    }

    public function getMovie_type(){
        return $this->movieType;
    }


    public static function getAllMovies(){
        $var = [];
        $req = DB::get()->prepare('SELECT * FROM movie, media
        WHERE movie.id_media = media.id_media');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new MovieModel($data);
          
        }
        return $var;
        $req->closeCursor();
    }


}