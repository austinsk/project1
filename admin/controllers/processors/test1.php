<?php
date_default_timezone_set("Africa/Lagos");
require_once 'init.php';




try{


	$database->beginTransaction();


$present_time = time(); 

$sql = "SELECT id, date_created, duration FROM playlist WHERE active = 1";

$result = $database->query($sql);


if($result->rowCount() > 0){


	$data = $result->fetch(PDO::FETCH_ASSOC);

	$time_left = $present_time - $data['date_created'];

	if($time_left > $data['duration']){

		$sql1 = "UPDATE playlist SET active = 1 WHERE id > ".$data['id'] ." ORDER BY id ASC LIMIT 1";
		$result1 = $database->query($sql1);


		$sql2 = "SELECT id, date_created FROM playlist ORDER BY date_created DESC LIMIT 1";
		$data2 = $database->query($sql2)->fetch(PDO::FETCH_ASSOC);



		$sql3 = "UPDATE playlist SET date_created = date_created + 1 WHERE id =".$data2['id'];
		$result3 = $database->query($sql3);






	}

	

}
















		}catch(PDOException $e){

				echo 'error';

				$database->rollBack();

				
				die($e->getMessage());
	
			}




?>