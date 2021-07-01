<?php


require_once 'init.php';
ini_set('memory_limit', '1024M');
require_once '../classes/category.class.php';

$category = new Category;



$type = $_GET['type'];

if($type == 'add'){

	$category->addCategory();

}

if($type == 'edit'){

	$category->editCategory();

}



?>