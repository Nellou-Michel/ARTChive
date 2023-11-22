<?php
require_once File::build_path(array("config","config.php")); //Conf.php

abstract class Model{


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


    public static function getAll($table, $obj){
        $var = [];
        $req = DB::get()->prepare('SELECT * FROM '.$table);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new $obj($data);
        
         
        }
        return $var;
        $req->closeCursor();
    }

}