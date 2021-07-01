<?php
require_once('init.php');

require_once('../classes/profile.class.php');
require_once '../lib/ImageResize.php';
require_once '../classes/company.class.php';

require_once '../lib/picture.class.php';



$company = new Company;

$type = $_GET['type'];


if($type == 'details'){

	$company->updateCompanyDetails();

}

if($type == 'image'){

	$company->updateCompanyImage($_FILES);


}


if($type == 'service'){

}
$company->addCompanyService($_FILES);


?>