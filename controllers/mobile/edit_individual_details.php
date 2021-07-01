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

$mobile1 = new Mobile;


// 	echo json_encode(array('test'=>'kkk'));
// die;
	//$id = $_GET['id'];

if(isset($_GET['type'])){
	$type = $_GET['type'];


	switch ($type) {
		case 'personal':

            $postdata = file_get_contents("php://input");
    if (isset($postdata)) {
        $request = json_decode($postdata);

        $post = array_merge($_REQUEST,(array)$request);

        $mobile1->editIndividualPersonalDetails($post,$id, $_FILES);
}
			
			break;

		case 'picture':


		$postdata = file_get_contents("php://input");
    if (isset($postdata)) {
        $request = json_decode($postdata);

        $post = array_merge($_REQUEST,(array)$request);
  //       echo json_encode(array('status'=>$post));
		// die();

  		$mobile1->updateIndividualPersonalPicture($_FILES, $post);

       

 		
    }


			break;

		case 'details':


	$postdata = file_get_contents("php://input");
    if (isset($postdata)) {
        $request = json_decode($postdata);

        $post = array_merge($_REQUEST,(array)$request);
  //       echo json_encode(array('status'=>$post));
		// die();

  

        if(isset($post['mobile']) && $post['mobile'] == 1){

        	

        	$mobile = $post['mobile'];



        	  if(AUTH_KEY != $post['auth_key']){



                echo json_encode(array('status'=>'Aunthentication error'));
                die;
            }

        	
        	$mobile1->editIndividualPersonalDetails($post);



        }

        

 		
    }



			
			break;



			case 'service':

		// echo json_encode(array('status'=>'fffff'));
		// die();


	$postdata = file_get_contents("php://input");
    if (isset($postdata)) {
        $request = json_decode($postdata);

        $post = array_merge($_REQUEST,(array)$request);
  //       echo json_encode(array('status'=>$post));
		// die();

  

        if(isset($post['mobile']) && $post['mobile'] == 1){

        	

        	$mobile = $post['mobile'];



        	  if(AUTH_KEY != $post['auth_key']){



                echo json_encode(array('status'=>'Aunthentication error'));
                die;
            }

        	
        	$mobile1->editIndividualServicePersonalDetails($post);



        }

        

 		
    }



			
			break;
		
		
	}






}

	
	


?>