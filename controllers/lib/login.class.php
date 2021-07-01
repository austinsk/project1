<?php 

class Login {
	
	
		public function authenticate_user($username,$pass="") {
			global $database;
			global $password_class;
			
			  $password = $password_class->hashPassword($pass);
			
			try{
			$sql  = "SELECT user_id,fm_id, role FROM users ";
			$sql .= "WHERE username = :username ";
			$sql .= "AND password = :password ";
			$result = $database->prepare($sql);
			$result->bindValue('username',"$username");
			$result->bindValue('password',"$password");
			$result->execute();
			if($result->rowCount() == 1){
			return $user = $result->fetch(PDO::FETCH_OBJ);
			}else{
				return "error";
				}
			}catch(PDOException $e){
				//die($e->getMessage());
				$_SESSION['error'] = "There was a problem. Pls try again";
				return "error";
				}
	}
	
	

	
	
	
	public function logout(){
			$_SESSION = array();
			
					session_destroy();
					 if(isset($_COOKIE[session_name()]))
					{
						setcookie(session_name(), '', time()-420000, '/');
					}

			}
	}









?>