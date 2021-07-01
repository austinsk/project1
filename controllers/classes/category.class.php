<?php 


	class Category{

		public $services;


		public function addUserService(){


			global $database;
		 
		$service = clean($_POST['service']);
		$category = clean($_POST['category']);
		$description = clean($_POST['description']);

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
		$result->bindParam('user_id', $_SESSION['user_id'],PDO::PARAM_STR);
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




		public function latestView($id){


		$last_view = time();

		global $database;
		$sql = "UPDATE services SET last_view = :last_view WHERE id =:id";
		$result = $database->prepare($sql);
		$result->bindParam('last_view',$last_view,PDO::PARAM_INT);
		$result->bindParam('id',$id,PDO::PARAM_INT);
		$result->execute();

	}



	public function fetchAllServices(){

		global $database;

		$sql = "SELECT id, name FROM services WHERE active = 1 AND DELETED = 0 ORDER BY views_count DESC LIMIT 7";

		$this->services = $database->query($sql);
	}



		public function incrementViews($id){

		global $database;
		$sql = "UPDATE services SET views_count = views_count+1 WHERE id =:id";
		$result = $database->prepare($sql);
		$result->bindParam('id',$id,PDO::PARAM_INT);
		$result->execute();


		$sql5 = "SELECT c.service_id FROM services c WHERE c.id =".$id;
			$result5 = $database->query($sql5)->fetch(PDO::FETCH_ASSOC);

			$service_id = $result5['service_id'];

			if($result5){

				$sql6 = "UPDATE services SET views_count = views_count + 1 WHERE id = ".$service_id;
				$result6 = $database->query($sql6);

			}

	}













	}



?>