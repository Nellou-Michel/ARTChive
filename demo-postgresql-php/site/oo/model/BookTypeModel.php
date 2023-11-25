<?php
require_once File::build_path(array("model","Model.php"));//Model.php

class BookTypeModel extends Model{
    private $bookType;

    public function setBook_type($bookType){
        $this->bookType = $bookType;
    }

    public function getBook_type(){
        return $this->bookType;
    }


}