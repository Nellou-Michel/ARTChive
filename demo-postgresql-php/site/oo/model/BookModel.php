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

    public static function getAllBooksWithFilter($genre_list, $type, $author, $sb_title, $sb_date, $sb_note) {
        $media_list = [];
        $book_list = [];

        $req = DB::get()->prepare("select * from get_books_by_genre_type_author_date_note(
            :genre, :type, :author, :sort_by_title, :sort_by_date, :sort_by_note)");
        $values = array(
        "genre" => $genre_list == NULL ? NULL : '{' . implode(',', $genre_list) . '}', 
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
            $req_join = DB::get()->prepare("select * from Book b
            JOIN Media m ON b.id_media = m.id_media 
            where m.id_media = :id
            ");
            $values = array("id" => $media->getId_media());
            $req_join->execute($values);
            while($data = $req_join->fetch(PDO::FETCH_ASSOC)){
                $book = new BookModel($data);
                if (!in_array($book, $book_list)) {
                    $book_list[] = new BookModel($data);
                }
            }
        }

        return $book_list;
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