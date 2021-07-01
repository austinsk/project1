<?php 
		require_once('init.php');
		require_once('../classes/misc.php');


		 $category = $_POST['category'];
		 $service = $_POST['service'];
		 $location = $_POST['location'];

		
	
		
			global $database;

			$sql1 = "SELECT 
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
			  u.work_address2,
			  u.work_address
			  
			 FROM users u , handyman_services hs  WHERE u.id = hs.user_id  AND u.work_address2 LIKE :location AND

			    u.approved = 1 AND

			     hs.service_id = ".$service;

			     $result = $database->prepare($sql1);
			     $result->bindValue('location',"%$location%",PDO::PARAM_STR);
			     $result->execute();
			     
			     // die($sql1);
			     $individual = '<div class="tab-pane fade in active" id="home">';

			     if($result->rowCount() > 0){



											while($data = $result->fetch(PDO::FETCH_ASSOC)){

												$rating = '';

												if($data['pic_set'] == 0){

													$individual_image = 'assets/images/avatar2.jpg';

												}else{

													$individual_image = $data['thumb'];
												}

												

												// if($data['user_rating'] > 0){


												// 	$rating .= '<div><div class="rating rating-'. ceil($data['user_rating']).' size-15  width-100"><!-- rating-0 ... rating-5 --></div></div>';

												// }else{

												// 	$rating .= '';
												// }

												

												$individual .= '<!-- SEARCH RESULTS -->	
																
							
											<div class="clearfix search-result"><!-- item -->
												<h4 class="margin-bottom-0"><a href="individual-details?id='.$data['id'].'&h_id='.$data['handy_id'].'">'.ucwords($data['first_name']).' '.ucwords($data['last_name']).'</a></h4>
												<small class="text-muted">'.$data['work_address2'].'</small>
												<img src="'.$individual_image.'" alt="dgd" height="60" />
												<p> '.$data['work_address2'].'</p>
												<p> '.$data['work_address'].'</p>
												<a href="individual-details?id='.$data['id'].'&h_id='.$data['handy_id'].'" class="text-warning fsize12">View Individual Details</a>


													'.$rating.'
													
											</div><!-- /item -->

											

											<!-- /SEARCH RESULTS -->
											';
												
											}


											



										}else{

											$individual .=' <h3>No Individual to Display</h3>';
											
										}


										$individual .= '</div>';

										//echo $individual;
										//Company SSide








										$sql = "SELECT  u.first_name, u.last_name, cs.id AS company_service_id, cs.company_id, cs.description, cs.date_created, c.name, c.user_id,  c.phone_number, c.path, c.thumb, c.address, c.website, c.years_experience, c.pic_set, c.country ,  c.location FROM company_services cs, companies c LEFT JOIN users u ON (c.user_id = u.id)  WHERE  c.active = 1 AND c.verified = 1 AND c.deleted = 0 AND cs.active = 1 AND cs.deleted = 0 AND cs.company_id = c.id AND cs.category_id = $service AND  c.location LIKE :location";


			$result1 = $database->prepare($sql);
			$result1->bindValue('location',"%$location%",PDO::PARAM_STR);
			$result1->execute();


			$company = '<div class="tab-pane fade" id="profile">';


			if($result1->rowCount() > 0){


											

											while($data1 = $result1->fetch(PDO::FETCH_ASSOC)){


												if($data1['pic_set'] == 1){

													$image = $data1['path'];
												}else{
													$image = 'assets/images/noimage.jpg';
												}

												

												$company .= '<!-- SEARCH RESULTS -->
							

												<div class="clearfix search-result"><!-- item -->
													<h4 class="margin-bottom-0"><a href="company-details.php?id='.$data1['company_id'].'">'.$data1['name'].' </a></h4>
													<small class="text-muted">'.$data1['address'].'</small>

													<img src="'.$image.'" alt="" height="60" />
													<p>'.$data1['location'].' </p>
													<a href="company-details.php?id='.$data1['company_id'].'&h_id='.$data1['company_service_id'].'" class="text-warning fsize12">View Company Details</a>
												</div><!-- /item -->



												</div>

							
							
												<!-- /SEARCH RESULTS -->';

											}


											



										}else{

											$company .=' <h3>No Company to Display</h3>';
											
										}

										$company .= '</div>';










		 			$all =  $individual.$company;

		 			echo $all;

?>