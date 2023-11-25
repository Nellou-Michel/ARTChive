<?php
require_once File::build_path(array("model","Model.php"));//Model.php

class PlatformModel extends Model{
    private $platform;

    public function setPlatform($platform){
        $this->platform = $platform;
    }

    public function getPlatform(){
        return $this->platform;
    }


}