<?php
require_once File::build_path(array("model","Model.php"));//Model.php
require_once File::build_path(array("model","GenreModel.php"));//Model.php

class GenreMediaModel extends Model{

    private $idGenre;
    private $idMedia;
    
   

    public function getId_genre(){
        return $this->idGenre;
    }

    public function setId_genre($idGenre){
        $this->idGenre = $idGenre;
    }

    public function getId_media(){
        return $this->idMedia;
    }

    public function setId_media($idMedia){
        $this->idMedia = $idMedia;
    }


    public static function getGenresByIdMedia($idMedia){
        $var = [];
        $req = DB::get()->prepare('SELECT Genre.id_genre, genre, category FROM Genre 
        JOIN GenreMedia on GenreMedia.id_genre = Genre.id_genre
        WHERE id_media = :id_media');
        $values = array("id_media" => $idMedia);
        $req->execute($values);
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new GenreModel($data);
          
        }
        return $var;
        $req->closeCursor();
    }


}