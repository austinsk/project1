<?php

	class Service{


	public function editService(){


				global $database;


 			$category_id = clean($_POST['category_id']);
			$description = clean($_POST['description']);
			$service_id = clean($_POST['service_id']);
			$service = clean($_POST['service']);

			if(empty($service)){

				$_SESSION['error'] = "Service cannot be empty";
				go();
			}

			if(empty($category_id)){

				$_SESSION['error'] = "Please selecet a Category";
				go();
			}

			$sql1 = "SELECT id FROM services WHERE name = :service AND deleted = 0";

			$result1 = $database->prepare($sql1);
			$result1->bindParam('service', $service,PDO::PARAM_STR);
			$result1->execute();

			$data = $result1->fetch(PDO::FETCH_ASSOC);

			if($result1->rowCount() > 0 && $data['id'] != $service_id){

				$_SESSION['error'] = "Service Name Already exist";
				go();
			}

			 $sql = "UPDATE services SET name = :name, category_id = :category_id, description = :description ";


			if($_FILES['file']['size'] > 0){
			    //die('43243');
			    


						$Picture = new Photograph;

						$file_index = 'file';
		
			 	  $status = $Picture->save($_FILES["$file_index"],mt_rand(10, 99) . time(),'../../uploads/service/');
				 if($status == false){

				 	$_SESSION['error'] = "Invalid image file";
			          go();
						 }else{
						 		// die('43243');
						 	$pic_name = str_replace("../../uploads/service/",'',$status);
						 	$thumb1  = '../../uploads/service/thumbnails/home_'.$pic_name;

						 	$pic_name1 = str_replace("../../uploads/service/thumbnails/",'',$thumb1);

						 	$ImageResize = new ImageResize($status);
						 	$ImageResize->resize(214, 142);
						 	$ImageResize->save($thumb1);


						 	$thumb2  = '../../uploads/service/thumbnails/details_'.$pic_name;
						 	$ImageResize = new ImageResize($status);
						 	$ImageResize->resizeToHeight(400);
						 	$ImageResize->save($thumb2);	

						 	$ImageResize = new ImageResize($status);
						 	$ImageResize->resizeToWidth(600);
						 	$ImageResize->save($status);	
						 	
						 	
							}


							$sql .= ", path = '$pic_name', thumb = '$pic_name1'";



			                     
			            }
			    $active = 1;
			    $date_created = time();

			    $sql .= " WHERE id = :id";

			   
			   



			$result = $database->prepare($sql);
			$result->bindParam('name', $service,PDO::PARAM_STR);
			$result->bindParam('category_id', $category_id,PDO::PARAM_STR);
			$result->bindParam('description', $description,PDO::PARAM_STR);
			//$result->bindParam('thumb', $pic_name1,PDO::PARAM_STR);
			//$result->bindParam('active', $active,PDO::PARAM_INT);
			// $result->bindParam('service', $service,PDO::PARAM_INT);
			$result->bindParam('id', $service_id,PDO::PARAM_INT);
			//$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
			$result->execute();

			if($result){

				$_SESSION['success'] = "Service Edited Successfully.";
			    go();
			}else{

				$_SESSION['error'] = "An error Occurred. Please Try again";
			    go();
			}







		}








		public function addService(){


				global $database;


 
			$category_id = clean($_POST['category']);
			$service = clean($_POST['service']);
			$description = clean($_POST['description']);

			if(empty($category)){

				$_SESSION['error'] = "Category cannot be empty";
				go();
			}

			if(empty($service)){

				$_SESSION['error'] = "Please selecet a service";
				go();
			}

			$sql1 = "SELECT id FROM services WHERE name = :category AND deleted = 0";

			$result1 = $database->prepare($sql1);
			$result1->bindParam('category', $category,PDO::PARAM_STR);
			$result1->execute();

			if($result1->rowCount() > 0){

				$_SESSION['error'] = "Category Name Already exist";
				go();
			}


			if($_FILES['file']['size'] > 0){
			    //die('43243');
			    
			             //    $picture = new Photograph;
			    
			             //    $file_index = 'file';
			    
			             // $file = $picture->save($_FILES["$file_index"],uniqid().'-'.time(),'../../uploads/service/');
			    
			             //             if($file == false){
			             //                 $_SESSION['error'] = "Invalid image file";
			             //                go();
			             //            }	


			    
			             //                $file1 = str_ireplace('../../','',$file);

			                           

			             //                $file2 = str_ireplace('../../uploads/','uploads/thumbnails/',$file);

			                            
			                            
			             //             $thumb1  = $file2;
			             //             $ImageResize = new ImageResize($file);
			             //             $ImageResize->resizeToWidth(600);
			             //             $ImageResize->save($thumb1,'../../uploads/thumbnails/category/');



						$Picture = new Photograph;

						$file_index = 'file';
		
			 	  $status = $Picture->save($_FILES["$file_index"],mt_rand(10, 99) . time(),'../../uploads/service/');
				 if($status == false){

				 	$_SESSION['error'] = "Invalid image file";
			          go();
						 }else{
						 		// die('43243');
						 	$pic_name = str_replace("../../uploads/service/",'',$status);
						 	$thumb1  = '../../uploads/service/thumbnails/home_'.$pic_name;

						 	$pic_name1 = str_replace("../../uploads/service/thumbnails/",'',$thumb1);

						 	$ImageResize = new ImageResize($status);
						 	$ImageResize->resize(199, 199);
						 	$ImageResize->save($thumb1);


						 	$thumb2  = '../../uploads/service/thumbnails/details_'.$pic_name;
						 	$ImageResize = new ImageResize($status);
						 	$ImageResize->resizeToHeight(199);
						 	$ImageResize->save($thumb2);	

						 	$ImageResize = new ImageResize($status);
						 	$ImageResize->resizeToWidth(600);
						 	$ImageResize->save($status);	
						 	
						 	
							}



			                     
			            }
			            // else{
			            //     // die('PLEASE UPLOAD A PICTURE');

			            //     $file1="";
			            //     $_SESSION['error'] = "Please Upload an Image for this Category";
			            //     go();
			            // }
			    $active = 1;
			    $date_created = time();

			$sql = "INSERT INTO services (name, description , path, active, date_created, category_id, thumb) VALUES (:name, :description , :path, :active, :date_created, :category_id, :thumb)";

			$result = $database->prepare($sql);
			$result->bindParam('name', $service,PDO::PARAM_STR);
			$result->bindParam('description', $description,PDO::PARAM_STR);
			$result->bindParam('path', $pic_name,PDO::PARAM_STR);
			$result->bindParam('thumb', $pic_name1,PDO::PARAM_STR);
			$result->bindParam('active', $active,PDO::PARAM_INT);
			$result->bindParam('category_id', $category_id,PDO::PARAM_INT);
			$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
			$result->execute();

			if($result->rowCount() > 0){

				$_SESSION['success'] = "Category Added Successfully.";
			    go();
			}else{

				$_SESSION['error'] = "An error Occurred. Please Try again";
			    go();
			}







		}




		public function displayServices(){



			global $database;


			$sql = "SELECT s.id,  s.name AS service_name, s.date_created, s.active, c.name AS category_name FROM categories c, services s WHERE s.deleted = 0 AND s.category_id = c.id";

			// $sql = "SELECT id, name AS category_name, description, date_created, active FROM services WHERE deleted = 0";
			$result = $database->query($sql);
			


			if($result->rowCount() > 0 ){


				$head = '<thead>
                <tr>

                  <th>Service Name</th>
                  
                  <th>Category Name</th>
                 
                  <th>Date Created</th>
                  
                  <th style="width:20%;"></th>
                  
                </tr>
                </thead>';

			$html = '<table id="example1" class="table table-bordered table-striped">
                '.$head.'
                <tbody>
                ';

				while($data = $result->fetch(PDO::FETCH_ASSOC)){


					$date = date("F j, Y", $data['date_created']);


				$html .= '<tr>
			                  <td>'.strtoupper($data['service_name']).'</td>

								
								<td>'.strtoupper($data['category_name']).'</td>			                  

			                 

			                  

			                  <td>'.$date.'</td>

			                  <td><a href="edit-service.php?id='.$data['id'].'" class=" btn btn-info btn-sm">Edit</a> &nbsp;';

			                  if($data['active'] == 1){

			                  	$html .= '<button id="'.$data['id'].'" class="deactivate btn btn-warning btn-sm">Deactivate</button>';
			                  }elseif($data['active'] == 0){
			                  	$html .= '<button id="'.$data['id'].'" class="activate btn btn-success btn-sm">Activate</button>';
			                  }


			              $html .=' &nbsp; <button id="'.$data['id'].'" class="delete btn btn-danger btn-sm">Delete</button> </tr>';


				}


				$html .='</tbody>
                <tfoot>
                '.$head.'
                </tfoot>
              </table>';

			}else{
				$html = '<h3>No Category to Display</h3>';
			}

			echo $html;
		}




			public function deactivateCategory($id){


						global $database;


						$sql = "UPDATE services SET active = 0 WHERE id =".$id;

						$result = $database->query($sql);

						if($result){
						$_SESSION['success'] = "Category Successfully Deactivated";
					    go();
					}else{
						$_SESSION['error'] = "An error Occurred. Please Try again";
					    go();
					}
			}


			public function activateCategory($id){


					global $database;


					$sql = "UPDATE services SET active = 1 WHERE id =".$id;

					$result = $database->query($sql);

					if($result){
					$_SESSION['success'] = "Category Successfully Activated";
				    go();
				}else{
					$_SESSION['error'] = "An error Occurred. Please Try again";
				    go();
				}
		}


		public function deleteCategory($id){


			global $database;


			$sql = "UPDATE services SET deleted = 1 WHERE id =".$id;

			$result = $database->query($sql);

			if($result){
			$_SESSION['success'] = "Category Successfully Deleted";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}
	}






	}



 ?>