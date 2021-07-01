<?php
	require_once ('notification.class.php'); 
	
	class User{


		public function addUserService($post, $files){


			global $database;
		 
		$service = clean($post['service']);
		$category = clean($post['category']);
		$description = clean($post['description']);
		$user_id = clean($post['user_id']);

		if(empty($service)){

			$_SESSION['error'] = "Please Enter a service";
		    go();

		}

		if(empty($category)){

			$_SESSION['error'] = "Please Enter a Category";
		    go();

		}
		
		$date_created = time();

		$active = 1;
		$deleted = 0;

		$sql = "INSERT INTO handyman_services (user_id, category_id, service_id, description, deleted, date_created) VALUES (:user_id, :category_id, :service_id, :description, :deleted, :date_created)";

		$result = $database->prepare($sql);
		$result->bindParam('user_id', $user_id,PDO::PARAM_INT);
		$result->bindParam('category_id', $category,PDO::PARAM_STR);
		$result->bindParam('service_id', $service,PDO::PARAM_STR);
		$result->bindParam('description', $description,PDO::PARAM_STR);
		
		//$result->bindParam('active', $active,PDO::PARAM_INT);
		$result->bindParam('deleted', $deleted,PDO::PARAM_INT);
		
		$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
		$result->execute();

		if($result->rowCount() > 0){
			$_SESSION['success'] = "Service added Successfully";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}



	}



		public function addUser($post, $files){

			global  $database;

				//print_r($post);
				//die();

			$firstname = ucwords(clean($post['first_name']));
			$lastname= ucwords(clean($post['last_name']));
			$password = 'password';
			$email = clean($post['email']);

			$bio = clean($post['bio']);
			//$retype_password = clean($post['retype_password']);
			// $phone_number = clean($post['phone_number']); 

			$phone1 = clean($post['phone1']);
			$phone2 = clean($post['phone2']);
			$city_of_residence = clean($post['city_of_residence']);
			$work_lng = clean($post['lng']);
			$work_lat = clean($post['lat']);
			$work_address2 = clean($post['formatted_address']);
		    $address = clean($post['address']);



		    $category1 = clean($post['category1']);
			$service1= clean($post['service1']);
			$description1 = clean($post['description1']);

			$category2 = clean($post['category2']);
			$service2= clean($post['service2']);
			$description2 = clean($post['description2']);

			$category3 = clean($post['category3']);
			$service3= clean($post['service3']);
			$description3 = clean($post['description3']);



		  
			if(empty($phone1)){
				 $_SESSION['error'] = "Primary phone number Required";
				go();
			}

			// if(empty($city_of_residence)){
			// 	 $_SESSION['error'] = "City of residence Required";
			// 	go();
			// }

			// if(empty($state_of_residence)){
			// 	 $_SESSION['error'] = "State of residence Required";
			// 	go();
			// }

			// if(empty($country_of_residence)){
			// 	 $_SESSION['error'] = "Country of residence Required";
			// 	go();
			// }

			// if(empty($address)){
			// 	 $_SESSION['error'] = "Home address Required";
			// 	go();
			// }

		

					if (empty($firstname)){

							$_SESSION['error'] = "Firstname Required";
							go();
					
						
					}

					if (empty($lastname)){
						
							$_SESSION['error'] = "Lastname Required";
							go();
						
					}


					if (empty($password)){

							$_SESSION['error'] = "Password Required";
							go();
						
						
					}

					

					if (empty($email)){

							$_SESSION['error'] = "Email Required";
							go();
						
						
					}

					$pic_set = 0;

					$file3 = '';
					$file1 = '';

			if($files['file']['size'] > 0){



			$picture = new Photograph;

			$file_index = 'file';


		 $file = $picture->save($files["$file_index"],uniqid().'-'.time(),'../../../uploads/profile/');

					 if($file == false){
						 $_SESSION['error'] = "Invalid image file";
						redirect_to($_SERVER['HTTP_REFERER']);
					}

						$file1 = str_ireplace('../../../','',$file);
						$file2 = str_ireplace('../../../uploads/profile/','../../../uploads/profile/thumb/',$file);

						$file3 = str_ireplace('../../../uploads/profile/thumb/','uploads/profile/thumb/',$file2);
						
				 	$thumb1  = $file2;

				 	$ImageResize = new ImageResize($file);
				 	$ImageResize->resizeToWidth(460);
				 	$ImageResize->save($thumb1);

				$pic_set = 1;		
					
				 
		}

		
					
					
				if($this->checkEmailExist($email)==true){

					
							$_SESSION['error'] = "Email Exists";
						go();
						
					
				}


				try{


					$database->beginTransaction();





		$hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
		  $user_password_hash = password_hash($password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
		 				$sql = "INSERT INTO users (first_name, last_name, password, email, agent, date_created, active, pic_set, phone1 , phone2 , city_of_residence , work_lng , work_lat , address  , work_address2, profile_picture, thumb, approved, verified, bio )
						 VALUES (:firstname, :lastname, :password, :email, :agent, :date_created, :active, :pic_set, :phone1 , :phone2 , :city_of_residence , :work_lng , :work_lat , :address , :work_address2, :profile_picture, :thumb, :approved, :verified, :bio)";


				$agent = 0;
				$date_created = time();
				$active = 1;
				$deleted = 0;

				$approved = 1;
				$verified = 1;
				
				$result = $database->prepare($sql);
				$result-> bindParam('firstname',$firstname,PDO::PARAM_STR);
				$result-> bindParam('lastname',$lastname,PDO::PARAM_STR);
				$result-> bindParam('password',$user_password_hash,PDO::PARAM_STR);
				$result-> bindParam('email',$email,PDO::PARAM_STR);
				$result-> bindParam('agent',$agent,PDO::PARAM_STR);
				$result-> bindParam('date_created',$date_created,PDO::PARAM_STR);
				$result-> bindParam('active',$active,PDO::PARAM_STR);

				$result-> bindParam('bio',$bio,PDO::PARAM_STR);
				
				$result-> bindParam('work_address2',$work_address2,PDO::PARAM_STR);

				$result->bindParam('phone1',$phone1,PDO::PARAM_STR);
				$result->bindParam('phone2',$phone2,PDO::PARAM_STR);
				$result->bindParam('city_of_residence',$city_of_residence,PDO::PARAM_STR);
				$result->bindParam('work_lat',$work_lat,PDO::PARAM_INT);
				$result->bindParam('work_lng',$work_lng,PDO::PARAM_INT);
				$result->bindParam('address',$address,PDO::PARAM_STR);

				$result->bindParam('profile_picture',$file1,PDO::PARAM_STR);
			 	$result->bindParam('pic_set',$pic_set,PDO::PARAM_INT);
			 	$result->bindParam('approved',$approved,PDO::PARAM_INT);
			 	$result->bindParam('verified',$verified,PDO::PARAM_INT);
			 	$result->bindParam('thumb',$file3,PDO::PARAM_STR);
				$result->execute();

				if($result->rowCount() > 0){
					$id = $database->lastInsertId();
					session_regenerate_id();


					if(!empty($category1)){



						$sql1 = "INSERT INTO handyman_services (user_id, category_id, service_id, description, deleted, date_created) VALUES ($id, '$category1', '$service1', '$description1', $deleted, $date_created)";

						if(!empty($category2)){

							$sql1 .= ",($id, '$category2', '$service2', '$description2', $deleted, $date_created)";

						}

						if(!empty($category3)){

							$sql1 .= ",($id, '$category3', '$service3', '$description3', $deleted, $date_created)";

						}

						

						
						
						$result1 = $database->query($sql1);

						if($result1->rowCount() > 0){


								$database->commit();
								success('User Added Successfully');
								go();


					// 		$item_type = "New Admin User!";

					// $status = $notification->addNotification($id, $id, $item_type, $id);

					// 		if($status){

					// 			$database->commit();
					// 			success('User Added Successfully');
					// 			go();

					// 		}else{

					// 			$database->rollBack();
							
					// 			$_SESSION['error']= "An error Occured, Please try Again";
					// 			go();

					// 		}


						}else{

						$database->rollBack();
					
						$_SESSION['error']= "An error Occured, Please try Again";
						go();

					}

						




						
					}


					
					
					

				}else{
					$database->rollBack();
					
						$_SESSION['error']= "An error Occured, Please try Again";
					go();

						
					
				}


			}catch(PDOException $e){

					//die('sff');

					$database->rollBack();
					die($e->getMessage());

					
						$_SESSION['error']= "An error Occured, Please try Again";
					go();

						
				

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




		public function verifyUser($id){



			global $database;


			$sql = "UPDATE users SET verified = 1 WHERE id =".$id;

			$result = $database->query($sql);

			if($result){
			$_SESSION['success'] = "User Successfully Verified";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}
	}



	public function approveUser($id){



			global $database;


			$sql = "UPDATE users SET approved = 1 WHERE id =".$id;

			$result = $database->query($sql);

			if($result){
			$_SESSION['success'] = "User Successfully approved";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}
	}


		public function unVerifyUser($id){



			global $database;


			$sql = "UPDATE users SET verified = 0 WHERE id =".$id;

			$result = $database->query($sql);

			if($result){
			$_SESSION['success'] = "User Successfully Verified";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}
		}




		public function unApproveUser($id){



			global $database;


			$sql = "UPDATE users SET approved = 0 WHERE id =".$id;

			$result = $database->query($sql);

			if($result){
			$_SESSION['success'] = "User Successfully Unapproved";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}
		}



		public function viewSubscribers(){
		global $database;

		$sql = "SELECT email, date_created FROM subscribers";

		$result = $database->query($sql);

		if($result->rowCount() > 0){

			$head = '<thead>
                <tr>

                  
                  <th>Email</th>
                  <th>Date</th>
                  
                </tr>
                </thead>';

			$html = '<table id="example1" class="table table-bordered table-striped">
                '.$head.'
                <tbody>
                ';

			while($data = $result->fetch(PDO::FETCH_ASSOC)){

				$date = date('F j, Y',$data['date_created']);


				$html .= '<tr>
			                  

			                  <td>'.$data['email'].'</td>

			                  <td>'.$date.'</td>

			                  
			               </tr>';


			}

			$html .='</tbody>
                <tfoot>
                '.$head.'
                </tfoot>
              </table>';

		}else{

			$html = '<h3>No subscribers to Display</h3>';
		}

		echo $html;
	}



		public function viewApprovedUsers(){
		global $database;

		$sql = "SELECT u.*, ct.name AS city_name, c.name AS country_name, s.name AS state_name FROM users u LEFT JOIN countries c ON (u.country_of_residence = c.id) LEFT JOIN states s ON (u.state_of_residence = s.id) LEFT JOIN cities ct ON (u.city_of_residence = ct.id) WHERE u.active = 1 AND u.approved = 1";

		$result = $database->query($sql);

		if($result->rowCount() > 0){

			$head = '<thead>
                <tr>

                  <th>Full Name</th>
                  <th>Email</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
                  <th style="width:25%;"></th>
                  
                </tr>
                </thead>';

			$html = '<table id="example1" class="table table-bordered table-striped">
                '.$head.'
                <tbody>
                ';

			while($data = $result->fetch(PDO::FETCH_ASSOC)){


				$html .= '<tr>
			                  <td>'.strtoupper($data['first_name']).' '.strtoupper($data['last_name']).'</td>

			                  <td>'.$data['email'].'</td>

			                  <td>'.$data['city_name'].'</td>

			                  <td>'.$data['state_name'].'</td>

			                  <td>'.$data['country_name'].'</td>

			                  <td>
			                  <button id="'.$data['id'].'" class="unapprove btn btn-warning">Cancel Approval</button>
			                  	  <a id="'.$data['id'].'" href="profile.php?id='.$data['id'].'" class="btn btn-info">User Details</a>
			                  </td>
			                  
			               </tr>';


			}

			$html .='</tbody>
                <tfoot>
                '.$head.'
                </tfoot>
              </table>';

		}else{

			$html = '<h3>No User to Display</h3>';
		}

		echo $html;
	}



	public function viewVerifiedUsers(){
		global $database;

		$sql = "SELECT u.*, c.name AS country_name, s.name AS state_name FROM users u LEFT JOIN countries c ON (u.country_of_residence = c.id) LEFT JOIN states s ON (u.state_of_residence = s.id) WHERE u.active = 1 AND u.approved = 1 AND u.verified = 1";

		$result = $database->query($sql);

		if($result->rowCount() > 0){

			$head = '<thead>
                <tr>

                  <th>Full Name</th>
                  <th>Email</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
                  <th style="width:25%;"></th>
                  
                </tr>
                </thead>';

			$html = '<table id="example1" class="table table-bordered table-striped">
                '.$head.'
                <tbody>
                ';

			while($data = $result->fetch(PDO::FETCH_ASSOC)){


				$html .= '<tr>
			                  <td>'.strtoupper($data['first_name']).' '.strtoupper($data['last_name']).'</td>

			                  <td>'.$data['email'].'</td>

			                  <td>'.$data['city_of_residence'].'</td>

			                  <td>'.$data['state_name'].'</td>

			                  <td>'.$data['country_name'].'</td>

			                  <td><button id="'.$data['id'].'" class="unverify btn btn-warning">Cancel Verification</button> &nbsp;
			                  <a id="'.$data['id'].'" href="profile.php?id='.$data['id'].'" class="btn btn-info">User Details</a></td>
			                  
			               </tr>';


			}

			$html .='</tbody>
                <tfoot>
                '.$head.'
                </tfoot>
              </table>';

		}else{

			$html = '<h3>No User to Display</h3>';
		}

		echo $html;
	}




	public function viewUnApprovedUsers(){
		global $database;

		$sql = "SELECT u.*, ct.name AS city_name, c.name AS country_name, s.name AS state_name FROM users u LEFT JOIN countries c ON (u.country_of_residence = c.id) LEFT JOIN states s ON (u.state_of_residence = s.id) LEFT JOIN cities ct ON (u.city_of_residence = ct.id) WHERE u.active = 1 AND u.approved = 0";

		$result = $database->query($sql);

		if($result->rowCount() > 0){

			$head = '<thead>
                <tr>

                  
                  <th>Full Name</th>
                  <th style="width:28%;">Email</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
                  <th style="width:25%;"></th>
                  
                </tr>
                </thead>';

			$html = '<table id="example1" class="table table-bordered table-striped">
                '.$head.'
                <tbody>
                ';

			while($data = $result->fetch(PDO::FETCH_ASSOC)){


				$html .= '<tr>
			                  <td>'.strtoupper($data['first_name']).' '.strtoupper($data['last_name']).'</td>

			                  <td>'.$data['email'].'</td>

			                  <td>'.$data['city_name'].'</td>

			                  <td>'.$data['state_name'].'</td>

			                  <td>'.$data['country_name'].'</td>

			                  <td>
			                  	<button id="'.$data['id'].'" class="approve btn btn-success">Approve User</button>
			                  	<a id="'.$data['id'].'" href="profile.php?id='.$data['id'].'" class="btn btn-info">User Details</a>
			                  </td>
			                  
			               </tr>';


			}

			$html .='</tbody>
                <tfoot>
                '.$head.'
                </tfoot>
              </table>';

		}else{

			$html = '<h3>No User to Display</h3>';
		}

		echo $html;
	}




	public function viewUnVerifiedUsers(){
		global $database;

		$sql = "SELECT u.*, c.name AS country_name, s.name AS state_name FROM users u LEFT JOIN countries c ON (u.country_of_residence = c.id) LEFT JOIN states s ON (u.state_of_residence = s.id) WHERE u.active = 1 AND u.approved = 1 AND u.verified = 0";

		$result = $database->query($sql);

		if($result->rowCount() > 0){

			$head = '<thead>
                <tr>

                  
                  <th>Full Name</th>
                  <th style="width:28%;">Email</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
                  <th style="width:25%;"></th>
                  
                </tr>
                </thead>';

			$html = '<table id="example1" class="table table-bordered table-striped">
                '.$head.'
                <tbody>
                ';

			while($data = $result->fetch(PDO::FETCH_ASSOC)){


				$html .= '<tr>
			                  <td>'.strtoupper($data['first_name']).' '.strtoupper($data['last_name']).'</td>

			                  <td>'.$data['email'].'</td>

			                  <td>'.$data['city_of_residence'].'</td>

			                  <td>'.$data['state_name'].'</td>

			                  <td>'.$data['country_name'].'</td>

			                  <td>
			                  	<button id="'.$data['id'].'" class="verify btn btn-success">Verify User</button>
			                  	<a id="'.$data['id'].'" href="profile.php?id='.$data['id'].'" class="btn btn-info">User Details</a>
			                  </td>
			                  
			               </tr>';


			}

			$html .='</tbody>
                <tfoot>
                '.$head.'
                </tfoot>
              </table>';

		}else{

			$html = '<h3>No User to Display</h3>';
		}

		echo $html;
	}



	public function viewPendingReviews(){

		global $database;


		$sql = "SELECT r.id, r.review, r.subject, r.date_created, u.first_name, u.last_name, r.active FROM reviews r, users u WHERE r.active = 0 AND r.user_id = u.id";

		$result = $database->query($sql);


		if($result->rowCount() > 0){

			$head = '<thead>
                <tr>

                  
                  <th style="width:20%;">Full Name</th>
                  <th style="width:40%;">Reviews</th>
                  <th>Date Created</th>
                  
                  
                  <th ></th>
                  
                </tr>
                </thead>';

			$html = '<table id="example1" class="table table-bordered table-striped">
                '.$head.'
                <tbody>
                ';

			while($data = $result->fetch(PDO::FETCH_ASSOC)){

				$date = date('F j, Y',$data['date_created']);


				$html .= '<tr>
			                  <td>'.strtoupper($data['first_name']).' '.strtoupper($data['last_name']).'</td>

			                 

			                  <td>'.$data['review'].'</td>

			                  <td>'.$date.'</td>

			                  
			                  <td>
			                  	<button id="'.$data['id'].'" class="approve btn btn-success">Approve Review</button> &nbsp;
			                  	<a id="'.$data['id'].'" href="review-details.php?id='.$data['id'].'" class="btn btn-info">Review Details</a>
			                  </td>
			                  
			               </tr>';


			}

			$html .='</tbody>
                <tfoot>
                '.$head.'
                </tfoot>
              </table>';

		}else{

			$html = '<h3>No Review to Display</h3>';
		}

		echo $html;


	}





	public function viewApprovedReviews(){

		global $database;


		$sql = "SELECT r.id, r.review, r.subject, r.date_created, u.first_name, u.last_name, r.active FROM reviews r, users u WHERE r.active = 1 AND r.user_id = u.id";

		$result = $database->query($sql);


		if($result->rowCount() > 0){

			$head = '<thead>
                <tr>

                  
                  <th style="width:20%;">Full Name</th>
                  <th style="width:40%;">Reviews</th>
                  <th>Date Created</th>
                  
                  
                  <th style="width:23%;"></th>
                  
                </tr>
                </thead>';

			$html = '<table id="example1" class="table table-bordered table-striped">
                '.$head.'
                <tbody>
                ';

			while($data = $result->fetch(PDO::FETCH_ASSOC)){

				$date = date('F j, Y',$data['date_created']);


				$html .= '<tr>
			                  <td>'.strtoupper($data['first_name']).' '.strtoupper($data['last_name']).'</td>

			                 

			                  <td>'.$data['review'].'</td>

			                  <td>'.$date.'</td>

			                  
			                  <td>
			                  	<button id="'.$data['id'].'" class="cancel btn btn-danger">Cancel Review</button> &nbsp;
			                  	<a id="'.$data['id'].'" href="review-details.php?id='.$data['id'].'" class="btn btn-info">Review Details</a>
			                  </td>
			                  
			               </tr>';


			}

			$html .='</tbody>
                <tfoot>
                '.$head.'
                </tfoot>
              </table>';

		}else{

			$html = '<h3>No Review to Display</h3>';
		}

		echo $html;


	}


	public function cancelReview($id){



			global $database;


			$sql = "UPDATE users SET active = 0 WHERE id =".$id;

			$result = $database->query($sql);

			if($result){
			$_SESSION['success'] = "Review Cancelled Successfully";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}
	}



	public function approveReview($id){



			global $database;


			$sql = "UPDATE reviews SET active = 1 WHERE id =".$id;

			$result = $database->query($sql);

			if($result){
			$_SESSION['success'] = "Review Approved Successfully";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}
	}








	}


?>