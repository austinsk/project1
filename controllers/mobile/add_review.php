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

// $user_id = $_GET['user_id'];

// $recipient_id = $_GET['recipient_id'];



   $postdata = file_get_contents("php://input");
    if (isset($postdata)) {
        $request = json_decode($postdata);
        $post = array_merge($_REQUEST,(array)$request);

        // $post = $post['review'];

//         echo json_encode(array('test'=>$post));
// die;
if(isset($post['mobile']) && $post['mobile'] == 1){





            $mobile = $post['mobile'];

            if(AUTH_KEY != $post['auth_key']){



                echo json_encode(array('status'=>'Aunthentication error'));

            }


          }

  $mobile = new Mobile;
$mobile->addReview($post);



        
    }
                           

// echo json_encode(array('test'=>'abc'));
// die;
  



//  echo json_encode(array('test'=>'ddddd'));
// die;
?>



?>