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


$sender_id = $_GET['sender_id'];

$recipient_id = $_GET['recipient_id'];

// echo json_encode(array('status'=>'success',$_REQUEST['last_message_id']));die;
if(!empty($_REQUEST['last_message_id']) && isset($_REQUEST['last_message_id'])){
    $last_message_id =empty($_REQUEST['last_message_id']);
}





		$postdata = file_get_contents("php://input");
    if (isset($postdata)) {
        $request = json_decode($postdata);


        $message = $request->message;
  
 		
    }
                           

// echo json_encode(array('test'=>'abc'));
// die;
  
$mobile = new Mobile;
$mobile->sendMessage($sender_id, $recipient_id, $message, $last_message_id);


// 	echo json_encode(array('test'=>'ddddd'));
// die;
?>