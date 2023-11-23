<?php
require_once File::build_path(array("model","Model.php"));//Model.php

class MusicModel extends MediaModel{

    private $idMedia;
    private $album;
   

    public function getId_media(){
        return $this->idMedia;
    }

    public function setId_media($idMedia){
        $this->idMedia = $idMedia;
    }

    public function setAlbum($album){
        $this->album = $album;
    }

    public function getAlbum(){
        return $this->album;
    }


    public static function getAllMusics(){
        $var = [];
        $req = DB::get()->prepare('SELECT * FROM music, media
        WHERE music.id_media = media.id_media');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new MusicModel($data);
          
        }
        return $var;
        $req->closeCursor();
    }

    public static function getAllMusicsWithFilter($genre, $album, $author, $sb_title, $sb_date, $sb_note) {
        $req = DB::get()->prepare("select * from get_musics_by_genre_album_author_date_note(
            :genre, :album, :author, :sort_by_title, :sort_by_date, :sort_by_note");
        $values = array(
        "genre" => $genre, 
        "album" => $album, 
        "author" => $author,
        "sort_by_title" => $sb_title,
        "sort_by_date" => $sb_date,
        "sort_by_note" => $sb_note
        );
        $req->prepare($values);
        return $req;
    }


}