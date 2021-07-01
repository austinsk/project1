<?php 

	class Profile
	{
		public $country;
		public $profile;



		public function displayUserServices($id){



			global $database;

			$sql = "SELECT hs.id, s.name AS service_name, s.date_created, s.active, c.name AS category_name FROM categories c, services s, handyman_services hs WHERE s.deleted = 0 AND s.category_id = c.id AND  hs.service_id = s.id AND hs.category_id = c.id AND hs.user_id = ".$id;  


			// $sql = "SELECT s.id,  s.name AS service_name, s.date_created, s.active, c.name AS category_name FROM categories c, services s WHERE s.deleted = 0 AND s.category_id = c.id";

			// $sql = "SELECT id, name AS category_name, description, date_created, active FROM services WHERE deleted = 0";
			$result = $database->query($sql);
			


			if($result->rowCount() > 0 ){


				$head = '<thead>
                <tr>

                  <th>Service Name</th>
                  
                  <th>Category Name</th>
                 
                  <th>Date Created</th>
                  
                  <th style="width:20%;"></th>
                  
                </tr>
                </thead>';

			$html = '<table id="example1" class="table table-bordered table-striped">
                '.$head.'
                <tbody>
                ';

				while($data = $result->fetch(PDO::FETCH_ASSOC)){


					$date = date("F j, Y", $data['date_created']);


				$html .= '<tr>
			                  <td>'.strtoupper($data['service_name']).'</td>

								
								<td>'.strtoupper($data['category_name']).'</td>			                  

			                 

			                  

			                  <td>'.$date.'</td>

			                  <td>';

			                


			              $html .=' &nbsp; <button id="'.$data['id'].'" class="delete btn btn-danger btn-sm">Delete</button> </tr>';


				}


				$html .='</tbody>
                <tfoot>
                '.$head.'
                </tfoot>
              </table>';

			}else{
				$html = '<h3>No Service to Display</h3>';
			}

			echo $html;
		}





		public function fetchCountry(){
			global $database;
			$sql = "SELECT id, name FROM countries";
			$this->country = $database->query($sql);

		}

		
				

		public function fetchProfile($id){
			global $database;
			$sql = "SELECT id, first_name, email, bio, last_name, phone1, phone2, address, city_of_residence, state_of_residence, country_of_residence, nationality, profile_picture, thumb, pic_set, verified, active FROM users WHERE id = ".$id;
				$result = $database->query($sql);

			$this->profile = $result->fetch(PDO::FETCH_OBJ);
			
		}

		public function fetchProfile2(){
			global $database;
			$sql = "SELECT first_name, last_name, profile_picture FROM users WHERE id = ".$_SESSION['user_id'];
				$result = $database->query($sql);

			$this->profile = $result->fetch(PDO::FETCH_OBJ);
			
		}


		public function updateProfile($post, $files){
			global $database;
			$type = $post['type'];
			switch ($type) {
				case 'personal':
					$this->updatePersonalDetails($post);
					break;

				case 'contact':
					$this->updateContactDetails($post);
					break;

				case 'password':
					$this->updatePassword($post);
					break;

				case 'photo':
					$this->changeProfilePicture($files);
					break;

				
			}
			


		}	



		
		public function removeProfilePicture($id){


			global $database;

			$sql = "UPDATE users SET pic_set = 0 WHERE id =".$id;

			$result = $database->query($sql);

			if($result){
						$_SESSION['success'] = "Profile Picture Removed Successfully";
				}else{
						$_SESSION['error'] = "An error Occured. Please try again";
				}
				go();
		}


		public function updatePersonalDetails($post){
			global $database;
			$first_name = ucwords(clean($post['first_name']));
			$last_name = ucwords(clean($post['last_name']));
			$user_id = clean($post['user_id']);
			$bio = clean($post['bio']);
			



			if(empty($first_name)){
				$_SESSION['error'] = "Firstname is Required";
				go();
			}

			if(empty($last_name)){
				$_SESSION['error'] = "Lastname is Required";
				go();
			}

			// if(empty($nationality)){
			// 	 $_SESSION['error'] = "Please select your Nationality";
			// 	go();
			// }

			//if(!empty($nationality && $first_name && $last_name)){
			//	echo $_SESSION['personal_success'] = "Details Updated Succesfully";
			//	go();
		//	}



			$sql = "UPDATE users SET first_name = :first_name, last_name = :last_name, bio = :bio WHERE id = :id";
						

						$result = $database->prepare($sql);
						$result->bindParam('first_name',$first_name,PDO::PARAM_STR);
						$result->bindParam('last_name',$last_name,PDO::PARAM_STR);
						$result->bindParam('bio',$bio,PDO::PARAM_STR);
						// $result->bindParam('nationality',$nationality,PDO::PARAM_INT);
						
						$result->bindParam('id',$user_id,PDO::PARAM_INT);
						$result->execute();
						if($result){
								$_SESSION['success'] = "Personal Details Updated Successfully";
						}else{
								$_SESSION['error'] = "An error Occured. Please try again";
						}
						go();


		}	




		public function updateContactDetails($post){
			global $database;
			$phone1 = clean($post['phone1']);
			$phone2 = clean($post['phone2']);
			$city_of_residence = clean($post['city_of_residence']);
			$work_lng = clean($post['lng']);
			$work_lat = clean($post['lat']);
			$work_address2 = clean($post['formatted_address']);
		    $address = clean($post['address']);

		    $user_id = clean($post['user_id']);

			if(empty($phone1)){
				 $_SESSION['error'] = "Primary phone number Required";
				go();
			}

			if(empty($city_of_residence)){
				 $_SESSION['error'] = "City of residence Required";
				go();
			}

			

			// if(empty($address)){
			// 	 $_SESSION['error'] = "Home address Required";
			// 	go();
			// }

			



			$sql = "UPDATE users SET phone1 = :phone1, phone2 = :phone2, city_of_residence = :city_of_residence, work_address2 = :work_address2, work_lat = :work_lat, work_lng = :work_lng, address =:address  
					WHERE id = :id";
						

						$result = $database->prepare($sql);
						$result->bindParam('phone1',$phone1,PDO::PARAM_STR);
						$result->bindParam('phone2',$phone2,PDO::PARAM_STR);
						$result->bindParam('city_of_residence',$city_of_residence,PDO::PARAM_STR);
						$result->bindParam('work_address2',$work_address2,PDO::PARAM_STR);
						$result->bindParam('work_lat',$work_lat,PDO::PARAM_STR);
						$result->bindParam('work_lng',$work_lng,PDO::PARAM_STR);
						$result->bindParam('address',$address,PDO::PARAM_STR);
						$result->bindParam('id',$user_id,PDO::PARAM_INT);
						$result->execute();
						if($result){
								$_SESSION['success'] = "Successfully Updated Contact Details";
								go();

						}else{
							$_SESSION['error'] = "An Error Occured. Please try Again";
							go();
						}
		}	


		public function updatePassword($post){

			global $database;
			$current_password = clean($post['current_password']);
			$retype_password = clean($post['retype_password']);
			$new_password = clean($post['new_password']);
			$user_id = clean($post['user_id']);

			if (empty($current_password)) {
				$_SESSION['error'] = "Please enter your current password";
			}

			if (empty($retype_password) || empty($new_password)) {
				$_SESSION['error'] = "Please enter a password";
			}

			if ($retype_password != $new_password) {
				$_SESSION['error'] = "Passwords do not Match!";
				go();
			}

			if (strlen($new_password) < 6) {
				$_SESSION['error'] = "Passwords must be atleast 6 characters";
				go();
			}


			$sql = "SELECT password FROM users WHERE id = :id";
					$result = $database->prepare($sql);
					$result->bindParam('id',$_SESSION['user_id'],PDO::PARAM_INT);
					$result->execute();
					$data = $result->fetch(PDO::FETCH_OBJ);

					
					if(password_verify($current_password,$data->password)){
						$hash_cost_factor = (defined('HASH_COST_FACTOR') ? HASH_COST_FACTOR : null);
		  $user_password_hash = password_hash($new_password, PASSWORD_DEFAULT, array('cost' => $hash_cost_factor));
						

						$sql = "UPDATE users set password = :new_password WHERE id = :id";
						$result = $database->prepare($sql);
						$result->bindParam('new_password',$user_password_hash,PDO::PARAM_STR); 
						$result->bindParam('id',$user_id,PDO::PARAM_INT);
						$result->execute();

						if($result){
								$_SESSION['success'] = "Password Successfully Updated";
								
						}else{
							$_SESSION['error'] = "An Error Occured. Please try Again";
						}
							go();

					}else{
						$_SESSION['error'] = "Your Old password is incorrect";
						go();
					}
			}





	public function changeProfilePicture($files){

			global $database;

			$user_id = $_POST['user_id'];
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
					
				 
		}else{

			$_SESSION['error'] = "Pls select an image";
			redirect_to($_SERVER['HTTP_REFERER']);

		}

		$pic_set = 1;


		$sql = "UPDATE users set profile_picture = :profile_picture, thumb = :thumb, pic_set = :pic_set  WHERE id = :id";
	 	$result = $database->prepare($sql);
	 	$result->bindParam('profile_picture',$file1,PDO::PARAM_STR);
	 	$result->bindParam('pic_set',$pic_set,PDO::PARAM_INT);
	 	$result->bindParam('thumb',$file3,PDO::PARAM_STR);
	 	$result->bindParam('id',$user_id,PDO::PARAM_INT);
	 	$result->execute();

	 	if($result){
	 		$_SESSION['success'] = "Profile Picture Updated Successfully";
	 		go();
	 	}else{

	 		$_SESSION['error'] = "An error occured. Please Try Again";
	 		go();
	 	}

	}






			public function updateProfilePic(){
				global $database;
				$Picture = new Picture;
				$pic_size = $_FILES['picture']['size'];
				die('dfd');


				 $status = $Picture->save($_FILES['picture'],time().$_SESSION['user_id'],'../../uploads/profile/');
				//../../uploads/profile/149259699510.jpg
				 if($status == false){
				 	$collect = array('status' => 'error', 'text' => $_SESSION['error']);
				 	echo json_encode($collect);
				 }else{
				 	$pic_name = str_replace("../../uploads/profile/",'',$status);
					 	
					 	if($pic_size > 1024){
						 	$ImageResize = new ImageResize($status);
						 	$ImageResize->resizeToHeight(373);
						 	$ImageResize->save($status);
					 	}

				 	$sql = "UPDATE users set profile_picture = :profile_picture WHERE id = :id";
				 	$result = $database->prepare($sql);
				 	$result->bindParam('profile_picture',$pic_name,PDO::PARAM_STR);
				 	$result->bindParam('id',$_SESSION['user_id'],PDO::PARAM_INT);
				 	$result->execute();

				 	if($result->rowCount() > 0){
				 		//unlink or delete picture
							 		$old_pic = $_POST['old_pic'];
							 		if(!empty($old_pic) ){							 	
							 			$pic_path = "../../uploads/profile/$old_pic";//use double quotes not single
							 			if(file_exists($pic_path)){
							 			unlink($pic_path);
							 		}
							 	}
							 unset($_FILES);		
							$collect = array('status' => 'success', 'text' => "$pic_name");
				 			echo json_encode($collect);
				 			die;

				 		}else{
				 			 unset($_FILES);
					 		unlink($status);
					 		$collect = array('status' => 'error', 'text' => 'An Error Occured. Try Again!');
					 		echo json_encode($collect);
					 		die;
				 	}


				 }

				unset($_SESSION['error']);
			}
}
