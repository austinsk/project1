<?php 


	class Notification{


		public $message_amount;
		
		public $notification_amount;
		public $message;
		public $result2;
		public $result;




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



		public function addAdminNotification($staff_id, $item_type, $item_id){
			global $database;
			//die('dgmjhchnhknrgvnrojndtgh89hjkndiu');
			$date_created = time();
			$read_status = 0;


			$sql = "INSERT INTO admin_notifications (staff_id, item_type, item_id, date_created, read_status) VALUES (:staff_id, :item_type, :item_id, :date_created, :read_status)";

			$result = $database->prepare($sql);
			$result->bindValue('staff_id',$staff_id,PDO::PARAM_INT);
			//$result->bindValue('recipient_id',$recipient_id,PDO::PARAM_INT);
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




		public function CountMyNotification(){

			global $database;


			$sql1 = "SELECT  m.id,m.subject, m.sender_id, m.message, m.date_created, m.recipient_id, s.first_name, s.last_name, s.pic_set, s.thumb FROM message m, users s WHERE s.id = m.sender_id AND  m.message_parent_id = 0 AND m.read_status = 0 AND m.recipient_id =".$_SESSION['user_id']." GROUP BY m.sender_id ORDER BY m.sender_id ASC LIMIT 8 ";


    $this->message = $database->query($sql1);

    $this->message_amount = $this->message->rowCount();





    // $sql2 = "SELECT  n.id, n.staff_id, n.item_id, n.recipient_id, n.item_type, s.first_name, s.last_name FROM user_notifications n, users s WHERE s.id = n.staff_id AND n.read_status = 0 AND n.recipient_id =".$_SESSION['user_id']." LIMIT 8";


    // $this->result2 = $database->query($sql2);

    // $this->notification_amount = $this->result2->rowCount();





		}





	}


	$notification = new Notification;



?>

