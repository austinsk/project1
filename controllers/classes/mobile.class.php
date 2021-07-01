<?php 
	
	require_once ('notification.class.php');
	// require_once 'init.php';


	class Mobile{



		public function deleteMyReview($post){

			global $database;
			
			
			$review_id = clean($post['review_id']);

			$sql = "DELETE FROM reviews WHERE id = :review_id";
				$result1 = $database->prepare($sql);
				$result1->bindParam('review_id', $review_id,PDO::PARAM_INT);
				
				$result1->execute();

				if($result1){

					echo json_encode(array('status'=>'success'));
					die();

				}else{

					echo json_encode(array('status'=>'error'));
					die();
				}



		}


		

		public function deleteMyService($type, $post){

			global $database;
			$picture = new Photograph;

			switch ($type) {
				case 'individual':
					$table = 'handyman_services';
					break;


				case 'company':
					$table = 'company_services';
					break;
				
				
			}

			$user_id = clean($post['user_id']);
			// $category_id = clean($post['category_id']);
			$service_id = clean($post['service_id']);

			$sql = "DELETE FROM $table WHERE user_id = :user_id AND service_id = :service_id";
				$result1 = $database->prepare($sql);
				$result1->bindParam('user_id', $user_id,PDO::PARAM_INT);
				$result1->bindParam('service_id', $service_id,PDO::PARAM_INT);

				$result1->execute();

				if($result1){

					echo json_encode(array('status'=>'success'));
					die();

				}else{

					echo json_encode(array('status'=>'error'));
					die();
				}



		}


		public function addIndividualServicePicture($type, $post, $files){

			global $database;
			$picture = new Photograph;

			switch ($type) {
				case 'individual':
					$table = 'handyman_services';
					break;


				case 'company':
					$table = 'company_services';
					break;
				
				
			}

			// echo json_encode(array('test'=>$post, 'keys'=>$files));
			// die;

			$user_id = clean($post['id']);
			// $category_id = clean($post['category_id']);
			$service_id = clean($post['service_id']);

			$path = clean($post['path']);


			if(isset($files["$path"]) && $files["$path"]['size'] > 0){


		    $file1 = $picture->save($files["$path"],uniqid().'-'.time(),'../../uploads/services/');

					 if($file1 == false){
						 
							 echo json_encode(array('status'=>'error'));
							die();
					}

		

						$photo1 = str_ireplace('../../','',$file1);
					
				 
			}else{
				echo json_encode(array('status'=>'error1'));
				die();
			}




			$sql1 = "UPDATE $table SET $path = :path WHERE user_id = :user_id AND service_id = :service_id";
				$result1 = $database->prepare($sql1);
				$result1->bindParam('path', $photo1,PDO::PARAM_STR);
				$result1->bindParam('user_id', $user_id,PDO::PARAM_INT);
				$result1->bindParam('service_id', $service_id,PDO::PARAM_INT);

				$result1->execute();

				if($result1){

					

						echo json_encode(array('status'=>'success','data'=>$photo1));
						die;



					}else{

						echo json_encode(array('status'=>'error2'));
						die;
					}



		}



		public function deleteIndividualServicePicture($type, $post){

			global $database;

			switch ($type) {
				case 'individual':
					$table = 'handyman_services';
					break;


				case 'company':
					$table = 'company_services';
					break;
				
				
			}

			$user_id = clean($post['id']);
			// $category_id = clean($post['category_id']);
			$service_id = clean($post['service_id']);

			$path = clean($post['path']);

			// echo json_encode(array('test'=>'ereer'));
			// die;
			

			$sql = "SELECT $path  FROM $table WHERE user_id = :user_id AND service_id = :service_id";

			$result = $database->prepare($sql);
			$result->bindParam('user_id', $user_id,PDO::PARAM_INT);
			$result->bindParam('service_id', $service_id,PDO::PARAM_INT);

			$result->execute();
			

			if($result->rowCount() > 0){


				$data = $result->fetch(PDO::FETCH_ASSOC);

				$pic_path = $data[$path];


				unlink('../../'.$pic_path);

				$empty = '';

				$sql1 = "UPDATE $table SET $path = :path WHERE user_id = :user_id AND service_id = :service_id";
				$result1 = $database->prepare($sql1);
				$result1->bindParam('path', $empty,PDO::PARAM_STR);
				$result1->bindParam('user_id', $user_id,PDO::PARAM_INT);
				$result1->bindParam('service_id', $service_id,PDO::PARAM_INT);

				$result1->execute();

				if($result1){

					

						echo json_encode(array('status'=>'success'));
						die;



					}else{

						echo json_encode(array('status'=>'error'));
						die;
					}

				



			}else{


				echo json_encode(array('status'=>'error'));
				die;

				
			}


			

			

		}


		public function addReview($post){

			global $database;
			//global $notification;



			$review = clean($post['review']);
			$rating = clean($post['rate']);
			$user_id = clean($post['id']);
			$subject = clean($post['subject']);
			$service_id = clean($post['service_id']);
			$type = clean($post['type']);

			$handyman_id = clean($post['handyman_id']);


			


			if(empty($review) || empty($subject) || empty($rating)){

		
				echo json_encode(array('status'=>'empty fields'));
				die;

			}

			
			$date_created = time();
			$active = 0;


			try{

				$database->beginTransaction();

				$sql2 = "DELETE FROM reviews WHERE user_id = :id AND recipient_id = :recipient_id AND service_id = :service_id";

				$result2 = $database->prepare($sql2);
				$result2->bindParam('id',$user_id,PDO::PARAM_STR);
				$result2->bindParam('recipient_id',$handyman_id,PDO::PARAM_STR);
				$result2->bindParam('service_id',$service_id,PDO::PARAM_STR);
				$result2->execute();

			

			

				

			$sql = "INSERT INTO reviews (subject, review, type, user_id, service_id, recipient_id, date_created, rating, active) VALUES (:subject, :review, :type, :user_id, :service_id, :recipient_id, :date_created, :rating, :active)";

			$result = $database->prepare($sql);
			$result->bindParam('review',$review,PDO::PARAM_STR);
			$result->bindParam('type',$type,PDO::PARAM_STR);
			$result->bindParam('subject',$subject,PDO::PARAM_STR);
			$result->bindParam('user_id',$user_id,PDO::PARAM_INT);
			$result->bindParam('date_created',$date_created,PDO::PARAM_INT);
			$result->bindParam('rating',$rating,PDO::PARAM_INT);
			$result->bindParam('recipient_id',$handyman_id,PDO::PARAM_INT);
			$result->bindParam('active',$active,PDO::PARAM_INT);
			$result->bindParam('service_id',$service_id,PDO::PARAM_INT);

			$result->execute();

			if($result->rowCount() > 0){

				$database->commit();

				echo json_encode(array('status'=>'success'));
				die;


				//Sending Review to Admin Notification

				// $item_type = "New Review";

				// $id = $database->lastInsertId();

				// 	$status = $notification->addAdminNotification($_SESSION['user_id'], $item_type, $id);

				// 	if($status){

				// 		$database->commit();
				// 		$_SESSION['success'] = "Reviewed Saved Successfully";
				// 		go();

				// 	}else{

				// 		$database->rollBack();
				// 		die('fggdr');
				// 		$_SESSION['error'] = "An error Occured. Please try again";
				// 		go();
				// 	}

				

				
			}else{

				echo json_encode(array('status'=>'error'));
				die;
			}




			}catch(PDOException $e){


					$database->rollBack();

					
					 die($e->getMessage());

					echo json_encode(array('status'=>'error'));
				die;
			
			}
			

			




		}




		public function fetchAllMessages($sender_id, $recipient_id){


			global $database;

			$sql= "SELECT m.* FROM message m WHERE ((sender_id = $sender_id AND recipient_id = $recipient_id) OR (sender_id = $recipient_id AND recipient_id =$sender_id))";

			$result = $database->query($sql);

			if($result->rowCount() > 0){


				$results = $result->fetchAll(PDO::FETCH_ASSOC);


				echo json_encode(array('status'=>'success', 'data'=>$results));
				die;


			}else{

				echo json_encode(array('status'=>'empty'));
				die;

			}



		}




		public function replyMessage($post){
		global $database;
		
		$message_parent_id = $post['message_parent_id'];
		$recipient_id = $post['recipient_id'];
		
		$read_status = clean($post['read_status']);
		$_SESSION['reply']['message'] = $message = trim($post['message']);
			
		
		// if(empty($recipient)){
		// 	$_SESSION['error'] = "An error occurred";
		// 	go($_SERVER['HTTP_REFERER']);
		// 	}
		
		if(empty($message)){
			echo json_encode(array('status'=>'error'));
			}	
		
		$user_id = trim($_SESSION['user_id']);
		




		try{
				$database->beginTransaction();	 	 	 		 	 
				
				// 	 	 	 	 	 	 	 	 	 	 		 	date_read 	active
				$query1  = "INSERT INTO message(`sender_id`,`recipient_id`,`message`,
				`message_parent_id`,`read_status`,`date_created`,`active`) 
				VALUES(:sender_id,:recipient_id,:message, :message_parent_id,:read_status,:date_created,:active) ";
				$result1 = $database->prepare($query1);
				$result1->bindValue('sender_id',$user_id,PDO::PARAM_STR);
				// $result1->bindValue('',$user_role,PDO::PARAM_INT);
				$result1->bindValue('recipient_id',$recipient_id,PDO::PARAM_INT);
				// $result1->bindValue('recipient_type',$recipient,PDO::PARAM_STR);
				// $result1->bindValue('subject',$subject,PDO::PARAM_STR);
				$result1->bindValue('message',$message,PDO::PARAM_STR);
				$result1->bindValue('message_parent_id',$message_parent_id,PDO::PARAM_STR);
				// $result1->bindValue('allow_reply','yes',PDO::PARAM_INT);
				// $result1->bindValue('type','portal',PDO::PARAM_INT);
				$result1->bindValue('read_status',0,PDO::PARAM_STR);
				$result1->bindValue('date_created',time(),PDO::PARAM_STR);
				$result1->bindValue('active',1,PDO::PARAM_STR);
				$result1->execute();
				
				
				$reply=0;
				if($read_status=='sender_read_status'){
					$reply=1;
				}
				
				
				$sql="UPDATE message SET $read_status=0  reply=$reply WHERE id=$message_parent_id";
				$result2=$database->query($sql);
				
		
					if($result1->rowCount() > 0  && $result1->rowCount() > 0 ){
						$database->commit();
						echo json_encode(array('status'=>'success'));
						
					}else{
						$database->rollBack();
						echo json_encode(array('status'=>'error'));
					}
			
		
		go($_SERVER['HTTP_REFERER']);
			
			}catch(PDOException $e){
				$database->rollBack();
				echo json_encode(array('status'=>'error'));
				die($e->getMessage());
				
		
		}
			
			
			
				
	
	}




		public function sendMessage( $sender_id, $recipient_id, $message, $last_message_id){



			$message_parent_id = 0;
			// $message = clean($post['message']);

			

			//check for empty stuff


			if(empty($message)){

				echo json_encode(array('status'=>'empty'));
				die;

			}

			
			$date_created = time();
			$active = 1;

			global $database;

			$sql = "INSERT INTO message (`message`, `sender_id` , `message_parent_id`, `recipient_id`, `date_created`,`active`) VALUES ( :message, :sender_id, :message_parent_id,  :recipient_id, :date_created, :active)";

		

			$result = $database->prepare($sql);
			$result->bindValue('sender_id',$sender_id,PDO::PARAM_INT);
			// $result->bindValue('sender_type',$sender_type,PDO::PARAM_INT);
			$result->bindValue('recipient_id',$recipient_id,PDO::PARAM_INT);
			$result->bindValue('message',$message,PDO::PARAM_STR);
			// $result->bindValue('recipient_type',$recipient_type,PDO::PARAM_STR);
			$result->bindValue('message_parent_id',$message_parent_id,PDO::PARAM_INT);
			$result->bindValue('date_created',$date_created,PDO::PARAM_INT);
			$result->bindValue('active',$active,PDO::PARAM_INT);


			$result->execute();

			if(!empty($_REQUEST['last_message_id']) && isset($_REQUEST['last_message_id'])){
$last_message_id = $_REQUEST['last_message_id'];
}

			if($result->rowCount() > 0){



					if(isset($last_message_id) && !empty($last_message_id)){


						$sql1= "SELECT m.* FROM message m WHERE m.id > $last_message_id AND  ((sender_id = $sender_id AND recipient_id = $recipient_id) OR (sender_id = $recipient_id AND recipient_id =$sender_id))";

						$result1 = $database->query($sql1);

						if($result1->rowCount() > 0){


								$results1 = $result1->fetchAll(PDO::FETCH_ASSOC);


								echo json_encode(array('status'=>'success', 'data'=>$results1));
								die;


							}else{

								echo json_encode(array('status'=>'empty'));
								die;

							}






					}else{


						echo json_encode(array('status'=>'success'));


					}




					





			}else{
				echo json_encode(array('status'=>'error'));
				die;
			}


		}


		public  function fetchMyCompanyDetails($id)
			{
				global $database;

				$sql = "SELECT c.* FROM companies c WHERE c.user_id = :id";
				$result = $database->prepare($sql);
				$result->bindParam('id',$id,PDO::PARAM_INT);
				$result->execute();

				if($result->rowCount() > 0){

					$details = $result->fetch(PDO::FETCH_ASSOC);

					echo json_encode(array('status'=>'success', 'data'=>$details));
					die;

				}else{

					echo json_encode(array('status'=>'empty'));
					die;

				}

			}

		public  function fetchCompanyDetails($id, $user_id)
			{
				global $database;
				$favourite = 'null';
				$review = 'null';
				$handyman_status = 'null';
				$sql = "SELECT c.*, ct.name AS city_name, ct.lat AS latitude, ct.lng AS longitude, s.name AS state_name, cn.name AS country_name FROM companies c LEFT JOIN cities ct ON (ct.id = c.city) LEFT JOIN states s ON (s.id = c.state) LEFT JOIN countries
				 cn ON (cn.id = c.country) WHERE c.id = :id";
				$result = $database->prepare($sql);
				$result->bindParam('id',$id,PDO::PARAM_INT);
				$result->execute();

				if($result->rowCount() > 0){

				$details = $result->fetch(PDO::FETCH_ASSOC);



				if(ctype_digit($user_id) && !empty($user_id) && $user_id > 0){


					$type = 'company';
					$action = 'favourite';

					$sql1 = "SELECT id FROM user_activity WHERE user_id = :user_id AND handyman_id = :id AND action = :action AND type = :type";

					$result1 = $database->prepare($sql1);
					$result1->bindParam('user_id', $user_id, PDO::PARAM_STR);
					$result1->bindParam('type', $type, PDO::PARAM_STR);
					$result1->bindParam('id', $id, PDO::PARAM_INT);
					$result1->bindParam('action', $action, PDO::PARAM_INT);
					$result1->execute();

					if($result1->rowCount() > 0 ){

						$favourite = 'true';

						


					}else{

						$favourite = 'false';


					}



					$history = $this->updateHistory($user_id, $id, $type);


					if($history){

						

					}else{

						echo json_encode(array('status'=>'error'));
						die;

					}




				}



				echo json_encode(array('status'=>'success', 'favourite'=>$favourite, 'data'=>$details));
						die;

				
			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}
		}

		public function fetchMyDetails($id, $type){

			global $database;

			switch ($type) {
						case 'individual':


						$sql = "SELECT ROUND(AVG(r.rating) ,1) AS user_rating,u.*, ct.lat AS latitude, ct.lng AS longitude, ct.name AS city_name, s.name AS state_name, cn.name AS country_name FROM users u LEFT JOIN reviews r ON (r.recipient_id = u.id AND r.type = 'individual') LEFT JOIN cities ct ON (ct.id = u.city_of_residence)  LEFT JOIN states s ON (s.id = u.state_of_residence)  LEFT JOIN countries
					 cn ON (cn.id = u.country_of_residence) WHERE u.id = :id";
					$result = $database->prepare($sql);
					$result->bindParam('id',$id,PDO::PARAM_INT);
					$result->execute();

					if($result->rowCount() > 0){



					$details = $result->fetch(PDO::FETCH_ASSOC);



					}else{

						$details = 'empty';
					}



					echo json_encode(array('status'=>'success', 'data'=>$details));
						die;

						break;


						case 'company':

						break;

					}





		}

		public  function fetchIndividualDetails($id, $user_id, $service_id, $review_count, $type)
			{

					global $database;


					switch ($type) {
						case 'individual':
							







						$favourite = 'null';
					$review = 'null';
					$handyman_status = 'null';
				
					$services = 'null';
					$my_review = 'null';
					$review_status = 'null';;






					$sql3 = "SELECT r.review, r.subject, u.id, u.profile_picture, u.first_name, u.last_name, u.pic_set, u.thumb FROM users u , reviews r WHERE  r.recipient_id = u.id AND r.service_id = $service_id AND r.active = 1 AND r.type = 'individual' AND u.id = $id";

					$result3 = $database->query($sql3);

					if($result3->rowCount() > 0){

						$review_details = $result3->fetchAll(PDO::FETCH_ASSOC);

						// $rating = $review_details['user_rating'];

						// $rating = round($review_details['user_rating'], 1);

						

						

					}else{

						$review_details = 'empty';

						

					}


					$sql4 = "SELECT hs.service_id,hs.path3,hs.path1,hs.path2, s.name FROM users u LEFT JOIN handyman_services hs ON (hs.user_id = u.id) LEFT JOIN services s ON (hs.service_id = s.id)  WHERE u.active = 1 AND u.id = $id";

					$result4 = $database->query($sql4);

					if($result4->rowCount() > 0){

						$services = $result4->fetchAll(PDO::FETCH_ASSOC);

					}else{

						$services = 'empty';
					
					}



					$sql = "SELECT ROUND(AVG(r.rating) ,1) AS user_rating, u.* FROM users u LEFT JOIN reviews r ON (r.recipient_id = u.id AND r.type = 'individual')   WHERE u.id = :id";
					$result = $database->prepare($sql);
					$result->bindParam('id',$id,PDO::PARAM_INT);
					$result->execute();

					if($result->rowCount() > 0){



					$details = $result->fetch(PDO::FETCH_ASSOC);


					if(ctype_digit($user_id) && !empty($user_id) && $user_id > 0){



						$sql9 = "SELECT r.review, r.rating AS rate, r.id AS review_id, r.subject, r.active, u.id, u.profile_picture, u.first_name, u.last_name, u.pic_set, u.thumb FROM users u , reviews r WHERE  r.recipient_id = u.id AND r.user_id = $user_id AND r.service_id = $service_id  AND r.type = 'individual' AND u.id = $id";

					$result9 = $database->query($sql9);

					if($result9->rowCount() > 0){

						$my_review = $result9->fetch(PDO::FETCH_ASSOC);

						$my_review_status = $my_review['active'];

						if($my_review_status == 0){
							$review_status = 'pending';
						}elseif ($my_review_status == 1) {
							$review_status = 'approved';
						}

						// $rating = round($review_details['user_rating'], 1);

						

						

					}else{

						$my_review = 'empty';

						

					}













					$sql2 = "SELECT id FROM message WHERE sender_id = :sender_id AND recipient_id = :recipient_id";
					$result2 = $database->prepare($sql2);
					$result2->bindParam('sender_id', $user_id, PDO::PARAM_INT);
					$result2->bindParam('recipient_id', $id, PDO::PARAM_INT);
					$result2->execute();

					if($result2->rowCount() > 0){

						$review = 'true';

					}else{

						$review = 'false';

					}


					$type = 'individual';
					$action = 'favourite';

					$sql1 = "SELECT id FROM user_activity WHERE user_id = :user_id AND handyman_id = :id AND action = :action AND type = :type";

					$result1 = $database->prepare($sql1);
					$result1->bindParam('user_id', $user_id, PDO::PARAM_STR);
					$result1->bindParam('type', $type, PDO::PARAM_STR);
					$result1->bindParam('id', $id, PDO::PARAM_INT);
					$result1->bindParam('action', $action, PDO::PARAM_INT);
					$result1->execute();

					if($result1->rowCount() > 0 ){

						$favourite = 'true';

						


					}else{

						$favourite = 'false';


					}

					$history = $this->updateHistory($user_id, $id, $type);


				if($history){

	

				}else{

					echo json_encode(array('status'=>'error'));
					die;

				}




				}else{

					$sql2 = "SELECT id FROM handyman_services WHERE user_id = $id";
					$result2 = $database->query($sql2);

					if($result2->rowCount() > 0){


						$handyman_status = 'true';


					}else{

						$handyman_status = 'false';
					}
				}


				



	echo json_encode(array('status'=>'success', 'services'=>$services, 'favourite'=>$favourite, 'handyman_status'=>$handyman_status, 'review'=>$review,'data'=>$details, 'review_details'=>$review_details, 'my_review'=>$my_review, 'review_status'=>$review_status));
					die;




				}else{

					echo json_encode(array('status'=>'empty'));
					die;
				}

















							break;
						

						case 'company':
							



						$services = 'null';

						$favourite = 'null';
						$review = 'null';
						$handyman_status = 'null';

						$my_review = 'null';

						$review_status = 'null';


				$sql = "SELECT c.* FROM companies c  WHERE c.id = :id";
				$result = $database->prepare($sql);
				$result->bindParam('id',$id,PDO::PARAM_INT);
				$result->execute();

				if($result->rowCount() > 0){

				$details = $result->fetch(PDO::FETCH_ASSOC);


				$sql3 = "SELECT r.review, r.subject, u.id, u.profile_picture, u.first_name, u.last_name, u.pic_set, u.thumb FROM users u , reviews r WHERE  r.recipient_id = u.id AND r.service_id = $service_id AND r.active = 1 AND r.type = 'company' AND u.id = $id";

					$result3 = $database->query($sql3);

					if($result3->rowCount() > 0){

						$review_details = $result3->fetchAll(PDO::FETCH_ASSOC);

						// $rating = $review_details['user_rating'];

						// $rating = round($review_details['user_rating'], 1);

						

						

					}else{

						$review_details = 'empty';

						

					}



				if(ctype_digit($user_id) && !empty($user_id) && $user_id > 0){


					$sql9 = "SELECT r.review, r.rating AS rate, r.id AS review_id, r.subject, r.active, u.id, u.path, u.name, u.pic_set, u.thumb FROM companies u , reviews r WHERE  r.recipient_id = u.id AND r.user_id = $user_id AND r.service_id = $service_id  AND r.type = 'company' AND u.id = $id";

					$result9 = $database->query($sql9);

					if($result9->rowCount() > 0){

						$my_review = $result9->fetch(PDO::FETCH_ASSOC);

						$my_review_status = $my_review['active'];

						if($my_review_status == 0){
							$review_status = 'pending';
						}elseif ($my_review_status == 1) {
							$review_status = 'approved';
						}

						// $rating = round($review_details['user_rating'], 1);

						

						

					}else{

						$my_review = 'empty';

						

					}


					$type = 'company';
					$action = 'favourite';

					$sql1 = "SELECT id FROM user_activity WHERE user_id = :user_id AND handyman_id = :id AND action = :action AND type = :type";

					$result1 = $database->prepare($sql1);
					$result1->bindParam('user_id', $user_id, PDO::PARAM_STR);
					$result1->bindParam('type', $type, PDO::PARAM_STR);
					$result1->bindParam('id', $id, PDO::PARAM_INT);
					$result1->bindParam('action', $action, PDO::PARAM_INT);
					$result1->execute();

					if($result1->rowCount() > 0 ){

						$favourite = 'true';

						


					}else{

						$favourite = 'false';


					}



					$history = $this->updateHistory($user_id, $id, $type);


					if($history){

						

					}else{

						echo json_encode(array('status'=>'error'));
						die;

					}




				}



				$sql4 = "SELECT cs.service_id,cs.path1, cs.path2, cs.path3, s.name FROM companies c LEFT JOIN company_services cs ON (cs.company_id = c.id) LEFT JOIN services s ON (cs.service_id = s.id)  WHERE c.active = 1 AND c.id = $id";

					$result4 = $database->query($sql4);

					if($result4->rowCount() > 0){


						$services = $result4->fetchAll(PDO::FETCH_ASSOC);

					}else{

						$services = 'empty';
					
					}



				echo json_encode(array('status'=>'success', 'favourite'=>$favourite, 'data'=>$details, 'services'=>$services, 'review_details'=>$review_details, 'my_review'=>$my_review, 'review_status'=>$review_status));
						die;

				
			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}














							break;
						
						
					}

























					







			}


		public function updateFavourite($id, $user_id, $type, $status){


				global $database;

				$date_created = time();
				$action = 'favourite';


				switch ($status) {
					case 'true':
						
						$sql = "DELETE FROM user_activity WHERE user_id = :user_id AND handyman_id = :handyman_id AND type = :type AND action = :action";

						$result = $database->prepare($sql);
						$result->bindParam('user_id', $user_id,PDO::PARAM_INT);
						$result->bindParam('handyman_id', $id,PDO::PARAM_INT);
						$result->bindParam('action', $action,PDO::PARAM_STR);
						$result->bindParam('type', $type,PDO::PARAM_STR);
						$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
						$result->execute();

						if($result){

						echo json_encode(array('status' =>'success', 'favourite'=>'false'));
						die;

					}else{
						echo json_encode(array('status'=>'error'));
						die;
					}



						break;
					
					case 'false':
						

							$sql = "INSERT INTO user_activity (user_id, handyman_id, action, type, date_created) VALUES (:user_id, :handyman_id, :action, :type, :date_created)";

					$result = $database->prepare($sql);
					$result->bindParam('user_id', $user_id,PDO::PARAM_INT);
					$result->bindParam('handyman_id', $id,PDO::PARAM_INT);
					$result->bindParam('action', $action,PDO::PARAM_STR);
					$result->bindParam('type', $type,PDO::PARAM_STR);
					$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
					$result->execute();

					if($result->rowCount() > 0){

						echo json_encode(array('status' =>'success', 'favourite'=>'true'));
						die;

					}else{
						echo json_encode(array('status'=>'error'));
						die;
					}



						break;
				}















				$sql1 = "SELECT id FROM user_activity WHERE user_id = :user_id AND handyman_id = :id AND action = :action";

				$result1 = $database->prepare($sql1);
				$result1->bindParam('user_id', $user_id, PDO::PARAM_INT);
				$result1->bindParam('id', $id, PDO::PARAM_INT);
				$result1->bindParam('action', $action, PDO::PARAM_INT);
				$result1->execute();

				if($result1->rowCount() > 0 ){

					echo json_encode(array('status'=>'true'));
					die;


				}else{

				

				}


				
			}


			public function deleteActivity($id, $action){

				global $database;

				$sql = "DELETE FROM user_activity WHERE user_id = $id AND action = '$action'";

				

				$result = $database->query($sql);

				if($result){

					echo json_encode(array('status'=>'success'));
					die;


				}else{

					echo json_encode(array('status'=>'error'));
					die;

				}


			}


			public function fetchIndividualHistory($id, $limit){

				global $database;

				$date_created = time();
				$action = 'history';


				$sql = "SELECT a.user_id,a.handyman_id,a.type, ct.lng AS longitude, ct.lat AS latitude, ct.name AS city_name, c.name AS country_name, s.name AS state_name, u.* FROM user_activity a, users u LEFT JOIN cities ct ON (ct.id = u.city_of_residence) LEFT JOIN countries c ON (c.id = u.country_of_residence) LEFT JOIN states s ON (s.id = u.state_of_residence) WHERE  a.action = '$action' AND u.id = a.handyman_id AND a.user_id = $id ORDER BY a.id DESC LIMIT  $limit";

				$result = $database->query($sql);

				if($result->rowCount() > 0){

					 $details = $result->fetchAll(PDO::FETCH_ASSOC);

					echo json_encode(array('status'=>'success', 'data'=>$details));
					die;


				}else{

					echo json_encode(array('status'=>'empty'));
					die;

				}


			}


			public function fetchIndividualFavourite($id){

				global $database;

				$date_created = time();
				$action = 'favourite';


				$sql = "SELECT a.user_id,a.handyman_id,a.type, ct.lng AS longitude, ct.lat AS latitude, ct.name AS city_name, c.name AS country_name, s.name AS state_name, u.* FROM user_activity a, users u LEFT JOIN cities ct ON (ct.id = u.city_of_residence) LEFT JOIN countries c ON (c.id = u.country_of_residence) LEFT JOIN states s ON (s.id = u.state_of_residence) WHERE a.action = '$action' AND u.id = a.handyman_id AND a.user_id = $id ORDER BY a.id";

				$result = $database->query($sql);

				if($result->rowCount() > 0){

					 $details = $result->fetchAll(PDO::FETCH_ASSOC);

					echo json_encode(array('status'=>'success', 'data'=>$details));
					die;


				}else{

					echo json_encode(array('status'=>'empty'));
					die;

				}


			}




			public function updateHistory($user_id, $id, $type){

				global $database;

				$date_created = time();
				$action = 'history';

				$sql = "INSERT INTO user_activity (user_id, handyman_id, action, date_created, type) VALUES (:user_id, :handyman_id, :action, :date_created, :type)";

				$result = $database->prepare($sql);
				$result->bindParam('user_id', $user_id,PDO::PARAM_INT);
				$result->bindParam('handyman_id', $id,PDO::PARAM_INT);
				$result->bindParam('action', $action,PDO::PARAM_STR);
				$result->bindParam('type', $type,PDO::PARAM_STR);
				$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
				$result->execute();

				if($result->rowCount() > 0){

					return true;

					// echo json_encode(array('status'=>'success'));
					// die;

				}else{

					return false;
					// echo json_encode(array('status'=>'error'));
					// die;
				}
			}



			public function fetchTrendingCategories(){

			global $database;

			$sql = "SELECT id, name,  path, description, mobile_path FROM categories WHERE active = 1 AND deleted = 0 ORDER BY views_count DESC LIMIT 6";
			$result = $database->query($sql);

			if($result->rowCount() > 0){

				 $categories = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$categories));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}



		}


		public function fetchMyNotificationCount($id){

			global $database;


			$sql1 = "SELECT  m.id FROM notification m WHERE m.read_status = 0 AND m.staff_id =".$id;

			$sql2 = "SELECT  m.id FROM message m WHERE  m.read_status = 0 AND m.recipient_id =".$id;

    $result = $database->query($sql1);

    $notification_count = $result->rowCount();

     $result2 = $database->query($sql2);

    $message_count = $result2->rowCount();



    $count = $message_count + $notification_count;

    echo json_encode(array('status'=>'success', 'count'=>$count));
    die;

    	


		}




		public function fetchMyNotification($id){

			global $database;


			$sql1 = "SELECT  m.id, m.item_type, m.date_created, m.read_status, s.first_name, s.last_name, s.pic_set, s.thumb FROM notification m, users s WHERE s.id = m.staff_id AND m.staff_id =".$id." ORDER BY m.id DESC LIMIT 8";


    $result = $database->query($sql1);

    $count = $result->rowCount();

    	if($result->rowCount() > 0){


				$results = $result->fetchAll(PDO::FETCH_ASSOC);


				echo json_encode(array('status'=>'success', 'data'=>$results, 'count'=>$count));
				die;


			}else{

				echo json_encode(array('status'=>'empty'));
				die;

			}


		}


		public function fetchMyMessages($id){

			global $database;


			$sql1 = "SELECT  m.id,m.subject, m.message, m.date_created, m.recipient_id, s.first_name, s.last_name, s.pic_set, s.thumb FROM message m, users s WHERE s.id = m.sender_id AND  m.message_parent_id = 0 AND m.read_status = 0 AND m.recipient_id =".$id." ORDER BY m.id DESC LIMIT 8";


    $result = $database->query($sql1);

    $count = $result->rowCount();

    	if($result->rowCount() > 0){


				$results = $result->fetchAll(PDO::FETCH_ASSOC);


				echo json_encode(array('status'=>'success', 'data'=>$results, 'count'=>$count));
				die;


			}else{

				echo json_encode(array('status'=>'empty'));
				die;

			}


		}


		public function checkCompanyServiceExist($user_id, $service_id){

			global $database;

			$sql = "SELECT id FROM company_services WHERE user_id = ".$user_id." AND service_id = ".$service_id;
			$result = $database->query($sql);

			if($result->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}


		public function checkServiceExist($user_id, $service_id){

			global $database;

			$sql = "SELECT id FROM handyman_services WHERE user_id = $user_id AND service_id = $service_id";
			$result = $database->query($sql);

			if($result->rowCount() > 0){
				return true;
			}else{
				return false;
			}
		}

		public function addIndividualService($post, $files){

		$picture = new Photograph;

		// echo json_encode(array('status'=>$post));
		// die();

			global $database;


			$category_id = ucwords(clean($post['category_id']));
			$service_id = ucwords(clean($post['service_id']));
			$description = ucwords(clean($post['description']));
			$user_id = ucwords(clean($post['user_id']));
			$mobile = ucwords(clean($post['mobile']));

			$type = 'individual';

			$date_created = time();

			$status = $this->checkServiceExist($user_id, $service_id);

			if($status){

				echo json_encode(array('status'=>'exist'));
				die();

			}

			if(isset($files['photo1']) && $files['photo1']['size'] > 0){

	

			$file_index = 'photo1';


		    $file1 = $picture->save($files["$file_index"],uniqid().'-'.time(),'../../uploads/services/');

					 if($file1 == false){
						 
							 echo json_encode(array('status'=>'error'));
							die();
					}

		

						$photo1 = str_ireplace('../../','',$file1);
						//$file2 = str_ireplace('../../uploads/profile/','../../uploads/profile/thumb/',$file);

						// $file3 = str_ireplace('../../uploads/profile/thumb/','uploads/profile/thumb/',$file2);
						
				 	// $thumb1  = $file2;
				 	// $ImageResize = new ImageResize($file);
				 	// $ImageResize->resizeToWidth(460);
				 	// $ImageResize->save($thumb1);


				 
					
				 
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
						//$file2 = str_ireplace('../../uploads/services/','../../uploads/services/thumb/',$file);

						// $file3 = str_ireplace('../../uploads/profile/thumb/','uploads/profile/thumb/',$file2);
						
				 	// $thumb1  = $file2;
				 	// $ImageResize = new ImageResize($file);
				 	// $ImageResize->resizeToWidth(460);
				 	// $ImageResize->save($thumb1);


				 
					
				 
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
						//$file2 = str_ireplace('../../uploads/profile/','../../uploads/profile/thumb/',$file);

						// $file3 = str_ireplace('../../uploads/profile/thumb/','uploads/profile/thumb/',$file2);
						
				 	// $thumb1  = $file2;
				 	// $ImageResize = new ImageResize($file);
				 	// $ImageResize->resizeToWidth(460);
				 	// $ImageResize->save($thumb1);


				 
					
				 
		}else{
			$photo3 = '';
		}




			$sql = "INSERT INTO handyman_services (user_id, category_id, service_id, description, type, date_created,path1,path2,path3) VALUES (:user_id, :category_id, :service_id, :description, :type, :date_created,:path1,:path2,:path3)";

					$result = $database->prepare($sql);
					$result->bindParam('user_id', $user_id,PDO::PARAM_INT);
					$result->bindParam('category_id', $category_id,PDO::PARAM_INT);
					$result->bindParam('service_id', $service_id,PDO::PARAM_STR);
					$result->bindParam('description', $description,PDO::PARAM_STR);
					$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
					$result->bindParam('type', $type,PDO::PARAM_STR);
					$result->bindParam('path1', $photo1,PDO::PARAM_STR);
					$result->bindParam('path2', $photo2,PDO::PARAM_STR);
					$result->bindParam('path3', $photo3,PDO::PARAM_STR);
					$result->execute();


				if($result->rowCount() > 0){

					echo json_encode(array('status'=>'success'));
					die;


				}else{

					echo json_encode(array('status'=>'error'));
					die;

				}


		}


		public function editIndividualContactDetails($post,$id){


			global $database;


			$country_of_residence = ucwords(clean($post['country_of_residence']));
			$state_of_residence = ucwords(clean($post['state_of_residence']));
			$city_of_residence = ucwords(clean($post['city_of_residence']));
			$address = ucwords(clean($post['address']));

			$mobile = ucwords(clean($post['mobile']));
			
			



			if(empty($country_of_residence)){
				error("Firstname is Required", $mobile);
			
			}


			


			$sql = "UPDATE users SET country_of_residence = :country_of_residence, state_of_residence = :state_of_residence, city_of_residence = :city_of_residence, address = :address WHERE id = :id";
						

						$result = $database->prepare($sql);
						$result->bindParam('country_of_residence',$country_of_residence,PDO::PARAM_INT);
						$result->bindParam('state_of_residence',$state_of_residence,PDO::PARAM_INT);
						
						$result->bindParam('city_of_residence',$city_of_residence,PDO::PARAM_INT);
						$result->bindParam('address',$address,PDO::PARAM_STR);
						//$result->bindParam('nationality',$nationality,PDO::PARAM_INT);
						
						$result->bindParam('id',$id,PDO::PARAM_INT);
						$result->execute();
						if($result){
								echo json_encode(array('status'=>'success'));
								die;
						}else{
								echo json_encode(array('status'=>'error'));
								die;
						}
						




		}

		public function updateIndividualPersonalPicture($files, $post){

			global $database;

			$id = ucwords(clean($post['user_id']));


			if($files['uploadFile']['size'] > 0){



			$pic_set = 1;



			$picture = new Photograph;

			$file_index = 'uploadFile';


		 $file = $picture->save($files["$file_index"],uniqid().'-'.time(),'../../uploads/profile/');

					 if($file == false){
						 
							 echo json_encode(array('status'=>'error'));
							die();
					}

		// 				      echo json_encode(array('status'=>'kk'));
		// die();

						$file1 = str_ireplace('../../','',$file);
						$file2 = str_ireplace('../../uploads/profile/','../../uploads/profile/thumb/',$file);

						$file3 = str_ireplace('../../uploads/profile/thumb/','uploads/profile/thumb/',$file2);
						
				 	$thumb1  = $file2;
				 	$ImageResize = new ImageResize($file);
				 	$ImageResize->resizeToWidth(460);
				 	$ImageResize->save($thumb1);


				 	$sql = "UPDATE users SET profile_picture = :profile_picture, thumb = :thumb, pic_set = :pic_set WHERE id = :id";
						

						$result = $database->prepare($sql);
						$result->bindParam('profile_picture',$file1,PDO::PARAM_STR);
						$result->bindParam('thumb',$file3,PDO::PARAM_STR);
						$result->bindParam('pic_set',$pic_set,PDO::PARAM_STR);
						$result->bindParam('id',$id,PDO::PARAM_STR);
						$result->execute();
						if($result){
								echo json_encode(array('status'=>'success'));
								die;
						}else{
								echo json_encode(array('status'=>'error'));
								die;
						}
						
					
				 
		}else{
	       echo json_encode(array('status'=>'cc'));
			die();

		}






		}




		public function editIndividualPersonalDetails($post){


			global $database;

			$id = ucwords(clean($post['user_id']));

			$first_name = ucwords(clean($post['first_name']));
			$last_name = ucwords(clean($post['last_name']));
			//$nationality = clean($post['nationality']);
			$phone1 = ucwords(clean($post['phone1']));
			$phone2 = ucwords(clean($post['phone2']));
			$address = ucwords(clean($post['address']));

			$address2 = ucwords(clean($post['location']));

			$lng = ucwords(clean($post['lng']));
			$lat = ucwords(clean($post['lat']));
			

			$mobile = clean($post['mobile']);
			//$email = clean($post['email']);
			$bio = clean($post['bio']);
			



			if(empty($first_name)){
				echo json_encode(array('status'=>'empty fields'));
				die;

			
			}

			if(empty($last_name)){
				echo json_encode(array('status'=>'empty fields'));
				die;

			
			}

	


			$sql = "UPDATE users SET first_name = :first_name, last_name = :last_name,address2 = :address2, phone1 = :phone1, phone2 = :phone2, bio = :bio, lng = :lng,lat = :lat, address = :address WHERE id = :id";
						

						$result = $database->prepare($sql);
						$result->bindParam('first_name',$first_name,PDO::PARAM_STR);
						$result->bindParam('last_name',$last_name,PDO::PARAM_STR);
						$result->bindParam('bio',$bio,PDO::PARAM_STR);
						$result->bindParam('phone1',$phone1,PDO::PARAM_STR);
						$result->bindParam('phone2',$phone2,PDO::PARAM_STR);

						$result->bindParam('lng',$lng,PDO::PARAM_STR);
						$result->bindParam('lat',$lat,PDO::PARAM_STR);

						$result->bindParam('address',$address,PDO::PARAM_STR);
						$result->bindParam('address2',$address2,PDO::PARAM_STR);
						$result->bindParam('id',$id,PDO::PARAM_INT);
						$result->execute();
						if($result){
								echo json_encode(array('status'=>'success'));
								die;
						}else{
								echo json_encode(array('status'=>'error'));
								die;
						}
						

		}




		public function editIndividualServicePersonalDetails($post){


			global $database;

			$id = ucwords(clean($post['user_id']));

			// $first_name = ucwords(clean($post['first_name']));
			// $last_name = ucwords(clean($post['last_name']));
			// //$nationality = clean($post['nationality']);
			// $phone1 = ucwords(clean($post['phone1']));
			// $phone2 = ucwords(clean($post['phone2']));
			$address = ucwords(clean($post['address']));

			$address2 = ucwords(clean($post['location']));

			$lng = ucwords(clean($post['lng']));
			$lat = ucwords(clean($post['lat']));
			

			$mobile = clean($post['mobile']);
			//$email = clean($post['email']);
			// $bio = clean($post['bio']);
			



			// if(empty($first_name)){
			// 	echo json_encode(array('status'=>'empty fields'));
			// 	die;

			
			// }

			// if(empty($last_name)){
			// 	echo json_encode(array('status'=>'empty fields'));
			// 	die;

			
			// }

	


			$sql = "UPDATE users SET work_address2 = :address2, work_lng = :lng,work_lat = :lat, work_address = :address WHERE id = :id";
						

						$result = $database->prepare($sql);
						// $result->bindParam('first_name',$first_name,PDO::PARAM_STR);
						// $result->bindParam('last_name',$last_name,PDO::PARAM_STR);
						// $result->bindParam('bio',$bio,PDO::PARAM_STR);
						// $result->bindParam('phone1',$phone1,PDO::PARAM_STR);
						// $result->bindParam('phone2',$phone2,PDO::PARAM_STR);

						$result->bindParam('lng',$lng,PDO::PARAM_STR);
						$result->bindParam('lat',$lat,PDO::PARAM_STR);

						$result->bindParam('address',$address,PDO::PARAM_STR);
						$result->bindParam('address2',$address2,PDO::PARAM_STR);
						$result->bindParam('id',$id,PDO::PARAM_INT);
						$result->execute();
						if($result){
								echo json_encode(array('status'=>'success'));
								die;
						}else{
								echo json_encode(array('status'=>'error'));
								die;
						}
						

		}



		

		public function displayCompanyServicesLocation($latitude, $longitude, $distance, $id){

			global $database;

			$distance_sql = "(((acos(sin((".$latitude."*pi()/180)) * sin((c.lat*pi()/180))+cos((".$latitude."*pi()/180)) * cos((c.lat*pi()/180)) * cos(((".$longitude."- c.lng)*pi()/180))))*180/pi())*60*1.1515*1.609344)";

			$sql = "SELECT  ROUND(AVG(r.rating) ,1) AS company_rating, u.first_name, u.last_name, cs.company_id, cs.description, cs.date_created, c.name, c.user_id, c.phone_number, c.path, c.thumb, c.address, c.website, c.years_experience, c.location, c.lat AS latitude, c.lng AS longitude, c.pic_set, c.country
			FROM company_services cs, companies c LEFT JOIN reviews r ON (r.recipient_id = c.id AND r.type = 'company')  LEFT JOIN users u ON (c.user_id = u.id)
			WHERE  c.active = 1 AND c.verified = 1 AND c.deleted = 0 AND cs.active = 1 AND cs.deleted = 0 AND cs.company_id = c.id AND cs.service_id = $id  AND

			$distance_sql <= ".$distance." GROUP BY c.id";

			$result = $database->query($sql);
			

			if($result->rowCount() > 0){

				
				$results = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$results));
				die;

				// $temp='';
				// $i=1;
				// while($data = $result->fetch(PDO::FETCH_ASSOC)){

				// 	$temp[$i]['first_name'] = $data['first_name']; 
				// 	$temp[$i]['last_name'] = $data['last_name']; 
				// 	$temp[$i]['description'] = $data['description']; 
				// 	$temp[$i]['date_created'] = $data['date_created']; 
				// 	$temp[$i]['name'] = $data['name']; 
				// 	$temp[$i]['user_id'] = $data['user_id']; 
				// 	$temp[$i]['phone_number'] = $data['phone_number']; 
				// 	$temp[$i]['path'] = $data['path']; 
				// 	$temp[$i]['thumb'] = $data['thumb']; 
				// 	$temp[$i]['address'] = $data['address']; 
				// 	$temp[$i]['website'] = $data['website']; 
				// 	$temp[$i]['years_experience'] = $data['years_experience']; 
				// 	$temp[$i]['city'] = $data['city']; 
				// 	$temp[$i]['pic_set'] = $data['pic_set'];
				// 	$temp[$i]['country'] = $data['country']; 
				// 	$temp[$i]['state_name'] = $data['state_name']; 
					


					
				// 	$i++;
				// }

				// echo json_encode(array('status'=>$temp));


			}else{

				echo json_encode(array('status'=>'empty'));
				die;

			}



		}





		public function displayIndividualServicesLocation($latitude, $longitude, $distance, $id){

			

			global $database;
			$distance_sql = "(((acos(sin((".$latitude."*pi()/180)) * sin((u.lat*pi()/180))+cos((".$latitude."*pi()/180)) * cos((u.lat*pi()/180)) * cos(((".$longitude."- u.lng)*pi()/180))))*180/pi())*60*1.1515*1.609344)";

			$sql = "SELECT ROUND(AVG(r.rating) ,1) AS user_rating,  hs.id AS handy_id, hs.description, hs.date_created, u.pic_set, u.first_name, u.last_name, u.phone1, u.phone2, u.email, u.address2, u.profile_picture, u.thumb, u.id, u.work_lat AS latitude, u.work_lng AS longitude 
			FROM users u LEFT JOIN reviews r ON (r.recipient_id = u.id AND r.type = 'individual'),  handyman_services hs 
			WHERE  u.id = hs.user_id AND

			    u.approved = 1 AND

			     hs.service_id = ".$id." AND 

			$distance_sql <= ".$distance." GROUP BY u.id ";

			//echo $sql;
			//die();

			$result = $database->query($sql);
			//echo $result->rowCount();
			if($result->rowCount() > 0){


				$results = $result->fetchAll(PDO::FETCH_ASSOC);

				// print_r($results);
				// die();

				echo json_encode(array('status'=>'success', 'data'=>$results));
				die;


			}else{

				echo json_encode(array('status'=>'empty'));
				die;

			}



		}

		

		public function displayIndividualServiceWithCity($id, $city){

			global $database;

			$sql1 = "SELECT ct.lat AS latitude,
			 ct.lng AS longitude,
			  hs.id AS handy_id, 
			  hs.description, 
			  hs.date_created,  
			  u.pic_set, 
			  u.first_name,
			  u.last_name,
			  u.phone1,
			  u.phone2, 
			  u.email,
			  u.profile_picture,
			  u.thumb,
			  u.id,
			  ct.name AS city,
			 s.name AS state_name,
			 c1.name AS country_name
			 FROM users u LEFT JOIN states s ON (s.id = u.state_of_residence) LEFT JOIN countries c1 ON (c1.id = u.country_of_residence) LEFT JOIN cities ct ON (u.city_of_residence = ct.id) , handyman_services hs  WHERE u.id = hs.user_id AND

		    u.approved = 1 AND
		    u.active = 1 AND
		    u.deleted = 0  AND 
		    u.city_of_residence = $city AND

		    hs.service_id = ".$id;


			     $result = $database->query($sql1);



			// $sql1 = "SELECT ct.lat AS latitude, ct.lng AS longitude, AVG(r.rating) AS user_rating,  hs.id AS handy_id, hs.description, hs.date_created, u.pic_set, u.first_name, u.last_name, u.phone1, u.phone2, u.email, u.profile_picture, u.thumb, u.id, ct.name AS city, s.name AS state_name FROM  users u LEFT JOIN states s ON (s.id = u.state_of_residence) LEFT JOIN cities ct ON (u.city_of_residence = ct.id),  handyman_services hs LEFT JOIN reviews r ON (r.service_id = hs.id)  WHERE u.city_of_residence = $city AND  u.id = hs.user_id AND u.approved = 1 AND hs.service_id = $id ";

			// $result = $database->query($sql1);


		if($result->rowCount() > 0){

				$details = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$details));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}


		}

		public function displayIndividualServices($id){

			global $database;

			$sql1 = "SELECT u.work_lat AS latitude,
			ROUND(AVG(r.rating) ,1) AS user_rating,
			 u.work_lng AS longitude,
			  hs.id AS handy_id, 
			  hs.description, 
			  hs.date_created,  
			  u.pic_set, 
			  u.first_name,
			  u.last_name,
			  u.phone1,
			  u.phone2, 
			  u.email,
			  u.profile_picture,
			  u.thumb,
			  u.address2,
			  u.id
			 --   ct.name AS city,
			 -- s.name AS state_name,
			 -- c1.name AS country_name
			 FROM users u LEFT JOIN reviews r ON (r.recipient_id = u.id AND r.type = 'individual') 
			 -- LEFT JOIN states s ON (s.id = u.state_of_residence) 
			 -- LEFT JOIN countries c1 ON (c1.id = u.country_of_residence) 
			 -- LEFT JOIN cities ct ON (u.city_of_residence = ct.id) 
			 , handyman_services hs  WHERE u.id = hs.user_id AND

			    u.approved = 1 AND

			     hs.service_id = ".$id." GROUP BY u.id";


			     $result = $database->query($sql1);




			// $sql1 = "SELECT ct.lat AS latitude, ct.lng AS longitude, AVG(r.rating) AS user_rating,  hs.id AS handy_id, hs.description, hs.date_created, u.pic_set, u.first_name, u.last_name, u.phone1, u.phone2, u.email, u.profile_picture, u.thumb, u.id, ct.name AS city, s.name AS state_name FROM  users u LEFT JOIN states s ON (s.id = u.state_of_residence) LEFT JOIN cities ct ON (u.city_of_residence = ct.id),  handyman_services hs LEFT JOIN reviews r ON (r.service_id = hs.id)  WHERE  u.id = hs.user_id AND u.approved = 1 AND hs.service_id = $id ";

			// $result = $database->query($sql1);


		if($result->rowCount() > 0){

				$details = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$details));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}


		}


		

		public function displayCompanyServicesWithCity($id, $city){

			global $database;

			$sql = "SELECT ct.lat AS latitude, ct.lng AS longitude, u.first_name, u.last_name, cs.company_id, cs.description, cs.date_created, c.name, c.user_id, c.phone_number, c.path, c.thumb, c.address, c.website, c.years_experience, ct.name AS city, c.pic_set, c.country, s.name AS state_name  FROM company_services cs, companies c LEFT JOIN states s ON (s.id = c.state) LEFT JOIN cities ct ON (c.city = ct.id) LEFT JOIN users u ON (c.user_id = u.id) WHERE c.city = $city AND c.active = 1 AND c.verified = 1 AND c.deleted = 0 AND cs.active = 1 AND cs.deleted = 0 AND cs.company_id = c.id AND cs.service_id = $id ";


			$result1 = $database->query($sql);

			if($result1->rowCount() > 0){

				$details = $result1->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$details));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}
		}



		public function displayMyCompanyServices($id){

			global $database;


			$sql = "SELECT cs.user_id, cs.service_id, s.name FROM company_services cs LEFT JOIN services s ON (s.id = cs.service_id) WHERE cs.user_id = $id";

			$result1 = $database->query($sql);

			if($result1->rowCount() > 0){

				$details = $result1->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$details));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}


			$sql = "SELECT ROUND(AVG(r.rating) ,1) AS company_rating, ct.lat AS latitude, ct.lng AS longitude, u.first_name, u.last_name, cs.company_id, cs.description, cs.date_created, c.name, c.user_id, c.phone_number, c.path, c.thumb, c.address, c.website, c.years_experience, ct.name AS city, c.pic_set, c.country, s.name AS state_name  FROM company_services cs, companies c LEFT JOIN reviews r ON (r.recipient_id = c.id AND r.type = 'company') LEFT JOIN states s ON (s.id = c.state) LEFT JOIN cities ct ON (c.city = ct.id) LEFT JOIN users u ON (c.user_id = u.id) WHERE  c.active = 1 AND c.verified = 1 AND c.deleted = 0 AND cs.active = 1 AND cs.deleted = 0 AND cs.company_id = c.id AND cs.service_id = $id GROUP BY c.id";


			$result1 = $database->query($sql);

			if($result1->rowCount() > 0){

				$details = $result1->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$details));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}
		}



		public function displayCompanyServices($id){

			global $database;


			$sql = "SELECT ROUND(AVG(r.rating) ,1) AS company_rating,
			 c.lat AS latitude,
			  c.lng AS longitude,
			  u.first_name,
			  u.last_name,
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
			  c.location,
			  -- ct.name AS city,
			  c.pic_set,
			  c.city
			  -- s.name AS state_name  

			  FROM company_services cs,
			  companies c 
			  LEFT JOIN reviews r ON (r.recipient_id = c.id AND r.type = 'company') 
			  -- LEFT JOIN states s ON (s.id = c.state) 
			  -- LEFT JOIN cities ct ON (c.city = ct.id) 
			  LEFT JOIN users u ON (c.user_id = u.id)
			   WHERE  c.active = 1 AND c.verified = 1 AND c.deleted = 0 AND cs.active = 1 AND cs.deleted = 0 AND cs.company_id = c.id AND cs.service_id = $id GROUP BY c.id";


			$result1 = $database->query($sql);

			if($result1->rowCount() > 0){

				$details = $result1->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$details));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}
		}




		public function search($q){

			global $database;

			$sql = "SELECT id, name, path, thumb, description FROM services WHERE active = 1 AND deleted = 0 AND name LIKE :q";
			$result = $database->prepare($sql);
			$result->bindValue('q',"%$q%",PDO::PARAM_STR);
			$result->execute(); 


			if($result->rowCount() > 0){

				$results = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$results));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}

		
		
		}


		public function searchCities($q){

			global $database;

			$sql = "SELECT id, name, lng, lat FROM cities WHERE approved = 1 AND name LIKE :q";
			$result = $database->prepare($sql);
			$result->bindValue('q',"%$q%",PDO::PARAM_STR);
			$result->execute(); 


			if($result->rowCount() > 0){

				$results = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$results));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}

		
		
		}

		public function addCompanyServices($files, $post){


			global $database;
			$picture = new Photograph;

			//$company = clean($post['company']);
		$service = clean($post['service_id']);
		$category = clean($post['category_id']);
		$description = clean($post['description']);
		$user_id = clean($post['user_id']);
		$date_created= time();
		$active = 1;
		$deleted = 0;

		$type = 'company';

			$sql1 = "SELECT id FROM companies WHERE user_id = ".$user_id;
			$result1 = $database->query($sql1);

			if($result1->rowCount() > 0){

				$data = $result1->fetch(PDO::FETCH_ASSOC);
				$company_id = $data['id'];

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
				

			}


		if(empty($service)){

			echo json_encode(array('status'=>'empty'));
		    die;

		}

		if(empty($category)){

			echo json_encode(array('status'=>'empty'));
		    die;
		    
		}

		$status = $this->checkCompanyServiceExist($user_id, $service);

			if($status){

				echo json_encode(array('status'=>'exist'));
				die();

			}

			if(isset($files['photo1']) && $files['photo1']['size'] > 0){

	

			$file_index = 'photo1';


		 $file1 = $picture->save($files["$file_index"],uniqid().'-'.time(),'../../uploads/services/');

					 if($file1 == false){
						 
							 echo json_encode(array('status'=>'error'));
							die();
					}

		

						$photo1 = str_ireplace('../../','',$file1);
						//$file2 = str_ireplace('../../uploads/profile/','../../uploads/profile/thumb/',$file);

						// $file3 = str_ireplace('../../uploads/profile/thumb/','uploads/profile/thumb/',$file2);
						
				 	// $thumb1  = $file2;
				 	// $ImageResize = new ImageResize($file);
				 	// $ImageResize->resizeToWidth(460);
				 	// $ImageResize->save($thumb1);


				 
					
				 
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
						//$file2 = str_ireplace('../../uploads/services/','../../uploads/services/thumb/',$file);

						// $file3 = str_ireplace('../../uploads/profile/thumb/','uploads/profile/thumb/',$file2);
						
				 	// $thumb1  = $file2;
				 	// $ImageResize = new ImageResize($file);
				 	// $ImageResize->resizeToWidth(460);
				 	// $ImageResize->save($thumb1);


				 
					
				 
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
						//$file2 = str_ireplace('../../uploads/profile/','../../uploads/profile/thumb/',$file);

						// $file3 = str_ireplace('../../uploads/profile/thumb/','uploads/profile/thumb/',$file2);
						
				 	// $thumb1  = $file2;
				 	// $ImageResize = new ImageResize($file);
				 	// $ImageResize->resizeToWidth(460);
				 	// $ImageResize->save($thumb1);


				 
					
				 
		}else{
			$photo3 = '';
		}



















		$sql = "INSERT INTO company_services (user_id, category_id, service_id, description, company_id,  active, deleted, date_created, path1, path2, path3) VALUES (:user_id, :category_id, :service_id, :description, :company_id, :active, :deleted, :date_created, :path1, :path2, :path3)";

		$result = $database->prepare($sql);
		$result->bindParam('user_id', $user_id,PDO::PARAM_INT);
		
		$result->bindParam('category_id', $category,PDO::PARAM_INT);
		$result->bindParam('service_id', $service,PDO::PARAM_INT);
		$result->bindParam('company_id', $company_id,PDO::PARAM_INT);
		$result->bindParam('description', $description,PDO::PARAM_STR);
		$result->bindParam('path1', $photo1,PDO::PARAM_STR);
		$result->bindParam('path2', $photo2,PDO::PARAM_STR);
		$result->bindParam('path3', $photo3,PDO::PARAM_STR);
		$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
		$result->bindParam('active', $active,PDO::PARAM_INT);
		$result->bindParam('deleted', $deleted,PDO::PARAM_INT);
		
		$result->execute();

		if($result->rowCount() > 0){

			echo json_encode(array('status'=>'success'));
		    die;
			
		}else{

			echo json_encode(array('status'=>'error'));
		    die;
			
		}




			
		}

		

		

			

			public static function fetchCompanyCities($city, $service)
			{
				global $database;


				$sql = "SELECT ct.lat AS latitude, ct.lng AS longitude, u.first_name, u.last_name, cs.company_id, cs.description, cs.date_created, c.name, c.user_id, c.phone_number, c.path, c.thumb, c.address, c.website, c.years_experience, ct.name AS city, c.pic_set, c.country, s.name AS state_name  FROM company_services cs, companies c LEFT JOIN states s ON (s.id = c.state) LEFT JOIN cities ct ON (c.city = ct.id) LEFT JOIN users u ON (c.user_id = u.id) WHERE  c.active = 1 AND c.verified = 1 AND c.deleted = 0 AND cs.active = 1 AND cs.deleted = 0 AND cs.company_id = c.id AND cs.service_id = $service And c.city = $city ";


				$result = $database->query($sql);

				if($result->rowCount() > 0){

				$details = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$details));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}



			}
		

			

			public static function fetchIndividualCities($city, $service)
			{
				global $database;


				$sql1 = "SELECT ct.lat AS latitude, ct.lng AS longitude, AVG(r.rating) AS user_rating,  hs.id AS handy_id, hs.description, hs.date_created, u.pic_set, u.first_name, u.last_name, u.phone1, u.phone2, u.email, u.profile_picture, u.thumb, u.id, ct.name AS city, s.name AS state_name FROM  users u LEFT JOIN states s ON (s.id = u.state_of_residence) LEFT JOIN cities ct ON (u.city_of_residence = ct.id),  handyman_services hs LEFT JOIN reviews r ON (r.service_id = hs.id)  WHERE  u.id = hs.user_id AND u.approved = 1 AND hs.service_id = $service AND u.city_of_residence = $city";


				$result = $database->query($sql1);

				if($result->rowCount() > 0){

				$details = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$details));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}



			}
		

		
		

		public static function fetchMyCompanies($user_id)
			{
				global $database;
				$sql = "SELECT id, name from companies  WHERE user_id = :user_id";
				$result = $database->prepare($sql);
				$result->bindParam('user_id',$user_id,PDO::PARAM_INT);
				$result->execute();

				if($result->rowCount() > 0){

				$companies = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$companies));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}
			}

		public static function fetchCities($country_id)
			{
				global $database;
				$sql = "SELECT id, name from cities WHERE state_id = :country_id";
				$result = $database->prepare($sql);
				$result->bindParam('country_id',$country_id,PDO::PARAM_INT);
				$result->execute();

				if($result->rowCount() > 0){

				$state = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$state));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}
			}



			


			public  function fetchAllCategories()
			{
				global $database;
				$sql = "SELECT id, name, path, thumb FROM categories WHERE active = 1 AND deleted = 0";
				$result = $database->query($sql);
				
				//echo json_encode(array('status'=>$country_id));
				if($result->rowCount() > 0){

				$details = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$details));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}
			}





			public  function fetchDetails($id, $type)
			{
				global $database;

				switch ($type) {
					case 'individual':
						


						$sql3 = "SELECT  u.id, AVG(r.rating) AS user_rating FROM users u LEFT JOIN reviews r ON (r.user_id = u.id) WHERE r.type = 'individual' AND u.id = $id";

					$result3 = $database->query($sql3);

					if($result3->rowCount() > 0){

						$ratings = $result3->fetch(PDO::FETCH_ASSOC);

						$rating = $ratings['user_rating'];

						

					}else{

						$rating = 'empty';

						

					}



				$sql = "SELECT u.*, ct.name AS city_name, s.name AS state_name, cn.name AS country_name FROM users u LEFT JOIN cities ct ON (ct.id = u.city_of_residence)  LEFT JOIN states s ON (s.id = u.state_of_residence)  LEFT JOIN countries
					 cn ON (cn.id = u.country_of_residence) WHERE u.id = :id";
					$result = $database->prepare($sql);
					$result->bindParam('id',$id,PDO::PARAM_INT);
					$result->execute();


					if($result->rowCount() > 0){

						$info = $result->fetch(PDO::FETCH_ASSOC);

						

					}else{

						$info = 'empty';

					}









						break;
					


					case 'company':
						

						$rating = 'empty';


					// 	$sql3 = "SELECT  u.id, AVG(r.rating) AS user_rating FROM users u LEFT JOIN reviews r ON (r.user_id = u.id) WHERE r.type = 'individual' AND u.id = $id";

					// $result3 = $database->query($sql3);

					// if($result3->rowCount() > 0){

					// 	$ratings = $result3->fetch(PDO::FETCH_ASSOC);

					// 	$rating = $ratings['user_rating'];

						

					// }else{

					// 	$rating = 'empty';

						

					// }



				$sql = "SELECT u.*, ct.name AS city_name, s.name AS state_name, cn.name AS country_name FROM companies u LEFT JOIN cities ct ON (ct.id = u.city)  LEFT JOIN states s ON (s.id = u.state)  LEFT JOIN countries
					 cn ON (cn.id = u.country) WHERE u.id = :id";
					$result = $database->prepare($sql);
					$result->bindParam('id',$id,PDO::PARAM_INT);
					$result->execute();


					if($result->rowCount() > 0){

						$info = $result->fetch(PDO::FETCH_ASSOC);

						

					}else{

						$info = 'empty';

					}




						break;
					
				}









				





					echo json_encode(array('status'=>'success', 'rating'=>$rating, 'data'=>$info));
					die;




			}



		public  function fetchStates($country_id)
			{
				global $database;
				$sql = "SELECT id, name FROM states WHERE countryId = :country_id";
				$result = $database->prepare($sql);
				$result->bindParam('country_id',$country_id,PDO::PARAM_INT);
				$result->execute();
				//echo json_encode(array('status'=>$country_id));
				if($result->rowCount() > 0){

				$state = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$state));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}
			}


	public function fetchCountry(){
			global $database;
			$sql = "SELECT id, name FROM countries";
			$result = $database->query($sql);

			if($result->rowCount() > 0){

				$country = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$country));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}

			

		}


		


		public function addCompany($post, $files){


			global $database;
			// echo json_encode(array('test'=>$files));
			// die;
		$file1 = '';
		$file3 = '';
		$pic_set = 0;

		$company_name = clean($post['company_name']);
		$company_phone = clean($post['company_phone']);
		$company_email = clean($post['company_email']);
		$company_address = clean($post['company_address']);
		$company_website = clean($post['company_website']);
		$company_years = clean($post['company_years']);
		//$company_country = clean($post['company_country']);
		//$address = clean($post['address']);
		$location = clean($post['location']);
		$lng = clean($post['lng']);
		$lat = clean($post['lat']);

		$user_id = clean($post['user_id']);


		if(!empty($post['old_pic'])){

			$file1 = clean($post['old_pic']);
			$pic_set = 1;
		}

		if(!empty($post['old_thumb'])){

			$file3 = clean($post['old_thumb']);

		}

		if(empty($company_name)){

			echo json_encode(array('status'=>'empty'));
			die;

		}

		if(empty($company_address)){

			echo json_encode(array('status'=>'empty'));
			die;

		}


		// if(empty($company_country)){

		// 	echo json_encode(array('status'=>'empty'));
		// 	die;

		// }
		
		$date_created = time();

		$active = 1;
		$deleted = 0;
		$verified = 0;

		

		

		if(isset($files['uploadFile']) && $files['uploadFile']['size'] > 0){

			

			$pic_set = 1;

			$picture = new Photograph;

			$file_index = 'uploadFile';


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
						
					
				 
		}


		$sql1 = "SELECT id FROM companies WHERE user_id = $user_id";
		$result1 = $database->query($sql1);
		if($result1->rowCount() > 0){

			$sql = "UPDATE companies SET email = :email, name = :name, phone_number = :phone_number, address = :address, website = :website, years_experience = :years_experience, active = :active, deleted = :deleted, date_created = :date_created, path = :path, thumb = :thumb, lat = :lat, lng = :lng, location =:location, pic_set =:pic_set, verified =:verified  WHERE user_id = :user_id";

		}else{

			$sql = "INSERT INTO companies (user_id, email, name, phone_number, address, website, years_experience, active, deleted, date_created, path, thumb, lat, lng, location, pic_set, verified) VALUES (:user_id, :email, :name, :phone_number, :address, :website, :years_experience, :active, :deleted, :date_created, :path, :thumb, :lat, :lng, :location, :pic_set, :verified)";

		}



		

		$result = $database->prepare($sql);
		$result->bindParam('user_id', $user_id,PDO::PARAM_INT);
		
	//	$result->bindParam('country', $company_country,PDO::PARAM_INT);
		$result->bindParam('address', $company_address,PDO::PARAM_STR);
		$result->bindParam('name', $company_name,PDO::PARAM_STR);
		$result->bindParam('location', $location,PDO::PARAM_STR);
		$result->bindParam('email', $company_email,PDO::PARAM_STR);
		$result->bindParam('path', $file1,PDO::PARAM_STR);
		$result->bindParam('thumb', $file3,PDO::PARAM_STR);
		$result->bindParam('pic_set', $pic_set,PDO::PARAM_STR);
		$result->bindParam('years_experience', $company_years,PDO::PARAM_INT);
		//$result->bindParam('state', $company_state,PDO::PARAM_INT);
		$result->bindParam('website', $company_website,PDO::PARAM_STR);
		$result->bindParam('phone_number', $company_phone,PDO::PARAM_STR);


		$result->bindParam('lat', $lat,PDO::PARAM_STR);
		$result->bindParam('lng', $lng,PDO::PARAM_STR);
		
		$result->bindParam('active', $active,PDO::PARAM_INT);
		$result->bindParam('deleted', $deleted,PDO::PARAM_INT);
		$result->bindParam('verified', $verified,PDO::PARAM_INT);
		
		$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
		$result->execute();

		if($result->rowCount() > 0){
			echo json_encode(array('status'=>'success'));
			die;

		}else{
			echo json_encode(array('status'=>'error'));
			die;

		}





			
		}



		// public function fetchMyServices($id){
			
		// 	global $database;

		// 	$sql = "SELECT s.id, s.name, s.path, s.description, h.user_id FROM services s, handyman_services h, users u WHERE h.service_id = s.id AND h.user_id = $id AND s.active = 1 AND s.deleted = 0";
		// 	$result = $database->query($sql);

		// 	if($result->rowCount() > 0){

		// 		$services = $result->fetchAll(PDO::FETCH_ASSOC);

		// 		echo json_encode(array('status'=>'success', 'data'=>$services));
		// 		die;


		// 	}else{

		// 		echo json_encode(array('status'=>'empty'));
		// 		die;

		// 	}



		// }


		public function fetchMyCompanyServices($id){
			
			global $database;

			$sql = "SELECT s.id, s.name, s.path, h.description, h.user_id, h.path1, h.path3, h.path2 FROM services s, company_services h, users u WHERE h.service_id = s.id AND h.user_id = $id AND s.active = 1 AND s.deleted = 0 GROUP BY h.service_id";
			$result = $database->query($sql);

			if($result->rowCount() > 0){

				$services = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$services));
				die;


			}else{

				echo json_encode(array('status'=>'empty'));
				die;

			}



		}


		public function fetchMyServices($id){
			
			global $database;

			// echo json_encode(array('test'=>$id));
			// 	die;

			$sql = "SELECT s.id, s.name, s.path, h.description, h.user_id, h.path1, h.path2, h.path3 FROM services s, handyman_services h, users u WHERE h.service_id = s.id AND h.user_id = $id AND s.active = 1 AND s.deleted = 0 GROUP BY h.service_id";
			$result = $database->query($sql);

			if($result->rowCount() > 0){

				$services = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$services));
				die;


			}else{

				echo json_encode(array('status'=>'empty'));
				die;

			}



		}


		public function fetchCategoryServices($id){
			
			global $database;

			$sql = "SELECT id, name, path, description FROM services WHERE active = 1 AND deleted = 0 AND category_id = ".$id;
			$result = $database->query($sql);

			if($result->rowCount() > 0){

				$services = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$services));
				die;


			}else{

				echo json_encode(array('status'=>'empty'));
				die;

			}



		}


		public function fetchServices(){

			global $database;

			$sql = "SELECT id, name, path FROM services WHERE active = 1 AND deleted = 0";
			$result = $database->query($sql);

			if($result->rowCount() > 0){

				$services = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$services));
				die;


			}else{

				echo json_encode(array('status'=>'empty'));
				die;

			}



		}








		public function fetchCategories(){

			global $database;

			$sql = "SELECT id, name,  path, description FROM categories WHERE active = 1 AND deleted = 0";
			$result = $database->query($sql);

			if($result->rowCount() > 0){

				 $categories = $result->fetchAll(PDO::FETCH_ASSOC);

				echo json_encode(array('status'=>'success', 'data'=>$categories));
				die;

			}else{

				echo json_encode(array('status'=>'empty'));
				die;
			}



		}
	}
 ?>