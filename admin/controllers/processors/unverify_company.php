<?php

require_once 'init.php';

require_once '../classes/company.class.php';

$company = new Company;


if(isset($_GET['id']) && !empty($_GET['id'])){

	$id = $_GET['id'];
	$company->unVerifyCompany($id);
}else{
	$_SESSION['error'] = "An error occurred.";
	go();
}










?>