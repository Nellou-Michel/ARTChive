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

    public static function getMovieById($id){
        $req = DB::get()->prepare("SELECT * FROM Media,Movie WHERE Media.id_media = :id_media AND Movie.id_media = :id_media");
        $values = array("id_media" => $id);
        $req->execute($values);
        
        $mediaData = $req->fetch(PDO::FETCH_ASSOC);
    
        // Attention, si il n'y a pas de résultat, on renvoie false
        if (!$mediaData) {
            echo "Pas de média trouvé";
            return false;
        }
    
        // Créez une instance de MediaModel et initialisez-la avec les données du média
        $media = new MovieModel($mediaData);
        return $media;
    }

}