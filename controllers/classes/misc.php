<?php 
		
		class Misc
		{
			

			public static function fetchStates($country_id)
			{
				global $database;
				$sql = "SELECT id, name FROM states WHERE countryId = :country_id";
				$result = $database->prepare($sql);
				$result->bindParam('country_id',$country_id,PDO::PARAM_INT);
				$result->execute();

				return $result;
			}

			public static function fetchCity($state_id)
			{
				global $database;
				$sql = "SELECT id, name FROM cities WHERE state_id = :state_id";
				$result = $database->prepare($sql);
				$result->bindParam('state_id',$state_id,PDO::PARAM_INT);
				$result->execute();

				return $result;
			}

			public static function fetchServices($category_id)
			{
				global $database;
				$sql = "SELECT id, name FROM services WHERE category_id = :category_id AND active = 1 AND deleted = 0";
				$result = $database->prepare($sql);
				$result->bindParam('category_id',$category_id,PDO::PARAM_INT);
				$result->execute();
				
				return $result;
			}


			public static function fetchCategories($service_id)
			{
				global $database;
				$sql = "SELECT id, name FROM categories WHERE service_id = :service_id AND active = 1 AND deleted = 0";
				$result = $database->prepare($sql);
				$result->bindParam('service_id',$service_id,PDO::PARAM_INT);
				$result->execute();
				
				return $result;
			}


			public function addSubscriber(){

				$email = $_POST['email'];

				if(empty($email)){

					error('Email field empty');
					go();

				}
				$date_created = time();
				global $database;

				$sql = "SELECT id FROM subscribers WHERE email = '$email'";

				$result = $database->query($sql);

				if($result->rowCount() > 0){

					success('You are Already Subcribed');
					go("");


				}else{

					$sql1 = "INSERT INTO subscribers (email, date_created) VALUES (:email, :date_created)";
					$result1 = $database->prepare($sql1);

					$result1->bindParam('email', $email,PDO::PARAM_STR);
					$result1->bindParam('date_created', $date_created,PDO::PARAM_STR);
					$result1->execute();

					if($result1->rowCount() > 0){

						success('Subcribed Successfully');
						go();

					}else{

						error('An error occured. please try Again');
						go();
					}

				}



			}

			
		}


?>
