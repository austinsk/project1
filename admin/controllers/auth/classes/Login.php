<?php



/**

 * handles the user login/logout/session

 * @author Panique

 * @link http://www.php-login.net

 * @link https://github.com/panique/php-login-advanced/

 * @license http://opensource.org/licenses/MIT MIT License

 */

class Login

{

    /**

     * @var object $db_connection The database connection

     */

    private $db_connection = null;

    /**

     * @var int $user_id The user's id

     */

    private $user_id = null;

    /**

     * @var string $user_name The user's name

     */

    private $user_name = "";

    /**

     * @var string $user_email The user's mail

     */

    private $user_email = "";

    /**

     * @var boolean $user_is_logged_in The user's login status

     */

    private $user_is_logged_in = false;

    /**

     * @var string $user_gravatar_image_url The user's gravatar profile pic url (or a default one)

     */

    public $user_gravatar_image_url = "";

    /**

     * @var string $user_gravatar_image_tag The user's gravatar profile pic url with <img ... /> around

     */

    public $user_gravatar_image_tag = "";

	public $login_attempt;

    /**

     * @var boolean $password_reset_link_is_valid Marker for view handling

     */

    private $password_reset_link_is_valid  = false;

    /**

     * @var boolean $password_reset_was_successful Marker for view handling

     */

    private $password_reset_was_successful = false;

    /**

     * @var array $errors Collection of error messages

     */

    public $errors = array();

    /**

     * @var array $messages Collection of success / neutral messages

     */

    public $messages = array();



	 

	public function __construct(){

		

	} 

	

	public function checkLoginStatus(){

		if (!empty($_SESSION['user_id']) ) {

            $this->loginWithSessionData();

        }elseif(isset($_COOKIE['rememberme'])) {
				
            $this->loginWithCookieData();

        }else{

			$this->securityLogout();

			redirect_to('../index.php');

			}

		}

	

		

		public function checkLoginStatusForLoginPage($url='portal'){
			if (!empty($_SESSION['user_id']) ) {
				$this->loginWithSessionData();
				go($url);

			}elseif(isset($_COOKIE['rememberme'])) {
				if($this->loginWithCookieData() == true){
				go($url);
				}
			}else{
				$this->securityLogout();
				}

		}

		

		public function checkLoginStatus2(){

		//

		if (!empty($_SESSION['user_id']) && ($_SESSION['user_logged_in'] == 1) && ($_SESSION['userAgent'] == $this->hashSessionData($_SERVER['HTTP_USER_AGENT'])) && ($this->hashSessionData($_SERVER['REMOTE_ADDR']) == $_SESSION['rmt_address'])) {

            $this->loginWithSessionData();

        }else{

			$this->securityLogout();

			redirect_to('../index.php');

			}

		

		

		/* if ($this->isUserLoggedIn() == true) {

            $this->getGravatarImageUrl($this->user_email);

        }*/	

		}

	

	public function securityLogout(){

		//$_SESSION = array();
		unset($_SESSION['user_id'],$_SESSION['staff_type'],$_SESSION['user_role'] ,$_SESSION['user_logged_in'],$_SESSION['userAgent'],$_SESSION['rmt_address']);
       // session_destroy();
		 unset($_COOKIE['rememberme']);
   		 setcookie('rememberme', '', time() - 3600, '/');


 }

	public function userLogin($post){
		


		if (!isset($post['user_rememberme']) && empty($post['user_rememberme'])) {

                $post['user_rememberme'] = null;

            }

            $this->loginWithPostData($post['username'], $post['password'], $post['user_rememberme']);

		

		}

		

	

	public function userLogin2($post){//non acade,ic staffs

		if (!isset($post['user_rememberme']) && empty($post['user_rememberme'])) {

                $post['user_rememberme'] = null;

            }

            $this->loginWithPostData2($post['username'], $post['password'],$post['role'], $post['user_rememberme']);

		

		}	

	

	public function requestPasswordReset(){

			if (isset($post["request_password_reset"]) && isset($post['user_name'])) {

				$this->setPasswordResetDatabaseTokenAndSendMail($post['user_name']);

			}

		}	

	

	public function checkPasswordResetLink(){

		 $this->checkIfEmailVerificationCodeIsValid($_GET["user_name"], $_GET["verification_code"]);

		}

	public function resetPassword(){

		

		}	

	

	public function hashSessionData($data) {

				$salt = SALT; 

				$password = crypt($data,$salt);

				return $password;

				

			

}

	 

   

    /**

     * Checks if database connection is opened. If not, then this method tries to open it.

     * @return bool Success status of the database connecting process

     */

    private function databaseConnection()

    {

		

        // if connection already exists

        if ($this->db_connection != null) {

            return true;

        } else {

            try {

                // Generate a database connection, using the PDO connector

                // @see http://net.tutsplus.com/tutorials/php/why-you-should-be-using-phps-pdo-for-database-access/

                // Also important: We include the charset, as leaving it out seems to be a security issue:

                // @see http://wiki.hashphp.org/PDO_Tutorial_for_MySQL_Developers#Connecting_to_MySQL says:

                // "Adding the charset to the DSN is very important for security reasons,

                // most examples you'll see around leave it out. MAKE SURE TO INCLUDE THE CHARSET!"

                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

                return true;

            } catch (PDOException $e) {

                $this->errors[] = MESSAGE_DATABASE_ERROR . $e->getMessage();

            }

        }

        // default return

        return false;

    }



    /**

     * Search into database for the user data of user_name specified as parameter

     * @return user data as an object if existing user

     * @return false if user_name is not found in the database

     * TODO: @devplanete This returns two different types. Maybe this is valid, but it feels bad. We should rework this.

     * TODO: @devplanete After some resarch I'm VERY sure that this is not good coding style! Please fix this.

     */

    private function getUserData($user_name)

    {

        // if database connection opened

        if ($this->databaseConnection()) {

            // database query, getting all the info of the selected user

            $query_user = $this->db_connection->prepare('SELECT * FROM admin WHERE user_name = :user_name');

            $query_user->bindValue(':user_name', $user_name, PDO::PARAM_STR);

            $query_user->execute();

            // get result row (as an object)

            return $query_user->fetchObject();

        } else {

            return false;

        }

    }



    /**

     * Logs in with S_SESSION data.

     * Technically we are already logged in at that point of time, as the $_SESSION values already exist.

     */

    private function loginWithSessionData()

    {
        $this->user_is_logged_in = true;

    }



    /**

     * Logs in via the Cookie

     * @return bool success state of cookie login

     */

	



    public function loginWithCookieData()

    {

		global $database;

		//define('COOKIE_SECRET_KEY',);

        if (isset($_COOKIE['rememberme'])) {

			
            // extract data from the cookie

            list ($user_id, $token, $hash,$role) = explode(':', $_COOKIE['rememberme']);

			

	
				
				if(!empty($user_id)&& !empty($token) && !empty($hash) && !empty($role)){

				   $sql = "SELECT id FROM staff WHERE id = :user_id

                                                      AND user_rememberme_token = :user_rememberme_token AND user_rememberme_token IS NOT NULL";

				$sth = $database->prepare($sql);

                    $sth->bindValue(':user_id', $user_id, PDO::PARAM_INT);

                    $sth->bindValue(':user_rememberme_token', $token, PDO::PARAM_STR);

                    $sth->execute();

					

				if($sth->rowCount() > 0){

                    // get result row (as an object)

                    $result_row = $sth->fetchObject();

			

					session_regenerate_id();

                // write user data into PHP SESSION [a file on your server]

                 $_SESSION['user_id'] = $user_id;

				$_SESSION['user_role'] =  $role;

                $_SESSION['user_logged_in'] = 1;

				$_SESSION['userAgent'] = $this->hashSessionData($_SERVER['HTTP_USER_AGENT']);

				$_SESSION['rmt_address'] = $this->hashSessionData($_SERVER['REMOTE_ADDR']);

				

				

				$time = time();

			

				 $sql = "UPDATE staff SET last_login = $time WHERE $id_field= :id ";

                $query_user = $database->prepare($sql);

                $query_user->bindValue('id', $_SESSION['user_id'], PDO::PARAM_INT);

                $query_user->execute(); ;

				

				

				

				  return true;}else{

					setcookie("rememberme", "", time() - 3600);

					  return false;

					}
				}else{
					
					setcookie("rememberme", "", time() - 3600);

					  return false;
					
					}

				

				

        }

      

    }



   


      /**

     * Logs in with the data provided in $post, coming from the login form

     * @param $user_name

     * @param $user_password

     * @param $user_rememberme

     */

    private function loginWithPostData($username, $user_password, $user_rememberme,$branch = ''){
		global $database;
		$username = trim($username);
		$user_password = trim($user_password);
	
		if(empty($username)){
			$_SESSION['error'] = "Pls enter your username";
			redirect_to($_SERVER['HTTP_REFERER']);
			}		

		if(empty($user_password)){
			$_SESSION['error'] = "Pls enter your password";
			redirect_to($_SERVER['HTTP_REFERER']);
			}	
		//$hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
		 //$user_password_hash = password_hash($user_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));

        if (!empty($username)){

         

			     $sql = "SELECT * FROM staff WHERE staff_id= :username AND active = :active ";
			
                $query_user = $database->prepare($sql);
                $query_user->bindValue('username', $username, PDO::PARAM_STR);
				$query_user->bindValue('active', 1, PDO::PARAM_STR);
                $query_user->execute();
				$query_user->rowCount();
                $result_row = $query_user->fetchObject();

            if ($query_user->rowCount() == 0) {
			
			
						$this->errors[] = "Invalid username / password combination";
						return false;
            }else if (!password_verify($user_password, $result_row->password)) {

				
						$this->errors[] = "Invalid username / password combination";
						
      
			}else {
		
							
							
							
							if($result_row->staff_type >0){
									$sql = "SELECT name, type FROM user_types WHERE id = ".$result_row->staff_type;
									$staff_type = $database->query($sql);
									$staff_type=$staff_type->fetch(PDO::FETCH_OBJ);
									$_SESSION['staff_type'] = $staff_type->name;
									$_SESSION['user_type'] = $staff_type->type;
							
							}else{
								$sql="SELECT title FROM ehr_job_titles WHERE id=".$result_row->job_title;
									$staff_type=$database->query($sql)->fetch(PDO::FETCH_OBJ);
									$_SESSION['staff_type'] = $staff_type->title;
									$_SESSION['user_type'] = $staff_type->title;
								}
								
								
							$_SESSION['action'] = $result_row->action;
							$_SESSION['user_name'] = ucwords($result_row->surname).' '.ucwords($result_row->other_names);
							
							$sql = "SELECT r.role,u.department_id,s.id,s.care_group FROM roles r, user_roles u,ehr_company_structure s WHERE r.id = u.role_id AND u.staff_id =  $result_row->id AND s.id=u.department_id";
							$roles = $database->query($sql);
							
							
							
							$user_roles = '';
							$care_group='';
							$department='';
							$i = 1;
							while($data = $roles->fetch(PDO::FETCH_OBJ)){
								if($i > 1){
									$user_roles .=",";
									$care_group .=",";
									$department .=",";
									}
								$user_roles .="$data->role";
								$care_group .="$data->care_group";
								$department .="$data->department_id";
								$i++;
								
								}
								$_SESSION['user_role'] = array_unique(explode(',',$user_roles));
								$_SESSION['care_group'] = array_unique(explode(',',$care_group));
								$_SESSION['department'] = array_unique(explode(',',$department));
					
						session_regenerate_id();
						$_SESSION['user_id'] = $result_row->id;
						$_SESSION['passport'] = $result_row->passport;
						$_SESSION['gender'] = $result_row->gender;
						$_SESSION['user_logged_in'] = 1;
						$_SESSION['userAgent'] = $this->hashSessionData($_SERVER['HTTP_USER_AGENT']);
						$_SESSION['rmt_address'] = $this->hashSessionData($_SERVER['REMOTE_ADDR']);
						$time = time();
						$this->user_is_logged_in = true;
						$this->lastLogin();
						
						$this->newRememberMeCookie();
						unset($result_row,$query_user);
						return true;
						


					

              

            }

        }

    }

	
	public function lastLogin(){
		 global $database;
		$sql = "UPDATE staff SET last_login = ".time()." WHERE id= :id ";
		$query_user = $database->prepare($sql);
		$query_user->bindValue('id', $_SESSION['user_id'], PDO::PARAM_INT);
		$query_user->execute();
		}

	public function ApplicantlastLogin(){
		 global $database;
		$sql = "UPDATE ehr_applicants SET last_login = ".time()." WHERE id= :id ";
		$query_user = $database->prepare($sql);
		$query_user->bindValue('id', $_SESSION['user_id'], PDO::PARAM_INT);
		$query_user->execute();
		}


    /**

     * Create all data needed for remember me cookie connection on client and server side

     */

    private function newRememberMeCookie()

    {

		

        // if database connection opened

        if ($this->databaseConnection()) {

	

			$role = $_SESSION['user_role'];

			

			

			switch($role){

				case 'admin':

				$table = 'admin';

				$id_field = 'user_id';

				break;

				

				case 'teacher':

				case 'staff':

				$table = 'staff';

				$id_field = 'id';

				break;

				

				case 'student':

				$table = 'students';

				$id_field = 'id';

				break;

				

				case 'parents':

				$table = 'parents';

				$id_field = 'id';

				break;

				

			}

			

			try{

            // generate 64 char random string and store it in current user data

			//l

			

			 $time = time();

             $random_token_string = hash('sha256', mt_rand());

			 $sql = "UPDATE $table SET last_login = $time, user_rememberme_token = :user_rememberme_token WHERE $id_field = :id";

			 $sth = $this->db_connection->prepare($sql);

              $sth->bindValue('user_rememberme_token',$random_token_string,PDO::PARAM_STR);

			  $sth->bindValue('id',$_SESSION['user_id'],PDO::PARAM_INT);

              $sth->execute();

			

			}catch(PDOException $e){

				//die($e->getMessage());

				}

            // generate cookie string that consists of userid, randomstring and combined hash of both

			

            $cookie_string_first_part = $_SESSION['user_id'] . ':' . $random_token_string;

            $cookie_string_hash = hash('sha256', $cookie_string_first_part . COOKIE_SECRET_KEY);

            $cookie_string = $cookie_string_first_part . ':' . $cookie_string_hash.':'.$role;

			

			$time = time() + COOKIE_RUNTIME;

            // set cookie

            setcookie('rememberme', $cookie_string,$time,'/');

			setcookie('rememberme_role', $_SESSION['user_role'], $time,'/');

			

        }

    }



    /**

     * Delete all data needed for remember me cookie connection on client and server side

     */

    private function deleteRememberMeCookie()

    {

        // if database connection opened

        if ($this->databaseConnection()) {

            // Reset rememberme token

           //// $sth = $this->db_connection->prepare("UPDATE admin SET user_rememberme_token = NULL WHERE user_id = :user_id");

          //  $sth->execute(array(':user_id' => $_SESSION['user_id']));

        }



        // set the rememberme-cookie to ten years ago (3600sec * 365 days * 10).

        // that's obivously the best practice to kill a cookie via php

        // @see http://stackoverflow.com/a/686166/1114320

        setcookie('rememberme', false, time() - (3600 * 3650), '/', COOKIE_DOMAIN);

    }



    /**

     * Perform the logout, resetting the session

     */

    public function doLogout()

    {

        $this->deleteRememberMeCookie();

        $_SESSION = array();

        session_destroy();



        $this->user_is_logged_in = false;

        $this->messages[] = MESSAGE_LOGGED_OUT;

    }



    /**

     * Simply return the current state of the user's login

     * @return bool user's login status

     */

    public function isUserLoggedIn()

    {

        return $this->user_is_logged_in;

    }



    /**

     * Edit the user's name, provided in the editing form

     */

    public function editUserName($user_name)

    {

        // prevent database flooding

        $user_name = substr(trim($user_name), 0, 64);



        if (!empty($user_name) && $user_name == $_SESSION['user_name']) {

            $this->errors[] = MESSAGE_USERNAME_SAME_LIKE_OLD_ONE;



        // username cannot be empty and must be azAZ09 and 2-64 characters

        // TODO: maybe this pattern should also be implemented in Registration.php (or other way round)

        } elseif (empty($user_name) || !preg_match("/^(?=.{2,64}$)[a-zA-Z][a-zA-Z0-9]*(?: [a-zA-Z0-9]+)*$/", $user_name)) {

            $this->errors[] = MESSAGE_USERNAME_INVALID;



        } else {

            // check if new username already exists

            $result_row = $this->getUserData($user_name);



            if (isset($result_row->user_id)) {

                $this->errors[] = MESSAGE_USERNAME_EXISTS;

            } else {

                // write user's new data into database

                $query_edit_user_name = $this->db_connection->prepare('UPDATE admin SET user_name = :user_name WHERE user_id = :user_id');

                $query_edit_user_name->bindValue(':user_name', $user_name, PDO::PARAM_STR);

                $query_edit_user_name->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

                $query_edit_user_name->execute();



                if ($query_edit_user_name->rowCount()) {

                    $_SESSION['user_name'] = $user_name;

                    $this->messages[] = MESSAGE_USERNAME_CHANGED_SUCCESSFULLY . $user_name;

                } else {

                    $this->errors[] = MESSAGE_USERNAME_CHANGE_FAILED;

                }

            }

        }

    }



    /**

     * Edit the user's email, provided in the editing form

     */

    public function editUserEmail($user_email)

    {

        // prevent database flooding

        $user_email = substr(trim($user_email), 0, 64);



        if (!empty($user_email) && $user_email == $_SESSION["user_email"]) {

            $this->errors[] = MESSAGE_EMAIL_SAME_LIKE_OLD_ONE;

        // user mail cannot be empty and must be in email format

        } elseif (empty($user_email) || !filter_var($user_email, FILTER_VALIDATE_EMAIL)) {

            $this->errors[] = MESSAGE_EMAIL_INVALID;



        } else if ($this->databaseConnection()) {

            // check if new email already exists

            $query_user = $this->db_connection->prepare('SELECT * FROM admin WHERE user_email = :user_email');

            $query_user->bindValue(':user_email', $user_email, PDO::PARAM_STR);

            $query_user->execute();

            // get result row (as an object)

            $result_row = $query_user->fetchObject();



            // if this email exists

            if (isset($result_row->user_id)) {

                $this->errors[] = MESSAGE_EMAIL_ALREADY_EXISTS;

            } else {

                // write admin new data into database

                $query_edit_user_email = $this->db_connection->prepare('UPDATE admin SET user_email = :user_email WHERE user_id = :user_id');

                $query_edit_user_email->bindValue(':user_email', $user_email, PDO::PARAM_STR);

                $query_edit_user_email->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

                $query_edit_user_email->execute();



                if ($query_edit_user_email->rowCount()) {

                    $_SESSION['user_email'] = $user_email;

                    $this->messages[] = MESSAGE_EMAIL_CHANGED_SUCCESSFULLY . $user_email;

                } else {

                    $this->errors[] = MESSAGE_EMAIL_CHANGE_FAILED;

                }

            }

        }

    }



    /**

     * Edit the user's password, provided in the editing form

     */

    public function editUserPassword($user_password_old, $user_password_new, $user_password_repeat)

    {

        if (empty($user_password_new) || empty($user_password_repeat) || empty($user_password_old)) {

            $this->errors[] = MESSAGE_PASSWORD_EMPTY;

        // is the repeat password identical to password

        } elseif ($user_password_new !== $user_password_repeat) {

            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;

        // password need to have a minimum length of 6 characters

        } elseif (strlen($user_password_new) < 6) {

            $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;



        // all the above tests are ok

        } else {

            // database query, getting hash of currently logged in user (to check with just provided password)

            $result_row = $this->getUserData($_SESSION['user_name']);



            // if this user exists

            if (isset($result_row->user_password_hash)) {



                // using PHP 5.5's password_verify() function to check if the provided passwords fits to the hash of that user's password

                if (password_verify($user_password_old, $result_row->user_password_hash)) {



                    // now it gets a little bit crazy: check if we have a constant HASH_COST_FACTOR defined (in config/hashing.php),

                    // if so: put the value into $hash_cost_factor, if not, make $hash_cost_factor = null

                    $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);



                    // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string

                    // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing

                    // compatibility library. the third parameter looks a little bit shitty, but that's how those PHP 5.5 functions

                    // want the parameter: as an array with, currently only used with 'cost' => XX.

                    $user_password_hash = password_hash($user_password_new, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));



                    // write users new hash into database

                    $query_update = $this->db_connection->prepare('UPDATE admin SET user_password_hash = :user_password_hash WHERE user_id = :user_id');

                    $query_update->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);

                    $query_update->bindValue(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);

                    $query_update->execute();



                    // check if exactly one row was successfully changed:

                    if ($query_update->rowCount()) {

                        $this->messages[] = MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY;

                    } else {

                        $this->errors[] = MESSAGE_PASSWORD_CHANGE_FAILED;

                    }

                } else {

                    $this->errors[] = MESSAGE_OLD_PASSWORD_WRONG;

                }

            } else {

                $this->errors[] = "Invalid username / password combination";

            }

        }

    }



    /**

     * Sets a random token into the database (that will verify the user when he/she comes back via the link

     * in the email) and sends the according email.

     */

    public function setPasswordResetDatabaseTokenAndSendMail($user_name)

    {

        $user_name = trim($user_name);



        if (empty($user_name)) {

            $this->errors[] = MESSAGE_USERNAME_EMPTY;



        } else {

            // generate timestamp (to see when exactly the user (or an attacker) requested the password reset mail)

            // btw this is an integer ;)

            $temporary_timestamp = time();

            // generate random hash for email password reset verification (40 char string)

            $user_password_reset_hash = sha1(uniqid(mt_rand(), true));

            // database query, getting all the info of the selected user

            $result_row = $this->getUserData($user_name);



            // if this user exists

            if (isset($result_row->user_id)) {



                // database query:

                $query_update = $this->db_connection->prepare('UPDATE admin SET user_password_reset_hash = :user_password_reset_hash,

                                                               user_password_reset_timestamp = :user_password_reset_timestamp

                                                               WHERE user_name = :user_name');

                $query_update->bindValue(':user_password_reset_hash', $user_password_reset_hash, PDO::PARAM_STR);

                $query_update->bindValue(':user_password_reset_timestamp', $temporary_timestamp, PDO::PARAM_INT);

                $query_update->bindValue(':user_name', $user_name, PDO::PARAM_STR);

                $query_update->execute();



                // check if exactly one row was successfully changed:

                if ($query_update->rowCount() == 1) {

                    // send a mail to the user, containing a link with that token hash string

                    $this->sendPasswordResetMail($user_name, $result_row->user_email, $user_password_reset_hash);

                    return true;

                } else {

                    $this->errors[] = MESSAGE_DATABASE_ERROR;

                }

            } else {

                $this->errors[] = "Invalid username / password combination";

            }

        }

        // return false (this method only returns true when the database entry has been set successfully)

        return false;

    }



    /**

     * Sends the password-reset-email.

     */

    public function sendPasswordResetMail($user_name, $user_email, $user_password_reset_hash)

    {

        $mail = new PHPMailer;



        // please look into the config/config.php for much more info on how to use this!

        // use SMTP or use mail()

        if (EMAIL_USE_SMTP) {

            // Set mailer to use SMTP

            $mail->IsSMTP();

            //useful for debugging, shows full SMTP errors

            //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only

            // Enable SMTP authentication

            $mail->SMTPAuth = EMAIL_SMTP_AUTH;

            // Enable encryption, usually SSL/TLS

            if (defined(EMAIL_SMTP_ENCRYPTION)) {

                $mail->SMTPSecure = EMAIL_SMTP_ENCRYPTION;

            }

            // Specify host server

            $mail->Host = EMAIL_SMTP_HOST;

            $mail->Username = EMAIL_SMTP_USERNAME;

            $mail->Password = EMAIL_SMTP_PASSWORD;

            $mail->Port = EMAIL_SMTP_PORT;

        } else {

            $mail->IsMail();

        }



        $mail->From = EMAIL_PASSWORDRESET_FROM;

        $mail->FromName = EMAIL_PASSWORDRESET_FROM_NAME;

        $mail->AddAddress($user_email);

        $mail->Subject = EMAIL_PASSWORDRESET_SUBJECT;



        $link    = EMAIL_PASSWORDRESET_URL.'?user_name='.urlencode($user_name).'&verification_code='.urlencode($user_password_reset_hash);

        $mail->Body = EMAIL_PASSWORDRESET_CONTENT . ' ' . $link;



        if(!$mail->Send()) {

            $this->errors[] = MESSAGE_PASSWORD_RESET_MAIL_FAILED . $mail->ErrorInfo;

            return false;

        } else {

            $this->messages[] = MESSAGE_PASSWORD_RESET_MAIL_SUCCESSFULLY_SENT;

            return true;

        }

    }



    /**

     * Checks if the verification string in the account verification mail is valid and matches to the user.

     */

    public function checkIfEmailVerificationCodeIsValid($user_name, $verification_code)

    {

        $user_name = trim($user_name);



        if (empty($user_name) || empty($verification_code)) {

            $this->errors[] = MESSAGE_LINK_PARAMETER_EMPTY;

        } else {

            // database query, getting all the info of the selected user

            $result_row = $this->getUserData($user_name);



            // if this user exists and have the same hash in database

            if (isset($result_row->user_id) && $result_row->user_password_reset_hash == $verification_code) {



                $timestamp_one_hour_ago = time() - 3600; // 3600 seconds are 1 hour



                if ($result_row->user_password_reset_timestamp > $timestamp_one_hour_ago) {

                    // set the marker to true, making it possible to show the password reset edit form view

                    $this->password_reset_link_is_valid = true;

                } else {

                    $this->errors[] = MESSAGE_RESET_LINK_HAS_EXPIRED;

                }

            } else {

                $this->errors[] = "Invalid username / password combination";

            }

        }

    }



    /**

     * Checks and writes the new password.

     */

    public function editNewPassword($user_name, $user_password_reset_hash, $user_password_new, $user_password_repeat)

    {

        // TODO: timestamp!

        $user_name = trim($user_name);



        if (empty($user_name) || empty($user_password_reset_hash) || empty($user_password_new) || empty($user_password_repeat)) {

            $this->errors[] = MESSAGE_PASSWORD_EMPTY;

        // is the repeat password identical to password

        } else if ($user_password_new !== $user_password_repeat) {

            $this->errors[] = MESSAGE_PASSWORD_BAD_CONFIRM;

        // password need to have a minimum length of 6 characters

        } else if (strlen($user_password_new) < 6) {

            $this->errors[] = MESSAGE_PASSWORD_TOO_SHORT;

        // if database connection opened

        } else if ($this->databaseConnection()) {

            // now it gets a little bit crazy: check if we have a constant HASH_COST_FACTOR defined (in config/hashing.php),

            // if so: put the value into $hash_cost_factor, if not, make $hash_cost_factor = null

            $hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);



            // crypt the user's password with the PHP 5.5's password_hash() function, results in a 60 character hash string

            // the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using PHP 5.3/5.4, by the password hashing

            // compatibility library. the third parameter looks a little bit shitty, but that's how those PHP 5.5 functions

            // want the parameter: as an array with, currently only used with 'cost' => XX.

            $user_password_hash = password_hash($user_password_new, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));



            // write admin new hash into database

            $query_update = $this->db_connection->prepare('UPDATE admin SET user_password_hash = :user_password_hash,

                                                           user_password_reset_hash = NULL, user_password_reset_timestamp = NULL

                                                           WHERE user_name = :user_name AND user_password_reset_hash = :user_password_reset_hash');

            $query_update->bindValue(':user_password_hash', $user_password_hash, PDO::PARAM_STR);

            $query_update->bindValue(':user_password_reset_hash', $user_password_reset_hash, PDO::PARAM_STR);

            $query_update->bindValue(':user_name', $user_name, PDO::PARAM_STR);

            $query_update->execute();



            // check if exactly one row was successfully changed:

            if ($query_update->rowCount() == 1) {

                $this->password_reset_was_successful = true;

                $this->messages[] = MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY;

            } else {

                $this->errors[] = MESSAGE_PASSWORD_CHANGE_FAILED;

            }

        }

    }



    /**

     * Gets the success state of the password-reset-link-validation.

     * TODO: should be more like getPasswordResetLinkValidationStatus

     * @return boolean

     */

    public function passwordResetLinkIsValid()

    {

        return $this->password_reset_link_is_valid;

    }



    /**

     * Gets the success state of the password-reset action.

     * TODO: should be more like getPasswordResetSuccessStatus

     * @return boolean

     */

    public function passwordResetWasSuccessful()

    {

        return $this->password_reset_was_successful;

    }



    /**

     * Gets the username

     * @return string username

     */

    public function getUsername()

    {

        return $this->user_name;

    }



    /**

     * Get either a Gravatar URL or complete image tag for a specified email address.

     * Gravatar is the #1 (free) provider for email address based global avatar hosting.

     * The URL (or image) returns always a .jpg file !

     * For deeper info on the different parameter possibilities:

     * @see http://de.gravatar.com/site/implement/images/

     *

     * @param string $email The email address

     * @param string $s Size in pixels, defaults to 50px [ 1 - 2048 ]

     * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]

     * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]

     * @param array $atts Optional, additional key/value attributes to include in the IMG tag

     * @source http://gravatar.com/site/implement/images/php/

     */

    public function getGravatarImageUrl($email, $s = 50, $d = 'mm', $r = 'g', $atts = array() )

    {

        $url = 'http://www.gravatar.com/avatar/';

        $url .= md5(strtolower(trim($email)));

        $url .= "?s=$s&d=$d&r=$r&f=y";



        // the image url (on gravatarr servers), will return in something like

        // http://www.gravatar.com/avatar/205e460b479e2e5b48aec07710c08d50?s=80&d=mm&r=g

        // note: the url does NOT have something like .jpg

        $this->user_gravatar_image_url = $url;



        // build img tag around

        $url = '<img src="' . $url . '"';

        foreach ($atts as $key => $val)

            $url .= ' ' . $key . '="' . $val . '"';

        $url .= ' />';



        // the image url like above but with an additional <img src .. /> around

        $this->user_gravatar_image_tag = $url;

    }

}

