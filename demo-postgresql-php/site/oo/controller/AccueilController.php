<?php
require_once FILE::build_path(array('view','View.php'));
class AccueilController {

    private $_view;

    public function __construct($url){
     
       
            $this->afficheAccueil();
        
    }


    private function afficheAccueil(){
       
        $this->_view = new View('view','Accueil');
        $this->_view->generate(array(null));

        //require_once FILE::build_path(array('view','Accueil','accueil.php'));
    }





}
?>