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

    public static function getAllGamesWithFilter($genre_list, $platform_game_list, $author, $sb_title, $sb_date, $sb_note) {
        $media_list = [];
        $game_list = [];
        $req = DB::get()->prepare("select * from get_games_by_genre_platform_author_date_note(
            :genre, :platform_game, :author, :sort_by_title, :sort_by_date, :sort_by_note)");
        $values = array(
        "genre" => $genre_list == NULL ? NULL : '{' . implode(',', $genre_list) . '}',
        "platform_game" => $platform_game_list == NULL ? NULL : '{' . implode(',', array_map(function($platform) {
            return '"' . $platform . '"';
        }, $platform_game_list)) . '}', 
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
            $req_join = DB::get()->prepare("select * from Game g
            join Media m on g.id_media = m.id_media 
            where m.id_media = :id");
            $values = array("id" => $media->getId_media());
            $req_join->execute($values);
            while($data = $req_join->fetch(PDO::FETCH_ASSOC)){
                $game = new GameModel($data);
                if (!in_array($game, $game_list)) {
                    $game_list[] = $game;
                }
            }
        }

        return $game_list;
    }


}