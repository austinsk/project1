<?php ob_start();
session_start();
$_SESSION['start'] = time();
class Session extends Password{
public function login($result){
	global $database;
			
			if(!empty($result) && $result!="error"){
				session_regenerate_id();
			 	$_SESSION['eb_user_id'] = $result->user_id;
				$_SESSION['eb_userAgent'] =  parent::hashPassword($_SERVER['HTTP_USER_AGENT']);
				$_SESSION['eb_address'] = parent::hashPassword($_SERVER['REMOTE_ADDR']);
				$_SESSION['eb_sid'] = session_id();
				$time = time() - 3600;
		
			
				if((date('d-m-y',$time)) != date('d-m-y',$result->last_login)){
					$database->query("UPDATE voter SET votes = 2 WHERE user_id =  $result->user_id");
					}	
				//$votes = new Voter($result->user_id);	
				$database->query("UPDATE users SET last_login = $time WHERE user_id = {$_SESSION['eb_user_id']}");
				redirect_to("../public/index.php");
			}else{
				$_SESSION['error'] = "Invalid username/password combination";
				redirect_to("../index.php");
				}
		}	



public function checkLogin(){
if(empty($_SESSION['eb_user_id']) || empty($_SESSION['eb_userAgent']) || empty($_SESSION['eb_address'])){
	redirect_to("../public/index.php");
}else if($_SESSION['eb_sid'] != session_id() || parent::hashPassword($_SERVER['HTTP_USER_AGENT']) != $_SESSION['eb_userAgent'] || parent::hashPassword($_SERVER['REMOTE_ADDR']) != $_SESSION['eb_address']){
				redirect_to("../public/index.php");
				}else{
						return true;
						}

	}



public function check_if_logged(){
	
	if(!empty($_SESSION['eb_user_id']) && !empty($_SESSION['eb_userAgent']) && !empty($_SESSION['eb_address'])){
			redirect_to("../portal/index.php");
}
	
	}
}

$session_login = new Session();

?>