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

    public static function getAllMoviesWithFilter($genre, $type, $author, $sb_title, $sb_date, $sb_note) {
        $media_list = [];
        $movie_list = [];
        $req = DB::get()->prepare("select * from get_movies_by_genre_type_author_date_note(
            :genre, :type, :author, :sort_by_title, :sort_by_date, :sort_by_note)");
        $values = array(
        "genre" => $genre, 
        "type" => $type, 
        "author" => $author,
        "sort_by_title" => $sb_title,
        "sort_by_date" => $sb_date,
        "sort_by_note" => $sb_note
        );
        $req->execute($values);
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $media_list[] = new MediaModel($data);
        }
        foreach ($media_list as $media) {
            $req_join = DB::get()->prepare("select * from Movie m, Media where m.id_media = :id");
            $values = array("id" => $media->getId_media());
            $req_join->execute($values);
            while($data = $req_join->fetch(PDO::FETCH_ASSOC)){
                $movie_list[] = new MovieModel($data);
            }
        }
        return $movie_list;
    }


}