<?php

require_once 'init.php';

require_once '../classes/user.class.php';

$user = new User;


if(isset($_GET['id']) && !empty($_GET['id'])){

	$id = $_GET['id'];
	$user->verifyUser($id);
}else{
	$_SESSION['error'] = "An error occurred.";
	go();
}










?>