<?php
include ('../config.php');

function getBooks() {
	$req = DB::get()->query('select * from book');
	$book = $req->fetchAll();
	return $book;
}	


function createBook

?>
