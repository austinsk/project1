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

if(isset($_GET['id'])){

	$id = $_GET['id'];

	if(isset($_GET['type'])){

	$type = $_GET['type'];

}
// 		echo json_encode(array('test'=>$id));
// die;
	$mobile->fetchMyDetails($id, $type);
}
// 	echo json_encode(array('test'=>'ddddd'));
// die;
?>