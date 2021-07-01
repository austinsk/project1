<?php
class Validate_form{
	
	public function check_data(){//check if empty
		$error;
		$num_args = func_num_args();
		$get_args = func_get_args();
		
		if($num_args == 1){
			$data = trim($get_args[0]);
				if(empty($data) || $data == NULL){
					return false;
				}else{
					return true;
					}
		}else if($num_args > 1){
				for($i = 0; $i<$num_args; $i++){
							$data = trim($get_args[$i]);
						if(empty($data) || $data == NULL){
							return false;
						}else{
							continue;
							}
				}
		}else{
		return true; 
		}
	}
	
	public function mysql_prep( $value ) {
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( trim($value) );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( trim($value) ); }
			// if magic quotes are active, then the slashes already exist
			//striptags
		}
		return htmlentities($value,ENT_QUOTES, 'UTF-8');
	}
	
	
	
	 public function strip_space($string){
		 $new_string = preg_replace('/\s+/', '',$string);
		 return $new_string;
	 }
	 
	 public function insert_one_space($string){
		 $new_string = preg_replace('/\s+/', ' ',$string);
		 return $new_string;
	 }
	 
	 public function strip_insert($string){
		  $new_string = preg_replace('/\s+/', '_',$string);
		 	return $new_string;
		 }
		
//////////////////////////////////////////////////////validate//////////////////////////////////////////////////////	
	public function validate_login_details(){
		$num_args = func_num_args();
		$get_args = func_get_args();
		if($num_args == 1){
			$data = $this->strip_space($get_args[0]);
				if(strlen($data) > 50){
					return false;
				}else if(!ctype_alnum($data) && !ctype_alpha($data)){
					return false;
				}else{
					return true;
				}
			}else if($num_args > 1){
				for($i = 0; $i<$num_args; $i++){
							$data = $this->strip_space($get_args[$i]);
							if(strlen($data) > 50){
								return false;
							}else if(!ctype_alnum($data) && !ctype_alpha($data)){
								return false;
							}else{
							
							}
				}
		}else{
		return true; 
		}
		
		
	}

public function validate_text(){
		$num_args = func_num_args();
		$get_args = func_get_args();
		if($num_args == 1){
			$data = $this->strip_space($get_args[0]);
				if(!ctype_alpha($data)){
					return false;
				}else{
					return true;
				}
			}else if($num_args > 1){
				for($i = 0; $i<$num_args; $i++){
							$data = $this->strip_space($get_args[$i]);
							if(!ctype_alpha($data)){
								return false;
							}else{
								continue;
							}
				}
		}else{
		return true; 
		}
		
		
	}	


public function validate_text_field(){
		$num_args = func_num_args();
		$get_args = func_get_args();
		if($num_args == 1){
			$data = $this->strip_space($get_args[0]);
				if(!ctype_alnum($data) && !ctype_alpha($data)){
					return false;
				}else{
					return true;
				}
			}else if($num_args > 1){
				for($i = 0; $i<$num_args; $i++){
							$data = $this->strip_space($get_args[$i]);
							if(!ctype_alnum($data) && !ctype_alpha($data)){
								return false;
							}else{
								continue;
							}
				}
		}else{
		return true; 
		}
		
		
	}	



	public function validate_number(){
		$num_args = func_num_args();
		$get_args = func_get_args();
		if($num_args == 1){
				$data = $this->strip_space($get_args[0]);
				if(!ctype_digit($data)){
					return false;
				}else{
					return true;
				}
			}else if($num_args > 1){
				for($i = 0; $i<$num_args; $i++){
							$data = $this->strip_space($get_args[$i]);
							if(!ctype_digit($data)){
								return false;
							}else{
									continue;}
				}
		}else{
		return false; 
		}
		
		
	}



	public function validate_phone_number($number){
		if(strlen($number) > 15){
			return false;
			}else if(!ctype_digit($number)){
				return false;
			}else{
			return true;
			}
	}


	
	public function validate_email($email){
		$email_pattern = '/^[^@\s<&>]+@([-a-z0-9]+\.)+[a-z]{2,}$/i';
		if(strlen($email) > 255){
			return false;
			}else if (!preg_match($email_pattern, $email)){
				return false;
				}else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				return false;
				}else{
					return true;
					}
	}
	

	
	public function validate_zip($zip){
		if(!ctype_alnum($zip)){
				return false;
			}else{
				return true;
				}
	}


	
	
	
	public function validate_date($date){
			$date = explode("-",$date);
			 if(!ctype_digit($date[1])){
					return false;
				}else if($date[1] < 1 || $date[1] > 12){ //validate month
					return false;
					}else if(!ctype_digit($date[2])){ //validate day
						return false;
							}else if($date[2] < 1 || $date[2] > 32){
							return false;
									}else if(!ctype_digit($date[0])){ //validate year
										return false;
											}else if($date[0] < 1 || $date[0] > 9999){
												return false;
													}else {
														return true;
														}
	}
	
	
	
	
	
	
	
	public function check_file($file){
		if(empty($file) || $file['size'] ==0){
			return false;
			}else{
				return true;}
		}
public function validate_password($password){
	//check if a password has atleast one capital letter, a lower case letter and a number.. 6 characters
if(!preg_match('%\A(?=[-_a-zA-Z0-9]*?[A-Z)(?=[-_a-zA-Z0-9]*?[a-z])(?=[-_a-zA-Z0-9]*?[0-9])\S{6,}\z%', $password)){
	return false;
	}else{
		return true;
		}
}


/////////////////////////////sanitize///////////////////////////////////////////////////////////////////////////
//this is the function that sanitizes all data goin into the database
	public function sanitize($data){
		return $new_data = $this->mysql_prep($data);
		}

		
	public function sanitize_email($email){
		$email_sanitized = filter_var($email, FILTER_SANITIZE_EMAIL);
		$email_sanitized =  $this->mysql_prep($email_sanitized);
		return $email_sanitized;
		}
		
		
		
	
		
		


}

$validate = new Validate_form;
?>