<?php
require_once File::build_path(array("model","Model.php"));//Model.php

class AuthorModel extends Model{

    private $id_author;
    private $name_author;

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    public function setId_author($id_author){
        $this->id_author=$id_author;
    }

    public function setName_author($name_author){
        $this->name_author=$name_author;
    }

    public function getId_author(){
        return $this->id_author;
    } 

    public function getName_author(){
        return $this->name_author;
    } 

  


   /* public static function getAllAuthors(){
        echo"getall";
         $var = [];
         $req =  DB::get()->query('SELECT name_author FROM Author');
         $req->execute();
         while($data = $req->fetch(PDO::FETCH_ASSOC)){
             $var[] = new AuthorModel($data);
            
         }
         return $var;
         $req->closeCursor();
       
         
    }*/

    public static function addAuthor($name) {
        $req = DB::get()->prepare("INSERT INTO Author (name_author) VALUES (:name_author)");
        $req->bindParam(':name_author', $name, PDO::PARAM_STR);
        $req->execute();
    }



}