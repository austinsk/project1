<?php

require_once 'init.php';

require_once '../classes/category.class.php';

$category = new Category;

if( (isset($_GET['id']) && !empty($_GET['id']))  &&  (isset($_GET['type']) && !empty($_GET['type'])) ){

$id = $_GET['id'];

$type = $_GET['type'];


switch ($type) {
	case 'deactivate':
		$category->deactivateCategory($id);
		go();
		break;

	case 'activate':
		$category->activateCategory($id);
		go();
		break;

	case 'delete':
		$category->deleteCategory($id);
		go();
		break;
	
	
}



}else{

	error('An error occurred. Please try again');
	go();
}






	
	$category->activatCategory($id);










?>