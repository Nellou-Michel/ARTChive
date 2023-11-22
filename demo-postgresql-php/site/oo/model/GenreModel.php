<?php
require_once File::build_path(array("model","Model.php"));//Model.php

class GenreModel extends Model{

    private $idGenre;
    private $genre;
    private $category;
    
   

    public function getId_genre(){
        return $this->idGenre;
    }

    public function setId_genre($idGenre){
        $this->idGenre = $idGenre;
    }

    public function setGenre($genre){
        $this->genre = $genre;
    }

    public function getGenre(){
        return $this->genre;
    }

    public function setCategory($category){
        $this->category=$category;
    }

    public function getCategory(){
        return$this->category;
    }


    public static function getAllGenresByCategory($category){
        $var = [];
        echo $category;
        $req = DB::get()->prepare("SELECT * FROM Genre
        WHERE category =  :category");
        $values = array("category" => $category);
        $req->execute($values);
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new GenreModel($data);
          
        }
        return $var;
        $req->closeCursor();

       

    }

}