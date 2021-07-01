<?php 
require_once 'password.class.php';
class User {
	protected $username;
	protected $password;
	protected $hash_pass;
	public $role;
	public $user;
	
	
	public function change_staff_role($_POST){
		global $database;
		$user_id = $_POST['user_id'];
		$role = $_POST['role'];
		if(!ctype_digit($user_id)){
				$_SESSION['error'] = "An error occurred. Pls contact admin";
				redirect_to($_SERVER['HTTP_REFERER']);
			}
		$join = '';	
		if(!empty($_POST['facility2'])){
			$facility = $_POST['facility2'];
				if(!ctype_alpha($facility)){
					$_SESSION['error'] = "An error occurred. Pls contact admin";
					redirect_to($_SERVER['HTTP_REFERER']);
				}
			$join = " VALUES($user_id,'$facility')";
			}else if(!empty($_POST['facility'])){
				$join .= " VALUES";
				foreach($_POST['facility'] as $facility){
					$join .= "($user_id,$facility),";
					}
				
				$join = substr($join,0,(strlen($join) - 1));	
				}	
		try{
			$database->beginTransaction();
			
			$sql = "DELETE FROM user_roles_facility WHERE user_id = :user_id";
			$result1 = $database->prepare($sql);
			$result1->bindValue('user_id',$user_id);
			$result1->execute();
			
			$sql = "UPDATE users SET role = :role WHERE user_id = :user_id";
			$result2 = $database->prepare($sql);
			$result2->bindValue('role',$role);
			$result2->bindValue('user_id',$user_id);
			$result2->execute();
			
			 $sql = "INSERT INTO user_roles_facility(`user_id`,`estate_id`) $join";
			$result3 = $database->query($sql);
			
			if($result1 && $result2 && $result3 ){
				$database->commit();
				$_SESSION['success'] = "user details updated successfully.";
				}
			}catch(PDOExeption $e){
				$database->rollBack();
				$_SESSION['error'] = "An error occurred. Pls try again";
				}
		
		}
		
		//public function __construct($username){
		//	$this->username = $username;
		//	}
		public function add_user($username,$pass, $role){
			$password = new Password;
			global $database;
			if($this->check_username() === "error"){
				$_SESSION['error'] = "The username exists";
				redirect_to("add_user.php");
				}
				$this->password = $pass;
				$this->hash_pass = $password->hashPassword($this->password);
		
			$sql = "INSERT INTO users VALUES('',:username,:password, :role,'')";
			$value = $database->prepare($sql);
			$value->bindValue('username', $username);
			$value->bindValue('password', $this->hash_pass);
			$value->bindValue('role', $role);
			$value->execute();
		
			if($value->rowCount()===1){
				$_SESSION['error'] = "User created successfully";
				
				//redirect_to("add_user.php");
				}else{
					$_SESSION['error'] = "Failed to create user";
					//redirect_to("add_user.php");
					}
			}
			
				
		
		public function check_username(){
			global $database;
			$sql = "SELECT user_id from users WHERE username = :username";
			$result = $database->prepare($sql);
			$result->bindValue(':username',$this->username);
			$result->execute();
			if($result->rowCount() >= 1){
				return "error";
				}else{
					return true;
					}
			}

	}









?>