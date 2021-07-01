<?php

require_once 'init.php';

require_once '../classes/service.class.php';

$service = new Service;

if( (isset($_GET['id']) && !empty($_GET['id']))  &&  (isset($_GET['type']) && !empty($_GET['type'])) ){

$id = $_GET['id'];

$type = $_GET['type'];


switch ($type) {
	case 'deactivate':
		$service->deactivateService($id);
		go();
		break;

	case 'activate':
		$service->activateService($id);
		go();
		break;

	case 'delete':
		$service->deleteService($id);
		go();
		break;
	
	
}



}else{

	error('An error occurred. Please try again');
	go();
}






	
	$service->activatService($id);










?>