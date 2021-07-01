<?php
	
	class Notification{





		public function addNotification($staff_id, $recipient_id, $item_type, $item_id){
			global $database;
			//die('dgmjhchnhknrgvnrojndtgh89hjkndiu');
			$date_created = time();
			$read_status = 0;


			$sql = "INSERT INTO user_notifications (staff_id, recipient_id, item_type, item_id, date_created, read_status) VALUES (:staff_id, :recipient_id, :item_type, :item_id, :date_created, :read_status)";

			$result = $database->prepare($sql);
			$result->bindValue('staff_id',$staff_id,PDO::PARAM_INT);
			$result->bindValue('recipient_id',$recipient_id,PDO::PARAM_INT);
			$result->bindValue('item_id',$item_id,PDO::PARAM_INT);
			$result->bindValue('date_created',$date_created,PDO::PARAM_INT);
			$result->bindValue('read_status',$read_status,PDO::PARAM_INT);
			$result->bindValue('item_type',$item_type,PDO::PARAM_STR);

			$result->execute();


			if($result->rowCount() > 0){
				return true;
			}else{
				return false;
			}





		}




		public function removeNotification($id){

			global $database;

			$sql = "UPDATE admin_notifications SET read_status = 1 WHERE id =".$id;
			$result = $database->query($sql);

			if($result){

				return true;

			}else{
				return false;
			}

		}


	}


$notification = new Notification;



?>