<?php 

//require_once 'init.php';
	
	
	class General{


		public $allUser;
		public $verifiedUser;
		public $approvedUser;
		public $allCompanies;





		
		public function dashCount(){

			global $database;


			$sql1 = "SELECT id FROM users";
			$result1 = $database->query($sql1);
			$this->allUser = $result1->rowCount();



			$sql2 = "SELECT id FROM users WHERE active = 1 AND verified = 1";
			$result2 = $database->query($sql2);
			$this->verifiedUser = $result2->rowCount();


			$sql3 = "SELECT id FROM users WHERE active = 1 AND approved = 1";
			$result3 = $database->query($sql3);
			$this->approvedUser = $result3->rowCount();	



			$sql4 = "SELECT id FROM companies WHERE active = 1 AND verified = 1";
			$result4 = $database->query($sql4);
			$this->allCompanies = $result4->rowCount();			






		}


























	}








 ?>