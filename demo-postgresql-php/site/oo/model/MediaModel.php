<?php
require_once File::build_path(array("model","Model.php"));//Model.php

class MediaModel{
    private $id;
    private $name;
    private $publicationDate;
    private $description;
    private $length;
    private $unit;
    private $averageNote;
    private $filePath;
    private $idAuthor;
    public function __construct(array $data) {
       $this->hydrate($data);
    }


    //Va faire les setter de chaque donnéé
    //Attention le nom de la méthode si un attribut est : attribut_type => setAttribut_type($attribut_type)
    //ça permet de ne pas se faire chier à associer les setters aux attributs à la mano.
    public function hydrate(array $data){
        foreach($data as $key => $value){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method)){
                $this->$method($value);
            }
            else{
                echo "[methode introuvable : ". $method."]__";
            }
        }
    }


    public static function getAllMedias(){

       // return Model::getAll('media','ModelMedia');
        /*$req = DB::get()->query('select * from media');
        $mediasall = $req->fetchall();
        return $mediasall;*/
        $var = [];
        $req =  DB::get()->query('select * from media');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new MediaModel($data);
        }
        return $var;
        $req->closeCursor();
      
        
    }

     // Getter et Setter pour l'ID
     public function getId_media() {
        return $this->id;
    }

    public function setId_media($id) {
        $this->id = $id;
    }

    // Getter et Setter pour le nom
    public function getName_media() {

        return $this->name;
    }

    public function setName_media($name) {
        $this->name = $name;
    }

    // Getter et Setter pour la date de publication
    public function getPublication_date() {
        return $this->publicationDate;
    }

    public function setPublication_date($publicationDate) {
        $this->publicationDate = $publicationDate;
    }

    // Getter et Setter pour la description
    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    // Getter et Setter pour la longueur
    public function getLength() {
        return $this->length;
    }

    public function setLength($length) {
        $this->length = $length;
    }

    // Getter et Setter pour l'unité de longueur
    public function getUnite() {
        return $this->unit;
    }

    public function setUnite($unit) {
        $this->unit = $unit;
    }

    // Getter et Setter pour la note moyenne
    public function getAverage_note() {
        return $this->averageNote;
    }

    public function setAverage_note($averageNote) {
        $this->averageNote = $averageNote;
    }

    // Getter et Setter pour le chemin du fichier
    public function getFile_path() {
        return $this->filePath;
    }

    public function setFile_path($filePath) {
        $this->filePath = $filePath;
    }

    public function getId_author(){
       return $this->idAuthor;
    } 
    public function setId_author($idAuthor){
        $this->idAuthor= $idAuthor;
    } 

    public function getName_Author(){
        $id_media = $this->getId_media(); // Stockez la valeur dans une variable
        $req = DB::get()->prepare("SELECT A.name_author FROM Media M 
        JOIN Author A ON A.id_author = M.id_author
        WHERE id_media = :id_media");
        
        $req->bindParam(':id_media', $id_media, PDO::PARAM_INT);
        
        $req->execute();
        
        $author = $req->fetch(PDO::FETCH_ASSOC);
        if ($author !== false && isset($author['name_author'])) {
            return $author['name_author'];
        } else {
            return "aucun";
        }
    }
    


    public static function getMediaById($id){
        $req = DB::get()->prepare("SELECT * FROM Media WHERE id_media = :id_media");
        $values = array("id_media" => $id);
        $req->execute($values);
        
        $mediaData = $req->fetch(PDO::FETCH_ASSOC);
    
        // Attention, si il n'y a pas de résultat, on renvoie false
        if (!$mediaData) {
            echo "Pas de média trouvé";
            return false;
        }
    
        // Créez une instance de MediaModel et initialisez-la avec les données du média
        $media = new MediaModel($mediaData);
      
    
        return $media;
       
    }


    public function delete(){
        $req = DB::get()->prepare("DELETE FROM Media Where id_media = :id_media");

       $values = array(
        "id_media" => $this->id,
       );

        $req->execute($values);

    }





    public function save(){
      // Préparez la requête SQL pour insérer dans la table "Media"
      $req = DB::get()->prepare("INSERT INTO Media (name_media, publication_date, description, length, unite, average_note, file_path) VALUES (:name_media, :publication_date, :description, :length, :unite, :average_note, :file_path)");

     
      // Définir les valeurs à insérer dans la base de données
      $values = array(
          "name_media" => $this->name,
          "publication_date" => $this->publicationDate,
          "description" => $this->description,
          "length" => $this->length,
          "unite" => $this->unit,
          "average_note" => $this->averageNote,
          "file_path" => $this->filePath,
      );
      
      // Exécution de la requête avec les valeurs
      $req->execute($values);
    }




    // Ajoutez ici d'autres fonctions pour lire, mettre à jour et supprimer des médias
}
?>
