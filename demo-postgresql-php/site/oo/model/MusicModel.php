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