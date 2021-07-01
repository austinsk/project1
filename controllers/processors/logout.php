<?php 
require_once('init.php');





$id = $_GET['id'];

require_once '../auth/classes/Login.php'; 
$login = new Login;



unset($_SESSION['access_token']);

$login->securityLogout();

if($id == 'admin'){

	
	session_destroy();
	go('../../admin/index');
}


if($id == 'user'){


	session_destroy();
	go('../../index');
}


delete_session();
	go('../../index');





?>