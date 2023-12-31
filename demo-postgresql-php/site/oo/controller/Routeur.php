<?php

require_once File::build_path(array("controller","ControllerAccueil.php"));
require_once File::build_path(array("controller","ControllerMedia.php"));
require_once File::build_path(array("controller","ControllerBook.php"));
require_once File::build_path(array("controller","ControllerGame.php"));
require_once File::build_path(array("controller","ControllerMovie.php"));
require_once File::build_path(array("controller","ControllerMusic.php"));



class Router{
    private $_controller;
    private $_view;

    
    public function routeReq(){
       
        if(isset($_GET['action'])){

            $action=$_GET['action'];
            $class_methods = get_class_methods('ControllerMedia');
            if(!in_array($action, $class_methods)){
                $action='error';
            }
        
        }
        else {
            $action='readAll';
        }
        
        if(isset($_GET['controller'])) {
            $controller = $_GET['controller'];
            $controller_class = "Controller".ucfirst($controller);
            if(class_exists($controller_class)) {
               
                $this->_controller = new $controller_class;
                $this->_controller->$action();
            }
            else  $action='error';
        }
        else {
             $accueil = new ControllerAccueil();
             $accueil->readAll();

        }




        /*try{
         
            //chargement automatique des classes
            spl_autoload_register(function($class){
            File::build_path(array("model",$class.'php'));//Model à charger;
            });

            $url='';

            
         
            //Le controller est inclus selon l'action de l'utilisateur;
            if(isset($_GET['action'])){
               
                $url= explode('/', filter_var($_GET['url'],FILTER_SANITIZE_URL));

                $controller = ucfirst(strtolower($url[0]));

                //Va chercher par exemple si dans url "media" cherche "MediaController"
                //Nous allons devoir faire attention aux règles"
                $controllerClass = $controller."Controller";
                $controllerFile = File::build_path(array("controller",$controllerClass.'.php'));
              
              
            
                if(file_exists($controllerFile)){
                    require_once($controllerFile);
                    $this->_controller = new $controllerClass($url);
                }
                else{
                    //echo 'page introuvable';
                    throw new Exception('Page introuvable');

                }

                
             

            }
            else{
                //echo "try non fonctionnel";
                require_once FILE::build_path(array("controller","AccueilController.php"));
                $controllerClass='AccueilController';
                $this->_controller = new $controllerClass($url);
            }
        }
        //Gestion des erreurs;
        catch(Exception $e){
            require_once FILE::build_path(array("view","errorView.php"));
        }*/
    }
}