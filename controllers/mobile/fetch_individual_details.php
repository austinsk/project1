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

$type = 'individual';

if(isset($_GET['id']) ){

	 $id = $_GET['id'];

	  

	  if(isset($_GET['review_count'])){

	  	$review_count = $_GET['review_count'];

	  }else{

	  	$review_count = '';
	  }

	  if(isset($_GET['service_id'])){

	  	$service_id = $_GET['service_id'];

	  }else{

	  	$service_id = '';
	  }

	  

	 $type = $_GET['type'];

	$user_id = '';

	if( isset($_GET['user_id'])) {

		$user_id = $_GET['user_id'];


	}





	
// 		echo json_encode(array('test'=>$id));
// die;
	$mobile->fetchIndividualDetails($id,$user_id, $service_id, $review_count, $type);
}


// if( ( $_GET['user_id'] > 0 && ctype_digit($_GET['user_id']) )  && isset($_GET['id'])){

// 	$user_id = $_GET['user_id'];
// 	$id = $_GET['id'];


// 	$mobile->fetchIndividualDetails($id);

// 	$mobile->updateHistory($user_id, $id, $type);

// 	$mobile->favouriteStatus($user_id, $id, $type);

// }
// 	echo json_encode(array('test'=>'ddddd'));
// die;
?>