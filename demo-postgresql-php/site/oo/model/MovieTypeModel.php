<?php
require_once File::build_path(array("model","Model.php"));//Model.php

class MovieTypeModel extends Model{
    private $movieType;

    public function setMovie_type($movieType){
        $this->movieType = $movieType;
    }

    public function getMovie_type(){
        return $this->movieType;
    }


}