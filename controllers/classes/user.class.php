<?php 
	require_once ('notification.class.php');
	//require_once ('../lib/functions.php');


class User{


		public function myCompletedIndividual(){

		global $database;

		$sql = "SELECT  h.user_id, u.first_name, u.last_name, u.bio, u.pic_set, u.profile_picture, u.thumb, h.handyman_id, h.date_created, c1.name AS nationality_name, c.name AS country_name, ct.name AS city_name, s.name AS state_name  FROM  completed_services h, users u  LEFT JOIN countries c1 ON (c1.id = u.nationality) LEFT JOIN countries c ON (c.id = u.country_of_residence) LEFT JOIN cities ct ON (ct.id = u.city_of_residence	) LEFT JOIN states s ON (s.id = u.state_of_residence) WHERE h.user_id = ".$_SESSION['user_id']." AND u.id = h.user_id AND u.active = 1";

		// $sql = "SELECT  h.user_id  FROM favourite_company h WHERE h.user_id = ".$_SESSION['user_id']."";

		// $sql = "SELECT c.company_id, h.user_id  FROM favourite h, favourite_company c WHERE h.user_id = c.user_id AND h.user_id = ".$_SESSION['user_id']." AND c.user_id =".$_SESSION['user_id'];

		$result = $database->query($sql);

		

		if($result->rowCount() > 0){

			$html = '';


			while ($data = $result->fetch(PDO::FETCH_ASSOC)) {




						$userMonth = date("F", $data['date_created']);

                        $userDay = date("j", $data['date_created']);

                        $userYear = date("Y", $data['date_created']);



				if($data['pic_set'] == 1){

					$image = $data['profile_picture'];

				}else{

					$image =  'assets/images/avatar2.jpg';

				}
				


				$html .= '			<!-- news item -->
							<div class="inews-item">
								<a class="inews-thumbnail image-hover lightbox" href="'.$image.'" data-plugin-options="{"type":"image"}"">
									<span class="image-hover-icon image-hover-dark">
										<i class="fa fa-search-plus"></i>
									</span>
									<img class="img-responsive" src="'.$image.'" alt="image" />
								</a>
								
								<div class="inews-item-content">

									<div class="inews-date-wrapper">
										<span class="inews-date-day">'.$userDay.'</span>
										<span class="inews-date-month">'.$userMonth.'</span>
										<span class="inews-date-year">'.$userYear.'</span>
									</div>

									<div class="inews-content-inner">

										<h3 class="size-20"><a href="individual-details.php?id='.$data['handyman_id'].'">'.$data['first_name'].' '.$data['last_name'].'</a></h3>
										<ul class="blog-post-info list-inline noborder margin-bottom-20 nopadding">
											<li>
												<a href="page-profile.html">
													<i class="fa fa-user"></i> 
													<span class="font-lato">By John Doe</span>
												</a>
											</li>
											<li>
												<i class="fa fa-folder-open-o"></i> ';


												$sql1 = "SELECT s.name, hs.id FROM handyman_services hs LEFT JOIN services s ON (s.id = hs.service_id) WHERE hs.user_id = ".$data['user_id'];

												$result1 = $database->query($sql1);

												if($result1->rowCount() > 0){

													while ($data1 = $result1->fetch(PDO::FETCH_ASSOC)) {
														$html .='<a class="category" href="individual-details?id='.$data['user_id'].'&h_id='.$data1['id'].'">
																	<span class="font-lato">'.$data1['name'].'</span>
																</a>';
													}

												}


										$html .=	'</li>
										</ul>

										<p>  '.$data['country_name'].', '.$data['state_name'].', '.$data['city_name'].'<br> '.$data['bio'].'</p>
									</div>
									

								</div>
							</div>
							<!-- /news item -->';




			}





		}else{


			$html = '<div align="center"><h3>No Favourite added Yet</h3></div>';


		}


		echo $html;



	}



	public function myCompletedCompany(){

		global $database;

		// $sql = "SELECT  h.user_id  FROM favourite h WHERE h.user_id = ".$_SESSION['user_id']."";

		$sql = "SELECT  h.user_id, c.name,c.path, c.thumb,c.pic_set, c.id, h.date_created, c.description, c1.name AS country_name,  ct.name AS city_name, s.name AS state_name  FROM company_completed_services h, companies c LEFT JOIN countries c1 ON (c1.id = c.country) LEFT JOIN cities ct ON (ct.id = c.city) LEFT JOIN states s ON (s.id = c.state) WHERE c.id = h.company_id AND h.user_id = ".$_SESSION['user_id']."";

		// $sql = "SELECT c.company_id, h.user_id  FROM favourite h, favourite_company c WHERE h.user_id = c.user_id AND h.user_id = ".$_SESSION['user_id']." AND c.user_id =".$_SESSION['user_id'];

		$result = $database->query($sql);

		

		if($result->rowCount() > 0){

			$html = '';


			while ($data = $result->fetch(PDO::FETCH_ASSOC)) {


						$userMonth = date("F", $data['date_created']);

                        $userDay = date("j", $data['date_created']);

                        $userYear = date("Y", $data['date_created']);

                       


				if($data['pic_set'] == 1){

					$image = $data['path'];

				}else{

					$image =  'assets/images/avatar2.jpg';

				}
				


				$html .= '			<!-- news item -->
							<div class="inews-item">
								<a class="inews-thumbnail image-hover lightbox" href="'.$image.'" data-plugin-options="{"type":"image"}"">
									<span class="image-hover-icon image-hover-dark">
										<i class="fa fa-search-plus"></i>
									</span>
									<img class="img-responsive" src="'.$image.'" alt="image" />
								</a>
								
								<div class="inews-item-content">

									<div class="inews-date-wrapper">
										<span class="inews-date-day">'.$userDay.'</span>
										<span class="inews-date-month">'.$userMonth.'</span>
										<span class="inews-date-year">'.$userYear.'</span>
									</div>

									<div class="inews-content-inner">

										<h3 class="size-20"><a href="company-details.php?id='.$data['id'].'">'.$data['name'].'</a></h3>
										<ul class="blog-post-info list-inline noborder margin-bottom-20 nopadding">
											<li>
												<a href="page-profile.html">
													<i class="fa fa-user"></i> 
													<span class="font-lato">By John Doe</span>
												</a>
											</li>
											<li>
												<i class="fa fa-folder-open-o"></i>';


												$sql1 = "SELECT s.name, hs.id FROM company_services hs LEFT JOIN services s ON (s.id = hs.service_id) WHERE hs.user_id = ".$data['user_id'];

												$result1 = $database->query($sql1);

												if($result1->rowCount() > 0){

													while ($data1 = $result1->fetch(PDO::FETCH_ASSOC)) {
														$html .='<a class="category" href="individual-details?id='.$data['user_id'].'&h_id='.$data1['id'].'">
																	<span class="font-lato">'.$data1['name'].'</span>
																</a>';
													}

												}


										$html .=	'</li>
										</ul>

										<p>  '.$data['country_name'].', '.$data['state_name'].', '.$data['city_name'].'<br> '.$data['description'].'</p>
									</div>
									

								</div>
							</div>
							<!-- /news item -->';




			}





		}else{


			$html = '<div align="center"><h3>No Favourite added Yet</h3></div>';


		}


		}


	public function myFavouriteIndividual(){

		global $database;

		$sql = "SELECT  h.user_id, u.first_name, u.last_name, u.bio, u.pic_set, u.profile_picture, u.thumb, h.handyman_id, h.date_created, c1.name AS nationality_name, c.name AS country_name, ct.name AS city_name, s.name AS state_name  FROM favourite h, users u  LEFT JOIN countries c1 ON (c1.id = u.nationality) LEFT JOIN countries c ON (c.id = u.country_of_residence) LEFT JOIN cities ct ON (ct.id = u.city_of_residence	) LEFT JOIN states s ON (s.id = u.state_of_residence) WHERE h.user_id = ".$_SESSION['user_id']." AND u.id = h.handyman_id AND u.active = 1";

		// $sql = "SELECT  h.user_id  FROM favourite_company h WHERE h.user_id = ".$_SESSION['user_id']."";

		// $sql = "SELECT c.company_id, h.user_id  FROM favourite h, favourite_company c WHERE h.user_id = c.user_id AND h.user_id = ".$_SESSION['user_id']." AND c.user_id =".$_SESSION['user_id'];

		$result = $database->query($sql);

		

		if($result->rowCount() > 0){

			$html = '';


			while ($data = $result->fetch(PDO::FETCH_ASSOC)) {




						$userMonth = date("F", $data['date_created']);

                        $userDay = date("j", $data['date_created']);

                        $userYear = date("Y", $data['date_created']);



				if($data['pic_set'] == 1){

					$image = $data['profile_picture'];

				}else{

					$image =  'assets/images/avatar2.jpg';

				}
				


				$html .= '			<!-- news item -->
							<div class="inews-item">
								<a class="inews-thumbnail image-hover lightbox" href="'.$image.'" data-plugin-options="{"type":"image"}"">
									<span class="image-hover-icon image-hover-dark">
										<i class="fa fa-search-plus"></i>
									</span>
									<img class="img-responsive favourite-img" src="'.$image.'" alt="image" />
								</a>
								
								<div class="inews-item-content">

									<div class="inews-date-wrapper">
										<span class="inews-date-day">'.$userDay.'</span>
										<span class="inews-date-month">'.$userMonth.'</span>
										<span class="inews-date-year">'.$userYear.'</span>
									</div>

									<div class="inews-content-inner">

										<h3 class="size-20"><a href="individual-details.php?id='.$data['handyman_id'].'">'.$data['first_name'].' '.$data['last_name'].'</a></h3>
										<ul class="blog-post-info list-inline noborder margin-bottom-20 nopadding">
											<li>
												<a href="page-profile.html">
													<i class="fa fa-user"></i> 
													<span class="font-lato">By John Doe</span>
												</a>
											</li>
											<li>
												<i class="fa fa-folder-open-o"></i> ';


												$sql1 = "SELECT s.name, hs.id FROM handyman_services hs LEFT JOIN services s ON (s.id = hs.service_id) WHERE hs.user_id = ".$data['user_id'];

												$result1 = $database->query($sql1);

												if($result1->rowCount() > 0){

													while ($data1 = $result1->fetch(PDO::FETCH_ASSOC)) {
														$html .='<a class="category" href="individual-details?id='.$data['user_id'].'&h_id='.$data1['id'].'">
																	<span class="font-lato">'.$data1['name'].'</span>
																</a>';
													}

												}


										$html .=	'</li>
										</ul>

										<p>  '.$data['country_name'].', '.$data['state_name'].', '.$data['city_name'].'<br> '.$data['bio'].'</p>
									</div>
									

								</div>
							</div>
							<!-- /news item -->';




			}





		}else{


			$html = '<div align="center"><h3>No Favourite added Yet</h3></div>';


		}


		echo $html;



	}



	public function myFavouriteCompany(){

		global $database;

		// $sql = "SELECT  h.user_id  FROM favourite h WHERE h.user_id = ".$_SESSION['user_id']."";

		$sql = "SELECT  h.user_id, c.name,c.path, c.thumb,c.pic_set, c.id, h.date_created, c.description, c1.name AS country_name,  ct.name AS city_name, s.name AS state_name  FROM favourite_company h, companies c LEFT JOIN countries c1 ON (c1.id = c.country) LEFT JOIN cities ct ON (ct.id = c.city) LEFT JOIN states s ON (s.id = c.state) WHERE c.id = h.company_id AND h.user_id = ".$_SESSION['user_id']."";

		// $sql = "SELECT c.company_id, h.user_id  FROM favourite h, favourite_company c WHERE h.user_id = c.user_id AND h.user_id = ".$_SESSION['user_id']." AND c.user_id =".$_SESSION['user_id'];

		$result = $database->query($sql);

		

		if($result->rowCount() > 0){

			$html = '';


			while ($data = $result->fetch(PDO::FETCH_ASSOC)) {


						$userMonth = date("F", $data['date_created']);

                        $userDay = date("j", $data['date_created']);

                        $userYear = date("Y", $data['date_created']);

                       


				if($data['pic_set'] == 1){

					$image = $data['path'];

				}else{

					$image =  'assets/images/avatar2.jpg';

				}
				


				$html .= '			<!-- news item -->
							<div class="inews-item">
								<a class="inews-thumbnail image-hover lightbox" href="'.$image.'" data-plugin-options="{"type":"image"}"">
									<span class="image-hover-icon image-hover-dark">
										<i class="fa fa-search-plus"></i>
									</span>
									<img class="img-responsive" src="'.$image.'" alt="image" />
								</a>
								
								<div class="inews-item-content">

									<div class="inews-date-wrapper">
										<span class="inews-date-day">'.$userDay.'</span>
										<span class="inews-date-month">'.$userMonth.'</span>
										<span class="inews-date-year">'.$userYear.'</span>
									</div>

									<div class="inews-content-inner">

										<h3 class="size-20"><a href="company-details.php?id='.$data['id'].'">'.$data['name'].'</a></h3>
										<ul class="blog-post-info list-inline noborder margin-bottom-20 nopadding">
											<li>
												<a href="page-profile.html">
													<i class="fa fa-user"></i> 
													<span class="font-lato">By John Doe</span>
												</a>
											</li>
											<li>
												<i class="fa fa-folder-open-o"></i>';


												$sql1 = "SELECT s.name, hs.id FROM company_services hs LEFT JOIN services s ON (s.id = hs.service_id) WHERE hs.user_id = ".$data['user_id'];

												$result1 = $database->query($sql1);

												if($result1->rowCount() > 0){

													while ($data1 = $result1->fetch(PDO::FETCH_ASSOC)) {
														$html .='<a class="category" href="individual-details?id='.$data['user_id'].'&h_id='.$data1['id'].'">
																	<span class="font-lato">'.$data1['name'].'</span>
																</a>';
													}

												}


										$html .=	'</li>
										</ul>

										<p>  '.$data['country_name'].', '.$data['state_name'].', '.$data['city_name'].'<br> '.$data['description'].'</p>
									</div>
									

								</div>
							</div>
							<!-- /news item -->';




			}





		}else{


			$html = '<div align="center"><h3>No Favourite added Yet</h3></div>';


		}


		echo $html;



	}



	

	
	public function register ($post, $mobile)
		{

			
			global $database;
			global $notification;

				$firstname = ucwords(clean($post['first_name']));
				$lastname= ucwords(clean($post['last_name']));
				$password = clean($post['password']);
				$email = clean($post['email']);
				$retype_password = clean($post['retype_password']);
				$phone_number = clean($post['phone_number']); 

				


					if (empty($firstname)){

						if($mobile == 1){

							echo json_encode(array("status" => "Firstname Required"));
							die;

						}else{
							$_SESSION['error'] = "Firstname Required";
							go();
						}
						
					}

					if (empty($lastname)){
						

						if($mobile == 1){

							echo json_encode(array("status" => "Lastname Required"));
							die;

						}else{
							$_SESSION['error'] = "Lastname Required";
							go();
						}

					}

					if (empty($password)){

						if($mobile == 1){

							echo json_encode(array("status" => "Password Required"));
							die;

						}else{
							$_SESSION['error'] = "Password Required";
							go();
						}
						
					}

					if (empty($phone_number)){

						if($mobile == 1){

							echo json_encode(array("status" => "Phone Number Required"));
							die;

						}else{
							$_SESSION['error'] = "Phone Number Required";
							go();
						}
						
					}

					if (empty($email)){

						if($mobile == 1){

							echo json_encode(array("status" => "Email Required"));
							die;

						}else{
							$_SESSION['error'] = "Email Required";
							go();
						}
						
					}

					// if ($password != $retype_password){
					// 	$_SESSION['error'] = "Passwords do not Match!";
					// 	go();
					// }
					

						$password_length = strlen($password);
						if($password_length < 6){
							

							if($mobile == 1){

							echo json_encode(array("status" => "Password must be at least 6 characters"));
							die;

						}else{
							$_SESSION['error'] = "Password must be at least 6 characters";
							go();
						}


						}
					
				if($this->checkEmailExist($email)==true){

					if($mobile == 1){

							echo json_encode(array("status" => "email exist"));
							die;

						}else{
							$_SESSION['error'] = "Email Already Exists";
						go();
						}
					
				}

				

				try{
					

					$database->beginTransaction();






		$hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
		  $user_password_hash = password_hash($password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
		 				$sql = "INSERT INTO users (first_name, last_name, password, email, phone1, agent, date_created, active, pic_set, verified)
						 VALUES (:firstname, :lastname, :password, :email, :phone_number, :agent, :date_created, :active, :pic_set, verified)";


				$agent = 0;
				$date_created = time();
				$active = 1;
				$pic_set = 0;
				$result = $database->prepare($sql);
				$result-> bindParam('firstname',$firstname,PDO::PARAM_STR);
				$result-> bindParam('lastname',$lastname,PDO::PARAM_STR);
				$result-> bindParam('password',$user_password_hash,PDO::PARAM_STR);
				$result-> bindParam('email',$email,PDO::PARAM_STR);
				$result-> bindParam('agent',$agent,PDO::PARAM_STR);
				$result-> bindParam('date_created',$date_created,PDO::PARAM_STR);
				$result-> bindParam('active',$active,PDO::PARAM_STR);
				$result-> bindParam('pic_set',$pic_set,PDO::PARAM_STR);
				$result-> bindParam('phone_number',$phone_number,PDO::PARAM_STR);
				$result->execute();


				if($result->rowCount() > 0){


					$id = $database->lastInsertId();

					$status =true;
					$item_type = "New User";
					//$status = $notification->addAdminNotification($_SESSION['user_id'], $item_type, $_SESSION['user_id']);

				

					if($status){

						
						$database->commit();


						if($mobile==1){
							echo json_encode(array("status" => "success", "id" => $id));
							die;
							

						}else{

							session_regenerate_id();
							$_SESSION['user_email'] = $email;
							$_SESSION['user_id'] = $id;
							$_SESSION['username'] = $firstname;
							go('../../index');

						}




						
						

					}else{


						
						$database->rollBack();

						if($mobile == 1){

							echo json_encode(array("status" => "error"));
							die;

						}else{

							// die('fggdr');
						$_SESSION['error'] = "error";
						go();

						}

						
					}


					
				}else{
					$database->rollBack();
					if($mobile == 1){

							echo json_encode(array("status" => "error"));

						}else{

							// die('fggdr');
						$_SESSION['error']= "error";
					go();

						}
					
				}


			}catch(PDOException $e){

					$database->rollBack();
					die($e->getMessage());

					if($mobile == 1){

							echo json_encode(array("status" => "error"));

						}else{

							// die('fggdr');
						$_SESSION['error']= "error";
					go();

						}
					

				}



}

				public function login ($post, $mobile){

								global $database;
								$email = clean($post['email']);
								$password = clean($post['password']);


								if (empty($email)){

									if($mobile == 1){
										echo json_encode(array('status'=>'error'));
												die;
									}else{
										error("Email Required", $mobile);
										go();
									}
							}



							if (empty($password)){


								if($mobile == 1){
									echo json_encode(array('status'=>'error'));
											die;
								}else{
									error("Password Required", $mobile);
									go();
								}

								
								
							}


						
					$sql = "SELECT id, first_name, password FROM users WHERE email = :email";
					$result = $database->prepare($sql);
					$result->bindParam('email', $email,PDO::PARAM_STR);
					$result->execute();
					
					if($result->rowCount() > 0){
									

										$data = $result->fetch(PDO::FETCH_OBJ);
										$first_name = $data->first_name;
										$id = $data->id;
											
										
										 if(password_verify($password,$data->password)){

											$present_time = time();
											$sql1 = "UPDATE users SET last_login = :present_time WHERE id = :id";
											$result = $database->prepare($sql1);
											$result->bindParam('present_time',$present_time,PDO::PARAM_INT);
											$result->bindParam('id', $email,PDO::PARAM_STR);
											$result->execute();


											if($mobile == 1){


												echo json_encode(array("status" => "success", "id" => $id));
												die;

												}else{

												 	session_regenerate_id();
													$_SESSION['user_email'] = $email;
													$_SESSION['user_id'] = $id;
													$_SESSION['username'] = $first_name;
													go('../../index');
												}

										 }else{	

										 	if($mobile == 1){

										 	    echo json_encode(array('status'=>'error'));
												die;

										 	}else{

										 		error("invalid email and password", $mobile);
												go();

										 	}

										 		 
												
									}


					}else{



						if($mobile == 1){

						 	    echo json_encode(array('status'=>'invalid details'));
								die;

						 	}else{

						 		error("invalid email and password", $mobile);
								go();

						 	}

					

						}

		}




		public function updateNewUserPassword(){


			global $database;

			$new_password = clean($_POST['password']);
			$id = clean($_POST['id']);

			$hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
		  $user_password_hash = password_hash($new_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
						

			$sql = "UPDATE users set password = :new_password, set_password = 1 WHERE oauth_uid = :id";
			$result = $database->prepare($sql);
			$result->bindParam('new_password',$user_password_hash,PDO::PARAM_STR); 
			$result->bindParam('id',$id,PDO::PARAM_INT);
			$result->execute();

			if($result){


				$this->socialLogin($id);



					$_SESSION['success'] = "Password Successfully Updated";
					go('index');
					
			}else{
				$_SESSION['error'] = "An Error Occured. Please try Again";
			}
				
				
		}





		public function socialLogin ($oauth_uid){

								global $database;
								


								if (empty($oauth_uid)){

									if($mobile == 1){
										echo json_encode(array('status'=>'error'));
												die;
									}else{
										error("An error occured", $mobile);
										go();
									}
							}




						
					$sql = "SELECT id, first_name, password FROM users WHERE oauth_uid = :oauth_uid";
					$result = $database->prepare($sql);
					$result->bindParam('oauth_uid', $oauth_uid,PDO::PARAM_STR);
					$result->execute();
					
					if($result->rowCount() > 0){
									

									$data = $result->fetch(PDO::FETCH_OBJ);
									$first_name = $data->first_name;
									$email = $data->email;
									$id = $data->id;
											

									$present_time = time();
									$sql1 = "UPDATE users SET last_login = :present_time WHERE id = :id";
									$result = $database->prepare($sql1);
									$result->bindParam('present_time',$present_time,PDO::PARAM_INT);
									$result->bindParam('id', $email,PDO::PARAM_STR);
									$result->execute();


									if($mobile == 1){


										echo json_encode(array("status" => "success", "id" => $id));
										die;

										}else{

										 	session_regenerate_id();
											$_SESSION['user_email'] = $email;
											$_SESSION['user_id'] = $id;
											$_SESSION['username'] = $first_name;
											go('../../index');
										}

										 


					}else{



						if($mobile == 1){

						 	    echo json_encode(array('status'=>'invalid details'));
								die;

						 	}else{

						 		error("invalid email and password", $mobile);
								go();

						 	}

					

						}

		}















		public function checkEmailExist($email){
			global $database;			
			$sql = "SELECT id FROM users WHERE 	email = :email";
			$result = $database->prepare($sql);
			$result-> bindParam('email', $email,PDO::PARAM_STR);
			$result->execute();
			if($result->rowCount() > 0){
				return true;
			}else{

				return false;
			}

		}


	public function subscribe(){

	$email = clean($_POST['email']);
	$page = clean($_POST['page']);
	$time = time();
	if($this->checkEmailExist1($email)==true){
		$_SESSION['error'] = 'You are already Subscribed. Thank you.';
		go('../../'.$page.'#footer1');
		}

		global $database;

		$sql = "INSERT INTO subscription (email, date) VALUES (:email, :time)";

		$result = $database->prepare($sql);
		$result->bindParam('email', $email,PDO::PARAM_STR);
		$result->bindParam('time', $time,PDO::PARAM_INT);
		$result->execute();
		if ($result){
			$_SESSION['subscribe_success'] = "Thank you for subscribing to our e-mail services.";
			go('../../'.$page.'#footer1');
		}else{

		}
		

}



	public function checkEmailExist1($email){
			global $database;			
			$sql = "SELECT id FROM subscription WHERE 	email = :email";
			$result = $database->prepare($sql);
			$result-> bindParam('email', $email,PDO::PARAM_STR);
			$result->execute();
			if($result->rowCount() > 0){
				return true;
			}else{

				return false;
			}

		}

}