<?php
	require_once ('notification.class.php');
	require_once ('../lib/functions.php');

	class Review{


		public function addUserReview(){


			global $database;
			global $notification;

			$_SESSION['review']['review'] = $review = clean($_POST['review']);
			$type = clean($_POST['type']);
			$subject = clean($_POST['subject']);
			$service_id = clean($_POST['service_id']);
			$recipient_id = clean($_POST['recipient_id']);
			$rating = clean($_POST['rating']);


	
			if(empty($rating)){

				$_SESSION['error'] = "Please Give a Rating";
				go();


			}



			


			if(empty($review)){

				$_SESSION['error'] = "Please Give a Review";
				go();

			}

			$date_created = time();
			$active = 0;


			try{

			

				$database->beginTransaction();

			$sql = "INSERT INTO reviews (review, subject, type, user_id, recipient_id, service_id, date_created, rating, active) VALUES (:review, :subject, :type, :user_id, :recipient_id, :service_id, :date_created, :rating, :active)";

			$result = $database->prepare($sql);
			$result->bindParam('review',$review,PDO::PARAM_STR);
			$result->bindParam('type',$type,PDO::PARAM_STR);
			$result->bindParam('subject',$subject,PDO::PARAM_STR);
			$result->bindParam('user_id',$_SESSION['user_id'],PDO::PARAM_INT);
			$result->bindParam('recipient_id',$recipient_id,PDO::PARAM_INT);
			$result->bindParam('date_created',$date_created,PDO::PARAM_INT);
			$result->bindParam('rating',$rating,PDO::PARAM_INT);
			$result->bindParam('active',$active,PDO::PARAM_INT);
			$result->bindParam('service_id',$service_id,PDO::PARAM_INT);

			$result->execute();

			if($result->rowCount() > 0){


				$item_type = "New Review";

				$id = $database->lastInsertId();

					$status = $notification->addAdminNotification($_SESSION['user_id'], $item_type, $id);

					if($status){

						$database->commit();
						$_SESSION['success'] = "Reviewed Saved Successfully";
						unset($_SESSION['review']);
						go();

					}else{

						$database->rollBack();
						die('fggdr');
						$_SESSION['error'] = "An error Occured. Please try again";
						go();
					}

				

				
			}else{

				$_SESSION['error'] = "An error Occurred. Please Try Again";
				go();
			}




			}catch(PDOException $e){


					$database->rollBack();

					
					 die($e->getMessage());

					$_SESSION['error'] = 'An error occured. Please try again';
					go();
			
			}
			

			




		}




















	}




 ?>