<?php

	class Category{


		public function editCategory(){


		global $database;
		
		$id = clean($_POST['category_id']); 
		$category = clean($_POST['category']);
		$description = clean($_POST['description']);

		if(empty($category)){

			$_SESSION['error'] = "Please Enter a category";
		    go();

		}


		$sql1 = "SELECT id FROM categories WHERE name = :category AND deleted = 0";

			$result1 = $database->prepare($sql1);
			$result1->bindParam('category', $category,PDO::PARAM_STR);
			$result1->execute();

			$data = $result1->fetch(PDO::FETCH_ASSOC);

			if($result1->rowCount() > 0 && $data['id'] != $id){

				$_SESSION['error'] = "category Name Already exist";
				go();
			}


			$sql = "UPDATE categories SET name= :name, description = :description ";



		if($_FILES['file']['size'] > 0){
			    //die('43243');
			    
						$Picture = new Photograph;

						$file_index = 'file';
		
			 	  $status = $Picture->save($_FILES["$file_index"],mt_rand(10, 99) . time(),'../../uploads/category/');
				 if($status == false){

				 	$_SESSION['error'] = "Invalid image file";
			          go();
				 }else{
				 		// die('43243');
				 	$pic_name = str_replace("../../uploads/category/",'',$status);
				 	$thumb1  = '../../uploads/category/thumbnails/home_'.$pic_name;

				 	$pic_name1 = str_replace("../../uploads/category/thumbnails/",'',$thumb1);

				 	$ImageResize = new ImageResize($status);
				 	$ImageResize->resize(214, 142);
				 	$ImageResize->save($thumb1);


				 	$thumb2  = '../../uploads/category/thumbnails/details_'.$pic_name;
				 	$ImageResize = new ImageResize($status);
				 	$ImageResize->resizeToHeight(400);
				 	$ImageResize->save($thumb2);	

				 	$ImageResize = new ImageResize($status);
				 	$ImageResize->resizeToWidth(600);
				 	$ImageResize->save($status);	
				 	
				 	
				 }
			                        

				 	$sql .=" ,path = '$pic_name', thumb = '$pic_name1'";	

			                     
			            }else{

			            	error('Please Upload an Image');
			            	go();
			            }


			     if($_FILES['file1']['size'] > 0){
			    //die('43243');
			    
						$Picture = new Photograph;

						$file_index = 'file1';
		
			 	  $status = $Picture->save($_FILES["$file_index"],mt_rand(10, 99) . time(),'../../uploads/category/');
				 if($status == false){

				 	$_SESSION['error'] = "Invalid image file";
			          go();
				 }else{
				 		// die('43243');
				 	$pic_name = str_replace("../../uploads/category/",'',$status);
				 	$thumb1  = '../../uploads/category/thumbnails/home_'.$pic_name;

				 	$pic_name1 = str_replace("../../uploads/category/thumbnails/",'',$thumb1);

				 	$ImageResize = new ImageResize($status);
				 	$ImageResize->resize(214, 142);
				 	$ImageResize->save($thumb1);


				 	$thumb2  = '../../uploads/category/thumbnails/details_'.$pic_name;
				 	$ImageResize = new ImageResize($status);
				 	$ImageResize->resizeToHeight(400);
				 	$ImageResize->save($thumb2);	

				 	$ImageResize = new ImageResize($status);
				 	$ImageResize->resizeToWidth(600);
				 	$ImageResize->save($status);	
				 	
				 	
				 }
			                        

				 	$sql .=" ,path = '$pic_name', thumb = '$pic_name1'";	

			                     
			            }else{

			            	error('Please Upload a Mobile Image');
			            	go();
			            }

		
		$date_created = time();

		$active = 1;
		$deleted = 0;

		$sql .= " WHERE id = :id";

		

		

		$result = $database->prepare($sql);
		$result->bindParam('name', $category,PDO::PARAM_STR);
		$result->bindParam('description', $description,PDO::PARAM_STR);
		// $result->bindParam('active', $active,PDO::PARAM_INT);
		// $result->bindParam('deleted', $deleted,PDO::PARAM_INT);
		//$result->bindParam('path', $pic_name,PDO::PARAM_STR);
		//$result->bindParam('thumb', $pic_name1,PDO::PARAM_STR);
		$result->bindParam('id', $id,PDO::PARAM_INT);
		//$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
		$result->execute();

		if($result){
			$_SESSION['success'] = "category added Successfully";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}





		}



		public function addCategory(){


		global $database;
		 
		$category = clean($_POST['category']);
		$description = clean($_POST['description']);

		if(empty($category)){

			$_SESSION['error'] = "Please Enter a category";
		    go();

		}


		$sql1 = "SELECT id FROM categories WHERE name = :category AND deleted = 0";

			$result1 = $database->prepare($sql1);
			$result1->bindParam('category', $category,PDO::PARAM_STR);
			$result1->execute();

			

			if($result1->rowCount() > 0){

				$_SESSION['error'] = "category Name Already exist";
				go();
			}


		if($_FILES['file']['size'] > 0){
			    //die('43243');
			    
			             //    $picture = new Photograph;
			    
			             //    $file_index = 'file';
			    
			             // $file = $picture->save($_FILES["$file_index"],uniqid().'-'.time(),'../../uploads/category/');
			    
			             //             if($file == false){
			             //                 $_SESSION['error'] = "Invalid image file";
			             //                go();
			             //            }
			    
			             //                $file1 = str_ireplace('../../','',$file);
			             //                $file2 = str_ireplace('../../uploads/category/','uploads/category/thumbnails/',$file);
			                            
			             //             $thumb1  = $file2;
			             //             $ImageResize = new ImageResize($file);
			             //             $ImageResize->resizeToWidth(600);
			             //             $ImageResize->save($file1,'../../uploads/category/thumbnails');

					 //die('43243');
						$Picture = new Photograph;

						$file_index = 'file';
		
			 	  $status = $Picture->save($_FILES["$file_index"],mt_rand(10, 99) . time(),'../../uploads/category/');
				 if($status == false){

				 	$_SESSION['error'] = "Invalid image file";
			          go();
				 }else{
				 		// die('43243');
				 	$pic_name = str_replace("../../uploads/category/",'',$status);
				 	$thumb1  = '../../uploads/category/thumbnails/home_'.$pic_name;

				 	$pic_name1 = str_replace("../../uploads/category/thumbnails/",'',$thumb1);

				 	$ImageResize = new ImageResize($status);
				 	$ImageResize->resize(214, 142);
				 	$ImageResize->save($thumb1);


				 	$thumb2  = '../../uploads/category/thumbnails/details_'.$pic_name;
				 	$ImageResize = new ImageResize($status);
				 	$ImageResize->resizeToHeight(400);
				 	$ImageResize->save($thumb2);	

				 	$ImageResize = new ImageResize($status);
				 	$ImageResize->resizeToWidth(600);
				 	$ImageResize->save($status);	
				 	
				 	
				 }
			                        



			                     
			            }
			            // else{
			            //     die('PLEASE UPLOAD A PICTURE');
			            //     $file1="";
			            //     $_SESSION['error'] = "Please Upload an Image for this category";
			            //     go();
			            // }

			 if($_FILES['file1']['size'] > 0){
			    //die('43243');
			    
			             //    $picture = new Photograph;
			    
			             //    $file_index = 'file';
			    
			             // $file = $picture->save($_FILES["$file_index"],uniqid().'-'.time(),'../../uploads/category/');
			    
			             //             if($file == false){
			             //                 $_SESSION['error'] = "Invalid image file";
			             //                go();
			             //            }
			    
			             //                $file1 = str_ireplace('../../','',$file);
			             //                $file2 = str_ireplace('../../uploads/category/','uploads/category/thumbnails/',$file);
			                            
			             //             $thumb1  = $file2;
			             //             $ImageResize = new ImageResize($file);
			             //             $ImageResize->resizeToWidth(600);
			             //             $ImageResize->save($file1,'../../uploads/category/thumbnails');

					 //die('43243');
						$Picture = new Photograph;

						$file_index = 'file1';
		
			 	  $status = $Picture->save($_FILES["$file_index"],mt_rand(10, 99) . time(),'../../uploads/category/');
				 if($status == false){

				 	$_SESSION['error'] = "Invalid image file";
			          go();
				 }else{
				 		// die('43243');
				 	$mobile_path = str_replace("../../uploads/category/",'',$status);
				 	$thumb1  = '../../uploads/category/thumbnails/home_'.$pic_name;

				 	$pic_name1 = str_replace("../../uploads/category/thumbnails/",'',$thumb1);

				 	$ImageResize = new ImageResize($status);
				 	$ImageResize->resize(214, 142);
				 	$ImageResize->save($thumb1);


				 	$thumb2  = '../../uploads/category/thumbnails/details_'.$pic_name;
				 	$ImageResize = new ImageResize($status);
				 	$ImageResize->resizeToHeight(400);
				 	$ImageResize->save($thumb2);	

				 	$ImageResize = new ImageResize($status);
				 	$ImageResize->resizeToWidth(600);
				 	$ImageResize->save($status);	
				 	
				 	
				 }
			                        



			                     
			            }
			            // else{
			            //     die('PLEASE UPLOAD A MOBILE PICTURE');
			            //     $file1="";
			            //     $_SESSION['error'] = "Please Upload an Image for this category";
			            //     go();
			            // }



		
		$date_created = time();

		$active = 1;
		$deleted = 0;

		$sql = "INSERT INTO categories (name, description, date_created, active, deleted, path, thumb, mobile_path) VALUES (:name, :description,  :date_created, :active, :deleted, :path, :thumb, :mobile_path)";

		$result = $database->prepare($sql);
		$result->bindParam('name', $category,PDO::PARAM_STR);
		$result->bindParam('description', $description,PDO::PARAM_STR);
		$result->bindParam('active', $active,PDO::PARAM_INT);
		$result->bindParam('deleted', $deleted,PDO::PARAM_INT);
		$result->bindParam('path', $pic_name,PDO::PARAM_STR);
		$result->bindParam('mobile_path', $mobile_path,PDO::PARAM_STR);
		$result->bindParam('thumb', $pic_name1,PDO::PARAM_STR);
		$result->bindParam('date_created', $date_created,PDO::PARAM_INT);
		$result->execute();

		if($result->rowCount() > 0){
			$_SESSION['success'] = "category added Successfully";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}





		}




		public function displaycategories(){



			global $database;

			// $sql = "SELECT c.id, c.name AS category_name, c.date_created, c.active, s.name AS category_name FROM categories c, categories s WHERE c.deleted = 0 AND c.category_id = s.id";

			$sql = "SELECT id, name, description, date_created, active FROM categories WHERE deleted = 0";
			$result = $database->query($sql);


			if($result->rowCount() > 0 ){


				$head = '<thead>
                <tr>

                  <th>category Name</th>
                  
                  <th style="width:40%;">Description</th>
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
			                  <td>'.strtoupper($data['name']).'</td>

			                  

			                  <td>'.$data['description'].'</td>

			                  

			                  <td>'.$date.'</td>

			                  <td><a href="edit-category.php?id='.$data['id'].'" class=" btn btn-info btn-sm">Edit</a> &nbsp;';

			                  if($data['active'] == 1){

			                  	$html .= '<button id="'.$data['id'].'" class="deactivate btn btn-warning btn-sm">Deactivate</button>';
			                  }elseif($data['active'] == 0){
			                  	$html .= '<button id="'.$data['id'].'" class="activate btn btn-success btn-sm">Activate</button>';
			                  }


			              $html .='&nbsp; <button id="'.$data['id'].'" class="delete btn btn-danger btn-sm">Delete</button> </tr>';


				}


				$html .='</tbody>
                <tfoot>
                '.$head.'
                </tfoot>
              </table>';

			}else{
				$html = '<h3>No Servcice to Display</h3>';
			}

			echo $html;
		}



			public function deactivatecategory($id){


						global $database;


						$sql = "UPDATE categories SET active = 0 WHERE id =".$id;

						$result = $database->query($sql);

						if($result){
						$_SESSION['success'] = "category Successfully Deactivated";
					    go();
					}else{
						$_SESSION['error'] = "An error Occurred. Please Try again";
					    go();
					}
			}


			public function activatecategory($id){


					global $database;


					$sql = "UPDATE categories SET active = 1 WHERE id =".$id;

					$result = $database->query($sql);

					if($result){
					$_SESSION['success'] = "category Successfully Activated";
				    go();
				}else{
					$_SESSION['error'] = "An error Occurred. Please Try again";
				    go();
				}
		}


		public function deletecategory($id){


			global $database;


			$sql = "UPDATE categories SET deleted = 1 WHERE id =".$id;

			$result = $database->query($sql);

			if($result){
			$_SESSION['success'] = "category Successfully Deleted";
		    go();
		}else{
			$_SESSION['error'] = "An error Occurred. Please Try again";
		    go();
		}
	}











	}









 ?>