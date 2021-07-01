<?php 

	
	class Company{


		public function updateCompanyImage($files){



			global $database;

			


			$sql1 = "SELECT id FROM companies WHERE user_id =".$_SESSION['user_id'];
			$result1 = $database->query($sql1);

			if($result1->rowCount() > 0){

				$data = $result1->fetch(PDO::FETCH_ASSOC);
				$company_id = $data['id'];

			}else{


				$_SESSION['error'] = "Please Setup Your Company Profile Details before adding Image";
				go();


			}



			if($files['file']['size'] > 0){

				



			$picture = new Photograph;

			$file_index = 'file';


		 $file = $picture->save($files["$file_index"],uniqid().'-'.time(),'../../uploads/company/');

					 if($file == false){
						 $_SESSION['error'] = "Invalid image file";
						redirect_to($_SERVER['HTTP_REFERER']);
					}

						$file1 = str_ireplace('../../','',$file);
						$file2 = str_ireplace('../../uploads/company/','../../uploads/company/thumb/',$file);

						$file3 = str_ireplace('../../uploads/company/thumb/','uploads/company/thumb/',$file2);
						
				 	$thumb1  = $file2;
				 	$ImageResize = new ImageResize($file);
				 	$ImageResize->resizeToWidth(460);
				 	$ImageResize->save($thumb1);
						
					
				 
		}else{
				
			$_SESSION['error'] = "Please select an image";
			redirect_to($_SERVER['HTTP_REFERER']);

		}

		$pic_set = 1;


		$sql = "UPDATE companies set path = :path, thumb = :thumb, pic_set = :pic_set  WHERE id = :id";
	 	$result = $database->prepare($sql);
	 	$result->bindParam('path',$file1,PDO::PARAM_STR);
	 	$result->bindParam('pic_set',$pic_set,PDO::PARAM_INT);
	 	$result->bindParam('thumb',$file3,PDO::PARAM_STR);
	 	$result->bindParam('id',$company_id,PDO::PARAM_INT);
	 	$result->execute();

	 	if($result){
	 		$_SESSION['success'] = "Company Picture Updated Successfully";
	 		go();
	 	}else{

	 		$_SESSION['error'] = "An error occured. Please Try Again";
	 		go();
	 	}
		}



		public function updateCompanyDetails(){

			global $database;




		$status = clean($_POST['status']);

		switch ($status) {
			case 'insert':
				$this->addCompany();
				go();
				break;
			

			case 'update':
				$this->updateCompany();
				go();
				break;
			
			
		}



		}



		public function addCompany($post){


			global $database;
			// echo json_encode(array('test'=>'abc'));
			// die('ddd');


		$company_name = clean($_POST['company_name']);
		$company_phone = clean($_POST['company_phone']);
		$company_address = clean($_POST['company_address']);
		$company_website = clean($_POST['company_website']);
		$company_years = clean($_POST['company_years']);
		// $company_country = clean($_POST['company_country']);
		// $company_state = clean($_POST['company_state']);
		// $company_city = clean($_POST['company_city']);
		$description = clean($_POST['description']);
		$location = clean($_POST['company_location']);
		$email = clean($_POST['email']);

		$lat = clean($_POST['lat']);
		$lng = clean($_POST['lng']);

		if(empty($company_name)){

			$_SESSION['error'] = "Please Enter your Company Name";
		    go();

		}

		if(empty($company_address)){

			$_SESSION['error'] = "Please Enter your Company Address";
		    go();

		}


		// if(empty($company_country)){

		// 	$_SESSION['error'] = "Please Enter your Company Country";
		//     go();

		// }
		
		$date_created = time();

		$active = 1;
		$deleted = 0;



		$sql = "INSERT INTO companies (user_id, name, phone_number, address, website, years_experience, active, deleted, date_created, email, description, location, lat, lng) VALUES (:user_id, :name, :phone_number, :address, :website, :years_experience, :active, :deleted, :date_created, :email, :description, :location, :lat, :lng)";

		$result = $database->prepare($sql);
		$result->bindParam('user_id', $_SESSION['user_id'],PDO::PARAM_INT);
		
		// $result->bindParam('country', $company_country,PDO::PARAM_INT);
		$result->bindParam('address', $company_address,PDO::PARAM_STR);
		$result->bindParam('name', $company_name,PDO::PARAM_STR);
		$result->bindParam('location', $location,PDO::PARAM_STR);
		// $result->bindParam('city', $company_city,PDO::PARAM_STR);
		$result->bindParam('description', $description,PDO::PARAM_STR);
		$result->bindParam('email', $email,PDO::PARAM_STR);
		$result->bindParam('years_experience', $company_years,PDO::PARAM_INT);
		// $result->bindParam('state', $company_state,PDO::PARAM_INT);
		$result->bindParam('website', $company_website,PDO::PARAM_STR);
		$result->bindParam('phone_number', $company_phone,PDO::PARAM_STR);
		
		$result->bindParam('active', $active,PDO::PARAM_INT);
		$result->bindParam('deleted', $deleted,PDO::PARAM_INT);

		$result->bindParam('lat', $lat,PDO::PARAM_INT);
		$result->bindParam('lng', $lng,PDO::PARAM_INT);
		
		$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
		$result->execute();

		if($result->rowCount() > 0){
			$_SESSION['success'] = "Company added Successfully";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}





			
		}





		public function updateCompany(){


			global $database;


			
		$company_name = clean($_POST['company_name']);
		$company_phone = clean($_POST['company_phone']);
		$company_address = clean($_POST['company_address']);
		$company_website = clean($_POST['company_website']);
		$company_years = clean($_POST['company_years']);
		// $company_country = clean($_POST['company_country']);
		// $company_state = clean($_POST['company_state']);
		// $company_city = clean($_POST['company_city']);
		$description = clean($_POST['description']);
		$location = clean($_POST['company_location']);
		$email = clean($_POST['email']);

		$lat = clean($_POST['lat']);
		$lng = clean($_POST['lng']);

		

		if(empty($company_name)){

			$_SESSION['error'] = "Please Enter your Company Name";
		    go();

		}

		if(empty($company_address)){

			$_SESSION['error'] = "Please Enter your Company Address";
		    go();

		}



		


		// if(empty($company_country)){

		// 	$_SESSION['error'] = "Please Enter your Company Country";
		//     go();

		// }
		
		$date_created = time();

		$active = 1;
		$deleted = 0;



		$sql = "UPDATE companies SET country = :country, address = :address, name = :name, city = :city, years_experience = :years_experience, state = :state, website = :website, phone_number = :phone_number, description = :description, email = :email, location = :location, lng = :lng, lat = :lat WHERE user_id =:id";

		$result = $database->prepare($sql);
		
		$result->bindParam('id', $_SESSION['user_id'],PDO::PARAM_INT);
		$result->bindParam('country', $company_country,PDO::PARAM_INT);
		$result->bindParam('address', $company_address,PDO::PARAM_STR);
		$result->bindParam('name', $company_name,PDO::PARAM_STR);
		$result->bindParam('city', $company_city,PDO::PARAM_STR);
		$result->bindParam('email', $email,PDO::PARAM_STR);
		$result->bindParam('description', $description,PDO::PARAM_STR);
		$result->bindParam('years_experience', $company_years,PDO::PARAM_INT);
		$result->bindParam('state', $company_state,PDO::PARAM_INT);
		$result->bindParam('website', $company_website,PDO::PARAM_STR);
		$result->bindParam('phone_number', $company_phone,PDO::PARAM_STR);
		
		$result->bindParam('lat', $lat,PDO::PARAM_STR);
		$result->bindParam('lng', $lng,PDO::PARAM_STR);
		
		$result->bindParam('location', $location,PDO::PARAM_STR);
		$result->execute();

		if($result->rowCount() > 0){
			$_SESSION['success'] = "Company updated Successfully";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}





			
		}








		public function addCompanyService($files){

			$picture = new Photograph;

			global $database;

			$sql1 = "SELECT id FROM companies WHERE user_id =".$_SESSION['user_id'];
			$result1 = $database->query($sql1);

			if($result1->rowCount() > 0){

				$data = $result1->fetch(PDO::FETCH_ASSOC);
				$company_id = $data['id'];

			}else{


				$_SESSION['error'] = "Please Setup Your Company Profile before adding Services";
				go();


			}



		$service = clean($_POST['service']);
		$category = clean($_POST['category']);
		$description = clean($_POST['description']);
		$date_created= time();
		$active = 1;
		$deleted = 0;

		if(empty($service)){

			$_SESSION['error'] = "Please Enter a Service Name";
		    go();

		}

		if(empty($category)){

			$_SESSION['error'] = "Please Enter a Category Address";
		    go();

		}


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




			$sql = "INSERT INTO company_services (company_id, user_id, category_id, service_id, description, date_created,path1,path2,path3,active, deleted) VALUES (:company_id, :user_id, :category_id, :service_id, :description, :date_created,:path1,:path2,:path3, :active, :deleted)";

					$result = $database->prepare($sql);
					$result->bindParam('user_id', $_SESSION['user_id'],PDO::PARAM_INT);
					$result->bindParam('category_id', $category,PDO::PARAM_INT);
					$result->bindParam('company_id', $company_id,PDO::PARAM_INT);
					$result->bindParam('service_id', $service,PDO::PARAM_STR);
					$result->bindParam('description', $description,PDO::PARAM_STR);
					$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
					// $result->bindParam('type', $type,PDO::PARAM_STR);

					$result->bindParam('active', $active,PDO::PARAM_INT);
					$result->bindParam('deleted', $deleted,PDO::PARAM_INT);

					$result->bindParam('path1', $photo1,PDO::PARAM_STR);
					$result->bindParam('path2', $photo2,PDO::PARAM_STR);
					$result->bindParam('path3', $photo3,PDO::PARAM_STR);
					$result->execute();



		// $sql = "INSERT INTO company_services (user_id, category_id, service_id, description, company_id,  active, deleted, date_created) VALUES (:user_id, :category_id, :service_id, :description, :company_id, :active, :deleted, :date_created)";

		// $result = $database->prepare($sql);
		// $result->bindParam('user_id', $_SESSION['user_id'],PDO::PARAM_INT);
		
		// $result->bindParam('category_id', $category,PDO::PARAM_INT);
		// $result->bindParam('service_id', $service,PDO::PARAM_INT);
		// $result->bindParam('company_id', $company_id,PDO::PARAM_INT);
		// $result->bindParam('description', $description,PDO::PARAM_INT);
		// $result->bindParam('date_created', $date_created,PDO::PARAM_INT);
		// $result->bindParam('active', $active,PDO::PARAM_INT);
		// $result->bindParam('deleted', $deleted,PDO::PARAM_INT);
		
		// $result->execute();

		if($result->rowCount() > 0){

			$_SESSION['success'] = "Service Added Successfully";
			go();
		}else{

			$_SESSION['error'] = "An error Occurred. Please Try again";
			go();
		}




			
		}













	}





?>