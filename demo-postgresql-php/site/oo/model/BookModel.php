<?php
require_once File::build_path(array("model","Model.php"));//Model.php

class BookModel extends MediaModel{

    private $idMedia;
    private $bookType;
    
    
   

    public function getId_media(){
        return $this->idMedia;
    }

    public function setId_media($idMedia){
        $this->idMedia = $idMedia;
    }

    public function getBook_type(){
        return $this->bookType;
    }

    public function setBook_type($bookType){
        $this->bookType=  $bookType;
    }

    public static function getAllBooks(){
        $var = [];
        $req = DB::get()->prepare('SELECT * FROM book, media
        WHERE book.id_media = media.id_media');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new BookModel($data);
          
        }
        return $var;
        $req->closeCursor();
    }

    public static function getBookById($id){
        $req = DB::get()->prepare("SELECT * FROM Media,Book WHERE Media.id_media = :id_media AND Book.id_media = :id_media");
        $values = array("id_media" => $id);
        $req->execute($values);
        
        $mediaData = $req->fetch(PDO::FETCH_ASSOC);
    
        // Attention, si il n'y a pas de résultat, on renvoie false
        if (!$mediaData) {
            echo "Pas de média trouvé";
            return false;
        }
    
        // Créez une instance de MediaModel et initialisez-la avec les données du média
        $media = new BookModel($mediaData);
        return $media;
    }


}