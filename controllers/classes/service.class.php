<?php

	class Service{

		public $services;
		public $categories;
		public $service_id;
		public $count;
		public $total_individual_services;
		public $individual_services;
		public $total_company_services;
		public $company_services;


		public function addUserServiceLocation(){


			global $database;
		 
		$work_lat = clean($_POST['lat']);
		$work_lng = clean($_POST['lng']);
		$work_address2 = clean($_POST['formatted_address']);
		$work_address = clean($_POST['address']);
		$user_id = $_SESSION['user_id'];


		$sql = "UPDATE users SET work_lat = :work_lat, work_lng = :work_lng, work_address2 = :work_address2, work_address = :work_address WHERE id =".$user_id;
		

			$result = $database->prepare($sql);
			$result->bindParam('work_lng', $work_lng,PDO::PARAM_INT);
			$result->bindParam('work_lat', $work_lat,PDO::PARAM_INT);
			$result->bindParam('work_address', $work_address,PDO::PARAM_STR);
			$result->bindParam('work_address2', $work_address2,PDO::PARAM_STR);
			
			$result->execute();


	

		if($result->rowCount() > 0){
			$_SESSION['success'] = "Service added Successfully";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}




	}


		public function addUserService($files){

			$picture = new Photograph;

			global $database;
		 
		$service = clean($_POST['service']);
		$category = clean($_POST['category']);
		$description = clean($_POST['description']);
		$user_id = $_SESSION['user_id'];
		$type = 'individual';


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

		if(isset($files['photo1']) && $files['photo1']['size'] > 0){

	

			$file_index = 'photo1';


		    $file1 = $picture->save($files["$file_index"],uniqid().'-'.time(),'../../uploads/services/');

					 if($file1 == false){
						 
							 echo json_encode(array('status'=>'error'));
							die();
					}

		

						$photo1 = str_ireplace('../../','',$file1);
						
					
				 
		}else{
			$photo1 = '';
		}


			if(isset($files['photo2']) && $files['photo2']['size'] > 0){

	


			$file_index = 'photo2';


		 $file2 = $picture->save($files["$file_index"],uniqid().'-'.time(),'../../uploads/services/');

					 if($file2 == false){
						 
							 echo json_encode(array('status'=>'error'));
							die();
					}

		

						$photo2 = str_ireplace('../../','',$file2);
						
				 
					
				 
		}else{
			$photo2 = '';
		}


		if(isset($files['photo3']) && $files['photo3']['size'] > 0){


			$file_index = 'photo3';


		 $file3 = $picture->save($files["$file_index"],uniqid().'-'.time(),'../../uploads/services/');

					 if($file3 == false){
						 
							 echo json_encode(array('status'=>'error'));
							die();
					}

		

						$photo3 = str_ireplace('../../','',$file3);
						
					
				 
		}else{
			$photo3 = '';
		}




			$sql = "INSERT INTO handyman_services (user_id, category_id, service_id, description, type, date_created,path1,path2,path3) VALUES (:user_id, :category_id, :service_id, :description, :type, :date_created,:path1,:path2,:path3)";

					$result = $database->prepare($sql);
					$result->bindParam('user_id', $user_id,PDO::PARAM_INT);
					$result->bindParam('category_id', $category,PDO::PARAM_INT);
					$result->bindParam('service_id', $service,PDO::PARAM_STR);
					$result->bindParam('description', $description,PDO::PARAM_STR);
					$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
					$result->bindParam('type', $type,PDO::PARAM_STR);
					$result->bindParam('path1', $photo1,PDO::PARAM_STR);
					$result->bindParam('path2', $photo2,PDO::PARAM_STR);
					$result->bindParam('path3', $photo3,PDO::PARAM_STR);
					$result->execute();


	

		if($result->rowCount() > 0){
			$_SESSION['success'] = "Service added Successfully";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}



		}



		public function addCount($id){

			global $database;

			$sql = "UPDATE categories SET views_count = views_count + 1 WHERE id =".$id;
			$result = $database->query($sql);


			$sql5 = "SELECT c.service_id FROM categories c WHERE c.id =".$id;
			$result5 = $database->query($sql5)->fetch(PDO::FETCH_ASSOC);

			$service_id = $result5['service_id'];

			if($result5){

				$sql6 = "UPDATE services SET views_count = views_count + 1 WHERE id = ".$service_id;
				$result6 = $database->query($sql6);

			}




		}



		




	public function fetchAllIndividualDetails($id){			

			global $database;

			$sql1 = "SELECT 
			  hs.id AS handy_id, 
			  hs.description, 
			  hs.date_created,
			  hs.path3,
			  hs.path2,
			  hs.path1,  
			  u.pic_set, 
			  u.first_name,
			  u.last_name,
			  u.phone1,
			  u.phone2, 
			  u.email,
			  u.profile_picture,
			  u.thumb,
			  u.id,
			  u.lat,
			  u.lng,
			  u.city_of_residence,
			  u.address2,
			  u.work_address,
			  u.work_address2
			 
			 FROM users u , handyman_services hs  WHERE u.id = hs.user_id AND  u.approved = 1 AND hs.service_id = ".$id;


			     $this->total_individual_services = $database->query($sql1);




			 }


			 public function fetchAllCompanyDetails($id){

			global $database;

			$sql = "SELECT 
					 c.lat AS latitude,
					 c.lng AS longitude,
					 u.first_name,
					 u.last_name,
					 cs.id AS company_service_id,
					 cs.company_id,
					 cs.description,
					 cs.date_created,
					 c.name,
					 c.user_id,
					  c.phone_number,
					 c.path,
					 c.thumb,
					 c.address,
					 c.website,
					 c.years_experience,
					 cs.path1,
					 cs.path2,
					 cs.path3,					
					 c.pic_set,
					 c.location,
					 c.country
					 
					 FROM company_services cs,
					  companies c  LEFT JOIN users u ON (c.user_id = u.id)  WHERE  c.active = 1 AND c.verified = 1 AND c.deleted = 0 AND cs.active = 1 AND cs.deleted = 0 AND cs.company_id = c.id AND cs.service_id = $id ";


			$this->total_company_services = $database->query($sql);


		}








		public function displayIndividualDetails($id, $limit, $page){

			$offset = ($page-1) * $limit;

			global $database;

			$sql1 = "SELECT 
			  hs.id AS handy_id, 
			  hs.description, 
			  hs.date_created,
			  hs.path3,
			  hs.path2,
			  hs.path1,  
			  u.pic_set, 
			  u.first_name,
			  u.last_name,
			  u.phone1,
			  u.phone2, 
			  u.email,
			  u.profile_picture,
			  u.thumb,
			  u.id,
			  u.lat,
			  u.lng,
			  u.city_of_residence,
			  u.address2,
			  u.work_address,
			  u.work_address2
			 
			 FROM users u , handyman_services hs  WHERE u.id = hs.user_id AND  u.approved = 1 AND hs.service_id = ".$id." LIMIT $limit OFFSET $offset";


			     $this->individual_services = $database->query($sql1);

			


			
			if($this->individual_services->rowCount() > 0){


											$individual = '';

											while($data = $this->individual_services->fetch(PDO::FETCH_ASSOC)){

												$rating = '';

												if($data['pic_set'] == 0){

													$individual_image = 'assets/images/avatar2.jpg';

												}else{

													$individual_image = $data['thumb'];
												}

												

												// if($data['user_rating'] > 0){


												// 	$rating .= '<div><div class="rating rating-'. ceil($data['user_rating']).' size-15  width-100"><!-- rating-0 ... rating-5 --></div></div>';

												// }else{

												// 	$rating .= '';
												// }

												

												$individual .= '<!-- SEARCH RESULTS -->
							
											<div class="clearfix search-result"><!-- item -->
												<h4 class="margin-bottom-0"><a href="individual-details?id='.$data['id'].'&h_id='.$data['handy_id'].'">'.ucwords($data['first_name']).' '.ucwords($data['last_name']).'</a></h4>
												<small class="text-muted">'.$data['work_address2'].'</small>
												<img src="'.$individual_image.'" alt="dgd" height="60" />
												<p> '.$data['work_address2'].'</p>
												<p> '.$data['work_address'].'</p>
												<a href="individual-details?id='.$data['id'].'&h_id='.$data['handy_id'].'" class="text-warning fsize12">View Individual Details</a>


													'.$rating.'
													
											</div><!-- /item -->

											<!-- /SEARCH RESULTS -->';
												
											}


											



										}else{
											$individual = '<h3>No Individual to Display</h3>';

											
										}

										return $individual;


		}




		public function displayCompanyDetails($id, $limit, $page){

			$offset = ($page-1) * $limit;

			global $database;

			$sql = "SELECT 
					 c.lat AS latitude,
					 c.lng AS longitude,
					 u.first_name,
					 u.last_name,
					 cs.id AS company_service_id,
					 cs.company_id,
					 cs.description,
					 cs.date_created,
					 c.name,
					 c.user_id,
					  c.phone_number,
					 c.path,
					 c.thumb,
					 c.address,
					 c.website,
					 c.years_experience,
					 cs.path1,
					 cs.path2,
					 cs.path3,					
					 c.pic_set,
					 c.location,
					 c.country
					 
					 FROM company_services cs,
					  companies c  LEFT JOIN users u ON (c.user_id = u.id)  WHERE  c.active = 1 AND c.verified = 1 AND c.deleted = 0 AND cs.active = 1 AND cs.deleted = 0 AND cs.company_id = c.id AND cs.service_id = ".$id." LIMIT $limit OFFSET $offset";


			$this->company_services = $database->query($sql);


			if($this->company_services->rowCount()){


											$company = '';

											while($data1 = $this->company_services->fetch(PDO::FETCH_ASSOC)){


												if($data1['pic_set'] == 1){

													$image = $data1['path'];
												}else{
													$image = 'assets/images/noimage.jpg';
												}

												

												$company .= '<!-- SEARCH RESULTS -->
							

												<div class="clearfix search-result"><!-- item -->
													<h4 class="margin-bottom-0"><a href="company-details.php?id='.$data1['company_id'].'">'.$data1['name'].' </a></h4>
													<small class="text-muted">'.$data1['address'].'</small>

													<img src="'.$image.'" alt="" height="60" />
													<p>'.$data1['location'].' </p>
													<a href="company-details.php?id='.$data1['company_id'].'&h_id='.$data1['company_service_id'].'" class="text-warning fsize12">View Company Details</a>
												</div><!-- /item -->

							
							
												<!-- /SEARCH RESULTS -->';

											}


											



										}else{

											$company = '<h3>No Company to Display</h3>';
										}

										return $company;
		}






		public function incrementViews($id){

		global $database;
		$sql = "UPDATE services SET views_count = views_count+1 WHERE id =:id";
		$result = $database->prepare($sql);
		$result->bindParam('id',$id,PDO::PARAM_INT);
		$result->execute();


		$sql5 = "SELECT c.category_id FROM services c WHERE c.id =".$id;
			$result5 = $database->query($sql5)->fetch(PDO::FETCH_ASSOC);

			$category_id = $result5['category_id'];

			if($result5){

				$sql6 = "UPDATE categories SET views_count = views_count + 1 WHERE id = ".$category_id;
				$result6 = $database->query($sql6);

			}

	}




		public function latestView($id){


		$last_view = time();

		global $database;
		$sql = "UPDATE services SET last_view = :last_view WHERE id =:id";
		$result = $database->prepare($sql);
		$result->bindParam('last_view',$last_view,PDO::PARAM_INT);
		$result->bindParam('id',$id,PDO::PARAM_INT);
		$result->execute();

	}


		public function fetchSearchCategories($q,$type){
		global $database;
		switch($type){
			case 'service';
			$sql = "SELECT id, name, path, thumb, description FROM services WHERE active = 1 AND deleted = 0 AND name LIKE :q";
			$result = $database->prepare($sql);
			$result->bindValue('q',"%$q%",PDO::PARAM_STR);
			$result->execute();

			$this->count = $result->rowCount();

			$this->services = $result; 
			break;

					
		
		case 'category';
			$sql = "SELECT id, name, path, thumb FROM services WHERE active = 1 AND deleted = 0 AND name LIKE :q";
			$this->service_id = $database->prepare($sql);
			$this->service_id->bindValue('q',"%$q%",PDO::PARAM_STR);
			$this->service_id->execute(); 
			break;
			
			}
		
		
		}






	}














 ?>