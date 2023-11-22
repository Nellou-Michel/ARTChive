<?php
require_once File::build_path(array("model","Model.php"));//Model.php
require_once File::build_path(array("model","PlayableOn.php"));//Model.php
class GameModel extends MediaModel{

    private $idMedia;
    
   

    public function getId_media(){
        return $this->idMedia;
    }

    public function setId_media($idMedia){
        $this->idMedia = $idMedia;
    }


    public static function getAllGames(){
        $var = [];
        $req = DB::get()->prepare('SELECT * FROM game, media
        WHERE game.id_media = media.id_media');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new GameModel($data);
          
        }
        return $var;
        $req->closeCursor();
    }

    
    public static function getGameById($id){
        $req = DB::get()->prepare("SELECT * FROM Media,Game WHERE Media.id_media = :id_media AND Game.id_media = :id_media");
        $values = array("id_media" => $id);
        $req->execute($values);
        
        $mediaData = $req->fetch(PDO::FETCH_ASSOC);
    
        // Attention, si il n'y a pas de résultat, on renvoie false
        if (!$mediaData) {
            echo "Pas de média trouvé";
            return false;
        }
    
        // Créez une instance de MediaModel et initialisez-la avec les données du média
        $media = new GameModel($mediaData);
        return $media;
    }

    //return toutes les platforms pour lequel ce jeu est jouable
    public function getPlatforms(){

        return PlayableOn::getPlatformsByIdGame($this->getId_media());

    }


}