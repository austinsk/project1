<?php 
		require_once('init.php');
		require_once('../classes/misc.php');


		
		 // $handyman_id = $_POST['handyman_id'];
		  $handyman_service_id = $_POST['handyman_service_id'];

		if(!ctype_digit($handyman_service_id)){
			die();
		}
	
		
		$sql4 = "SELECT id FROM completed_services WHERE handyman_service_id = $handyman_service_id AND user_id =".$_SESSION['user_id'];
		$result4 = $database->query($sql4);

		if($result4->rowCount() > 0){

			$sql5 = "DELETE FROM completed_services WHERE handyman_service_id = $handyman_service_id AND user_id =".$_SESSION['user_id'];
			$result5 = $database->query($sql5);

			if($result5){

				$status = 'removed';

			}

		}else{

$date_created = time();
			$sql6 = "INSERT INTO completed_services (handyman_service_id, user_id, date_created) VALUES (:handyman_service_id, :user_id, :date_created)";

			$result6 = $database->prepare($sql6);
			$result6->bindParam('date_created', $date_created, PDO::PARAM_INT);
			$result6->bindParam('handyman_service_id', $handyman_service_id, PDO::PARAM_INT);
			$result6->bindParam('user_id', $_SESSION['user_id'], PDO::PARAM_INT);
			$result6->execute();

			if($result6->rowCount() > 0){

				$status = 'added';
			}


		}


		 			echo $status;

?>