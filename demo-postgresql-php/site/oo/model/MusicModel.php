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

    public static function getAllMusicsWithFilter($genre_list, $album, $author, $sb_title, $sb_date, $sb_note) {
        $media_list = [];
        $music_list = [];
        $req = DB::get()->prepare("select * from get_musics_by_genre_album_author_date_note(
            :genre, :album, :author, :sort_by_title, :sort_by_date, :sort_by_note)");
        $values = array(
        "genre" => $genre_list == NULL ? NULL : '{' . implode(',', $genre_list) . '}',
        "album" => $album, 
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
            $req_join = DB::get()->prepare("select * from Music mus 
            join Media m on mus.id_media = m.id_media 
            where m.id_media = :id");
            $values = array("id" => $media->getId_media());
            $req_join->execute($values);
            while($data = $req_join->fetch(PDO::FETCH_ASSOC)){
                $music = new MusicModel($data);
                if (!in_array($music, $music_list)) {
                    $music_list[] = $music;
                }
            }
        }
        return $music_list;
    }

    public static function getMusicById($id){
        $req = DB::get()->prepare("SELECT * FROM Media,Music WHERE Media.id_media = :id_media AND Music.id_media = :id_media");
        $values = array("id_media" => $id);
        $req->execute($values);
        
        $mediaData = $req->fetch(PDO::FETCH_ASSOC);
    
        // Attention, si il n'y a pas de résultat, on renvoie false
        if (!$mediaData) {
            echo "Pas de média trouvé";
            return false;
        }
    
        // Créez une instance de MediaModel et initialisez-la avec les données du média
        $media = new MusicModel($mediaData);
        return $media;
    }


}