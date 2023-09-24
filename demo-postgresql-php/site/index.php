
<?php

//Permet de cacher l'url mais pas encore utilisée, un peu osef
define ('URL', str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : 
"http") . "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));
	/*
	// initialisation de la session
	// INDISPENSABLE À CETTE POSITION SI UTILISATION DES VARIABLES DE SESSION.
	 ;*/



		//Gestion des controller à afficher en fonction de l'url, pour en savoir plus, il faut aller voir le routeur !
		require 'oo'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'File.php';//File.php

		require_once File::build_path(array("controller","Routeur.php"));

		$router = new Router();
		$router->routeReq();

?>


