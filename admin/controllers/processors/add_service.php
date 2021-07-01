<?php

require_once 'init.php';
ini_set('memory_limit', '1024M');
require_once '../classes/service.class.php';

$service = new Service;

$type = $_GET['type'];

if($type == 'add'){

	$service->addService();

}

if($type == 'edit'){

	$service->editService();

}











?>