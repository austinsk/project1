<?php 
require_once ('init.php');
// echo json_encode(array('test'=>'abc'));
// die;

// check for minimum PHP version
// if (version_compare(PHP_VERSION, '5.3.7', '<')) {
//     exit('PHP version error occurred. Pls contact Admin');
// } else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
//     // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
//     // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
//     require_once('../auth/libraries/password_compatibility_library.php');
// }
// include the config
require_once ('../classes/mobile.class.php');

$mobile = new Mobile;

if(isset($_GET['id']) && ( !isset($_GET['lat']) && !isset($_GET['lng']) ) ){

	$id = $_GET['id'];
// 		echo json_encode(array('test'=>$id));
// die;
	$mobile->displayIndividualServices($id);





}




if(isset($_GET['id']) && (   (isset($_GET['lat'])  && $_GET['lat'] == 0 )     && (isset($_GET['lng']) && $_GET['lng'] == 0    ) )     ){

	$id = $_GET['id'];
// 		echo json_encode(array('test'=>$id));
// die;
	$mobile->displayIndividualServices($id);





}


if(isset($_GET['id']) && isset($_GET['city']) ){

	$id = $_GET['id'];
	$city = $_GET['city'];
// 		echo json_encode(array('test'=>$id));
// die;
	$mobile->displayIndividualServiceWithCity($id, $city);





}


if(isset($_GET['id']) &&  (isset($_GET['lat']) && $_GET['lat'] > 0)  &&  (isset($_GET['lng']) && $_GET['lng'] > 0)   ){


	$id = $_GET['id'];
	$lat = $_GET['lat'];
	$lng = $_GET['lng'];
	
	if(isset($_GET['distance']) && $_GET['distance'] > 0 ){

		$distance = $_GET['distance'];

	}else{

		$distance = 3;

	}
	

	$mobile->displayIndividualServicesLocation($lat, $lng, $distance, $id);



		}




?>