<?php
date_default_timezone_set("Africa/Lagos");
require_once 'init.php';

require_once '../../getid/getid3/getid3.php';

$getID3 = new getID3;

try{


	$database->beginTransaction();

if($_FILES['file']['size'] > 0){



			$picture = new Photograph;

			$file_index = 'file';


		 $file_name = $picture->save($_FILES["$file_index"],uniqid().'-'.time(),'../../uploads/');

					if($file_name == false){
						 $_SESSION['error'] = "Invalid Audio file";
						redirect_to($_SERVER['HTTP_REFERER']);
					}

					$file1 = str_ireplace('../../','',$file_name);


					$file_analysis = $getID3->analyze($file_name);

					$duration = $file_analysis['playtime_string'];




					$sql = "SELECT id FROM playlist ";

					$result = $database->query($sql);
							if($result->rowCount() == 0){

								$active = 1;
								$date_created = time();
								$filename = ''; 

								$sql1 = "INSERT INTO playlist (duration, path ,active, date_created) VALUES (:duration, :path ,:active, :date_created)";
								$result1 = $database->prepare($sql1);
								$result1->bindParam('path',$file1, PDO::PARAM_STR);
								$result1->bindParam('active',$active, PDO::PARAM_INT);
								$result1->bindParam('date_created',$date_created, PDO::PARAM_INT);
								$result1->bindParam('duration',$duration, PDO::PARAM_INT);
								$result1->execute();

								if($result1->rowCount() > 0){
									$database->commit();													
									success('Audio Added Successful');
									go();

								}else{

									error('An error occured. Please try Again');
									go();
								}



							}else{

								$active = 0;
								$date_created = time();
								$filename = ''; 

								$sql1 = "INSERT INTO playlist (duration, path ,active, date_created) VALUES (:duration, :path ,:active, :date_created)";
								$result1 = $database->prepare($sql1);
								$result1->bindParam('path',$file1, PDO::PARAM_STR);
								$result1->bindParam('active',$active, PDO::PARAM_INT);
								$result1->bindParam('date_created',$date_created, PDO::PARAM_INT);
								$result1->bindParam('duration',$duration, PDO::PARAM_INT);
								$result1->execute();

								if($result1->rowCount() > 0){
									$database->commit();				
									success('Audio Added Successful');
									go();

								}else{

									error('An error occured. Please try Again');
									go();
								}


							}










						
						
				 
		}else{

			$_SESSION['error'] = "Pls select an Audio File";
			redirect_to($_SERVER['HTTP_REFERER']);

		}





	}catch(PDOException $e){


					$database->rollBack();

					
					 die($e->getMessage());

					
			
				}




?>