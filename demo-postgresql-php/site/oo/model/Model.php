<?php
require_once File::build_path(array("config","config.php")); //Conf.php

abstract class Model{

    public function getAll($table, $obj){
        $var = [];
        $req = BD::get()->prepare('SELECT * FROM '.$table. ' ORDER BY id desc');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }

}